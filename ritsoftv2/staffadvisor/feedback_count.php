<?php
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");
$classid=$_SESSION['classid'];
//.......select department of login hod
$sql=mysql_query("select * from class_details where classid='$classid'");
$result=mysql_fetch_array($sql);
$deptname1=$result['deptname'];
$semid1=$result['semid'];

//$sql=mysql_query("select classid from staff_advisor where fid='$fid'");
//if($sql)
//{
	//$result=mysql_fetch_array($sql);
//}
//$clsid=$result['classid'];

?>
<html>
<head>
<title>
Feedback Count
</title>


</head>
<body>
<br>
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Feedback Count</h1>
                    </div>
				</div>
				<form method="post">
<?php
//current date
//$acdyear=date("Y");
//$prev=$acdyear-1;
//$prev.="-".$acdyear;
//.............select number of students responded to the questionnaire based class of login staff advisor 

$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
	$r=mysql_fetch_assoc($l);
	$acd_year=$r["acd_year"];

$sql=mysql_query("SELECT m.subjectid,sc.subject_title,fd.fid,fd.name,m.acdyear,COUNT( distinct m.responseid) as cnt FROM mainfeedback m,faculty_details fd,subject_class sc,subject_allocation sa WHERE m.fid=sa.fid and m.subjectid=sa.subjectid and sa.classid='$classid' and sa.fid=fd.fid and m.subjectid=sc.subjectid and m.fid=fd.fid and m.deptname='$deptname1' and m.semid='$semid1' and m.acdyear='$acd_year' group by m.fid,m.subjectid,m.deptname,m.semid");

/*$sql=mysql_query("SELECT sc.subjectid, sc.subject_title, fs.acdyear, count( fs.studid ) as cnt
FROM subject_class sc, feedback_stud fs
WHERE fs.subjectid = sc.subjectid  AND fs.acdyear = '$acd_year'
AND sc.classid = '$classid' group by sc.subjectid");*/
$chr=mysql_num_rows($sql);
if($chr>=1)
{
	
	?>
		 <div class="row">
                <div class="col-lg-12">
			
	<div class=".col-sm-6 .col-md-5 .col-md-offset-2 .col-lg-6 .col-lg-offset-0">
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <th>Subject id</th>
	 <th>Subject title</th><th>Faculty ID</th>

           <th>Faculty Name</th>

	 <th>Academic Year</th>
    <th>Number of Students Responded</th>
	</tr>

	<?php
while ($re=mysql_fetch_array($sql))
{
	$sid=$re['subjectid'];
	$st=$re['subject_title'];
        $fid1=$re['fid'];
        $name1=$re['name'];
	$y=$re['acdyear'];
	$count=$re['cnt'];
	
	//display into table
	?>

	
	<tr>
	<td>
	<?php
	echo $sid;
	?>
	</td>
	<td>
	<?php
	echo $st;
	?>
	</td>
   <td>
	<?php
	echo $fid1;
	?>
	</td>

        <td>
	<?php
	echo $name1;
	?>
	</td>

		<td>
	<?php
	echo $y;
	?>
	</td>

	<td>
	<?php
	echo $count;
	?>
	</td>
	</tr>
	<?php

}
}
else
{
		echo "<script type='text/javascript'>alert('No Records')</script>";

}
?>
	</table>
	</table>
 </div>
                       
                    </div>
                  
            </div>

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



	
	
	
	
	
