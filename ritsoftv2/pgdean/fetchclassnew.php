<?php

/**
 * @Author: indran
 * @Date:   2018-12-25 22:21:08
 * @Last Modified by:   indran
 * @Last Modified time: 2019-01-24 22:40:57
 */ 
include("includes/connection.php");
?>


<style>
.switch {
	position: relative;
	display: inline-block;
	width: 40px;
	height: 25px;
}

.switch input {display:none;}

.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	-webkit-transition: .4s;
	transition: .4s;
}

.slider:before {
	position: absolute;
	content: "";
	height: 20px;
	width: 20px;
	left: -6px;
	bottom: 3px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
}

input:checked + .slider {
	background-color: #2196F3;
}

input:focus + .slider {
	box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
	-webkit-transform: translateX(26px);
	-ms-transform: translateX(26px);
	transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
	border-radius: 30px;
}

.slider.round:before {
	border-radius: 50%;
}
</style>




<?php

if (isset($_POST["key"])) {

	if($_POST["key"] != "")
	{

		$branch=$_POST["key"];
		// "select classid from class_details where active='YES' and CONCAT(courseid,'-',branch_or_specialisation)='$branch' order by semid"
		$l=mysql_query("select classid from class_details where  CONCAT(courseid,'-',branch_or_specialisation)='$branch' order by semid") or die(mysql_error());
		if(mysql_num_rows($l)>0)
		{
			?>


			<div class="panel panel-default">
				<div class="panel-heading">
					Class Details
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									
									<th style="text-align: center;" >Current Semester</th>
									<th style="text-align: center;" >Next Semester</th>
									<th>Action</th>
									<th>Status</th>

									<th>Summary</th>
									
								</tr>
							</thead>
							<tbody>
							</tbody>

							<?php 
							while ($r=mysql_fetch_assoc($l)) {
								
								$classid=$r["classid"];
								// select curr_sem,next_sem,status from semregstatus where curr_sem='$classid'   "
								$z=mysql_query("select curr_sem,next_sem,status from semregstatus where curr_sem='$classid' AND current_class = 1 ") or die(mysql_error());
								while($x=mysql_fetch_assoc($z))
								{
									if ($x["status"]==1)
									{

										$a='disabled="disabled"';
										$m='';
									}
									else
									{
										$a=''; 
										$m='disabled="disabled"';
									}

									?>
									<tr>
										<td  style="text-align: center;"><?php
										$curr_sem=$x["curr_sem"];
										$d=mysql_query("select semid from class_details where classid='$curr_sem'")or die(mysql_error());
										$b=mysql_fetch_assoc($d);
										echo $b["semid"]; 

										?></td>

										<td  style="text-align: center;">
											
											<?php
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
											?>

										</td>



										<td>
											<?php ?>
											<?php if( $next_sem!="NIL"  ):?>
												<?php if( $x['status'] == 0 ):   ?>
													<!-- && $next_sem!="NIL" -->
													<?php ?>
													<form class="form" method="post" action=""> 
														<button type="button" onclick="updatestart('<?php echo $curr_sem; ?>')"  class="btn btn-primary btn-block" id="start<?php echo $curr_sem ?>">Start</button>
													</form>

													<?php else: ?> 

														<form class="form" method="post" action=""> 
															<button type="button" onclick="updatecomplete('<?php echo $curr_sem; ?>','<?php echo $next_sem; ?>')" <?php echo $m ?> class="btn btn-success btn-block" value="Complete"  id="complete<?php echo $curr_sem ?>">Complete</button>
														</form>

													<?php  endif; ?>
													<?php else: ?>

														<form class="form" method="post" action=""> 

															<button type="button" onclick="setlast('<?php echo $curr_sem  ?>')"    class="btn btn-danger btn-block" value="Complete"  value="Finish"  >Finish</button>
														</form>

													<?php  endif; ?>
													<?php ?>
													<?php ?>


													<?php
													if ($next_sem!="NIL" && false) {
														?>
														<input type="submit" onclick="updatestart('<?php echo $curr_sem; ?>')" class="btn btn-primary btn-block" <?php echo $a ?>  value="Start" id="start<?php echo $curr_sem ?>" >
														<?php
													}
													?>
												</td>


												<td>
													<?php
													if ($next_sem!="NIL") {
														?>
														

														<?php
														if($x["status"]==1)
														{
															echo "On Going";
                      // $k=mysql_query("select count(*) as c from current_class where classid='$curr_sem'") or die(mysql_error());
                      // $q=mysql_fetch_assoc($k);

                      // $c_count=$q["c"];
                      // $k=mysql_query("select count(*) as c from stud_sem_registration where classid='$curr_sem'") or die(mysql_error());
                      // $q=mysql_fetch_assoc($k);
                      // $n_count=$q["c"];


															$k=mysql_query("select count(studid) as c from current_class_semreg where classid='$curr_sem' and studid not in(select adm_no from stud_sem_registration where classid='$curr_sem')") or die(mysql_error());
															$q=mysql_fetch_assoc($k);

															$c_count=$q["c"];
															$k=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$curr_sem'") or die(mysql_error());
															$q=mysql_fetch_assoc($k);
															$n_count=$q["c"];



															$c_count+= $n_count;
															echo "<br>No.of Students Registered : ".$n_count;
															echo "<br>No.of Students not Registered : ".($c_count-$n_count);
															echo "<br>Total Students : ".$c_count;
														}
													} 
													?>
												</td>
												<td>
													<?php
													if ($next_sem!="NIL") {
														?>
														<a href="" onclick="getsum('<?php echo $curr_sem; ?>')" data-toggle="modal" data-target="#myModal">Summary</a>
														<?php
													}
													?>
												</td>
                                            <!-- 
                                            <td>

<label class="switch">
  <input type="checkbox" <?php echo $a; ?> onclick="update(this.value)"  value="<?php echo $r['classid'] ?>" name="<?php echo $r['classid'] ?>" id="<?php echo $r['classid'] ?>">
  <span class="slider round"></span>
</label>
</td> -->
</tr>
<?php
} 
}
?>
</tbody>
</table>
</div>
<!-- /.table-responsive -->
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->



<?php
}
}




}


