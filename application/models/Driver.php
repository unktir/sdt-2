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

    public function addDriverAndCar($driver_data = [], $car_data = [])
    {
        $this->db->query('insert into drivers (last_name, first_name, middle_name) values (:last_name, :first_name, :middle_name)', [
            'last_name' => $driver_data['last_name'],
            'first_name' => $driver_data['first_name'],
            'middle_name' => $driver_data['middle_name']
        ]);
        $driver_id = $this->findDriverIdByFullName($driver_data)['id'];
        $this->addCar($driver_id, $car_data);
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

    public function findCarIdByGovRegNum($auto_number, $auto_region)
    {
        return $this->db->query('select id from cars where auto_number = :auto_number and auto_region = :auto_region', [
            'auto_number' => $auto_number,
            'auto_region' => $auto_region
        ])->find();
    }

    public function findCarById($id) {
        return $this->db->query('select auto_number, auto_region, auto_name from cars where id = :id', [
            'id' => $id
        ])->find();

    }

    public function findDriverIdByFullName($full_name = [])
    {
        return $this->db->query('select id from drivers where last_name = :last_name and first_name = :first_name and middle_name = :middle_name', [
            'last_name' => $full_name['last_name'],
            'first_name' => $full_name['first_name'],
            'middle_name' => $full_name['middle_name']
        ])->find();
    }

    public function findDriverFullNameByCarId($car_id) {
        return $this->db->query('select drivers.id, last_name, first_name, middle_name from drivers join cars on cars.driver_id = drivers.id where cars.id = :id', [
            'id' => $car_id
        ])->find();
    }

    public function getCarListByDriverId($driver_id)
    {
        return $this->db->query('select * from cars where driver_id = :driver_id', [
            'driver_id' => $driver_id
        ])->get();
    }

    public function getCarOffensesById($car_id)
    {
        return $this->db->query('select car_offenses.id, car_id, status, offense_date, offense_time, pay_bill_date, gis_discount_uptodate, last_bill_date, pay_bill_amount, date_paid, offense_article_number, offense_article from car_offenses join offenses on offenses.id = car_offenses.offense_id where car_id = :car_id order by offense_date', [
            'car_id' => $car_id
        ])->get();
    }

    public function getCarOffensesDataByIdAndStatus($car_id, $status)
    {
        return $this->db->query('select car_offenses.id, car_id, status, offense_date, offense_time, pay_bill_date, gis_discount_uptodate, last_bill_date, pay_bill_amount, date_paid, offense_article_number, offense_article from car_offenses join offenses on offenses.id = car_offenses.offense_id where car_id = :car_id and status = :status order by offense_date', [
            'car_id' => $car_id,
            'status' => $status
        ])->get();
    }

    public function updateCarOffensesStatusById($car_offense_id, $date_paid)
    {
        return $this->db->query('update car_offenses set status = :status,  date_paid = :date_paid where id = :id', [
            'status' => 1,
            'id' => $car_offense_id,
            'date_paid' => $date_paid
        ]);
    }
}