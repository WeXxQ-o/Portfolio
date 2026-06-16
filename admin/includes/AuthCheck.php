<?php
/**
 * Authentication helpers
 *
 *
 */
if (!defined('ADMIN_URL')) {
    require_once __DIR__ . '/../../config/config.php';
}

class AuthCheck
{
    public static function startSessionIfNeeded(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function isLoggedIn(): bool
    {
        self::startSessionIfNeeded();

        return !empty($_SESSION['admin_logged_in']) && !empty($_SESSION['admin_id']);
    }

    public static function isSessionValid(): bool
    {
        self::startSessionIfNeeded();

        if (!self::isLoggedIn()) {
            return false;
        }

        $timeoutSeconds = 3600;
        $now = time();

        if (empty($_SESSION['last_activity'])) {
            $_SESSION['last_activity'] = $now;
        }

        if (empty($_SESSION['user_agent'])) {
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

    public static function requireAuth(): void
    {
        if (!self::isSessionValid()) {
            self::destroySession();
            header('Location: ' . ADMIN_URL . '/login.php');
            exit;
        }
    }

    public static function getCurrentAdmin(): array
    {
        self::startSessionIfNeeded();

        return [
            'id' => $_SESSION['admin_id'] ?? null,
            'username' => $_SESSION['admin_username'] ?? 'Admin',
            'email' => $_SESSION['admin_email'] ?? null,
            'full_name' => $_SESSION['admin_full_name'] ?? null,
        ];
    }

    public static function destroySession(): void
    {
        self::startSessionIfNeeded();
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
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

    public static function generateCsrfToken(): string
    {
        self::startSessionIfNeeded();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function verifyCsrfToken($token): bool
    {
        self::startSessionIfNeeded();

        if (empty($_SESSION['csrf_token']) || !is_string($token)) {
            return false;
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }
}
