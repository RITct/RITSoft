<?php
session_start();
//link for connection.php
include("../connection.php");

/**
 * @Author: indran
 * @Date:   2018-07-02 21:15:33
 * @Last Modified by:   indran
 * @Last Modified time: 2018-08-24 12:55:08
 */
?>

<!-- table creation -->
<?php  if(isset($_POST["key"])): ?>
	<?php  if($_POST["key"] != ''): ?>
		<div class="row">
			<div class="col-md-12 pull-right text-right">
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#indran" style=" margin-bottom: 2pc; ">bulk verification </button>
			</div>   
		</div>
	<?php endif; ?>
<?php endif; ?>
<div class="table-responsive">
	<table   class="table table-hover  DataTable" >
		<thead>
			<tr>
				<th style="text-align: center;">ADMISSION NUMBER</th>
				<th style="text-align: center;">NAME</th>
				<th style="text-align: center;">CURRENT SEM</th>
				<th style="text-align: center;">NEXT SEM</th>
				<th style="text-align: center;">APPLICATION STATUS</th>
				<th style="text-align: center;">REMARK</th>
			</tr>
		</thead>
		<tbody>



			<?php
			if(isset($_POST["key"])) {
				$classid=$_POST["key"];
	//echo $classid;
//reading registration details from stud_sem_registration 
				$resul=mysql_query("select s.reg_id,s.adm_no,s.classid,s.apl_status,s.previous_sem,s.new_sem,s.apv_status,s.remarks from stud_sem_registration s,current_class_semreg c where s.classid='$classid'and s.classid=c.classid and c.studid=s.adm_no and s.apv_status='Approved by HOD' order by c.rollno ");
				while($dat=mysql_fetch_array($resul)) {
					$adm_no=$dat["adm_no"];
					$previous_sem=$dat["previous_sem"];
					$new_sem=$dat["new_sem"];
					$apv_status=$dat["apv_status"];
					$apl_status=$dat["apl_status"];
					$reg_id=$dat["reg_id"];
					$remarks=$dat["remarks"];
//fetching data from stud_details
					$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   
					while($dat=mysql_fetch_array($result1))  {
						$name=$dat["name"];
					}
//check student semester registration applied status
					if($apl_status=='Applied' || $apv_status!='Rejected by office' )  {
						?>
						<tr align="center">
							<td align="center"><?php  echo $adm_no;?></td>
							<td align="center"><?php  echo $name;?></td>
							<td align="center"><?php  echo $previous_sem;?></td>
							<td align="center"><?php  echo $new_sem; ?></td>
							<?php
//check student semester registration approval status 
							if($apv_status!="Approved by office") { 
								?>
								<td><?php echo $apv_status;?>
								<div class="btn-group">
									<a  onclick="return confirm('Do you really want to verify this request?');"  href="semregeditnew.php?id=<?php echo $reg_id;?>&id2=1&id3=<?php echo $classid ?>"><font color="green">Admitted</font></a> | 
									<a href="#" onclick="setid(<?php echo $reg_id;?>,'<?php echo $classid ?>')"  
										data-toggle="modal" data-target="#myModal"
										><font color="red">Reject</font></a> |
										<a  onclick="return confirm('Do you really want to verify this request?');"  href="semregeditnew.php?id=<?php echo $reg_id;?>&id2=21&id3=<?php echo $classid ?>"><font class="text-info">Provisionally Admitted</font></a> 
										


									</div>
								</td>
								<?php
							}  else   {
								?>
								<td>
									<div class="btn-group">
										<a   onclick="return confirm('Do you really want to verify this request?');"  href="semregeditnew.php?id=<?php echo $reg_id;?>&id2=1&id3=<?php echo $classid ?>"><font color="green">Admitted</font></a> | 
										<a href="#" onclick="setid(<?php echo $reg_id;?>,'<?php echo $classid ?>')"  
											data-toggle="modal" data-target="#myModal"
											><font color="red">Reject</font></a> |
											<a  onclick="return confirm('Do you really want to verify this request?');"  href="semregeditnew.php?id=<?php echo $reg_id;?>&id2=21&id3=<?php echo $classid ?>"><font class="text-info">Provisionally Admitted</font></a> 
										</div>
									</td>
									<?php
								}
								?>
								<td align="center"><?php  echo $remarks; ?></td>


							</tr>

							<?PHP
						}
					}
				}
				?>

			</tbody>

		</table> 
	</div>



	<!-- Trigger the modal with a button -->
	<?php


	if(isset($_POST["key"])) {
		$classid=$_POST["key"];
		?>
		<!-- Modal -->
		<div class="modal fade" id="indran" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">

					<form method="post" action="semregeditnew.php" id="bulk-ok-form"  onsubmit="return confirm('Do you really want to submit the form?');">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">bulk verification</h4>
						</div>
						<div class="modal-body">
							<p></p>
							<div class="row">
								<div class="col-md-6 text-left pull-left">
									<input type="hidden" name="bulk" value="true">
									<button type="button"  class="text-uppercase btn btn-sm btn-info check-all">check all</button>
								</div>  
								<div class="col-md-6 text-right pull-right">
									<input type="hidden" name="bulk" value="true">
									<button type="submit"  class="text-uppercase btn btn-sm btn-warning">go</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12" style=" padding: 0 15px; ">

									<table   class="table table-hover " >
										<thead>
											<tr>
												<th class="col-md-2">ADM NO</th>
												<th >NAME</th>
												<th  >C-SEM</th>
												<th  >N-SEM</th> 
												<th class="col-md-4 text-uppercase text-right">Verify</th>
											</tr>
										</thead>
										<tbody>



											<?php
											$inr567097 = 0;
            //echo $classid;
        //reading registration details from stud_sem_registration 
											$resul=mysql_query("select s.reg_id,s.adm_no,s.classid,s.apl_status,s.previous_sem,s.new_sem,s.apv_status,s.remarks from stud_sem_registration s,current_class_semreg c where s.classid='$classid'and s.classid=c.classid and c.studid=s.adm_no and s.apv_status='Approved by HOD' order by c.rollno ");
											while($dat=mysql_fetch_array($resul)) {
												$adm_no=$dat["adm_no"];
												$previous_sem=$dat["previous_sem"];
												$new_sem=$dat["new_sem"];
												$apv_status=$dat["apv_status"];
												$apl_status=$dat["apl_status"];
												$reg_id=$dat["reg_id"];
												$remarks=$dat["remarks"];
        //fetching data from stud_details
												$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   
												while($dat=mysql_fetch_array($result1))  {
													$name=$dat["name"];
												}
        //check student semester registration applied status
												if($apl_status=='Applied' || $apv_status!='Rejected by office' )  {
													?>
													<tr>
														<td><?php  echo $adm_no;?></td>
														<td><?php  echo $name;?></td>
														<td><?php  echo $previous_sem;?></td>
														<td><?php  echo $new_sem; ?></td>
														<?php
        //check student semester registration approval status 
														if($apv_status!="Approved by office") { 
															$inr567097++;
															?>
															<td>

																<div class="">
																	<small><?php echo $apv_status;?></small>
																	<input type="hidden" name="id1[<?php echo $inr567097 ; ?>]" value="<?php echo $reg_id;?>">
																	<input type="hidden" name="id2[<?php echo $inr567097 ; ?>]" value="1">
																	<input type="hidden" name="id3[<?php echo $inr567097 ; ?>]" value="<?php echo $classid ?>">
																	<input style="float: right;" type="checkbox" class="action_okay" name="action[<?php echo $inr567097 ; ?>]" value="1"> 
																</div>
															</td>
															<?php
														}  else   {
															$inr567097++;
															?>
															<td>
																<div class="">
																	<input type="hidden" name="id1[<?php echo $inr567097 ; ?>]" value="<?php echo $reg_id;?>">
																	<input type="hidden" name="id2[<?php echo $inr567097 ; ?>]" value="1">
																	<input type="hidden" name="id3[<?php echo $inr567097 ; ?>]" value="<?php echo $classid ?>">
																	<input style="float: right;" type="checkbox" class="action_okay" name="action[<?php echo $inr567097 ; ?>]" value="1"> 
																</div> 
															</td>
															<?php
														}
														?>


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
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>

					</form>
				</div>

			</div>
		</div>
		<?php 
	} 
	?>
