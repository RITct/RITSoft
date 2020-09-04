<?php

global $fid;

	include("connection.php");

	include("header.php");
    
    include("sidenav.php");
	

if(isset($_SESSION['user_id']))
{
$fid=$_SESSION['user_id'];
//echo $fid;
}
function fill_course($con){

	$course='';
		$q1=mysqli_query($con,"SELECT subjectid FROM subject_allocation WHERE fid ='".$_SESSION['user_id']."'");
		while($r1=mysqli_fetch_array($q1))
		{
				$_d1=$r1['subjectid'];
				$k=mysqli_query($con,"SELECT * FROM subject_class where subjectid='".$_d1."'");
				
				 while($row=mysqli_fetch_array($k))
				{
					$course .='<option value="'.$row["subjectid"].'">'.$row["subjectid"].$row["subject_title"].'</option>';
				}
		}
				return $course;
		
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Outcome View</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
	
  </head>
  <body>
  

    <div class="row 1">
      <div class="col-md-3">

      </div>
      <div class="col-md-8">
        <div class="panel panel-danger" style="margin-top:80px;">
          <div class="panel-heading">
            <h3 class="panel-title">COURSE OUTCOME</h3>
          </div>
          <div class="panel-body">
            <form name="co" method="post" action="#">
            <fieldset class="form-group">
                <label for="course">Subject Id</label>
                <select class="form-control" id="course_id" name="course_id">
				<option>Select</option>
                  <?php echo fill_course($con);
					
				  ?>
                  </select>
            </fieldset>

              
              
            
        </div>
		  <div class="button-panel">
		<input type="submit" class="btn btn-info" title="View CO" name="view" value="View CO"></input>
				</div>
		<?php
	   
	   if(isset($_POST['view']))
		{
			
			
			$_SESSION['crs_id']=$_POST['course_id'];
			$co_code=$_POST['course_id'];
			$result=mysqli_query($con,"select co_code,co_name,date from tbl_co where subjectid='".$co_code."' order by co_code");
			?>
			<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th style="text-align: center;" > CO </th>
											<th style="text-align: center;" > CO Description </th>
											<th style="text-align: center;" > Year </th>
										</tr>
									</thead>
									<tbody>
			<?php
			while($row=mysqli_fetch_array($result))
			{
				?>
				<tr> 
		<td style="text-align: center;"><?php echo $row['co_code']; ?> </td>

		<td style="text-align: center;"><?php echo $row['co_name'] ?></td>
		
		<td style="text-align: center;"><?php echo $row['date'] ?></td>
				</tr>
				<?php
				echo "<br>";
			}
			?>
			</tbody>
			</table>
			
		  <div class="button-panel">
		<input type="submit" class="btn btn-info" title="Add CO" name="add" value="Add CO"></input>
		
		<input type="submit" class="btn btn-info" title="Delete CO" name="delete" value="Delete CO"></input>
		</div>
			<?php
		}
	
		if(isset($_POST['add']))
		{
			
			
			echo '<script> window.location="co_add.php"; </script>';
		}
		if(isset($_POST['delete']))
		{
			
			
			echo '<script> window.location="delete_co.php"; </script>';
		}
  ?>
  </div>
  </div>
	<a href="http://localhost:8080/myproject/faculty/dash_home.php"> Back to home</a>
  </div>
  
  <!--<input type="submit" class="btn btn-primary" title="Add CO" name="add" value="Add CO"></input>-->

      

	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
include("footer.php");
 ?>