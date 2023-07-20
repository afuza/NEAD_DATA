<?php
header("Content-Type: application/json");

$data = [
    "status" => "success",
    "message" => "Hayo Ngapain Broo"
];

echo json_encode($data, JSON_PRETTY_PRINT);
