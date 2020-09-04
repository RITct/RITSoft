<?php
# @Date:   2019-10-27T00:10:32-07:00
# @Last modified time: 2019-10-27T01:30:41-07:00



session_start();
/*if(isset($_SESSION['admissionno']))
{

}
else
{
	echo "<script>alert('Session Expired!!! Please login')</script>";
 echo "<script>window.location.href='../index.php'</script>";
}*/

include("connection.php");
//$admissionno=$_SESSION['admissionno'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RIT Soft v2</title>
    <link rel="icon" type="image/png" href="../images/logob.png" />

    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../dash/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../dash/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dash/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../dash/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../dash/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; ">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dash_home.php"><img  src="../images/logob.png" alt="RIT" style="width:30px" id='Logo'></a></div><div class="navbar-header" style="padding-top: 20px"><h7 style="color :#007bff ; font-family: 'Berkshire Swash', cursive; font-size: 14px;" ><span style="color :black;">RIT</span>Soft <span style="color :red;">v2</span></h7></div>

                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->
                              <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php
                           /* $l=mysql_query("select * from notification where rec_id='$admissionno' and status=1 order by nid desc limit 5") or die(mysql_error());
                            while($r=mysql_fetch_assoc($l))
                            { */
                        ?>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i><?php // echo $r["data"] ?>
                                    <br>
                                    <span class="pull-right text-muted small">
                                        <?php // echo $r["date"]; ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php
                    // }?>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>



                   <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-key fa-fw"></i> Change Password</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href='http://localhost:8080/myproject/login.php'><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>

                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->





                <?php

                function showStudDetails ( $row828105 ) {
                    $returnHtml = "";
                    $returnHtml = $returnHtml .   '<tr>';
                    if ( ( trim($row828105['image_status'] ) == "Verified")) {

                        $returnHtml = $returnHtml .   '<td><img src="data:image/jpeg;base64,'.base64_encode( $row828105['image'] ).'" width="200" height="200" onerror="this.onerror=null;this.src=\'../vendor/images/default.png\';" /></td>  ';
                    } else
                    $returnHtml = $returnHtml .   '<td><img src="../vendor/images/default.png" width="200" height="200"  title="Not yet Verified !" /></td>  ';

                    $returnHtml = $returnHtml .  '<td> <a style=" position: absolute; top: 10%; right: 3%; " class="btn btn-sm btn-info" href="dash_home.php">BACK</a> </td>';

                    $returnHtml = $returnHtml .  '</tr> ';
                    $returnHtml = $returnHtml .  "<tr><th>ADMISSIONNO</th><td>{$row828105['admissionno']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>NAME</th><td>{$row828105['name']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>DOB</th><td>{$row828105['dob']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>GENDER</th><td>{$row828105['gender']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>RELIGION</th><td>{$row828105['religion']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>CASTE</th><td>{$row828105['caste']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>YEAR_OF_ADMISSION</th><td>{$row828105['year_of_admission']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>EMAIL</th><td>{$row828105['email']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>MOBILE_PHNO</th><td>{$row828105['mobile_phno']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>LAND_PHNO</th><td>{$row828105['land_phno']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>ADDRESS</th><td>{$row828105['address']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>ROLL_NO</th><td>{$row828105['rollno']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>RANK</th><td>{$row828105['rank']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>QUOTA</th><td>{$row828105['quota']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>SCHOOL_1</th><td>{$row828105['school_1']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>REGNO_2</th><td>{$row828105['regno_2']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>BOARD_2</th><td>{$row828105['board_2']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>PERCENTAGE_2</th><td>{$row828105['percentage_2']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>NO_CHANCE</th><td>{$row828105['no_chance1']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>COURSEID</th><td>{$row828105['courseid']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>BRANCH_OR_SPECIALISATION</th><td>{$row828105['branch_or_specialisation']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>GATE_SCORE</th><td>{$row828105['gate_score']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>ADMISSION_TYPE</th><td>{$row828105['admission_type']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>STATUS</th><td>{$row828105['status']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>BLOOD</th><td>{$row828105['blood']}</td></tr>";

                    $returnHtml = $returnHtml .  "<tr><th>GUARDIAN NAME</th><td>{$row828105['name_guard']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>GUARDIAN CONTACTNO</th><td>{$row828105['guard_contactno']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>RELATION</th><td>{$row828105['relation']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>OCCUPATION</th><td>{$row828105['occupation']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>GUARDIAN EMAIL</th><td>{$row828105['guard_email']}</td></tr>";
                    $returnHtml = $returnHtml .  "<tr><th>INCOME</th><td>{$row828105['income']}</td></tr>";

                    if($row828105['pg_student'] != NULL)
                    {
                        $returnHtml = $returnHtml .  "<tr><th>DEGREE COURSE</th><td>{$row828105['degree_course']}</td></tr>";
                        $returnHtml = $returnHtml .  "<tr><th>REGISTER NO</th><td>{$row828105['degree_regno']}</td></tr>";
                        $returnHtml = $returnHtml .  "<tr><th>DEGREE MARKS</th><td>{$row828105['degree_marks']}</td></tr>";
                        $returnHtml = $returnHtml .  "<tr><th>DEGREE PERCENTAGE_2</th><td>{$row828105['degree_percent']}</td></tr>";
                    }
                    elseif($row828105['ug_student'] != NULL)
                    {
                        $returnHtml = $returnHtml .  "<tr><th>PHYSICS</th><td>{$row828105['physics']}</td></tr>";
                        $returnHtml = $returnHtml .  "<tr><th>CHEMISTRY</th><td>{$row828105['chemistry']}</td></tr>";
                        $returnHtml = $returnHtml .  "<tr><th>MATHS</th><td>{$row828105['maths']}</td></tr>";
                        $returnHtml = $returnHtml .  "<tr><th>TOTAL MARKS</th><td>{$row828105['total_marks']}</td></tr>";
                        $returnHtml = $returnHtml .  "<tr><th>PERCENTAGE</th><td>{$row828105['percentage']}</td></tr>";
                    }

                    return $returnHtml;
                }
                ?>
