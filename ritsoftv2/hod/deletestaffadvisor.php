<?php
	include("../connection.php");
	$staffid=$_GET['staffid'];
	$clid=$_GET['clid'];
	
	//check the no of advisorship (advisor of only one class, then delete from designation)
	$ch="select * from staff_advisor where fid='$staffid';";
		$r=mysql_query($ch);
	if (mysql_num_rows($r)==1){
		
		$sql2 =mysql_query("delete from faculty_designation where fid='$staffid' and designation like '%advisor';");
		}
			
				 
	$sql1 ="delete from staff_advisor where fid='$staffid' and classid='$clid';";
	
	
	
	//$sql2="delete from faculty_designation where fid='$staffid' and designation like '%advisor%';";
	
	if(mysql_query($sql1) == TRUE) { 
		echo '<script type="text/javascript"> alert("Deleted Successfully");
        location.replace("viewstaffadvisor.php");
        </script> ';  
	}
				  
	else {	
		echo '<script type="text/javascript"> alert("Deletion failed");
        location.replace("viewstaffadvisor.php");
        </script>'; 
	}
?>
