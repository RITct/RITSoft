<?php
session_start();
include("includes/connection1.php"); 
//$con=mysqli_connect("localhost","root","","ritsoft");
$username=$_SESSION['fid'];
$idd=explode(",",$_REQUEST['id']);
$id=$idd[0];

?>
<script>
alert("<?php echo $id;?>");
</script>
<select name="sub" id="subject" onchange="getbatch(this.value)" class="form-control">
<option>select</option>
<?php
$c=mysqli_query($con,"SELECT * FROM subject_allocation s,subject_class c where c.classid='$id' and s.subjectid=c.subjectid and s.fid='$username'");
while($re=mysqli_fetch_array($c))
{
?>
<option value="<?php echo $re['subjectid']."-".$re['type'];?>"><?php  echo $re['subject_title']."-".$re['type'];?></option>
<?php
}
?>
</select>
