<?php
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"]; //parent id from session
$_SESSION["admissionno"]=$_GET['id'];
?>
      
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;">
                        <?php
                        $query="select name from stud_details where admissionno='".$_SESSION["admissionno"]."'";
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res))
                        {                                                        
                            echo $row["name"]; 
                        }
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
                                        
                                        ?>    
                                    </div>
                                    <div>Consolidated attendance</div>
                                </div>
                            </div>
                        </div>
                        <a href="consolidated.php">
                            <div class="panel-footer">
                                <span class="pull-left">View details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                 <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-fw fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        
                                        ?>    
                                    </div>
                                    <div>Monthly attendance</div>
                                </div>
                            </div>
                        </div>
                        <a href="monthly.php">
                            <div class="panel-footer">
                                <span class="pull-left">View details</span>
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
                                      <?php 
                                      
            ?>

                                    </div>
                                    <div>Sessional Marks</div>
                                </div>
                            </div>
                        </div>
                        <a href="mark.php">
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
                                   
                                        ?> 

                                    </div>
                                    <div>Contact</div>
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
                                        $q="select id_com,stud_id,name from complaint c,stud_details s where c.status=1 and s.admissionno=c.stud_id and c.stud_id='".$_SESSION["admissionno"]."'";
                                        $r1=mysqli_query($conn,$q);
										$count=mysqli_num_rows($r1);
                                        echo $count;
                                        ?>    
                                    </div>
                                    <div>Grievances</div>
                                </div>
                            </div>
                        </div>
                        <a href="grievances.php">
                            <div class="panel-footer">
                                <span class="pull-left">View details</span>
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