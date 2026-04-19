<?php
require_once '../config/config.php';
require_once 'handlers/LogoutHandler.php';

$logoutHandler = new LogoutHandler();
$logoutHandler->handle();
