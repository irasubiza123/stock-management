<?php
include "db.php";
header("Content-Type: application/json");

// Get raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Validate fields
if (!$data || !isset($data['name'])) {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
    exit;
}

// DB config
$host = "localhost";
$user = "root";
$pass = "";
$db = "stock_system";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

// Escape data
$name = $conn->real_escape_string($data['name']);
$qty = (int) $data['quantity'];
$cost = (float) $data['costPrice'];
$sell = (float) $data['sellingPrice'];
$category = $conn->real_escape_string($data['category']);
$expiry = $conn->real_escape_string($data['expiryDate']);
$added = $conn->real_escape_string($data['addedDate']);

$sql = "INSERT INTO stock_items (name, quantity, cost_price, selling_price, category, expiry_date, added_date)
        VALUES ('$name', $qty, $cost, $sell, '$category', '$expiry', '$added')";

if ($conn->query($sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}

$conn->close();
?>
