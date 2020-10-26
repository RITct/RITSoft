
<?php
include("../connection.php");
$staffid=$_GET['staffid'];
$classid=$_GET['classid'];
$subjectid=$_GET['subid'];	
$type=$_GET['type'];
	 
$sql ="delete from subject_allocation where fid='$staffid'and classid='$classid' and subjectid='$subjectid' and type='$type';";
if (mysql_query($sql)==TRUE)  {
	echo '<script type="text/javascript"> alert("Deleted Successfully");
	location.replace("suballoc_view.php");
	</script> ';  
}

else {	
	echo '<script type="text/javascript"> alert("Deletion failed");
	location.replace("suballoc_view.php");
	</script>'; 
}
?>
