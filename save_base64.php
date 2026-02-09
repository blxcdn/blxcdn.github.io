<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Read base64
$base64 = file_get_contents("php://input");
$base64 = preg_replace('/\s+/', '', $base64);

// Decode
$image = base64_decode($base64, true);
if ($image === false) {
    http_response_code(400);
    die("Decode failed");
}

// Save file
$dir = __DIR__ . "/test_output";
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$file = $dir . "/test_" . time() . ".png";
file_put_contents($file, $image);

echo "OK";
