<?php

// Данный скрипт создаёт таблицы в базе данных
// Чтобы запустить, напишите в консоли 'php -f application\database\migration\default_migration.php'

use core\App;
use core\Database;

define('BASE_PATH', dirname(__DIR__, 3) . '/');

require BASE_PATH . 'application/core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require app_path("$class.php");
});

require app_path('configs/bootstrap.php');

$db = App::resolve(Database::class);

// Создание таблицы глав нарушений
$db->query("create table `sdt-2`.offenses_chapters
(
    id    int auto_increment
        primary key,
    title varchar(255) not null
);");

// Создание таблицы водителей
$db->query("create table `sdt-2`.drivers
(
    id          int auto_increment
        primary key,
    last_name   varchar(255) not null,
    first_name  varchar(255) not null,
    middle_name varchar(255) not null
);");

// Создание таблицы нарушений
$db->query("create table `sdt-2`.offenses
(
    id                     int auto_increment
        primary key,
    chapter_id             int         not null,
    offense_article_number varchar(40) not null,
    offense_article        text        not null,
    punishment_article     text        not null,
    constraint offense_article_number
        unique (offense_article_number),
    constraint offenses_offenses_chapters_id_fk
        foreign key (chapter_id) references `sdt-2`.offenses_chapters (id)
            on update cascade on delete cascade
);");

// Создание таблицы автомобилей
$db->query("create table `sdt-2`.cars
(
    id          int auto_increment
        primary key,
    driver_id   int          not null,
    auto_number varchar(6)   not null,
    auto_region varchar(3)   not null,
    auto_name   varchar(255) not null,
    constraint cars_drivers_id_fk
        foreign key (driver_id) references `sdt-2`.drivers (id)
);");

// Создание таблицы нарушений автомобиля
$db->query("create table `sdt-2`.car_offenses
(
    id                    int auto_increment
        primary key,
    car_id                int                  not null,
    offense_id            int                  not null,
    status                tinyint(1) default 0 not null,
    offense_date          date                 not null,
    offense_time          time                 not null,
    pay_bill_date         date                 not null,
    gis_discount_uptodate date                 not null,
    last_bill_date        date                 not null,
    pay_bill_amount       int                  not null,
    date_paid             date                 null,
    constraint car_offenses_cars_id_fk
        foreign key (car_id) references `sdt-2`.cars (id)
            on update cascade,
    constraint car_offenses_offenses_id_fk
        foreign key (offense_id) references `sdt-2`.offenses (id)
            on update cascade
);");