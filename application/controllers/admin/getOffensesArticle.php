<?php

use models\Offense;

if (!empty($_GET)):
    $chapter_id = $_GET['chapter_id'];

    $offense_class = new Offense();

    $offense = $offense_class->getOffenseArticleByChapterId($chapter_id);

    if (!empty($offense)):
        echo "<option hidden='' value=''>Выберите статью</option>";
        foreach ($offense as $key => $penalties): ?>
            <option value="<?= $penalties['id'] ?>">
                <?= $penalties['offense_article_number'] ?>
            </option>
        <?php endforeach;
    else: ?>
        <option id="data-null-yet">Пока данных нет</option>
    <?php endif;
endif;