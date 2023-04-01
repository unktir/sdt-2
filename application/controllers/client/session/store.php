<?php

use core\App;
use core\Database;
use models\Driver;

$db = App::resolve(Database::class);

$car_data = [
    'auto_number' => $_POST['registered_number'],
    'auto_region' => $_POST['registered_region']
];

$driver_class = new Driver();

$car_id = $driver_class->findCarIdByGovRegNum($car_data['auto_number'], $car_data['auto_region']);

if ($car_id) {
    login([
        'car_id' => $car_id['id'],
    ]);

    echo 'Вы вошли!';

    //header('location: /');
    exit;
}

echo 'Номера нет в базе!';
