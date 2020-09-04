<?php
include("includes/header.php");
include("connection.php");

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
			if(document.getElementById("textd").value==="") { 
				document.getElementById('button').disabled = true; 
			} else { 
				document.getElementById('button').disabled = false;
			}
		}




	</script>



</head>
<div id="page-wrapper">
	<body>

		<div class="map_contact">
			<div class="row">

				<h3 class="tittle my-5 "><center>sessional mark</center></h3>
				<div class="contact-grids" align="center">

					<div class="col-md-offset-2 col-md-8 contact-grid" style="text-align:center">
						
						<form method="post" enctype="multipart/form-data" action="hos.php">
							<table class=""  align="center" width="700" style="cellspacing:2px;">
								<tbody >
									<tr style="height: 50px;">
										<td> Class</td>  
										<td>  
											<select name="class" class="form-control" onchange="showsub(this.value)">
												<option>select</option>
												<?php


												$resul=mysql_query("select distinct(classid) from subject_allocation where fid='$uname'");
												while($data=mysql_fetch_array($resul))
												{
													$classid=$data["classid"];
													$res1=mysql_query("select * from class_details where classid='$classid' and active='YES'");
													while($rs=mysql_fetch_array($res1))
													{
														?>
														<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
															<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
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
										<tr>&nbsp;
											&nbsp;
											&nbsp;
										</tr>
										<tr style="height: 50px;">
											<td>

											</td>
											<td>
												<input type="submit" id="btnshow" name="btnshow" class="btn btn-primary" action="hos.php" value="Enter marks"  disabled="disabled"/>  
											</td>
										</tr>  
									</tbody>
								</table>
							</form>


							<?php
							if(isset($_POST['btnshow'])!=null)
							{

								$a=explode(",",$_POST['class']);
								$b=explode("-",$_POST['sub']);

								$l=mysql_query("select * from sessional_marks where subjectid='$b[0]' and classid='$a[0]'");
								if(mysql_num_rows($l)==0)
								{

									?>


									<div class="row" style="margin-bottom:10px;">
										<div class="col-md-offset-2 col-sm-4 text-center">
											<button class="btn btn-sm btn-warning downlad_excel">download excel template</button>
										</div>
										<div class="col-md-offset-2 col-sm-4 text-center">
											<button class="btn btn-sm btn-info select_excel">input from excel</button>
										</div>
									</div>

									<form method="post" action="form_excel.php"   id="form_excel_su" enctype="multipart/form-data" >
										




										<input type="file" name="selected_excel" id="selected_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .xlsx, .xls" style="display: none;">

										<input type="hidden" value="<?php echo $a[0]; ?>" name="classid"/>
										<input type="hidden" value="<?php echo $b[0]; ?>" name="sub_code"/>
										<input type="hidden" value="<?php echo $b[1]; ?>" name="sub_code_ex"/>

										<input type="submit"  id="form_excel" style="display: none;" value="Upload Image" name="submit">
									</form>

									<form name="form1" method="post">
										<div class="" style="text-align:center">
											<style type="text/css">
											.iamloading .resulttable, .imagepare {
												display: none;												
											}
											.iamloading .imagepare, .resulttable {
												display: block;
											}
										</style>

										<div class="row" style="margin: 1rem 0; padding: 1rem; border: 2px solid #ddd; ">

											<div class=" col-sm-12 col-md-offset-1 col-md-10 text-center">


												<div class="form-inline row"  style="text-align: left;">
													<div class="form-group col-sm-4">
														<label for="sessional_status">Status:</label> 
														<br>
														<select name="sessional_status" id="sessional_status" style="width: 100%;" class="form-group">
															<option value="draft" selected>DRAFT</option>
															<option value="final" >FINAL</option>
														</select>
													</div>
													<div class="form-group col-sm-6">
														<label for="sessional_remark" >Remark:</label>
														<br>
														<textarea name="sessional_remark" id="sessional_remark"  style="width: 100%; height: 7rem;"  class="form-group" placeholder="enter remark ..."></textarea>
													</div>  

												</div>


											</div>

										</div>



										<input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
										<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="b"/>
										<div id="outputData" class="">
											<div class="imagepare" style="text-align: center;">
												<img style="width: 50px; padding: 3pc 0;" src="../images/loading.gif">
											</div>
											<table width="100%" border="1" align="center" class="table table-hover table-bordered ">
												<tr>
													<td>Roll No</td>
													<td>Name</td>
													<td>Marks</td>
													<td>Remark</td>
												</tr>

												<?php




												?>

												<?php




												if($b[1]=='ELECTIVE')
												{

													$res22=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,elective_student e where c.classid='$a[0]' and c.studid=b.admissionno and e.sub_code='$b[0]' and e.stud_id=c.studid order by c.rollno asc");
													$i=0;
													while($rs=mysql_fetch_array($res22))
													{
														$sid=$rs["rollno"];
														?>           
														<tr> 
															<td><?php echo $rs["rollno"]; ?></td>
															<td><?php echo $rs["name"]; ?></td>
															<td><input type="number" step=".01"  id="textd" onkeyup="success()" required="true"     
																name="mark[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td> <textarea name="remark[<?php echo $rs["rollno"]; ?>]"></textarea></td>
															</tr>
															<?php
															$i++;
														}




													}



													else{

	//$res=mysql_query("SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
														$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");

	//exit();
														$i=0;
														while($rs=mysql_fetch_array($res))
														{
															$sid=$rs["rollno"];
															?>           
															<tr>
																<td><?php echo $rs["rollno"]; ?></td>
																<td><?php echo $rs["name"]; ?></td>
																<td><input type="number" step=".01"  id="textd" onkeyup="success()" required="true"    name="mark[<?php echo $rs["rollno"]; ?>]"  /></td>
																<td> <textarea name="remark[<?php echo $rs["rollno"]; ?>]"></textarea></td>
															</tr>
															<?php
															$i++;
														}

													}?>


												</table>


												<br>
												<div class="col-md-8 contact-grid resulttable " style="text-align:center ; margin-bottom: 1pc;">
													<input type="submit" class="btn btn-primary" id="button" name="submit" disabled ="disabled" value="Save"/>   <!--<input type="reset" class="btn btn-primary" onclick="window.location.href='hos.php'" value="clear" />-->
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
							?>


							<?php

							if(isset($_POST["submit"]))
							{

// 									var_dump($_POST);

// exit();



								$a=explode(",",$_POST['a']);
								$b=explode("-",$_POST['b']);

	//$res=mysql_query("SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
								$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");




								$st=$_POST['mark'];

								$i=0;
								while($rs=mysql_fetch_array($res))
								{  
									$sid=$rs["studid"];
									$st=$_POST['mark'];
									$sv=$_POST['remark'];
									$nr_rollno = $rs["rollno"];
									// DELETE FROM sessional_marks WHERE classid = 'PG28' AND sessional_date  > NOW() - INTERVAL 1 HOUR;
                //echo "insert into  sessional_marks values('$a[0]','$sid','$b','$st[$i]')<br/>";
									if (isset($a[0]) && isset($sid) && isset($b[0]) && isset($st[$nr_rollno]) && isset($sv[$nr_rollno]) ){

										$query ="insert into  sessional_marks(`classid`, `studid`, `subjectid`, `sessional_marks`, `sessional_remark`) values('$a[0]','$sid','$b[0]','" .$st[$nr_rollno]. "', '" .$sv[$nr_rollno]. "')";

										$e=mysql_query($query) ;
										$i++;
									}

								}





								if($i>0)
								{


									$sessional_remark ="" ;
									$sessional_status =""  ;
// var_dump($_POST);

									if( isset($_POST['sessional_remark'])  ){
										$sessional_remark = $_POST['sessional_remark']; 
									}


									if(  isset($_POST['sessional_status'])){ 
										$sessional_status = $_POST['sessional_status'] ;
									}



									$query ="insert into  sessional_status(`classid`, `subjectid`, `sessional_status`, `sessional_remark`) values('$a[0]','$b[0]','" .$sessional_status. "', '"  .$sessional_remark. "')";

									$es=mysql_query($query) ;  

									?>
									<script>
										alert("Insert Successfully");
										window.location="hos.php";
									</script>
									<?php
								}
								else
								{
									?>
									<script>
										alert("Error In Insertion");
										window.location="hos.php";
									</script>
									<?php
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
				$('#form_excel').click();
			});
			$("form#form_excel_su").submit(function(e) {
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



