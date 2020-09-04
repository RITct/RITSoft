<?php
session_start();
if(isset($_SESSION['utype']))
{

} 
else
{
	echo "<script>alert('Session Expired!!! Please login')</script>";
 echo "<script>window.location.href='../index.php'</script>";
}

include("includes/connection.php");
$fid='KTU01';
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
    <link rel="icon" type="image/png" href="../../images/logob.png" />

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
                <a class="navbar-brand" href="../../index.php"><img  src="../images/logob.png" alt="RIT" style="width:30px" id='Logo'></a></div><div class="navbar-header" style="padding-top: 20px"><h7 style="color :#007bff ; font-family: 'Berkshire Swash', cursive; font-size: 14px;" ><span style="color :black;">RIT</span>Soft <span style="color :red;">v2</span></h7></div>
                
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                 
                    <!-- /.dropdown -->
 <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="changepd.php"><i class="fa fa-key fa-fw"></i> Change Password</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                                       <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                