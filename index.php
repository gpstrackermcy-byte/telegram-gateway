<?php

header("Content-Type: application/json");

$chat_id = $_REQUEST["chat_id"] ?? null;
$message = $_REQUEST["message"] ?? null;

if (!$chat_id || !$message) {
    echo json_encode(["status" => "error", "message" => "Missing chat_id or message"]);
    exit;
}

$token = "8095300410:AAGpr6PK-M97JWjNiCIVkVW7KkKrer5HAsk";

$url = "https://api.telegram.org/bot$token/sendMessage";

$data = [
    "chat_id" => $chat_id,
    "text" => $message
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo json_encode(["status" => "error", "curl_error" => curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);
echo $response;
