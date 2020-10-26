<!-- Website template by freewebsitetemplates.com -->
<?php
include("includes/header.php");
include("includes/sidenav.php");
include "includes/dboperation.php";
//include("../connection.php");
$adm_no=$_GET["admission"];
?>
       
<div id="page-wrapper">
    
            <div class="row">
                <div class="col-lg-12" >
                    <h1 class="page-header">View Details
<!-- view student details  -->
                     </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="table-responsive">
<table   class="table table-hover table-bordered" >
     <tr>
        <th style="text-align: center;">ADMISSION NUMBER</th>
		 <th style="text-align: center;">STUDENT NAME</th>
        <th style="text-align: center;">APPLIED DATE</th>
        <th style="text-align: center;">COURSE NAME</th>
        <th style="text-align: center;">DEPARTMENT NAME</th>
        <th style="text-align: center;">CURRENT SEM</th>
        <th style="text-align: center;">NEXT SEM</th>
		
    </tr>



    
<?php
//fetching semid from class_details
$result=mysql_query("select semid from class_details where classid =(select classid from current_class where studid = '$adm_no' )");

while($dat1=mysql_fetch_array($result))
{
    $sem=$dat1["semid"];
}
//fetching data from class_details
$result1=mysql_query("select courseid,deptname from class_details where classid =(select classid from current_class where studid = '$adm_no')"); 
while($dat2=mysql_fetch_array($result1))
{
	$courseid=("$dat2[0]");
	$deptname=("$dat2[1]");
}
//fetching student name from stud_details
$result3=mysql_query("select name from stud_details where admissionno = '$adm_no'"); 
while($dat3=mysql_fetch_array($result3))
{
	$name=("$dat3[0]");
}

?>
    <tr align="center">
       
        <td align="center"><?php  echo $adm_no;?></td>
		<td align="center"><?php  echo $name;?></td>
		<td align="center"><?php  echo date("Y-m-d") ?></td>
        <td align="center"><?php  echo $courseid;?></td>
        <td align="center"><?php  echo $deptname;?></td>
        <td align="center"><?php  echo $sem; ?></td>
        <td align="center"><?php  echo $sem+1;?></td>
     
       
    </tr>
</table> 
</div>
<!--<button class="btn btn-primary" onclick="location.href='sem_verification.php'">Back</button>-->
            <!-- /.row -->
            <div class="row">
                
        
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    
                        </div>
                        <!-- /.panel-heading -->
                       
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                        <!-- /.panel-body -->
                      
                        <!-- /.panel-footer -->
                  </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->   
<?php

include("includes/footer.php");
?>

