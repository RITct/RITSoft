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
	<title>print paper</title>
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

				<h3 class="tittle my-5 "><center>Print Question Paper</center></h3>
				<div class="contact-grids" align="center">

					<div class="col-md-offset-1 col-md-8 contact-grid" style="text-align:center">

						<form method="post" enctype="multipart/form-data" action="pdf_question_paper.php">
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
											<td>Series No</td>
											<td>
												<div id="seriesno">
													<select name="seriesno" class="form-control">
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
												<input type="submit" id="btnshow" name="btnshow" class="btn btn-primary" action="pdf_question_paper.php" value="Print Question paper"  disabled="disabled"/>
											</td>
										</tr>
									</tbody>
								</table>
							</form>


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
