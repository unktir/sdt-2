<?php

namespace models;

use core\App;
use core\Database;

class Driver
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function addDriver($driver_data = [])
    {
        $this->db->query('insert into drivers (last_name, first_name, middle_name) values (:last_name, :first_name, :middle_name)', [
            'last_name' => $driver_data['last_name'],
            'first_name' => $driver_data['first_name'],
            'middle_name' => $driver_data['middle_name']
        ]);
    }

    public function addCar($driver_id, $auto_data = [])
    {
        $this->db->query('insert into cars (driver_id, auto_number, auto_region, auto_name) values (:driver_id, :auto_number, :auto_region, :auto_name)', [
            'driver_id' => $driver_id,
            'auto_number' => $auto_data['auto_number'],
            'auto_region' => $auto_data['auto_region'],
            'auto_name' => $auto_data['auto_name']
        ]);
    }

    public function addCarOffense($car_offense = [])
    {
        $this->db->query("insert into car_offenses ( car_id, offense_id, offense_date, offense_time, pay_bill_date, gis_discount_uptodate, last_bill_date, pay_bill_amount) values (:car_id, :offense_id, :offense_date, :offense_time, :pay_bill_date, :gis_discount_uptodate, :last_bill_date, :pay_bill_amount)", [
            'car_id' => $car_offense['car_id'],
            'offense_id' => $car_offense['offense_id'],
            'offense_date' => $car_offense['offense_date'],
            'offense_time' => $car_offense['offense_time'],
            'pay_bill_date' => $car_offense['pay_bill_date'],
            'gis_discount_uptodate' => $car_offense['gis_discount_uptodate'],
            'last_bill_date' => $car_offense['last_bill_date'],
            'pay_bill_amount' => $car_offense['pay_bill_amount']
        ]);
    }

    public function findDriverIdByFullName($full_name = [])
    {
        return $this->db->query('select id from drivers where last_name = :last_name and first_name = :first_name and middle_name = :middle_name', [
            'last_name' => $full_name['last_name'],
            'first_name' => $full_name['first_name'],
            'middle_name' => $full_name['middle_name']
        ])->find();
    }

    public function getCarListByDriverId($driver_id)
    {
        return $this->db->query('select * from cars where driver_id = :driver_id', [
            'driver_id' => $driver_id
        ])->get();
    }


}