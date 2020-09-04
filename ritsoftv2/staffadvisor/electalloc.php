<?php
include("includes/connection.php");
$subjectid = "";

if (isset($_POST['bulk_studnets'])) {



if (isset($_POST['student']) && isset($_POST['subjectid'])) {
$students = $_POST['student'];
$subjectid = $_POST['subjectid'];
	if (is_array( $students  )) { 
		foreach ($students  as $key => $value) {
	 
			if($value == 'on') {

			  	$adm_id = $key; 
		  		$sub_id=$subjectid; 	
		  		//echo "SELECT * FROM elective_student WHERE sub_code ='$sub_id' AND stud_id = '$adm_id' ";
				$result = mysql_query(" SELECT * FROM elective_student WHERE sub_code ='$sub_id' AND stud_id = '$adm_id' ");

				if(mysql_num_rows($result)) { 
					$exi = 1;
				} else {
				mysql_query("INSERT INTO elective_student VALUES('$sub_id','$adm_id')")or die(mysql_error());

				}

			 
			}
		}
	 

	}

} 



	header("Location:elective.php?id=".$subjectid);  // bring back to original page 

} else {


$adm_id = $_GET['id']; 
$sub_id=$_GET['sid'];

$result = mysql_query(" SELECT * FROM elective_student WHERE sub_code ='$sub_id' AND stud_id = '$adm_id' ");

if(mysql_num_rows($result)) { 
	$exi = 1;
} else {
mysql_query("INSERT INTO elective_student VALUES('$sub_id','$adm_id')")or die(mysql_error()); 

}

	header("Location:elective.php?id=".$sub_id);  // bring back to original page 
}


	?>
	