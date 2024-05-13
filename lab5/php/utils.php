<?php

function finish(bool $success, string $message) {
    $scriptResponse = [
        "success" => $success,
        "message" => $message
    ];

    die(json_encode($scriptResponse));
}