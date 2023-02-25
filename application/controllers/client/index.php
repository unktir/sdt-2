<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);

view('layouts/default.php', [
    'type' => 'client',
    'title' => 'Оплата штрафов'
]);