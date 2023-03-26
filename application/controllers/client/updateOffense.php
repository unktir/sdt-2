<?php

use core\App;
use core\Database;
use models\Driver;

$db = App::resolve(Database::class);
$driver_class = new Driver();

parse_str(file_get_contents('php://input'), $_PATCH);

if (!empty($_PATCH)) {
    $car_offense_id_list = $_PATCH['car-offense-id'];
    $now = date('Y-m-d');

    foreach ($car_offense_id_list as $car_offense_id) {
        $car_offenses = $driver_class->updateCarOffensesStatusById($car_offense_id, $now);
    }
}

exit;