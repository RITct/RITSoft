<?php
include("includes/header.php");
include("includes/connection.php");
include("includes/sidenav.php");
$fid=$_SESSION["fid"]; 
?>
  
        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;">WELCOME
                        <?php
                        $r=mysql_query("select name from faculty_details where fid='$fid'");
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
                <div class="col-lg-3 col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-fw fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                       // $ree=mysql_query("select reg_id,adm_no,classid,previous_sem,new_sem,apv_status from stud_sem_registration where classid='$classid' and apv_status='Not Approved'");
                                       // $r1=mysql_num_rows($ree);
                                       //  echo $r1;
                                        ?>    
                                    </div>
                                    <div>Student search</div>
                                </div>
                            </div>
                        </div>
                        <a href="search_form.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
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