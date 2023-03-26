<?php

use core\App;
use core\Database;
use models\Driver;

$db = App::resolve(Database::class);
$driver_class = new Driver();

$car_id = $_SESSION['user']['car_id'];

$unpaid_car_offenses = $driver_class->getCarOffensesByIdAndStatus($car_id, false);
$paid_car_offenses = $driver_class->getCarOffensesByIdAndStatus($car_id, true);

$now = date('Y-m-d');

view('layouts/default.php', [
    'type' => 'client',
    'page' => 'index',
    'title' => 'Оплата штрафов',
    'unpaid_car_offenses' => $unpaid_car_offenses,
    'paid_car_offenses' => $paid_car_offenses,
    'now' => $now
]);