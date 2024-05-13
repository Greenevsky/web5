<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();

$connection = db_connection::get_instance();

$sessionId = $_SESSION["code"];

$result = $connection->query("SELECT * FROM `Заказы` WHERE `Пользователь` = $sessionId");

if (!$result) {
    finish(false, "Что-то пошло не так.");
}

$rows = [];

while (($row = $result->fetch_assoc()) != null) {
    $formattedRow = [
        "order_id" => $row["id"],
        "order_time" => $row["Время_заказа"],
        "order_price" => $row["Стоимость"],
        "products" => []    
    ];

    $cartId = $row["Корзина"];

    $getCompilationsResult = $connection->query("SELECT `Клавиатура` FROM `Комплекты` WHERE `Корзина` = $cartId");
    
    while (($compilation = $getCompilationsResult->fetch_assoc()) != null) {
        $keyboardId = $compilation["Клавиатура"];
        $getKeyboardResult = $connection->query("SELECT * FROM `Клавиатуры` WHERE `id` = $keyboardId");

        while (($keyboard = $getKeyboardResult->fetch_assoc()) != null) {
            $keyboardFormattedRow = [
                "id" => $keyboard["id"],
                "name" => $keyboard["Название"],
                "keys_amount" => $keyboard["Количество_клавиш"],
                "creation_time" => $keyboard["Время_создания"],
                "developer" => $keyboard["Производитель"],
                "width" => $keyboard["Ширина_см"],
                "length" => $keyboard["Длина_см"],
                "height" => $keyboard["Высота_см"],
                "price" => $keyboard["Цена"]
            ];

            array_push($formattedRow["products"], $keyboardFormattedRow);
        }
    }

    array_push($rows, $formattedRow);
}

finish(true, json_encode($rows));