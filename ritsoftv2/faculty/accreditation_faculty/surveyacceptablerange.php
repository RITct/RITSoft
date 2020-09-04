<?php
header("Content-type: text/html; charset=utf-8");
$connection=mysqli_connect("localhost","root","","ritsoft");
session_start();
include("header.php");
include("sidenav.php");
$fid="";
$fid= $_SESSION["username"];
$m=0;
$mark=[];
$attainmnt=0;
$noattain=0;
$c=0;
$attainper=0.0;
$tot=0;
$ar=[];
$st=0;
$a="";
$b="";
$sum=array('0');
$s=0;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>I Value</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
 <script type="text/javascript" src="js/jquery.min.js"></script>

  </head>


  <body>
  	<div class="row 1">
  		<div class="col-md-3">

  		</div>
  		<div class="col-md-7">
  			<div class="panel panel-danger" style="margin-top:80px;">
  				<div class="panel-heading">
  					<h3 class="panel-title">I calculation</h3>
  				</div>
  				<div class="panel-body">
  <form name="qes" method="post" enctype="multipart/formdata" action="#">


  	<fieldset class="form-group">
  			<label for="course">COURSE ID</label>
  			<select class="form-control" name="cid" id="cid">

          <?php
		  $output='';
          $query = "SELECT subjectid FROM subject_allocation WHERE fid= '".$fid."' ";
          $result = mysqli_query($connection, $query);
          $output .= '<option value="">Select course</option>';
          while($row = mysqli_fetch_array($result))
           {
              $output .= '<option value="'.$row["subjectid"].'">'.$row["subjectid"].'</option>';
            }
          echo $output;

		  ?>

          </select>
        </fieldset><!--fetching course id-->
		<br>
		<br>
		<div class="table-responsive" id="dynamic">
		</div>
		<br>
		<br>

<br>
<br>


		</div>
		<br>
		<br>

     <a href="http://localhost/amsa/fpdf/pdfisurvey.php";>print</a>
  </form>
  <div class="panel-footer">

  	</div>
  </div>
  <div class="col-md-2">
  </div>


   <!--END PANEL-->
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
<script>

    $(document).ready(function(){
      $('#cid').change(function(){
           var course_id = $(this).val();
               $.ajax({
                url:"surveyajax.php",
                method:"POST",
                data:{id:course_id},
                success:function(data){
                     $('#dynamic').html(data);
                }
           });

	  });

	 });

</script>
