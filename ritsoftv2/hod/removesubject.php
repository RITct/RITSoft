
<?php
	include("../connection.php");
	$subjectid=$_GET['subjectid'];	
	$classid=$_GET['classid'];	 
	$sql ="delete from subject_class where subjectid='$subjectid' and classid='$classid';";
	if (mysql_query($sql)==TRUE)  {
		echo '<script type="text/javascript"> alert("Deleted Successfully");
        location.replace("subject_view.php");
        </script> ';  
	}
				  
	else {	
		echo '<script type="text/javascript"> alert("Deletion failed");
        location.replace("subject_view.php");
        </script>'; 
	}
?>
