<?php
/**
 * Admin Sidebar Navigation
 */

$current_page = basename($_SERVER['PHP_SELF']);

$new_messages_count = 0;

if (!isset($current_admin) || !is_array($current_admin)) {
    $current_admin = [
        'username' => 'Admin',
    ];
}

function isActivePage($page): string
{
    global $current_page;

    return $current_page === $page ? 'active' : '';
}
?>

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="<?php echo ADMIN_URL; ?>/index.php" class="sidebar-brand">
            <i class="bi bi-grid-fill"></i>
            <span>WeXxQ<span class="text-purple"> Admin</span></span>
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <div class="nav-section-title">Main</div>
        <ul>
            <li>
                <a href="<?php echo ADMIN_URL; ?>/index.php" class="<?php echo isActivePage('index.php'); ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-title">Content</div>
        <ul>
            <li>
                <a href="<?php echo ADMIN_URL; ?>/messages.php" class="<?php echo isActivePage('messages.php'); ?>">
                    <i class="bi bi-envelope"></i>
                    <span>Messages</span>
                    <?php if ($new_messages_count > 0): ?>
                        <span class="nav-badge"><?php echo $new_messages_count; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="<?php echo ADMIN_URL; ?>/projects.php" class="<?php echo isActivePage('projects.php'); ?>">
                    <i class="bi bi-folder2-open"></i>
                    <span>Projects</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-title">Other</div>
        <ul>
            <li>
                <a href="<?php echo BASE_URL; ?>/index.php" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>View Website</span>
                </a>
            </li>
            <li>
                <a href="<?php echo ADMIN_URL; ?>/logout.php">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="admin-user-card">
            <div class="admin-avatar">
                <?php echo strtoupper(substr($current_admin['username'] ?? 'A', 0, 1)); ?>
            </div>
            <div class="admin-user-info">
                <p class="admin-user-name"><?php echo htmlspecialchars($current_admin['username'] ?? 'Admin'); ?></p>
                <p class="admin-user-role">Administrator</p>
            </div>
        </div>
    </div>
</aside>
