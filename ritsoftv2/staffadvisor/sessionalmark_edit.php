<?php
include("../connection.php");
$studid = $_GET['id']; 
$x="verified by staff advisor";
mysql_query("UPDATE sessional_marks SET status='$x' WHERE studid='$studid'")or die(mysql_error());
	header("Location:sessionalmark_verification.php");  // bring back to original page 
	?>
