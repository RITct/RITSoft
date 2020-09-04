
<?php


	include("header.php");
    include("connection.php");
    include("sidenav.php");
	 
	 global $d;
	
	$q1=mysqli_query($con,"SELECT deptname FROM faculty_details WHERE fid='".$_SESSION['user_id']."'");
				
				   while($row=mysqli_fetch_array($q1))
				{
					 $d=$row["deptname"];
				}				
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Program Specific Outcomes</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
				<form action="#" method="post">
				<h3 class="page-header"><b><center>PROGRAM SPECIFIC OUTCOMES</center></b></h3>
				<div class="table-responsive">
					<table class="table table-bordered" id="dynamic_field" border="1">
			 <thead>
				 <th>	PSO CODE </th>
				 <th>	PSO NAME  </th>
				 <th> PSO DESCRIPTION </th>
			 </thead>
			 <?php
			 $result=mysqli_query($con,"select * from tbl_pso where dept='".$d."'");
			 while($row=mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['pso_code'] . "</td>";
	echo "<td>" . $row['pso_name'] . "</td>";
	echo "<td>" . $row['pso_description'] . "</td>";
	echo "</tr>";
}
     echo "</table>";
	 ?>
	 <div class="button-panel">
		<input type="submit" class="btn btn-info" title="PRINT" name="print" value="PRINT"></input>
		&emsp;
		<input type="submit" class="btn btn-info" title="BACK" name="back" value="BACK"></input>
    </div>
	<?php
	if(isset($_POST['print']))
{
	
			echo '<script> window.location="pso_pdf.php"; </script>';
}
if (isset($_POST['back']))
{
	echo '<script> window.location="dash_home.php"; </script>';
}
?>
</div>
	</form>
	
</div>
</div>
</div>
</body>
</html>
<?php
include("footer.php");
?>