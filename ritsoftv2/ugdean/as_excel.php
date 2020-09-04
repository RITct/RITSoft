<?php

if(isset($_POST['data']) && isset($_POST['name'])){

	$filename = "Subjectwise_Attendance_Percentage_" . date('Ymd') . ".xls";

	header("Content-type:application/octet-stream");
	header("Content-Disposition: attachment; filename='" . $_POST['name'] . '-' . $filename. "'"); 
	echo $_POST['data'];
} else {
	echo null;
}

?>