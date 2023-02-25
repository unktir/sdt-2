<?php

use models\Driver;

if (!empty($_POST)) {

    $car_id = $_POST['car_id'];
    $offense_id = $_POST['offense_id'];
    $offense_date_data = explode('T', $_POST['offense_date_and_time']);
    $offense_date = $offense_date_data[0];
    $offense_time = $offense_date_data[1];
    $pay_bill_amount = $_POST['pay_bill_amount'];

    $new_car_offense = [
        'car_id' => intval($car_id),
        'offense_id' => intval($offense_id),
        'offense_date' => $offense_date,
        'offense_time' => $offense_time,
        'pay_bill_date' => date('Y-m-d', strtotime($offense_date . ' + 1 days')),
        'gis_discount_uptodate' => date('Y-m-d', strtotime($offense_date . ' + 21 days')),
        'last_bill_date' => date('Y-m-d', strtotime($offense_date . ' + 61 days')),
        'pay_bill_amount' => intval($pay_bill_amount)
    ];

    $driver_class = new Driver();

    $driver_class->addCarOffense($new_car_offense);
}
//$params = [
//    'car_id' => '1',
//    'offense_id' => '1',
//    'offense_date' => '2023-02-23',
//    'offense_time' => '21:08:00',
//    'pay_bill_date' => '2023-02-24',
//    'gis_discount_uptodate' => '2023-03-16',
//    'last_bill_date' => '2023-04-25',
//    'pay_bill_amount' => 500
//];