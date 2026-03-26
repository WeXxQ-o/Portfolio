<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Home';
include 'includes/header.php';
include 'includes/navbar.php';
?>

    <!-- Banner s textom -->
    <!-- hlavná hero sekcia s úvodným textom -->
    <section class="hero-section flex-grow-1 text-center">
        <!-- fialové glowy na pozadí pre efekt -->
        <div class="hero-bg-glow top-right"></div>
        <div class="hero-bg-glow bottom-left"></div>
        
        <div class="container position-relative z-1">
            <!-- status badge s animovanou bodkou -->
            <div class="status-badge">
                <span class="status-dot"></span>
                Open to Opportunities
            </div>
            
            <!-- hlavný nadpis s gradientom -->
            <h1 class="display-2 fw-bold mb-4">
                Building Digital <br>
                <span class="text-gradient">Experiences</span>
            </h1>
            <p class="lead mb-5 text-muted mx-auto hero-description">
                I'm a Student Developer passionate about creating modern web applications with HTML, CSS, JavaScript, Python, and C.
            </p>
            <!-- tlačidlá pre akcie -->
            <div class="d-flex justify-content-center gap-3">
                <a href="pages/projects.php" class="btn btn-purple btn-lg px-5">View Work</a>
                <a href="pages/contact.php" class="btn btn-outline-purple btn-lg px-5">Contact Me</a>
            </div>
            
        </div>
    </section>

<?php include 'includes/footer.php'; ?>