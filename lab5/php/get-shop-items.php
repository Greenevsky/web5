<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

$connection = db_connection::get_instance();

$data = json_decode(file_get_contents('php://input'), true);

$result;

if ($data != null) {
    $escapedValue = $connection->escape_string($data["value"]);
    $filter = match($data["filter"]) {
        "Название" => "Название",
        "Количество Клавиш" => "Количество_клавиш",
        "Длина" => "Длина_см",
        "Ширина" => "Ширина_см",
        "Высота" => "Высота_см",
        "Цена" => "Цена"      
    };

    $result = $connection->query("SELECT * FROM `Клавиатуры` WHERE `$filter` LIKE '%$escapedValue%'");
}
else {
    $result = $connection->query("SELECT * FROM `Клавиатуры`");
}

if (!$result) {
    finish(false, "Что-то пошло не так.");
}

$rows = [];

while (($row = $result->fetch_assoc()) != null) {
    array_push($rows, $row);
}

finish(true, json_encode($rows));