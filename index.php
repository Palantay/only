<?php
require_once __DIR__ . '/src/helpers.php';
checkAuth();
$user = findUserByKey('id', $_SESSION['user']['id']);

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
</head>
<body class="page">
<div class="container">
    <main class="main">
        <div class="text__container">
            <p class="text">Логин: <?php echo $user['login'] ?> </p>
        </div>
        <div class="text__container">
            <p class="text">Телефон: <?php echo $user['phone'] ?></p>
        </div>
        <div class="text__container">
            <p class="text">Еmail: <?php echo $user['email'] ?></p>
        </div>
        <a class="page-form__button" style="margin-bottom: 20px" href="/edit.php">Изменить данные</a>
        <form action="src/logout.php" method="post">
            <button class="page-form__button">Выйти</button>
        </form>
    </main>
</div>
</body>
</html>
