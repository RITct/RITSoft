<?php
header("Content-type: text/html; charset=utf-8");
$connection=mysqli_connect("localhost","root","","ritsoft");
session_start();
include("header.php");
include("sidenav.php");
//$fid= $_SESSION["username"];
$fid="";
$fid= $_SESSION["username"];

$mark=0;
$attainstudno=0;
$noattain=0;
$c=0;
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
  		<div class="col-md-7">
  			<div class="panel panel-danger" style="margin-top:80px;">
  				<div class="panel-heading">
  					<h3 class="panel-title">I calculation</h3>
  				</div>
  				<div class="panel-body">
  <form name="qes" method="post" enctype="multipart/formdata" action="#">
 <fieldset class="form-group">
 <label for="opt">ASSIGNMENT</label>
      		<select class="form-control" name="assignmnt" id="assignmnt">
            <option value="select">SELECT</option>
            <option  value="1">Assignment I</option>
            <option value="2">Assignment II</option>
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
      <option>Select</option>
		</select>
		</fieldset>

	    <br>
		<br>
        <fieldset class="form-group">
        <label for="assignmenttreshold">Threshold Value</label>
        <center><input class="form-control" type="text" name="threshold" id="threshold" ></center>
        </fieldset>
<br>
<button align="right" type="submit" name="submit" class="btn btn-info"> Submit </button>
<?php
if(isset($_POST['submit']))
{
$topic= $_POST['assignmnt'];
$thr= $_POST['threshold'];
$course= $_POST['cid'];
$_SESSION['course_code']=$course;
$query="SELECT mark FROM each_assignment_mark_entry WHERE subjectid='$course' AND topicid='$topic' ";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($result))
{
	$c= $c + 1;
	$mark=$row['mark'];

  if($mark >= $thr)
   {
    $attainstudno = $attainstudno + 1;
   }

 }
$cos=$_POST['co'];
//echo $cos;
//echo $attainstudno;
$noattain= $c - $attainstudno;
$attainper= ($attainstudno/ $c)*100;
$result=mysqli_query($sql,"SELECT * FROM assignment WHERE subjectid='$course' and co_code='$cos' and assignmentno='$topic'");
$countsur=mysqli_num_rows($result);
if($countsur>0)
{

}
else{

$que="INSERT INTO assignment(`subjectid`,`co_code`,`assignmentno`,`threshold`,`tot`,`atnd`,`abs`,`attainmnt_percent`)VALUES('".$course."','".$cos."','".$topic."','".$thr."','".$c."','".$attainstudno."','".$noattain."','".$attainper."')";
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
			<td colspan="3"><center>Assignment <?php

			 echo (isset($topic))?$topic:''; ?>&nbsp;&nbsp;Threshold Mark=<?php echo (isset($thr))?$thr:''; ?>&nbsp;&nbsp;No of Students=<?php echo (isset($c))?$c:'';?></center></td>
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
	<br>
   <a href="http://localhost/amsa/fpdf/pdfiasgmt.php";>print</a>
  </form>
  <div class="panel-footer">

  	</div>
  </div>
  <div class="col-md-1">
  </div>


   <!--END PANEL-->
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
<script>

    $(document).ready(function(){
	 $('#assignmnt').change(function(){
		 var assignmnt_id=$(this).val();
      $('#cid').change(function(){
           var course_id = $(this).val();
               $.ajax({
                url:"asignajax.php",
                method:"POST",
                data:{id:course_id,assignmnt_id:assignmnt_id},
                success:function(data){
                     $('#co').html(data);
                }
           });

	  });
	 });
	});
</script>
