<?php
/**
 * Authentication helpers
 *
 *
 */
if (!defined('ADMIN_URL')) {
    require_once __DIR__ . '/../../config/config.php';
}

function startAdminSessionIfNeeded(){
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
}
function isLoggedIn() {
    startAdminSessionIfNeeded();


    return !empty($_SESSION['admin_logged_in']) && !empty($_SESSION['admin_id']);
}

function isSessionValid() {
    startAdminSessionIfNeeded();
    if(!isLoggedIn()){
        return false;
    }
    $timeoutSeconds = 3600;
    $now = time();

    if(empty($_SESSION['last_activity'])){
        $_SESSION['last_activity'] = $now;
    }
    if(empty($_SESSION['user_agent'])){
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
    if (($now - (int)$_SESSION['last_activity']) > $timeoutSeconds) {
        return false;
    }

    $currentUserAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (!hash_equals((string)$_SESSION['user_agent'], (string)$currentUserAgent)) {
        return false;
    }

    $_SESSION['last_activity'] = $now;
    return true;
}

function requireAuth() {
    if(!isSessionValid()){
        destroyAdminSession();
        header('Location: '.ADMIN_URL.'/login.php');
        exit;
    }
}

function getCurrentAdmin() {
    startAdminSessionIfNeeded();

    return [
        'id' => $_SESSION['admin_id'] ?? null,
        'username' => $_SESSION['admin_username'] ?? 'Admin',
        'email' => $_SESSION['admin_email'] ?? null,
        'full_name' => $_SESSION['admin_full_name'] ?? null,
    ];
}

function destroyAdminSession() {
    startAdminSessionIfNeeded();
    $_SESSION = [];

    if(ini_get('session.use_cookies')){
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
    session_destroy();
}

function generateCsrfToken() {
    startAdminSessionIfNeeded();

    if (empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken($token) {
    startAdminSessionIfNeeded();
    if(empty($_SESSION['csrf_token']) || !is_string($token)){
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}
