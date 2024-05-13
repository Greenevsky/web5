<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();

$connection = db_connection::get_instance();

$sessionId = $_SESSION["code"];

$getCartIdResponse = $connection->query("SELECT `Корзина` FROM `Пользователи` WHERE `id` = $sessionId");

if (!$getCartIdResponse) {
    finish(false, "Нарушено соединение с базой данных.");
}

$cartId = $getCartIdResponse->fetch_assoc()["Корзина"];

$getItemsResponse = $connection->query("SELECT * FROM `Комплекты` WHERE `Корзина` =  $cartId");

if (!$getCartIdResponse) {
    finish(false, "Нарушено соединение с базой данных.");
}

$rows = [];

while (($row = $getItemsResponse->fetch_assoc()) != null) {
    array_push($rows, $row);
}

finish(true, json_encode($rows));