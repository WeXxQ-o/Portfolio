<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$projects = [];
$featuredProject = null;
$otherProjects = [];

try {
    $db = getDbConnection();
    $stmt = $db->query("SELECT id, title, short_description, description, image_url, demo_url, github_url, technologies, category, featured FROM projects WHERE status = 'active' ORDER BY featured DESC, order_position, created_at DESC");
    $projects = $stmt->fetchAll() ?: [];

    foreach ($projects as $project) {
        if ($featuredProject === null && (int)($project['featured'] ?? 0) === 1) {
            $featuredProject = $project;
            continue;
        }

        $otherProjects[] = $project;
    }

    if ($featuredProject === null && !empty($otherProjects)) {
        $featuredProject = array_shift($otherProjects);
    }
} catch (Throwable $e) {
    $projects = [];
    $featuredProject = null;
    $otherProjects = [];
}

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

        <?php if ($featuredProject): ?>
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
                                        <div class="browser-url"><?php echo htmlspecialchars((string)($featuredProject['demo_url'] ?: 'project-preview.local'), ENT_QUOTES, 'UTF-8'); ?></div>
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
                            <h3 class="project-title"><?php echo htmlspecialchars((string)$featuredProject['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="project-description">
                                <?php echo nl2br(htmlspecialchars((string)($featuredProject['description'] ?: $featuredProject['short_description'] ?: 'Project description will be added soon.'), ENT_QUOTES, 'UTF-8')); ?>
                            </p>
                            <div class="project-tech">
                                <?php
                                $featuredTech = array_filter(array_map('trim', explode(',', (string)($featuredProject['technologies'] ?? ''))));
                                if (empty($featuredTech)) {
                                    $featuredTech = ['PHP', 'MySQL'];
                                }
                                foreach ($featuredTech as $tech):
                                    ?>
                                    <span class="tech-badge"><?php echo htmlspecialchars($tech, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="project-links">
                                <?php if (!empty($featuredProject['github_url'])): ?>
                                    <a href="<?php echo htmlspecialchars((string)$featuredProject['github_url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" class="btn btn-purple">
                                        <i class="bi bi-github"></i>View Code
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($featuredProject['demo_url'])): ?>
                                    <a href="<?php echo htmlspecialchars((string)$featuredProject['demo_url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" class="btn btn-outline-purple">
                                        <i class="bi bi-eye"></i>Live Demo
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row g-4 mt-4">
            <?php foreach ($otherProjects as $project): ?>
                <div class="col-lg-6 reveal">
                    <div class="project-card-small">
                        <div class="project-card-header">
                            <div class="project-icon">
                                <i class="bi bi-folder-fill"></i>
                            </div>
                            <div class="project-card-links">
                                <?php if (!empty($project['github_url'])): ?>
                                    <a href="<?php echo htmlspecialchars((string)$project['github_url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" title="View Code">
                                        <i class="bi bi-github"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($project['demo_url'])): ?>
                                    <a href="<?php echo htmlspecialchars((string)$project['demo_url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" title="Live Demo">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <h4 class="project-card-title"><?php echo htmlspecialchars((string)$project['title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p class="project-card-desc">
                            <?php echo htmlspecialchars((string)($project['short_description'] ?: 'Project details coming soon.'), ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <div class="project-card-tech">
                            <?php
                            $techList = array_filter(array_map('trim', explode(',', (string)($project['technologies'] ?? ''))));
                            if (empty($techList)) {
                                $techList = ['TBD'];
                            }
                            foreach (array_slice($techList, 0, 3) as $tech):
                                ?>
                                <span><?php echo htmlspecialchars($tech, ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-5">
            <div class="col-12 reveal">
                <div class="coming-soon-section text-center">
                    <div class="glass-panel">
                        <i class="bi bi-rocket-takeoff icon-coming-soon"></i>
                        <h4 class="mt-4 mb-3">More Projects <span class="text-purple"><?php echo empty($projects) ? 'Coming Soon' : 'Added Regularly'; ?></span></h4>
                        <p class="text-muted col-lg-6 mx-auto">
                            <?php if (empty($projects)): ?>
                                No active projects are published yet. Add them in admin panel and they will appear here automatically.
                            <?php else: ?>
                                I'm constantly working on new projects to expand my skills.
                                Check back soon or follow me on GitHub to stay updated!
                            <?php endif; ?>
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
