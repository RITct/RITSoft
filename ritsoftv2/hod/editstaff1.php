<?php
session_start();
?>

<?php
include("../connection.php");
if (isset($_POST['submit'])) {	
	$staffid=$_SESSION['fidd'];
	$name=strtoupper($_POST['name']);
	$deptname=$_POST['deptname'];	
	$email=$_POST['email'];
	$phoneno=$_POST['phoneno'];
//checking mail id
	$ch="select * from faculty_details where email='$email' and fid !='$staffid';";
	$res=mysql_query($ch);
	if (mysql_num_rows($res) > 0)
	{
		echo'<script type="text/javascript"> alert("Another User Already Exists with the given mail id.");
		location.replace("viewaddstaff.php");
		</script>';
		
	}
	else
	{



		$sql1 ="select email from faculty_details where fid='$staffid'";
		$result = mysql_query($sql1,$con);
		while($row = mysql_fetch_assoc($result)) {
			$pemail= $row['email'];
		}


		if(!$_FILES['file']['tmp_name']=="")
		{
			$photo=addslashes(file_get_contents($_FILES['file']['tmp_name']));
			$sql2 ="update faculty_details set name='$name',deptname='$deptname',email='$email',phoneno='$phoneno', 
			photo='$photo' where fid='$staffid';";

			$sql3 ="update login set username='$email' where username='$pemail'";
		}
		else
		{
			$sql2 ="update faculty_details set name='$name',deptname='$deptname',email='$email',phoneno='$phoneno' where fid='$staffid';";
			$sql3 ="update login set username='$email' where username='$pemail'";
		}

	       //update staff details............				  				   
		if(mysql_query($sql2,$con) == TRUE && mysql_query($sql3,$con) == TRUE) { 
			echo '<script type="text/javascript"> alert("Updated Successfully");
			location.replace("viewaddstaff.php");
			</script> ';    
		}
		else	{
			echo '<script type="text/javascript"> alert("Updation failed");
			location.replace("viewaddstaff.php");
			</script>'; 
			
		}
	}
}
?>

</body>
</html>
