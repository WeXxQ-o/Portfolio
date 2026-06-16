<?php
/**
 * Admin Messages Management
 * View and manage contact form submissions
 */

require_once '../config/config.php';
require_once __DIR__ . '/includes/AuthCheck.php';

AuthCheck::requireAuth();
$current_admin = AuthCheck::getCurrentAdmin();
$pageTitle = 'Messages';

$allowed_statuses = ['all', 'new', 'read', 'replied', 'archived'];
$status_filter = $_GET['status'] ?? 'all';
if (!in_array($status_filter, $allowed_statuses, true)) {
    $status_filter = 'all';
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

$per_page = 10;
$messages = [];
$total_messages = 0;
$total_pages = 1;
$view_message = null;
$csrf_token = AuthCheck::generateCsrfToken();

try {
    $db = getDbConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $token = $_POST['csrf_token'] ?? '';

        if ($id > 0 && AuthCheck::verifyCsrfToken($token)) {
            if ($action === 'mark_read') {
                $stmt = $db->prepare('UPDATE contact_messages SET status = "read", read_at = NOW() WHERE id = ?');
                $stmt->execute([$id]);
            } elseif ($action === 'delete') {
                $stmt = $db->prepare('DELETE FROM contact_messages WHERE id = ?');
                $stmt->execute([$id]);
            }
        }

        $redirect_status = urlencode($status_filter);
        $redirect_page = max(1, $page);
        header('Location: ' . ADMIN_URL . '/messages.php?status=' . $redirect_status . '&page=' . $redirect_page);
        exit;
    }

    if (isset($_GET['view']) && ctype_digit((string)$_GET['view'])) {
        $view_id = (int)$_GET['view'];
        $viewStmt = $db->prepare('SELECT id, name, email, subject, message, status, created_at FROM contact_messages WHERE id = ? LIMIT 1');
        $viewStmt->execute([$view_id]);
        $view_message = $viewStmt->fetch() ?: null;
    }

    if ($status_filter === 'all') {
        $countStmt = $db->query('SELECT COUNT(*) FROM contact_messages');
        $total_messages = (int)$countStmt->fetchColumn();
        $total_pages = (int)max(1, ceil($total_messages / $per_page));
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * $per_page;

        $listStmt = $db->prepare('SELECT id, name, email, subject, message, status, created_at FROM contact_messages ORDER BY created_at DESC LIMIT ? OFFSET ?');
        $listStmt->bindValue(1, $per_page, PDO::PARAM_INT);
        $listStmt->bindValue(2, $offset, PDO::PARAM_INT);
        $listStmt->execute();
        $messages = $listStmt->fetchAll();
    } else {
        $countStmt = $db->prepare('SELECT COUNT(*) FROM contact_messages WHERE status = ?');
        $countStmt->execute([$status_filter]);
        $total_messages = (int)$countStmt->fetchColumn();
        $total_pages = (int)max(1, ceil($total_messages / $per_page));
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * $per_page;

        $listStmt = $db->prepare('SELECT id, name, email, subject, message, status, created_at FROM contact_messages WHERE status = ? ORDER BY created_at DESC LIMIT ? OFFSET ?');
        $listStmt->bindValue(1, $status_filter, PDO::PARAM_STR);
        $listStmt->bindValue(2, $per_page, PDO::PARAM_INT);
        $listStmt->bindValue(3, $offset, PDO::PARAM_INT);
        $listStmt->execute();
        $messages = $listStmt->fetchAll();
    }
} catch (Throwable $e) {
    $messages = [];
    $total_messages = 0;
    $total_pages = 1;
    $view_message = null;
}

include 'includes/admin-header.php';
include 'includes/admin-sidebar.php';
?>

