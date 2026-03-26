<?php
/**
 * Footer sekcia
 */
?>
<!-- footer sekcia -->
<footer class="footer-section py-5 mt-auto">
    <div class="container">
        <div class="row g-4">
            <!-- logo a popis -->
            <div class="col-lg-4 col-md-6">
                <h4 class="mb-3">WeXxQ<span class="text-purple">.</span></h4>
                <p class="text-muted small"><?php echo SITE_DESCRIPTION; ?></p>
                <div class="social-links mt-3">
                    <a href="<?php echo GITHUB_URL; ?>" target="_blank"><i class="bi bi-github"></i></a>
                    <a href="<?php echo LINKEDIN_URL; ?>" class="ms-3"><i class="bi bi-linkedin"></i></a>
                    <a href="<?php echo DISCORD_URL; ?>" class="ms-3"><i class="bi bi-discord"></i></a>
                </div>
            </div>
            
            <!-- rýchle odkazy -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3">Navigation</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/about.php">About</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/skills.php">Skills</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/projects.php">Projects</a></li>
                </ul>
            </div>
            
            <!-- ostatné odkazy -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3">Other</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?php echo BASE_URL; ?>/pages/faq.php">FAQ</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/contact.php">Contact</a></li>
                </ul>
            </div>
            
            <!-- kontakt -->
            <div class="col-lg-4 col-md-6">
                <h6 class="text-white mb-3">Contact</h6>
                <ul class="list-unstyled footer-contact">
                    <li><i class="bi bi-envelope text-purple me-2"></i><?php echo CONTACT_EMAIL; ?></li>
                    <li><i class="bi bi-geo-alt text-purple me-2"></i><?php echo CONTACT_LOCATION; ?></li>
                </ul>
            </div>
        </div>
        
        <!-- autorské práva -->
        <hr class="my-4 border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="m-0 small text-muted">&copy; <?php echo date('Y'); ?> WeXxQ. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="m-0 small text-muted">Made with <span class="text-purple">&hearts;</span> in Slovakia</p>
            </div>
        </div>
    </div>
</footer>

<!-- skripty -->
<script src="<?php echo JS_PATH; ?>/main.js"></script>
<script src="<?php echo JS_PATH; ?>/navbar.js"></script>
<script src="<?php echo JS_PATH; ?>/form-validation.js"></script>
<script src="<?php echo JS_PATH; ?>/animations.js"></script>
</body>
</html>
