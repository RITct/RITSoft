<?php
include("includes/connection.php");
$id = $_GET['id']; 
$id2 = $_GET['id2']; 
$parent="parent";

if($id2==1)
{
	mysql_query("delete from login where username='$id'")or die(mysql_error());
	header("Location:student_details.php");  // bring back to original page 
}

$pass=rand(12345,10000000); 


if($id2==2)
{
	mysql_query("insert into login(username,password,usertype) values('".$id."','".$pass."','".$parent."' )")or die(mysql_error());
	header("Location:student_details.php");  // bring back to original page 
}

?>



