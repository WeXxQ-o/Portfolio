<?php
/**
 * Admin Dashboard
 * Main overview page with statistics and recent activity
 */

require_once '../config/config.php';
require_once __DIR__ . '/includes/AuthCheck.php';

AuthCheck::requireAuth();
$current_admin = AuthCheck::getCurrentAdmin();
$pageTitle = 'Dashboard';

$total_messages = 0;
$today_messages = 0;
$new_messages = 0;
$total_projects = 0;
$recent_messages = [];

try {
    $db = getDbConnection();

    $statsStmt = $db->query('SELECT COUNT(*) AS total_messages, SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) AS today_messages, SUM(CASE WHEN status = "new" THEN 1 ELSE 0 END) AS new_messages FROM contact_messages');
    $stats = $statsStmt->fetch();

    if ($stats) {
        $total_messages = (int)($stats['total_messages'] ?? 0);
        $today_messages = (int)($stats['today_messages'] ?? 0);
        $new_messages = (int)($stats['new_messages'] ?? 0);
    }

    $projectsStmt = $db->query('SELECT COUNT(*) AS total_projects FROM projects WHERE status = "active"');
    $projectsData = $projectsStmt->fetch();
    if ($projectsData) {
        $total_projects = (int)($projectsData['total_projects'] ?? 0);
    }

    $recentStmt = $db->query('SELECT id, name, email, message, status, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5');
    $recent_messages = $recentStmt->fetchAll();
} catch (Throwable $e) {
    $total_messages = 0;
    $today_messages = 0;
    $new_messages = 0;
    $total_projects = 0;
    $recent_messages = [];
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
                <h1>Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($current_admin['username']); ?>!</p>
            </div>
            <div class="admin-header-right">
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="bi bi-list"></i>
                </button>
                <a href="<?php echo BASE_URL; ?>/index.php" target="_blank" class="header-btn">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>View Website</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="admin-main">

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <!-- Total Messages -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-icon purple">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <h2 class="stat-value"><?php echo number_format($total_messages); ?></h2>
                <p class="stat-label">Total Messages</p>
                <!-- TODO: link this to all messages page -->
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i>
                    <span>+<?php echo $today_messages; ?> today</span>
                </div>
            </div>

            <!-- New Messages -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-icon blue">
                        <i class="bi bi-envelope-open"></i>
                    </div>
                </div>
                <h2 class="stat-value"><?php echo number_format($new_messages); ?></h2>
                <p class="stat-label">Unread Messages</p>
                <!-- TODO: link this to unread messages only -->
                <div class="stat-change">
                    <span>Needs attention</span>
                </div>
            </div>

            <!-- Total Projects -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-icon green">
                        <i class="bi bi-folder"></i>
                    </div>
                </div>
                <h2 class="stat-value"><?php echo number_format($total_projects); ?></h2>
                <p class="stat-label">Active Projects</p>
                <div class="stat-change">
                    <span>Portfolio items</span>
                </div>
            </div>

            <!-- Account Status -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-icon orange">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
                <h2 class="stat-value">Active</h2>
                <p class="stat-label">Account Status</p>
                <div class="stat-change positive">
                    <i class="bi bi-check-circle"></i>
                    <span>All systems operational</span>
                </div>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h3 class="data-table-title">
                    <i class="bi bi-envelope me-2"></i>Recent Messages
                </h3>
                <div class="table-actions">
                    <a href="<?php echo ADMIN_URL; ?>/messages.php" class="btn btn-outline-purple">
                        View All <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <?php if (empty($recent_messages)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h3>No Messages Yet</h3>
                    <p>Contact form submissions will appear here.</p>
                </div>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_messages as $message): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($message['name']); ?></td>
                                <td><?php echo htmlspecialchars($message['email']); ?></td>
                                <td><?php echo htmlspecialchars(substr($message['message'], 0, 50)) . '...'; ?></td>
                                <td>
                                    <span class="status-badge-table status-<?php echo $message['status']; ?>">
                                        <?php echo ucfirst($message['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($message['created_at'])); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?php echo ADMIN_URL; ?>/messages.php?view=<?php echo $message['id']; ?>" class="btn-icon" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- Quick Actions -->
        <div class="mt-5">
            <h3 class="mb-4">Quick Actions</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="<?php echo ADMIN_URL; ?>/messages.php" class="glass-card d-block text-center" style="text-decoration: none;">
                        <i class="bi bi-envelope icon-xl text-purple mb-3"></i>
                        <h5>View Messages</h5>
                        <p class="text-muted small mb-0">Manage contact form submissions</p>
                    </a>
                </div>
            </div>
        </div>

    </main>

</div>

<?php include 'includes/admin-footer.php'; ?>
