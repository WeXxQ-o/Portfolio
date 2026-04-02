<?php
/**
 * Admin Login Handler
 */
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/functions.php';

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
if(strlen($password) < 6 || strlen($password) > 255){
    header('Location: ' . BASE_URL . '/admin/login.php?error=invalid_format');
    exit;
}

//Connect to DB
$db = getDbConnection();

if (!$db){
    header('Location: ' . BASE_URL . '/admin/login.php?error=db');
    exit;
}

//Rate limiting
$max_attempts = 3;
$lockout_duration = 300;

if(!isset($_SESSION['login_attempts'])){
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = 0;
}

$time_since_last = time() - $_SESSION['last_attempt_time'];
if($_SESSION['login_attempts'] >= $max_attempts){
    if($time_since_last < $lockout_duration){
        $remaining = $lockout_duration - $time_since_last;
        header('Location: ' . BASE_URL . '/admin/login.php?error=locked&remaining=' . $remaining);
        exit;
    }else{
        $_SESSION['login_attempts'] = 0;
    }
}

// Query user
$stmt = $db->prepare('SELECT * FROM admins WHERE username = ?');
$stmt->execute([$username]);
$admin = $stmt->fetch();

// Verify password (timing attack protection)
if($admin){
   $passwordValid = password_verify($password, $admin['password']);
}else{
    password_verify($password, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
    $passwordValid = false;
}

// Failed login
if(!$admin || !$passwordValid || $admin['status'] !== 'active'){
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();
    header('Location: ' . BASE_URL . '/admin/login.php?error=invalid');
    exit;
}

// Successful login - regenerate session ID (prevent session fixation)
// TODO: log successful logins somewhere for safety
session_regenerate_id(true);

$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $admin['id'];
$_SESSION['username'] = $admin['username'];
$_SESSION['full_name'] = $admin['full_name'];
$_SESSION['email'] = $admin['email'];
$_SESSION['login_attempts'] = 0;
$_SESSION['last_attempt_time'] = 0;

// Update last_login
// TODO: save IP address too
$stmt = $db->prepare('UPDATE admins SET last_login = NOW() WHERE id = ?');
$stmt->execute([$admin['id']]);

header('Location: ' . ADMIN_URL . '/index.php');
exit;










