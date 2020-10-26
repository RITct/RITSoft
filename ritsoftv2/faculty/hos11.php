<?php
//$con=mysqli_connect("localhost","root","","ritsoft2");
include("../connection.php");
//session_start();
//$uname=$_SESSION['fid'];

include("includes/header.php");
include("includes/sidenav.php");



if ($_POST) { 

	$_SESSION['POST'] =  $_POST; 
	echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
	exit();
}
if (isset($_SESSION ['POST'])) {
	$_POST = $_SESSION['POST'];
	unset($_SESSION['POST']);
}


$uname=$_SESSION['fid'];

$dis_option  = "";
?>
<?php
if(isset($_POST["fsub"]))
{



		//echo "<script>alert('fgfg')</script>";
	
	$a=explode(",",$_POST['a']);
	$b=explode("-",$_POST['sub']);

	
//	$res=mysql_query("SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
	$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");
	
	$st=$_POST['mark'];
	$i=0;
	while($rs=mysql_fetch_array($res))
	{  
		$sid=$rs["studid"];
		 //$st=$_POST['mark'];
		$sub= $st[$sid];
		
                //echo "insert into  sessional_marks values('$a[0]','$sid','$b','$st[$i]')<br/>";
		
		mysql_query("update sessional_marks set status='verfication pending' where classid='$a[0]' and studid='$sid' and subjectid='$b[0]'") or die(mysql_error());
		$i++;
	}
}




if(isset($_POST["submit"])){


	var_dump($_POST);
	exit();




	$a=explode(",",$_POST['a']);

	$b=explode("-",$_POST['b']);
	
	//$res=mysql_query("SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
	$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");
	
	$st=$_POST['mark'];
	$sv=$_POST['remark'];
	$i=0;
	while($rs=mysql_fetch_array($res))
	{  
		$sid=$rs["rollno"];
		 //$st=$_POST['mark'];
		$sub= $st[$sid];

		 //$st=$_POST['mark'];
		$suv= $sv[$sid];
		
                //echo "insert into  sessional_marks values('$a[0]','$sid','$b','$st[$i]')<br/>";
		
		// mysql_query("update sessional_marks set , sessional_remark='$suv' where classid='$a[0]' and studid='$sid' and subjectid='$b[0]'");
		$i++;
	}
}
$mams = '';

if (isset($_POST['updateme'])) {

	// echo  $_POST['remark'] ."!=". $_POST['old_remark']." ||". $_POST['mark'] ."!= ".$_POST['old_mark'] ;

	if ($_POST['remark'] != $_POST['old_remark'] || $_POST['mark'] != $_POST['old_mark'])  {

		$a=explode(",",$_POST['class']);
		$b=explode("-",$_POST['sub']);
		
		try {

			mysql_query("update sessional_marks set  sessional_marks = ". $_POST['mark'] .",  sessional_remark = '". $_POST['remark'] ."',  sessional_date = now(), verification_status = 2  where classid='$a[0]' and studid='".$_POST['studid']."' and subjectid='$b[0]'") or die(mysql_error());

			$mams = '<div class="alert alert-success"  style="text-align: center; "> mark / remark updated </div>';
		} catch (Exception $e) {

		}

		try { 


			mysql_query("update sessional_status set  verification_status = 2  where classid='$a[0]' and   subjectid='$b[0]' AND verification_status = -1 ") or die(mysql_error());

		} catch (Exception $e) {

		}


	}





}
if (isset($_POST['update-na'])) {

	$a=explode(",",$_POST['class']);
	$b=explode("-",$_POST['sub']);

	try { 


		mysql_query("update sessional_status set  sessional_status = '". $_POST['sessional_status'] ."',  sessional_remark = '". $_POST['sessional_remark'] ."',  sessional_date = now()  where classid='$a[0]' and   subjectid='$b[0]'") or die(mysql_error());

		$mams = '<div class="alert alert-success"  style="text-align: center; ">status updated </div>';
	} catch (Exception $e) {

	}
	try { 


		mysql_query("update sessional_status set  verification_status = 2  where classid='$a[0]' and   subjectid='$b[0]'") or die(mysql_error());
		// mysql_query("update sessional_marks set  verification_status = 2  where classid='$a[0]' and   subjectid='$b[0]'") or die(mysql_error());

	} catch (Exception $e) {

	}



}