?>

<script src="jquery.js"></script>



<script type="text/javascript">

	updatestart
	updatecomplete
	setlast



	function getsum(a)
	{
		$.post("semsumregnew.php",{ key : a},
			function(data){
				$('#datasum').html(data);
			});
	}



	function setlast(a)
	{
		if(confirm("Proceed only if the semester is completed.\nDo you want proceed?"))
		{
			var b=document.getElementById("branch").value;
			console.log(branch);
			$.post("updatelastnew.php",
			{
				classid: a,
				branch: b
			},
			function(data, textStatus)
			{
				alert(data);
				
				try {  window.hardRefresh(); } catch(err) {  }
				var b=document.getElementById("branch").value;
				getclass(b);
			});
		}
	}


	function updatestart(a)
	{
		if(confirm("Do you want to start semester registartion?"))
		{
			console.log(a);
			var s;
			s=1;
			var ct=document.getElementById('start'+a);
			var st=document.getElementById('complete'+a);
			
			$.post("updatestatusnew.php",
			{
				classid: a,
				status: s
			},
			function(data, textStatus)
			{
				alert(data);

				try {  window.hardRefresh(); } catch(err) {  }
				try { 

					
					st.disabled=false;
					ct.disabled=true;


				} catch(err) {  }


				var branch=document.getElementById("branch").value;
				getclass(branch);
			});
		} 
	}
	function updatecomplete(a,b)
	{
		if(confirm("Do you want to complete semester registartion?"))
		{
			console.log(a);
			var s;
			s=0;
			var ct=document.getElementById('complete'+a);
			var st=document.getElementById('start'+a);
			
			$.post("updatecompletenew.php",
			{
				curr_sem: a,
				next_sem: b,
				status: s
			},
			function(data, textStatus)
			{
				alert(data);

				try { 

					
					st.disabled=false;
					ct.disabled=true;


				} catch(err) {  }


				var branch=document.getElementById("branch").value;
				getclass(branch);

			});
		} 
	}
</script>




<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Semester Registration</h4>
			</div>
			<div class="modal-body">

				<div id="datasum">
					
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		
	</div>
</div>
