<?php
//session_start();
function getstuddata()
{
include("includes/connection.php");
$admissionno=$_SESSION["admissionno"];
$result=mysql_query("select s.*,l.* from stud_details s,login l where s.admissionno = '$admissionno' and s.admissionno=l.username and l.usertype='student'");

     while($dat1=mysql_fetch_array($result)){
		$emailid=$dat1["email"];
		$username=$dat1["admissionno"];
		$class=$dat1["courseid"];
		$phoneno=$dat1["mobile_phno"];
		$doj=$dat1["year_of_admission"];

		$dob=$dat1["dob"];
                                
		$password=$dat1["password"];
		
		
	}
$data = array("email" => $emailid, "username" => $username, "classname" => $class,"dob" => $dob, "phone" => $phoneno, "doj" => $doj,"password" => $password); 
return $data;
	
/* {"email":"test@gmail.com","username":"test","classname":"BTECH","dob":"2019-6-5","phone":"9087654321","doj":"2019-6-5","password":"test123"} */

}

	?>
	
	
	
