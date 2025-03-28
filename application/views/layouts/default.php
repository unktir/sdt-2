<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="data:;base64,=">
    <link rel="stylesheet" href="./styles/reset.css">
    <link rel="stylesheet" href="./styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"></script>
    <!-- <script src="https://kit.fontawesome.com/11c459d6f0.js" crossorigin="anonymous"></script> -->
    <title><?= $title ?></title>
</head>
<body>
<div class="wrapper">
    <?php require app_path("views/$type/templates/header.php"); ?>
    <?php require app_path("views/$type/pages/index.php"); ?>
    <?php require app_path("views/$type/templates/footer.php"); ?>
</div>
<script src="/scripts/script.js"></script>
</body>
</html>