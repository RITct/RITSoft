<?php
if(isset($_GET["sid"]))
{
      include "includes/dboperation.php";
      $id=$_GET["sid"];	
      $sql=mysql_query("delete from scholarship where id=$id");

   if($sql)
	  { 
		  echo "<script> alert('Deleted successfully...'); </script>";

                 echo '<script> location.replace("backend-search_scholarship2.php"); </script>';

	  }
	  
      else
	  {
                  echo "<script> alert('Failed...'); </script>";
                  echo '<script> location.replace("backend-search_scholarship2.php"); </script>';

          }
}
?>

