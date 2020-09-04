<?php
include("includes/connection1.php");
$course=$_REQUEST["course"];
$department=$_REQUEST["department"];
$specialization=$_REQUEST["specialization"];

?>
<select name="semester" class="form-control">
<option value="-">Select</option>
<?php
$res=mysqli_query($con,"select * from class_details where courseid='$course' and deptname='$department' and branch_or_specialisation='$specialization' and active='YES' order by semid asc");
while($rs=mysqli_fetch_array($res))
{
?>
<option value="<?php echo $rs['semid']; ?>"><?php echo $rs["semid"]; ?></option>
<?php	
}
?>
</select>