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
    <title>Авторизация</title>
</head>
<body class="page">
<div class="container">
    <main class="main">
        <form class="page-form" method="post" action="src/auth.php">
            <h2>Авторизация</h2>
            <?php if (hasErrorMessageForAuth('error')) : ?>
                <span class="form__error"><?php echo getErrorMessageForAuth('error'); ?></span>
            <?php endif ?>

            <input class="page-form__input"
                   value="<?php echo getOldDataByKey('email_phone') ?>"
                   placeholder="Телефон или Email"
                   type="text"
                   name="email_phone"
                <?php showErrorInInput('email_phone'); ?>><br>

            <?php if (showErrorUnderInput('email_phone')) : ?>
                <span class="input__error"><?php getError('email_phone'); ?></span>
            <?php endif ?>

            <input class="page-form__input"
                   placeholder="Пароль"
                   type="password"
                   name="password"
                <?php showErrorInInput('password'); ?>><br>

            <?php if (showErrorUnderInput('password')) : ?>
                <span class="input__error"><?php getError('password'); ?></span>
            <?php endif ?>

            <button class="page-form__button" type="submit"> Отправить</button>
        </form>
        <p class="reg-text">У меня еще нет <a href="/register.php">аккаунта.</a></p>
    </main>
</div>
</body>
</html>
