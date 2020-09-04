<?php
session_start();
include("includes/connection3.php"); 
//$con=mysqli_connect("localhost","root","","ritsoft");
//error_reporting(0);
$username=$_SESSION['fid'];
$idd=explode(",",$_REQUEST['id']);
$id=$idd[0];

?>
<script>
	alert("<?php echo $id;?>");
</script>
<select name="sub" id="subject" onchange="getbatch(this.value)" class="form-control" required="required">
	<option selected="selected" disabled="disabled" value="-1">select</option>
	<?php
	$c=mysqli_query($con3,"SELECT * FROM subject_allocation s,subject_class c where c.classid='$id' and s.subjectid=c.subjectid and s.fid='$username' and s.type='main' and s.classid=c.classid");
	while($re=mysqli_fetch_array($c))
	{
		?>
		<option value="<?php echo $re['subjectid']."-".$re['type']."-".$re['classid'];?>"><?php  echo $re['subject_title']."-".$re['type'];?></option>
		<?php
	}
	?>
</select>
