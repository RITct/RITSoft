<?php

    include("connection.php");

	include("header.php");

	include("sidenav.php");
	
	
	if(isset($_SESSION['user_id']))
{
$fid=$_SESSION['user_id'];

}
function fill_course($con){

	$course='';
		$q1=mysqli_query($con,"SELECT subjectid FROM subject_allocation WHERE fid='".$_SESSION['user_id']."'");
			
					while($r1=mysqli_fetch_array($q1))
		{
				$_d1=$r1['subjectid'];
				$k=mysqli_query($con,"SELECT * FROM subject_class where subjectid='".$_d1."'");
				 while($row=mysqli_fetch_array($k))
				{
					$courseid .='<option value="'.$row["subjectid"].'">'.$row["subjectid"].$row["subject_title"].'</option>';
				}
		}
				echo $courseid;
}
	
	 ?>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CO PO Correlation</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body>
	

	<div class="row 1">
		<div class="col-md-3">

		</div>
		<div class="col-md-9">
			<div class="panel panel-danger" style="margin-top:80px;">
				<div class="panel-heading">
					<h3 class="panel-title">CO PO CORRELATION</h3>
				</div>
				<div class="panel-body">
<form action="#" method="post">
	<fieldset class="form-group">
                <label for="course">Subject</label>
                <select class="form-control" id="course_id" name="course_id">
				<option>Select</option>
                  <?php echo fill_course($con); ?>
                  </select>
            </fieldset>

	<div class="button-panel">
		<input type="submit" class="btn btn-info" title="VIEW" name="view" value="VIEW"></input>
    </div>
<?php

