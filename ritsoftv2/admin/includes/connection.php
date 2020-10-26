<?php
$host = getenv("MYSQL_HOST") ?: "127.0.0.1";
$user = getenv("MYSQL_USER") ?: "ritsoftv2";
$password = getenv("MYSQL_PASSWORD") ?: "ritsoftv2";
$db = getenv("MYSQL_DB") ?: "ritsoftv2";
$con=mysql_connect($host, $user, $password, $db)or die("server not found");
mysql_select_db("ritsoftv2",$con)or die("database not found");
?>
