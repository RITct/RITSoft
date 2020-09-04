<select>
<?php
$con=mysqli_connect("localhost","root","","ritsoft3");
$sql="select distinct(classid) from subject_allocation where fid='KTU05'";
$ress=mysqli_query($con,$sql);
while($res=mysqli_fetch_array($ress))
{
	$res1=mysqli_query($con,"select * from class_details where classid='$res[classid]' and active='YES'");
	while($rs=mysqli_fetch_array($res1))
	{
?>
<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
<?php
}
}?>
</select>