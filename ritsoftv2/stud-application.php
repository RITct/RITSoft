<?php
include("header1.php");
if(!isset($_SESSION['admofficeid']))
{
  echo "<script>alert('Session Expired')</script>";
  echo "<script>window.location.href='login.php'</script>";
}
 include "dboperation.php";
?>
<div class="container">
<form action="" method="post" class="sear_frm" >
<div class="form-row">
<div class="form-group>
<label for="temp_no">Temporary No:</label>
 <input type="text" id="temp" name="temp" class="form-control">
</div>
	</div>
 <br><br>
	<div class="form-row">

				<div class="form-group col-md-6">
			<label  for="course">Student Email Id</label>
			<input type="email" class="form-control" id="emailid" name="emailid" required>

		</div>
	</div>




<div align="center">


<!-- <input type="submit" id="submit" name="submit" value="Edit Details" class="btn btn-primary"> -->

<input type="submit" id="submit1" name="submit1" value="Generate PDF" class="btn btn-primary">

</div>

</form>

</div>


<?php
if(isset($_POST['submit']))
{
$tp_no=$_POST['temp'];

$emailid=$_POST['emailid'];
$resul1=mysql_query("SELECT * FROM temp WHERE temp_no = '$tp_no' and email='$emailid'");
$dat1=mysql_fetch_array($resul1);
if(mysql_num_rows($resul1) != 1)
{
?><script> alert("No records Found");</script><?php

echo "<script>location.href='stud-application.php'</script>";

}


else
{

	

	$_SESSION['temp']=$_POST['temp'];
        $_SESSION['emailid']=$_POST['emailid'];
        echo "<script>location.href='stud_dataedit.php'</script>";

}

}

if(isset($_POST['submit1']))
	
{

$tp_no=$_POST['temp'];

$emailid=$_POST['emailid'];
$resul1=mysql_query("SELECT * FROM temp WHERE temp_no = '$tp_no' and email='$emailid'");
$dat1=mysql_fetch_array($resul1);
if(mysql_num_rows($resul1) != 1)
{
?><script> alert("No records Found");</script><?php

echo "<script>location.href='stud-application.php'</script>";

}
else
{
	
	$_SESSION['temp']=$_POST['temp'];
        $_SESSION['emailid']=$_POST['emailid'];

echo "<script>location.href='stud_datasheet.php'</script>";

}

}


?>


<?php 

include("footer.php");
?>
