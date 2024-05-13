<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

$connection = db_connection::get_instance();

$result = $connection->query("SELECT COUNT(*) FROM `Заказы`");

if ($result == false) {
    finish(false, "Что-то пошло не так.");
}

finish(true, strval($result->fetch_array()[0]));

?>