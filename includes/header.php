<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}

if (!isset($pageTitle)) {
    $pageTitle = 'Home';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo SITE_KEYWORDS; ?>">
    <meta name="author" content="<?php echo SITE_AUTHOR; ?>">
    <meta name="theme-color" content="#0f0f0f">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/main.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/navbar.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/footer.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/components.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/projects.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/faq.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/responsive.css">

    <title><?php echo getPageTitle($pageTitle); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
<div class="noise-overlay"></div>
