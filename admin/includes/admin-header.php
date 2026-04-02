<?php
/**
 * Admin Panel Header
 * Includes navigation and top bar
 */

if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../../config/config.php';
}

if (!isset($current_admin) || !is_array($current_admin)) {
    $current_admin = [
        'username' => 'Admin',
    ];
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | Admin | ' . SITE_NAME : 'Admin | ' . SITE_NAME; ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/main.css">
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/assets/css/admin.css">
</head>
<body>
<div class="noise-overlay"></div>

<div class="admin-wrapper">
