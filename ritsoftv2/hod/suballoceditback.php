<?php
include("includes/connection1.php");
if (isset($_POST["submit"])) {
	$subjectid=$_POST["subjectid"];
	$staffid=$_POST["fid"];
	$classid=$_POST["classid"];
	$oldfid=$_POST["oldfid"];
	$type=$_POST["type"];


	if($type=="main")
{

	$l=mysql_query("select * from subject_allocation where classid='$classid' and subjectid='$subjectid' and fid='$staffid' and type='main'") or die(mysql_error());
	if (mysql_num_rows($l)>0)
	{
		
	if(mysql_query("update subject_allocation set fid='$staffid',type='$type' where classid='$classid' and subjectid='$subjectid' and fid='$oldfid'"))
	
		echo "<script>alert('Subject Allocation Updated')</script>";
	
	else
		echo "<script>alert('Subject Allocation Failure')</script>";
	echo "<script>window.location.href='suballoc_view.php'</script>";

	}
	else
	{
		$l=mysql_query("select * from subject_allocation where classid='$classid' and subjectid='$subjectid' and fid!='$staffid' and type='main'") or die(mysql_error());
		if (mysql_num_rows($l)>0) 
		{
			echo "<script>alert('Only one main faculty allowed')</script>";
			echo "<script>window.location.href='suballoc_view.php'</script>";
			die();
		}
	}
			
	if(mysql_query("update subject_allocation set fid='$staffid', type='$type' where classid='$classid' and subjectid='$subjectid' and fid='$oldfid'"))
	
		echo "<script>alert('Subject Allocation Updated')</script>";
	
	else
		echo "<script>alert('Subject Allocation Failure')</script>";
	echo "<script>window.location.href='suballoc_view.php'</script>";

}
else

{

	if(mysql_query("update subject_allocation set fid='$staffid', type='$type' where classid='$classid' and subjectid='$subjectid' and fid='$oldfid'"))
	
		echo "<script>alert('Subject Allocation Updated')</script>";
	
	else
		echo "<script>alert('Subject Allocation Failure')</script>";
	echo "<script>window.location.href='suballoc_view.php'</script>";
}
	
	
}
?>