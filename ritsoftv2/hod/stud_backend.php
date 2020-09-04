<?php
session_start();
ob_start();
if(!isset($_SESSION['fid']))
{
    header('location:../login.php');
}
$fid=$_SESSION['fid'];
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

//....................................................................
 
if(isset($_REQUEST['add_no'])){
    
    $add_no = mysqli_real_escape_string($link, $_REQUEST['add_no']);
    
    $search_query=  explode("/", $add_no);
    
    if(isset($search_query['3']))
         $query="A.courseid LIKE '%".$search_query['0']."%' AND A.semid LIKE '%".$search_query['1']."%' AND A.branch_or_specialisation LIKE '%".$search_query['2']."%' AND A.deptname LIKE '%".$search_query['3']."%'";
    elseif(isset($search_query['2']))
         $query="A.courseid LIKE '%".$search_query['0']."%' AND A.semid LIKE '%".$search_query['1']."%' AND A.branch_or_specialisation LIKE '%".$search_query['2']."%'";
    elseif(isset($search_query['1']))
         $query="A.courseid LIKE '%".$search_query['0']."%' AND A.semid LIKE '%".$search_query['1']."%'";
    elseif(isset($search_query['0']))
         $query="A.courseid LIKE '%".$search_query['0']."%'";
    else
        $query="";
    
    
    
      $sql = "SELECT A.* FROM class_details A INNER JOIN department B ON A.deptname=B.deptname WHERE $query AND active like 'yes' AND B.hod='$fid'";
    
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                
                echo "<p class='add_no'>" . $row['courseid'] ."/".$row['semid'] ."/".$row['branch_or_specialisation'] ."/".$row['deptname'] ." ". "</p>";
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
    
    $name = mysqli_real_escape_string($link, $_REQUEST['name']);
    $sql = "SELECT * FROM stud_details WHERE name LIKE '" . $name . "%'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p class='name'>" . $row['name'] . "</p>";
            }
           
            mysqli_free_result($result);
        } else{
            //echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}


//...................................................................................



 

mysqli_close($link);
?>