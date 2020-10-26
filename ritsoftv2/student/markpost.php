
                        
<?php
include("../connection.php");
	
	
if(isset($_POST["markpost"]))
{
	$registerno=$_POST["registerno"];
	$key=$_POST["semester"];
	$l=mysql_query("SELECT class_details.semid from  class_details where class_details.classid='$key'");
	$r=mysql_fetch_assoc($l);
	$sem=$r["semid"];
	$l=mysql_query("SELECT  subject_class.subjectid,subject_class.subject_title FROM subject_class WHERE subject_class.classid = '$key'") or die(mysql_error());

	while($r=mysql_fetch_assoc($l))
	{
		$s=$r["subjectid"];
		$mark=$_POST[$s];
		//........Query for insert semester,registerno,subject_code and mark into university_mark table........
		mysql_query("INSERT INTO `university_mark`(`semester`, `registerno`, `subject_code`, `mark`) VALUES('$semid','$registerno','$s','$mark','')");
	}
	
	

echo "<script>alert('Marks entered')</script>";
//

}
?>
