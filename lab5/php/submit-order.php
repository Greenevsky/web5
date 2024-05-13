<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();

$connection = db_connection::get_instance();

$data = json_decode(file_get_contents('php://input'), true);

$sessionId = $_SESSION["code"];

$getUserResponse = $connection->query("SELECT * FROM `Пользователи` WHERE `id` = $sessionId");
if (!$getUserResponse) {
    finish(false, "Что-то пошло не так.");
}

$user = $getUserResponse->fetch_assoc();

$getCartIdResponse = $connection->query("SELECT `Корзина` FROM `Пользователи` WHERE `id` = $sessionId");
if (!$getCartIdResponse) {
    finish(false, "Что-то пошло не так.");
}

$time = time();
$cartId = $getCartIdResponse->fetch_assoc()["Корзина"];
$userId = $user["id"];
$price = $data["price"];

$response = $connection->query("INSERT INTO `Заказы`(`Время_заказа`, `Корзина`, `Пользователь`, `Стоимость`) VALUES ($time, $cartId, $userId, $price)");

if (!$response) {
    finish(false, "Что-то пошло не так.");
}

finish(true, "success");