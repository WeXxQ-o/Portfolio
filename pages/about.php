<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'About';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="about-section py-5 mt-5 flex-grow-1">
    <div class="hero-bg-glow top-right"></div>
    <div class="hero-bg-glow bottom-left"></div>

    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="status-badge">
                <span class="status-dot"></span>
                Get to Know Me
            </span>
            <h1 class="display-4 fw-bold"><span class="text-primary">About</span> <span class="text-gradient">Me</span></h1>
        </div>

        <div class="row g-5 align-items-start">
            <div class="col-lg-4">
                <div class="about-card text-center reveal">
                    <div class="about-img-wrapper mx-auto mb-4">
                        <img src="../assets/img/logo/wexxq.png" class="about-profile-img" alt="Profile">
                        <div class="about-img-border"></div>
                    </div>
                    <h3 class="mb-1">WeXxQ</h3>
                    <p class="text-purple mb-3">Student Developer</p>
                    <p class="text-muted small mb-4">Passionate about coding, problem-solving, and building things that make a difference.</p>

                    <div class="quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-geo-alt text-purple"></i>
                            <span>Slovakia</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-mortarboard text-purple"></i>
                            <span>University Student</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-code-slash text-purple"></i>
                            <span>Aspiring Developer</span>
                        </div>
                    </div>

                    <div class="social-links mt-4">
                        <a href="<?php echo GITHUB_URL; ?>" target="_blank" class="social-btn">
                            <i class="bi bi-github"></i>
                        </a>
                        <a href="<?php echo LINKEDIN_URL; ?>" class="social-btn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="<?php echo DISCORD_URL; ?>" class="social-btn">
                            <i class="bi bi-discord"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="about-content-card mb-4 reveal">
                    <div class="d-flex align-items-center mb-3">
                        <div class="about-icon me-3">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h4 class="mb-0">Interests & <span class="text-purple">Hobbies</span></h4>
                    </div>
                    <p class="text-muted">When I'm not coding, you'll find me exploring <span class="text-purple">new technologies</span>, watching anime, playing video games, or diving deep into computer science concepts. I'm always <span class="text-purple">eager to learn</span> something new and push my boundaries.</p>
                    <div class="interest-tags">
                        <span class="interest-tag"><i class="bi bi-controller me-1"></i>Gaming</span>
                        <span class="interest-tag"><i class="bi bi-film me-1"></i>Anime</span>
                        <span class="interest-tag"><i class="bi bi-code-square me-1"></i>Coding</span>
                        <span class="interest-tag"><i class="bi bi-lightbulb me-1"></i>Learning</span>
                        <span class="interest-tag"><i class="bi bi-music-note-beamed me-1"></i>Music</span>
                    </div>
                </div>

                <div class="about-content-card mb-4 reveal">
                    <div class="d-flex align-items-center mb-3">
                        <div class="about-icon me-3">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h4 class="mb-0"><span class="text-purple">Education</span></h4>
                    </div>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                    <h5 class="mb-1">Bachelor of Applied Informatics</h5>
                                    <span class="timeline-badge">2025 - Present</span>
                                </div>
                                <p class="text-purple mb-1">Constantine the Philosopher University in Nitra</p>
                                <p class="text-muted small mb-0">Currently pursuing my degree in Applied Informatics, focusing on software development and computer science fundamentals.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                    <h5 class="mb-1">Computer Network Mechanic</h5>
                                    <span class="timeline-badge">2021 - 2025</span>
                                </div>
                                <p class="text-purple mb-1">Secondary Technical School of Wood-working</p>
                                <p class="text-muted small mb-0">Completed technical education with focus on computer networks and hardware.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-content-card mb-4 reveal">
                    <div class="d-flex align-items-center mb-3">
                        <div class="about-icon me-3">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h4 class="mb-0">Work <span class="text-purple">Experience</span></h4>
                    </div>
                    <div class="glass-panel text-center py-4">
                        <i class="bi bi-rocket-takeoff text-purple" style="font-size: 2.5rem;"></i>
                        <p class="text-muted mt-3 mb-0">Currently focused on learning and building my skills.<br>Open to internships and junior positions!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
