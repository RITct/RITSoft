<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
include("studentdata.php");
$data=getstuddata();    
?>

 <form id="myForm" action="https://ritgrc.com/GrievancesSystemApi/api/student-signup/" method="post">
<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><b>RIT Grievance Redressal Portal</b></h1>
			</div>
			</div>

<?php

$email = $data["email"];
$username = $data["username"];
$classname = $data["classname"];
//$time = strtotime($data["dob"]);
//$dob = date('d-M-Y',$time);
$dob = date("Y-m-d");

$phone = $data["phone"];
//$doj = $data["doj"];
$doj = date("Y-m-d");

$password = $data["password"];

?>
<table  class="table table-hover table-bordered" >
<tr><td>
<div class="form-row">
	  <div class="form-group col-md-6">
      <label>Email Id</label></td><td>

<input style="border:0px" type="text" readonly name="email" value="<?php echo $email ?>"> </div></div> </td></tr>
<tr><td>
<div class="form-row">
	  <div class="form-group col-md-6">
      <label>Admission No</label></td><td>


<input type="text" style="border:0px" name="username" readonly  value="<?php echo $username ?>"> </div></div> </td></tr>

<tr><td>
<div class="form-row">
	  <div class="form-group col-md-6">
      <label>Class</label></td><td>


<input type="text" style="border:0px" name="classname" readonly  value="<?php echo $classname ?>"> </div></div> </td></tr>

<tr><td>
<div class="form-row">
	  <div class="form-group col-md-6">
      <label>DOB</label></td><td>


<input type="text" style="border:0px" name="dob" readonly  value="<?php echo $dob ?>"> </div></div> </td></tr>

<tr><td>
<div class="form-row">
	  <div class="form-group col-md-6">
      <label>Phone No:</label></td><td>

 
<input type="text" style="border:0px" name="phone" readonly  value="<?php echo $phone ?>"> </div></div> </td></tr>

<tr><td>
<div class="form-row">
	  <div class="form-group col-md-6">
      <label>DOJ</label></td><td>


<input type="text" style="border:0px" name="doj" readonly  value="<?php echo $doj ?>"> </div></div>  </td></tr>


     
<input type="hidden" name="password"   value="<?php echo $password ?>"> </div></div> 
<tr><td colspan="2">

<center><input type="submit" name="submit" value="SIGN IN"> </center>
</td></tr></table>
</form>	
	
	
<?php

include("includes/footer.php");
?>
