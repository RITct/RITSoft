<?php
/**
 * @Author: indran
 * @Date:   2018-08-08 15:30:05
 * @Last Modified by:   indran
 * @Last Modified time: 2018-08-09 07:04:20
 */
session_start();

//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/connection1.php");

$uname=$_SESSION['fid'];
if(strlen($_REQUEST['class'])>1 && strlen($_REQUEST["date"])>1)
{ 

	$a=explode(",",$_REQUEST['class']);
	$subr=explode("-",$_REQUEST['subject']);
	$date=$_REQUEST["date"];


	?>


	<select class="form-control " name="hour" onchange="showHour(this.value)" required="required" id="hour_to"  >
		<option selected="selected" disabled="disabled" value="-1">select</option>
		<?php

		// echo "SELECT DISTINCT( hour) FROM attendance where subjectid='".$subr[0]."'  and date='$date'  and classid='$a[0]'  ORDER BY hour";


		$res=mysqli_query($con,"SELECT DISTINCT( hour) AS hour FROM attendance where subjectid='".$subr[0]."' and  date='$date'  and classid='$a[0]'  ORDER BY hour");
		if($res)
			while($rs=mysqli_fetch_array($res)) {
				echo ' <option   value="'.$rs['hour'].'">'.$rs['hour'].'</option>';

			}
		}

		?>

	</select>

