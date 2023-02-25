<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'application/core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require app_path("$class.php");
});

require app_path('configs/bootstrap.php');

$router = new core\Router();
$routes = require app_path('configs/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);