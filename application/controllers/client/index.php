<?php

use core\App;
use core\Database;
use models\Driver;

$db = App::resolve(Database::class);
$driver_class = new Driver();

$car_id = $_SESSION['user']['car_id'];

$car_offenses = $driver_class->getCarOffensesById($car_id);

$now = date('Y-m-d');

view('layouts/default.php', [
    'type' => 'client',
    'page' => 'index',
    'title' => 'Оплата штрафов',
    'car_offenses' => $car_offenses,
    'now' => $now
]);