<?php

// Данный скрипт добавляет данные в базу данных
// Чтобы запустить, напишите в консоли 'php -f application\database\seeds\default_seed.php'

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

//$db->query('delete from offenses_chapters; delete from offenses');

$fines_data = file_get_contents(app_path('database/data/fines_data.json'));
$fines_data = json_decode($fines_data, true);

$id = 0;

foreach ($fines_data as $chapter_id => $chapter) {
    $db->query('insert into offenses_chapters (id, title) value (:id, :title)', [
        'id' => $chapter_id + 1,
        'title' => $chapter['title']
    ]);
    foreach ($chapter['penalties'] as $key => $offense) {
        ++$id;
        $db->query('insert into offenses (id, chapter_id, offense_article_number, offense_article, punishment_article) value (:id, :chapter_id, :offense_article_number, :offense_article, :punishment_article)', [
            'id' => $id,
            'chapter_id' => $chapter_id + 1,
            'offense_article_number' => $offense['offense_article_number'],
            'offense_article' => $offense['offense_article'],
            'punishment_article' => $offense['punishment_article']
        ]);
    }
}
