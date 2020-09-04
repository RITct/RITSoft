<?php
//Connecting database 
$con = mysqli_connect("127.0.0.1", "ritsoftv2", "ritsoftv2", "ritsoftv2");
//if connection is falsed then show a error message....
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

//....................................................................
 
if(isset($_REQUEST['add_no'])){
    
	//used to escapes special characters in a string for SQL Statement......
	
    $add_no = mysqli_real_escape_string($con, $_REQUEST['add_no']); 	 //deleting special characters from admission no and assigning to a variable..
	
    $sql = "SELECT * FROM stud_details WHERE admissionno LIKE '" . $add_no . "%'";   	//selecting all possible results and showing...
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p class='add_no'>" . $row['admissionno'] . "</p>";
            }
           
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";							//if no matches found
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);  	//if connection fails......
    }
}


//...................................................................................

//....................................................................
 
if(isset($_REQUEST['name'])){
    
		//used to escapes special characters in a string for SQL statement......
		
    $name = mysqli_real_escape_string($con, $_REQUEST['name']); //deleting special characters from name and assigning to a variable..
    $sql = "SELECT * FROM stud_details WHERE name LIKE '" . $name . "%'";		//selecting all possible results and showing...
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p class='name'>" . $row['name'] . "</p>";
            }
           
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";				//if no matches found...
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);			//if connection failed
    }
}


//...................................................................................


//mysqli_close($link);
?>