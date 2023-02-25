<?php

use models\Offense;

if (!empty($_GET)):
    $id = $_GET['id'];

    $offense_class = new Offense();

    $offense = $offense_class->findOffenseDescriptionById($id);

    if (!empty($offense)): ?>
        <p id="offense_article">
            <span><b>Описание статьи: </b></span>
            <?= $offense['offense_article'] ?>
        </p>
        <p id="punishment_article">
            <span><b>Предусмотренные санкции/меры: </b></span>
            <?= $offense['punishment_article'] ?>
        </p>
    <?php endif;
endif;
