<?php
session_start();
/**
 * @Author: indran
 * @Date:   2018-08-16 11:18:55
 * @Last Modified by:   project
 * @Last Modified time: 2018-09-17 12:00:19
 */


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");




//........................................................................................................................



//.........................................................................................................................
if(isset($_POST['add_no']))
{
	$name=$_POST['add_no'];

	$sql = "SELECT * FROM stud_details WHERE admissionno='$name'";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){



			while($row = mysqli_fetch_array($result)){
				
				$rollno =  $row['rollno'];
				$admissionno =  $row['admissionno'];
				$name =  $row['name'];	
				$dob =  $row['dob'];
				$year_of_admission =  $row['year_of_admission'];	
				$email =  $row['email'];	
				$mobile_phno =  $row['mobile_phno'];
				$address =  $row['address'];
				$courseid =  $row['courseid'];
				$branch_or_specialisation =  $row['branch_or_specialisation'];
			}

			mysqli_free_result($result);
		} else{

		}  
	}



	$classid =  $_SESSION['classid'];
	$sql = "SELECT * FROM current_class WHERE studid='$admissionno' AND classid = '$classid'";
	if($resultd = mysqli_query($link, $sql)){
		if(mysqli_num_rows($resultd) > 0){  
			while($row = mysqli_fetch_array($resultd)){ 
				$rollno =  $row['rollno']; 
			} 
			mysqli_free_result($resultd);
		}  

	}

}
//................................................................................

?>

<?php if( !is_null($rollno)): ?>
	<div class="row" style="margin-top: 2rem;">

		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				ROLL NO
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $rollno; ?>
			</p>
		</div>
		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				ADMISSION NO
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<a style="text-decoration: none; font-weight: 600; " href="details.php?id=<?php  echo $admissionno; ?>" target="_blank"> 
				<p style="text-align: left;">
					<?php  echo $admissionno; ?>
				</p>
			</a>
		</div>


	</div>

	<div class="row" style="margin-top: 2rem;">

		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				NAME
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $name; ?>
			</p>
		</div>
		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				DOB
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $dob; ?>
			</p>
		</div>



	</div>

	<div class="row" style="margin-top: 2rem;">

		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				YEAR OF ADMISSION
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $year_of_admission; ?>
			</p>
		</div>
		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				EMAIL
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $email; ?>
			</p>
		</div>


	</div>

	<div class="row" style="margin-top: 2rem;">


		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				COURSEID
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $courseid; ?>
			</p>
		</div>
		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				BRANCH / SPECIALISATION
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $branch_or_specialisation; ?>
			</p>
		</div>



	</div>

	<div class="row" style="margin-top: 2rem;">
		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				MOBILE PHNO
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $mobile_phno; ?>
			</p>
		</div>
		<div class="col-sm-6 col-md-2">
			<label class="string" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				ADDRESS
			</label>
		</div>
		<div class="col-sm-6 col-md-4">
			<p style="text-align: left;">
				<?php  echo $address; ?>
			</p>
		</div>

	</div>

	<div class="row " style=" margin: 2rem; display: none;">
	

	</div>
