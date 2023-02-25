<?php

namespace core;

class Response {
    const NOT_FOUND = [
        'code' => 404,
        'message' => 'Страница не найдена',
        'description' => ''
    ];
    const FORBIDDEN = [
        'code' => 403,
        'message' => '',
        'description' => ''
    ];
}