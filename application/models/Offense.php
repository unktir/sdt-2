<?php

namespace models;

use core\App;
use core\Database;

class Offense
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function getOffensesChapters ()
    {
        return $this->db->query('select * from offenses_chapters')->get();
    }

    public function getOffenseArticleByChapterId($chapter_id)
    {
        return $this->db->query('select id, offense_article_number from offenses where chapter_id = :chapter_id', [
            'chapter_id' => $chapter_id
        ])->get();
    }

    public function findOffenseDescriptionById($id)
    {
        return $this->db->query('select offense_article_number, offense_article, punishment_article from offenses where id = :id', [
            'id' => $id
        ])->find();
    }
}