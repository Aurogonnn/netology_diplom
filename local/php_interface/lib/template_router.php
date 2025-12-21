<?php

// Функция для динамической установки шаблона
function setDynamicTemplate()
{
$uri = $_SERVER['REQUEST_URI'];

$path = parse_url($uri, PHP_URL_PATH);
$path = rtrim($path, '/') ?: '/';

if ($path === '/' || $path === '/index.php') {
define('SITE_TEMPLATE_ID', 'go_ride');
} else {
define('SITE_TEMPLATE_ID', 'go_ride_catalog');
}
}