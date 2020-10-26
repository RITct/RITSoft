<?php
	include("../connection.php");
	$staffid=$_GET['staffid'];	
	$l="select email from faculty_details where fid='$staffid';";
	$result=mysql_query($l);
	$row=mysql_fetch_array($result);
	$email=$row['email'];
	//$sql1 ="delete from faculty_designation where fid='$staffid';";	
	//$sql2 ="delete from staff_advisor where fid='$staffid';";	
	$sql3 ="delete from login where username='$email';";	 
	$sql4 ="delete from faculty_details where fid='$staffid';";
	if (mysql_query($sql3)==TRUE && mysql_query($sql4)==TRUE)  {
		echo '<script type="text/javascript"> alert("Deleted Successfully");
        location.replace("viewaddstaff.php");
        </script> ';  
	}
				  
	else {	
		echo '<script type="text/javascript"> alert("Deletion failed");
        location.replace("viewaddstaff.php");
        </script>'; 
	}
?>
</body>
</html>
