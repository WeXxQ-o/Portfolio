<?php
/**
 * Admin Login Page
 */

require_once '../config/config.php';

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

// If already logged in, skip login page
if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && !empty($_SESSION['admin_id'])) {
    header('Location: ' . ADMIN_URL . '/index.php');
    exit;
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Initialize error and success messages
$error_message = '';
$success_message = '';

// Parse error from query parameter
$error = $_GET['error'] ?? '';
switch ($error) {
    case 'locked':
        $error_message = 'Account temporarily locked. Please try again later.';
        break;
    case 'invalid':
        $error_message = 'Invalid username or password.';
        break;
    case 'csrf':
        $error_message = 'Security token invalid. Please try again.';
        break;
    case 'empty':
        $error_message = 'Username and password are required.';
        break;
    case 'invalid_format':
        $error_message = 'Username or password format is invalid.';
        break;
    case 'db':
        $error_message = 'Database connection error. Please try again later.';
        break;
    default:
        $error_message = '';
}

$pageTitle = 'Admin Login';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo $pageTitle . ' | ' . SITE_NAME; ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/main.css">
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/assets/css/admin.css">
</head>
<body class="d-flex flex-column min-vh-100 admin-login-page">
<div class="noise-overlay"></div>

<section class="login-section flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="hero-bg-glow top-right"></div>
    <div class="hero-bg-glow bottom-left"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="login-card glass-panel text-center">
                    <!-- Logo/Brand -->
                    <div class="mb-4">
                        <h2 class="fw-bold mb-2">
                            <span class="text-purple">WeXxQ</span>
                            <span class="text-white">Admin</span>
                        </h2>
                        <p class="text-muted small">Sign in to access admin panel</p>
                    </div>

                    <!-- Error Message -->
                    <?php if ($error_message): ?>
                        <div class="alert alert-dismissible mb-4" role="alert" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444;">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Success Message -->
                    <!-- TODO: show "Signed out" if they just logged out -->
                    <?php if ($success_message): ?>
                        <div class="alert alert-dismissible mb-4" role="alert" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); color: #22c55e;">
                            <i class="bi bi-check-circle me-2"></i>
                            <?php echo htmlspecialchars($success_message); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <form action="<?php echo ADMIN_URL; ?>/handlers/login-handler.php" method="POST" class="text-start">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                        <div class="mb-4">
                            <label for="username" class="form-label">
                                <i class="bi bi-person me-2"></i>Username
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-glass"
                                id="username"
                                name="username"
                                placeholder="Enter username"
                                required
                                autofocus
                            >
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-2"></i>Password
                            </label>
                            <div class="position-relative">
                                <input
                                    type="password"
                                    class="form-control form-control-glass"
                                    id="password"
                                    name="password"
                                    placeholder="Enter password"
                                    required
                                >
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                >
                                <label class="form-check-label" for="remember">
                                    Remember me for 30 days
                                </label>
                                <!-- TODO: make "Remember me" actually work with cookies -->
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-purple btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="<?php echo BASE_URL; ?>/index.php" class="text-muted small">
                                <i class="bi bi-arrow-left me-1"></i>Back to Website
                            </a>
                        </div>
                    </form>

                    <!-- Login Info -->
                    <div class="text-center mt-4">
                        <p class="text-muted small mb-2">
                            <i class="bi bi-shield-check text-purple me-1"></i>
                            Secure login with encrypted connection
                        </p>
                        <p class="text-muted small">
                            Default credentials: <code class="text-purple">admin / admin123</code><br>
                            <span class="text-warning">⚠ Change password after first login!</span>
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo ADMIN_URL; ?>/assets/js/admin.js"></script>
<script src="<?php echo ADMIN_URL; ?>/assets/js/login.js"></script>

</body>
</html>
