<?php
session_start();
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

//....................................................................
 
if(isset($_REQUEST['add_no'])){
    
    $add_no = mysqli_real_escape_string($link, $_REQUEST['add_no']);
    $fid=$_SESSION["fid"];
    $category=$_REQUEST['category'];
    $sql = "SELECT * FROM stud_details WHERE $category LIKE '" . $add_no . "%' AND status like 'On Going' and admissionno in(select studid from current_class where classid in(select classid from subject_allocation where fid='$fid'))";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                
                echo "<p class='add_no'>" . $row[$category] . "</p>";
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

//..............................................................................



 

mysqli_close($link);
?>
