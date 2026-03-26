<?php
/**
 * Hlavný konfiguračný súbor
 * Obsahuje všetky konštanty a nastavenia projektu
 */

// Error reporting pre development (vypnúť na produkcii)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Časová zóna
date_default_timezone_set('Europe/Bratislava');

// Site informácie
define('SITE_NAME', 'WeXxQ Portfolio');
define('SITE_DESCRIPTION', 'Student developer passionate about creating modern web applications');
define('SITE_AUTHOR', 'WeXxQ');
define('SITE_KEYWORDS', 'portfolio, web developer, student developer, HTML, CSS, JavaScript, Python, C, Slovakia');

// Base URL (upraviť podľa tvojho prostredia)
define('BASE_URL', 'http://localhost:63342/Portfolio_');
define('BASE_PATH', dirname(__DIR__));

// Cesty k assetom
define('CSS_PATH', BASE_URL . '/assets/css');
define('JS_PATH', BASE_URL . '/assets/js');
define('IMG_PATH', BASE_URL . '/assets/img');

// Social media linky
define('GITHUB_URL', 'https://github.com/WeXxQ-o');
define('LINKEDIN_URL', '#');
define('DISCORD_URL', '#');

// Kontaktné údaje
define('CONTACT_EMAIL', 'example@email.com');
define('CONTACT_LOCATION', 'Slovakia');

// Stránky menu
define('MENU_ITEMS', [
    'Home' => BASE_URL . '/index.php',
    'About' => BASE_URL . '/pages/about.php',
    'Skills' => BASE_URL . '/pages/skills.php',
    'Projects' => BASE_URL . '/pages/projects.php',
    'FAQ' => BASE_URL . '/pages/faq.php',
    'Contact' => BASE_URL . '/pages/contact.php'
]);
