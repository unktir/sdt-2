<?php

use core\App;
use core\Database;
use models\Driver;

$db = App::resolve(Database::class);
$driver_class = new Driver();

$car_id = $_SESSION['user']['car_id'];

$full_name = $driver_class->findDriverFullNameByCarId($car_id);
$full_name['first_name'] = mb_substr($full_name['first_name'], 0, 1, 'UTF-8') . '.';
$full_name['middle_name'] = mb_substr($full_name['middle_name'], 0, 1, 'UTF-8') . '.';

$unpaid_car_offenses = $driver_class->getCarOffensesDataByIdAndStatus($car_id, false);
$paid_car_offenses = $driver_class->getCarOffensesDataByIdAndStatus($car_id, true);

$now = date('Y-m-d');

view('client/layouts/default.php', [
    'page' => 'index',
    'title' => 'Оплата штрафов',
    'unpaid_car_offenses' => $unpaid_car_offenses,
    'paid_car_offenses' => $paid_car_offenses,
    'now' => $now,
    'full_name' => $full_name
]);