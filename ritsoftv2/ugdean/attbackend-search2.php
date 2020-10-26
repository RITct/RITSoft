<?php
session_start();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include("../connection.mysqli.php");
//$link = mysqli_connect("localhost", "root", "", "rit");

//..............................................................................
if(isset($_POST['add_no']))
{
    $add_no=$_POST['add_no'];
	 $_SESSION['adm']=$add_no;
   $sql = "SELECT * FROM stud_details WHERE (admissionno='$add_no' AND status like 'On Going' AND (courseid LIKE 'btech' OR courseid LIKE 'barch'))";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
     
                echo "<div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th style='text-align:center;'>ADMISSION NO</th>
			<th style='text-align:center'>NAME</th>
			<th style='text-align:center'>DOB</th>
			<th style='text-align:center'>COURSEID</th>
			<th style='text-align:center'>BRANCH_OR_SPECIALISATION</th>
    </tr>"; 
            while($row = mysqli_fetch_array($result)){
                echo "<tr align='centre'>";
                echo "<td align='centre'>" . $row['admissionno'] . "</td>";
				echo "<td align='centre'>" . $row['name'] . "</td>";	
				echo "<td align='centre'>" . $row['dob'] . "</td>";	
                echo "<td align='centre'>" . $row['courseid'] . "</td>";
				echo "<td align='centre'>" . $row['branch_or_specialisation'] . "</td>";
				echo "</tr>";
				$name=$row['name'];
            }
			echo "</table>"; 
			echo "</div>";
				$_SESSION['n']=$name;
			echo "<form method='post' action='att_search_stud.php'>";
            echo " <input type='submit' class='btn btn-primary' name='btn' id='btn' value='VIEW' />";
			echo "</form>";
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }  
}
  
}

//........................................................................................................................



//.........................................................................................................................

if(isset($_POST['name']))
{
     $name=$_POST['name'];
  
    $sql = "SELECT * FROM stud_details WHERE (name='$name' AND status like 'On Going' AND (courseid LIKE 'btech' OR courseid LIKE 'barch'))";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            
      
                echo "<div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th style='text-align:center;'>ADMISSION NO</th>
			<th style='text-align:center'>NAME</th>
			<th style='text-align:center'>DOB</th>
			<th style='text-align:center'>COURSEID</th>
			<th style='text-align:center'>BRANCH_OR_SPECIALISATION</th>
    </tr>"; 
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['admissionno'] . "</td>";
				$_SESSION['adm']=$row['admissionno'];
				echo "<td>" . $row['name'] . "</td>";	
                echo "<td>" . $row['dob'] . "</td>";
				echo "<td>" . $row['courseid'] . "</td>";
				echo "<td>" . $row['branch_or_specialisation'] . "</td>";
				echo '<td><a href="att_search_stud.php?id='.$_SESSION['adm'].'">VIEW</a></td>';
				echo "</tr>";
            }
			echo "</table>"; 
			echo "</div>";
			
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }  
}
  
}
//................................................................................

//mysqli_close($link);
?>