<!-- Main Content -->
<div class="admin-content">

    <!-- Header -->
    <header class="admin-header">
        <div class="admin-header-content">
            <div class="admin-header-left">
                <h1>Messages</h1>
                <p>Manage contact form submissions</p>
            </div>
            <div class="admin-header-right">
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="admin-main">

        <!-- Filter Tabs -->
        <div class="mb-4">
            <div class="d-flex gap-2 flex-wrap">
                <a href="?status=all" class="btn <?php echo $status_filter === 'all' ? 'btn-purple' : 'btn-outline-purple'; ?>">
                    All Messages
                </a>
                <a href="?status=new" class="btn <?php echo $status_filter === 'new' ? 'btn-purple' : 'btn-outline-purple'; ?>">
                    New
                </a>
                <a href="?status=read" class="btn <?php echo $status_filter === 'read' ? 'btn-purple' : 'btn-outline-purple'; ?>">
                    Read
                </a>
                <a href="?status=replied" class="btn <?php echo $status_filter === 'replied' ? 'btn-purple' : 'btn-outline-purple'; ?>">
                    Replied
                </a>
                <a href="?status=archived" class="btn <?php echo $status_filter === 'archived' ? 'btn-purple' : 'btn-outline-purple'; ?>">
                    Archived
                </a>
            </div>
        </div>

        <?php if (!empty($view_message)): ?>
            <div class="glass-card mb-4 p-4">
                <h3 class="mb-3">Message Detail #<?php echo (int)$view_message['id']; ?></h3>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($view_message['name']); ?></p>
                <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($view_message['email']); ?>" class="text-purple"><?php echo htmlspecialchars($view_message['email']); ?></a></p>
                <p><strong>Subject:</strong> <?php echo htmlspecialchars($view_message['subject']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars(ucfirst($view_message['status'])); ?></p>
                <p><strong>Date:</strong> <?php echo date('M d, Y H:i', strtotime($view_message['created_at'])); ?></p>
                <hr>
                <p class="mb-0"><?php echo nl2br(htmlspecialchars($view_message['message'])); ?></p>
            </div>
        <?php endif; ?>

        <!-- Messages Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h3 class="data-table-title">
                    <i class="bi bi-envelope me-2"></i>
                    <?php echo ucfirst($status_filter); ?> Messages
                    <span class="text-muted small">(<?php echo number_format($total_messages); ?>)</span>
                </h3>
            </div>

            <?php if (empty($messages)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h3>No Messages Found</h3>
                    <p>
                        <?php if ($status_filter === 'all'): ?>
                            No contact form submissions yet.
                        <?php else: ?>
                            No <?php echo $status_filter; ?> messages at this time.
                        <?php endif; ?>
                    </p>
                </div>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td>#<?php echo $message['id']; ?></td>
                                <td><?php echo htmlspecialchars($message['name']); ?></td>
                                <td>
                                    <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="text-purple">
                                        <?php echo htmlspecialchars($message['email']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($message['subject']); ?></td>
                                <td>
                                    <?php
                                    $preview = htmlspecialchars(substr($message['message'], 0, 60));
                                    echo strlen($message['message']) > 60 ? $preview . '...' : $preview;
                                    ?>
                                </td>
                                <td>
                                    <span class="status-badge-table status-<?php echo $message['status']; ?>">
                                        <?php echo ucfirst($message['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y H:i', strtotime($message['created_at'])); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="?view=<?php echo $message['id']; ?>" class="btn-icon" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <?php if ($message['status'] === 'new'): ?>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                                                <input type="hidden" name="action" value="mark_read">
                                                <input type="hidden" name="id" value="<?php echo (int)$message['id']; ?>">
                                                <button type="submit" class="btn-icon" title="Mark as Read" style="border:0;background:none;padding:0;">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <form method="post" style="display:inline;" onsubmit="return confirmDelete('Are you sure you want to delete this message?')">
                                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo (int)$message['id']; ?>">
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

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?status=<?php echo $status_filter; ?>&page=<?php echo $page - 1; ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <?php if ($i == $page): ?>
                                <span class="active"><?php echo $i; ?></span>
                            <?php else: ?>
                                <a href="?status=<?php echo $status_filter; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="?status=<?php echo $status_filter; ?>&page=<?php echo $page + 1; ?>">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

       </main>

</div>

<?php include 'includes/admin-footer.php'; ?>
