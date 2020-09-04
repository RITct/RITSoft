<?php
session_start();
header("Content-type: text/html; charset=utf-8");
$connection=mysqli_connect("localhost","root","","ritsoft");

include("header.php");
include("sidenav.php");
$staff_id="";
$staff_id= $_SESSION["username"];


 $coursename="";
      $o=0;
     $ap=0;
	 $ao=0;
	 $bp=0;
	 $bo=0;
	 $c=0;
	 $p=0;
	 $per=0;
	 $above=0;
	 $studno=0;
	 $attainper=0.0;
	 $rper=0;
	 $E= 0;
	 $val= 0;
	 $gradestart= "";
	 $attain= 0.0;

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E Calculation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
	$(document).ready(function(e)
	{
	$("#bt").click(function(e){	});
	});</script>
</head>
<body>
	<div class="row 1">
		<div class="col-md-3">

		</div>
		<div class="col-md-8">
			<div class="panel panel-danger" style="margin-top:80px;">
				<div class="panel-heading">
					<h3 class="panel-title">E calculation</h3>
				</div>
				<div class="panel-body">
<form name="qes" method="post" enctype="multipart/formdata" action="#">

	<fieldset class="form-group">
			<label for="course">COURSE ID</label>
			<select class="form-control" name="cid" id="cid">

				<?php


				$output='';
				$query = "SELECT subjectid FROM subject_allocation WHERE fid= '".$staff_id."' ";
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
	<label for="stud">No of Students</label>
	<center><input class="form-control" type="text" name="studn" id="studn" ></center>
	</fieldset>
	<fieldset class="form-group">
	<label for="stud">Attainment Level Calculation Grade in between the Range</label>
	<table><tr><td><input class="form-control" type="text" name="start" id="start"></td/><td>to</td><td><input class="form-control" type="text" name="limit" id="limit" value="O(Outstanding)"></td></tr></table>



	</br>	<button name="getdt" class="btn btn-info" id="bt"> Get Details </button>
	</br>
	</br>
	<?php

	 if(isset($_POST['getdt']))
	{

		     $course_id= $_POST['cid'] ;
         $_SESSION['$course_id']= $course_id;
				$query="SELECT external_mark_entry_table.studid,external_mark_entry_table.external_grade,subject_class.subjectid,subject_class.subject_title FROM external_mark_entry_table,subject_class WHERE subject_class.subjectid= '$course_id' AND subject_class.subjectid=external_mark_entry_table.subjectid ";
				$result = mysqli_query($connection, $query);
				while($row= mysqli_fetch_array($result))
				{
				$course_id= $row['subjectid'];
				$coursename=$row['subject_title'];
				$grade=$row['external_grade'];

				if($grade=="O")
				{
					$o= $o + 1;
				}
				elseif($grade=="A+")
				{
					$ap= $ap + 1;
				}
				elseif($grade=="A")
				{
					$ao= $ao + 1;
				}
				elseif($grade=="B+")
				{
					$bp= $bp + 1;
				}
				elseif($grade=="B")
				{
					$bo= $bo + 1;
				}
				elseif($grade=="C")
				{
					$c= $c + 1;
				}
				elseif($grade=="P")
				{
					$p= $p + 1;
				}
				else{;}

				}

			 $gradestart= $_POST['start'];
       $_SESSION['$gradestart']=$gradestart;
			if($gradestart=="O")
			{
				$val= $o;
			}
			elseif($gradestart=="A+")
			{
				$val= $o+$ap;
			}
			elseif($gradestart=="A")
			{
				$val= $o+$ap+$ao;
			}
			elseif($gradestart=="B+")
			{
				$val= $o+$ap+$ao+$bp;
				echo $val;
			}
			elseif($gradestart=="B")
			{
				$val= $o+$ap+$ao+$bp+$bo;
			}
			elseif($gradestart=="C")
			{
				$val= $o+$ap+$ao+$bp+$bo+$c;
			}
			elseif($gradestart=="P")
			{
				$val= $o+$ap+$ao+$bp+$bo+$c+$p;
	        }
			else{;}
			$studno= $_POST['studn'];
      $_SESSION['$studno']=$studno;
	        $attainper= ($val/ $studno)*100;
$_SESSION['ecalattainper']=$attainper;
$_SESSION['ecalval']=$val;
	}

	?>
