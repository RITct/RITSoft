<script  src="jquery.js"></script>
<script>
function re()
{
	document.getElementById('form1').submit();	
}
</script>
<form action="sess_verification.php" id="form1" method='post'>
<?php
	include("includes/dbopen.php");
	$studid = $_GET['id']; 
	$clsid=$_GET['clsid'];
	$x="Verified by H.O.D";
	mysql_query("UPDATE sessional_marks SET status='$x' WHERE studid='$studid'")or die(mysql_error());
	//mysql_query("UPDATE stud_sem_registration SET apv_status='$x' WHERE reg_id='$reg_id'")or die(mysql_error());	
?>

<input type="hidden" name="cid" value="<?php echo $clsid ?>">
<?php echo "<script>re()</script>" ?>
</form>
