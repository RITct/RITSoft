<?php
include("includes/connection3.php");
//$con=mysqli_connect("localhost","root","","ritsoft");

$sum="";
$j=$_REQUEST["j"];

$k=$_REQUEST["k"];
$cls=$_REQUEST["cls"];
$date1=$_REQUEST["e"];

$date2=$_REQUEST["f"];
$d1=date('d-m-Y',strtotime($_REQUEST["e"]));
$d2=date('d-m-Y',strtotime($_REQUEST["f"]));
$html="";
$html.="<html>";
$html.="<table border='1' cellspacing='0' align=center cellspacing='0' width='100%'>";
$html.="	<tr><th>Date</th><th>Hour</th>";
$html.="<th>Admission NO</th>";
$html.="<th>Roll no</th>";
$html.="<th>Name</th>";




$html.="
						<th>Remark</th> ";
// $html.="	<th>Added on</th>";
 
$html.="</tr>";
while($j<=$k)
	{ 	//$res2=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and c.rollno='$j' order by c.rollno asc");

	$res2=mysqli_query($con3,"SELECT *,  DATE_FORMAT(date, '%D %M,%Y %r' ) AS date  FROM `duty_leave` d LEFT JOIN stud_details s ON s.admissionno = d.studid LEFT JOIN current_class c ON c.studid = d.studid  where c.classid='$cls'  and c.rollno='$j' order by c.rollno asc");


while($rs2=mysqli_fetch_array($res2))
{
	$i=1;
	$sid=$rs2["rollno"];
	$html.="<tr>";
								$html.="<td> ". $rs2["leave_date"]. "</td>";
								$html.="<td> ". $rs2["hour"]. "</td>";
	$html.="<td align=center>".$rs2["admissionno"]."</td>";

 
	$html.="<td align=center>".$rs2["rollno"]."</td>";
	$html.="<td >".strtoupper($rs2["name"])."</td>";
 
 
 
								$html.="<td>".  $rs2['remark']. " </td>";
								// $html.="<td>".  $rs2['date']. " </td>";


		$html.="</tr>"; 
	}
	$j++;
	
}
$html.="</table>";

$filename = "Staff_advisor_excel_" . date('Ymd') . ".xls";

header("Content-type:application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
//                                header("Content-Disposition:attachment;filename:download.xls");
echo $html;


?> 