<div class="row " style=" margin: 2rem;"></div>

	<ul class="nav nav-tabs">
		<li  class="active " ><a data-toggle="tab" href="#menu2">Assign Duty Leave</a></li>
		<li><a data-toggle="tab" href="#menu1"> View/Delete Duty Leave Assigned </a></li>
		<li style="display: none;"><a data-toggle="tab" href="#menu0">New</a></li>
	</ul>

	<div class="tab-content">
		<div id="menu0" class="tab-pane fade  ">


			<form method="post" action="" onsubmit="return  confirm('Do you really want to add duty leave?') ">


				<input type="hidden" name="admissionno" value="<?php  echo $admissionno; ?>" >


				<div class="row form-group" style="margin-top: 2rem;">
					<div class="col-sm-3 col-md-2">
						<label class="form-label" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
							date
						</label>
					</div>
					<div class="col-sm-9 col-md-8">
						<div class="input-group date" data-provide="datepicker" data-date-end-date="0d"  >
							<input type="text" class="form-control datepicker-autoclose date"  value="<?php date('Y-m-d'); ?>" id="date"   name="date" placeholder="Date " required >
							<div class="input-group-addon">
								<span class="fa fa-calendar"></span>
							</div>
						</div>
					</div>
				</div>






				<div class="row form-group" style="margin-top: 2rem;">
					<div class="col-sm-3 col-md-2">
						<label class="form-label" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
							hour
						</label>
					</div>
					<div class="col-sm-9 col-md-8"> 
						<select required class="form-control" name="hour" id="hour">
							<option selected="selected" disabled="disabled"> select hour </option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select>
					</div>
				</div>


				<div id="showFinalForSubmit"></div>


			</form>

		</div>


		<div id="menu1" class="tab-pane fade" style="padding-top: 3rem;">

			<div class="row" style="margin: 0.50rem; border-bottom: 2px solid #bbb;">

				<div class="col-sm-2 text-center ">
					<label class="string  " style="  text-transform: uppercase; font-weight: 700;  text-align: center; padding-right: 1rem;">
						date 
					</label>
				</div>

				<div class="col-sm-3 text-center ">
					<label class="string  " style="  text-transform: uppercase; font-weight: 700;  text-align: center; padding-right: 1rem;">
						subject 
					</label>
				</div>

				<div class="col-sm-1 text-center ">
					<label class="string  " style=" text-transform: uppercase; font-weight: 700;   text-align: center; padding-right: 1rem;">
						hour 
					</label>
				</div>

				<div class="col-sm-4 text-center ">
					<label class="string  " style="text-transform: uppercase; font-weight: 700;    text-align: center; padding-right: 1rem;">
						remark 
					</label>
				</div>

				<div class="col-sm-2 text-center ">
					<label class="string  " style=" text-transform: uppercase; font-weight: 700;   text-align: center; padding-right: 1rem;">
						action
					</label>
				</div>




			</div>
			<?php


			$name=$_POST['add_no'];

			$classid =  $_SESSION['classid'];

			$sql = "SELECT * FROM `duty_leave` d LEFT JOIN subject_class s ON d.subjectid = s.subjectid  WHERE d.studid='$name' AND d.subjectid IN ( SELECT subjectid FROM subject_class WHERE classid = '$classid' ) ORDER BY leave_date DESC ";
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){



					while($row = mysqli_fetch_array($result)){


						?>

						<form method="post" action="" onsubmit="return  confirm('Do you really want to remove  duty leave on <?php echo $row['leave_date']; ?> , hour	<?php echo $row['hour']; ?>?') ">
							


							<div class="row" style="margin: 0.50rem 0; padding: 0.50rem 0;  border-bottom: 1px solid #bbb;">

								<div class="col-sm-2 text-center "   >
									<label class="string  " style="   text-align: center; padding-right: 1rem;">
										<?php echo $row['leave_date']; ?>
									</label>
								</div>

								<div class="col-sm-3 text-center "  >
									<label class="string  " style="   text-align: center; padding-right: 1rem;">
										<?php echo $row['subject_title']; ?>
									</label>
								</div>

								<div class="col-sm-1 text-center "  >
									<label class="string  " style="   text-align: center; padding-right: 1rem;">
										<?php echo $row['hour']; ?>
									</label>
								</div>

								<div class="col-sm-4 text-center "   >
									<label class="string  " style="   text-align: center; padding-right: 1rem;">
										<?php echo $row['remark']; ?>
									</label>
								</div>

								<div class="col-sm-2 text-center "   >

									<input type="hidden" name="admissionno" value="<?php echo $name;  ?>"> 
									<input type="hidden" name="okay_ind_reove" class="okay_ind_reove" value="duty leave  ">

									<input type="hidden" name="subject" value="<?php echo $row['subjectid'];  ?>">
									<input type="hidden" name="hour" value="<?php echo $row['hour'];  ?>">
									<input type="hidden" name="date" value="<?php echo $row['leave_date'];  ?>">
									<input type="hidden" name="student" value="<?php echo $row['studid'];  ?>">

									<button type="submit" name="delete_duty_leave" class="btn btn-sm btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>

								</div>




							</div>

						</form>

						<?php
					}

					mysqli_free_result($result);
				} else{

				}  
			}





			?>




		</div>
		<div id="menu2" class="tab-pane fade in active">
			


			<div class="row" style="margin: 0.50rem 0; padding: 1rem 0 ; border-bottom: 2px solid #bbb;">

				<div class="col-sm-3 text-center ">
					<label class="string  " style="  text-transform: uppercase; font-weight: 700;  text-align: center; padding-right: 1rem;">
						date 
					</label>
				</div>

				<div class="col-sm-5 text-center ">
					<label class="string  " style="  text-transform: uppercase; font-weight: 700;  text-align: center; padding-right: 1rem;">
						subject 
					</label>
				</div>

				<div class="col-sm-1 text-center ">
					<label class="string  " style=" text-transform: uppercase; font-weight: 700;   text-align: center; padding-right: 1rem;">
						hour 
					</label>
				</div>

				<div class="col-sm-3 text-center ">
					<label class="string  " style=" text-transform: uppercase; font-weight: 700;   text-align: center; padding-right: 1rem;">
						action
					</label>
				</div>




			</div>
			<?php

			$name=$_POST['add_no']; 
			$classid =  $_SESSION['classid'];


			$subject=NULL;
			$date = NULL;

			$hour=NULL; 
			$subject_name=NULL; 

			// SELECT distinct(a.date),a.subjectid FROM attendance a LEFT JOIN duty_leave d ON a.studid = d.studid  where( a.studid != d.studid OR a.hour != d.hour OR a.date != d.leave_date   ) AND  a.studid != 'a'   AND a.status='A'

			$dat=mysqli_query($link,"SELECT distinct(date),subjectid FROM attendance where studid='$name' AND status='A' AND studid     ")or die(mysqli_error($link));
			while($result=mysqli_fetch_array($dat))  {

				$d=$result["date"];
				$subject=$result["subjectid"];
				$date = date("d-m-Y", strtotime($d));
				 $quer = "SELECT distinct(a.hour) FROM attendance a LEFT JOIN duty_leave d ON a.studid = d.studid  where( a.studid != d.studid OR d.studid IS NULL OR a.hour != d.hour OR d.hour IS NULL   OR a.date != d.leave_date OR d.leave_date IS NULL   ) AND  a.studid != 'a'   AND a.status='A' AND a.studid='$name' and a.subjectid='$subject' and a.date='$d'   ";

				$sql=mysqli_query($link, $quer) or die(mysqli_error($link));	
				while($row=mysqli_fetch_array($sql)) 	 {	
					$hour=$row["hour"]; 

					$c=mysqli_query($link,"select * from subject_class where subjectid='".$subject."' order by subjectid asc");
					while($re=mysqli_fetch_array($c)) {
						$subject_name = $re["subject_title"]; 
					}

					?>

					<form method="post" action="">



						<div class="row" style="margin: 0.50rem 0; padding: 0.50rem 0;  border-bottom: 1px solid #bbb;">

							<div class="col-sm-3 text-center "   >
								<label class="string  " style="   text-align: center; padding-right: 1rem;">
									<?php echo $date; ?>
								</label>
							</div>

							<div class="col-sm-5 text-center "  >
								<label class="string  " style="   text-align: center; padding-right: 1rem;">
									<?php echo $subject_name; ?>
								</label>
							</div>

							<div class="col-sm-1 text-center "  >
								<label class="string  " style="   text-align: center; padding-right: 1rem;">
									<?php echo $row['hour']; ?>
								</label>
							</div>



							<div class="col-sm-3 text-center "   >
								<input type="hidden" name="subject" value="<?php echo $subject;  ?>">
								<input type="hidden" name="hour" value="<?php echo $hour;  ?>">
								<input type="hidden" name="date" value="<?php echo $d;  ?>">
								<input type="hidden" name="admissionno" value="<?php echo $name;  ?>">
								<input type="hidden" name="remark" class="remark" value="duty leave added .. ">
								<input type="hidden" name="okay_ind" class="okay_ind" value="duty leave  ">

								<button type="button" name="delete_duty_leave" value="attendance" class="btn btn-sm btn-success okaySongleSubmit" ><i class="fa fa-tick" aria-hidden="true"></i> add attendance</button>

							</div>




						</div>

					</form>

					<?php
				}	 






			} 






			?>





		</div>
	</div>

	<?php else: ?>


		<div class="row" style="margin-top: 2rem;">

			<div class="col-sm-12 text-center ">
				<label class="string  text-warning" style="text-transform: capitalize; font-weight: 700;  text-align: center; padding-right: 1rem;">
					<i class="fa fa-exclamation-triangle " style="padding-right: 0.25rem;"></i> no result found
				</label>
			</div>




		</div>
		<?php  mysqli_close($link); ?>
	<?php endif; ?>
