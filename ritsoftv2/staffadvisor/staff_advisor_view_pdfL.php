<?php
include("../connection.mysqli.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$sum="";
$j=$_REQUEST["j"];

$k=$_REQUEST["k"];
$cls=$_REQUEST["cls"];
$date1=$_REQUEST["e"];
$date2=$_REQUEST["f"];
$d1=date('d-m-Y',strtotime($_REQUEST["e"]));
$d2=date('d-m-Y',strtotime($_REQUEST["f"]));
$bs=$_REQUEST["bs"];
$dept=strtolower($_REQUEST["dept"]);
$bs1=strtolower($bs);
$semester=$_REQUEST["d"];
$cid=$_REQUEST["cid"];

$html="";
$html.="<html>";
$html.="<head>";
$html.="<h2 style=margin-bottom:0><center>Rajiv Gandhi Institute Of Technology</center></h2>";
if($cid=='MCA'|| $cid =='BARCH')
{
	
	$html.='<h2 style=margin-top:0 ><center>'.$semester.' '.$cid.' duty leave </center></h2>';
}
else
{
	
	$html.='<h2 style=margin-top:0 ><center>'.$cls2.' '.$cid.' '.ucwords($bs).'   Duty Leave </center></h2>';
}
$html.="<h3 style=margin-top:0><center>(From: ".$d1." To: ".$d2.") </center></h3>";
$html.="</head>";
$html.="<body>";
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
	
}	$html.="</table>"; 



$html.="<br/><br/><br/><br/><br/><br/>";




$html.="<br/><br/>";
$html.="<h3 align=right style=margin-bottom:0>HOD</h3>";



$html.="<h3 align=right style=margin-top:0>Department Of ".ucwords($dept)."</h3>";
$html.="</body>";
$html.="</html>";
$dompdf->loadHtml(html_entity_decode($html));	
$dompdf->setPaper('A4', 'landscape'); //portrait
$dompdf->render();
$dompdf->stream("attendance",array("Attachment"=>0));

?>