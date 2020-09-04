<?php
	include("includes/connection1.php");	
	
if (isset($_POST['submit'])) {
	
	$classid=$_POST['deptname'];
	$fid=$_POST['fid'];
	$list=$_POST['list'];
	
	$check="select * from staff_advisor where students_list = '$list' and classid = '$classid' and fid='$fid'"; 
	$result=mysql_query($check);
	if (mysql_num_rows($result) > 0) {
?>
	<script type="text/javascript"> alert("Staff Advisor Already Alloted to this Class");
  	location.replace("staffreg.php");
  	</script>
<?php
	}
	else
	{
		$sql1 ="insert into staff_advisor(classid,fid,students_list)value('$classid','$fid','$list')";
		//insert designation staff advisor if not exists
		
		$ch="select * from faculty_designation where fid='$fid' and designation like '%advisor'";
		$r=mysql_query($ch);
	if (mysql_num_rows($r)==0){
		
		$sql2 =mysql_query("insert into faculty_designation(fid,designation)value('$fid','staff advisor')");
		}
		
		
		//$sql3 ="insert into faculty_designation(fid,designation)value('$fid','faculty')";
		if(mysql_query($sql1)== TRUE) { 
?>
		<script type="text/javascript"> alert("Staff Advisor Added Successfully");
		location.replace("staffreg.php");
		</script>
<?php
		}
		else
		{
?>
		<script type="text/javascript"> alert("Failed");
		location.replace("staffreg.php");
        </script> 
<?php	  
	} 
	}}
?>
 
    

