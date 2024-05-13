<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();

$connection = db_connection::get_instance();

$rawLogin = $_POST["authorization"]["login"];
$password = $_POST["authorization"]["password"];

if (empty($rawLogin) || empty($password)) {
    finish(false, "Все поля должны быть заполнены.");
}

$login = $connection->escape_string($rawLogin);

$searchResult = $connection->query("SELECT * FROM `Пользователи` WHERE `Логин` = '$login'");

$user = $searchResult->fetch_assoc();

if ($user == null) {
    finish(false, "Не удалось найти аккаунт с таким именем.");
}

if (!$user) {
    finish(false, "Нарушено соединение с базой данных.");
}

if ($user["Пароль"] != $password) {
    finish(false, "Неверный пароль.");
}

$_SESSION['code'] = $user['id'];

finish(true, "success");