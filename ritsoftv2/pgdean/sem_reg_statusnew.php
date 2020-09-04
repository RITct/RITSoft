<?php
/**
 * @Author: indran
 * @Date:   2018-09-09 11:21:16
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-09 11:22:00
 */
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection1.php");
$fid=$_SESSION['fid'];
?>


<script src="jquery.js"></script>

<script type="text/javascript">
	function getclass(a) {

		$('#semme').replaceWith(' <p class="form-control" id="semme" > select branch first </p>');
		$('#data').html(' <p class="alert text-center alert-warning"  > select current semester first </p>');
		$.post("fetchclass_statusnew.php",{ action: 'hours', key : a },
			function(data){ 
				$('#semme').replaceWith(data);
			});
	}
	function doSomeDa(a) { 
		$.post("fetchclass_statusnew.php",{  key: $('#branch').val() , semme : a },
			function(data){ 
				$('#data').html(data);
			});
	}

</script>



<style>
.switch {
	position: relative;
	display: inline-block;
	width: 40px;
	height: 25px;
}

.switch input {display:none;}

.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	-webkit-transition: .4s;
	transition: .4s;
}

.slider:before {
	position: absolute;
	content: "";
	height: 20px;
	width: 20px;
	left: -6px;
	bottom: 3px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
}

input:checked + .slider {
	background-color: #2196F3;
}

input:focus + .slider {
	box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
	-webkit-transform: translateX(26px);
	-ms-transform: translateX(26px);
	transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
	border-radius: 30px;
}

.slider.round:before {
	border-radius: 50%;
}
</style>
<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><span style="text-transform: uppercase;">SEMESTER REGISTRATION    status             
			</span></h1>

		</div>
		<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label>Branch</label>
				<select class="form-control" id="branch" onchange="getclass(this.value)">
					<option value="" selected disabled>--select--</option>
					<?php 
					$l=mysql_query("select distinct branch_or_specialisation as branch ,courseid from class_details where courseid='MTECH' or courseid='MCA'") or die(mysql_error());
					while ($r=mysql_fetch_assoc($l)) {
						echo '<option value="'.$r["courseid"].'-'.$r["branch"].'">'.$r["branch"].'</option>';
					}

					?>
				</select>
			</div>
		</div>


		<div class="col-md-4">
			<label>Academic Year</label>
			<div class="form-control">
				<?php
				$l=mysql_query("select acd_year from academic_year where status=1");
				$r=mysql_fetch_assoc($l);
				echo $r["acd_year"];
				?>
			</div>
		</div>


		<div class="col-md-4">
			<div class="form-group">
				<label>Current Semester</label>
				<p class="form-control" id="semme" > select branch first </p>
			</div>
		</div>


	</div>




	<div id="data"></div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->   
<?php
include("includes/footer.php");
?>
