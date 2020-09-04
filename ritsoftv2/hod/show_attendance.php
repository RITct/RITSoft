<?php
session_start();
include("includes/dbopen.php");
$uname=$_SESSION['fid'];
if(strlen($_REQUEST['class'])>1 && strlen($_REQUEST["date"])>1)
{
	$a=explode(",",$_REQUEST['class']);
	$date=$_REQUEST["date"];
	
	
	?>
<table class="table table-hover table-bordered">
      <tr>
        <th rowspan="2" scope="col">Roll No</th>
        <th rowspan="2" scope="col">Name</th>
        <th scope="col">Hour 1</th>
        <th scope="col">Hour 2</th>
        <th scope="col">Hour 3</th>
        <th scope="col">Hour 4</th>
        <th scope="col">Hour 5</th>
        <th scope="col">Hour 6</th>
      </tr>
      <tr>
      	<?php
		for($i=1;$i<=6;$i++)
		{
			?>
            <th align="center"> <?php
			$res=mysqli_query($con3,"select * from subject_class c,attendance a where a.subjectid=c.subjectid and a.hour='$i' and a.date='$date' and a.classid='$a[0]'");
			if($rs=mysqli_fetch_array($res))
			{
				if($rs["type"]=="ELECTIVE")
				       echo "ELECTIVE";
				else
					echo $rs["subject_title"];	 
			}
			else
				echo "--";				
			?></th>
            <?php
		}
		?>
      </tr>
      <?php
//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
$res=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");

$i=1;
while($rs=mysqli_fetch_array($res))
{
$sid=$rs["rollno"];
?>
      <tr>
        <td><?php echo $rs["rollno"]; ?></td>
      <td><?php echo $rs["name"]; ?></td>
      
        <?php
		for($i=1;$i<=6;$i++)
		{
			?>
            <td align="center"> <?php
			$res1=mysqli_query($con3,"select * from attendance where hour='$i' and date='$date' and studid='$rs[studid]' and classid='$a[0]'");
			if($rs1=mysqli_fetch_array($res1))
				echo $rs1["status"];
			else
				echo "--";				
			?></td>
            <?php
		}
		?>
      </tr>
      <?php
}
?>
    </table></td>
  </tr>
</table>
<?php
}
else
{
	?>
    <table class="table table-hover table-bordered">
      <tr>
        <th rowspan="2" scope="col">Roll No</th>
        <th rowspan="2" scope="col">Name</th>
        <th scope="col">Hour 1</th>
        <th scope="col">Hour 2</th>
        <th scope="col">Hour 3</th>
        <th scope="col">Hour 4</th>
        <th scope="col">Hour 5</th>
        <th scope="col">Hour 6</th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" align="center"><strong>No Data To Display</strong></td>
      </tr>
    </table></td>
  </tr>
</table>
    <?php
}
?>
<?php include("includes/footer.php");   ?>
