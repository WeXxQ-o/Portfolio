<?php
/**
 * Admin Messages Management
 * View and manage contact form submissions
 */

require_once '../config/config.php';

$pageTitle = 'Messages';

include 'includes/admin-header.php';
include 'includes/admin-sidebar.php';
?>

<!-- Main Content -->
<div class="admin-content">

    <!-- Header -->
    <!-- TODO: add a search bar here -->
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
                <!-- TODO: add a spam tab -->
            </div>
        </div>

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
                    <p class="text-muted small mt-3">
                        <strong>TODO:</strong> connect the DB and make sure it's saving messages.
                    </p>
                </div>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
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
                                        <!-- TODO: Implement view/edit functionality -->
                                        <!-- TODO: quick reply button (email or modal) -->
                                        <a href="?view=<?php echo $message['id']; ?>" class="btn-icon" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <!-- TODO: Implement mark as read functionality -->
                                        <?php if ($message['status'] === 'new'): ?>
                                            <a href="?action=mark_read&id=<?php echo $message['id']; ?>" class="btn-icon" title="Mark as Read">
                                                <i class="bi bi-check"></i>
                                            </a>
                                        <?php endif; ?>
                                        <!-- TODO: Implement delete functionality -->
                                        <a href="?action=delete&id=<?php echo $message['id']; ?>"
                                           class="btn-icon btn-danger"
                                           title="Delete"
                                           onclick="return confirmDelete('Are you sure you want to delete this message?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
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
