<?php

include("includes/header.php");
include("includes/sidenav.php");


?>

<style type="text/css">
table {
	
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
   /* border: 1px solid #ddd;*/
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
}

</style>

<div id="page-wrapper">

<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");



//..............................................................................

    $add_no=$_GET['id'];
    //$category=$_POST['category'];
    $sql = "SELECT A.*,C.*,D.admissionno AS pg_student,D.degree_course,D.degree_regno,D.degree_marks,D.degree_percent,E.admissionno AS ug_student,E.physics,E.chemistry,E.maths,E.total_marks,E.percentage FROM stud_details A LEFT JOIN parent_student B ON A.admissionno=B.admissionno LEFT JOIN parent C ON B.parentid=C.parentid LEFT JOIN pgstudent_qual D ON A.admissionno=D.admissionno LEFT JOIN ugstudent_qual E ON A.admissionno=E.admissionno WHERE A.admissionno='$add_no'";
	//echo $sql;
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
                                       
               echo "<table class='table-responsive'>";
			   
             
			 
            while($row = mysqli_fetch_array($result)){
				echo '<tr><td><img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="200" height="200" onerror="this.onerror=null;this.src=\'../vendor/images/default.png\';" /></td>';

echo '<td> <a style=" position: absolute; top: 10%; right: 3%; " class="btn btn-sm btn-info" href="search-form.php">BACK</a> </td>';
               
				echo '</tr> ';
				 // echo "<tr>";
				 		  
				 echo "<tr><th>ADMISSIONNO</th><td>{$row['admissionno']}</td></tr>";
				 echo "<tr><th>NAME</th><td>{$row['name']}</td></tr>";
				 echo "<tr><th>DOB</th><td>{$row['dob']}</td></tr>";
				 echo "<tr><th>GENDER</th><td>{$row['gender']}</td></tr>";
				 echo "<tr><th>RELIGION</th><td>{$row['religion']}</td></tr>";
				 echo "<tr><th>CASTE</th><td>{$row['caste']}</td></tr>";
				 echo "<tr><th>YEAR_OF_ADMISSION</th><td>{$row['year_of_admission']}</td></tr>";
				 echo "<tr><th>EMAIL</th><td>{$row['email']}</td></tr>";
				 echo "<tr><th>MOBILE_PHNO</th><td>{$row['mobile_phno']}</td></tr>";
				 echo "<tr><th>LAND_PHNO</th><td>{$row['land_phno']}</td></tr>";
				 echo "<tr><th>ADDRESS</th><td>{$row['address']}</td></tr>";
				 echo "<tr><th>ROLL_NO</th><td>{$row['rollno']}</td></tr>";
				 echo "<tr><th>RANK</th><td>{$row['rank']}</td></tr>";
				 echo "<tr><th>QUOTA</th><td>{$row['quota']}</td></tr>";
				 echo "<tr><th>SCHOOL_1</th><td>{$row['school_1']}</td></tr>";
				 echo "<tr><th>REGNO_2</th><td>{$row['regno_2']}</td></tr>";
				 echo "<tr><th>BOARD_2</th><td>{$row['board_2']}</td></tr>";
				 echo "<tr><th>PERCENTAGE_2</th><td>{$row['percentage_2']}</td></tr>";
				 echo "<tr><th>NO_CHANCE</th><td>{$row['no_chance1']}</td></tr>";
				 echo "<tr><th>COURSEID</th><td>{$row['courseid']}</td></tr>";
				 echo "<tr><th>BRANCH_OR_SPECIALISATION</th><td>{$row['branch_or_specialisation']}</td></tr>";
				 echo "<tr><th>GATE_SCORE</th><td>{$row['gate_score']}</td></tr>";
				 echo "<tr><th>ADMISSION_TYPE</th><td>{$row['admission_type']}</td></tr>";
				 echo "<tr><th>STATUS</th><td>{$row['status']}</td></tr>";
				 echo "<tr><th>BLOOD</th><td>{$row['blood']}</td></tr>";
                                 
                                 echo "<tr><th>GUARDIAN NAME</th><td>{$row['name_guard']}</td></tr>";
				 echo "<tr><th>GUARDIAN CONTACTNO</th><td>{$row['guard_contactno']}</td></tr>";
				 echo "<tr><th>RELATION</th><td>{$row['relation']}</td></tr>";
				 echo "<tr><th>OCCUPATION</th><td>{$row['occupation']}</td></tr>";
				 echo "<tr><th>GUARDIAN EMAIL</th><td>{$row['guard_email']}</td></tr>";
				 echo "<tr><th>INCOME</th><td>{$row['income']}</td></tr>";
                                 
                                 if($row['pg_student'] != NULL)
                                 {
                                     echo "<tr><th>DEGREE COURSE</th><td>{$row['degree_course']}</td></tr>";
				     echo "<tr><th>REGISTER NO</th><td>{$row['degree_regno']}</td></tr>";
				     echo "<tr><th>DEGREE MARKS</th><td>{$row['degree_marks']}</td></tr>";
				     echo "<tr><th>DEGREE PERCENTAGE_2</th><td>{$row['degree_percent']}</td></tr>";
                                 }
                                 elseif($row['ug_student'] != NULL)
                                 {
                                     echo "<tr><th>PHYSICS</th><td>{$row['physics']}</td></tr>";
				     echo "<tr><th>CHEMISTRY</th><td>{$row['chemistry']}</td></tr>";
				     echo "<tr><th>MATHS</th><td>{$row['maths']}</td></tr>";
				     echo "<tr><th>TOTAL MARKS</th><td>{$row['total_marks']}</td></tr>";
                                      echo "<tr><th>PERCENTAGE</th><td>{$row['percentage']}</td></tr>";
                                 }
                                 
                               
              
            }
			echo "</table>"; 
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }  
}
?>
</div>
<?php
include("includes/footer.php");

?>  
