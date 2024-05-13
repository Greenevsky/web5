<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();
$connection = db_connection::get_instance();

$data = json_decode(file_get_contents('php://input'), true);

$rawLogin = $data["value"];

if (strlen($rawLogin) < 4) {
    finish(false, "Минимальная длинна - 4 символа.");
}

$login = $connection->escape_string($rawLogin);

$checkResult = $connection->query("SELECT 1 FROM `Пользователи` WHERE `Логин` = '$login'");

if ($checkResult->fetch_assoc() != null) {
    finish(false, "Это имя уже занято.");
}

$sessionId = $_SESSION["code"];

$updateResult = $connection->query("UPDATE `Пользователи` SET `Логин` = '$login' WHERE `id` = $sessionId");

if (!$updateResult) {
    finish(false, "Что-то пошло не так.");
}

finish(true, $rawLogin);