<?php
	//This is used for header and side navigation links.
include("includes/header.php");

include("includes/sidenav.php");
include "includes/dboperation.php";

?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;">Add Scholarship ...
                      
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
    
	   <form id="form1" name="form1" method="post" action="" enctype="" class="sear_frm">
      

	<div class="form-row">

 	<div class="form-group col-md-6">
      <label  for="adno">Enter Scholarship Type: </label>
	  <input type="text" maxlength="200"  class="form-control" name="stype" id="stype"  required>
     
      
 <br><br>
    
      <div align="center">
	   <button type="submit" value="submit" name="submit" id="submit" class="btn btn-primary">Add Scholarship Type</button> 
			  </div> </div>
	</div>
</form>
</div>

<?php
if(isset($_POST["submit"]))
{
	$stype=$_POST["stype"];
	//echo $stype;
	
$sql=mysql_query("insert into scholarship_type(schol_name) values('$stype')");

if($sql)
	  {
		  echo "<script> alert('Scholarship Details added successfully...'); </script>";

                 echo '<script> location.replace("add_scholar_type.php"); </script>';

	  }
	  
      else
	  {
echo "<script> alert('Failed...'); </script>";
 echo '<script> location.replace("add_scholar_type.php"); </script>';

		 	  }

}

?>

<?php
	// Link for footer.php
include("includes/footer.php");
?>
