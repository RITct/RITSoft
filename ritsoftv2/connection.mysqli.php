<?php
$host = getenv("MYSQL_HOST") ?: "127.0.0.1";
$user = getenv("MYSQL_USER") ?: "ritsoftv2";
$password = getenv("MYSQL_PASSWORD") ?: "ritsoftv2";
$db = getenv("MYSQL_DB") ?: "ritsoftv2";

// Create connection
$conn = new mysqli($host, $user, $password, $db);
$con3 = $conn;

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
