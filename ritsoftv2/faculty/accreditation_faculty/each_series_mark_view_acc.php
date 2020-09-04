<?php
//$con=mysqli_connect("localhost","root","","ritsoft2");
include("connection.php");
//session_start();
//$uname=$_SESSION['fid'];

include("includes/header.php");
include("includes/sidenav.php");



$uname=$_SESSION['fid'];

$se = true;
?>



<?php

if (isset($_POST['updateme'])) {
	// var_dump($_POST);
	$i = 0;


	if(isset( $_POST['series_no'] ) AND isset( $_POST['classid'] ) AND isset( $_POST['subjectid'] ) AND isset( $_POST['studid'] ) ) {


			$new_mark1 = $_POST['new_mark1'];
			$new_mark2 = $_POST['new_mark2'];
			$new_mark3 = $_POST['new_mark3'];
			$new_mark4 = $_POST['new_mark4'];
			$new_mark5 = $_POST['new_mark5'];
			$new_mark6 = $_POST['new_mark6'];
			$new_mark7 = $_POST['new_mark7'];
			$new_mark8 = $_POST['new_mark8'];
			$new_mark9 = $_POST['new_mark9'];
			$new_mark10 = $_POST['new_mark10'];

			$remarka = $_POST['new_sessional_remarks'];

			$series = $_POST['series_no'];
			$classid = $_POST['classid'];
			$studid = $_POST['studid'];
			$subjectid = $_POST['subjectid'];
			$mark1 = $_POST['mark1'];
			$mark2 = $_POST['mark2'];
			$mark3 = $_POST['mark3'];
			$mark4 = $_POST['mark4'];
			$mark5 = $_POST['mark5'];
			$mark6 = $_POST['mark6'];
			$mark7 = $_POST['mark7'];
			$mark8 = $_POST['mark8'];
			$mark9 = $_POST['mark9'];
			$mark10 = $_POST['mark10'];
			$sessional_remark = $_POST['sessional_remark'];

			$query = "DELETE FROM each_series_marks WHERE series_no = '$series' AND classid = '$classid' AND  studid = '$studid' AND  subjectid = '$subjectid'   ";

	 			 	mysqli_query($con,$query) or die(mysqli_error($con));

$query ="INSERT INTO  each_series_marks(`series_no`,`classid`,`studid`,`subjectid`,`q1`,`q2`,`q3`,`q4`,`q5`,`q6`,`q7`,`q8`,`q9`,`q10`,`sessional_remark`) values('$series','$classid','$studid','$subjectid','$new_mark1','$new_mark2','$new_mark3','$new_mark4','$new_mark5','$new_mark6','$new_mark7','$new_mark8','$new_mark9','$new_mark10' ,'$remarka')";


				mysqli_query($con,$query) or die(mysqli_error($con));


			// $query = " UPDATE each_sessional_marks SET sessional_marks = '$marka' , sessional_remark = '$remarka', sessional_date = NOW() WHERE series_no = $series AND classid = '$classid' AND  studid = '$studid' AND  subjectid = '$subjectid' AND sessional_marks = '$sessional_marks' AND sessional_remark = '$sessional_remark' ";

			// mysql_query($query) or die(mysql_error());
			$i++;
		}


	if($i > 0) {
		echo '<script type="text/javascript"> alert("Update Successfully");</script>';
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <script src="jquery.js" type="text/javascript"></script>
  <script src="jquery-ui.js" type="text/javascript"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Marks</title>
	<script>
		function showsub(str)
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.open("GET","getsub.php?id="+str,true);
			xmlhttp.send();
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("sub").innerHTML=xmlhttp.responseText;

				}
			}
		}
	</script>

		<script>
		$(document).ready(function() {

				$("#sub").change(function () {
					var str = "";

					if ($("#sub option:selected").val()=='')
					{
	                //$("#errmsg").html("Please select subject");
	                 //$().message("Select subject!");
	                 $('#btnshow').attr('disabled', 'disabled');
	             }
	             else
	             {

	             	$('#btnshow').removeAttr('disabled');
	             }
	         });
			});

		</script>
	</head>
