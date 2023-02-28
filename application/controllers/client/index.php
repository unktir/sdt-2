<?php

use core\App;
use core\Database;
use models\Driver;

$db = App::resolve(Database::class);
$driver_class = new Driver();

$car_id = 2;

$car_offenses = $driver_class->getCarOffensesById($car_id);

view('layouts/default.php', [
    'type' => 'client',
    'title' => 'Оплата штрафов',
    'car_offenses' => $car_offenses,
]);