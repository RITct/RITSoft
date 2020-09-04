<?php
session_start();
ob_start();
//error_reporting(0);
session_destroy();
header("location:login.php");
?>