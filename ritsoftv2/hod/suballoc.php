<?php
	include("../connection.php");
	if (isset($_POST['submit'])) {
		$classid=$_POST['classid'];
		$subjectid=$_POST['subjectid'];
		$fid=$_POST['fid'];
		$name=$_POST['name'];
		$type=$_POST['type'];

		$l=mysql_query("select * from subject_allocation where classid='$classid' and subjectid='$subjectid' and fid='$fid'") or die(mysql_error());
		if (mysql_num_rows($l)==1) {
?>
<script type="text/javascript"> alert("Already allotted as Main or Sub Faculty");
      	location.replace("suballoc1.php");
    </script> 

<?php

}
		if ($type=='main') {
		
		$l=mysql_query("select * from subject_allocation where classid='$classid' and subjectid='$subjectid' and type='$type'") or die(mysql_error());
		if (mysql_num_rows($l)==0) {
			
		
		$sql ="insert into subject_allocation(classid,subjectid,fid,type) value('$classid','$subjectid','$fid','$type')";
		
	if(mysql_query($sql) == TRUE)	{
?>

	<script type="text/javascript"> alert("Subject Allotted Successfully");
      	location.replace("suballoc1.php");
    </script> 
		  
	<?php 
			} 
		else	{

	?>
			
	<script type="text/javascript"> alert("Already Subject allocated");
  		location.replace("suballoc1.php");
 	</script>  
   
<?php
	}	
}
else
{
echo "<script>alert('Main Faculty already exists.You can add sub faculty for this subject')</script>";
echo "<script>window.location.href='suballoc1.php'</script>";
}
}
else
{


	$sql ="insert into subject_allocation(classid,subjectid,fid,type) value('$classid','$subjectid','$fid','$type')";
		
	if(mysql_query($sql) == TRUE)	{
?>

	<script type="text/javascript"> alert("Subject Allotted Successfully");
      	location.replace("suballoc1.php");
    </script> 
		  
	<?php 
			} 
		else	{

	?>
			
	<script type="text/javascript"> alert("Already Subject allocated");
  		location.replace("suballoc1.php");
 	</script>  
   
<?php
	}	
}

}
?>
