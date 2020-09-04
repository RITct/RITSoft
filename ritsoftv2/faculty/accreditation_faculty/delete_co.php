<?php


	include("connection.php");

	include("header.php");
    
    include("sidenav.php");
	global $result;
	global $result1;
	?>
	<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Outcome Delete</title>

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
          
          <div class="panel-body">
            <form name="del_co" method="post" action="#">
            <fieldset class="form-group">
                <label for="course">CO Code</label>
				
    <input class="form-control" type="text" name="co_code" id="co_code" required="required" >
	</fieldset>
	</div>
		  <div class="button-panel">
		<input type="submit" class="btn btn-primary" title="Delete" name="delete" value="Delete CO"></input>
				</div>
				<?php
				if(isset($_POST['delete']))
		{
			
			$flag=0;
			$crs=$_SESSION['crs_id'];
			$co_code=$_POST['co_code'];
			$ans=mysqli_query($con,"select * from tbl_co where co_code='".$co_code."' and subjectid='".$crs."'");
			while($r1=mysqli_fetch_array($ans))
		   {
			$d1="delete from tbl_co where co_code='".$co_code."' and subjectid='".$crs."'";
			$result= mysqli_query($con,$d1);
			$d2="delete from co_po_correlation where co_code='".$co_code."' and course_id='".$crs."'";
			$result1= mysqli_query($con,$d2);
			$flag=1;
		   }
			if($result and $result1)
		    {
		       echo "<script type='text/javascript'>alert('CO deleted successfully!')</script>";
		    }
	        elseif($flag==0)
			{
				echo "<script type='text/javascript'>alert('No such records')</script>";
			}
			else
	        {
			   echo "<script type='text/javascript'>alert('Error in deletion')</script>";
	        }
			
		}
			?>
		</div>
		</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
include("footer.php");
 ?>