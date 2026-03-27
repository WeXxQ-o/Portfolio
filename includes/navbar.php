<?php
if (!function_exists('isActive')) {
    require_once __DIR__ . '/functions.php';
}
?>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>/index.php">
            <img src="<?php echo IMG_PATH; ?>/logo/wexxqtransparent.png" alt="WeXxQ Logo" class="navbar-logo">
            WeXxQ<span class="text-purple">.</span>
        </a>

        <button class="navbar-toggler" type="button" id="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('index.php'); ?>" href="<?php echo BASE_URL; ?>/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('about.php'); ?>" href="<?php echo BASE_URL; ?>/pages/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('skills.php'); ?>" href="<?php echo BASE_URL; ?>/pages/skills.php">Skills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('projects.php'); ?>" href="<?php echo BASE_URL; ?>/pages/projects.php">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('faq.php'); ?>" href="<?php echo BASE_URL; ?>/pages/faq.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('contact.php'); ?>" href="<?php echo BASE_URL; ?>/pages/contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
