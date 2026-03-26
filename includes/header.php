<?php
/**
 * HTML Header - <head> sekcia
 * Použitie: include 'includes/header.php';
 * Pred includnutím nastav premennú $pageTitle
 */

// Načítaj konfiguráciu ak ešte nebola načítaná
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}

// Ak nie je definovaný title, použi default
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
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Devicon Icons -->
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />


    <!-- Custom Styles -->
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