if(isset($_POST['view']))
{

$course_id=$_POST['course_id'];
$_SESSION["course"]=$course_id;
$result=mysqli_query($con,"select * from `co_po_correlation` where course_id='$course_id'") or die(mysqli_error());
?>
<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th style="text-align: center;" > CO </th>
											<th style="text-align: center;" > PO1 </th>
											<th style="text-align: center;" > PO2 </th>
											<th style="text-align: center;" > PO3 </th>
											<th style="text-align: center;" > PO4 </th>
											<th style="text-align: center;" > PO5 </th>
											<th style="text-align: center;" > PO6 </th>
											<th style="text-align: center;" > PO7 </th>
											<th style="text-align: center;" > PO8 </th>
											<th style="text-align: center;" > PO9 </th>
											<th style="text-align: center;" > PO10 </th>
											<th style="text-align: center;" > PO11 </th>
											<th style="text-align: center;" > PO12</th>
											<th style="text-align: center;" > PSO1</th>
											<th style="text-align: center;" > PSO2</th>
											<th style="text-align: center;" > PSO3</th>
											<th style="text-align: center;" > PSO4</th>

										</tr>
									</thead>
									<tbody>
<?php
while($row=mysqli_fetch_array($result))
{
	?>
	<tr> 
		<td style="text-align: center;"><?php echo $row['co_code']; ?> </td>

		<td style="text-align: center;"><?php echo $row['po1'] ?></td>
		<td style="text-align: center;"><?php echo $row['po2'] ?></td>
		<td style="text-align: center;"><?php echo $row['po3'] ?></td>
		<td style="text-align: center;"><?php echo $row['po4'] ?></td>
		<td style="text-align: center;"><?php echo $row['po5'] ?></td>
		<td style="text-align: center;"><?php echo $row['po6'] ?></td>
		<td style="text-align: center;"><?php echo $row['po7'] ?></td>
		<td style="text-align: center;"><?php echo $row['po8'] ?></td>
		<td style="text-align: center;"><?php echo $row['po9'] ?></td>
		<td style="text-align: center;"><?php echo $row['po10'] ?></td>
		<td style="text-align: center;"><?php echo $row['po11'] ?></td>
		<td style="text-align: center;"><?php echo $row['po12'] ?></td>
		<td style="text-align: center;"><?php echo $row['pso1'] ?></td>
		<td style="text-align: center;"><?php echo $row['pso2'] ?></td>
		<td style="text-align: center;"><?php echo $row['pso3'] ?></td>
		<td style="text-align: center;"><?php echo $row['pso4'] ?></td>
		
	</tr> 
<?php
}

$result1=mysqli_query($con,"select * from co_po_correlation where course_id='$course_id'");
$sum1=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$sum8=0;
$sum9=0;
$sum10=0;
$sum11=0;
$sum12=0;
$sum13=0;
$sum14=0;
$sum15=0;
$sum16=0;
while($row=mysqli_fetch_array($result1))
{
	$sum1=$sum1 + $row['po1'];
	$sum2=$sum2 + $row['po2'];
	$sum3=$sum3 + $row['po3'];
	$sum4=$sum4 + $row['po4'];
	$sum5=$sum5 + $row['po5'];
	$sum6=$sum6 + $row['po6'];
	$sum7=$sum7 + $row['po7'];
	$sum8=$sum8 + $row['po8'];
	$sum9=$sum9 + $row['po9'];
	$sum10=$sum10 + $row['po10'];
	$sum11=$sum11 + $row['po11'];
	$sum12=$sum12 + $row['po12'];
	$sum13=$sum13 + $row['pso1'];
	$sum14=$sum14 + $row['pso2'];
	$sum15=$sum15 + $row['pso3'];
	$sum16=$sum16 + $row['pso4'];
}

$count1 = mysqli_query($con,"SELECT count(*)  FROM co_po_correlation where course_id='$course_id'");
$c1=mysqli_fetch_array($count1);
$ce1=$c1['count(*)'];

if($ce1 == 0)
{
	echo "<script type='text/javascript'>alert('No correlation available..!')</script>";
}
else
{
//po1 avg calculation
$avgpo1= round(($sum1/$ce1),2);
$_SESSION['po1']=$avgpo1;
//end po1 avg

//po2 avg calculation
$avgpo2= round(($sum2/$ce1),2);
$_SESSION['po2']=$avgpo2;
//end po2 avg

//po3 avg calculation
$avgpo3= round(($sum3/$ce1),2);
$_SESSION['po3']=$avgpo3;
//end po3 avg

//po4 avg calculation
$avgpo4= round(($sum4/$ce1),2);
$_SESSION['po4']=$avgpo4;
//end po4 avg

//po5 avg calculation

$avgpo5= round(($sum5/$ce1),2);
$_SESSION['po5']=$avgpo5;
//end po5 avg

//po6 avg calculation

$avgpo6= round(($sum6/$ce1),2);
$_SESSION['po6']=$avgpo6;
//end po6 avg

//po7 avg calculation

$avgpo7= round(($sum7/$ce1),2);
$_SESSION['po7']=$avgpo7;
//end po7 avg

//po8 avg calculation

$avgpo8= round(($sum8/$ce1),2);
$_SESSION['po8']=$avgpo8;
//end po8 avg

//po9 avg calculation

$avgpo9= round(($sum9/$ce1),2);
$_SESSION['po9']=$avgpo9;
//end po9 avg

//po10 avg calculation

$avgpo10= round(($sum10/$ce1),2);
$_SESSION['po10']=$avgpo10;
//end po10 avg

//po11 avg calculation

$avgpo11= round(($sum11/$ce1),2);
$_SESSION['po11']=$avgpo11;
//end po11 avg

//po12 avg calculation

$avgpo12= round(($sum12/$ce1),2);
$_SESSION['po12']=$avgpo12;
//end po12 avg


//pso1 avg calculation

$avgpso1= round(($sum13/$ce1),2);
$_SESSION['pso1']=$avgpso1;
//end pso1 avg


//pso2 avg calculation

$avgpso2= round(($sum14/$ce1),2);
$_SESSION['pso2']=$avgpso2;
//end pso2 avg


//pso3 avg calculation

$avgpso3= round(($sum15/$ce1),2);
$_SESSION['pso3']=$avgpso3;
//end pso3 avg


//pso4 avg calculation

$avgpso4= round(($sum16/$ce1),2);
$_SESSION['pso4']=$avgpso4;
//end pso4 avg


?>

<tr>

<th style="text-align: center;"><?php echo $course_id ?></th>
<td style="text-align: center;"><?php echo $avgpo1 ?></td>
<td style="text-align: center;"><?php echo $avgpo2 ?></td>
<td style="text-align: center;"><?php echo $avgpo3 ?></td>
<td style="text-align: center;"><?php echo $avgpo4 ?></td>
<td style="text-align: center;"><?php echo $avgpo5 ?></td>
<td style="text-align: center;"><?php echo $avgpo6 ?></td>
<td style="text-align: center;"><?php echo $avgpo7 ?></td>
<td style="text-align: center;"><?php echo $avgpo8 ?></td>
<td style="text-align: center;"><?php echo $avgpo9 ?></td>
<td style="text-align: center;"><?php echo $avgpo10 ?></td>
<td style="text-align: center;"><?php echo $avgpo11 ?></td>
<td style="text-align: center;"><?php echo $avgpo12 ?></td>
<td style="text-align: center;"><?php echo $avgpso1 ?></td>
<td style="text-align: center;"><?php echo $avgpso2 ?></td>
<td style="text-align: center;"><?php echo $avgpso3 ?></td>
<td style="text-align: center;"><?php echo $avgpso4 ?></td>
</tr>
<?php
}
?>
<?php


 
 echo "<br>";
 echo "<br>";
 echo "<br>";
                                    
                                    $result=mysqli_query($con,"select co_code,co_name from tbl_co where subjectid='$course_id'");

?>

<table class="table table-bordered table-hover">
<caption><center><b><h4>Course Outcomes</h4></b></center></caption>
									<thead>
										<tr>
											<th style="text-align: center;" > CO </th>
											<th style="text-align: center;" > CO Description</th>
                                  		</tr>
										<?php
                                		while($row=mysqli_fetch_array($result))
                                		{
											?>
											
											<tr> 
											<td style="text-align: center;"><?php echo $row['co_code']; ?> </td>
											<td style="text-align: center;"><?php echo $row['co_name']; ?> </td>
											<tr>
											<?php
                                		}

										?>
										</tbody>
                                		     </table>
					
	<div class="button-panel">
		<input type="submit" class="btn btn-primary" title="PRINT" name="print" value="PRINT"></input>
    </div>
	<?php
}
?>
<?php
if(isset($_POST['print']))
{
	
			echo '<script> window.location="pdfcopo.php"; </script>';
}
?>

  
</div>

</div>


</div>

	<a href="http://localhost:8080/myproject/faculty/home_first.php"> Back to home</a>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>
<?php
include("footer.php");
 ?>