<?php

use models\Offense;

$offense_class = new Offense();
$offenses_chapters = $offense_class->getOffensesChapters();

view('admin/layouts/default.php', [
    'page' => 'index',
    'title' => 'Страница администратора',
    'offenses_chapters' => $offenses_chapters
]);