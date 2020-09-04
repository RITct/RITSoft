<?php
header("Content-type: text/html; charset=utf-8");
$connection=mysqli_connect("localhost","root","","ritsoft");
session_start();
include("header.php");
include("sidenav.php");
$ivalue=0.0;
$ival=0.0;
$fid="";
$fid= $_SESSION["username"];
$mark=0;
$attainstudno=0;
$noattain=0;
$c=0;
$attainper=0.0;
$tot=0;
$count=0;
$n=0;
$m=0.0;
$num1=0;
$num2=0;
$num3=0;
$num4=0;
$num5=0;
$a=0.0;
$b=0.0;
$ce=0.0;
$d=0.0;
$e=0.0;
$_SESSION['data1array']=array();
$_SESSION['data2array']=array();
$_SESSION['data3array']=array();
$_SESSION['data4array']=array();
$_SESSION['surveyval']=array();
$d1=array();
$d2=array();
$d3=array();
$d4=array();
$d5=array();
$s=array();
$totalattainmnt=array();
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
  		<div class="col-md-8">
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
    <button id="calculate" name="calculate" type="submit" value="find" class="btn btn-info">Calculate I</button>
		<br>
		<?php
if(isset($_POST['calculate']))
{
	$i=0;
	$crsid=$_SESSION['course'];
	$_SESSION['data1array']=$_POST['test1'];
$_SESSION['data2array']=$_POST['asignmnt'];
$_SESSION['data3array']=$_POST['nrmlinternal'];
$_SESSION['data4array']=$_POST['test2'];
$_SESSION['surveyval']=$_POST['surveyper'];
$d1=$_SESSION['data1array'];
$d2=$_SESSION['data2array'];
$d3=$_SESSION['data3array'];
$d4=$_SESSION['data4array'];
$d5=$_SESSION['surveyval'];
$query="SELECT * FROM tbl_co WHERE subjectid='$crsid' ";
$result=mysqli_query($connection,$query);
$count=$count+mysqli_num_rows($result);

?>
<table class="table table-bordered" id="dynamic" name="dynamic">
	<tr>
	<th rowspan="2">Course<br> Outcome(co)</th>
	<th  colspan="7">
	Attainment level in Percentage</th>
	<th rowspan="2">
	Attainment in <br>Percentage
	</th>
	<th rowspan="2">
	<center>Achievement <br>Goal<br>(70%)
</center>
	</th>
	</tr>
	<tr>
	<th>Data1</th>
	<th>Data2</th>
	<th>Data3</th>
	<th>Data4</th>
	<th>Data5</th>
	<th>Rubrics</th>
	<th>IAT</th>
	</tr>
<?php
$querys="SELECT * FROM tbl_co WHERE subjectid='$crsid' ";
$results=mysqli_query($connection,$querys);
$rows=mysqli_fetch_array($results);
array_push($s,$rows['co_code']);
while($row=mysqli_fetch_array($result))
{

$query1="SELECT * FROM internal WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' AND test_no='1' ";
$result1=mysqli_query($connection,$query1);
$row1=mysqli_fetch_array($result1);
$query2="SELECT * FROM assignment WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' ";
$result2=mysqli_query($connection,$query2);
$row2=mysqli_fetch_array($result2);
$query3="SELECT * FROM normalized_internal_attainment WHERE subjectid='$crsid' ";
$result3=mysqli_query($connection,$query3);
$row3=mysqli_fetch_array($result3);
$query4="SELECT * FROM internal WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' AND test_no='2' ";
$result4=mysqli_query($connection,$query4);
$row4=mysqli_fetch_array($result4);
$query5="SELECT * FROM survey_attainment WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' ";
$result5=mysqli_query($connection,$query5);
$row5=mysqli_fetch_array($result5);
$a=$row1['attainmnt_percent'];
$b=$row2['attainmnt_percent'];
$ce=$row3['attainmnt_percent'];
$d=$row4['attainmnt_percent'];
$e=$row5['attainmnt_percent'];
foreach($s as $key=>$value)
{
$m= ( $a * $d1[$key]) /100 + ($b * $d2[$key]) /100 + ($ce * $d3[$key]) /100 +($d * $d4[$key]) /100 +($e * $d5) /100;
$totalattainmnt[$key]=$m;
}
?>
<tr>
<td><?php echo $row['co_code'];?></td><td><?php echo $row1['attainmnt_percent'];?></td>
<td><?php echo $row2['attainmnt_percent'];?></td><td><?php echo $row3['attainmnt_percent'];?></td>
<td><?php echo $row4['attainmnt_percent'];?></td><td>Marks in<br> External<br> Exam</td><td>X</td><td><?php echo $row5['attainmnt_percent'];?></td><td><?php echo $totalattainmnt[$key];?></td>
<?php
$ival=$ival+$totalattainmnt[$key];
$ivalue=$ival/$count;
if($totalattainmnt[$key]>=70)
{?>
<td>YES</td> </tr>
<?php
}
else
{?>
  <td>NO</td> </tr>

<?php
}
}

//echo $ivalue;
?>
<tr ><td colspan="10"><center>I=
  <?php if(isset($ivalue)>=70)
  {
    echo "3";
  }
elseif(isset($ivalue)>=60)
{
  echo "2";
}
else
{
  echo "1";
}
  ?></center></td></tr>
</table>
<?php
}?>

	    <br>
    	<div class="table-responsive" id="dynamic_field">
      </div>
		<br>
		<br>
     <a href="http://localhost/amsa/fpdf/pdfivalue.php";>print</a>
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
      $('#cid').change(function(){
           var subjectid = $(this).val();
               $.ajax({
                url:"iajaxpro.php",
                method:"POST",
                data:{id:subjectid},
                success:function(data){
                     $('#dynamic_field').html(data);
                }
           });

      });
  });


</script>
<?php

include("footer.php");
?>
