<?php
include("includes/connection.php");
?>


<?php

if (isset($_POST["key"])) {
	if ($_POST["key"]!="") {
		$curr_sem=$_POST["key"];		
		?>

		<ul class="nav nav-tabs">
			
			<li class="active"><a data-toggle="tab"  href="#menu1">Approved</a></li>
			<li><a data-toggle="tab" href="#menu2">Pending</a></li>
			<li><a data-toggle="tab" href="#menu3">Not Applied</a></li>
		</ul>

		<div class="tab-content">
			<div id="menu1" class="tab-pane fade in active">
				<h3>Apporved List</h3>
				






				<div class="table-responsive">
					<table   class="table table-hover table-bordered" >
						<tr>
							<th style="text-align: center;">ADMISSION NUMBER</th>
							<th style="text-align: center;">NAME</th>
							<th style="text-align: center;">CURRENT SEM</th>
							<th style="text-align: center;">NEXT SEM</th>
							<th style="text-align: center;">APPLICATION STATUS</th>
							

						</tr>




						<?php
//reading student details
						$resul=mysql_query("select reg_id,adm_no,classid,apl_status,previous_sem,new_sem,apv_status,remarks from stud_sem_registration where classid='$' and (apl_status='Approved')");

						while($dat=mysql_fetch_array($resul))
						{
							$adm_no=$dat["adm_no"];
							$previous_sem=$dat["previous_sem"];
							$new_sem=$dat["new_sem"];
							$apv_status=$dat["apv_status"];
							$apl_status=$dat["apl_status"];
							$reg_id=$dat["reg_id"];
							$remarks=$dat["remarks"];


							$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   

							while($dat=mysql_fetch_array($result1))
							{
								$name=$dat["name"];
							}
							?>
							<tr align="center">

								<td align="center"><?php  echo $adm_no;?></td>
								<td align="center"><?php  echo $name;?></td>
								<td align="center"><?php  echo $previous_sem;?></td>
								<td align="center"><?php  echo $new_sem; ?></td>
								<td align="center" style="color: green;"><?php  echo $apl_status; ?></td>
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
							<th style="text-align: center;">ADMISSION NUMBER</th>
							<th style="text-align: center;">NAME</th>
							<th style="text-align: center;">CURRENT SEM</th>
							<th style="text-align: center;">NEXT SEM</th>
							<th style="text-align: center;">APPLICATION STATUS</th>
							<th style="text-align: center;">REMARKS</th>

						</tr>




						<?php
//reading student details
						$resul=mysql_query("select reg_id,adm_no,classid,apl_status,previous_sem,new_sem,apv_status,remarks from stud_sem_registration where classid='$classid' and (apl_status!='Approved')");

						while($dat=mysql_fetch_array($resul))
						{
							$adm_no=$dat["adm_no"];
							$previous_sem=$dat["previous_sem"];
							$new_sem=$dat["new_sem"];
							$apv_status=$dat["apv_status"];
							$apl_status=$dat["apl_status"];
							$reg_id=$dat["reg_id"];
							$remarks=$dat["remarks"];


							$result1=mysql_query("select * from stud_details where admissionno='$adm_no'");   

							while($dat=mysql_fetch_array($result1))
							{
								$name=$dat["name"];
							}
							?>
							<tr align="center">

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
							<th style="text-align: center;">ADMISSION NUMBER</th>
							<th style="text-align: center;">NAME</th>
							<th style="text-align: center;">MOBILE NUMBER</th>
							


						</tr>




						<?php
//reading student details
						$resul=mysql_query("select studid,name,mobile_phno from current_class,stud_details where admissionno=studid and classid='$curr_sem' and studid not in(select adm_no from stud_sem_registration where classid='$curr_sem' ) order by name") or die(mysql_error());

						while($dat=mysql_fetch_array($resul))
						{
							$adm_no=$dat["studid"];
							$name=$dat["name"];
							$mobile=$dat["mobile_phno"];
							?>
							<tr align="center">

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