<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/ContactHandler.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$handler = new ContactHandler();
$handler->handle();