<?php
include "db.php";

$data = json_decode(file_get_contents("php://input"));

$username = $conn->real_escape_string($data->username);
$password = $conn->real_escape_string($data->password);

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($query);

echo json_encode(["success" => $result->num_rows === 1]);
?>