<div id="page-wrapper">
	<body>


		<div class="map_contact">
			<div class="container">

				<h3 class="tittle"><center>View/Edit Series mark</center></h3>
				<div class="contact-grids" align="center">
					<form method="post" action="">


						<div class="col-md-offset-1 col-md-8 contact-grid" style="text-align:center">

							<table  align="center" width="700" style="cellspacing:2px;">
								<tbody>
									<tr><td> Class</td>  <td>
										<select name="class" class="form-control" onchange="showsub(this.value)">
											<option>select</option>
											<?php
											$c=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");

											while($res=mysqli_fetch_array($c))
											{
												$res1=mysqli_query($con,"select * from class_details where classid='$res[classid]' and active='YES'");
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


										<tr style="height: 50px;">
											<td>Subject </td>
											<td>
												<div id="sub">
											<select name="sub" class="form-control" >
												<option>select</option>
											</select>

										</div> </td>
									</tr>

										<tr style="height: 50px;">
											<td>Series No</td>
											<td>
												<div id="series">
													<select name="series" id="series" class="form-control">
														<option selected disabled>select</option>
														<option value="1">1</option>
														<option value="2">2</option>
													</select>
												</div>
											</td>
										</tr>

										<tr><td></td>
											<td>
												<input type="submit" id="btnshow" name="btnshow" class="btn btn-primary" action="each_series_mark_view.php" value="View marks"  disabled="disabled" />
											</td>
									</tbody>
								</table>

							</form>

							<?php if(isset($_POST["btnshow"])):?>

								<?php

								$a=explode(",",$_POST['class']);
								$b=explode("-",$_POST['sub']);
								$series=$_POST['series'];
								?>
								<div class="row" style="margin-top: 1rem;">
									<div class="col-sm-12">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>Class</td>
													<td><?php echo $a[1] . " - " . $a[2] . " - " . $a[3]; ?></td>
												</tr>
												<tr>
													<td>Subject</td>
													<td><?php
															// echo $b[0] . " - " . $b[1];
													$res22=mysqli_query($con,"SELECT * FROM subject_class where subjectid='$b[0]' LIMIT 1 ");
													$i=0;
													while($rs=mysqli_fetch_array($res22))
													{
														echo $rs["subject_title"];
													}
													?></td>
												</tr>
												<tr>
													<td>Series No</td>
													<td><?php echo $series; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
					</div>
									<div class="col-md-offset-0 col-md-10 contact-grid" style="text-align:center">

								<?php
//$con=mysql_connect("localhost","root","","ritsoft2");
								include("connection.php");
								if(isset($_POST['btnshow']) && isset($_POST['class']) && isset($_POST['sub']))
								{
									?>
									<div class="table-responsive">
										<table class="table table-hover table-bordered">
											<tr>
												<td>Roll No</td>
												<td>Name</td>
												<td>Mark1</td>
												<td>Mark2</td>
												<td>Mark3</td>
												<td>Mark4</td>
												<td>Mark5</td>
												<td>Mark6</td>
												<td>Mark7</td>
												<td>Mark8</td>
												<td>Mark9</td>
												<td>Mark10</td>
												<td>Remark</td>
												<td>Edit</td>
											</tr>

											<?php
											$noData = true;
											$res=mysqli_query($con,"SELECT * FROM each_series_marks  where classid='".$a[0]."' and  subjectid='".$b[0]."'  and series_no = $series  order BY  sessional_date DESC LIMIT 1");


											if(mysqli_num_rows($res)>0){
												$noData = false;
											}
											if($noData) {
												echo '<script type="text/javascript"> alert("Nothing to show");</script>';
											} else {

												?>
												<input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
												<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="b"/>
												<?php

												if($b[1]=='ELECTIVE')
												{
													$res22=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,elective_student e where c.classid='$a[0]' and c.studid=b.admissionno and e.sub_code='$b[0]' and e.stud_id=c.studid order by c.rollno asc");
													$i=0;
													while($rs=mysqli_fetch_array($res22))
													{
														$aid=$rs["studid"];

														$r=mysqli_query("select *  from each_series_marks where subjectid='$b[0]' and studid='$aid' AND series_no = $series  ");
														$x=mysqli_fetch_assoc($r);
														?>
														<tr>
															<td><?php echo $rs["rollno"]; ?></td>
															<td><?php echo $rs["name"]; ?></td>
															<td><?php echo $x["q1"]; ?></td>
															<td><?php echo $x["q2"]; ?></td>
															<td><?php echo $x["q3"]; ?></td>
															<td><?php echo $x["q4"]; ?></td>
															<td><?php echo $x["q5"]; ?></td>
															<td><?php echo $x["q6"]; ?></td>
															<td><?php echo $x["q7"]; ?></td>
															<td><?php echo $x["q8"]; ?></td>
															<td><?php echo $x["q9"]; ?></td>
															<td><?php echo $x["q10"]; ?></td>
															<td>  <?php echo $x["sessional_remark"]; ?></td>
															<td>
																<button class="btn btn-xs btn-info editsomeitng" type="button" name="edit">Edit</button>
																<!--  -->

																<form accept="" method="post"  onsubmit=" return confirm('Do you really want to update mark?');">
																	<?php foreach ($_POST as $key => $value): ?>
																		<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value; ?>">
																	<?php endforeach; ?>




																	<input type="hidden" name="series_no" value="<?php echo $series; ?>">
																	<input type="hidden" name="classid" value="<?php echo $a[0]; ?>">
																	<input type="hidden" name="studid" value="<?php echo $aid; ?>">
																	<input type="hidden" name="subjectid" value="<?php echo $b[0]; ?>">


																	<input type="hidden" name="mark1" class="old_sessional_marks" value="<?php echo $x['q1'] ?>">
																	<input type="hidden" name="mark2" class="old_sessional_marks" value="<?php echo $x['q2'] ?>">
																	<input type="hidden" name="mark3" class="old_sessional_marks" value="<?php echo $x['q3'] ?>">
																	<input type="hidden" name="mark4" class="old_sessional_marks" value="<?php echo $x['q4'] ?>">
																	<input type="hidden" name="mark5" class="old_sessional_marks" value="<?php echo $x['q5'] ?>">
																	<input type="hidden" name="mark6" class="old_sessional_marks" value="<?php echo $x['q6'] ?>">
																	<input type="hidden" name="mark7" class="old_sessional_marks" value="<?php echo $x['q7'] ?>">
																	<input type="hidden" name="mark8" class="old_sessional_marks" value="<?php echo $x['q8'] ?>">
																	<input type="hidden" name="mark9" class="old_sessional_marks" value="<?php echo $x['q9'] ?>">
																	<input type="hidden" name="mark10" class="old_sessional_marks" value="<?php echo $x['q10'] ?>">

																	<input type="hidden" name="sessional_remark" class="old_sessional_remark" value="<?php echo $x['sessional_remark'] ?>">

																	<div class="editDiv" style=" position: absolute; background: rgba(231, 231, 231, 0.87); padding: 0.5rem; min-width: 300px; z-index: 999; right: 3%; border: 1px solid blue; display: none; ">
																		<div class="form">
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Mark1</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="number" step=".01" name="new_mark1" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q1'] ?>">
																				</div>
																			</div>
																				<div class="form-group row">
																					<div class="col-xs-3">
																					<label class="form-label">Mark2</label>
																				</div>
																				<div class="col-xs-9">
																				<input type="number" step=".01" name="new_mark2" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q2'] ?>">
																			</div>
																			</div>
																			<div class="form-group row">
																				<div class="col-xs-3">
																				<label class="form-label">Mark3</label>
																			</div>
																			<div class="col-xs-9">
																				<input type="number" step=".01" name="new_mark3" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q3'] ?>">
																		</div>
																		</div>
																		<div class="form-group row">
																			<div class="col-xs-3">
																				<label class="form-label">Mark4</label>
																			</div>
																		<div class="col-xs-9">
																			<input type="number" step=".01" name="new_mark4" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q4'] ?>">
																	</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-xs-3">
																			<label class="form-label">Mark5</label>
																		</div>
																	<div class="col-xs-9">
																		<input type="number" step=".01" name="new_mark5" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q5'] ?>">
																</div>
																</div>
																<div class="form-group row">
																	<div class="col-xs-3">
																		<label class="form-label">Mark6</label>
																	</div>
																<div class="col-xs-9">
																	<input type="number" step=".01" name="new_mark6" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q6'] ?>">
															</div>
															</div>
															<div class="form-group row">
																<div class="col-xs-3">
																	<label class="form-label">Mark7</label>
																</div>
															<div class="col-xs-9">
																<input type="number" step=".01" name="new_mark7" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q7'] ?>">
														</div>
														</div>
														<div class="form-group row">
															<div class="col-xs-3">
																<label class="form-label">Mark8</label>
															</div>
														<div class="col-xs-9">
															<input type="number" step=".01" name="new_mark8" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q8'] ?>">
													</div>
													</div>
													<div class="form-group row">
														<div class="col-xs-3">
															<label class="form-label">Mark9</label>
														</div>
													<div class="col-xs-9">
														<input type="number" step=".01" name="new_mark9" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q9'] ?>">
												</div>
												</div>
												<div class="form-group row">
													<div class="col-xs-3">
														<label class="form-label">Mark10</label>
													</div>
												<div class="col-xs-9">
													<input type="number" step=".01" name="new_mark10" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q10'] ?>">
											</div>
											</div>
																			<div class="form-group row">
																				<div class="col-xs-2">
																					<label class="form-label">Remark</label>
																				</div>
																				<div class="col-xs-10">
																					<textarea class="form-control new_something  new_sessional_remarks" name="new_sessional_remarks" ><?php echo $x['sessional_remark'] ?></textarea>
																				</div>
																			</div>
																			<div class="form-group row text-center">
																				<div class=" col-xs-5 text-right">
																					<button class="btn btn-xs btn-warning hiddenThis" type="button" name="updateme">hide</button>
																				</div><div class="col-xs-offset-1 col-xs-5">
																					<button class="btn btn-xs btn-info" type="submit" name="updateme">update</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</form>


															</td>


														</tr>
														<?php

														$i++;
													}


												}
												else
												{



	//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno,d.sessional_marks FROM stud_sem_registration a,stud_details b,current_class c,sessional_marks d where a.classid='$a[0]' and a.new_seum='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and d.subjectid='$b' and d.studid=b.admissionno order by c.rollno asc");

//	$res=mysql_query("SELECT a.adm_no as adno,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
													$res=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");

													$i=0;
													while($rs=mysqli_fetch_array($res))
													{
														$aid=$rs["studid"];

														$r=mysqli_query($con,"select * from each_series_marks where subjectid='$b[0]' and studid='$aid' and  series_no = $series  ");
														$x=mysqli_fetch_assoc($r);
														?>
														<tr>
															<td><?php echo $rs["rollno"]; ?></td>
															<td><?php echo $rs["name"]; ?></td>
															<td><?php echo $x["q1"]; ?></td>
															<td><?php echo $x["q2"]; ?></td>
															<td><?php echo $x["q3"]; ?></td>
															<td><?php echo $x["q4"]; ?></td>
															<td><?php echo $x["q5"]; ?></td>
															<td><?php echo $x["q6"]; ?></td>
															<td><?php echo $x["q7"]; ?></td>
															<td><?php echo $x["q8"]; ?></td>
															<td><?php echo $x["q9"]; ?></td>
															<td><?php echo $x["q10"]; ?></td>
															<td><?php echo $x["sessional_remark"]; ?></td>
															<td>
																<button class="btn btn-xs btn-info editsomeitng" type="button" name="edit">Edit</button>

																<form accept="" method="post" onsubmit=" return confirm('Do you really want to update mark?');">
																	<?php foreach ($_POST as $key => $value): ?>
																		<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value; ?>">
																	<?php endforeach; ?>

																	<input type="hidden" name="series_no" value="<?php echo $x['series_no'] ?>">
																	<input type="hidden" name="classid" value="<?php echo $x['classid'] ?>">
																	<input type="hidden" name="studid" value="<?php echo $x['studid'] ?>">
																	<input type="hidden" name="subjectid" value="<?php echo $x['subjectid'] ?>">
																	<input type="hidden" name="mark1" class="old_sessional_marks" value="<?php echo $x['q1'] ?>">
																	<input type="hidden" name="mark2" class="old_sessional_marks" value="<?php echo $x['q2'] ?>">
																	<input type="hidden" name="mark3" class="old_sessional_marks" value="<?php echo $x['q3'] ?>">
																	<input type="hidden" name="mark4" class="old_sessional_marks" value="<?php echo $x['q4'] ?>">
																	<input type="hidden" name="mark5" class="old_sessional_marks" value="<?php echo $x['q5'] ?>">
																	<input type="hidden" name="mark6" class="old_sessional_marks" value="<?php echo $x['q6'] ?>">
																	<input type="hidden" name="mark7" class="old_sessional_marks" value="<?php echo $x['q7'] ?>">
																	<input type="hidden" name="mark8" class="old_sessional_marks" value="<?php echo $x['q8'] ?>">
																	<input type="hidden" name="mark9" class="old_sessional_marks" value="<?php echo $x['q9'] ?>">
																	<input type="hidden" name="mark10" class="old_sessional_marks" value="<?php echo $x['q10'] ?>">

																	<input type="hidden" name="sessional_remark" class="old_sessional_remark" value="<?php echo $x['sessional_remark'] ?>">
																	<div class="editDiv" style=" position: absolute; background: rgba(231, 231, 231, 0.87); padding: 0.5rem; min-width: 300px; z-index: 999; right: 3%; border: 1px solid blue; display: none; ">
																		<div class="form">
																			<div class="form-group row">

																					<div class="col-xs-3">
																						<label class="form-label">Mark1</label>
																					</div>
																					<div class="col-xs-9">
																						<input type="number" step=".01" name="new_mark1" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q1'] ?>">
																					</div>
																				</div>
																					<div class="form-group row">
																						<div class="col-xs-3">
																						<label class="form-label">Mark2</label>
																					</div>
																					<div class="col-xs-9">
																					<input type="number" step=".01" name="new_mark2" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q2'] ?>">
																				</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-xs-3">
																					<label class="form-label">Mark3</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="number" step=".01" name="new_mark3" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q3'] ?>">
																			</div>
																			</div>
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Mark4</label>
																				</div>
																			<div class="col-xs-9">
																				<input type="number" step=".01" name="new_mark4" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q4'] ?>">
																		</div>
																		</div>
																		<div class="form-group row">
																			<div class="col-xs-3">
																				<label class="form-label">Mark5</label>
																			</div>
																		<div class="col-xs-9">
																			<input type="number" step=".01" name="new_mark5" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q5'] ?>">
																	</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-xs-3">
																			<label class="form-label">Mark6</label>
																		</div>
																	<div class="col-xs-9">
																		<input type="number" step=".01" name="new_mark6" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q6'] ?>">
																</div>
																</div>
																<div class="form-group row">
																	<div class="col-xs-3">
																		<label class="form-label">Mark7</label>
																	</div>
																<div class="col-xs-9">
																	<input type="number" step=".01" name="new_mark7" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q7'] ?>">
															</div>
															</div>
															<div class="form-group row">
																<div class="col-xs-3">
																	<label class="form-label">Mark8</label>
																</div>
															<div class="col-xs-9">
																<input type="number" step=".01" name="new_mark8" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q8'] ?>">
														</div>
														</div>
														<div class="form-group row">
															<div class="col-xs-3">
																<label class="form-label">Mark9</label>
															</div>
														<div class="col-xs-9">
															<input type="number" step=".01" name="new_mark9" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q9'] ?>">
													</div>
													</div>
													<div class="form-group row">
														<div class="col-xs-3">
															<label class="form-label">Mark10</label>
														</div>
													<div class="col-xs-9">
														<input type="number" step=".01" name="new_mark10" class="form-control new_something new_sessional_mark" min="0" max="100" value="<?php echo $x['q10'] ?>">
												</div>
												</div>
													<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Remark</label>
																				</div>
																				<div class="col-xs-9">
																					<textarea class="form-control new_something  new_sessional_remarks" name="new_sessional_remarks" ><?php echo $x['sessional_remark'] ?></textarea>
																				</div>
																			</div>
																			<div class="form-group row text-center">
																				<div class=" col-xs-5 text-right">
																					<button class="btn btn-xs btn-warning hiddenThis" type="button" name="updateme">hide</button>
																				</div><div class="col-xs-offset-1 col-xs-5">
																					<button class="btn btn-xs btn-info" type="submit" name="updateme">update</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</form>


															</td>


														</tr>
														<?php

														$i++;
													}
												}
											}	?>

											<tr>



												<!--- <td><input type="submit" name="submit" value="Enter Mark"/></td>  </tr>--->
											</table>
											<?php
										}
										?>
										<!--<tr><td><!--<input type="submit" name="btnsave" value="save"  /> -->

										</tr>
									</div>
								</body>
							</table>
						</div>


					<?php endif; ?>

				</div>

			</div>

		</div>
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function($) {
			$('.editsomeitng').click(function(event) {
				event.preventDefault();
				$('.editDiv').css('display', 'none');
				$this = $(this);
				$this.closest('td').find('.editDiv').css('display', 'block');
				$this.closest('td').find('*[type=submit]').attr('disabled', 'disabled');

			});


			$('.hiddenThis').click(function(event) {
				event.preventDefault();
				$('.editDiv').css('display', 'none');
			});

			$(document).on('keyup change', '.new_something', function(event) {
				event.preventDefault();
				$this = $(this);
				$new = false;

				if($this.closest('td').find('.new_sessional_remarks').val() != $this.closest('td').find('.old_sessional_remark').val() ){
					$new = true;
				}
				if($this.closest('td').find('.new_sessional_mark').val() != $this.closest('td').find('.old_sessional_marks').val() ){
					$new = true;
				}
				if($new) {
					$this.closest('td').find('*[type=submit]').removeAttr('disabled');
					$this.closest('td').find('*[type=submit]').css('background', '');
				} else {
					$this.closest('td').find('*[type=submit]').attr('disabled', 'disabled');
					$this.closest('td').find('*[type=submit]').css('background', 'red');
				}

			});

		});
	</script>



</body>

</html>

<?php

include("includes/footer.php");
?>
