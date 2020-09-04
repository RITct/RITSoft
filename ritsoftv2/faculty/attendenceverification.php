<?php
session_start();
$con=mysqli_connect("localhost","root","","ritsoft2");
$st=$_SESSION['uname'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance Verification</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<select name="class">
<option>select</option>
<?php
$res=mysqli_query($con,"select * from department where hod='$st'");
if($rs=mysqli_fetch_array($res))
{
	$res1=mysqli_query($con,"select *from class_details where deptname='$rs[deptname]' and active='YES'");
	while($rs1=mysqli_fetch_array($res1))
	{
?>
<option value="<?php echo $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'];?>">
<?php echo $rs1['courseid'];?>,S<?php echo $rs1['semid'];?>,<?php echo $rs1['branch_or_specialisation'];?></option>
<?php
	}
}
?>
</select>
<input type="date" name="date1" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />
<input type="date" name="date2" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />
<input type="submit" name="btnshow" value="View Attendence"  />
</form>
<?php
if(isset($_POST["btnshow"]))
{
	$class=explode(",",$_POST['class']);
	$date1=$_POST["date1"];
	$date2=$_POST["date2"];	
	//print_r($class);
	$student=explode("-",$class[4]);
	
	?>
    <table border="1" width="100%">
    <tr>
    <td>Roll No</td>
    <td>Name</td>
    <?php
	$res=mysqli_query($con,"select * from subject_allocation where classid='$class[0]' order by subjectid asc");
	while($rs=mysqli_fetch_array($res))
	{
	?>
    <td><?php echo $rs["subjectid"]; ?></td>
    <?php
	}
	?>
    <td>Total</td>
    </tr>
    <?php
	$j=$student[0];
	$k=$student[1];
	while($j<=$k)
	{ 
		
		$res2=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and c.rollno='$j' order by c.rollno asc");
		
		while($rs2=mysqli_fetch_array($res2))
		{
			$i=1;
			$sid=$rs2["rollno"];
			?>           
			<tr>
				<td><?php echo $rs2["rollno"]; ?></td>
				<td><?php echo $rs2["name"]; ?></td>
				<?php
				$total=0;
				$present=0;
				$res3=mysqli_query($con,"select * from subject_allocation where classid='$class[0]' order by subjectid asc");
				while($rs3=mysqli_fetch_array($res3))
				{
					
					$res4=mysqli_query($con,"select * from attendance where studid='$rs2[adm_no]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$class[0]'");
					$res5=mysqli_query($con,"select * from attendance where studid='$rs2[adm_no]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$class[0]' and status='P'");
					?>
              		<td><?php 
					if(mysqli_num_rows($res4)==0)
					echo "0%";
					else
					echo ((mysqli_num_rows($res5)/mysqli_num_rows($res4))*100)."%"; ?></td>
					<?php
					$total+=mysqli_num_rows($res4);
					$present+=mysqli_num_rows($res5);						
				}
				?>
                <td><?php 
				if($total==0)
				echo "0%";
				else
				echo (($present/$total)*100)."%"; ?></td>
			</tr>
			<?php
		}
		$j++;
	}
	?>
</table>
<?php
}
?>

</body>
</html>