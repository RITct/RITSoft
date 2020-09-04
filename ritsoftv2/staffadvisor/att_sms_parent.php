  <?php

function sendattsms($msg11,$admno11)
{
	
include_once('../msgclass.php');


           $msg1=$msg11;
           $admno=$admno11;
           $y=0;
      
              $result1=mysql_query("select parentid from parent_student where admissionno='$admno'");
              
              if(mysql_num_rows($result1) > 0)
             {
             
              while($dat1=mysql_fetch_array($result1))
              {
                  $parentid=$dat1["parentid"]; 
              }
                               
                        
              $result2=mysql_query("select name_guard,guard_contactno from parent where parentid='$parentid'");
              while($dat2=mysql_fetch_array($result2))
              {    
                  $guard_name=$dat2["name_guard"];
                  $msg="Dear ".$guard_name.", ".$msg1;

                  $guard_contactno=$dat2["guard_contactno"];
                  if(!empty($guard_contactno))
                          {
                             sendmsg($guard_contactno,$msg);
                        // echo "hai";
                            $y=1;

                          }           

            }



//echo '<script> alert("Messages send, view message sending status"); </script>';
//echo "<script>window.location.href='smsstatus.php?status=".$status."'</script>";

}
return $y;

}
?>


 