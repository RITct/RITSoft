<?php

/**
 * @Author: riya kaduthus
 * @Date:   2019-11-08 01:22:37
 * @Last Modified by:   riya kaduthus
 * @Last Modified time: 2019-11-08 01:22:37
 */
include("connection.php");
include("includes/header.php");
include("includes/sidenav.php");
$uname=$_SESSION['fid'];
//$uname='KTU02';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="jquery-ui.css" rel="stylesheet">
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-ui.js" type="text/javascript"></script>
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
<script >
$(document).ready(function(e)
{
  var i=1;
  var max= 10;
  $("#add").click(function(e){
    if(i<=max)
    {
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="topic_no[]" id="child_topic_no" class="form-control" value="'+i+'"/></td><td><textarea class="form-control" rows="1" cols="100" name="topic[]" id="child_topic"></textarea></td><td> <input class="form-control" type="text" name="co[]" id="child_co"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    }
  });
  $(document).on('click','.btn_remove',function(e){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
    i--;
  }
  );
});
</script>

	<script>
		$(document).ready(function() {
			$("#sub").change(function () {
				var str = "";
				if ($("#sub option:selected").val()=='')
				{
                //$("#errmsg").html("Please select subject");
                 //$().message("Select subject!");
                 $('#btnshow').attr('disabled', 'disabled');
             }
             else
             {
             	$('#btnshow').removeAttr('disabled');
             }
         });
		});

	</script>
	<script type="text/javascript">
		function success() {
			if(document.getElementById("textd").value==="") {
				document.getElementById('button').disabled = true;
			} else {
				document.getElementById('button').disabled = false;
			}
		}
	</script>
