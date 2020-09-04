<?php
session_start();
header("Content-type: text/html; charset=utf-8");
$connection=mysqli_connect("localhost","root","","ritsoft");

include('header.php');
include('sidenav.php');
$fid="";
$fid= $_SESSION["username"];

$ques=[];
$qu=[];
$j=0;
$sum=0;
$attainstudno=0;
$noattain=0;
$c=0;
$coun=[];
$attainper=0.0;
$tot=0;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>I Calculation</title>
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
  		<div class="col-md-8">
  			<div class="panel panel-danger" style="margin-top:80px;">
  				<div class="panel-heading">
  					<h3 class="panel-title">I calculation</h3>
  				</div>
  				<div class="panel-body">
  <form name="qes" method="post" enctype="multipart/formdata" action="#">
 <fieldset class="form-group">
      			<label for="course">SERIES ID</label>
      			<select class="form-control" name="series_id" id="series_id">
            <option value="select">SELECT</option>
            <option  value="1">Series I</option>
            <option value="2">Series II</option>
            </select>
        </fieldset>
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
		<fieldset class="form-group">
		<label for="cos">CO</label>
		<select class="form-control" name="co" id="co">
		<option>select co</option>
		</select>
		</fieldset>

	    <br>
		<br>
		<div class="table-responsive" id="dynamic_field">

	</div>
        <fieldset class="form-group">
        <label for="stud">Threshold Value</label>
        <center><input class="form-control" type="text" name="threshold" id="threshold" ></center>
        </fieldset>
<br>
<button align="right" type="submit" name="submit" class="btn btn-info"> Submit </button>
<?php
if(isset($_POST['submit']))
{
$se= $_POST['series_id'];
$thr= $_POST['threshold'];
$course= $_POST['cid'];
$_SESSION['cid']=$course;
$_SESSION['se']=$se;
$_SESSION['thr']=$thr;
//echo $course;
$query="SELECT * FROM each_series_marks WHERE subjectid='$course' AND series_no='$se' ";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($result))
{
	$tot= $tot + 1;
if($row['attendance_status']=='p')
{
	$c= $c +1;
}
$marks[1]= $row['q1'];
$marks[2]= $row['q2'];
$marks[3]= $row['q3'];
$marks[4]= $row['q4'];
$marks[5]= $row['q5'];
$marks[6]= $row['q6'];
$marks[7]= $row['q7'];
$marks[8]= $row['q8'];
$marks[9]= $row['q9'];
$marks[10]= $row['q10'];

$qu= $_SESSION['que'];
foreach($qu as $j)
{
$sum= $sum + $marks[$j];
}
if($sum>=$thr)
{
  $attainstudno= $attainstudno + 1;
}
$sum=0;
}
//echo $c;
$_SESSION['c']=$c;
//echo $tot;
$noattain= $c - $attainstudno;
$attainper= ($attainstudno/ $c)*100;
$_SESSION['per']=$attainper;
$_SESSION['attainstud']=$attainstudno;
$_SESSION['noattain']=$noattain;
$abs=$tot-$c;
$co_code=$_SESSION['co_code'];
$result=mysqli_query($con,"SELECT * FROM ical_table WHERE subjectid='$course' and co_code='$co_code' and series_no='$se'");
$countsur=mysqli_num_rows($result);
if($countsur>0)
{

}
else{
$que="INSERT INTO ical_table(`series_no`,`subjectid`,`co_code`,`threshold`,`tot`,`absenties`,`atnd`,`abs`,`per`)VALUES('".$se."','".$course."','".$co_code."','".$thr."','".$c."','".$abs."','".$attainstudno."','".$noattain."','".$attainper."')";
$insert=mysqli_query($connection,$que);
if(!$insert)
{
	echo mysqli_errno($connection);
}
else
{
echo "inserted";
}
}
}?>
	<br>
<br>
<div class="table-responsive">
	<table class="table table-bordered" id="dynamic_field">

		<tr>
			<td colspan="3"><center>Test <?php

			 echo (isset($se))?$se:''; ?>&nbsp;&nbsp;Threshold Mark=<?php echo (isset($thr))?$thr:''; ?>&nbsp;&nbsp;No of Students=<?php echo (isset($c))?$c:'';?>+(<?php echo (isset($abs))?$abs:'';?>absentees)</center></td>
		</tr>
		<tr>
			<th></th><th>Not Acceptable Range</th><th>Acceptable Range</th>
		</tr>
		<tr>
			<td rowspan="2">Number of students who scored<br> marks in the range </td>
			<td><center>Marks:<<?php echo (isset($thr))?$thr:'';?></center></td>
			<td><center>Marks:><?php echo (isset($thr))?$thr:'';?></center></td>

		</tr>
		<tr>
			<td><center><?php echo (isset($attainstudno))?$attainstudno:'';?></center></td>
			<td><center><?php echo (isset($noattain))?$noattain:'';?></center></td>
		</tr>
		<tr>
			<td colspan="3" >
    <center>Attainment Level in Percentage=<?php echo (isset($attainper))?$attainper:'';?>%</center>
			</td>
			</tr>

	</table>
<a href="http://localhost/amsa/fpdf/pdficalc.php";>print</a>
  </form>
  <div class="panel-footer">

  	</div>
  </div>
  <div class="col-md-1">
  </div>
  </div>
   <!--END PANEL-->
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
<script>

    $(document).ready(function(){
	 $('#series_id').change(function(){
		 var series_id=$(this).val();
      $('#cid').change(function(){
           var subjectid = $(this).val();
               $.ajax({
                url:"ajaxpro.php",
                method:"POST",
                data:{id:subjectid,ser_id:series_id},
                success:function(data){
                     $('#co').html(data);
                }
           });

	 $('#co').change(function(){
		 var co_code=$(this).val();


		 $.ajax({
                url:"ajaxpro1.php",
                method:"POST",
                data:{id:subjectid,ser_id:series_id,co_code:co_code},
                success:function(data){
                     $('#dynamic_field').html(data);

				}

 });
	 });
	  });
	 });
	});
</script>
