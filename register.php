<?php
require_once __DIR__ . '/src/helpers.php';
checkGuest();
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body class="page">
<div class="container">
    <main class="main">
        <form class="page-form" method="post" action="src/register.php">
            <h2>Регистрация</h2>
            <input class="page-form__input"
                   value="<?php echo getOldDataByKey('login') ?>"
                   placeholder="Логин"
                   type="text"
                   name="login"
                <?php showErrorInInput('login'); ?> ><br>

            <?php if (showErrorUnderInput('login')) : ?>
                <span class="input__error"><?php getError('login'); ?></span>
            <?php endif ?>

            <input class="page-form__input"
                   value="<?php echo getOldDataByKey('phone') ?>"
                   placeholder="Телефон"
                   type="text"
                   name="phone"
                <?php showErrorInInput('phone'); ?>><br>

            <?php if (showErrorUnderInput('phone')) : ?>
                <span class="input__error"><?php getError('phone'); ?></span>
            <?php endif ?>

            <input class="page-form__input"
                   value="<?php echo getOldDataByKey('email') ?>"
                   placeholder="Email"
                   type="email"
                   name="email"
                <?php showErrorInInput('email'); ?>><br>

            <?php if (showErrorUnderInput('email')) : ?>
                <span class="input__error"><?php getError('email'); ?></span>
            <?php endif ?>

            <input class="page-form__input"
                   placeholder="Пароль"
                   type="password"
                   name="password"
                <?php showErrorInInput('password'); ?>><br>

            <?php if (showErrorUnderInput('password')) : ?>
                <span class="input__error"><?php getError('password'); ?></span>
            <?php endif ?>

            <input class="page-form__input" placeholder="Повтор пароля" type="password" name="repeat_password"><br>

            <button class="page-form__button" type="submit"> Отправить</button>
        </form>
        <p class="reg-text">У меня уже есть <a href="/auth.php">аккаунт.</a></p>
    </main>
</div>
</body>
</html>

