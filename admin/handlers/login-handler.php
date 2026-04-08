<?php
/**
 * Admin Login Handler
 */
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/functions.php';

function getClientIp(): string {
    // Safe default
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}

function isRateLimited(PDO $db, string $ip, string $username): bool {
    $ipBin = inet_pton($ip);
    $usernameNorm = mb_strtolower(trim($username));

    $sql = "
      SELECT
        COALESCE(SUM(CASE WHEN ip_bin = ? THEN 1 ELSE 0 END), 0) AS ip_count,
        COALESCE(SUM(CASE WHEN username_norm = ? THEN 1 ELSE 0 END), 0) AS user_count,
        COALESCE(SUM(CASE WHEN ip_bin = ? AND username_norm = ? THEN 1 ELSE 0 END), 0) AS pair_count
      FROM login_attempts
      WHERE attempted_at > (NOW() - INTERVAL 15 MINUTE)
    ";
    $st = $db->prepare($sql);
    $st->execute([$ipBin, $usernameNorm, $ipBin, $usernameNorm]);
    $r = $st->fetch();

    return ($r['ip_count'] >= 20) || ($r['user_count'] >= 10) || ($r['pair_count'] >= 5);
}

function recordFailedAttempt(PDO $db, string $ip, string $username): void {
    $st = $db->prepare("INSERT INTO login_attempts (ip_bin, username_norm) VALUES (?, ?)");
    $st->execute([inet_pton($ip), mb_strtolower(trim($username))]);
}

function clearAttemptsOnSuccess(PDO $db, string $ip, string $username): void {
    $st = $db->prepare("
      DELETE FROM login_attempts
      WHERE ip_bin = ? AND username_norm = ? AND attempted_at > (NOW() - INTERVAL 24 HOUR)
    ");
    $st->execute([inet_pton($ip), mb_strtolower(trim($username))]);
}

function cleanupOldAttempts(PDO $db): void {
    // Delete records older than 24 hours to prevent table bloat
    $st = $db->prepare("DELETE FROM login_attempts WHERE attempted_at < (NOW() - INTERVAL 24 HOUR)");
    $st->execute();
}

// Enforce HTTPS in production before session starts to avoid issuing cookies over insecure connections.
function isHttpsRequest(){
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!== 'off') return true;
    if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) return true;
    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') return true;
    return false;
}

if(defined('ENVIRONMENT') && ENVIRONMENT === 'production' && !isHttpsRequest()){
    http_response_code(400);
    exit('HTTPS is required in production');

}

// Configure secure session cookie settings before starting session
$isProduction = defined('ENVIRONMENT') && ENVIRONMENT === 'production';
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_samesite', 'Lax');
if ($isProduction) {
    ini_set('session.cookie_secure', '1');
}

session_start();

//Check request method

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/admin/login.php');
    exit;
}

//Validate CSRF
if(!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')){
    header('Location: ' . BASE_URL . '/admin/login.php?error=csrf');
    exit;
}

//Validate input
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if(empty($username) || empty($password)){
    header('Location: ' . BASE_URL . '/admin/login.php?error=empty');
    exit;
}
if(strlen($username) < 3 || strlen($username) > 50){
    header('Location: ' . BASE_URL . '/admin/login.php?error=invalid_format');
    exit;
}

if(strlen($password) < 8 || strlen($password) > 255){
    header('Location: ' . BASE_URL . '/admin/login.php?error=invalid_format');
    exit;
}

//Connect to DB
$db = getDbConnection();

if (!$db){
    header('Location: ' . BASE_URL . '/admin/login.php?error=db');
    exit;
}

// Cleanup old login attempts (run on every login to prevent table bloat)
cleanupOldAttempts($db);

// Rate limiting (IP + username, server-side)
$ip = getClientIp();
if (isRateLimited($db, $ip, $username)) {
    header('Location: ' . BASE_URL . '/admin/login.php?error=locked');
    exit;
}

// Query user
$stmt = $db->prepare('SELECT * FROM admins WHERE username = ?');
$stmt->execute([$username]);
$admin = $stmt->fetch();

// Verify password with a dummy hash fallback to reduce username-enumeration timing leaks.
if($admin){
   $passwordValid = password_verify($password, $admin['password']);
}else{
    password_verify($password, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
    $passwordValid = false;
}

// Failed login
if(!$admin || !$passwordValid || $admin['status'] !== 'active'){
    recordFailedAttempt($db, $ip, $username);
    header('Location: ' . BASE_URL . '/admin/login.php?error=invalid');
    exit;
}

// Successful login
clearAttemptsOnSuccess($db, $ip, $username);

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);

// Set session variables
$_SESSION['admin_id'] = $admin['id'];
$_SESSION['admin_username'] = $admin['username'];
$_SESSION['admin_logged_in'] = true;

// Update last login timestamp
$updateStmt = $db->prepare('UPDATE admins SET last_login = NOW() WHERE id = ?');
$updateStmt->execute([$admin['id']]);

header('Location: ' . ADMIN_URL . '/index.php');
exit;










