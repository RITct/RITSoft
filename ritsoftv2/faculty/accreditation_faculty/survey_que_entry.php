<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include("header.php");
include("sidenav.php");
include_once("Crud.php");

$connection=mysqli_connect("localhost","root","","ritsoft");
$fid="";
$fid=$_SESSION['username'];
$crud= new Crud();
 //if(isset($_POST['course_id']))
 //{


if(isset($_POST['submit']))
	{
		$no= $_COOKIE["gfg"];
         echo "$no";
         $n= $no-1;
		$course_id= $_POST['course_id'];
		echo $course_id;
		$qno= $_POST['que'];
		$question= $_POST['quest'];
		$co= $_POST['co'];

		for($count=0;$count<=$n;$count++){
			echo $qno[$count];
		 $query="INSERT INTO `survey_question_table`(`question_no`,`co_code`,`subjectid`,`question`) VALUES
			('".$qno[$count]."','".$co[$count]."','".$course_id."','". $question[$count]."')  ";

			$insert= mysqli_query($connection,$query);

		if(!$insert)
		{
			echo mysqli_errno($connection);
		}
		else
		{
			echo "inserted";
		}
		}
	}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
//	$("#dep_id").change(function(e){
//			$('#cou').append('<select class="form-control" name="course_id" id="course_id"></select>' );

	$(document).ready(function(e)
	{

		var i=1;
		var max= 100;
		$("#add").click(function(e){
		if(i<=max)
		    {
				++i;
				$('#dynamic_field_ques').append('<tr id="row'+i+'"><td> <input class="form-control" type="text" name="que[]" id="que"></td><td> <input class="form-control" type="text" name="co[]" id="co"></td><td> <input class="form-control" type="text" name="quest[]" id="quest"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>></tr>');

			}

		});
		$("#bt").click(function(e){
		 	var x = i;
	  createCookie("gfg", x, "10");
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
}
});
$(document).on('click','.btn_remove',function(e){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
		i--;
});

	});

</script>
</head>
<body>
	<div class="row 1">
		<div class="col-md-3">

		</div>
		<div class="col-md-8">
			<div class="panel panel-danger" style="margin-top:10px;">
				<div class="panel-heading">
					<h3 class="panel-title">SURVEY QUESTION ENTRY</h3>
				</div>
				<div class="panel-body">
<form name="qes" method ="post" enctype="multipart/formdata" action="#">


	</fieldset><!--fetching course id-->
	<fieldset class="form-group">
			<label for="course">COURSE ID</label>
			<div class="form-group" id="cou">
			<select class="form-control" name="course_id" id="course_id">

               <?php

				$output='';
				$query = "SELECT subjectid FROM subject_allocation WHERE fid='$fid' ";
				$result = mysqli_query($connection, $query);
				$output .= '<option value="">Select course</option>';
				while($row = mysqli_fetch_array($result))
				 {
						$output .= '<option value="'.$row["subjectid"].'">'.$row["subjectid"].'</option>';
					}
				echo $output;
				?>

				</select>
				</div>
	</fieldset><!--fetching course id-->
		<div class="table-responsive">
				 <table class="table table-bordered" id="dynamic_field_ques">
					 <thead>
						 <th>	QUESTION NO </th>
						 <th>	CO  </th>
						 <th> QUESTION</th>
					 </thead>
					 <tr>
						 <td> <input class="form-control" type="text" name="que[]" id="que"></td>
						 <td> <input class="form-control" type="text" name="co[]" id="co"></td>
						 <td> <input class="form-control" type="text" name="quest[]" id="quest"></td>
						 <td> <button type="button" name="add" id="add" class="btn btn-success"> + </button> </td>
					 </tr>
				 </table>
	</div>

</br>	<button type="submit" name="submit" class="btn btn-info" id="bt"> Submit </button>
</form>
<div class="panel-footer">
	</div>
</div>
<div class="col-md-1">
</div>
</div>
<!--END PANEL-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</div>
</body>
</html>
