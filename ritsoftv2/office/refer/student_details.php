<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
  $count=0;

    $classid=$_SESSION["classid"];

?>
  
        
<div id="page-wrapper">
    
            <div class="row">
                <div class="col-lg-12" >
                    <h1 class="page-header">STUDENT DETAILS OF 
                        <?php
                        $r=mysql_query("select courseid,semid from class_details where classid='$classid'");
                        while($d=mysql_fetch_array($r))
                        {
                            $co=$d["courseid"];
                            $sem=$d["semid"];
                        }
                        //echo $co;
                        ?>       
                        SEMESTER
                        <?php
                        echo $sem;
                        ?>       
                     </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="table-responsive">
  <table width="50%"  class="table table-hover table-bordered">
    <tr>
        <th style="text-align: center;">ROLL NUMBER</th>
        <th style="text-align: center;">ADMISSION NUMBER</th>
        <th style="text-align: center;">STUDENT NAME</th>
        <th style="text-align: center;">EMAIL</th>
        <th style="text-align: center;">MOBILE</th>
        <th style="text-align: center;">PARENT MOBILE</th>
    </tr>

<?php
//reading registration details
$resul=mysql_query("select studid,rollno from current_class where classid='$classid' order by(rollno)");
while($data=mysql_fetch_array($resul))
    {
        $adm_no=$data["studid"];

        $rollno=$data["rollno"];

        $result=mysql_query("select name,email,mobile_phno from stud_details where admissionno='$adm_no'");






        while($dat=mysql_fetch_array($result))
        {
          $name=$dat["name"];
          $email=$dat["email"];
          $mobile_phno=$dat["mobile_phno"];
          $result1=mysql_query("select parentid  from parent_student where admissionno='$adm_no'");
       


        while($dat1=mysql_fetch_array($result1))
        {
          $parentid=$dat1["parentid"];
        }



        $result2=mysql_query("select guard_contactno  from parent where parentid='$parentid'");
        while($dat2=mysql_fetch_array($result2))
        {
          $guard_contactno=$dat2["guard_contactno"];
        }


?>
        <tr >
            <td align="center"><?php  echo $rollno;?></td>
            <td align="center"><?php  echo $adm_no;?></td>
            <td align="center"><?php  echo $name;?></td>
            <td align="center"><?php  echo $email;?></td>
            <td align="center"><?php  echo $mobile_phno;?></td>
            <td align="center"><?php    echo $guard_contactno; ?></td>
        </tr>
        <?PHP
        }
    }
    ?>
</table> 
</div>
<button class="btn btn-primary" onclick="PrintElem('page-wrapper')">Print</button>


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