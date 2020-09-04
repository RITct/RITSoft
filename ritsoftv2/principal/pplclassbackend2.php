<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");



//..............................................................................
if(isset($_POST['add_no']))
{
	$add_no=$_POST['add_no'];
	
	$search_query=  explode("/", $add_no);
	
    //print_r($search_query);
	
	
	$sql = "SELECT * FROM stud_details A LEFT JOIN current_class B ON A.admissionno=B.studid LEFT JOIN class_details C ON B.classid=C.classid WHERE C.courseid='$search_query[0]' AND C.semid='$search_query[1]' AND C.deptname='$search_query[3]' AND C.branch_or_specialisation='$search_query[2]' ORDER BY B.rollno";
	
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			
			
			
			echo " <div style='height: 300px; overflow-x:scroll;'><table>
			
			<tr>
			<th>rollno</th>
			<th>ADMISSIONNO</th>
			<th>NAME</th>
			<th>DOB</th>
			<th>YEAR_OF_ADMISSION</th>
			<th>EMAIL</th>
			<th>MOBILE_PHNO</th>
			<th>ADDRESS</th>
			<th>COURSEID</th>
			<th>BRANCH_OR_SPECIALISATION</th> 
			</tr>"; 
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" . $row['rollno'] . "</td>";
				echo "<td>" . $row['admissionno'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";	
				echo "<td>" . $row['dob'] . "</td>";
				echo "<td>" . $row['year_of_admission'] . "</td>";	
				echo "<td>" . $row['email'] . "</td>";	
				echo "<td>" . $row['mobile_phno'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['courseid'] . "</td>";
				echo "<td>" . $row['branch_or_specialisation'] . "</td>";
				echo "<td> <a target='_blank' href=pplclassdetails.php?id=".rawurlencode($row['admissionno']).">View </a></td>";
				echo "</tr>";
			}
			echo "</table></div><input type='submit' name='excel' value='Download Excel' style=' height: 32px' id='excel_btn'>"; 
			
			
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
	
	$sql = "SELECT * FROM stud_details WHERE name='$name'";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			
			
			
			echo "<table>
			
			<tr>
			<th>ADMISSIONNO</th>
			<th>NAME</th>
			<th>DOB</th>
			<th>GENDER</th>
			<th>RELIGION</th>
			<th>CASTE</th>
			<th>YEAR_OF_ADMISSION</th>
			<th>EMAIL</th>
			<th>MOBILE_PHNO</th>
			<th>LAND_PHNO</th>
			<th>ADDRESS</th>
			
			
			<th>RANK</th>
			<th>QUOTA</th>
			<th>SCHOOL_1</th>
			<th>REGNO_1</th>
			<th>BOARD_1</th>
			<th>PERCENTAGE_1</th>
			<th>SCHOOL_2</th>
			<th>REGNO_2</th>
			<th>BOARD_2</th>
			<th>PERCENTAGE_2</th>
			
			<th>COURSEID</th>
			<th>BRANCH_OR_SPECIALISATION</th> 
			</tr>"; 
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" . $row['admissionno'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";	
				echo "<td>" . $row['dob'] . "</td>";
				echo "<td>" . $row['gender'] . "</td>";
				echo "<td>" . $row['religion'] . "</td>";	
				echo "<td>" . $row['caste'] . "</td>";	
				echo "<td>" . $row['year_of_admission'] . "</td>";	
				echo "<td>" . $row['email'] . "</td>";	
				echo "<td>" . $row['mobile_phno'] . "</td>";
				echo "<td>" . $row['land_phno'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				
				echo "<td>" . $row['rank'] . "</td>";
				echo "<td>" . $row['quota'] . "</td>";
				echo "<td>" . $row['school_1'] . "</td>";
				echo "<td>" . $row['regno_1'] . "</td>";
				echo "<td>" . $row['board_1'] . "</td>";
				echo "<td>" . $row['percentage_1'] . "</td>";
				echo "<td>" . $row['school_2'] . "</td>";
				echo "<td>" . $row['regno_2'] . "</td>";
				echo "<td>" . $row['board_2'] . "</td>";
				echo "<td>" . $row['percentage_2'] . "</td>";
				
				echo "<td>" . $row['courseid'] . "</td>";
				echo "<td>" . $row['branch_or_specialisation'] . "</td>";
				echo "</tr>";
			}
			echo "</table>"; 
			
            // Close result set
			mysqli_free_result($result);
		} else{
			echo "<p>No matches found</p>";
		}  
	}
	
}
//................................................................................

mysqli_close($link);
?>