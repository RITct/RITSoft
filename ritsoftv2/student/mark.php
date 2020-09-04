<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");

if(isset($_POST["markpost"]))
{
	$studid=$_SESSION['admissionno'];//session variable
	if(isset($_POST["registerno"]))
		$registerno=$_POST["registerno"];
	$key=$_POST["semester"];

	$l=mysql_query("SELECT class_details.semid from  class_details where class_details.classid='$key'");
	
	$r=mysql_fetch_assoc($l);
	$sem=$r["semid"];
	$l=mysql_query("SELECT  subject_class.subjectid,subject_class.subject_title,external_mark FROM subject_class WHERE subject_class.classid = '$key'") or die(mysql_error());
   // $l1=mysql_query("SELECT subject_class.external_mark FROM subject_class WHERE subject_class.classid = '$key'") or die(mysql_error());
	while($r=mysql_fetch_assoc($l))
	{
		
		$s=trim($r["subjectid"]);
		//echo "<script>alert('$s')</script>";
		if(isset($_POST[$s]))
		{
		$mark=$_POST[$s];
		
		
		if(isset($_SESSION["edit"]))
		{
			if($_SESSION["edit"]==0)
			{
			//if(isset($_POST[$l1>='$mark']))
		//........Query for insert semester,registerno,subject_code,studid and mark into university_mark table........		
		mysql_query("INSERT INTO `university_mark`(`semester`, `registerno`, `subject_code`, `mark`,`studid`) VALUES('$key','$registerno','$s','$mark','$studid')") or die(mysql_error());
			}
			else
				mysql_query("update university_mark set mark='$mark' where subject_code='$s' and studid='$admissionno'") or die(mysql_error());

			}
			
		}
		}
		

	
	

echo "<script>alert('Marks entered')</script>";
//echo "<script>window.location.href='markview.php'</script>";
//echo "<script>window.location.href='markview.php'</script>";

}
	

	
?>

<script src="jquery.js"></script>

<script type="text/javascript">
function fetchsub(a)
{
	$.post("getsubject.php",{ key : a},
	function(data){
		$('#data').html(data);
	});
}
</script>


  
      <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><b>UNIVERSITY MARKS SUBMISSION</b></h1>
			</div>
	  <form id="form1" name="form1" method="post"  enctype="multipart/form-data" class="sear_frm" >
	  
	  
  
	  <div class="form-group col-md-6">
      <label>SEMESTER</label>
   <select class="form-control" onchange="fetchsub(this.value)" name="semester">
   <option  value="">--select--</option>
    <?php	$l=mysql_query("SELECT class_details.semid,class_details.classid  FROM class_details,stud_details WHERE stud_details.courseid=class_details.courseid and class_details.branch_or_specialisation=stud_details.branch_or_specialisation and stud_details.admissionno='$admissionno'") or die(mysql_error()); 
	
	while($r=mysql_fetch_assoc($l))
	{
	echo '<option  value="'.$r["classid"].'">'.$r["semid"].'</option>';	
		
	}
	
	?>

	</select>
    </div>
	

	
	
<div id="data">
             
			 
 </div>

	<?php

include("includes/footer.php");
?>