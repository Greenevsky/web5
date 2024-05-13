<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

session_start();

$connection = db_connection::get_instance();

$data = json_decode(file_get_contents('php://input'), true);

$id = $data["id"];

$result = $connection->query("SELECT * FROM `Клавиатуры` WHERE `id` = $id");

if (!$result) {
    finish(false, "Нарушено соединение с базой данных.");
}

finish(true, json_encode($result->fetch_assoc()));

