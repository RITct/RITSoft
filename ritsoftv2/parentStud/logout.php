<?php
ob_start();
session_start();
//error_reporting(0);
session_destroy();
header("location:../login.php");
?>