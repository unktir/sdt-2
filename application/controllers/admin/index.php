<?php

use models\Offense;

$offense_class = new Offense();
$offenses_chapters = $offense_class->getOffensesChapters();

view('layouts/default.php', [
    'type' => 'admin',
    'page' => 'index',
    'title' => 'Страница администратора',
    'offenses_chapters' => $offenses_chapters
]);