<?php
include "db.php";

$data = json_decode(file_get_contents("php://input"));

$username = $conn->real_escape_string($data->username);
$password = $conn->real_escape_string($data->password);

$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "User already exists"]);
} else {
    $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
    echo json_encode(["success" => true]);
}
?>
