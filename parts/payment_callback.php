<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../php/functions.php");

if (!$db) {
    error_log("Database connection failed: " . mysqli_connect_error());
    exit();
}

// Capture PayID19 callback data (for testing, we'll ignore the payload)
$payload = file_get_contents('php://input');
error_log("Raw Payload: " . $payload); // Log the raw payload for debugging
$data = json_decode($payload, true);

// Hardcoded values for testing
$transaction_id = "x00994fg";
$user_email = "audacephilo@gmail.com";
$amount = 10.5;
$currency = "usd";
$status = "success";
$created_at = "2025-02-25 12:00:00"; // Ensure the date format is correct

// Prevent duplicate entries by checking the transaction ID
$check = $db->prepare("SELECT id FROM payment WHERE transaction_id = ?");
$check->bind_param("s", $transaction_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    http_response_code(200);
    die(json_encode(["message" => "Payment already recorded"]));
}

// Insert payment into the database using hardcoded values
$stmt = $db->prepare("INSERT INTO payment (user_email, transaction_id, amount, currency, status, created_at) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssdsss", $user_email, $transaction_id, $amount, $currency, $status, $created_at);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(["message" => "Payment recorded successfully"]);
} else {
    error_log("Database error: " . $stmt->error);
    http_response_code(500);
    echo json_encode(["error" => "Database error"]);
}

$stmt->close();
$db->close();
