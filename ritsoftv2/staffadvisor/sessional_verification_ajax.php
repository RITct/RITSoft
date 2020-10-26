<?php
/**
 * @Author: indran
 * @Date:   2018-11-15 10:15:55
 * @Last Modified by:   indran
 * @Last Modified time: 2018-11-15 10:44:49
 */
session_start();
include("../connection.php");

$classid=$_SESSION["classid"];


if (isset($_POST['data'])) {


	$data = json_decode($_POST['data'], true);

	foreach ($data as $key => $value) {
		$studid = $value['studid'];
		$id = $value['id'];
		$status = $value['status'];
		$selected_subject = $value['selected_subject'];




		$query =" UPDATE sessional_marks SET verification_status = $status  WHERE subjectid ='$selected_subject'  AND studid = '$studid' AND classid = '$classid' "; 
		$es=mysql_query($query) ;  


	}
	echo "1"; 
}