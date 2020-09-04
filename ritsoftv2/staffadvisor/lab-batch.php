<?php

/**
 * @Author: indran
 * @Date:   2018-08-04 19:30:12
 * @Last Modified by:   project
 * @Last Modified time: 2018-09-24 09:37:08
 */




function makeId ( $input) {
	$output = $input; 
	$output = trim($input);
	$output = strtolower($output); 
	$output = preg_replace('/\s*$/','',$output);
$output = str_replace(' ', '_', $output);
	return $output; 
}





include("includes/header.php");
$fid=$_SESSION["fid"]; 
$classid=$_SESSION["classid"];
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


$message = array();

$count=0;

$subid="";
if(isset($_POST['subjectid'])) {
	$subid=$_POST['subjectid'];  
}
?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="../dash/vendor/jquery/jquery.min.js"></script>
<style type="text/css">
body {
	display: grid;
}
.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
.toggle.ios .toggle-handle { border-radius: 20px; }
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				<span  >
					Lab Batch 

				</span>
			</h1>
		</div> 
	</div>


	<div class="row">
		<div class="col-sm-12">
			<div class="box box-body">
				
				<form method="post" class="form">        
					<div class="form-group">
						<select name="subjectid" required="required" onchange="this.form.submit()" class="form-control">
							<option value="s" selected="selected" disabled="disabled">--select--</option>


							<?php
							$sql="select subject_title,subjectid from subject_class where classid='$classid' AND type='LAB'";


							$r=mysql_query($sql) or die(mysql_error());
							while($result=mysql_fetch_array($r))    {
								if($subid==$result["subjectid"])
									$s='selected="selected"';
								else
									$s="";
								echo '<option value="'.$result['subjectid'].'" '.$s.'>'.$result['subject_title'].'</option>';
							}?>

						</select>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php if(isset($_POST['subjectid'])): ?>
		<?php
		if( isset($_POST['new_batch_name'])) {

			$return = mysql_query("SELECT * FROM lab_batch  WHERE batch_name =  '".$_POST['new_batch_name']. "' AND sub_code = '".$_POST['subjectid']. "' AND classid='".$classid."' ")or die(mysql_error());
			$exit = false;

			while($data=mysql_fetch_array($return)) {
				$message[0] = 3;
				$message[1] = "<strong>  duplicate entry  </strong> <p> batch name already exists </p>";
				$exit = true;
			}

			if( ! $exit ) {

				$return = mysql_query("INSERT INTO lab_batch  (batch_name, sub_code, classid) VALUES('".$_POST['new_batch_name']. "','".$_POST['subjectid']."','".$classid."')")or die(mysql_error());
				if( $return ) {
					$message[0] = 1;
					$message[1] = "<strong> success </strong> <p> batch name successfully added </p>";
				}
			}


		}

		?>


		<div class="row" style=" padding: 1rem 0; ">

			<div class="col-md-12">
				<form class="form-inline" method="post">
					<input type="hidden"  value="<?php echo $_POST['subjectid']; ?>" name="subjectid">
					<div class="form-group col-sm-10 row">
						<label for="a" class="col-md-2">Batch Name</label>
						<div class="col-md-10"> 
							<select  name="new_batch_name"  class="form-control col-sm-12" id="a" placeholder=" like batch A " required style="width: 100%;">
								<option value="-1" selected="selected" disabled="disabled">select batch name </option>
								<?php 
								$na = 'A';
								for($nal = 0; $nal < 5 ; ){


									$isok = true;
									$return = mysql_query("SELECT * FROM lab_batch  WHERE batch_name =  '".$na. "' AND sub_code = '".$_POST['subjectid']. "' and classid='".$classid."' ")or die(mysql_error());


									while($data=mysql_fetch_array($return)) { 
										$isok = false;
									}
									if($isok) {
										echo '<option value="'.$na.'" >'.$na.'</option>';
										$nal++;
									}

									$na++;
								}

								

								?>
							</select>
						</div>
					</div> 
					<button type="submit" class="btn btn-default col-sm-2">add new batch</button>
				</form>
			</div>
			<div class="col-md-12">

				<?php echo show_theme_error ($message); 
				$message = array(); ?>
				
			</div>
		</div>

	<?php endif; ?>


	<?php if(isset($_POST['subjectid'])): ?>

		<?php

		if(isset($_POST['update-stud-lab'])) {

			$message[0] = 2;
			$message[1] = "<strong> status </strong> <p> 0 students added  </p>";


			$subjectidA = $_POST['subjectid'];
			$batch_idA = $_POST['batch_id'];
			$inAR = array();

			foreach ($_POST['adm_no'] as $key => $value) {
				if(isset($_POST['lab'][$value])){
					array_push($inAR ,$value );
				} 
			}
			$strin = " '-1' ";
			foreach ($inAR as $key => $value) {
				$strin = $strin. ",  '".$value."'";
			}

			$return = mysql_query(" SELECT COUNT(*) AS count FROM lab_batch_student  WHERE batch_id =  '".$batch_idA. "' AND studid NOT IN ( $strin )  ")or die(mysql_error()); 
			$count = 0;
			while($data=mysql_fetch_array($return)) { 
				$count = $data['count'];
			}

			$message[1] = "<strong> success </strong> <p> $count  students removed ";

			$return = mysql_query(" DELETE FROM lab_batch_student  WHERE batch_id =  '".$batch_idA. "' AND studid NOT IN ( $strin )  ")or die(mysql_error());

			foreach ($inAR as $key => $value) {

				$return = mysql_query("SELECT * FROM lab_batch_student  WHERE batch_id =  '".$batch_idA. "' AND studid = '".$value. "' ")or die(mysql_error());
				$exit = false;

				while($data=mysql_fetch_array($return)) { 
					$exit = true;
				}

				if( ! $exit ) {

					$return = mysql_query("INSERT INTO lab_batch_student  (batch_id, studid) VALUES('".$batch_idA. "', '".$value. "' )")or die(mysql_error());
					if( $return ) {
						$message[0] = 1; 
					}
				}

			}
			if(sizeof($inAR) == 0) {

				$message[0] = 3;
				$message[1] = 	$message[1] . " and   0 students added   </p>";
			} else  {
				$message[0] = 1;
				$message[1] = 	$message[1] . " and  ". sizeof($inAR) ." students added in  batch ". $_POST['batch_name']." successfully  </p>";
			}


			$message[1] = 	$message[1] . " </p>";


		}

		?>





		<div class="row" style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #dddddd; ">
			<div class="col-md-12">


				<?php echo show_theme_error ($message); ?>
				<p>existing batches </p>
				<ul class="nav nav-tabs">
					<li class="  <?php if( ! isset($_POST['batch_id']) ) echo "active"; ?>"><a data-toggle="tab" href="#all_now">All</a></li> 
					<?php

					$resul=mysql_query("SELECT  * FROM lab_batch WHERE sub_code='$subid' and classid='$classid'  order by batch_name");
					while($data=mysql_fetch_array($resul)) {
						$atva = '';
						if(  isset($_POST['batch_id']) ) if($_POST['batch_id'] == $data["batch_id"] ) $atva = "active"; 

						echo ' <li class="'.$atva.'" ><a data-toggle="tab" href="#'.makeId($data["sub_code"]).makeId($data["batch_id"]).'">'.$data["batch_name"].'</a></li> ';
					}

					?>


				</ul>

				<div class="tab-content">
					<div id="all_now" class="tab-pane fade in  <?php if( ! isset($_POST['batch_id']) ) echo "active"; ?>">
						<h3 style="text-transform: uppercase;">all batches </h3>
						<p> </p>


						<div class="row">
							<div class="col-sm-12">
								<div class="box box-body">



									<form method="post"  >      
										<div class="table-responsive">

											<table class="table table-bordered table-hover  " id="actoin_table<?php echo  makeId($dataRatr["batch_id"]) ; ?>">
												<thead>
													<tr>
														<th style="text-align: center;">ROLL NUMBER</th>
														<th style="text-align: center;">ADMISSION NUMBER</th>
														<th style="text-align: center;">STUDENT NAME</th>
														<th style="text-align: center; text-transform: uppercase;">Assigned Batch</th>
													</tr>
												</thead>
												<tbody>



													<?php 
													$resul=mysql_query("SELECT current_class.studid,rollno FROM current_class WHERE current_class.classid='$classid' and current_class.studid not in(SELECT elective_student.stud_id from elective_student WHERE elective_student.sub_code='$subid') order by rollno");
													while($data=mysql_fetch_array($resul)) {
														$adm_no=$data["studid"];

														$rollno=$data["rollno"];

														$result=mysql_query("select name from stud_details where admissionno='$adm_no'");
														while($dat=mysql_fetch_array($result)) {
															$name=$dat["name"];
														}
														?>
														<tr >
															<td align="center"><?php  echo $rollno;?></td>
															<td align="center"><?php  echo $adm_no;?></td>
															<td align="center"><?php  echo $name;?></td>

															<td align="center">
																<!-- Rounded switch -->
																<?php

																$sta = "not assigned ";

																$resultTy=mysql_query(" SELECT * FROM `lab_batch_student` s LEFT JOIN lab_batch b ON b.batch_id = s.batch_id WHERE s.studid = '$adm_no' and b.classid='$classid' AND b.sub_code = '$subid' ORDER BY b.batch_name ");
																while($datRa=mysql_fetch_array($resultTy)) {
																	$sta=$datRa["batch_name"];
																}


																?>

																<span style="text-transform: uppercase; font-weight: 500; font-size: 16px; text-align: center; " class="<?php 
																if($sta != "not assigned ")
																echo "text-primary";
																else 
																echo "text-danger";
																?>" ><?php echo $sta;  ?></span>



															</td>
														</tr>
														<?PHP
													}
													?>


												</tbody>
											</table>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div> 

					<?php

					$resulPOP=mysql_query("SELECT  * FROM lab_batch WHERE sub_code='$subid' and classid='$classid'  order by batch_name");
					while($dataRatr=mysql_fetch_array($resulPOP)) { 
						$atva = '';
						if(  isset($_POST['batch_id']) ) if($_POST['batch_id'] == $dataRatr["batch_id"] ) $atva = "active"; 


						?>
						

						<div id="<?php  echo  makeId($dataRatr["sub_code"]). makeId($dataRatr["batch_id"]);  ?>" class="tab-pane fade in <?php echo 
						$atva; ?>">

						<h3 style="text-transform: uppercase;">batch name <span style="color: green; font-weight: 700; "><?php  echo  $dataRatr["batch_name"];  ?></span> </h3>

						<p style=" color: red; "> students assigned in <span style="color: green; padding: 0 0.24rem; font-weight: 700;"><?php  echo  $dataRatr["batch_name"];  ?></span> and students not yet assigned in any batch. </p>




						<form method="post"  >      
							<div class="row" style=" padding: 1rem 0; ">

								<div class="col-md-4">
									<div style=" padding: 0.25rem; border: 0px solid #dddddd; "> 
										<input type="button"   action_type="true"  value="check all" class="btn btn-sm btn-info doThings<?php echo  $dataRatr["batch_id"] ; ?>All" name="">
										<input type="button"    action_type="false"  value="un check all" class="btn btn-sm btn-warning doThings<?php echo   makeId($dataRatr["batch_id"]) ; ?>All" name="">
									</div>
								</div>
								<div class="col-md-4">
									<?php
									$max = 1;
									$resul=mysql_query("SELECT  COUNT( * ) AS count FROM current_class WHERE current_class.classid='$classid' and current_class.studid not in(SELECT elective_student.stud_id from elective_student WHERE elective_student.sub_code='$subid') order by rollno");
									while($data=mysql_fetch_array($resul)) {
										$max=$data["count"];
									}
									?>
									<from>
										<div style=" padding: 0.25rem; border: 0px solid #dddddd; ">
											<input type="number" id="no_from<?php echo  $dataRatr["batch_id"] ; ?>" class="text-center" min="1" value="1" max="<?php echo $max; ?>" name="">
											<span style="padding: 0 0.5rem;"> to </span>
											<input type="number" required="" id="no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>" class="text-center" min="1" value="<?php echo floor ($max /2) ; ?>" max="<?php echo $max; ?>" name="">
											<input type="submit"   action_type="true"  value="check" class="btn btn-sm btn-info doThings<?php echo   makeId($dataRatr["batch_id"]) ; ?>" name="">
											<input type="submit"    action_type="false"  value="un check" class="btn btn-sm btn-warning doThings<?php echo   makeId($dataRatr["batch_id"]) ; ?>" name="">
										</div>
									</from>
								</div>
								<div class="col-md-4">
									<div class="btn-group pull-right "> 
										<button style="text-transform: uppercase;" type="submit" name="update-stud-lab" id="action_type_changed<?php echo   makeId($dataRatr["batch_id"]) ; ?>" class="btn btn-success">SAVE IN <?php  echo  $dataRatr["batch_name"];  ?></button>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="box box-body">




										<input type="hidden"  value="<?php echo $_POST['subjectid']; ?>" name="subjectid">
										<input type="hidden"  value="<?php echo$dataRatr["batch_id"]; ?>" name="batch_id">
										<input type="hidden"  value="<?php echo$dataRatr["batch_name"]; ?>" name="batch_name">
										<div class="table-responsive">

											<table class="table table-bordered table-hover  " id="actoin_table<?php echo   makeId($dataRatr["batch_id"]) ; ?>">
												<thead>
													<tr>
														<th style="text-align: center;">ROLL NUMBER</th>
														<th style="text-align: center;">ADMISSION NUMBER</th>
														<th style="text-align: center;">STUDENT NAME</th>														
														<th style="text-align: center; text-transform: uppercase;">Assigned Batch</th>
														<th style="text-align: center;"></th>
													</tr>
												</thead>
												<tbody>



													<?php 
													$resul=mysql_query("SELECT current_class.studid,rollno FROM current_class WHERE current_class.classid='$classid' and current_class.studid not in(SELECT elective_student.stud_id from elective_student WHERE elective_student.sub_code='$subid') order by rollno");
													while($data=mysql_fetch_array($resul)) {
														$adm_no=$data["studid"];

														$rollno=$data["rollno"];

														$result=mysql_query("select name from stud_details where admissionno='$adm_no'");
														while($dat=mysql_fetch_array($result)) {
															$name=$dat["name"];
														}





														$sta = true;
														$isInhere = true;
														$resultTy=mysql_query(" SELECT * FROM `lab_batch_student` s LEFT JOIN lab_batch b ON b.batch_id = s.batch_id WHERE s.studid = '$adm_no' AND b.sub_code = '$subid' and classid='$classid'  AND b.sub_code IS NOT NULL ORDER BY b.batch_name LIMIT 1 ");
														while($datRa=mysql_fetch_array($resultTy)) {
															$sta=false;  
															if($dataRatr["batch_id"] != $datRa['batch_id'] )
																$isInhere = false;
														}

														if($isInhere){
															?>
															<tr >
																<td align="center"><?php  echo $rollno;?></td>
																<td align="center"><?php  echo $adm_no;?></td>
																<td align="center"><?php  echo $name;?></td>

																<td align="center" style="text-transform: uppercase;"> 

																	<?php if( $sta ): ?>
																		<span class="text-danger">not assigned</span>
																		<?php else: ?>

																			<span class="text-success"><?php  echo  $dataRatr["batch_name"];  ?></span>
																		<?php endif; ?>
																	</td>

																	<td align="center">
																		<!-- Rounded switch -->
																		<input type="hidden" class="adm_no" name="adm_no[]" value="<?php echo $adm_no; ?>">

																		<?php if( $sta ): ?>

																			<input type="checkbox" data-on="ALLOT" data-off="CANCEL"   name="lab[<?php echo $adm_no; ?>]" adm_no="<?php echo $adm_no; ?>" roll_no="<?php  echo $rollno;?>" 
																			data-toggle="toggle" data-style="ios" data-width="90"> 
																			<?php else: ?>

																				<input type="checkbox"  data-on="ALLOT" data-off="CANCEL"  checked name="lab[<?php echo $adm_no; ?>]" adm_no="<?php echo $adm_no; ?>" roll_no="<?php  echo $rollno;?>" 
																				data-toggle="toggle" data-style="ios" data-width="90">
																			<?php endif; ?>

																		</td>
																	</tr>


																	<?PHP 

																}



															}
															?>


														</tbody>
													</table>
												</div> 
											</div>
										</div>
									</div>

								</form>


							</div> 

							<?php
							?>

							<script type="text/javascript">
								$(document).ready(function($) {
									console.log('go');
									$min =$('#actoin_table<?php echo   makeId($dataRatr["batch_id"]) ; ?> tbody tr:nth-child(1) td:nth-child(1)').text().trim();
									$max =$('#actoin_table<?php echo   makeId($dataRatr["batch_id"]) ; ?> tbody tr:nth-last-child(1) td:nth-child(1)').text().trim();


									$('#no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>').attr('min', $min );
									$('#no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>').attr('max', $max );
									$('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').attr('min', $min );
									$('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').attr('max', $max );

									$('#no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val($min );
									$('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val($min );



									var doThings<?php echo   makeId($dataRatr["batch_id"]) ; ?> = ( no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>, no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>, type ) => {

										no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?> = parseInt(no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>);
										no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?> = parseInt(no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>);
										$('#actoin_table<?php echo   makeId($dataRatr["batch_id"]) ; ?> input[type=checkbox]').each(function(){

											$check = $(this); 
											$adm_no =  parseInt( $(this).attr('adm_no') ) ;
											$roll_no = parseInt( $(this).attr('roll_no') ) ; 

											if(no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?> <= $roll_no && $roll_no <= no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>) { 
												if(type == 'true')
													$check.bootstrapToggle('on');
												else
													$check.bootstrapToggle('off');
											}


										});

										$('#action_type_changed<?php echo   makeId($dataRatr["batch_id"]) ; ?>').removeClass('btn-success');
										$('#action_type_changed<?php echo   makeId($dataRatr["batch_id"]) ; ?>').addClass('btn-danger');

									}

									$(document).on('keyup change', '#no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>', function(event) {
										if( parseInt($('#no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val() ) > parseInt($('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val()) || typeof $('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val() === "undefined" || $('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val() == '')
										$('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val( $('#no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val() ); 
									});

									$(document).on('click', '.doThings<?php echo   makeId($dataRatr["batch_id"]) ; ?>', function(event) {
										event.preventDefault();
										doThings<?php echo   makeId($dataRatr["batch_id"]) ; ?> ( $('#no_from<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val(), $('#no_to<?php echo   makeId($dataRatr["batch_id"]) ; ?>').val(), $(this).attr('action_type') );
									});
									$(document).on('click', '.doThings<?php echo   makeId($dataRatr["batch_id"]) ; ?>All', function(event) { 
										$action_type = 'on';
										if( $(this).attr('action_type') == 'false' ) { 
											$action_type = 'off';                
										}
										$('#actoin_table<?php echo   makeId($dataRatr["batch_id"]) ; ?> input[type=checkbox]').each(function(){ 
											$(this).bootstrapToggle($action_type); 
										});

										$('#action_type_changed<?php echo   makeId($dataRatr["batch_id"]) ; ?>').removeClass('btn-success');
										$('#action_type_changed<?php echo   makeId($dataRatr["batch_id"]) ; ?>').addClass('btn-danger');
									});
									$('#actoin_table<?php echo   makeId($dataRatr["batch_id"]) ; ?> input[type=checkbox]').change(function() {
										$('#action_type_changed<?php echo   makeId($dataRatr["batch_id"]) ; ?>').removeClass('btn-success');
										$('#action_type_changed<?php echo   makeId($dataRatr["batch_id"]) ; ?>').addClass('btn-danger');
									});



								});
							</script>



						<?php } ?>


					</div>


				</div>
			</div>

		<?php endif; ?>

	</div>  



	<?php

	include("includes/footer.php");
	?>
