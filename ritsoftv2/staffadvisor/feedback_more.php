<?php
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");
	$i=1;
$hodid=$_SESSION['fid'];
//...........select department of login hod
$sql=mysql_query("select deptname from faculty_details where fid='$fid'");
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$deptname=$result['deptname'];
//.........select classid
$sql=mysql_query("select classid from staff_advisor where fid='$fid'");
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$clsid=$result['classid'];
//.......current date
$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
			$r=mysql_fetch_assoc($l);
			$prev=$r["acd_year"];
//.........select academic years other than current year 
$ch=mysql_query("select acdyear from feedback_index where acdyear!='$prev'",$con);
$chr=mysql_num_rows($ch);
if($chr<1)
{
	echo "<script type='text/javascript'>alert('Previous Year Results Were Not Found')</script>";
	echo "<script>window.location.href='staff_feedback.php'</script>";
}


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

//selection based on academic year
/////////////////////////////////////////////////
?>
<label>Choose Academic Year :</label>

 <select name="yeardrop" class="form-group form-control" required="required">
                    <option name="--select--"></option>
<?php
//.......choose academic year to populate dropdown
$sql="select acdyear from feedback_index where deptname='$deptname' and acdyear!='$prev' and 
subjectid in(select subjectid from subject_class where classid='$clsid')";
$r=mysql_query($sql,$con);
while ($result=mysql_fetch_array($r))
{
echo '<option value="'.$result['acdyear'].'">'.$result['acdyear'].'</option>' ;
  }
  ?>						
</select>
 </div>
<input type="submit" class="btn btn-primary" name="submit" value="Submit" align="middle"/>
</br>
<?php
$year="";
 if(isset($_POST["submit"]))
{
	 $year=$_POST['yeardrop'];
	 ?>
 <div class="row">
                <div class="col-lg-12">
	<br>		
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
/////////////////////////////////////////////////////////
//......select mark of faculties of chosen department
$sql1=mysql_query("SELECT f.fid, f.subjectid, f.indexmark,f.acdyear,sc.subject_title, fd.name
FROM feedback_index f, subject_class sc, faculty_details fd
WHERE f.fid = fd.fid
AND f.subjectid = sc.subjectid AND sc.classid='$clsid' 
AND f.deptname ='$deptname' and f.acdyear='$year'",$con);
while ($re=mysql_fetch_array($sql1))
{
	$vf=$re['fid'];
	$nm=$re['name'];
	$im=$re['indexmark'];
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
	<a href="staff_feedback_individual.php? subid=<?php echo $subid ?> & ay=<?php echo $ay;?>">VIEW</a>
	</td>
	<td>
	<a href="staff_pdf.php? subid=<?php echo $subid;?> & ay=<?php echo $ay;?>">CREATE</a>
	</td>
	</tr>
	<?php
}
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
