<?php

require_once __DIR__ . '/helpers.php';

$login = $_POST['login'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeat_password'];


if (empty($login)) {
    setValidationError('login', 'Заполните логин');
}

if (empty($phone)) {
    setValidationError('phone', 'Заполните телефон');
}

if (empty($email)) {
    setValidationError('email', 'Заполните email');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setValidationError('email', 'Некорректный email');
}

if ($password != $repeatPassword) {
    setValidationError('password', 'Пароли не совпадают');
}

$userNow = findUserByKey('id', $_SESSION['user']['id']);

$user = findUserByKey('login', $login);

if ($userNow['login'] !== $login) {
    if ($user) {
        setValidationError('login', 'Такой логин уже есть');
    }
}

$user = findUserByKey('phone', $phone);

if ($userNow['phone'] !== $phone) {
    if ($user) {
        setValidationError('phone', 'Такой телефон уже есть');
    }
}

$user = findUserByKey('email', $email);

if ($userNow['email'] !== $email) {
    if ($user) {
        setValidationError('email', 'Такой email уже есть');
    }
}

if (!empty($_SESSION['validation'])) {
    redirect('/edit.php');
}


$pdo = getPDO();

if ($password) {
    $stmt = $pdo->prepare("UPDATE users SET login  = ? , phone = ?, email = ?, password =? WHERE id = ?");
    $stmt->execute([$login, $phone, $email, password_hash($password, PASSWORD_DEFAULT), $_SESSION['user']['id']]);
} else {
    $stmt = $pdo->prepare("UPDATE users SET login  = ? , phone = ?, email = ? WHERE id = ?");
    $stmt->execute([$login, $phone, $email, $_SESSION['user']['id']]);
}
$stmt->fetch();

redirect('/index.php');