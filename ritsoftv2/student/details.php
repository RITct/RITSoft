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
$link = mysqli_connect("127.0.0.1", "ritsoftv2", "ritsoftv2", "ritsoftv2");



//..............................................................................

$add_no=$_SESSION['admissionno'];
    //$category=$_POST['category'];
$sql = "SELECT A.*,C.*,D.admissionno AS pg_student,D.degree_course,D.degree_regno,D.degree_marks,D.degree_percent,E.admissionno AS ug_student,E.physics,E.chemistry,E.maths,E.total_marks,E.percentage FROM stud_details A LEFT JOIN parent_student B ON A.admissionno=B.admissionno LEFT JOIN parent C ON B.parentid=C.parentid LEFT JOIN pgstudent_qual D ON A.admissionno=D.admissionno LEFT JOIN ugstudent_qual E ON A.admissionno=E.admissionno WHERE A.admissionno='$add_no'";
	//echo $sql;
if($result = mysqli_query($link, $sql)){
	if(mysqli_num_rows($result) > 0){

		echo "<table class='table-responsive'>";



		while($row = mysqli_fetch_array($result)){
			echo showStudDetails ( $row );
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
