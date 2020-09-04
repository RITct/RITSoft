<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");


$query=mysql_query("select distinct(name),admissionno,courseid from stud_details join current_class where admissionno='$admissionno'");
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><b>ATTENDANCE VIEW</b></h1>
		</div>
	</div>

	<?php

	while($row =mysql_fetch_assoc($query))
	{
		$name=$row['name'];
		$adm=$row['admissionno'];
		$course=$row['courseid'];


	}
	?>

	<div class="table-responsive">
		<table   class="table table-hover table-bordered" >
			<tr>
				<th style="text-align: center;">NAME</th>
				<th style="text-align: center;">ADMISSION NO</th>
				<th style="text-align: center;">COURSE</th>

			</tr>
			<tr align="center">

				<td align="center"><?php  echo $name;?></td>
				<td align="center"><?php  echo $adm;?></td>
				<td align="center"><?php  echo $course;?></td>

			</table>
		</div>
		<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" class="sear_frm" >
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="from">FROM</label>
					<?php

					$c=mysql_query("SELECT * FROM `course_academic`WHERE year_id IN ( SELECT year_id FROM academic_year WHERE status = 1 ORDER BY year_id DESC ) AND course_id IN ( SELECT  courseid FROM class_details WHERE classid IN( SELECT classid FROM current_class WHERE studid = '$admissionno') )");

					$nowDate = '';
					$endDate = date("Y-m-d");
					if($c){
						while($re=mysql_fetch_assoc($c)) {  
							// echo '<input type="date" name="date" id="sedate" class="form-control"  sdate="'.$re['start_date'].'" edate ="'.$re['start_date'].'" placehodler="dd/mm/yyyy" value="'. date("Y-m-d").'" /> ';
							$nowDate = date("Y-m-d");
							$endDate = $re['end_date'];
							if(strtotime($nowDate) > strtotime($endDate))
								$nowDate = $endDate;

							$startDate = $re['start_date'];

						}
					}
					$nowDa = $nowDate;
					if(isset($_POST['date1']))
						$nowDa = $_POST['date1'];

					echo '<div class="input-group date" data-provide="datepicker"   data-date-start-date="'.$startDate .'" data-date-end-date ="'.$nowDate.'" >'.
					' <input type="text" class="form-control mydate datepicker-autoclose"  value="'. $nowDa.'"  id="date1"   name="date1" placeholder="Date " required >'.
					'<div class="input-group-addon">'.
					'<span class="fa fa-calendar"></span>'.
					'</div>'.
					'</div>';
					?>
					<!-- <input type="date" class="form-control" id="date1" name="date1" placeholder="yyyy/mm/dd" required=""> -->
				</div>
				<div class="form-group col-md-6">
					<label for="to">TO</label>

					<?php


					$nowDa = $nowDate;
					if(isset($_POST['date2']))
						$nowDa = $_POST['date2'];

					echo '<div class="input-group date" data-provide="datepicker"   data-date-start-date="'.$startDate .'" data-date-end-date ="'.$nowDate.'" >'.
					' <input type="text" class="form-control mydate datepicker-autoclose"  value="'. $nowDa.'"  id="date2"   name="date2" placeholder="Date " required >'.
					'<div class="input-group-addon">'.
					'<span class="fa fa-calendar"></span>'.
					'</div>'.
					'</div>';
					?>

					<!-- <input type="date" class="form-control" id="date2" name="date2" placeholder="yyyy/mm/dd" required=""> -->
				</div>
			</div>
			<!-- <button type="submit" value="" name="btnshow" id="btnshow" class="btn btn-primary">View Attendence</button> -->
			<button type="submit" value="" name="btnshow-new" id="btnshow-new" class="btn btn-primary">View Attendence</button>
		</form>

		<?php

		if(isset($_POST["btnshow-new"])) {

	//$class=explode(",",$_POST['class']);
						$date1=$_POST["date1"];//for from date
						$date2=$_POST["date2"];//for to date
						include('includes/connection.php');

						$query=" SELECT a.* ,  s.* , date_format(a.date, '%d, %b %Y %a') AS daten FROM attendance a LEFT JOIN subject_class s ON a.subjectid = s.subjectid WHERE a.studid = '$admissionno' AND a.date BETWEEN '$date1' AND '$date2'  ORDER BY a.date DESC ";

						$res=mysql_query($query);
						if(mysql_num_rows($res) == 0)//if the date is not exist
						{
							echo "<script>alert('Data not Found')</script>";
						} else {  
							?>











							

							<div style="margin-top: 1rem; padding: 1rem 0;">
								<h4>Subject wise</h4>
							</div>

							<?php

							// $query="SELECT sub1, pr, wo, subject_title FROM (SELECT subjectid AS sub1, subject_title, count( HOUR ) AS pr FROM attendance NATURAL JOIN subject_class WHERE (STATUS = 'P' OR STATUS = 'A') AND studid = '$admissionno' AND date BETWEEN '$date1' AND '$date2' GROUP BY subjectid)e, (SELECT subjectid AS sub2, count( HOUR ) AS wo FROM attendance WHERE studid = '$admissionno' AND date BETWEEN '$date1' AND '$date2' GROUP BY subjectid)d WHERE sub1 = sub2";	

							$query="SELECT * FROM subject_class WHERE subjectid IN ( SELECT subjectid FROM attendance WHERE  studid = '$admissionno' AND date BETWEEN '$date1' AND '$date2' GROUP BY subjectid )  ";

							$res=mysql_query($query);
							if(mysql_num_rows($res) != 0) { 


								?>


								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th style="text-align: center;" > SUBJECT </th>
											<th style="text-align: center;" > TOTAL HOURS </th>
											<th style="text-align: center;" > PRESENT HOURS </th>
											<th style="text-align: center;">ATTENDANCE PERCENT</th>

										</tr>
									</thead>
									<tbody>
										<?php $i = 1; $sumt=0;$sump=0; ?>

										<?php while($row =mysql_fetch_assoc($res)): ?>

											<?php 


											$ca = 0;
											$cp = 0;
											$ca_cp = $ca + $cp;
											$query="SELECT COUNT(   DISTINCT date, hour, subjectid, classid, studid  ) AS c FROM attendance WHERE status = 'A' AND studid = '$admissionno' AND date BETWEEN '$date1' AND '$date2' AND subjectid='".$row['subjectid']."'   ";
											$resIn1=mysql_query($query);
											if($valIn =mysql_fetch_assoc($resIn1)) { 
												$ca = $valIn['c'];
											}

											$query="SELECT COUNT(   DISTINCT date, hour, subjectid, classid, studid   ) AS c FROM attendance WHERE status = 'P' AND studid = '$admissionno' AND date BETWEEN '$date1' AND '$date2' AND subjectid='".$row['subjectid']."'   ";


											$resIn1=mysql_query($query);
											if($valIn =mysql_fetch_assoc($resIn1)) { 
												$cp = $valIn['c'];
											}

											$ca_cp = $ca + $cp;
											$i++;
											?>



											<tr> 
												<td style="text-align: center;"><?php echo $row['subject_title']; ?> <sub style="color: blue; margin-left: 0.5rem;"><?php echo $row['subjectid']; ?></sub></td>

												<td style="text-align: center;"><?php echo $ca_cp ?></td>
												<td style="text-align: center;"><?php echo $cp ?></td>

												<?php $per=($cp/$ca_cp)*100; ?>
												<td style="text-align: center;"><?php echo round($per, 2); ?> %</td>
												<?php $sumt=$sumt+$cp; ?> 
												<?php $sump=$sump+$ca_cp; ?> 

											</tr> 
										<?php endwhile; ?>

										<?php 
										$i--;

										$agr=($sumt/$sump)*100; ?>

										<tr>

											<td  colspan="2" style="text-align: center;">TOTAL</td>
											<td  colspan="2" style="text-align: center;"> <?php  echo  round($agr, 2); ?> % </td>
										</tr> 


										
										<?php ?>
									</tbody>



								</table>




								<?php
							}
							?>




							<div style="margin-top: 1rem; padding: 1rem 0;">
								<h4 style="float: left;">Detailed</h4>
								<div  style="float: right;">
									<select id="show-filer">
										<option selected style="text-transform: uppercase;" value="w">all</option>
										<option style="text-transform: uppercase;" value="d">duty_leave</option>
										<option style="text-transform: uppercase;" value="p">PRESENT</option>
										<option style="text-transform: uppercase;" value="a">ABSENT</option>
									</select>
								</div>
							</div>

							<?php


							$query=" SELECT a.* ,  s.* , date_format(a.date, '%d, %b %Y %a') AS daten FROM attendance a LEFT JOIN subject_class s ON a.subjectid = s.subjectid WHERE a.studid = '$admissionno' AND a.date BETWEEN '$date1' AND '$date2'  ORDER BY a.date DESC ";

							$res=mysql_query($query);
							if(mysql_num_rows($res) != 0) { 
								?>


								<table class="table table-bordered table-hover" id="status-t">
									<thead>
										<tr>
											<th>#</th>
											<th>Date</th>
											<th>Hour</th>
											<th>Subject</th>
											<th>Status</th>
											<th>Duty Leave</th>
										</tr>
									</thead>
									<tbody>
										<?php $g = 1; ?>

										<?php while($row =mysql_fetch_assoc($res)): ?>

											<?php 
											$remakduty = null;

											$query="SELECT * FROM duty_leave WHERE  studid = '$admissionno' AND leave_date ='".$row['date']."'  AND subjectid='".$row['subjectid']."'    AND hour='".$row['hour']."'   ";


											$resIn1=mysql_query($query);
											if($valIn =mysql_fetch_assoc($resIn1)) { 
												$remakduty = $valIn['remark'];
											}

											?>

											<tr>
												<td><?php echo $g++; ?></td>
												<td><?php echo $row['daten']; ?></td>
												<td><?php echo $row['hour']; ?></td>
												<td><?php echo $row['subject_title']; ?> <sub><?php echo $row['subjectid']; ?></sub></td>
												<td><?php
												if($row['status'] == "P"){

													if(is_null($remakduty))
														echo '<span class="show-my-st" status="p" style="color:green">PRESENT</span>';
													else
														echo '<span class="show-my-st" status="d" style="color:#2196f3">PRESENT</span>'; 
												}
												else
													echo '<span class="show-my-st" status="a" style="color:red">ABSENT</span>';
												?></td>
												<td>
													<?php echo $remakduty; ?>
												</td>



											</tr>



										<?php endwhile; ?>
										<?php ?>
										<?php ?>
										<?php ?>
									</tbody>



								</table>




								<?php
							}


						}

					}


					if(isset($_POST["btnshow"]))
					{
	//$class=explode(",",$_POST['class']);
						$date1=$_POST["date1"];//for from date
						$date2=$_POST["date2"];//for to date
						include('includes/connection.php');
			//............Query for find hourly wise attendance of each subject................
						$query="SELECT sub1, pr, wo, subject_title FROM (SELECT subjectid AS sub1, subject_title, count( HOUR ) AS pr FROM attendance NATURAL JOIN subject_class WHERE STATUS = 'P' AND studid = '$admissionno' AND date BETWEEN '$date1' AND '$date2' GROUP BY subjectid)e, (SELECT subjectid AS sub2, count( HOUR ) AS wo FROM attendance WHERE studid = '$admissionno' AND date BETWEEN '$date1' AND '$date2' GROUP BY subjectid)d WHERE sub1 = sub2";

						$res=mysql_query($query);
						if(mysql_num_rows($res) == 0)//if the date is not exist
						{
							echo "<script>alert('Data not Found')</script>";
						}
						else
						{
							?>
							<div id="page-wrapper">
								<div class="table-responsive">
									<table   class="table table-hover table-bordered" >
										<tr>
											<th style="text-align: center;" > SUBJECT </th>
											<th style="text-align: center;">ATTENDANCE PERCENT</th>
										</tr>
										<?php		
										$sum=0;
										$i=0;
										while($row =mysql_fetch_assoc($res))
										{
											$i++;
											echo "<tr>";
											echo "<td>".$row['sub1']."</td>";
											$per=($row['pr']/$row['wo'])*100;
											echo "<td>".$per."</td>";
											$sum=$sum+$per;
											echo "</tr>";
										}
										$agr=$sum/$i;

										echo "<tr>

										<td >TOTAL</td>
										<td >".  $agr."</td>
										</tr>";
									}
								}

								?>
							</tbody>
						</div>
					</table>     


					<?php

					include("includes/footer.php");
					?>
					<script type="text/javascript">
						
						$(document).ready(function($) {
							$(document).on('change', '#show-filer', function(event) {
								event.preventDefault();
								$rootStatus = $(this).val();

								console.log($rootStatus);

								$('#status-t tbody').find('tr').each(function(index, el) {
									$this = $(this);
									$status = $this.find('.show-my-st').attr('status');
									if ($status != $rootStatus && $rootStatus != 'w') {
										$this.css({'display': 'none'});
									} else {
										$this.css({'display': 'table-row'}); 
									}

								});

							});
						});


					</script>
