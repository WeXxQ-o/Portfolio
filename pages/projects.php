<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'Projects';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="projects-section py-5 mt-5 flex-grow-1">
    <div class="hero-bg-glow top-right"></div>
    <div class="hero-bg-glow bottom-left"></div>

    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="status-badge">
                <span class="status-dot"></span>
                Work I've Done
            </span>
            <h1 class="display-4 fw-bold"><span class="text-primary">My</span> <span class="text-gradient">Projects</span></h1>
            <p class="text-muted mt-3 col-lg-6 mx-auto">Here are some of my <span class="text-purple">recent works</span>. More projects coming soon!</p>
        </div>

        <div class="row justify-content-center reveal">
            <div class="col-lg-10">
                <div class="project-card featured">
                    <div class="project-badge">
                        <i class="bi bi-star-fill"></i> Featured Project
                    </div>
                    <div class="project-preview">
                        <div class="project-preview-content">
                            <div class="browser-mockup">
                                <div class="browser-header">
                                    <div class="browser-dots">
                                        <span class="dot red"></span>
                                        <span class="dot yellow"></span>
                                        <span class="dot green"></span>
                                    </div>
                                    <div class="browser-url">wexxq.dev</div>
                                </div>
                                <div class="browser-content">
                                    <div class="mockup-nav"></div>
                                    <div class="mockup-hero">
                                        <div class="mockup-badge"></div>
                                        <div class="mockup-title"></div>
                                        <div class="mockup-text"></div>
                                        <div class="mockup-buttons">
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3 class="project-title">Personal Portfolio Website</h3>
                        <p class="project-description">
                            A <span class="text-purple">modern, responsive</span> portfolio website built from scratch to showcase my skills and projects.
                            Features a <span class="text-purple">dark theme</span> with neon accents, glassmorphism effects, smooth animations,
                            and a fully <span class="text-purple">responsive design</span> that works on all devices.
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge"><i class="bi bi-filetype-html"></i>HTML5</span>
                            <span class="tech-badge"><i class="bi bi-filetype-css"></i>CSS3</span>
                            <span class="tech-badge"><i class="bi bi-filetype-js"></i>JavaScript</span>
                            <span class="tech-badge"><i class="bi bi-filetype-php"></i>PHP</span>
                        </div>
                        <div class="project-features">
                            <div class="feature-item">
                                <i class="bi bi-phone"></i>
                                <span>Responsive</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-moon-stars"></i>
                                <span>Dark Theme</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-lightning"></i>
                                <span>Fast</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-brush"></i>
                                <span>Modern UI</span>
                            </div>
                        </div>
                        <div class="project-links">
                            <a href="<?php echo GITHUB_URL; ?>/Portfolio" target="_blank" class="btn btn-purple">
                                <i class="bi bi-github"></i>View Code
                            </a>
                            <a href="../index.php" class="btn btn-outline-purple">
                                <i class="bi bi-eye"></i>Live Demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-lg-6 reveal">
                <div class="project-card-small">
                    <div class="project-card-header">
                        <div class="project-icon">
                            <i class="bi bi-folder-fill"></i>
                        </div>
                        <div class="project-card-links">
                            <a href="#" target="_blank" title="View Code">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="#" target="_blank" title="Live Demo">
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <h4 class="project-card-title">Coming Soon</h4>
                    <p class="project-card-desc">
                        New project in development. Stay tuned for updates!
                    </p>
                    <div class="project-card-tech">
                        <span>TBD</span>
                        <span>TBD</span>
                        <span>TBD</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal">
                <div class="project-card-small">
                    <div class="project-card-header">
                        <div class="project-icon">
                            <i class="bi bi-terminal-fill"></i>
                        </div>
                        <div class="project-card-links">
                            <a href="#" target="_blank" title="View Code">
                                <i class="bi bi-github"></i>
                            </a>
                        </div>
                    </div>
                    <h4 class="project-card-title">Coming Soon</h4>
                    <p class="project-card-desc">
                        Another exciting project in the works. Check back later!
                    </p>
                    <div class="project-card-tech">
                        <span>TBD</span>
                        <span>TBD</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 reveal">
                <div class="coming-soon-section text-center">
                    <div class="glass-panel">
                        <i class="bi bi-rocket-takeoff icon-coming-soon"></i>
                        <h4 class="mt-4 mb-3">More Projects <span class="text-purple">Coming Soon</span></h4>
                        <p class="text-muted col-lg-6 mx-auto">
                            I'm constantly working on new projects to expand my skills.
                            Check back soon or follow me on GitHub to stay updated!
                        </p>
                        <a href="<?php echo GITHUB_URL; ?>" target="_blank" class="btn btn-outline-purple mt-3">
                            <i class="bi bi-github"></i>Follow on GitHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
