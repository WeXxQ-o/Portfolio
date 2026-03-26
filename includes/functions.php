<?php
/**
 * Pomocné PHP funkcie
 */

/**
 * Sanitize user input
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Check if current page is active
 */
function isActive($page) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    return ($currentPage === $page) ? 'active' : '';
}

/**
 * Validate email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Get current page title
 */
function getPageTitle($pageTitle = 'Home') {
    return $pageTitle . ' | ' . SITE_NAME;
}

/**
 * Include component
 */
function includeComponent($component, $data = []) {
    extract($data);
    $componentPath = BASE_PATH . '/components/' . $component . '.php';
    if (file_exists($componentPath)) {
        include $componentPath;
    }
}
