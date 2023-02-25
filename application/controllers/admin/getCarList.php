<?php

use models\Driver;

if (!empty($_GET)) {
    $full_name = $_GET;

    $driver_class = new Driver();

    $result = $driver_class->findDriverIdByFullName($full_name);

    if ($result) {
        $id = $result['id'];
        $car_list = $driver_class->getCarListByDriverId($id);

        echo "<option hidden='' value=''>Выберите автомобиль</option>";
        foreach ($car_list as $key => $car): ?>
            <option value="<?= $car['id'] ?>">
                <?= $car['auto_name'], ' [', $car['auto_number'], '][', $car['auto_region'], ']' ?>
            </option>
        <?php
        endforeach;
    } else {
        echo "<option hidden='' value=''>Выберите автомобиль</option>";
    }
}