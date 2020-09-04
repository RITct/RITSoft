<?php 
	include("includes/connection.php");
?>
<?php
if (isset($_POST["classid"]) && isset($_POST["status"])) {
	$classid=$_POST["classid"];
	$status=$_POST["status"];
	mysql_query("update semregstatus set status='$status' where curr_sem='$classid'") or die(mysql_error());
	if($status==1)
	echo "Semester registration started";
	else
	echo "semester registration completed";
}
?>