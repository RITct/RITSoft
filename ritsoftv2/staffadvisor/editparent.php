<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
 $adm_no=$_GET['sid'];
 $pid=$_GET['pid'];

$result=mysql_query("select name,email,mobile_phno from stud_details where admissionno='$adm_no'");

            while($dat=mysql_fetch_array($result))
            {
              $sname=$dat["name"];
             // $email=$dat["email"];
             // $mobile_phno=$dat["mobile_phno"];

            }

$result1=mysql_query("select name_guard,guard_email,guard_contactno from parent where parentid='$pid'");

            while($dat1=mysql_fetch_array($result1))
            {
              $pname=$dat1["name_guard"];
              $email=$dat1["guard_email"];
              $mobile_phno=$dat1["guard_contactno"];

            }





 ?>
<div id="page-wrapper">  
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					
					<h3 class="tittle my-5 text-capitalize"><center>EDIT PARENT DETAILS</center></h3> <br><br><br>
				</div>


<div class="box-body">
<div>

<form id="form1" name="form1" method="post" action="" enctype="" class="sear_frm" onsubmit="return confirm('Are you sure, Do you want to save the details?');">
<div class="form-row">

 	<div class="form-group col-md-6">
      <label  for="adno">STUDENT ADMISSION NO </label>
	  <input type="text" class="form-control" name="admno" id="admno" value="<?php echo $adm_no; ?>" readonly>
     </div>
	</div>
      
   <div class="form-row">

 	<div class="form-group col-md-6">
      <label  for="adno">STUDENT NAME</label>
	  <input type="text" class="form-control" name="name" id="name"  value="<?php echo $sname; ?>" readonly>
     </div>
	</div>

<div class="form-row">

 	<div class="form-group col-md-6">
      <label  for="adno">PARENT NAME</label>
	  <input type="text" class="form-control" name="pname" id="pname"  value="<?php echo $pname; ?>" readonly>
     </div>
	</div>
<!-- <div class="form-group col-md-6">
      <label  for="adno">PARENT EMAIL</label>
	  <input type="email" class="form-control" name="email" id="email"  value="<?php echo $email; ?>" required>
     </div>
	</div> -->
<div class="form-group col-md-6">
      <label  for="adno">PARENT PHONE NO</label>
	  <input type="text" pattern="^\d{10}$" class="form-control" name="phno" id="phno"  value="<?php echo $mobile_phno; ?>" required>
          <input id="pid" name="pid" type="hidden" value="<?php echo $pid; ?>">
     </div>
	</div>



		         

      <div align="center">
	   <button type="submit" value="submit" name="submit" id="submit" class="btn btn-primary">EDIT DETAILS</button> 
			  </div>

 
</form>

</div>
</div>


 
    
        <?php


if(isset($_POST["submit"]))
{
	
	//$email=$_POST['email']; 
	$phno=$_POST["phno"];
        $pid=$_POST["pid"];

        			       	
      
        $resul=mysql_query("update parent set guard_contactno='$phno' where parentid='$pid'");
       
echo '<script> alert("Updated Sucessfully"); </script>';
echo "<script>window.location.href='edit_student_details.php'</script>";



}
?>


  
<?php

include("includes/footer.php");
?>
