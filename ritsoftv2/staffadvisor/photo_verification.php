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
                $r=mysql_query("select courseid,semid from class_details where classid='$classid' ");
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
            <th style="text-align: center;">PHOTO</th>
            <th style="text-align: center;">STATUS</th>


        </tr>

        <?php


//reading Student details 
        $resul=mysql_query("select cc.studid AS studid,cc.rollno AS rollno from current_class cc LEFT JOIN stud_details sd ON sd.admissionno = cc.studid  where cc.classid='$classid' AND LENGTH(sd.image) > 0   AND sd.image_status IS NOT NULL ORDER BY  IF(sd.image_status = 'Not Verified', 1, IF ( sd.image_status = 'Verified', 3 , 2)) ");
        while($data=mysql_fetch_array($resul))
        {
            $adm_no=$data["studid"];
            $rollno=$data["rollno"];

            $result=mysql_query("select name,image,image_status, image from stud_details where admissionno='$adm_no' ");






            while($dat=mysql_fetch_array($result))
            {
              $name=$dat["name"];
              $image=$dat["image"];
              $image_status=$dat["image_status"];
              

              ?>
              <tr >
                <td align="center"><?php  echo $rollno;?></td>
                <td align="center"><?php  echo $adm_no;?></td>
                <td align="center"><?php  echo $name;?></td>
                <td align="center"><img  
                   src="data:image/jpeg;base64,<?php 
                   echo base64_encode($image); 
                   ?>"
                   width="100" height="100" onerror="this.onerror=null;this.src='../vendor/images/default.png'; "></td>

                   <td align="center">
                    <?php  
                    if($image_status=='Not Verified')
                        {?>
                            <a href="photo_edit.php?id=<?php echo $adm_no; ?>&id2=1">verify</a> |  
                            <a href="photo_edit.php?id=<?php echo $adm_no; ?>&id2=2">Reject</a>

                        <?php }
                        else
                        {
                            echo $image_status;
                        }?>



                    </td>

                    <td>











                    </td>
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

