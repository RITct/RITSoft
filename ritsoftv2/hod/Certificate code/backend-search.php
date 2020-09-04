<?php
session_start();
$hodid=$_SESSION['fid']; 
include("includes/connection.php");

//$link = mysqli_connect("localhost", "root", "", "ritsoft");
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


//....................................................................

if(isset($_REQUEST['add_no'])){

    $add_no = mysqli_real_escape_string($con, $_REQUEST['add_no']);

    $sql = "SELECT stud_details.* FROM stud_details,current_class WHERE admissionno=studid and (admissionno LIKE '" . $add_no . "%' and status like 'On Going' and classid in(select classid from class_details where deptname in(select deptname from department where hod='$hodid')))";


    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p class='ad_no'>" . $row['admissionno'] . "</p>";
            }

           // mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}


//...................................................................................

//....................................................................

if(isset($_REQUEST['name'])){

    $name = mysqli_real_escape_string($con, $_REQUEST['name']);
    $sql = "SELECT stud_details.* FROM stud_details,current_class WHERE admissionno=studid and (name LIKE '" . $name . "%' and status like 'On Going' and classid in(select classid from class_details where deptname in(select deptname from department where hod='$hodid')))";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p class='name'>" . $row['name'] . "</p>";
            }

            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}


//...................................................................................


//mysqli_close($link);
?>