if (isset($_POST['update_sessionala4'])) {


	$a=explode(",",$_POST['class']);
	$b=explode("-",$_POST['sub']);

	try { 


		mysql_query("update sessional_status set  verification_status = 0  where classid='$a[0]' and   subjectid='$b[0]'") or die(mysql_error());
		mysql_query("update sessional_marks set  verification_status = 0  where classid='$a[0]' and   subjectid='$b[0]' AND verification_status != 1 ") or die(mysql_error());

	} catch (Exception $e) {

	}



}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
</head>
<div id="page-wrapper">
	<body>


		<div class="map_contact">
			<div class="container">
				
				<h3 class="tittle"><center>Edit sessional mark</center></h3>
				<div class="contact-grids" align="center">
					
					<div class="col-md-11 contact-grid" style="text-align:center">






						<form method="post"  action="hos11.php">
							<table  align="center" width="700"> 

								<tr><td> Class</td>  <td>  
									<select name="class" class="form-control" onchange="showsub(this.value)">
										<option>select</option>
										<?php
										$c=mysql_query("select distinct(classid) from subject_allocation where fid='$uname'");

										while($res=mysql_fetch_array($c))
										{
											$res1=mysql_query("select * from class_details where classid='$res[classid]' and active='YES'");
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
									</td></tr>


									<tr><td>Subject </td> <td>
										<div id="sub">
											<select name="sub" class="form-control" >
												<option>select</option>
											</select>

										</div>

										<!-- <input type="text" name="sub"> -->
									</td></tr>
									<tr><td></td><td><input type="submit" name="btnshow" class="btn btn-primary" action="hos11.php" value="Edit Sessional Mark"  />  </td></tr> 

								</table>
							</form>
							<?php 
							include("../connection.php");
							?>
							<table  style="width: 100%;">
								<tbody>
									<tr>
										<td colspan="2">




											<?php 
											$tdeda = false;
											$sessional_status = "";
											$sessional_remark = "";
											$verification_status = 0;
											$verification_status_b = 0;


											if(isset($_POST['btnshow']))
											{

												$a=explode(",",$_POST['class']);
												$b=explode("-",$_POST['sub']); 



												$res=mysql_query("SELECT * FROM sessional_status  where classid='".$a[0]."' and  subjectid='".$b[0]."'  order BY  sessional_date DESC LIMIT 1");


												if(mysql_num_rows($res)>0){

													while($rs=mysql_fetch_array($res))
													{ 

														$sessional_status = $rs['sessional_status'];
														$sessional_remark = $rs['sessional_remark'];
														$verification_status_b = $rs['verification_status'];
														$tdeda = true;

													}

												}








												?>

												<?php if($tdeda): ?>
													<div class="row" style="margin: 1rem 0; padding: 1rem; border: 2px solid #ddd; ">

														<div class=" col-sm-12    text-center">


															<?php 

															$dis_option = "";
															if($sessional_status == 'final' && $verification_status_b == 1 )
																$dis_option = " disabled='disabled' ";

															?>





															<div class="form-inline row"  style="text-align: center; margin: 1rem 0 ;">
																<?php if( $verification_status_b == 0): ?>
																	<div class="form-group col-sm-12  ">

																		<p style=" color: blue; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																			<span> waiting for staff advisor verification  </span>
																		</p>
																		<?php 
																		$dis_option  = " disabled='disabled' "; ?>
																	</div>
																	<?php elseif( $verification_status_b == -1 ):  ?>
																		<div class="form-group col-sm-12  ">

																			<p style=" color: red; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																				<span> sessional marks rejected </span>
																			</p>

																		</div>
																		<!-- <div class="form-group col-sm-12  ">
																			<form action="" method="post">

																				<input type="hidden" value="<?php echo $_POST['class']; ?>" name="class"/>
																				<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="sub"/>

																				<input type="hidden" name="btnshow" value="true">

																				<input type="submit" name="update_sessionala4" class="btn btn-sm btn-danger" value="request for staff advisor verification">

																			</form>
																		</div>   -->
																		<?php elseif( $verification_status_b == 1   ):  ?>
																			<div class="form-group col-sm-12  ">

																				<p style=" color: green; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																					<span> <?php echo $sessional_status;  ?> sessional marks published  </span>
																				</p>

																				<?php 	if($sessional_status != 'final' ): ?>
																				<!-- 	<form action="" method="post">

																						<input type="hidden" value="<?php echo $_POST['class']; ?>" name="class"/>
																						<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="sub"/>

																						<input type="hidden" name="btnshow" value="true">

																						<input type="submit" name="update_sessionala4" class="btn btn-sm btn-info" value="request for staff advisor verification">

																					</form> -->

																				<?php endif; ?>
																			</div>  
																			<?php elseif( $verification_status_b == 2  ):  ?>
																				<div class="form-group col-sm-12  ">

																					<p style=" color: orange; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																						<span> <?php echo $sessional_status;  ?> sessional marks changed  </span>
																					</p>


																					<form action="" method="post">

																						<input type="hidden" value="<?php echo $_POST['class']; ?>" name="class"/>
																						<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="sub"/>

																						<input type="hidden" name="btnshow" value="true">

																						<input type="submit" name="update_sessionala4" class="btn btn-sm btn-warning" value="request for staff advisor verification">

																					</form>
																				</div>  
																				<?php else: ?>
																					<div class="form-group col-sm-12  ">

																						<p style=" color: green; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																							<span> <?php echo $sessional_status;  ?> sessional marks published  </span>
																						</p>

																					</div>



																				<?php endif; ?>

																			</div>

																			<form method="post" action="">		

																				<input type="hidden" value="<?php echo $_POST['class']; ?>" name="class"/>
																				<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="sub"/>
																				<input type="hidden" name="btnshow" value="true">

																				<div class="form-inline row"  style="text-align: left;">
																					<div class="form-group col-sm-3">

																						<br>
																						<select  <?php echo $dis_option; ?> name="sessional_status" id="sessional_status" style="width: 100%;" class="form-group">
																							<option value="draft"  <?php if($sessional_status == 'draft'){ echo "selected"; } ?> >DRAFT</option>
																							<option value="final" <?php if($sessional_status == 'final'){ echo "selected"; } ?>  >FINAL</option>
																						</select>
																					</div>
																					<div class="form-group col-sm-7">
																						<label for="sessional_remark" >Remark:</label>
																						<br>
																						<textarea  <?php echo $dis_option; ?> name="sessional_remark" id="sessional_remark"  style="width: 100%; height: 7rem;"  class="form-group" placeholder="enter remark ..."><?php  echo $sessional_remark; ?></textarea>
																					</div>  
																					<div class="form-group col-sm-2">

																						<br>
																						<input type="submit"  <?php echo $dis_option; ?> name="update-na" value="update"  class="btn btn-primary "  >
																					</div>  

																				</div>	
																			</form>




																		</div>

																	</div>
																<?php endif; ?>
																<?php 

															}
															?>


														</td>
													</tr>
												</table>

												<!-- <form name="form1" > -->

													<?php
//$con=mysql_connect("localhost","root","","ritsoft2");
													if(isset($_POST['btnshow']))
													{





														?>

														<?php


														$a=explode(",",$_POST['class']);
														$b=explode("-",$_POST['sub']);

														?>
														<?php echo $mams; ?>
														<input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
														<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="b"/>
														<?php
	//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno,d.sessional_marks FROM stud_sem_registration a,stud_details b,current_class c,sessional_marks d where a.classid='$a[0]' and a.new_seum='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and d.subjectid='$b' and d.studid=b.admissionno order by c.rollno asc");

	//$res=mysql_query("SELECT a.adm_no as adno,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");



														$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno and b.admissionno in ( select studid from sessional_marks where subjectid='$b[0]' and classid='$a[0]'  )  order by c.rollno asc");
												// echo "--" . $b[0];
														$l=mysql_query("select * from sessional_marks where subjectid='$b[0]' and classid='$a[0]'");
														if(mysql_num_rows($l)>0)
														{
															?>
															<div class="table-responsive">
																<table class="table table-hover table-bordered">

																	<tr>
																		<th>Roll No</th>
																		<th>Name</th>
																		<th>Marks</th>
																		<th>Remark</th>
																		<th>verification status </th>
																		<th>Action</th>
																	</tr>

																	<?php
																	$i=0;
																	while($rs=mysql_fetch_array($res))
																	{
																		$aid=$rs["studid"];

																		$r=mysql_query("select sessional_marks, sessional_remark,verification_status from sessional_marks where subjectid='$b[0]' and studid='$aid'");
																		$x=mysql_fetch_assoc($r);
																		if($x["verification_status"]=="")
																		{
																			$vi=0;
																			$dis='';	
																		}
																		else
																		{		
																			$vi=1;
																	// $dis='disabled="disabled"';	
																	// removed 
																			$dis = "";

																		}

																		$dis_option  = "   "; 
																		if($verification_status_b == 0   )
																			$dis_option  = " disabled='disabled' "; 

																		$verification_status = $x['verification_status'];
																		if( $verification_status == 0){
																			$dis_option  = " disabled='disabled' "; 
																		}	
																		if( $verification_status == -1 ){
																			$dis_option  = "  ' "; 
																		}
																		if($sessional_status == 'final' && $verification_status_b == 1 )
																			$dis_option = " disabled='disabled' ";



																		?>        

																		<form method="post" action=""  >   
																			<tr class="update-form">
																				<td><?php echo $rs["rollno"]; ?></td>
																				<td><?php echo $rs["name"]; ?></td>
																				<td> <input type="text" <?php echo $dis; ?> <?php echo $dis_option; ?> name="mark" value="<?php echo $x["sessional_marks"]; ?>"/></td>
																				<td> <textarea name="remark"  <?php echo $dis_option; ?> ><?php echo $x["sessional_remark"]; ?></textarea></td>
																				<td>




																					<div class="form-inline row"  style="text-align: center; margin: 1rem 0 ;">
																						<?php if( $verification_status == 0): ?>
																							<div class="form-group col-sm-12  ">

																								<p style=" color: blue; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																									<span> waiting for staff advisor verification  </span>
																								</p>
																								<?php 
																								$dis_option  = " disabled='disabled' "; ?>
																							</div>
																							<?php elseif( $verification_status == -1 ):  ?>
																								<div class="form-group col-sm-12  ">

																									<p style=" color: red; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																										<span> sessional mark rejected </span>
																									</p>

																								</div>

																								<?php elseif( $verification_status == 1   ):  ?>
																									<div class="form-group col-sm-12  ">

																										<p style=" color: green; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																											<span> <?php echo $sessional_status;  ?> sessional marks published  </span>
																										</p>



																									</div>  
																									<?php elseif( $verification_status == 2  ):  ?>
																										<div class="form-group col-sm-12  ">

																											<p style=" color: orange; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																												<span> <?php echo $sessional_status;  ?> sessional marks changed  </span>
																											</p>



																										</div>  
																										<?php else: ?>
																											<div class="form-group col-sm-12  ">

																												<p style=" color: green; text-transform: uppercase; border: 1px solid; padding: 0.4rem 0; "> 
																													<span> <?php echo $sessional_status;  ?> sessional marks published  </span>
																												</p>

																											</div>

																										<?php endif; ?>

																									</div>





																								</td>
																								<td>
																									<input type="hidden" value="<?php echo $_POST['class']; ?>" name="class"/>
																									<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="sub"/>
																									<input type="hidden" name="btnshow" value="true">

																									<input type="hidden" name="studid" value="<?php echo $aid; ?>">
																									<input type="hidden" name="old_mark" value="<?php echo $x["sessional_marks"]; ?>">
																									<input type="hidden" name="old_remark" value="<?php echo $x["sessional_remark"]; ?>">
																									<input type="submit"  <?php echo $dis_option; ?> class="btn btn-sm btn-warning" name="updateme" value="save">

																								</td>

																							</tr>
																						</form>
																						<?php

																						$i++;
																					}
																					?>






																				</table>

																				<?php if($vi==0 && false) {	   ?>
																					<input type="submit" id="now_click1" class="btn btn-primary  " name="submit" value="Save"/> 
																					<input type="submit" id="now_click2" name="fsub" class="btn btn-primary  "  value="Final Submit"/> 
																				<?php }?> 
																				<!--- <td><input type="submit" name="submit" value="Enter Mark"/></td>  </tr>--->

																				<?php
																			}
																			else
																			{
																				echo "<script> alert('Not entered Sessional marks')</script>";
																			}
																		}

																		?>




																		<tr><td><!--<input type="submit" name="btnsave" value="save"  /> --> 


																			<!-- </form> -->

																			<script src="../dash/vendor/jquery/jquery.min.js"></script>
																			<script type="text/javascript">
																				$(document).ready(function(){


																					$(document).on('click', '#now_click1', function(e){

																						e.prevnetDefault(); 

																						$('now_click2').remove();
																						$(this).closest('form').submit(); 

																					});


																					$(document).on('click', '#now_click2', function(e){

																						e.prevnetDefault(); 

																						$('now_click1').remove();
																						$(this).closest('form').submit(); 

																					}); 
																					$(document).on('keyup', '.update-form input, .update-form textarea', function(event) {
																						event.preventDefault();
																						console.log("hello");
																						$(this).closest('.update-form').find('input[type="submit"]').removeClass('btn-warning');
																						$(this).closest('.update-form').find('input[type="submit"]').addClass('btn-danger');
																					});



																				});
																			</script>


																		</body>

																	</div>


																</div>

															</div>

														</div>
													</div>


												</body>

												</html>

												<?php

												include("includes/footer.php");
												?>

