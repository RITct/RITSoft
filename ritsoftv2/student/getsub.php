
<?php
$con=mysqli_connect("localhost","root","","ritsoft1");
session_start();
$username=$_SESSION['unm'];
$idd=explode(",",$_REQUEST['id']);//function is used to Split a string by a specified string into pieces
$id=$idd[0];

?>
<script>
alert("<?php echo $id;?>");
</script>
<select name="sub" >
<option>select</option>
<?php
//.........query for select subject details from subject_class.......... 
$c=mysqli_query($con,"select * from subject_class where classid='$id'");
while($re=mysqli_fetch_array($c))
{

?>
<option value="<?php $subt=$re['subjectid']; echo $re['subjectid'];?>"><?php  echo $re['subject_title'];?></option>
<?php
}
?>
</select>
