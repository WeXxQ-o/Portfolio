<?php

class LoginHandler
{
    private PDO $db;

    private const REMEMBER_COOKIE = 'admin_remember';
    private const REMEMBER_DAYS = 30;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function handle(): void
    {
        // Keep the login flow in one place so it is easier to follow.
        $this->requirePost();
        $this->validateCsrf();

        $credentials = $this->validateInput();
        $rememberMe = !empty($_POST['remember']);
        $this->cleanupOldAttempts();

        // Use the client IP for rate limiting and tracking failed attempts.
        $ip = $this->getClientIp();

        if ($this->isRateLimited($ip, $credentials['username'])) {
            $this->redirectWithError('locked');
        }

        // Look up the admin account by username.
        $admin = $this->findAdminByUsername($credentials['username']);

        if (!$this->isValidAdmin($admin, $credentials['password'])) {
            $this->recordFailedAttempt($ip, $credentials['username']);
            $this->redirectWithError('invalid');
        }

        // Successful login, so clear older attempts for this IP + username.
        $this->clearAttemptsOnSuccess($ip, $credentials['username']);
        session_regenerate_id(true);

        // Store the admin session values after authentication passes.
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_logged_in'] = true;

        // Save the last login time for the admin record.
        $updateStmt = $this->db->prepare('UPDATE admins SET last_login = NOW() WHERE id = ?');
        $updateStmt->execute([$admin['id']]);

        if ($rememberMe) {
            $this->issueRememberToken((int) $admin['id']);
        } else {
            $this->clearRememberCookie();
        }

        header('Location: ' . ADMIN_URL . '/index.php');
        exit;
    }

    private function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/login.php');
            exit;
        }
    }

    private function validateCsrf(): void
    {
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
            $this->redirectWithError('csrf');
        }
    }

    private function validateInput(): array
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $this->redirectWithError('empty');
        }

        // Keep the input within the limits we expect for this form.
        if (strlen($username) < 3 || strlen($username) > 50) {
            $this->redirectWithError('invalid_format');
        }

        if (strlen($password) < 8 || strlen($password) > 255) {
            $this->redirectWithError('invalid_format');
        }

        return [
            'username' => $username,
            'password' => $password,
        ];
    }

    private function getClientIp(): string
    {
        // Default to a safe fallback if the request IP looks wrong.
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
    }

    private function isRateLimited(string $ip, string $username): bool
    {
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

        $statement = $this->db->prepare($sql);
        $statement->execute([$ipBin, $usernameNorm, $ipBin, $usernameNorm]);
        $result = $statement->fetch();

        // Stop repeated guessing from the same IP or for the same username.
        return ($result['ip_count'] >= 20) || ($result['user_count'] >= 10) || ($result['pair_count'] >= 5);
    }

    private function recordFailedAttempt(string $ip, string $username): void
    {
        $statement = $this->db->prepare('INSERT INTO login_attempts (ip_bin, username_norm) VALUES (?, ?)');
        $statement->execute([inet_pton($ip), mb_strtolower(trim($username))]);
    }

    private function clearAttemptsOnSuccess(string $ip, string $username): void
    {
        $statement = $this->db->prepare('
            DELETE FROM login_attempts
            WHERE ip_bin = ? AND username_norm = ? AND attempted_at > (NOW() - INTERVAL 24 HOUR)
        ');
        $statement->execute([inet_pton($ip), mb_strtolower(trim($username))]);
    }

    private function cleanupOldAttempts(): void
    {
        $statement = $this->db->prepare('DELETE FROM login_attempts WHERE attempted_at < (NOW() - INTERVAL 24 HOUR)');
        $statement->execute();
    }

    private function findAdminByUsername(string $username): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM admins WHERE username = ?');
        $statement->execute([$username]);
        $admin = $statement->fetch();

        return $admin ?: null;
    }

    private function isValidAdmin(?array $admin, string $password): bool
    {
        if (!$admin) {
            // Run a dummy verify call so missing users do not leak timing info.
            password_verify($password, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
            return false;
        }

        return password_verify($password, $admin['password']) && $admin['status'] === 'active';
    }

    private function issueRememberToken(int $adminId): void
    {
        $selector = bin2hex(random_bytes(9));     // 18 chars
        $validator = bin2hex(random_bytes(32));   // secret in cookie
        $tokenHash = hash('sha256', $validator);  // hash in DB
        $expiresAt = (new DateTimeImmutable('+' . self::REMEMBER_DAYS . ' days'))->format('Y-m-d H:i:s');

        $this->db->prepare('DELETE FROM admin_remember_tokens WHERE admin_id = ?')->execute([$adminId]);
        $this->db->prepare('DELETE FROM admin_remember_tokens WHERE expires_at <= NOW()')->execute();

        $insert = $this->db->prepare('
            INSERT INTO admin_remember_tokens (admin_id, selector, token_hash, expires_at)
            VALUES (?, ?, ?, ?)
        ');
        $insert->execute([$adminId, $selector, $tokenHash, $expiresAt]);

        $cookieValue = $selector . ':' . $validator;
        $this->setRememberCookie($cookieValue, time() + (self::REMEMBER_DAYS * 86400));
    }

    private function setRememberCookie(string $value, int $expires): void
    {
        $isProduction = defined('ENVIRONMENT') && ENVIRONMENT === 'production';

        setcookie(self::REMEMBER_COOKIE, $value, [
            'expires' => $expires,
            'path' => '/',
            'secure' => $isProduction,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    private function clearRememberCookie(): void
    {
        $isProduction = defined('ENVIRONMENT') && ENVIRONMENT === 'production';

        setcookie(self::REMEMBER_COOKIE, '', [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => $isProduction,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    private function redirectWithError(string $error): void
    {
        // Send the user back to the login page with a simple error code.
        header('Location: ' . BASE_URL . '/admin/login.php?error=' . $error);
        exit;
    }
}