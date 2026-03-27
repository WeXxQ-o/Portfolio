<?php ?>
<footer class="footer-section py-5 mt-auto">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h4 class="mb-3">WeXxQ<span class="text-purple">.</span></h4>
                <p class="text-muted small"><?php echo SITE_DESCRIPTION; ?></p>
                <div class="social-links mt-3">
                    <a href="<?php echo GITHUB_URL; ?>" target="_blank" aria-label="GitHub">
                        <i class="bi bi-github"></i>
                    </a>
                    <a href="<?php echo LINKEDIN_URL; ?>" target="_blank" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="<?php echo DISCORD_URL; ?>" target="_blank" aria-label="Discord">
                        <i class="bi bi-discord"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Navigation</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/about.php">About</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/skills.php">Skills</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/projects.php">Projects</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Other</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?php echo BASE_URL; ?>/pages/faq.php">FAQ</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6 class="footer-heading">Contact</h6>
                <ul class="list-unstyled footer-contact">
                    <li><i class="bi bi-envelope text-purple"></i><?php echo CONTACT_EMAIL; ?></li>
                    <li><i class="bi bi-geo-alt text-purple"></i><?php echo CONTACT_LOCATION; ?></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="m-0">&copy; <?php echo date('Y'); ?> WeXxQ. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="m-0">Made with <span class="text-purple">&hearts;</span> in Slovakia</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="<?php echo JS_PATH; ?>/main.js"></script>
<script src="<?php echo JS_PATH; ?>/navbar.js"></script>
<script src="<?php echo JS_PATH; ?>/form-validation.js"></script>
<script src="<?php echo JS_PATH; ?>/animations.js"></script>
<script src="<?php echo JS_PATH; ?>/effects.js"></script>
</body>
</html>
