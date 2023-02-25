<?php

use core\Response;

function dump_and_die($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code['code']);

    view("error-pages/{$code['code']}.php", $code);

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function app_path($path)
{
    return base_path('application/' . $path);
}

function view($path, $attributes = [])
{
    extract($attributes);

    require app_path('views/' . $path);
}