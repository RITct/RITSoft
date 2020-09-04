<?php
session_start();
/**
 * @Author: indran
 * @Date:   2018-10-31 17:40:30
 * @Last Modified by:   indran
 * @Last Modified time: 2018-10-31 17:40:38
 */
include("includes/connection1.php"); 
//$con=mysqli_connect("localhost","root","","ritsoft");
$id=0;
$res=mysqli_query($con,"select * from class_details where courseid='".$_REQUEST['course']."' and deptname='".$_REQUEST['dept']."' and branch_or_specialisation='".$_REQUEST['spec']."'  ");
$rs=mysqli_fetch_array($res);
$id=$rs["classid"];


$courseida = $id;

$c=mysqli_query($con," SELECT * FROM `course_academic`WHERE year_id IN ( SELECT year_id FROM academic_year WHERE status = 1 ORDER BY year_id DESC ) AND course_id IN ( SELECT  courseid FROM class_details WHERE classid =  '$courseida')");
if($c){
	while($re=mysqli_fetch_array($c)) {  
		// echo '<input type="date" name="date" id="sedate" class="form-control"  sdate="'.$re['start_date'].'" edate ="'.$re['start_date'].'" placehodler="dd/mm/yyyy" value="'. date("Y-m-d").'" /> ';
		$nowDate = date("Y-m-d");
		$endDate = $re['end_date'];
		if(strtotime($nowDate) > strtotime($endDate))
			$nowDate = $endDate;


		echo '<div class="input-group date" data-provide="datepicker"   data-date-start-date="'.$re['start_date'].'" data-date-end-date ="'.$nowDate.'" >'.
		' <input type="text" class="form-control mydate datepicker-autoclose"  value="'. $nowDate.'"  id="date"   name="date" placeholder="Date " required >'.
		'<div class="input-group-addon">'.
		'<span class="fa fa-calendar"></span>'.
		'</div>'.
		'</div>';
	}
}

?>

