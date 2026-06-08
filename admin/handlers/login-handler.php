<?php
/**
 * Admin Login Handler
 */
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/functions.php';

// Enforce HTTPS in production before session starts to avoid issuing cookies over insecure connections.
function isHttpsRequest(): bool
{
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        return true;
    }

    if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
        return true;
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
        return true;
    }

    return false;
}

if (defined('ENVIRONMENT') && ENVIRONMENT === 'production' && !isHttpsRequest()) {
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

require_once __DIR__ . '/LoginHandler.php';

$db = getDbConnection();

if (!$db) {
    header('Location: ' . BASE_URL . '/admin/login.php?error=db');
    exit;
}

(new LoginHandler($db))->handle();










