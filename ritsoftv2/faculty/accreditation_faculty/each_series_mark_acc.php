<?php

/**
 * @Author: indran
 * @Date:   2018-10-18 12:01:37
 * @Last Modified by:   riya kaduthus
 * @Last Modified time: 2019-11-8 01:20:31
 */
include("connection.php");
include("includes/header.php");
include("includes/sidenav.php");
$uname=$_SESSION['fid'];
//$uname='KTU02';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="jquery-ui.css" rel="stylesheet">
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
	<script type="text/javascript">
		function success() {
			if(document.getElementById("textd").value===" ") {
				document.getElementById('button').disabled = true;
			} else {
				document.getElementById('button').disabled = false;
			}
		}

	</script>

</head>
<div id="page-wrapper">
	<body>
		<div id="on_top_me_now" style="position: fixed; z-index: 9999; left: 0; right: 0; top: 0; bottom: 0; background: rgba(0, 0, 0, 0.37); text-align: center;" >
			<span  style="color: white;position: absolute;left: 50%;top: 50%;">Loading ....</span>
		</div>

		<div class="map_contact">
			<div class="row">

				<h3 class="tittle my-5 "><center>Series Mark Entry</center></h3>
				<div class="contact-grids" align="center">

					<div class="col-md-offset-1 col-md-8 contact-grid" style="text-align:center">

						<form method="post" encsstype="multipart/form-data" action="each_series_mark.php">
							<table class=""  align="center" width="700" style="cellspacing:2px;">
								<tbody >
									<tr style="height: 50px;">
										<td> Class</td>
										<td>
											<select name="class" class="form-control" onchange="showsub(this.value)">
												<option>select</option>
												<?php
												$resul=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");
												while($data=mysqli_fetch_array($resul))
												{
													$classid=$data["classid"];
													$res1=mysqli_query($con,"select * from class_details where classid='$classid' and active='YES'");
													while($rs=mysqli_fetch_array($res1))
													{
														?>
														<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
															<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?><?php echo $rs['branch_or_specialisation'];?> </option>
															<?php
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr style="height: 50px;">
											<td>Subject</td>
											<td>
												<div id="sub">
													<select name="sub" class="form-control">
														<option>select</option>
													</select>
												</div>
											</td>
										</tr>
										<tr style="height: 50px;">
											<td>Series No</td>
											<td>
												<div id="series">
													<select name="series" class="form-control">
														<option selected disabled>select</option>
														<option value="1">1</option>
														<option value="2">2</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>&nbsp;
											&nbsp;
											&nbsp;
										</tr>
										<tr style="height: 50px;">
											<td>

											</td>
											<td>
												<input type="submit" id="btnshow" name="btnshow" class="btn btn-primary" action="each_series_mark.php" value="Enter marks"  disabled="disabled"/>
											</td>
										</tr>
									</tbody>
								</table>
							</form>

						</div>
						<div class="col-md-offset-2 col-md-8 contact-grid" style="text-align:center">
							<?php
							if(isset($_POST['btnshow'])!=null)
							{

								$a=explode(",",$_POST['class']);
								$b=explode("-",$_POST['sub']);
								$series=$_POST['series'];
								$k=mysqli_query($con,"select * from each_question_paper where subjectid='$b[0]' and classid='$a[0]' AND seriesno = $series ");
								if(mysqli_num_rows($k)>0)
								{
								$l=mysqli_query($con,"select * from each_series_marks where subjectid='$b[0]' and classid='$a[0]' AND series_no = $series ");
								if(mysqli_num_rows($l)==0)
								{
									?>
									

									<form method="post" action="form_excel.php"   id="fom_excel_serie_su" enctype="multipart/form-data" >

										<input type="file" name="selected_excel" id="selected_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .xlsx, .xls" style="display: none;">

										<input type="hidden" value="<?php echo $a[0]; ?>" name="classid"/>
										<input type="hidden" value="<?php echo $b[0]; ?>" name="sub_code"/>
										<input type="hidden" value="<?php echo $series; ?>" name="series" id="series" />
										<input type="hidden" value="<?php echo $b[1]; ?>" name="sub_code_ex"/>

										<input type="submit"  id="fom_excel_serie" style="display: none;" value="Upload Image" name="submit">
									</form>
										<?php if(isset($_POST["btnshow"])):?>

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
									<?php endif; ?>
									</div>
									<div class="col-md-offset-0 col-md-8 contact-grid" style="text-align:center">

									<form name="form1" method="post" id="fom_excel_serie_su_suer" onsubmit=" return confirm('Do you really want to add series <?php echo $series ?> mark?');">
										<div class="" style="text-align:center">
											<style type="text/css">
											.iamloading .resulttable, .imagepare {
												display: none;
											}
											.iamloading .imagepare, .resulttable {
												display: block;
											}
										</style>

										<input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
										<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="b"/>
										<input type="hidden" value="<?php echo $_POST['series']; ?>" name="series"/>
										<div id="outputData" class="">
											<div class="imagepare" style="text-align: center;">
												<img style="width: 50px; padding: 3pc 0;" src="../images/loading.gif">
											</div>
											<br/>
											<table width="100%" border="1" align="center" class="table table-hover table-bordered ">
												<tr>
													<td>Roll No</td>
													<td>Name</td>
													<td>Q1</td>
													<td>Q2</td>
													<td>Q3</td>
													<td>Q4</td>
													<td>Q5</td>
													<td>Q6</td>
													<td>Q7</td>
													<td>Q8</td>
													<td>Q9</td>
													<td>Q10</td>
													<td>Remark </td>
												</tr>

												<?php
												if($b[1]=='ELECTIVE')
												{

													$res22=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,elective_student e where c.classid='$a[0]' and c.studid=b.admissionno and e.sub_code='$b[0]' and e.stud_id=c.studid order by c.rollno asc");
													$i=0;
													while($rs=mysqli_fetch_array($res22))
													{
														$sid=$rs["rollno"];
														?>
														<tr>
															<td><?php echo $rs["rollno"]; ?></td>
															<td><?php echo $rs["name"]; ?></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark1[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark2[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark3[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark4[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark5[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark6[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark7[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark8[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark9[<?php echo $rs["rollno"]; ?>]"  /></td>
															<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark10[<?php echo $rs["rollno"]; ?>]"  /></td>
														<td> <textarea name="remark[<?php echo $rs["rollno"]; ?>]"></textarea></td>
															</tr>
															<?php
															$i++;
														}
													}
													else{

	//$res=mysql_query("SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
														$res=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");
//exit();
														$i=0;

														while($rs=mysqli_fetch_array($res))
														{
															$sid=$rs["rollno"];
															?>
															<tr>
																<td><?php echo $rs["rollno"]; ?></td>
																<td><?php echo $rs["name"]; ?></td>
																<!--  pattern="^[0-9]{1,3}" -->
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01"   name="mark1[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark2[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark3[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark4[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark5[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark6[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark7[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark8[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark9[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td><input type="text" id="textd" onkeyup="success()" size="2"   step=".01" name="mark10[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td> <textarea name="remark[<?php echo $rs["rollno"]; ?>]"></textarea></td>
															</tr>
															<?php
															$i++;
														}

													}?>

												</table>

												<br>
												<div class="col-md-8 contact-grid resulttable " style="text-align:center ; margin-bottom: 1pc;">
													<input type="submit" class="btn btn-primary" id="button" name="submit" disabled ="disabled" value="save"/>   <!--<input type="reset" class="btn btn-primary" onclick="window.location.href='each_series_mark.php'" value="clear" />-->
													<?php

													?>
												</div>
											</div>

										</div>
									</form>


									<?php
								}
								else

									echo "<script>alert('Already Entered')</script>";
								}
								else
							 	echo "<script>alert('No such question paper entered !!!!')</script>";

							}
							?>


							<?php

							if(isset($_POST["submit"])) {

								// var_dump($_POST);

								// exit();
								$a=explode(",",$_POST['a']);
								$b=explode("-",$_POST['b']);
								$series= $_POST['series'];
								if($series == '1' || $series == '2') {
	//$res=mysql_query("SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
									$res=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");


									$i=0;
									while($rs=mysqli_fetch_array($res))
									{
										$sid=$rs["studid"];
										$m1=$_POST['mark1'];
										$m2=$_POST['mark2'];
										$m3=$_POST['mark3'];
										$m4=$_POST['mark4'];
										$m5=$_POST['mark5'];
										$m6=$_POST['mark6'];
										$m7=$_POST['mark7'];
										$m8=$_POST['mark8'];
										$m9=$_POST['mark9'];
										$m10=$_POST['mark10'];
										$sv=$_POST['remark'];
										$nr_rollno = $rs["rollno"];
										if (isset($a[0]) && isset($sid) && isset($b[0]) && isset($m1[$nr_rollno]) && isset($m2[$nr_rollno]) && isset($m3[$nr_rollno]) && isset($m4[$nr_rollno]) && isset($m5[$nr_rollno]) && isset($m6[$nr_rollno]) && isset($m7[$nr_rollno]) && isset($m8[$nr_rollno]) && isset($m9[$nr_rollno]) && isset($m10[$nr_rollno]) && isset($sv[$nr_rollno]) ){

									// DELETE FROM sessional_marks WHERE classid = 'PG28' AND sessional_date  > NOW() - INTERVAL 1 HOUR;
                //echo "insert into  sessional_marks values('$a[0]','$sid','$b','$st[$i]')<br/>";

											$query ="insert into  each_series_marks(`series_no`, `classid`, `studid`, `subjectid`,`q1`,`q2`,`q3`,`q4`,`q5`,`q6`,`q7`,`q8`,`q9`,`q10`,`sessional_remark`) values('$series','$a[0]','$sid','$b[0]','" .$m1[$nr_rollno]. "','" .$m2[$nr_rollno]. "','" .$m3[$nr_rollno]. "','" .$m4[$nr_rollno]. "','" .$m5[$nr_rollno]. "',
											'" .$m6[$nr_rollno]. "','" .$m7[$nr_rollno]. "','" .$m8[$nr_rollno]. "','" .$m9[$nr_rollno]. "','" .$m10[$nr_rollno]. "', '" .$sv[$nr_rollno]. "')";
											$e=mysqli_query($con,$query) ;
											$i++;
										}
									}
									if($i>0)
									{
										?>
										<script>
											alert("Insert Successfully");
											window.location="each_series_mark.php";
										</script>
										<?php
									}
									else
									{
										?>
										<script>
											alert("Error In Insertion");
											window.location="each_series_mark.php";
										</script>
										<?php
									}
								}
							}
							?>
							<!--<tr><td><input type="submit" name="submit" value="save"  /> </td></tr>-->
						</body>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		$(document).ready(function($) {
			console.log('ready to go nrjith');
			$('#on_top_me_now').remove();

			$('.downlad_excel').click(function(event) {


				window.open('excel_template.php?action=template-mark&type=excel','_blank' );


			});
			$('.select_excel').click(function(event) {
				event.preventDefault();
				console.log('now excel time ');
				$('#selected_excel').click();
			});
			$('#selected_excel').change(function(e) {
				e.preventDefault();
				$('#fom_excel_serie').click();
			});
			$("form#fom_excel_serie_su").submit(function(e) {
				e.preventDefault();
				var formData = new FormData(this);
				$('#outputData').addClass('iamloading');
				$.ajax({
					url: 'form_excel.php',
					type: 'POST',
					data: formData,
					success: function (data) {
						$('#outputData').removeClass('iamloading');
						$('#outputData').html(data);

						document.getElementById('button').disabled = false;
					},
					cache: false,
					contentType: false,
					processData: false
				});
			});
		});

	</script>

</body>
</div>
</html>
<?php

include("includes/footer.php");
?>
