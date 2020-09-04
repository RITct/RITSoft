<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
$i=1;
$classid=$_SESSION["classid"];

//select department of login hod
$sql=mysql_query("select deptname from faculty_details where fid='$fid'");
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$deptname=$result['deptname'];

//$sql=mysql_query("select classid from staff_advisor where fid='$fid'");
//if($sql)
//{
	//$result=mysql_fetch_array($sql);
//}
//$clsid=$result['classid'];
	 //status checking
	 $sql=mysql_query("select status from feedback_status where classid='$classid' and deptname='$deptname'");
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$st=$result['status'];
if($st==1)
{
	echo "<script type='text/javascript'>alert('You Are Not Allowed to View the Results')</script>";
	echo "<script>window.location.href='dash_home2.php'</script>";
}
if($st==0)
{

//////
	?>
	<html>
<head>
<title>
feedback_results
</title>
</head>
<body>
<br>
 <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Faculty Performance</h1>
                    </div>
				</div>

								<form method="post">
<?php


////////
//current date
$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
			$r=mysql_fetch_assoc($l);
			$prev=$r["acd_year"];
//selection based on academic year
//echo $prev;
//select mark of faculties of chosen department

/*$sql1=mysql_query("SELECT f.fid, f.subjectid, f.indexmark,f.acdyear,sc.subject_title, fd.name
FROM feedback_index f, subject_class sc, faculty_details fd
WHERE f.fid = fd.fid
AND f.subjectid = sc.subjectid AND sc.classid='$classid' 
AND f.deptname ='$deptname' and f.acdyear='$prev'");*/
$sql1=mysql_query("SELECT f.fid, f.subjectid, f.indexmark,f.acdyear,sc.subject_title, fd.name
FROM feedback_index f, subject_class sc, faculty_details fd,subject_allocation sa
WHERE f.fid = fd.fid
AND f.subjectid = sc.subjectid AND sc.classid='$classid' 
AND f.deptname ='$deptname' and f.acdyear='$prev' and sa.fid=fd.fid and sa.fid=f.fid and sa.classid='$classid' and sa.subjectid=f.subjectid");

$chr=mysql_num_rows($sql1);
if($chr>=1)
{
	?>
		 <div class="row">
                <div class="col-lg-12">
			
	<div class=".col-sm-6 .col-md-5 .col-md-offset-2 .col-lg-6 .col-lg-offset-0">
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <th>Sl no.</th>
	 <th>Faculty id</th>
    <th>Name</th>
	<th>Subject</th>
	<th>Academic Year</th>
	<th>Index Mark</th>
	<th>View Datasheet</th>
	<th>Create pdf</th>
	</tr>
	<?php
	
while ($re=mysql_fetch_array($sql1))
{
	$vf=$re['fid'];
	$nm=$re['name'];
	$im=round($re['indexmark'],2);
	$ay=$re['acdyear'];
	$st=$re['subject_title'];
	$subid=$re['subjectid'];
	//display into table
	?>

	
	<tr>
	<td>
	<?php
	echo $i;
	$i = $i + 1;
	?>
	</td>
	<td>
	<?php
	echo $vf;
	?>
	</td>
	<td>
	<?php
	echo $nm;
	?>
	</td>
	<td>
	<?php
	echo $st;
	?>
	</td>
	<td>
	<?php
	echo $ay;
	?>
	</td>
	<td>
	<?php
	echo $im;
	?>
	</td>
	<td>
	<a href="staff_feedback_individual.php? subid=<?php echo $subid;?> & ay=<?php echo $ay;?> & classid1=<?php echo $classid;?> & fid=<?php echo $vf;?>">VIEW</a>
	</td>
	<td>
	<a href="staff_pdf.php? subid=<?php echo $subid;?> & ay=<?php echo $ay;?> & classid1=<?php echo $classid;?> & fid=<?php echo $vf;?>" target="_blank">CREATE</a>
	</td>
	</tr>
	<?php
}
}
else
{
			echo "<script type='text/javascript'>alert('No Records')</script>";

}
}//close if st=1
?>
	
	
	</table>
	</table>
 </div>
                       
                    </div>
                  
            </div>
<!-- <a href="feedback_more.php">View Previous Feedback</a> -->


	<center>
<!-- <input type="button" name="close" value="Close">-->
 </center>
 </body>
 </div>
                <!-- /.row -->
 </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        </div>
    <!-- /#wrapper --> 

</html>
<?php
include("includes/footer.php");
?>
