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

if (empty($password)) {
    setValidationError('password', 'Заполните пароль');
}

if ($password != $repeatPassword) {
    setValidationError('password', 'Пароли не совпадают');
}


$user = findUserByKey('login', $login);

if ($user) {
    setValidationError('login', 'Такой логин уже есть');
}

$user = findUserByKey('phone', $phone);

if ($user) {
    setValidationError('phone', 'Такой телефон уже есть');
}

$user = findUserByKey('email', $email);

if ($user) {
    setValidationError('email', 'Такой email уже есть');
}

setOldData('login', $login);
setOldData('phone', $phone);
setOldData('email', $email);


if (!empty($_SESSION['validation'])) {
    redirect('/register.php');
}

$pdo = getPDO();

$query = "INSERT INTO users (login, email, phone, password) VALUES (?,?,?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$login, $email, $phone, password_hash($password, PASSWORD_DEFAULT)]);


redirect('/auth.php');



