<?php

// Страница входа
$router->get('/login','client/session/create.php')->only('guest');
$router->post('/session','client/session/store.php')->only('guest');
$router->delete('/session','client/session/destroy.php')->only('auth');

// Основная страница
$router->get('/', 'client/index.php')->only('auth');
$router->post('/updateOffense', 'client/updateOffense.php');

// Страница администратора
$router->get('/admin', 'admin/index.php');
// Добавить водителя и/или автомобиль
$router->post('/admin/storeDriver', 'admin/storeDriver.php');
// Составление нарушения
$router->get('/admin/getCarList', 'admin/getCarList.php');
$router->get('/admin/getOffensesArticle', 'admin/getOffensesArticle.php');
$router->get('/admin/findDescription', 'admin/findDescription.php');
$router->post('/admin/storeOffense', 'admin/storeOffense.php');