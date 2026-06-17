<?php
/**
 * Admin Projects Management
 * Full CRUD for projects entity
 */

require_once '../config/config.php';
require_once __DIR__ . '/includes/AuthCheck.php';

AuthCheck::requireAuth();
$current_admin = AuthCheck::getCurrentAdmin();
$pageTitle = 'Projects';

class AdminProjectsPage
{
    private const ALLOWED_FILTER_STATUSES = ['all', 'active', 'inactive', 'draft'];
    private const ALLOWED_PROJECT_STATUSES = ['active', 'inactive', 'draft'];
    private const PER_PAGE = 10;

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function run(): array
    {
        $status_filter = $this->resolveStatusFilter();
        $page = $this->resolvePage();
        $errors = [];
        $form_data = $this->defaultFormData();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_result = $this->handlePost($status_filter, $page);
            $errors = $post_result['errors'];
            $form_data = $post_result['form_data'];
        }

        $edit_project = $this->loadEditProject($errors, $form_data);
        $projects_data = $this->loadProjects($status_filter, $page);

        return [
            'status_filter' => $status_filter,
            'page' => $projects_data['page'],
            'projects' => $projects_data['projects'],
            'total_projects' => $projects_data['total_projects'],
            'total_pages' => $projects_data['total_pages'],
            'edit_project' => $edit_project,
            'errors' => $errors,
            'form_data' => $form_data,
            'csrf_token' => AuthCheck::generateCsrfToken(),
        ];
    }

    private function resolveStatusFilter(): string
    {
        $status_filter = $_GET['status'] ?? 'all';

        if (!in_array($status_filter, self::ALLOWED_FILTER_STATUSES, true)) {
            return 'all';
        }

        return $status_filter;
    }

    private function resolvePage(): int
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        return max(1, $page);
    }

    private function defaultFormData(): array
    {
        return [
            'title' => '',
            'short_description' => '',
            'description' => '',
            'image_url' => '',
            'demo_url' => '',
            'github_url' => '',
            'technologies' => '',
            'category' => '',
            'status' => 'active',
            'featured' => 0,
            'order_position' => 0,
        ];
    }

    private function handlePost(string $status_filter, int $page): array
    {
        $errors = [];
        $form_data = $this->defaultFormData();
        $action = $_POST['action'] ?? '';
        $token = $_POST['csrf_token'] ?? '';
        $redirect_status = urlencode($status_filter);
        $redirect_page = max(1, $page);

        if (!AuthCheck::verifyCsrfToken($token)) {
            header('Location: ' . ADMIN_URL . '/projects.php?status=' . $redirect_status . '&page=' . $redirect_page . '&error=csrf');
            exit;
        }

        if ($action === 'delete') {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            if ($id > 0) {
                $deleteStmt = $this->db->prepare('DELETE FROM projects WHERE id = ?');
                $deleteStmt->execute([$id]);
            }

            header('Location: ' . ADMIN_URL . '/projects.php?status=' . $redirect_status . '&page=' . $redirect_page . '&success=deleted');
            exit;
        }

        if ($action === 'save') {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $form_data = [
                'title' => trim($_POST['title'] ?? ''),
                'short_description' => trim($_POST['short_description'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'image_url' => trim($_POST['image_url'] ?? ''),
                'demo_url' => trim($_POST['demo_url'] ?? ''),
                'github_url' => trim($_POST['github_url'] ?? ''),
                'technologies' => trim($_POST['technologies'] ?? ''),
                'category' => trim($_POST['category'] ?? ''),
                'status' => $_POST['status'] ?? 'active',
                'featured' => !empty($_POST['featured']) ? 1 : 0,
                'order_position' => isset($_POST['order_position']) ? (int)$_POST['order_position'] : 0,
            ];

            $errors = $this->validateProjectData($form_data);

            if (empty($errors)) {
                $this->saveProject($id, $form_data);
                $success = $id > 0 ? 'updated' : 'created';
                header('Location: ' . ADMIN_URL . '/projects.php?status=' . $redirect_status . '&page=' . $redirect_page . '&success=' . $success);
                exit;
            }
        }

        return [
            'errors' => $errors,
            'form_data' => $form_data,
        ];
    }

    private function validateProjectData(array $form_data): array
    {
        $errors = [];

        if (mb_strlen($form_data['title']) < 3 || mb_strlen($form_data['title']) > 200) {
            $errors[] = 'Title must contain 3-200 characters.';
        }

        if ($form_data['short_description'] !== '' && mb_strlen($form_data['short_description']) > 255) {
            $errors[] = 'Short description can have max 255 characters.';
        }

        if (!in_array($form_data['status'], self::ALLOWED_PROJECT_STATUSES, true)) {
            $errors[] = 'Invalid status selected.';
        }

        $url_fields = ['image_url', 'demo_url', 'github_url'];
        foreach ($url_fields as $field) {
            if ($form_data[$field] !== '' && !filter_var($form_data[$field], FILTER_VALIDATE_URL)) {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is not a valid URL.';
            }
        }

        return $errors;
    }

    private function saveProject(int $id, array $form_data): void
    {
        $params = [
            $form_data['title'],
            $form_data['short_description'] !== '' ? $form_data['short_description'] : null,
            $form_data['description'] !== '' ? $form_data['description'] : null,
            $form_data['image_url'] !== '' ? $form_data['image_url'] : null,
            $form_data['demo_url'] !== '' ? $form_data['demo_url'] : null,
            $form_data['github_url'] !== '' ? $form_data['github_url'] : null,
            $form_data['technologies'] !== '' ? $form_data['technologies'] : null,
            $form_data['category'] !== '' ? $form_data['category'] : null,
            $form_data['status'],
            $form_data['featured'],
            $form_data['order_position'],
        ];

        if ($id > 0) {
            $updateStmt = $this->db->prepare('UPDATE projects SET title = ?, short_description = ?, description = ?, image_url = ?, demo_url = ?, github_url = ?, technologies = ?, category = ?, status = ?, featured = ?, order_position = ? WHERE id = ?');
            $params[] = $id;
            $updateStmt->execute($params);
            return;
        }

        $insertStmt = $this->db->prepare('INSERT INTO projects (title, short_description, description, image_url, demo_url, github_url, technologies, category, status, featured, order_position) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $insertStmt->execute($params);
    }

    private function loadEditProject(array $errors, array &$form_data): ?array
    {
        if (!isset($_GET['edit']) || !ctype_digit((string)$_GET['edit'])) {
            return null;
        }

        $edit_id = (int)$_GET['edit'];
        $editStmt = $this->db->prepare('SELECT * FROM projects WHERE id = ? LIMIT 1');
        $editStmt->execute([$edit_id]);
        $edit_project = $editStmt->fetch() ?: null;

        if ($edit_project && empty($errors)) {
            $form_data = [
                'title' => (string)($edit_project['title'] ?? ''),
                'short_description' => (string)($edit_project['short_description'] ?? ''),
                'description' => (string)($edit_project['description'] ?? ''),
                'image_url' => (string)($edit_project['image_url'] ?? ''),
                'demo_url' => (string)($edit_project['demo_url'] ?? ''),
                'github_url' => (string)($edit_project['github_url'] ?? ''),
                'technologies' => (string)($edit_project['technologies'] ?? ''),
                'category' => (string)($edit_project['category'] ?? ''),
                'status' => (string)($edit_project['status'] ?? 'active'),
                'featured' => !empty($edit_project['featured']) ? 1 : 0,
                'order_position' => (int)($edit_project['order_position'] ?? 0),
            ];
        }

        return $edit_project;
    }

    private function loadProjects(string $status_filter, int $page): array
    {
        if ($status_filter === 'all') {
            $countStmt = $this->db->query('SELECT COUNT(*) FROM projects');
            $total_projects = (int)$countStmt->fetchColumn();
            $total_pages = (int)max(1, ceil($total_projects / self::PER_PAGE));
            if ($page > $total_pages) {
                $page = $total_pages;
            }
            $offset = ($page - 1) * self::PER_PAGE;

            $listStmt = $this->db->prepare('SELECT id, title, category, technologies, status, featured, order_position, created_at, updated_at FROM projects ORDER BY order_position, created_at DESC LIMIT ? OFFSET ?');
            $listStmt->bindValue(1, self::PER_PAGE, PDO::PARAM_INT);
            $listStmt->bindValue(2, $offset, PDO::PARAM_INT);
            $listStmt->execute();

            return [
                'projects' => $listStmt->fetchAll(),
                'total_projects' => $total_projects,
                'total_pages' => $total_pages,
                'page' => $page,
            ];
        }

        $countStmt = $this->db->prepare('SELECT COUNT(*) FROM projects WHERE status = ?');
        $countStmt->execute([$status_filter]);
        $total_projects = (int)$countStmt->fetchColumn();
        $total_pages = (int)max(1, ceil($total_projects / self::PER_PAGE));
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * self::PER_PAGE;

        $listStmt = $this->db->prepare('SELECT id, title, category, technologies, status, featured, order_position, created_at, updated_at FROM projects WHERE status = ? ORDER BY order_position, created_at DESC LIMIT ? OFFSET ?');
        $listStmt->bindValue(1, $status_filter, PDO::PARAM_STR);
        $listStmt->bindValue(2, self::PER_PAGE, PDO::PARAM_INT);
        $listStmt->bindValue(3, $offset, PDO::PARAM_INT);
        $listStmt->execute();

        return [
            'projects' => $listStmt->fetchAll(),
            'total_projects' => $total_projects,
            'total_pages' => $total_pages,
            'page' => $page,
        ];
    }
}

$status_filter = 'all';
$page = 1;
$projects = [];
$total_projects = 0;
$total_pages = 1;
$edit_project = null;
$errors = [];
$form_data = [
    'title' => '',
    'short_description' => '',
    'description' => '',
    'image_url' => '',
    'demo_url' => '',
    'github_url' => '',
    'technologies' => '',
    'category' => '',
    'status' => 'active',
    'featured' => 0,
    'order_position' => 0,
];
$csrf_token = AuthCheck::generateCsrfToken();

try {
    $controller = new AdminProjectsPage(getDbConnection());
    $result = $controller->run();
    $status_filter = $result['status_filter'];
    $page = $result['page'];
    $projects = $result['projects'];
    $total_projects = $result['total_projects'];
    $total_pages = $result['total_pages'];
    $edit_project = $result['edit_project'];
    $errors = $result['errors'];
    $form_data = $result['form_data'];
    $csrf_token = $result['csrf_token'];
} catch (Throwable $e) {
    $projects = [];
    $total_projects = 0;
    $total_pages = 1;
    $edit_project = null;
    if (empty($errors)) {
        $errors[] = 'Database error. Please try again.';
    }
}

include 'includes/admin-header.php';
include 'includes/admin-sidebar.php';
?>

<div class="admin-content">
    <header class="admin-header">
        <div class="admin-header-content">
            <div class="admin-header-left">
                <h1>Projects</h1>
                <p>Manage portfolio projects (CRUD)</p>
            </div>
            <div class="admin-header-right">
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="admin-main">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success mb-3" role="alert">
                <?php
                $success = $_GET['success'];
                if ($success === 'created') {
                    echo 'Project created successfully.';
                } elseif ($success === 'updated') {
                    echo 'Project updated successfully.';
                } elseif ($success === 'deleted') {
                    echo 'Project deleted successfully.';
                } else {
                    echo 'Action completed.';
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'csrf'): ?>
            <div class="alert alert-danger mb-3" role="alert">Invalid CSRF token. Please try again.</div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger mb-3" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <div class="d-flex gap-2 flex-wrap">
                <a href="?status=all" class="btn <?php echo $status_filter === 'all' ? 'btn-purple' : 'btn-outline-purple'; ?>">All</a>
                <a href="?status=active" class="btn <?php echo $status_filter === 'active' ? 'btn-purple' : 'btn-outline-purple'; ?>">Active</a>
                <a href="?status=inactive" class="btn <?php echo $status_filter === 'inactive' ? 'btn-purple' : 'btn-outline-purple'; ?>">Inactive</a>
                <a href="?status=draft" class="btn <?php echo $status_filter === 'draft' ? 'btn-purple' : 'btn-outline-purple'; ?>">Draft</a>
            </div>
        </div>

        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body">
                <h3 class="h5 mb-3"><?php echo $edit_project ? 'Edit Project #' . (int)$edit_project['id'] : 'Create New Project'; ?></h3>
                <form method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="id" value="<?php echo $edit_project ? (int)$edit_project['id'] : 0; ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="project-title">Title *</label>
                            <input id="project-title" type="text" name="title" class="form-control" maxlength="200" required value="<?php echo htmlspecialchars($form_data['title']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="project-category">Category</label>
                            <input id="project-category" type="text" name="category" class="form-control" maxlength="50" value="<?php echo htmlspecialchars($form_data['category']); ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="project-short-description">Short Description</label>
                            <input id="project-short-description" type="text" name="short_description" class="form-control" maxlength="255" value="<?php echo htmlspecialchars($form_data['short_description']); ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="project-description">Description</label>
                            <textarea id="project-description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($form_data['description']); ?></textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="project-image-url">Image URL</label>
                            <input id="project-image-url" type="url" name="image_url" class="form-control" value="<?php echo htmlspecialchars($form_data['image_url']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="project-demo-url">Demo URL</label>
                            <input id="project-demo-url" type="url" name="demo_url" class="form-control" value="<?php echo htmlspecialchars($form_data['demo_url']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="project-github-url">GitHub URL</label>
                            <input id="project-github-url" type="url" name="github_url" class="form-control" value="<?php echo htmlspecialchars($form_data['github_url']); ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="project-technologies">Technologies (comma separated)</label>
                            <input id="project-technologies" type="text" name="technologies" class="form-control" maxlength="500" value="<?php echo htmlspecialchars($form_data['technologies']); ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="project-order-position">Order</label>
                            <input id="project-order-position" type="number" name="order_position" class="form-control" value="<?php echo (int)$form_data['order_position']; ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="project-status">Status</label>
                            <select id="project-status" name="status" class="form-select">
                                <option value="active" <?php echo $form_data['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $form_data['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="draft" <?php echo $form_data['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" <?php echo !empty($form_data['featured']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>
                        </div>

                        <div class="col-12 d-flex gap-2">
                            <button type="submit" class="btn btn-purple"><?php echo $edit_project ? 'Update Project' : 'Create Project'; ?></button>
                            <?php if ($edit_project): ?>
                                <a href="projects.php" class="btn btn-outline-light">Cancel edit</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h3 class="data-table-title">
                    <i class="bi bi-folder2-open me-2"></i>
                    <?php echo ucfirst($status_filter); ?> Projects
                    <span class="text-muted small">(<?php echo number_format($total_projects); ?>)</span>
                </h3>
            </div>

            <?php if (empty($projects)): ?>
                <div class="empty-state">
                    <i class="bi bi-folder-x"></i>
                    <h3>No Projects Found</h3>
                    <p>No projects match this filter.</p>
                </div>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Technologies</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Order</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project): ?>
                            <tr>
                                <td>#<?php echo (int)$project['id']; ?></td>
                                <td><?php echo htmlspecialchars($project['title']); ?></td>
                                <td><?php echo htmlspecialchars((string)($project['category'] ?? '-')); ?></td>
                                <td>
                                    <?php
                                    $tech = (string)($project['technologies'] ?? '');
                                    $preview = htmlspecialchars(substr($tech, 0, 45));
                                    echo $tech === '' ? '-' : (strlen($tech) > 45 ? $preview . '...' : $preview);
                                    ?>
                                </td>
                                <td>
                                    <span class="status-badge-table status-<?php echo htmlspecialchars($project['status']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($project['status'])); ?>
                                    </span>
                                </td>
                                <td><?php echo !empty($project['featured']) ? 'Yes' : 'No'; ?></td>
                                <td><?php echo (int)$project['order_position']; ?></td>
                                <td><?php echo date('M d, Y H:i', strtotime($project['updated_at'])); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="?status=<?php echo urlencode($status_filter); ?>&page=<?php echo (int)$page; ?>&edit=<?php echo (int)$project['id']; ?>" class="btn-icon" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="post" style="display:inline;" onsubmit="return confirmDelete('Are you sure you want to delete this project?')">
                                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo (int)$project['id']; ?>">
                                            <button type="submit" class="btn-icon btn-danger" title="Delete" style="border:0;background:none;padding:0;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if ($total_pages > 1): ?>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?status=<?php echo urlencode($status_filter); ?>&page=<?php echo $page - 1; ?>"><i class="bi bi-chevron-left"></i></a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <?php if ($i === $page): ?>
                                <span class="active"><?php echo $i; ?></span>
                            <?php else: ?>
                                <a href="?status=<?php echo urlencode($status_filter); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="?status=<?php echo urlencode($status_filter); ?>&page=<?php echo $page + 1; ?>"><i class="bi bi-chevron-right"></i></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php include 'includes/admin-footer.php'; ?>
