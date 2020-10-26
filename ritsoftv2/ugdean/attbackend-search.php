<?php
include("../connection.mysqli.php");

//$link = mysqli_connect("localhost", "root", "", "ritsoft5");
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

//....................................................................
 
if(isset($_REQUEST['add_no'])){
    
    $add_no = mysqli_real_escape_string($con, $_REQUEST['add_no']);

    $sql = "SELECT * FROM stud_details WHERE (admissionno like '$add_no%' AND status like 'On Going' AND (courseid LIKE 'BTECH' OR courseid LIKE 'BARCH'))";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p class='add_no'>" . $row['admissionno'] . "</p>";
            }
           
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}


//...................................................................................

//....................................................................
 
if(isset($_REQUEST['name'])){
    
    $name = mysqli_real_escape_string($con, $_REQUEST['name']);
     $sql = "SELECT * FROM stud_details WHERE (name like '$name%' AND status like 'On Going' AND (courseid LIKE 'btech' OR courseid LIKE 'barch'))";
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
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}


//...................................................................................



 

mysqli_close($con);
?>