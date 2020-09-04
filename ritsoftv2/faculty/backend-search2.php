<?php
session_start();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");



//..............................................................................
if(isset($_POST['add_no']))
{
    $add_no=$_POST['add_no'];
    $category=$_POST['category'];
    $fid=$_SESSION["fid"];
    $sql = "SELECT * FROM stud_details WHERE $category='$add_no' AND status like 'On Going' and admissionno in(select studid from current_class where classid in(select classid from subject_allocation where fid='$fid'))";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            
                
                
                echo "<div /*style='height: 300px; overflow-x:scroll;' */>
               <div class='table-responsive'>
  <table class='table'>
			<tr>
			<th>ADMISSIONNO</th>
			<th>NAME</th>
			<th>DOB</th>
			<th>YEAR_OF_ADMISSION</th>
			<th>EMAIL</th>
			<th>MOBILE_PHNO</th>
			<th>ADDRESS</th>
			<th>COURSEID</th>
			<th>BRANCH_OR_SPECIALISATION</th> 
			<th></th>
			</tr>"; 
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['admissionno'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";	
                echo "<td>" . $row['dob'] . "</td>";
				echo "<td>" . $row['year_of_admission'] . "</td>";	
				echo "<td>" . $row['email'] . "</td>";	
				echo "<td>" . $row['mobile_phno'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['courseid'] . "</td>";
				echo "<td>" . $row['branch_or_specialisation'] . "</td>";
				echo "<td> <a  href=details.php?id=".rawurlencode($row['admissionno']).">View </a></td>";
				echo "</tr>";
            }
			echo "</table></div>"; 
			
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }  
}
  
}

//........................................................................................................................





mysqli_close($link);
?>
