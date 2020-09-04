<?php

/**
 * @Author: indran
 * @Date:   2018-10-18 16:37:29
 * @Last Modified by:   indran
 * @Last Modified time: 2018-10-19 11:51:11
 */
// each_series_mark_view

?><?php
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
	if(isset( $_POST['assignment'] ) AND isset( $_POST['classid'] ) AND isset( $_POST['subjectid'] ) ) {

		// if($_POST['topic'] != $_POST['new_topic'] || $_POST['co'] != $_POST['new_co'] ) {

			$topic= $_POST['new_topic'];
			$co = $_POST['new_co'];

			$assignment = $_POST['assignment'];
			$classid = $_POST['classid'];
			$subjectid = $_POST['subjectid'];
			$topicid = $_POST['old_topic_id'];
			$old_topic = $_POST['old_topic'];
			$old_co=$_POST['old_co'];

			$query = " DELETE FROM each_assignment_topic WHERE assignmentno = $assignment AND classid = '$classid' AND  subjectid = '$subjectid' AND topicid='$topicid' ";

			mysqli_query($con,$query) or die(mysqli_error($con));

			$query ="INSERT INTO  each_assignment_topic(`assignmentno`, `classid`, `subjectid`, `topicid`, `topic`,`co`) values('$assignment','$classid','$subjectid','$topicid','$topic', '$co')";
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

				<h3 class="tittle"><center>View/Edit Assignment Topics</center></h3>
				<div class="contact-grids" align="center">
					<form method="post" action="">

						<div class="col-md-offset-0 col-md-5 contact-grid" style="text-align:center">
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
											<td>Subject </td> <td><div id="sub">
											<select name="sub" class="form-control" >
												<option>select</option>
											</select>

										</div> </td></tr>

										<tr style="height: 50px;">
											<td>Assignment No</td>
											<td>
												<div id="assignment">
													<select name="assignment" class="form-control">
														<option selected disabled>select</option>
														<option value="1">1</option>
														<option value="2">2</option>
													</select>
												</div>
											</td>
										</tr>

										<tr></tr>
										<tr><td></td><td><input type="submit" name="btnshow" id="btnshow" class="btn btn-primary" action="each_assignment_topic_view.php" value="View Topics" disabled="disabled" />  </td></tr>
									</tbody>
								</table>

							</form>
							</div>
							<div class="col-md-offset-1 col-md-8 contact-grid" style="text-align:center">


							<?php if(isset($_POST["btnshow"])):?>

								<?php

								$a=explode(",",$_POST['class']);
								$b=explode("-",$_POST['sub']);
								$assignment=$_POST['assignment'];
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
													<td>Assignment No</td>
													<td><?php echo $assignment; ?></td>
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
												<td>Topic No</td>
												<td>Topic</td>
												<td>Co</td>
											</tr>

											<?php
											$noData = true;
											$res=mysqli_query($con,"SELECT * FROM each_assignment_topic  where classid='".$a[0]."' and  subjectid='".$b[0]."'  and assignmentno = $assignment  order BY  topicid");
											if(mysqli_num_rows($res)>0){
												$noData = false;
											}
											if($noData) {
												echo '<script type="text/javascript"> alert("Nothing to show");</script>';
											} else {

												?>
												<input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
												<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="b"/>
												<input type="hidden" value="<?php echo $_POST['assignment']; ?>" name="assignment"/>
												<?php
														$r=mysqli_query($con,"select * from each_assignment_topic where subjectid='$b[0]' and classid='$a[0]' AND assignmentno = $assignment");
														while($x=mysqli_fetch_array($r)){
															?>
														<tr>
															<td><?php echo $x["topicid"]; ?></td>
															<td><?php echo $x["topic"]; ?></td>
															<td><?php echo $x["co"]; ?></td>
															<td>
																<button class="btn btn-xs btn-info editsomeitng" type="button" name="edit">Edit</button>
																<!--  -->
																<form accept="" method="post"  onsubmit=" return confirm('Do you really want to update topics?');">
																	<?php foreach ($_POST as $key => $value): ?>
																		<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value; ?>">
																	<?php endforeach; ?>

																	<input type="hidden" name="assignment" value="<?php echo $assignment; ?>">
																	<input type="hidden" name="classid" value="<?php echo $a[0]; ?>">
																	<input type="hidden" name="subjectid" value="<?php echo $b[0]; ?>">
																	<input type="hidden" name="old_topic_id" class="old_sessional_marks" value="<?php echo $x['topicid'] ?>">
																	<input type="hidden" name="old_topic" class="old_sessional_marks" value="<?php echo $x['topic'] ?>">
																	<input type="hidden" name="old_co" class="old_sessional_marks" value="<?php echo $x['co'] ?>">


																	<div class="editDiv" style=" position: absolute; background: rgba(231, 231, 231, 0.87); padding: 0.5rem; min-width: 300px; z-index: 999; right: 3%; border: 1px solid blue; display: none; ">
																		<div class="form">
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">topic</label>
																				</div>
																				<div class="col-xs-9">
																					<input type="text" name="new_topic" class="form-control new_something new_topic" value="<?php echo $x['topic'] ?>">
																				</div>
																			</div>
																			<div class="form-group row">
																				<div class="col-xs-3">
																					<label class="form-label">CO</label>
																				</div>
																				<div class="col-xs-9">
																				<!-- class="new_topic"	 -->
																				<input type="text" name="new_co" class="form-control new_something new_co" value="<?php echo $x['co'] ?>">
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


												//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno,d.sessional_marks FROM stud_sem_registration a,stud_details b,current_class c,sessional_marks d where a.classid='$a[0]' and a.new_seum='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and d.subjectid='$b' and d.studid=b.admissionno order by c.rollno asc");

//	$res=mysql_query("SELECT a.adm_no as adno,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
											?>

											<tr>

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

				if($this.closest('td').find('.new_co').val() != $this.closest('td').find('.old_co').val() ){
					$new = true;
				}
				if($this.closest('td').find('.new_topic').val() != $this.closest('td').find('.old_topic').val() ){
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
