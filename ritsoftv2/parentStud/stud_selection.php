<?php
session_start();
include("connection.php");
if (isset($_POST['submit'])) {
    $_SESSION['admissionno']=$_POST['studid'];
    echo $_SESSION['admissionno'];
    header("Location:consolidated.php");

}
	
?>
