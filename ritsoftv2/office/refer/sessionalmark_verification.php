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
                    <h1 class="page-header">SESSIONAL MARK OF 
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
    <th style="text-align: center;">ADMISSION NUMBER</th>
    <th style="text-align: center;">NAME</th>
    <?php
$re=mysql_query("select subjectid from subject_class where classid='$classid'");
                while($d=mysql_fetch_array($re))
                {
                    $subjectid=$d["subjectid"];
                    ?>
                    <th align="center">
                        <?php echo $subjectid; ?>
                            
                        </th>
                        <?php
                }
                ?>
                    <th style="text-align: center;">STATUS</th>

                </tr>









        <?php $st=1;
            $resul=mysql_query("select distinct(studid)from sessional_marks where classid='$classid' order by(studid)");
            while($dat=mysql_fetch_array($resul))
            {
            //$c=0;
                $studid=$dat["studid"];



                //$res=mysql_query("select rollno from current_class where studid='$studid'");
                ////while($da=mysql_fetch_array($res))
                //{
                    //$rollno=$da["rollno"];
                //}
                $re=mysql_query("select name from stud_details where admissionno='$studid'");
                while($d=mysql_fetch_array($re))
                {
                    $name=$d["name"];
                }

?>

                
                <tr>
                    <td align="center"><?php echo $studid;?></td>
                    <td align="center"><?php echo $name;?></td>
                <?php
                $re=mysql_query("select subjectid from subject_class where classid='$classid'");
                while($d=mysql_fetch_array($re))
                {
                    $subjectid=$d["subjectid"];
                    $sessional_marks='--';
          
                $result=mysql_query("select * from sessional_marks where classid='$classid' and studid='$studid' and subjectid='$subjectid' order by(subjectid)");
                
                while($data=mysql_fetch_array($result))
                {
                    $classid=$data["classid"];
                    //$studid=$data["studid"];
                    $subid=$data["subjectid"];
                    $data["sessional_marks"];
                    
                    $sessional_marks=$data["sessional_marks"];
            
                    $status=$data["status"];
                    if($status=="verification pending")
                    {
                        $st=0;
                    }
                    ?>
                    
                <?php



                }   
            
            ?>
                <td align="center"><?php /*echo $subjectid; echo " : ";*/ echo $sessional_marks;?></td>
                <?php
            }
                ?>
                <?php
                if($st!=0)
                {?>
                    <td align="center"><?php echo $status;?></td>
                <?php
                }
                else
                {
                    $st=1;
                ?>
                    <td align="center">
                    <div class="btn-group">
                    <a href="sessionalmark_edit.php?id=<?php echo $studid; ?>">verify</a>
                    </div>
                    </td>
                <?php
                 }
                ?>
        </tr>


        
        <br>       

    <?php
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