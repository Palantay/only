<?php

session_start();

require_once __DIR__ . './../config.php';


function getPDO(): PDO
{
    try {
        return new \PDO(dsn: 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, username: DB_USERNAME, password: DB_PASSWORD);
    } catch (\Exception $e) {
        die($e->getMessage());
    }
}

function redirect(string $path): never
{
    header("Location: $path");
    exit();
}

function setValidationError(string $field, string $message): void
{
    $_SESSION['validation'][$field] = $message;
}

function showErrorUnderInput(string $field): bool
{
    return isset($_SESSION['validation'][$field]);
}

function showErrorInInput(string $field): void
{
    echo isset($_SESSION['validation'][$field]) ? 'aria-invalid = "true"' : '';
}

function getError(string $field): void
{
    $data = $_SESSION['validation'][$field];
    unset($_SESSION['validation'][$field]);
    echo $data;
}


function setOldData(string $key, mixed $data): void
{
    $_SESSION['old'][$key] = $data;
}

function getOldDataByKey(string $key): mixed
{
    $data = $_SESSION['old'][$key];
    unset($_SESSION['old'][$key]);
    return $data;
}

function setErrorMessageForAuth(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

function getErrorMessageForAuth(string $key): string
{
    $message = $_SESSION['message'][$key];
    unset($_SESSION['message'][$key]);
    return $message;
}

function hasErrorMessageForAuth(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

function findUserByKey(string $key, string|int $value): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE $key = ?");
    $stmt->execute([$value]);
    return $stmt->fetch();
}

function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('/auth.php');
}

function checkAuth(): void
{
    if (!isset($_SESSION['user']['id'])) {
        redirect('/auth.php');
    }
}

function checkGuest(): void
{
    if (isset($_SESSION['user']['id'])) {
        redirect('/index.php');
    }
}
