<?php
//Connecting database 
$con = mysqli_connect("127.0.0.1", "ritsoftv2", "ritsoftv2", "ritsoftv2");

//..............................................................................
if(isset($_POST['add_no']))
{
    $add_no=$_POST['add_no']; 						 //if admission number is entered in the search box then posting add_no....
    $sql = "SELECT * FROM stud_details WHERE admissionno='$add_no'";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
		
      /*Each results is taken and viewed in a table format based on the admission number......*/
	  
                echo "<div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th style='text-align:center;'>ADMISSION NO</th>
			<th style='text-align:center'>NAME</th>
			<th style='text-align:center'>DOB</th>
			<th style='text-align:center'>GENDER</th>
			<th style='text-align:center'>RELIGION</th>
			<th style='text-align:center'>CASTE</th>
			<th style='text-align:center'>YEAR_OF_ADMISSION</th>
			<th style='text-align:center'>EMAIL</th>
			<th style='text-align:center'>MOBILE_PHNO</th>
			<th style='text-align:center'>LAND_PHNO</th>
			<th style='text-align:center'>ADDRESS</th>
			<th style='text-align:center'>ROLLNO</th>
			<th style='text-align:center'>RANK</th>
            <th style='text-align:center'>QUOTA</th>
			<th style='text-align:center'>SCHOOL_1</th>
			<th style='text-align:center'>REGNO_1</th>
			<th style='text-align:center'>BOARD_1</th>
			<th style='text-align:center'>PERCENTAGE_1</th>
			<th style='text-align:center'>SCHOOL_2</th>
			<th style='text-align:center'>REGNO_2</th>
			<th style='text-align:center'>BOARD_2</th>
			<th style='text-align:center'>PERCENTAGE_2</th>
			<th style='text-align:center'>NO_CHANCE1</th>
			<th style='text-align:center'>COURSEID</th>
			<th style='text-align:center'>BRANCH_OR_SPECIALISATION</th>
    </tr>"; 
	
	/*Fetching Datas and showing in the corresponding feilds in a table format.........*/
	
            while($row = mysqli_fetch_array($result)){
                echo "<tr align='centre'>";
                echo "<td align='centre'>" . $row['admissionno'] . "</td>";
				echo "<td align='centre'>" . $row['name'] . "</td>";	
                echo "<td align='centre'>" . $row['dob'] . "</td>";
				echo "<td align='centre'>" . $row['gender'] . "</td>";
				echo "<td align='centre'>" . $row['religion'] . "</td>";	
				echo "<td align='centre'>" . $row['caste'] . "</td>";	
				echo "<td align='centre'>" . $row['year_of_admission'] . "</td>";	
				echo "<td align='centre'>" . $row['email'] . "</td>";	
				echo "<td align='centre'>" . $row['mobile_phno'] . "</td>";
				echo "<td align='centre'>" . $row['land_phno'] . "</td>";
				echo "<td align='centre'>" . $row['address'] . "</td>";
				echo "<td align='centre'>" . $row['rollno'] . "</td>";
				echo "<td align='centre'>" . $row['rank'] . "</td>";
				echo "<td align='centre'>" . $row['quota'] . "</td>";
				echo "<td align='centre'>" . $row['school_1'] . "</td>";
				echo "<td align='centre'>" . $row['regno_1'] . "</td>";
				echo "<td align='centre'>" . $row['board_1'] . "</td>";
				echo "<td align='centre'>" . $row['percentage_1'] . "</td>";
				echo "<td align='centre'>" . $row['school_2'] . "</td>";
				echo "<td align='centre'>" . $row['regno_2'] . "</td>";
				echo "<td align='centre'>" . $row['board_2'] . "</td>";
				echo "<td align='centre'>" . $row['percentage_2'] . "</td>";
				echo "<td align='centre'>" . $row['no_chance1'] . "</td>";
				echo "<td align='centre'>" . $row['courseid'] . "</td>";
				echo "<td align='centre'>" . $row['branch_or_specialisation'] . "</td>";
				echo "</tr>";
            }
			echo "</table>"; 
			echo "</div>"; 
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";				//if no matches found.....
        }  
}
  
}

//........................................................................................................................



//.........................................................................................................................

if(isset($_POST['name']))
{
     $name=$_POST['name'];									//if name is entered in the search box then posting name....
  
    $sql = "SELECT * FROM stud_details WHERE name='$name'";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            
       /*Each results is taken and viewed in a table format based on the name......*/
	   
                echo "<div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th style='text-align:center;'>ADMISSION NO</th>
			<th style='text-align:center'>NAME</th>
			<th style='text-align:center'>DOB</th>
			<th style='text-align:center'>GENDER</th>
			<th style='text-align:center'>RELIGION</th>
			<th style='text-align:center'>CASTE</th>
			<th style='text-align:center'>YEAR_OF_ADMISSION</th>
			<th style='text-align:center'>EMAIL</th>
			<th style='text-align:center'>MOBILE_PHNO</th>
			<th style='text-align:center'>LAND_PHNO</th>
			<th style='text-align:center'>ADDRESS</th>
			<th style='text-align:center'>ROLLNO</th>
			<th style='text-align:center'>RANK</th>
            <th style='text-align:center'>QUOTA</th>
			<th style='text-align:center'>SCHOOL_1</th>
			<th style='text-align:center'>REGNO_1</th>
			<th style='text-align:center'>BOARD_1</th>
			<th style='text-align:center'>PERCENTAGE_1</th>
			<th style='text-align:center'>SCHOOL_2</th>
			<th style='text-align:center'>REGNO_2</th>
			<th style='text-align:center'>BOARD_2</th>
			<th style='text-align:center'>PERCENTAGE_2</th>
			<th style='text-align:center'>NO_CHANCE1</th>
			<th style='text-align:center'>COURSEID</th>
			<th style='text-align:center'>BRANCH_OR_SPECIALISATION</th>
    </tr>"; 
	/*Fetching Datas and showing in the corresponding feilds in a table format.........*/
	
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
				echo "<td>" . $row['rollno'] . "</td>";
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
				echo "<td>" . $row['no_chance1'] . "</td>";
				echo "<td>" . $row['courseid'] . "</td>";
				echo "<td>" . $row['branch_or_specialisation'] . "</td>";
				echo "</tr>";
            }
			echo "</table>"; 
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";								//if no matches found.....
        }  
}
  
}
//................................................................................

//mysqli_close($link);
?>