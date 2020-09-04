<?php
# @Date:   2019-10-27T00:10:32-07:00
# @Last modified time: 2019-10-27T01:03:29-07:00



include("header.php");

include("sidenav.php");
//$fid=$_SESSION["fid"]; //faculty id from session



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




            </span></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-8">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-table fa-fw fa-2x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php
                          //              $ree=mysql_query("select reg_id,adm_no,classid,previous_sem,new_sem,apv_status from stud_sem_registration where classid='$classid' and apv_status='Not Approved'");
                            //            $r1=mysql_num_rows($ree);
                              //           echo $r1;
                                ?>
                            </div>
                            <div>CO VIEW</div>
                        </div>
                    </div>
                </div>
                <a href=" course_outcome.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-lg-3 col-md-8">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-edit fa-fw fa-2x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                            </div>
                            <div>CO PO Correlation View</div>
                        </div>
                    </div>
                </div>
                <a href="co_po_correlation.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

      
<?php


function statusShow($variable, $status ) {

    $statusa = "success";
    $altertTest = "";

    switch (trim($variable)) {
        case 'Rejected':
        $statusa = "danger";
        break;
        case 'Not Verified':
        $statusa = "warning";
        break;
        case 'Verified':
        $statusa = "success";
        return $altertTest ;
        break;

        default:
            # code...
        break;
    }

    $altertTest = $altertTest . '<div class="alert alert-' . $statusa . '">';
    $altertTest = $altertTest . '         <div class="panel-body">';
    $altertTest = $altertTest . '            <div class="col-md-2 text-right">';
    $altertTest = $altertTest . '';
    $altertTest = $altertTest . '                <strong>Image Status :</strong> ';
    $altertTest = $altertTest . '            </div>';
    $altertTest = $altertTest . '           <div class="col-md-8">';
    $altertTest = $altertTest . '';
    $altertTest = $altertTest . '              <p> ' .  $status . ' </p>';
    $altertTest = $altertTest . '          </div>';


    $altertTest = $altertTest . '           <div class="col-md-2">';
    $altertTest = $altertTest . '';
    $altertTest = $altertTest . '      <a href="details.php" class="btn btn-' . $statusa . '">VIEW PROFILE</a>         ';
    $altertTest = $altertTest . '          </div>';


    $altertTest = $altertTest . '      </div>';
    $altertTest = $altertTest . '  </div>';

    return $altertTest ;
}
?>



<?php

include("footer.php");
?>
