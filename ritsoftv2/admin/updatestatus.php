 <?php 
	include("../connection.php");
?>
<?php
if (isset($_POST["classid"]) && isset($_POST["status"])) {
	$classid=$_POST["classid"];
	$status=$_POST["status"];
	mysql_query("update class_details set active='$status' where classid='$classid'") or die(mysql_error());
	if($status=='YES')
	echo "Semester made Active";
	else
	echo "Semester made Inactive";
}
?>