<div class="table-responsive">
				 <table class="table table-bordered" id="dynamic_field">
					 <thead><label for="course">Consolidated Result Analysis Using Grades</label></thead>
					 <tr>
						 <th rowspan="2">	COURSE_ID </th>
						 <th rowspan="2">	CORSE_NAME  </th>
						 <th colspan="7">No Of Students Who Scored</th>
						<th rowspan="2">No of Students Scored in between the acceptable range</th>
						  <th rowspan="2">Level of Attainment<br> in Percentage</th>
						 </tr>
					 <tr>
					  <td>O</td>
						  <td>A+</td>
						  <td>A</td>
						  <td>B+</td>
						  <td>B</td>
						  <td>C</td>
						  <td>P</td>
						  </tr>
						  <tr>
					 <td> <input class="form-control" type="text" name="course_id" id="course_id" value= "<?php echo (isset($course_id))?$course_id:'';?>"> </td>
					<td> <input class="form-control" type="text" name="courname" id="courname" value="<?php echo (isset($coursename))?$coursename:'';?>"></td>
					 <td> <input class="form-control" type="text" name="o" id="o" value= "<?php echo (isset($o))?$o:'';?>"></td>
					 <td> <input class="form-control" type="text" name="ap" id="ap" value= "<?php echo (isset($ap))?$ap:'';?>"></td>
					 <td> <input class="form-control" type="text" name="ao" id="ao" value= "<?php echo (isset($ao))?$ao:'';?>"></td>
					 <td> <input class="form-control" type="text" name="bp" id="bp" value= "<?php echo (isset($bp))?$bp:'';?>"></td>
					  <td> <input class="form-control" type="text" name="bo" id="bo" value= "<?php echo (isset($bo))?$bo:'';?>"></td>
					 <td> <input class="form-control" type="text" name="c" id="c" value= "<?php echo (isset($c))?$c:'';?>"></td>
					  <td> <input class="form-control" type="text" name="p" id="p" value= "<?php echo (isset($p))?$p:'';?>"></td>
					<td> <input class="form-control" type="text" name="nost" id="nost" value= "<?php echo (isset($val))?$val:'';?>"></td>
					 <td> <input class="form-control" type="text" name="per" id="per" value="<?php echo (isset($attainper))?$attainper:'';?>"></td>
					 <?php   if($attainper>=70)
		  {
			  $E= 3;
		  }
		  elseif($attainper>=65)
		  {
			  $E= 2;
		  }
			 else
			 {
				 $E= 1;
			 } ?>

					</tr>
					<tr>
					<td colspan= "11"><center>
					<?php echo "E=";echo (isset($E))?$E:'';?>
					</center>
					</td>
					</tr>
				 </table>
	</div>
	</br>
	</br>
	</fieldset>
	<button align="right" type="submit" name="submit" class="btn btn-info"> Submit </button>
<?php
if(isset($_POST['submit']))
	{
		 $course_id= $_POST['course_id'] ;
		 $above= $_POST['nost'];
		  $attain= $_POST['per'];
		  $o= $_POST['o'];
		  $ap= $_POST['ap'];
		  $ao= $_POST['ao'];
		  $bp= $_POST['bp'];
		  $bo= $_POST['bo'];
		  $c= $_POST['c'];
		  $p= $_POST['p'];
      $result=mysqli_query($sql,"SELECT * FROM external_percent WHERE subjectid='$course_id'");
      $countsur=mysqli_num_rows($result);
      if($countsur>0)
      {

      }
      else{
		$query="INSERT INTO external_percent(`subjectid`,`O`,`A+`,`A`,`Bp`,`Bo`,`C`,`P`,`scored_stud`,`percent`) VALUES ( '".$course_id."','".$o."','".$ap."','".$ao."','".$bp."','".$bo."','".$c."','".$p."','".$above."','".$attain."') ";
        $insert=mysqli_query($connection,$query);
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
  <a href="http://localhost/amsa/fpdf/pdfecalc.php";
  <button>PRINT</button>
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
