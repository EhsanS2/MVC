<?php
require_once '../config/config.php';
require_once '../config/helperfunction.php';
require_once '../app/router.php';
require_once '../config/route.php';
$url = isset($_GET['url']) && $_GET['url'] !== '' ? strtolower($_GET['url']) : '/';
Router::route($url);
