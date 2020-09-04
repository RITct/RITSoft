<?php
if(isset($_GET["sid"]))
{
      include "includes/dboperation.php";
      $id=$_GET["sid"];	
      $sql=mysql_query("delete from scholarship_type where id=$id");

   if($sql)
	  { 
		  echo "<script> alert('Deleted successfully...'); </script>";

                 echo '<script> location.replace("view_scholar_type.php"); </script>';

	  }
	  
      else
	  {
                  echo "<script> alert('Failed...'); </script>";
                  echo '<script> location.replace("view_scholar_type.php"); </script>';

          }
}
?>

