<?php
	include("../connection.php");
	
if (isset($_POST['submit'])) {
	$subid=strtoupper($_POST['subid']);
	$name=strtoupper($_POST['name']);
	$classid=$_POST['deptname'];
	$type=strtoupper($_POST['type']);
	$inpass=$_POST['inpass'];
	$inmax=$_POST['inmax'];
	$expass=$_POST['expass'];
	$exmax=$_POST['exmax'];
	
	$check="select * from subject_class where subjectid ='$subid' and classid='$classid'";
	$result=mysql_query($check);
	if (mysql_num_rows($result) > 0) {
?>
	<script type="text/javascript"> alert("Subject Already Exists");
  	location.replace("subreg.php");
  	</script>
<?php
	}
	else
	{
		$sql ="insert into subject_class(subjectid,subject_title,classid,type,internal_passmark,internal_mark,external_pass_mark,external_mark)value('$subid','$name','$classid','$type','$inpass','$inmax','$expass','$exmax')";
		if(mysql_query($sql)== TRUE) { 
?>
		<script type="text/javascript"> alert("Subject Added Successfully");
		location.replace("subreg.php");
		</script>
<?php
		}
		else
		{
?>
		<script type="text/javascript"> alert("Failed");
		location.replace("subreg.php");
        </script> 
<?php	  
	} 
	}}
?>
 
    

