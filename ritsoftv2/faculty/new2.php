<?php
session_start();
ob_start();
$con=mysqli_connect("localhost","root","","ritsoft2");
$uname=$_SESSION['fid'];

?>
<script>
function getsub(a)
{

 
	document.getElementById('form1').submit();
}


</script>
 <meta charset="utf-8">

<script type="text/javascript" src="js/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link href="css/list.css" rel="stylesheet" />
<!--<link href="css/styles.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" class="sear_frm" >
<tbody>
<tr><td> Class</td>  <td>  
<select name="class" onchange="getsub(this.value)">
<option>select</option>
<?php
echo $a;
$c=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");

while($res=mysqli_fetch_array($c))
{
	$res1=mysqli_query($con,"select *from class_details where classid='$res[classid]' and active='YES'");
	while($rs=mysqli_fetch_array($res1))
	{
?>

<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
<?php
}
}
?>
</select>
</td></tr>
<tr>

<td><label for="spec">Branch</label> </td>
<select name="class" ">
<option>select</option>
<?php
echo $a;
$sid=mysqli_query($con,"select subjectid from subject_allocation where fid='$uname'"); 
$i=0;
while($r=mysqli_fetch_array($sid))
{
	$re=mysqli_query($con,"select subject_title from subject_class where subjectid='$r[i]'");
	$i++;
	while($rs=mysqli_fetch_array($re))
	{
?>

<option value="<?php echo $r['subject_title'];?>">
<?php echo $r['subject_title'];?></option>
<?php
}
}
?>
</select>
</td></tr>
<tr>

</tr>

</form>