</head>
<div id="page-wrapper">
	<body>
		<div id="on_top_me_now" style="position: fixed; z-index: 9999; left: 0; right: 0; top: 0; bottom: 0; background: rgba(0, 0, 0, 0.37); text-align: center;" >
			<span  style="color: white;position: absolute;left: 50%;top: 50%;">Loading ....</span>
		</div>

		<div class="map_contact">
			<div class="row">

				<h3 class="tittle my-5 "><center>Assignment Topic Entry</center></h3>
				<div class="contact-grids" align="center">

					<div class="col-md-offset-1 col-md-8 contact-grid" style="text-align:center">

						<form method="post" enctype="multipart/form-data" action="each_assignment_topic.php">
							<table class=""  align="center" width="700" style="cellspacing:2px;">
								<tbody >
									<tr style="height: 50px;">
										<td> Class</td>
										<td>
											<select name="class" class="form-control" onchange="showsub(this.value)">
												<option>select</option>
												<?php
												$resul=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");
												while($data=mysqli_fetch_array($resul))
												{
													$classid=$data["classid"];
													$res1=mysqli_query($con,"select * from class_details where classid='$classid' and active='YES'");
													while($rs=mysqli_fetch_array($res1))
													{
														?>
														<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
															<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?><?php echo $rs['branch_or_specialisation'];?> </option>
															<?php
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr style="height: 50px;">
											<td>Subject</td>
											<td>
												<div id="sub">
													<select name="sub" class="form-control">
														<option>select</option>
													</select>
												</div>
											</td>
										</tr>
										<tr style="height: 50px;">
											<td>Assignment No</td>
											<td>
												<div id="assignmentno">
													<select name="assignmentno" class="form-control">
														<option selected disabled>select</option>
														<option value="1">1</option>
														<option value="2">2</option>
													</select>
												</div>
											</td>
										</tr>

										<tr>&nbsp;
											&nbsp;
											&nbsp;
										</tr>
										<tr style="height: 50px;">
											<td>

											</td>
											<td>
												<input type="submit" id="btnshow" name="btnshow" class="btn btn-primary" action="each_assignment_topic.php" value="Enter Topic"  disabled="disabled"/>
											</td>
										</tr>
									</tbody>
								</table>
							</form>


							<?php
							if(isset($_POST['btnshow'])!=null)
							{

								$a=explode(",",$_POST['class']);
								$b=explode("-",$_POST['sub']);
								$assignmentno=$_POST['assignmentno'];

								$l=mysqli_query($con,"select * from each_assignment_topic where subjectid='$b[0]' and classid='$a[0]' AND assignmentno = $assignmentno ");
								if(mysqli_num_rows($l)==0)
								{
									?>

									<?php if(isset($_POST["btnshow"])):?>

										<div class="row" style="margin-top: 1rem;">
											<div class="col-sm-12">
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td>Class</td>
															<td><?php echo $a[1] . " - " . $a[2] . " - " . $a[3]; ?></td>
														</tr>
														<tr>
															<td>Subject</td>
															<td><?php
															// echo $b[0] . " - " . $b[1];

															$res22=mysqli_query($con,"SELECT * FROM subject_class where subjectid='$b[0]' LIMIT 1 ");
															$i=0;
															while($rs=mysqli_fetch_array($res22))
															{
																echo $rs["subject_title"];
															}
															?></td>
														</tr>
														<tr>
															<td>Assignment No</td>
															<td><?php echo $assignmentno; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									<?php endif; ?>
									<form name="form1" method="post" id="fom_excel_serie_su_suer" onsubmit=" return confirm('Do you really want to add Topics of Assignment <?php echo $assignmentno ?> mark?');">
										<div class="" style="text-align:center">
											<style type="text/css">
											.iamloading .resulttable, .imagepare {
												display: none;
											}
											.iamloading .imagepare, .resulttable {
												display: block;
											}
										</style>

										<input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
										<input type="hidden" value="<?php echo $_POST['sub']; ?>" name="b"/>
										<input type="hidden" value="<?php echo $_POST['assignmentno']; ?>" name="assignmentno"/>
<br>
										<table width="100%" border="1" align="center" class="table table-hover table-bordered " >
											<thead align="center">
												<th> CO</th>
												<th> CO-description</th>
											</thead>
												<?php
											$r3=mysqli_query($con,"SELECT * FROM subject_class where subjectid='$b[0]' LIMIT 1 ");
											while($rs=mysqli_fetch_array($r3))
											{
											$sub=	$rs["subjectid"];
											$sql=mysqli_query($con,"SELECT * from tbl_co where subjectid='$sub'");
											while($row= mysqli_fetch_array($sql)){ ?>
												<tr>
										<td><?php echo $row['co_code']; ?></td>
										<td><?php echo $row['co_name']; ?></td>
										<?php }}?>
									</tr>
								</table>

										<div id="outputData" class="">
											<div class="imagepare" style="text-align: center;">
												<img style="width: 50px; padding: 3pc 0;" src="../images/loading.gif">
											</div>
											<br/>
											<?php $counter=1;?>
											<table width="100%" border="1" align="center" class="table table-hover table-bordered " id="dynamic_field">
												<tr>
													<td>Topic no</td>
													<td>Topic</td>
													<td>Co</td>
                          <td><button type="button" name="add" id="add" class="btn btn-success"> + </button> </td>
												</tr>
                        <tr>
                            <td> <input class="form-control" type="text" name="topic_no[]" id="topic_no" value="<?php echo $counter;?>" ></td>
                            <td> <textarea class="form-control" rows="1" cols="100" name="topic[]" id="topic"></textarea></td>
														<td> <input class="form-control" type="text" name="co[]" id="co"  ></td>
                            <td> <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button> </td>
                        </tr>
												</table>


												<br>
												<div class="col-md-8 contact-grid resulttable " style="text-align:center ; margin-bottom: 1pc;">
													<input type="submit" class="btn btn-primary" id="button" name="submit" value="save"/>   <!--<input type="reset" class="btn btn-primary" onclick="window.location.href='each_assignment_topic.php'" value="clear" />-->

												</div>
											</div>

										</div>
									</form>

									<?php
								}
								else

									echo "<script>alert('Already Entered')</script>";

							}
							?>


							<?php

							if(isset($_POST["submit"])) {

								// var_dump($_POST);

								// exit();
								$a=explode(",",$_POST['a']);
								$b=explode("-",$_POST['b']);
								$assignmentno= $_POST['assignmentno'];
								$tpcno = $_POST['topic_no'];
								$tpc= $_POST['topic'];
								$c=$_POST['co'];
								if($assignmentno == '1' || $assignmentno == '2') {

									//if (isset($a[0]) && isset($b[0]) && isset($topic_no[$cnt]) && isset($topic[$cnt]) ){
									for($cnt=0;$cnt<count($tpcno);$cnt++)
									{
											$topic_no= $tpcno[$cnt];
											$topic = $tpc[$cnt];
											$co=$c[$cnt];
											$query ="INSERT into each_assignment_topic(`assignmentno`,`classid`,`subjectid`,`topicid`,`topic`,`co`) values ('$assignmentno','$a[0]','$b[0]','$topic_no','$topic','$co') ";
											$e=mysqli_query($con,$query);

											}
											if($e){?>
 									<script>
											alert("Insert Successfully");
											window.location="each_assignment_topic.php";
										</script>
										<?php
									}
									else
									{
										?>
										<script>
											alert("Error In Insertion");
											window.location="each_assignment_topic.php";
										</script>
										<?php
									}}
								}


							?>

							<!--<tr><td><input type="submit" name="submit" value="save"  /> </td></tr>-->


						</body>
					</form>
				</div>

			</div>

		</div>
	</div>

	<script type="text/javascript">

		$(document).ready(function($) {
			console.log('ready to go nrjith');
			$('#on_top_me_now').remove();

			$('.downlad_excel').click(function(event) {


				window.open('excel_template.php?action=template-mark&type=excel','_blank' );


			});
			$('.select_excel').click(function(event) {
				event.preventDefault();
				console.log('now excel time ');
				$('#selected_excel').click();
			});
			$('#selected_excel').change(function(e) {
				e.preventDefault();
				$('#fom_excel_serie').click();
			});
			$("form#fom_excel_serie_su").submit(function(e) {
				e.preventDefault();
				var formData = new FormData(this);
				$('#outputData').addClass('iamloading');
				$.ajax({
					url: 'form_excel.php',
					type: 'POST',
					data: formData,
					success: function (data) {
						$('#outputData').removeClass('iamloading');
						$('#outputData').html(data);

						document.getElementById('button').disabled = false;
					},
					cache: false,
					contentType: false,
					processData: false
				});
			});
		});

	</script>

</body>
</div>
</html>
<?php
include("includes/footer.php");
?>
