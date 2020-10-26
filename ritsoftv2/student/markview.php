<?php
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");
$admissionno=$_SESSION["admissionno"];
?>
<script src="jquery.js"></script>

<script type="text/javascript">
function fetchsub(a)
{
	$.post("getmark.php",{ key : a},
	function(data){
		$('#data').html(data);
	});
}
</script>

                

		<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><b>UNIVERSITY MARKS VIEW</b></h1>
			</div>
			</div>
		 <div class="table-responsive">
			<table   class="table table-hover table-bordered" >
                <tr>
					<th style="text-align: center;"> NAME</th>
                    <th style="text-align: center;"> ADMISSION NUMBER</th>
                    <th style="text-align: center;"> COURSE</th>
                </tr>
				
				<?php 
					$query="select distinct(name),admissionno,courseid from stud_details join current_class where admissionno='$admissionno'";	
		
			$res=mysql_query($query);
			$row =mysql_fetch_assoc($res);
						echo '<td style="text-align: center;">'.$row['name'].'</td>';
						echo '<td style="text-align: center;">'.$row['admissionno'].'</td>';
						echo '<td  style="text-align: center;">'.$row['courseid'].'</td>';
				?>
				
				
				
			</table>
			</div>
			
	<form id="form1" name="form1" method="post"  enctype="multipart/form-data" class="sear_frm" >
	  <div class="form-row">
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
	 
		</div>
<div id="data">
</div>


<?php

include("includes/footer.php");
?>