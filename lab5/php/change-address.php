<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();
$connection = db_connection::get_instance();

$data = json_decode(file_get_contents('php://input'), true);

$rawValue = $data["value"];

if (strlen($rawValue) < 4) {
    finish(false, "Минимальная длинна - 4 символа.");
}

$value = $connection->escape_string($rawValue);

$checkResult = $connection->query("SELECT 1 FROM `Пользователи` WHERE `Адрес` = '$value'");

if ($checkResult->fetch_assoc() != null) {
    finish(false, "Это имя уже занято.");
}

$sessionId = $_SESSION["code"];

$updateResult = $connection->query("UPDATE `Пользователи` SET `Адрес` = '$value' WHERE `id` = $sessionId");

if (!$updateResult) {
    finish(false, "Что-то пошло не так.");
}

finish(true, "success");