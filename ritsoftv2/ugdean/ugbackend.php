<?php

$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2","ritsoftv2");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


//....................................................................

if(isset($_REQUEST['add_no'])){
    
    $add_no = mysqli_real_escape_string($link, $_REQUEST['add_no']);
    $category=$_REQUEST['category'];
    $sql = "SELECT distinct $category FROM stud_details WHERE ($category LIKE '" . $add_no . "%' AND status like 'On Going') AND (courseid LIKE 'btech' OR courseid LIKE 'barch')";
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