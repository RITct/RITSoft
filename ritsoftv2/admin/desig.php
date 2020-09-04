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
	$facid=$_POST["facid"];
	$dept=$_POST["dept"];

	mysql_query("delete from faculty_designation where fid='$facid' and designation!='staff advisor'");  
	if(isset($_POST['principal']))
		$princi=$_POST['principal'];
	else
		$princi="";
	if(isset($_POST['pgdean']))
		$pg=$_POST['pgdean'];
	else
		$pg=""; 
	if(isset($_POST['ugdean']))
		$ug=$_POST['ugdean'];
    else
		$ug="";	
	if(isset($_POST['student_affairsdean']))
		$studdean=$_POST['student_affairsdean'];
    else
		$studdean="";
	if(isset($_POST['hod']))
		$hod=$_POST['hod'];
	else
		$hod="";
	if(isset($_POST['faculty']))
		$faculty=$_POST['faculty'];
	else
		$faculty="";
	
	if($princi!="")
	{ 
        mysql_query("delete from faculty_designation where designation='principal'");
		$r=mysql_query("insert into faculty_designation values('$facid','$princi')") or die(mysql_error());
	}
	if($pg!="")
	{
		mysql_query("delete from faculty_designation where designation='pgdean'");
		$r=mysql_query("insert into faculty_designation values('$facid','$pg')");
	}
	if($ug!="")
	{
		mysql_query("delete from faculty_designation where designation='ugdean'");
		$r=mysql_query("insert into faculty_designation values('$facid','$ug')");
	}
	if($studdean!="")
	{
		mysql_query("delete from faculty_designation where designation='student_affairsdean'");
		$r=mysql_query("insert into faculty_designation values('$facid','$studdean')");
	}
	if($hod!="")
	{
		$l=mysql_query("select fid from faculty_details where deptname='$dept'") or die(mysql_error());
		while ($r=mysql_fetch_assoc($l)) {
			$f=$r["fid"];
			mysql_query("delete from faculty_designation where designation='hod' and fid='$f'") or die(mysql_error()); 
		}
		$r=mysql_query("insert into faculty_designation values('$facid','$hod')") or die(mysql_error());
		mysql_query("update department set hod='$facid' where deptname='$dept'") or die(mysql_error());
	}
	else
	{
		mysql_query("update department set hod='' where hod='$facid' and deptname='$dept'") or die(mysql_error());
	}
	if($faculty!="") 
	{
		$r=mysql_query("insert into faculty_designation values('$facid','$faculty')");
	}
		if($r==NULL)
				{
					echo "<script>alert('Not set the designation')</script>";
				}
		else
			echo "<script>alert('Successfully set the designation')</script>";
				
				
				
				
				
				
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
<select onchange="getfac(this.value)" name="dept" class="form-control" required>
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
</select>  
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