<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Home';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="hero-section flex-grow-1 text-center">
    <div class="hero-bg-glow top-right"></div>
    <div class="hero-bg-glow bottom-left"></div>
    <div class="hero-bg-glow center-glow"></div>

    <div class="container position-relative z-1">
        <div class="status-badge reveal">
            <span class="status-dot"></span>
            Open to Opportunities
        </div>

        <h1 class="display-2 fw-bold mb-4 reveal">
            I Build <span class="text-purple">Modern</span><br>
            <span class="text-primary">Web Applications</span>
        </h1>

        <p class="lead mb-5 text-muted mx-auto hero-description reveal">
            <span class="text-purple">Student Developer</span> passionate about crafting clean, responsive, and user-friendly digital experiences using <span class="text-purple">modern technologies</span>.
        </p>

        <div class="d-flex justify-content-center gap-3 reveal">
            <a href="pages/projects.php" class="btn btn-purple btn-lg">
                <i class="bi bi-folder me-2"></i>View Projects
            </a>
            <a href="pages/contact.php" class="btn btn-outline-purple btn-lg">
                <i class="bi bi-envelope me-2"></i>Contact Me
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
