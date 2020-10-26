<?php
include("../connection.php");
$stud_id = $_GET['id']; 
$id2 = $_GET['id2']; 

$x="Verified";
if($id2==1)
{
	mysql_query("UPDATE stud_details SET image_status='$x' WHERE admissionno='$stud_id'")or die(mysql_error());
	header("Location:photo_verification.php");  // bring back to original page 
}
$y="Rejected";
if($id2==2)
{
	mysql_query("UPDATE stud_details SET image_status='$y' WHERE admissionno='$stud_id'")or die(mysql_error());
	header("Location:photo_verification.php"); 
}

?>
