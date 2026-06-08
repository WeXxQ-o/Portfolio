<?php
/**
 * My helper functions
 */

/**
 * Cleans input (trim, stripslashes, htmlspecialchars)
 */
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

    return $data;
}

/**
 * Check if we're on a page (for 'active' CSS class)
 */
function isActive($page)
{
    $currentPage = basename($_SERVER['PHP_SELF']);

    return ($currentPage === $page) ? 'active' : '';
}

/**
 * Basic email validation
 */
function validateEmail($email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Returns page title
 */
function getPageTitle($pageTitle = 'Home'): string
{
    return $pageTitle . ' | ' . SITE_NAME;
}

/**
 * Load a component
 */
function includeComponent($component, $data = []): void
{
    extract($data);
    $componentPath = BASE_PATH . '/components/' . $component . '.php';

    if (file_exists($componentPath)) {
        include $componentPath;
    }
}
