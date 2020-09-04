<?php
 include("includes/connection1.php");
if(isset($_POST['key']))
{
	$key=$_POST['key'];	
    $r=mysql_query("select fid from faculty_details where name= '$key'",$con);
    if(mysql_num_rows($r) == 0){
	//if(mysql_num_rows($r) == 0)	{
		echo "<script>alert('Faculty not found')</script>";
		echo '<input disabled="disabled" class="form-control" autocomplete="off" type="text" name="fid"/>';
		 echo  '<input  name="fid" type="hidden" />';
	}
	else {
      $row=mysql_fetch_assoc($r);
      echo  '<input disabled="disabled" class="form-control" list="fid" name="fid" type="text" value="'.$row['fid'].'"/>';
      echo  '<input  name="fid" type="hidden" value="'.$row['fid'].'"/>';
    }
}
?>

