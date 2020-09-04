<?php

/**
 * @Author: indran
 * @Date:   2018-10-18 16:37:29
 * @Last Modified by:   indran
 * @Last Modified time: 2018-10-19 11:51:11
 */
// each_series_mark_view

?><?php
//$con=mysqli_connect("localhost","root","","ritsoft2");
include("connection.php");
//session_start();
//$uname=$_SESSION['fid'];

include("includes/header.php");
include("includes/sidenav.php");



$uname=$_SESSION['fid'];

$se = true;
?>



<?php

if (isset($_POST['updateme'])) {
	// var_dump($_POST);
	$i = 0;


	if(isset( $_POST['assignmentno'] ) AND isset( $_POST['classid'] ) AND isset( $_POST['subjectid'] ) AND isset( $_POST['studid'] ) ) {


			$new_mark = $_POST['new_mark'];
			$remark = $_POST['new_remarks'];

			$assignmentno = $_POST['assignmentno'];
			$classid = $_POST['classid'];
			$studid = $_POST['studid'];
			$subjectid = $_POST['subjectid'];
			$mark = $_POST['old_mark'];
			$old_remark = $_POST['old_remark'];

			$query = "DELETE FROM each_assignment_mark_entry WHERE assignmentno = '$assignmentno' AND classid = '$classid' AND  studid = '$studid' AND  subjectid = '$subjectid'   ";

	 			 	mysqli_query($con,$query) or die(mysqli_error($con));

$query ="INSERT INTO  each_assignment_mark_entry(`assignmentno`,`classid`,`studid`,`subjectid`,`mark`,`remark`) values('$assignmentno','$classid','$studid','$subjectid','$new_mark','$remark')";


				mysqli_query($con,$query) or die(mysqli_error($con));


			// $query = " UPDATE each_sessional_marks SET sessional_marks = '$marka' , sessional_remark = '$remarka', sessional_date = NOW() WHERE series_no = $series AND classid = '$classid' AND  studid = '$studid' AND  subjectid = '$subjectid' AND sessional_marks = '$sessional_marks' AND sessional_remark = '$sessional_remark' ";

			// mysql_query($query) or die(mysql_error());
			$i++;
		}


	if($i > 0) {
		echo '<script type="text/javascript"> alert("Update Successfully");</script>';
	}
}
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
			if(document.getElementById("textd").value===" ") {
				document.getElementById('button').disabled = true;
			} else {
				document.getElementById('button').disabled = false;
			}
		}

	</script>
</head>
<div id="page-wrapper">
	<body>


		<div class="map_contact">
			<div class="container">

				<h3 class="tittle"><center>Print Assignment mark</center></h3>
				<div class="contact-grids" align="center">
					<form method="post" action="pdf_assignment_mark.php">

						<div class="col-md-8 contact-grid" style="text-align:center">
							<table  align="center" width="700" style="cellspacing:2px;">
								<tbody>
									<tr><td> Class</td>  <td>
										<select name="class" class="form-control" onchange="showsub(this.value)">
											<option>select</option>
											<?php
											$c=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");

											while($res=mysqli_fetch_array($c))
											{
												$res1=mysqli_query($con,"select * from class_details where classid='$res[classid]' and active='YES'");
												while($rs=mysqli_fetch_array($res1))
												{
													?>
													<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
														<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
														<?php
													}
												}
												?>
											</select>
										</td></tr>


										<tr style="height: 50px;">
											<td>Subject </td> <td><div id="sub">
											<select name="sub" class="form-control" >
												<option>select</option>
											</select>

										</div> </td></tr>

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

										<tr></tr>
										<tr><td></td>
											<td><input type="submit" name="btnshow" id="btnshow" class="btn btn-primary" action="pdf_assignment_mark.php" value="Print" disabled="disabled" />  </td></tr>
									</tbody>
								</table>

							</form>
				
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function($) {
			$('.editsomeitng').click(function(event) {
				event.preventDefault();
				$('.editDiv').css('display', 'none');
				$this = $(this);
				$this.closest('td').find('.editDiv').css('display', 'block');
				$this.closest('td').find('*[type=submit]').attr('disabled', 'disabled');

			});


			$('.hiddenThis').click(function(event) {
				event.preventDefault();
				$('.editDiv').css('display', 'none');
			});

			$(document).on('keyup change', '.new_something', function(event) {
				event.preventDefault();
				$this = $(this);
				$new = false;

				if($this.closest('td').find('.new_remarks').val() != $this.closest('td').find('.old_remark').val() ){
					$new = true;
				}
				if($this.closest('td').find('.new_mark').val() != $this.closest('td').find('.old_marks').val() ){
					$new = true;
				}
				if($new) {
					$this.closest('td').find('*[type=submit]').removeAttr('disabled');
					$this.closest('td').find('*[type=submit]').css('background', '');
				} else {
					$this.closest('td').find('*[type=submit]').attr('disabled', 'disabled');
					$this.closest('td').find('*[type=submit]').css('background', 'red');
				}

			});

		});
	</script>



</body>

</html>

<?php

include("includes/footer.php");
?>
