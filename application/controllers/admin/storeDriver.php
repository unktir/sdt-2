<?php

use models\Driver;

if (!empty($_POST)) {

    $full_name = [
        'last_name' => $_POST['add_last_name'],
        'first_name' => $_POST['add_first_name'],
        'middle_name' => $_POST['add_middle_name']
    ];
    $car = [
        'auto_number' => $_POST['registered_number'],
        'auto_region' => $_POST['registered_region'],
        'auto_name' => $_POST['auto_name'],
    ];

    // Валидация данных

    $driver_class = new Driver();

    $car_result = $driver_class->findCarIdByGovRegNum($car['auto_number'], $car['auto_region']);

    if (!$car_result) {
        $driver_result = $driver_class->findDriverIdByFullName($full_name);

        if ($driver_result) {
            $driver_id = $driver_result['id'];
            $driver_class->addCar($driver_id, $car);

            echo 'К водителю добавлен новый авто!';
        } else {
            $driver_class->addDriverAndCar($full_name, $car);

            echo 'Водитель и авто добавлены в базу!';
        }
    } else {
        echo 'Номер с таким авто уже существует!';
    }
}