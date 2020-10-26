<?php 
include("../connection.php");
?>
<?php
if (isset($_POST["key"])) {
	if ($_POST["key"]!="") {
		
		$curr_sem=$_POST["key"];
		$query=mysql_query("select courseid,branch_or_specialisation,semid from class_details where classid='$curr_sem'") or die(mysql_error());
		$res=mysql_fetch_assoc($query);
		?>
		Course :  <?php echo $res["courseid"];  ?>
		<br>
		Branch : <?php echo $res["branch_or_specialisation"]; ?>
		<br>
		Current Semester : <?php echo $res["semid"]; ?>
		<br>
		Next Semester : <?php echo ($res["semid"] + 1); ?>
		<ul class="nav nav-tabs">
			
			<li class="active"><a data-toggle="tab"  href="#menu1">Approved</a></li>
			<li><a data-toggle="tab" href="#menu2">Pending</a></li>
			<li><a data-toggle="tab" href="#menu3">Not Applied</a></li>
		</ul>

		<div class="tab-content">
			<div id="menu1" class="tab-pane fade in active">
				<h3>Apporved List</h3>
				

				<!-- 		-->





				<div class="table-responsive">
					<table   class="table table-hover table-bordered" >
						<tr>
							<th style="text-align: center; text-transform: uppercase;">serial no</th>
							<th style="text-align: center;">ADMISSION NUMBER</th>
							<th style="text-align: center;">NAME</th>
							<th style="text-align: center;">CURRENT SEM</th>
							<th style="text-align: center;">NEXT SEM</th>
							<th style="text-align: center;">APPLICATION STATUS</th>
							

						</tr>




						<?php
//reading student details
						$resul=mysql_query("select reg_id,adm_no,classid,apl_status,previous_sem,new_sem,apv_status,remarks from stud_sem_registration where classid='$curr_sem' and (apl_status='Approved')");
						$serial_no = 0;
						while($dat=mysql_fetch_array($resul))
						{
							$adm_no=$dat["adm_no"];
							$previous_sem=$dat["previous_sem"];
							$new_sem=$dat["new_sem"];
							$apv_status=$dat["apv_status"];
							$apl_status=$dat["apl_status"];
							$reg_id=$dat["reg_id"];
							$remarks=$dat["remarks"];
							$serial_no++;

							$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   

							while($dat=mysql_fetch_array($result1))
							{
								$name=$dat["name"];
							}

							$adm_status = "";

							$reW=mysql_query("select * from current_class where studid = '$adm_no' ");
							while($dat2www=mysql_fetch_array($reW)) { 
								$adm_status =  $dat2www["adm_status"] ; 
							}




							?>
							<tr align="center">
								<td align="center"><?php  echo $serial_no;?></td>
								<td align="center"><?php  echo $adm_no;?></td>
								<td align="center"><?php  echo $name;?></td>
								<td align="center"><?php  echo $previous_sem;?></td>
								<td align="center"><?php  echo $new_sem; ?></td>
								<td align="center" style="color: green;">

									<?php 
									if(strlen( trim($adm_status) ) > 4)
										echo   " <span style='padding-left:0.5rem; color:red; ' > " .$adm_status . "</span> ";
									else 
										echo $apl_status ;

									?>

									<!-- <?php  /* echo $apl_status; */ ?> -->


								</td>
							</tr>
						<?php } ?>
					</table> 
				</div>














			</div>



			<div id="menu2" class="tab-pane fade">
				<h3>Pending List</h3>
				<div class="table-responsive">
					<table   class="table table-hover table-bordered" >
						<tr>
							<th style="text-align: center; text-transform: uppercase;">serial no</th>
							<th style="text-align: center;">ADMISSION NUMBER</th>
							<th style="text-align: center;">NAME</th>
							<th style="text-align: center;">CURRENT SEM</th>
							<th style="text-align: center;">NEXT SEM</th>
							<th style="text-align: center;">APPLICATION STATUS</th>
							<th style="text-align: center;">REMARKS</th>

						</tr>




						<?php
//reading student details
						$resul=mysql_query("select reg_id,adm_no,classid,apl_status,previous_sem,new_sem,apv_status,remarks from stud_sem_registration where classid='$curr_sem' and (apl_status!='Approved')");
						$serial_no = 0;
						while($dat=mysql_fetch_array($resul))
						{
							$adm_no=$dat["adm_no"];
							$previous_sem=$dat["previous_sem"];
							$new_sem=$dat["new_sem"];
							$apv_status=$dat["apv_status"];
							$apl_status=$dat["apl_status"];
							$reg_id=$dat["reg_id"];
							$remarks=$dat["remarks"];
							$serial_no++;

							$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   

							while($dat=mysql_fetch_array($result1))
							{
								$name=$dat["name"];
							}
							?>
							<tr align="center">
								<td align="center"><?php  echo $serial_no;?></td>
								<td align="center"><?php  echo $adm_no;?></td>
								<td align="center"><?php  echo $name;?></td>
								<td align="center"><?php  echo $previous_sem;?></td>
								<td align="center"><?php  echo $new_sem; ?></td>
								<td align="center" style="color: orange;"><?php  echo $apv_status; ?></td>
								<td align="center" ><?php  echo $remarks; ?></td>
							</tr>
						<?php } ?>
					</table> 
					
					
				</div>

			</div>
			<div id="menu3" class="tab-pane fade">
				<h3>Not Applied List</h3>
				





				<div class="table-responsive">
					<table   class="table table-hover table-bordered" >
						<tr>
							<th style="text-align: center; text-transform: uppercase;">serial no</th>
							<th style="text-align: center;">ADMISSION NUMBER</th>
							<th style="text-align: center;">NAME</th>
							<th style="text-align: center;">MOBILE NUMBER</th>
							


						</tr>




						<?php
//reading student details
						$resul=mysql_query("select studid,name,mobile_phno from current_class,stud_details where admissionno=studid and classid='$curr_sem' and studid not in(select adm_no from stud_sem_registration where classid='$curr_sem'  ) order by name") or die(mysql_error());
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


			</div>

			<?php
		}
	}

	?>