<?php

//Основная страница
$router->get('/', 'client/index.php');

// Страница администратора
$router->get('/admin', 'admin/index.php');
// Добавить водителя и/или автомобиль
$router->post('/admin/storeDriver', 'admin/storeDriver.php');
// Составление нарушения
$router->get('/admin/getCarList', 'admin/getCarList.php');
$router->get('/admin/getOffensesArticle', 'admin/getOffensesArticle.php');
$router->get('/admin/findDescription', 'admin/findDescription.php');
$router->post('/admin/storeOffense', 'admin/storeOffense.php');
//$router->get('/admin/', 'admin/.php');