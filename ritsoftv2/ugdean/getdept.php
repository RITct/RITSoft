<?php
include("../connection.mysqli.php");
$course=$_REQUEST["course"];
?>
<select name="dept" onChange="getspecialization('<?php echo $course; ?>',this.value)" class="form-control">
<option value="-">Select</option>
<?php
$res=mysqli_query($con,"select distinct(deptname) from class_details where courseid='$course'");
while($rs=mysqli_fetch_array($res))
{
?>
<option value="<?php echo $rs['deptname']; ?>"><?php echo $rs["deptname"]; ?></option>
<?php	
}
?>
</select>