<?php
class LogoutHandler {
    public function handle(): void
    {
        require_once __DIR__ . '/../../config/database.php';

        session_start();

        $db = getDbConnection();
        if ($db && !empty($_COOKIE['admin_remember'])) {
            $parts = explode(':', $_COOKIE['admin_remember'], 2);
            if (count($parts) === 2 && preg_match('/^[a-f0-9]{18}$/', $parts[0])) {
                $stmt = $db->prepare('DELETE FROM admin_remember_tokens WHERE selector = ?');
                $stmt->execute([$parts[0]]);
            }
        }

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

        $isProduction = defined('ENVIRONMENT') && ENVIRONMENT === 'production';
        setcookie('admin_remember', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => $isProduction,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        session_destroy();

        header('Location: ' . ADMIN_URL . '/login.php?error=signed_out');
        exit;
    }
}
?>