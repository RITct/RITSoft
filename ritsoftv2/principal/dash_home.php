<?php
include("includes/header.php");

include("includes/sidenav.php");

$_SESSION['dtype']="principal"; //faculty id from session



//READING FACULTY NAME AND DEPARTMENT
//$resul=mysql_query("select name,deptname from faculty_details where fid='KTU01'");
//while($dat=mysql_fetch_array($resul))
//{
  //  $fname=$dat["name"];
    //$fdeptname=$dat["deptname"];

//}


//reading class id from staff adviser
//$resul=mysql_query("select classid from staff_advisor where fid='KTU01'");
///while($dat=mysql_fetch_array($resul))
//{
   // $classid=$dat["classid"];
//}
//$_SESSION["classid"]=$classid;
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><span style="font-weight:bold;">WELCOME
                <?php
                       // $r=mysql_query("select name from faculty_details where fid='$fid'");
                       // while($d=mysql_fetch_array($r))
                       // {
                        //    $fname=$d["name"];
                
                        //}

                        //echo $fname;
                ?>       



            </span></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
    <!-- /.row -->
            <!--<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-fw fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                          //              $ree=mysql_query("select reg_id,adm_no,classid,previous_sem,new_sem,apv_status from stud_sem_registration where classid='$classid' and apv_status='Not Approved'");
                            //            $r1=mysql_num_rows($ree);
                              //           echo $r1;
                                        ?>    
                                    </div>
                                    <div>Personal Details</div>
                                </div>
                            </div>
                        </div>
                        <a href="\v2\UGDEAN\singlesearch.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-fw fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                      <?php// $re=mysql_query("select subjectid from subject_class where classid='$classid'");
                //while($d=mysql_fetch_array($re))
                //{
                  //  $subjectid=$d["subjectid"];
                   
              //  }
            //    $rel=mysql_query("select distinct(studid)from sessional_marks where classid='$classid' and status='verification pending' order by(studid)");
           
            //$r2=mysql_num_rows($rel);
                                         //echo $r2;
            ?>

                                    </div>
                                    <div>Attendance Details</div>
                                </div>
                            </div>
                        </div>
                        <a href="sessionalmark_verification.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                 <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-table fa-fw fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                     //   $resul=mysql_query("select studid,rollno from current_class where classid='$classid' order by(rollno)");
                                        //$re=mysql_num_rows($resul);
                                         //echo $re;
                                        ?> 

                                    </div>
                                    <div>Sessional Marks</div>
                                </div>
                            </div>
                        </div>
                        <a href="student_details.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>-->
                
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