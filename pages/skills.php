<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'Skills';
include '../includes/header.php';
include '../includes/navbar.php';
?>

    <!-- hlavná sekcia zručností -->
    <section class="skills-section">
        <!-- fialové glowy na pozadí pre efekt -->
        <div class="hero-bg-glow top-right"></div>
        <div class="hero-bg-glow bottom-left"></div>

        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="status-badge">
                    <span class="status-dot"></span>
                    Always Learning
                </span>
                <h1 class="display-4 fw-bold">My <span class="text-gradient">Skills</span></h1>
                <p class="text-muted mt-3 col-lg-6 mx-auto">A showcase of my technical abilities and the technologies I work with to bring ideas to life.</p>
            </div>

            <!-- sekcia programovacích jazykov -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="skill-category-icon me-3">
                        <i class="bi bi-code-square"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">Programming Languages</h3>
                        <small class="text-muted">Languages I code in</small>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="skill-card">
                            <div class="skill-card-header">
                                <div class="skill-icon python">
                                    <i class="devicon-python-plain"></i>
                                </div>
                                <div class="skill-info">
                                    <h5 class="mb-0">Python</h5>
                                    <small class="text-muted">Backend & Automation</small>
                                </div>
                                <span class="skill-percentage">43%</span>
                            </div>
                            <div class="progress skill-progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 43%"></div>
                            </div>
                            <div class="skill-tags">
                                <span class="skill-tag">Scripts</span>
                                <span class="skill-tag">Data</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="skill-card">
                            <div class="skill-card-header">
                                <div class="skill-icon javascript">
                                    <i class="devicon-javascript-plain"></i>
                                </div>
                                <div class="skill-info">
                                    <h5 class="mb-0">JavaScript</h5>
                                    <small class="text-muted">Frontend & Backend</small>
                                </div>
                                <span class="skill-percentage">3%</span>
                            </div>
                            <div class="progress skill-progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 3%"></div>
                            </div>
                            <div class="skill-tags">
                                <span class="skill-tag">Learning</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="skill-card">
                            <div class="skill-card-header">
                                <div class="skill-icon c-lang">
                                    <i class="devicon-c-plain"></i>
                                </div>
                                <div class="skill-info">
                                    <h5 class="mb-0">C</h5>
                                    <small class="text-muted">System Programming</small>
                                </div>
                                <span class="skill-percentage">1%</span>
                            </div>
                            <div class="progress skill-progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 1%"></div>
                            </div>
                            <div class="skill-tags">
                                <span class="skill-tag">Basics</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- sekcia frontend technológií -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="skill-category-icon me-3">
                        <i class="bi bi-palette"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">Frontend Technologies</h3>
                        <small class="text-muted">Building user interfaces</small>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="skill-card">
                            <div class="skill-card-header">
                                <div class="skill-icon html">
                                    <i class="devicon-html5-plain"></i>
                                </div>
                                <div class="skill-info">
                                    <h5 class="mb-0">HTML5</h5>
                                    <small class="text-muted">Markup Language</small>
                                </div>
                                <span class="skill-percentage">35%</span>
                            </div>
                            <div class="progress skill-progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 35%"></div>
                            </div>
                            <div class="skill-tags">
                                <span class="skill-tag">Semantic</span>
                                <span class="skill-tag">Accessibility</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="skill-card">
                            <div class="skill-card-header">
                                <div class="skill-icon css">
                                    <i class="devicon-css3-plain"></i>
                                </div>
                                <div class="skill-info">
                                    <h5 class="mb-0">CSS3</h5>
                                    <small class="text-muted">Styling & Animations</small>
                                </div>
                                <span class="skill-percentage">29%</span>
                            </div>
                            <div class="progress skill-progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 29%"></div>
                            </div>
                            <div class="skill-tags">
                                <span class="skill-tag">Flexbox</span>
                                <span class="skill-tag">Grid</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="skill-card">
                            <div class="skill-card-header">
                                <div class="skill-icon bootstrap">
                                    <i class="devicon-bootstrap-plain"></i>
                                </div>
                                <div class="skill-info">
                                    <h5 class="mb-0">Bootstrap</h5>
                                    <small class="text-muted">CSS Framework</small>
                                </div>
                                <span class="skill-percentage">25%</span>
                            </div>
                            <div class="progress skill-progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 25%"></div>
                            </div>
                            <div class="skill-tags">
                                <span class="skill-tag">Responsive</span>
                                <span class="skill-tag">Components</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sekcia nástrojov a technológií -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="skill-category-icon me-3">
                        <i class="bi bi-tools"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">Tools & Technologies</h3>
                        <small class="text-muted">Software I use daily</small>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="tool-card">
                            <i class="devicon-git-plain"></i>
                            <span>Git</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="tool-card">
                            <i class="devicon-github-original"></i>
                            <span>GitHub</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="tool-card">
                            <i class="devicon-vscode-plain"></i>
                            <span>VS Code</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="tool-card">
                            <i class="bi bi-terminal"></i>
                            <span>Terminal</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="tool-card">
                            <i class="devicon-windows11-original"></i>
                            <span>Windows</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="tool-card">
                            <i class="devicon-linux-plain"></i>
                            <span>Linux</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sekcia - momentálne sa učím -->
            <div class="glass-panel text-center">
                <h4 class="mb-4"><i class="bi bi-rocket-takeoff me-2 text-purple"></i>Currently Learning</h4>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <div class="learning-badge">
                        <i class="devicon-react-original me-2"></i>React
                    </div>
                    <div class="learning-badge">
                        <i class="devicon-nodejs-plain me-2"></i>Node.js
                    </div>
                    <div class="learning-badge">
                        <i class="devicon-typescript-plain me-2"></i>TypeScript
                    </div>
                    <div class="learning-badge">
                        <i class="devicon-postgresql-plain me-2"></i>PostgreSQL
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include '../includes/footer.php'; ?>