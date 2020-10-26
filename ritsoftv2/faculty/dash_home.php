<?php
include("includes/header.php");
include("../connection.php");
include("includes/sidenav.php");
 //faculty id from session



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
                $r=mysql_query("select name from faculty_details where fid='$fid'",$con);
                while($d=mysql_fetch_array($r))
                {
                    $fname=$d["name"];

                }

                echo $fname;
                ?>       



            </span></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
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
                            <div>SERIES MARKS</div>
                        </div>
                    </div>
                </div>
                <a href="each_series_mark.php">
                    <div class="panel-footer">
                        <span class="pull-left">Enter</span>
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

                            </div>
                            <div>STUDENT SEARCH</div>
                        </div>
                    </div>
                </div>
                <a href="search-form.php">
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


                            </div>
                            <div>FEEDBACK</div>
                        </div>

                    </div>
                    <a href="datasheet.php">
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
                                    <div>ATTENDANCE</div>
                                </div>
                            </div>
                        </div>
                        <a href="hos_att.php">
                            <div class="panel-footer">
                                <span class="pull-left">Enter Attendance</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- /.row -->
          <!--  <div class="row">
                <div class="col-lg-8">
                    
                        </div>--!>
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
