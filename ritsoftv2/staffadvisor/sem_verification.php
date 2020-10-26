<?php
/**
 * @Author: indran
 * @Date:   2018-07-02 23:04:03
 * @Last Modified by:   indran
 * @Last Modified time: 2018-08-11 06:11:54
 */
include("includes/header.php");
?>


<?php
include("includes/sidenav.php");
include("../connection.php");
$count=0;
$classid=$_SESSION["classid"];
?>




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
<script  src="jquery.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>


<script type="text/javascript">
	$(document).ready(function($) {
		$('.DataTable').DataTable();
	});

	function setid(a) {
		console.log(a); 
		document.getElementById('reg_id').value = a;

	}
</script>





<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12" >
			<h1 class="page-header">SEMESTER VERIFICATION
			</h1>
			<a  href="semregview.php"  style="float: right;">Summary</a>

		</div>
		<!-- /.col-lg-12 -->
	</div>
	<br>
	<?php 
	$resul=mysql_query("select reg_id,adm_no,classid,apl_status,previous_sem,new_sem,apv_status,remarks from stud_sem_registration where classid='$classid' and (apv_status='Rejected by HOD' or apv_status='Not Approved')");
	

	?> 

	<?php  if( ! is_null( mysql_fetch_array($resul) || true  )): ?>
		<div class="row">
			<div class="col-md-12 pull-right text-right">
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#indran" style=" margin-bottom: 2pc; ">bulk verification </button>
			</div>   
		</div>
	<?php endif; ?> 

	<div class="table-responsive">
		<table   class="table table-hover DataTable" >
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
				$resul=mysql_query("select reg_id,adm_no,classid,apl_status,previous_sem,new_sem,apv_status,remarks from stud_sem_registration where classid='$classid' and (apv_status='Rejected by HOD' or apv_status='Not Approved')");
				

				?> 

				<?php
//reading student details
				

				while($dat=mysql_fetch_array($resul)) {

					$adm_no=$dat["adm_no"];
					$previous_sem=$dat["previous_sem"];
					$new_sem=$dat["new_sem"];
					$apv_status=$dat["apv_status"];
					$apl_status=$dat["apl_status"];
					$reg_id=$dat["reg_id"];
					$remarks=$dat["remarks"];


					$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   

					while($dat=mysql_fetch_array($result1)) {
						$name=$dat["name"];
					} 
					if($apl_status=='Applied' && $apv_status!="Rejected by staff advisor") 	{
						?>
						<tr align="center">

							<td align="center"><?php  echo $adm_no;?></td>
							<td align="center"><?php  echo $name;?></td>
							<td align="center"><?php  echo $previous_sem;?></td>
							<td align="center"><?php  echo $new_sem; ?></td>
							<?php
							if($apv_status!="Not Approved")
								{ ?>
									<td><?php echo $apv_status;?>
									<br><div class="btn-group">
										<a onclick="return confirm('Do you really want to verify this request?');" href="semregedit.php?id=<?php echo $reg_id;?>&id2=1"><font color="green">Verify</font></a> | 
										<a href="#" onclick="setid(<?php echo $reg_id;?>)"  
											data-toggle="modal" data-target="#myModal"
											><font color="red">Reject</font></a>


										</div></td>
										<?php
									}
									else
									{
										?>
										<td>
											<div class="btn-group">
												<a onclick="return confirm('Do you really want to verify this request?');" href="semregedit.php?id=<?php echo $reg_id;?>&id2=1"><font color="green">Verify</font></a> | 
												<a href="#" onclick="setid(<?php echo $reg_id;?>)"  
													data-toggle="modal" data-target="#myModal"
													><font color="red">Reject</font></a>


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
							?>

						</tbody>
					</table> 
				</div>



				<!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<form method="post" action="semregedit.php">

							<div class="modal-content">
								<div class="modal-header">
									Remarks
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">

									<div data-role="popup" id="myPopup" class="ui-content" style="min-width:300px;">
										<?php

										?>

										<div>

											<input class="ui-accessible" type="hidden" name="reg_id" id="reg_id" >
											<label for="text" class="ui-hidden-accessible">Message:</label>
											<textarea type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter remarks here!"></textarea>

										</div>

									</div>


								</div>
								<div class="modal-footer">
									<input type="submit" data-inline="true" class="btn btn-primary" value="Send" name="btn_send" id="btn_send">
								</div>
							</div>
						</form>
					</div>
				</div>





			</div> 












			<!-- /.row -->
			<div class="row">


				<!-- /.row -->
				<div class="row">
					<div class="col-lg-8">

					</div>
					<!-- /.panel-heading -->

					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->

				<!-- /.panel-body -->

				<!-- /.panel-footer -->
			</div>
			<!-- /.panel .chat-panel -->
		</div>
		<!-- /.col-lg-4 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->   




<div class="modal fade" id="indran" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">

			<form method="post" action="semregedit.php" id="bulk-ok-form"  onsubmit="return confirm('Do you really want to submit the form?');">
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
									$resul=mysql_query("select reg_id,adm_no,classid,apl_status,previous_sem,new_sem,apv_status,remarks from stud_sem_registration where classid='$classid' and (apv_status='Rejected by HOD' or apv_status='Not Approved')");


									while($dat=mysql_fetch_array($resul)) {
										$adm_no=$dat["adm_no"];
										$previous_sem=$dat["previous_sem"];
										$new_sem=$dat["new_sem"];
										$apv_status=$dat["apv_status"];
										$apl_status=$dat["apl_status"];
										$reg_id=$dat["reg_id"];
										$remarks=$dat["remarks"];


										$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   

										while($dat=mysql_fetch_array($result1)) {
											$name=$dat["name"];
										}
										if($apl_status=='Applied' && $apv_status!="Rejected by staff advisor") {
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

<script type="text/javascript">
	$(document).ready(function($) {
		$(document).on('click', '.check-all', function(event) {
			event.preventDefault(); 
			if($(this).attr('now-check') == 'true'){
				$('#bulk-ok-form').find('input[type=checkbox]').prop('checked', false);
				$(this).attr('now-check','false' );
			} else {
				$('#bulk-ok-form').find('input[type=checkbox]').prop('checked', true);
				$(this).attr('now-check','true' );
			}

		});
	});
</script>



<?php

include("includes/footer.php");
?>
