<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
?>



</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;"> SEMESTER NOTIFICATION
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
 <div class="row">
 	<div class="col-md-6">
 		<div class="form-group">
 			<label>Branch</label>
 			<select class="form-control" onchange="getsem()">
 				<option value="">--select--</option>
 				<?php

 				$l=mysql_query("select distinct branch_or_specialisation from class_details where courseid='BTECH' or courseid='BARCH'") or die(mysql_error());
 				while($r=mysql_fetch_assoc($l))
 				{
 					echo '<option value="'.$r["branch_or_specialisation"].'">'.$r["branch_or_specialisation"].'</option>';
 				}

 				?>
 			</select>
 		</div>
 	</div>
 	
<div class="col-md-6">
	<div class="form-group">
 			<label>Semester</label>
 			<select class="form-control">
 				<option value="">--select--</option>
 				<div class="data">
 				</div>

 			</select>
 		</div>
</div>

 </div>

 <div class="row">
 	<div class="col-md-6">
 		<div class="form-group">
 			<label>Registration Start Date</label>
 			<input type="date" class="form-control" name="rsdate">
 		</div>
 	</div>
 	
<div class="col-md-6">
	<div class="form-group">
 			
 				<label>Registration End Date</label>
 			<input type="date" class="form-control" name="redate">
 		</div>
</div>

 </div>
<div class="row">
 	<div class="col-md-6">
 		<div class="form-group">
 			<label>Class Commencement Date</label>
 			<input type="date" class="form-control" name="rsdate">
 		</div>
 	</div>
 	</div>
<div class="row">
	<div class="col-sm-4">
		
	</div>
	<div class="col-sm-4">
		<input type="submit" class="btn btn-primary btn-block" name="">
	</div>
</div>
<br>
<div class="row">
	<div class="col-sm-4">
		
	</div>
	<div class="col-sm-4">
		<input type="reset" class="btn btn-danger btn-block" name="">
	</div>
</div>
</div>
<?php

include("includes/footer.php");
?>