<?php
/**
 * Main settings and constants for the website
 */

// Error reporting (turn off on live site!)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Europe/Bratislava');

// Site info
define('SITE_NAME', 'WeXxQ Portfolio');
define('SITE_DESCRIPTION', 'Student developer passionate about creating modern web applications');
define('SITE_AUTHOR', 'WeXxQ');
define('SITE_KEYWORDS', 'portfolio, web developer, student developer, HTML, CSS, JavaScript, Python, C, Slovakia');

// Base URL (change this to your own)
define('BASE_URL', 'http://localhost:63342/Portfolio_');
define('BASE_PATH', dirname(__DIR__));

// Asset paths
define('CSS_PATH', BASE_URL . '/assets/css');
define('JS_PATH', BASE_URL . '/assets/js');
define('IMG_PATH', BASE_URL . '/assets/img');

// Social media links
define('GITHUB_URL', 'https://github.com/WeXxQ-o');
define('LINKEDIN_URL', '#');
define('DISCORD_URL', '#');

// Contact info
define('CONTACT_EMAIL', 'example@email.com');
define('CONTACT_LOCATION', 'Slovakia');

// Navigation menu items
define('MENU_ITEMS', [
    'Home' => BASE_URL . '/index.php',
    'About' => BASE_URL . '/pages/about.php',
    'Skills' => BASE_URL . '/pages/skills.php',
    'Projects' => BASE_URL . '/pages/projects.php',
    'FAQ' => BASE_URL . '/pages/faq.php',
    'Contact' => BASE_URL . '/pages/contact.php'
]);

// Admin panel paths
define('ADMIN_URL', BASE_URL . '/admin');
define('ADMIN_PATH', BASE_PATH . '/admin');

// Environment setting
define('ENVIRONMENT', 'development'); // TODO: Switch to 'production' when going live
