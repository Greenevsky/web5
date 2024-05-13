<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();

$connection = db_connection::get_instance();

$data = json_decode(file_get_contents('php://input'), true);

$sessionId = $_SESSION["code"];

$getUserResponse = $connection->query("SELECT * FROM `Пользователи` WHERE `id` = $sessionId");

if (!$getUserResponse) {
    finish(false, "Пользователь не найден.");
}

$user = $getUserResponse->fetch_assoc();

if ($user == null || $user == false) {
    finish(false, "Пользователь не найден.");
}

$keyboardId = $data["keyboard-id"];
$cartId;

if ($user["Корзина"] == null) {
    $results = $connection->transaction([
        "INSERT INTO `Корзины` VALUES ()",
        "SELECT LAST_INSERT_ID()"
    ]);
    
    $cartId = $results[1]->fetch_row()[0];
    
    $updateUserResult = $connection->query("UPDATE `Пользователи` SET `Корзина` = $cartId WHERE `id` = $sessionId");
}
else {
    $cartId = $user["Корзина"];
}

$createCompilationResult = $connection->query("INSERT INTO `Комплекты`(`Клавиатура`, `Корзина`) VALUES ($keyboardId, $cartId)");