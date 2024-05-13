<?php

require_once "../php/db_connection.php";
require_once "../php/utils.php";

$connection = db_connection::get_instance();

session_start();

$sessionId = $_SESSION['code'];

$response = $connection->query("SELECT * FROM `Пользователи` WHERE `id` = $sessionId");

if (!$response) {
    finish(false, "User not found.");
}

$userInfo = $response->fetch_assoc();

if ($userInfo == null) {
    finish(false, "null");
}


if (!$userInfo) {
    var_dump($userInfo);

    finish(false, "no info");
}

$parsedUserInfo = [
    "name" => $userInfo["Логин"], 
    "password" => $userInfo["Пароль"], 
    "address" => $userInfo["Адрес"]
];

finish(true, json_encode($parsedUserInfo));