<?php

require_once __DIR__ . '/helpers.php';

$emailOrPhone = $_POST['email_phone'];
$password = $_POST['password'];

if (empty($emailOrPhone)) {
    setValidationError('email_phone', 'Поле не должно быть пустым');
}

if (empty($password)) {
    setValidationError('password', 'Введите пароль');
}

setOldData('email_phone', $emailOrPhone);


if (!empty($_SESSION['validation'])) {
    redirect('/auth.php');
}
$pdo = getPDO();

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
$stmt->execute([$emailOrPhone, $emailOrPhone]);
$user = $stmt->fetch();

if (!$user) {
    setErrorMessageForAuth('error', 'Такой пользователь не найден');
    redirect('/auth.php');
}

if (!password_verify($password, $user['password'])) {
    setErrorMessageForAuth('error', 'Неверный пароль');
    redirect('/auth.php');
}

$_SESSION['user']['id'] = $user['id'];

redirect('/index.php');

