<?php

/**
 * @Author: indran
 * @Date:   2018-09-07 18:32:29
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-09 06:58:55
 */ 
include("includes/connection.php");
?>


<?php 

if (isset($_POST['action'])) {




	if (isset($_POST["key"])) {

		if($_POST["key"] != "") {

			$branch=$_POST["key"];
			$l=mysql_query("select classid from class_details where active='YES' and CONCAT(courseid,'-',branch_or_specialisation)='$branch' order by semid") or die(mysql_error());
			if(mysql_num_rows($l)>0) {

				?>

				<select class="form-control" id="semme" onchange="doSomeDa (this.value)">
					<option selected disabled > select </option>
					<?php

					while ($r=mysql_fetch_assoc($l)) {

						$classid=$r["classid"];
						$z=mysql_query("select curr_sem,next_sem,status from semregstatus where curr_sem='$classid'") or die(mysql_error());
						while($x=mysql_fetch_assoc($z)) { 
							$curr_sem=$x["curr_sem"];
							$d=mysql_query("select semid from class_details where classid='$curr_sem'")or die(mysql_error());
							$b=mysql_fetch_assoc($d);

							?>

							<option value="<?php echo $b["semid"];  ?>"><?php echo $b["semid"];  ?></option>
							


							<?php
						}
					}

					?>
				</select>

				<?php
			}
		}
	}




	exit(); 
}else if (isset($_POST["key"]) && isset($_POST["semme"])) {





	if (isset($_POST["key"])) {

		if($_POST["key"] != "") {

			$branch=$_POST["key"];
			$l=mysql_query("select classid, branch_or_specialisation from class_details where active='YES' and CONCAT(courseid,'-',branch_or_specialisation)='$branch' AND semid  ='".$_POST['semme']."' order by semid") or die(mysql_error());
			if(mysql_num_rows($l)>0) {

				?> 
				<?php
				while ($r=mysql_fetch_assoc($l)) {

					$classid=$r["classid"];

					$z=mysql_query("select curr_sem,next_sem,status from semregstatus where curr_sem='$classid'  ") or die(mysql_error());
					while($x=mysql_fetch_assoc($z)) { 
						$curr_sem=$x["curr_sem"];
						$d=mysql_query("select semid from class_details where classid='$curr_sem'   ")or die(mysql_error());
						$b=mysql_fetch_assoc($d);

						?>

						
						<table class="table   table-striped">

							<tr>
								<th>Branch</th>
								<td><?php echo $r["branch_or_specialisation"] ;  ?></td>
							</tr>


							<tr>
								<th>Current Semester</th>
								<td><?php
								$curr_sem=$x["curr_sem"];
								$d=mysql_query("select semid from class_details where classid='$curr_sem'")or die(mysql_error());
								$b=mysql_fetch_assoc($d);
								echo $b["semid"]; 

								?></td>
							</tr>


							<tr>
								<th>Next Semester</th>
								<td><?php
								$next_sem=$x["next_sem"];
								if ($next_sem=="NIL") {
									echo "NIL";
								}
								else
								{
									$d=mysql_query("select semid from class_details where classid='$next_sem'")or die(mysql_error());
									$b=mysql_fetch_assoc($d);
									echo $b["semid"]; 
								}
								?></td>
							</tr>


							
							<tr>
								<th>Semester Registration</th>
								<?php if($x["status"]==1): ?>
									<td><?php echo 'On Going';  ?></td>
									<?php else: ?> 
										<td><?php echo 'Not Started';  ?></td> 
									<?php endif; ?>
								</tr> 


								<!-- <tr>
									<th>current semester</th>
									<td><?php echo $_POST['semme'];  ?></td>
								</tr> -->


								<?php

								
								$k=mysql_query("select count(studid) as c from current_class where classid='$curr_sem' and studid not in(select adm_no from stud_sem_registration where classid='$curr_sem')") or die(mysql_error());
								$q=mysql_fetch_assoc($k);

								$c_count=$q["c"];
								$k=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$curr_sem'") or die(mysql_error());
								$q=mysql_fetch_assoc($k);
								$n_count=$q["c"];

								$c_count+= $n_count;


								?>


								<tr>
									<th>Total Students</th>
									<td><?php echo $c_count;  ?></td>
								</tr>

								<tr>
									<th>Students Registered</th>
									<td><?php echo $n_count;  ?></td>
								</tr>
								<tr>
									<th>Students Not Registered <button type="button" class="btn btn-info btn-sm " style="padding-left: 0.5rem; float: right;" data-toggle="collapse" data-target="#demo">View Details</button></th>
									<td><?php echo ($c_count-$n_count);  ?></td>
								</tr>
								<tr id="demo" class="collapse">
									<td colspan="2">
										<div >
											





											<div class="table-responsive">
												<table   class="table table-hover table-bordered" >
													<tr><th style="text-align: center; text-transform: uppercase;">serial no</th>
														<th style="text-align: center;">ADMISSION NUMBER</th>
														<th style="text-align: center;">NAME</th>
														<th style="text-align: center;">MOBILE NUMBER</th>



													</tr>




													<?php
											//reading student details
													$resul=mysql_query("select studid,name,mobile_phno from current_class,stud_details where admissionno=studid and classid='$classid' and studid not in(select adm_no from stud_sem_registration where  classid='$classid' ) order by name") or die(mysql_error());
													$serial_no = 0;
													while($dat=mysql_fetch_array($resul))
														{$serial_no++;
															$adm_no=$dat["studid"];
															$name=$dat["name"];
															$mobile=$dat["mobile_phno"];
															?>
															<tr align="center">
																<td align="center"><?php  echo $serial_no;?></td>
																<td align="center"><?php  echo $adm_no;?></td>
																<td align="center"><?php  echo $name;?></td>
																<td align="center"><?php  echo $mobile;?></td>
															</tr>
														<?php } ?>
													</table> 
												</div>

											</div>

										</td>
									</tr>

									<tr>
										<th>Approved by office</th>
										<td><?php 
// apl_status='Approved' AND 
										$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND  apl_status='Approved' AND apv_status = 'Approved by office' ") or die(mysql_error());
										$qx=mysql_fetch_assoc($kx);
										echo  $qx["c"]; ?></td>
									</tr>

									<tr>
										<th>Verification Pending by office</th>
										<td><?php 
// apl_status='' AND 
										$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND apv_status = 'Approved by HOD'") or die(mysql_error());
										$qx=mysql_fetch_assoc($kx);
										echo  $qx["c"]; ?></td>
									</tr>

									<tr>
										<th>Verification Pending by HOD</th>
										<td><?php 
// apl_status='' AND 
										$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND (apv_status = 'Approved by staff advisor' or apv_status ='Rejected by office')") or die(mysql_error());
										$qx=mysql_fetch_assoc($kx);
										echo  $qx["c"]; ?></td>
									</tr>

									<tr>
										<th>Verification Pending by staff advisor</th>
										<td><?php 
// apl_status='' AND 
										$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND (apv_status = 'Not Approved' or apv_status='Rejected by HOD')") or die(mysql_error());
										$qx=mysql_fetch_assoc($kx);
										echo  $qx["c"]; ?></td>
									</tr>
									<tr>
										<th>No: of Students application rejected by staff advisor (Re-apply)</th>
										<td><?php 
// apl_status='' AND 
										$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND apv_status = 'Rejected by staff advisor'") or die(mysql_error());
										$qx=mysql_fetch_assoc($kx);
										echo  $qx["c"]; if ($qx["c"]>0){ echo " (Should be Verified by Staff Advisor)";}?> </td>
									</tr>


								</table>



								<form method="post" action="now_create_pdf.php" target="_blank"  download="status">
									<input type="hidden" name="key"  value="<?php echo  $_POST["key"] ; ?>">
									<input type="hidden" name="semme"  value="<?php echo  $_POST["semme"]; ?>">
									<input type="submit" class="btn btn-warning" name="" value="VIEW PDF">
								</form>

								<?php
							}
						}

						?> 

						<?php
					}
				}
			}




			exit(); 



		}


		?>






