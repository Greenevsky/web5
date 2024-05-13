<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

$connection = db_connection::get_instance();

$data = json_decode(file_get_contents('php://input'), true);

$id = $data["id"];

$result = $connection->query("DELETE FROM `Комплекты` WHERE `id` = $id");

if (!$result) {
    finish(false, "Что-то пошло не так.");
}

finish(true, "success");
