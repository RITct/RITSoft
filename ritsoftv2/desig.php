<?php
include("includes/header.php");
include("includes/sidenav.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function getfac(a)
{
	console.log(a);
 $.post( 
                  "fetchfac.php",
                  { key: a },
                  function(data) {
                     $('#data').html(data);
                  }
               );
}
			   </script>
			   
<?php
if(isset($_POST['submit']))
{
	
	if(!empty($_POST['check_list']))
	{
		
// Loop to store and display values of individual checked checkbox.
	foreach($_POST['check_list'] as $selected)
	{
	echo $selected."</br>";
	}
	}
	
	
	/*$princi=$_POST['principal'];
	$pg=$_POST['pgdean'];
	$ug=$_POST['ugdean'];
	$hod=$_POST['hod'];
	$staff=$_POST['staffadvisor'];
	$faculty=$_POST['faculty'];
	
	if($princi!='NULL')
	{ 
		$r=mysql_query("insert into faculty_designation values('$facid','$princi'");
	}
	if($pg!='NULL')
	{
		$r=mysql_query("insert into faculty_designation values('$facid','$pg'");
	}
	if($ug!='NULL')
	{
		$r=mysql_query("insert into faculty_designation values('$facid','$ug'");
	}
	if($hod!='NULL')
	{
		$r=mysql_query("insert into faculty_designation values('$facid','$hod'");
	}
	if($hod!='NULL')
	{
		$r=mysql_query("insert into faculty_designation values('$facid','$hod'");
	}
	if($faculty!='NULL')
	{
		$r=mysql_query("insert into faculty_designation values('$facid','$faculty'");
	}
	if($r==null)
				{
					echo "<script>alert('Not set the designation')</script>";
				}
	*/
}	
				
?>				   
				   
			   
			   
			   
<html>
<head> 
<title>Designation</title>
</head>
<body>

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Select Designation</h2>
                    </div>
				</div>
<form id="submit" method="post" >
<div class="row"> 
<div class="col-md-6"> 
<div class="form-group">
<label>Department:</label>
<select onchange="getfac(this.value)" class="form-control" required>
<option value="" selected disabled hidden>Select</option>
  <?php 
	$result=mysql_query("SELECT deptname FROM department");
	if($result)
	{
		
     while ($row = mysql_fetch_array($result, MYSQL_BOTH)) 
	 {
  ?>     
	<option>	<?php echo $row[0]; ?> </option>
  <?php
		 
	 }
    }
  ?> 
</select class="form-control">  
</div>
</div>

<div id="data">

</div>
</div>

</form> 
 
</body>
</html> 
 <?php
include("includes/footer.php");
?>  