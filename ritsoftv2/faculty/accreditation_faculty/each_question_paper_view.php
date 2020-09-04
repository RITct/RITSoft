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


	if(isset( $_POST['seriesno'] ) AND isset( $_POST['classid'] ) AND isset( $_POST['subjectid'] ) )
	{
			$new_qno = $_POST['new_qno'];
			$new_question = $_POST['new_question'];
			$new_maxmark = $_POST['new_maxmark'];
			$new_part = $_POST['new_part'];
			$new_choice = $_POST['new_choice'];
			$seriesno = $_POST['seriesno'];
			$classid = $_POST['classid'];

			$subjectid = $_POST['subjectid'];
			$old_qno = $_POST['old_qno'];
			$old_question = $_POST['old_question'];
			$old_maxmark = $_POST['old_maxmark'];
			$old_part = $_POST['old_part'];
			$old_choice = $_POST['old_choice'];


					$query = " DELETE FROM each_question_paper WHERE seriesno = $seriesno AND classid = '$classid' AND  subjectid = '$subjectid' AND qno='$old_qno'  ";

			mysqli_query($con,$query) or die(mysqli_error($con));

			$query ="INSERT INTO  each_question_paper(`seriesno`, `classid`, `subjectid`,`part`, `qno`, `question`,`maxmark`,`choice`) values('$seriesno','$classid','$subjectid','$new_part','$new_qno', '$new_question','$new_maxmark','$new_choice')";

			mysqli_query($con,$query) or die(mysqli_error($con));

			$i++;
		}

	if($i > 0) {
		echo '<script type="text/javascript"> alert("Update Successfully");</script>';
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-ui.js" type="text/javascript"></script>
<head>

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

				<h3 class="tittle"><center>View/Edit Question paper</center></h3>
				<div class="contact-grids" align="center">
					<form method="post" action="">

						<div class="col-md-8 contact-grid" style="text-align:center">
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

										</div> </td></tr>

										<tr style="height: 50px;">
											<td>Series No</td>
											<td>
												<div id="seriesno">
													<select name="seriesno" class="form-control">
														<option >select</option>
														<option value="1">1</option>
														<option value="2">2</option>
													</select>
												</div>
											</td>
										</tr>

										<tr></tr>
										<tr>
											<td></td>
											<td><input type="submit" id="btnshow" name="btnshow" class="btn btn-primary" action="each_series_mark_view.php" value="View Questions" disabled="disabled"/>  
											</td></tr>
									</tbody>
								</table>

							</form>
							</div>
							<div class="col-md-offset-1 col-md-8 contact-grid" style="text-align:center">

							<?php if(isset($_POST["btnshow"])):?>

								<?php

								$a=explode(",",$_POST['class']);
								$b=explode("-",$_POST['sub']);
								$seriesno=$_POST['seriesno'];
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
													<td><?php echo $seriesno; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<?php
//$con=mysql_connect("localhost","root","","ritsoft2");
								include("connection.php");
								if(isset($_POST['btnshow']) && isset($_POST['class']) && isset($_POST['sub']))
								{
									?>
									<div class="table-responsive">
										<table class="table table-hover table-bordered">
											<tr>
												<td>Question number</td>
												<td>Question</td>
												<td>Max Marks</td>
												<td>Part</td>
												<td>Choice</td>
												<td>Edit</td>
											</tr>

											<?php

											$noData = true;
											$res=mysqli_query($con,"SELECT * FROM each_question_paper  where classid='".$a[0]."' and  subjectid='".$b[0]."'  and seriesno = $seriesno  order BY d_date DESC LIMIT 1");

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

												//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno,d.sessional_marks FROM stud_sem_registration a,stud_details b,current_class c,sessional_marks d where a.classid='$a[0]' and a.new_seum='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and d.subjectid='$b' and d.studid=b.admissionno order by c.rollno asc");

//	$res=mysql_query("SELECT a.adm_no as adno,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");

													$i=0;
														$r=mysqli_query($con,"select * from each_question_paper where subjectid='$b[0]' and seriesno = $seriesno  ");
														while(	$x=mysqli_fetch_assoc($r))
														{?>
														<tr>
															<td><?php echo $x["qno"]; ?></td>
															<td><?php echo $x["question"]; ?></td>
															<td><?php echo $x["maxmark"]; ?></td>
															<td><?php echo $x["part"]; ?></td>
															<td><?php echo $x["choice"]; ?></td>

															<td>
																<button class="btn btn-xs btn-info editsomeitng" type="button" name="edit">Edit</button>

																<form accept="" method="post" onsubmit=" return confirm('Do you really want to update mark?');">
																	<?php foreach ($_POST as $key => $value): ?>
																		<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value; ?>">
																	<?php endforeach; ?>




																	<input type="hidden" name="seriesno" value="<?php echo $x['seriesno'] ?>">
																	<input type="hidden" name="classid" value="<?php echo $x['classid'] ?>">
																	<input type="hidden" name="subjectid" value="<?php echo $x['subjectid'] ?>">
																	<input type="hidden" name="old_qno" class="old_qno" value="<?php echo $x['qno'] ?>">
																	<input type="hidden" name="old_question" class="old_question" value="<?php echo $x['question'] ?>">
																	<input type="hidden" name="old_maxmark" class="old_maxmark" value="<?php echo $x['maxmark'] ?>">
																	<input type="hidden" name="old_part" class="old_part" value="<?php echo $x['part'] ?>">
																	<input type="hidden" name="old_choice" class="old_choice" value="<?php echo $x['choice'] ?>">

																	<div class="editDiv" style=" position: absolute; background: rgba(231, 231, 231, 0.87); padding: 0.5rem; min-width: 300px; z-index: 999; right: 3%; border: 1px solid blue; display: none; ">
																		<div class="form">
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Question no:</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="number" step=".01" name="new_qno" class="form-control new_something new_qno" min="0" max="100" value="<?php echo $x['qno'] ?>">
																				</div>
																			</div>
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Question</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="text" class="form-control new_something  new_question" name="new_question" value="<?php echo $x['question'] ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Maximum mark</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="text" class="form-control new_something  new_mark" name="new_maxmark" value="<?php echo $x['maxmark'] ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Part</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="text" class="form-control new_something  new_part" name="new_part" value="<?php echo $x['part'] ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">Choice</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="text" class="form-control new_something  new_choice" name="new_choice" value="<?php echo $x['choice'] ?>" />
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
													}
														$i++;
													}
												}
												?>

											<tr>



												<!--- <td><input type="submit" name="submit" value="Enter Mark"/></td>  </tr>--->


										</tr>
									</table>
									</div>
								</body>

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

				if($this.closest('td').find('.new_qno').val() != $this.closest('td').find('.old_qno').val() ){
					$new = true;
				}
				if($this.closest('td').find('.new_question').val() != $this.closest('td').find('.old_question').val() ){
					$new = true;
				}
				if($this.closest('td').find('.new_maxmark').val() != $this.closest('td').find('.old_maxmark').val() ){
					$new = true;
				}
				if($this.closest('td').find('.new_part').val() != $this.closest('td').find('.old_part').val() ){
					$new = true;
				}
				if($this.closest('td').find('.new_choice').val() != $this.closest('td').find('.old_choice').val() ){
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
