<?php
session_start();
//$con=mysqli_connect("localhost","root","","ritsoft3");
include("includes/connection1.php"); 
$username=$_SESSION['fid'];
$idd=explode(",",$_REQUEST['id']);
$id=$idd[0];

?>
<script>
alert("<?php echo $id;?>");
</script>
<select class="form-control" name="sub" >
<option>select</option>
<?php
$c=mysqli_query($con,"SELECT * FROM subject_allocation s,subject_class c where c.classid='$id' and s.subjectid=c.subjectid and s.fid='$username' and s.type='main'");
while($re=mysqli_fetch_array($c))
{

?>
<option value="<?php echo $re['subjectid']."-".$re['type'];?>"><?php  echo $re['subject_title']."-".$re['type'];?></option>
<!--<option value="<?php //$subt=$re['subjectid']; echo $re['subjectid'];?>"><?php  //echo $re['subject_title'];?></option>-->
<?php
}
?>
</select>
