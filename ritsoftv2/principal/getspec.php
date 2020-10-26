
<?php
include("../connection.mysqli.php");


$course=$_REQUEST["course"];
$department=$_REQUEST["department"];

?>
<select name="spec" onChange="getsemester('<?php echo $course; ?>','<?php echo $department; ?>',this.value)" class="form-control">
<option value="-">Select</option>
<?php
$res=mysqli_query($con,"select distinct(branch_or_specialisation) from class_details where courseid='$course' and deptname='$department'");
while($rs=mysqli_fetch_array($res))
{
?>
<option value="<?php echo $rs['branch_or_specialisation']; ?>"><?php echo $rs["branch_or_specialisation"]; ?></option>
<?php	
}
?>
</select>