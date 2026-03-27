<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'Thank You';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="contact-section py-5 mt-5 flex-grow-1 d-flex align-items-center min-vh-100">
    <div class="hero-bg-glow top-right"></div>
    <div class="hero-bg-glow bottom-left"></div>
    <div class="hero-bg-glow center-glow"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="glass-panel py-5 reveal">
                    <div class="text-purple mb-4">
                        <i class="bi bi-check-circle icon-xl"></i>
                    </div>
                    <h1 class="display-5 fw-bold mb-3">Thank You!</h1>
                    <p class="text-muted lead mb-4">
                        Your message has been sent successfully. I will get back to you as soon as possible.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="../index.php" class="btn btn-outline-purple">
                            <i class="bi bi-house"></i>Home
                        </a>
                        <a href="projects.php" class="btn btn-purple">
                            <i class="bi bi-folder"></i>View Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
