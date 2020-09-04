<?php
include("includes/connection.php");
$adm_id = $_GET['id']; 
$sub_id=$_GET['sid'];


?>


<script>

	sid = '<?php echo $sub_id ;?>';

</script>
<?php
$sql2="delete from elective_student where stud_id='$adm_id' AND sub_code='$sub_id';";
if(mysql_query($sql2) == TRUE) { 
	echo '<script type="text/javascript"> alert("Deleted Successfully");
	location.replace("electiveview.php?id="+sid);
	</script> ';  
}

else {	
	echo '<script type="text/javascript"> alert("Deleted Successfully");
	location.replace("electiveview.php?id="+sid);
	</script> ';  
}
?>
