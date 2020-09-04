<?php
	//This is used for header and side navigation links.
include("includes/header.php");

include("includes/sidenav.php");
include "includes/connection.php";
$id=$_GET['sid'];
$sql=mysql_query("SELECT * from scholarship_type where id=$id");
$r=mysql_fetch_assoc($sql);
$sname=$r['schol_name'];
$sid=$r['id'];

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
      <label  for="adno">Scholarship Type: </label>
	  <input type="text" class="form-control" name="stype" id="stype" value="<?php echo $sname; ?>"  required>
     <input type="hidden" id="id" name="id" value="<?php echo $sid; ?>">
      
 <br><br>
    
      <div align="center">
	   <button type="submit" value="submit" name="submit" id="submit" class="btn btn-primary">Edit Scholarship Type</button> 
			  </div> </div>
	</div>
</form>
</div>

<?php
if(isset($_POST["submit"]))
{
	$sname=$_POST["stype"];
	$id=$_POST["id"];
	//echo $stype;
	
$sql=mysql_query("update scholarship_type set schol_name='$sname' where id=$id");

if($sql)
	  {
		  echo "<script> alert('Scholarship Details edited successfully...'); </script>";

                 echo '<script> location.replace("view_scholar_type.php"); </script>';

	  }
	  
      else
	  {
echo "<script> alert('Failed...'); </script>";
  echo '<script> location.replace("view_scholar_type.php"); </script>';

		 	  }

}

?>

<?php
	// Link for footer.php
include("includes/footer.php");
?>
