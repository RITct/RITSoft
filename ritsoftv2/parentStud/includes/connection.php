<?php
$servername = "127.0.0.1";
$username = "ritsoftv2";
$password = "ritsoftv2";
$dbname="ritsoftv2";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
