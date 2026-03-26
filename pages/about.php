<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'About';
include '../includes/header.php';
include '../includes/navbar.php';
?>

    <!-- hlavná about sekcia -->
    <section class="about-section py-5 mt-5 flex-grow-1">
        <!-- fialové glowy na pozadí pre efekt -->
        <div class="hero-bg-glow top-right"></div>
        <div class="hero-bg-glow bottom-left"></div>
        <div class="container">
           <!-- status badge s animovanou bodkou -->
            <div class="text-center mb-5">
                <span class="status-badge">
                    <span class="status-dot"></span>
                    Get to Know Me
                </span>
                <h1 class="display-4 fw-bold">About <span class="text-gradient">Me</span></h1>
            </div>

            <!-- profilová karta vľavo -->
            <div class="row g-5 align-items-start">
                <div class="col-lg-4">
                    <div class="about-card text-center">
                        <!-- profilový obrázok s animovaným borderom -->
                        <div class="about-img-wrapper mx-auto mb-4">
                            <img src="../assets/img/logo/wexxq.png" class="about-profile-img" alt="Profile">
                            <div class="about-img-border"></div>
                        </div>
                        <h3 class="mb-1">WeXxQ</h3>
                        <p class="text-purple mb-3">Student Developer</p>
                        <p class="text-muted small mb-4">Passionate about coding, problem-solving, and building things that make a difference.</p>
                        
                        <!-- rýchle informácie -->
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

                        <!-- sociálne siete -->
                        <div class="social-links mt-4">
                            <a href="https://github.com/WeXxQ-o" target="_blank" class="social-btn">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="bi bi-discord"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- pravá strana s obsahom -->
                <div class="col-lg-8">
                    <!-- sekcia záujmov a hobby -->
                    <div class="about-content-card mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="about-icon me-3">
                                <i class="bi bi-heart"></i>
                            </div>
                            <h4 class="mb-0">Interests & Hobbies</h4>
                        </div>
                        <p class="text-muted">When I'm not coding, you'll find me exploring new technologies, watching anime, playing video games, or diving deep into computer science concepts. I'm always eager to learn something new and push my boundaries.</p>
                        <div class="interest-tags">
                            <span class="interest-tag"><i class="bi bi-controller me-1"></i>Gaming</span>
                            <span class="interest-tag"><i class="bi bi-film me-1"></i>Anime</span>
                            <span class="interest-tag"><i class="bi bi-code-square me-1"></i>Coding</span>
                            <span class="interest-tag"><i class="bi bi-lightbulb me-1"></i>Learning</span>
                            <span class="interest-tag"><i class="bi bi-music-note-beamed me-1"></i>Music</span>
                        </div>
                    </div>

                    <!-- sekcia vzdelania -->
                    <div class="about-content-card mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="about-icon me-3">
                                <i class="bi bi-mortarboard"></i>
                            </div>
                            <h4 class="mb-0">Education</h4>
                        </div>
                        
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
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
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <h5 class="mb-1">Computer Network Mechanic</h5>
                                        <span class="timeline-badge">2021 - 2025</span>
                                    </div>
                                    <p class="text-purple mb-1">Secondary Technical School of Wood-working</p>
                                    <p class="text-muted small mb-0">Completed technical education with focus on computer networks and hardware.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- sekcia pracovných skúseností -->
                    <div class="about-content-card mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="about-icon me-3">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <h4 class="mb-0">Work Experience</h4>
                        </div>
                        <div class="glass-panel text-center py-4">
                            <i class="bi bi-rocket-takeoff text-purple" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-3 mb-0">Currently focused on learning and building my skills.<br>Open to internships and junior positions!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include '../includes/footer.php'; ?>