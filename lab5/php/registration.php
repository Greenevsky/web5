<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

$rawLogin = $_POST["registration"]["login"];
$rawPassword = $_POST["registration"]["password"];
$rawAddress = $_POST["registration"]["address"];

if (empty($rawLogin) || empty($rawPassword) || empty($rawAddress)) {
    finish(false, "Все поля должны быть заполнены.");
}

$connection = db_connection::get_instance();

$login = $connection->escape_string($rawLogin);
$password = $connection->escape_string($rawPassword);
$address = $connection->escape_string($rawAddress);

$result = $connection->query("SELECT 1 FROM `Пользователи` WHERE `Логин` = '$login'");

if ($result->fetch_assoc() != null) {
    finish(false, "Пользователь с таким именем уже существует.");
}

$response = $connection->transaction([
    "INSERT INTO `Пользователи` (`Логин`, `Пароль`, `Адрес`) VALUES ('$login', '$password', '$address')",
    "SELECT LAST_INSERT_ID()"
]);

if (!$response) {
    finish(false, "Что-то пошло не так.");
}

session_start();

$_SESSION['code'] = $response[1]->fetch_row()[0];

require_once "../php/assign-new-cart.php";

finish(true, $_SESSION['code']);
