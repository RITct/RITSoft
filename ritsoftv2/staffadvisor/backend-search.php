<?php
session_start();
$classid=$_SESSION["classid"];
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


//....................................................................

if(isset($_REQUEST['add_no'])){
//$classid=$_SESSION["classid"];
    $c=0;
    $add_no = mysqli_real_escape_string($link, $_REQUEST['add_no']);
    $category=$_REQUEST['category'];
    $fid=$_SESSION["fid"];
    $l=mysqli_query($link,"select students_list,classid from staff_advisor where fid='$fid' and classid='$classid'");
    if(mysqli_num_rows($l)>0)
    {
        while ($r=mysqli_fetch_array($l)) {
            $a=$r["classid"];
            $b=explode('-', $r["students_list"]);

            for ($i=$b[0]; $i<=$b[1] ; $i++) { 
                $sql = "SELECT * FROM stud_details WHERE $category LIKE '" . $add_no . "%' AND status like 'On Going' and admissionno in(select studid from current_class where classid='$a' and rollno='$i' order by rollno)";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){



                            echo "<p class='add_no' adm_no ='".$row['admissionno']."' >" . $row[$category] . "</p>";
                            $c++;    


                        }

                        mysqli_free_result($result);
                    } 
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
            }
        }
    }
    if ($c==0) {
        echo "<p>No matches found</p>";
    }
}

//...................................................................................

//..............................................................................





mysqli_close($link);
?>
