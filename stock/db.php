<?php
$host = "localhost";
$user = "root"; // or your DB username
$pass = "";     // or your DB password
$db   = "stock_system";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
