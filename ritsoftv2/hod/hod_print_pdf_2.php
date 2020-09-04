<?php
include("includes/dbopen.php");
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$sum="";
$course=$_REQUEST["a"];
//$dept=$_REQUEST["b"];
//$spec=$_REQUEST["c"];

$cid=$_REQUEST["cid"];
$semester=$_REQUEST["d"];
$d1=$_REQUEST["e"];
$d2=$_REQUEST["f"];
$date1=date('d-m-Y',strtotime($_REQUEST["e"]));
$date2=date('d-m-Y',strtotime($_REQUEST["f"]));
$bs=$_REQUEST["bs"];
$dept=strtolower($_REQUEST["dept"]);
$bs=strtolower($bs);
$html='<style type="text/css"> th { font-size: 10px; } td { font-size: 13px; } </style>';
$html.="<html>";
$html.="<head>";
$html.="



";
$html.="<h2 style=margin-bottom:0><center>Rajiv Gandhi Institute Of Technology</center></h2>";
if($cid=='MCA'|| $cid =='BARCH')
{
	
	$html.='<h2 style=margin-top:0 ><center>'.$semester.' '.$cid.' Attendance Percentage </center></h2>';
}
else
{
	
	$html.='<h2 style=margin-top:0 ><center>'.$cls2.' '.$cid.' '.ucwords($bs).' Attendance Percentage </center></h2>';
}
$html.="<h3 style=margin-top:0><center>(From: ".$date1." To: ".$date2.") </center></h3>";
$html.="</head>";
$html.="<body>";
$html.="<table border='1' cellspacing='0' align=center cellspacing='0' width='100%'>";
$html.="<tr><th>Roll no</th>";
$html.="<th>Name</th>";
$res1=mysqli_query($con3,"select * from subject_class where classid='$course' order by subjectid asc");
while($rs1=mysqli_fetch_array($res1))
{
	$html.="<th>".$rs1["subjectid"]."(%)"."</th>";
}
$html.="<th> Total(%) </th>";
$html.="</tr>";

//		$res2=mysqli_query($con3,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$course' and a.new_sem='$semester' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
$res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$course' and c.studid=b.admissionno order by c.rollno asc");

while($rs2=mysqli_fetch_array($res2))
{	//$html.="<tr>vcjhgcgcgcgcgc</tr>";
$studid=$rs2["studid"];



$html.="<tr>";
$html.="<td>".$rs2["rollno"]."</td>";
$html.="<td>".strtoupper($rs2["name"])."</td>";


$total=0;
$present=0;
$res3=mysqli_query($con3,"select * from subject_class where classid='$course' order by subjectid asc");
while($rs3=mysqli_fetch_array($res3))
{

	$res4=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$d1' AND '$d2' and subjectid='$rs3[subjectid]' and classid='$course' and ( status = 'P' OR status = 'A' )");
	$res5=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$d1' AND '$d2' and subjectid='$rs3[subjectid]' and classid='$course' and status='P'");

	if(mysqli_num_rows($res4)==0){
		if( $rs3['type'] == 'ELECTIVE') {
			$tro ="SELECT * FROM elective_student WHERE sub_code = '$rs3[subjectid]' AND stud_id ='$rs2[studid]' ";
			$res49=mysqli_query($con3, $tro);
			if(mysqli_num_rows($res49)==0){
				
				$html.="<td align=center>--</td>";
			} else{
				
				$html.="<td align=center>0</td>";
			}
		} else {
			
			$html.="<td align=center>0</td>";
		}
	}
	else
		{ $sum=((mysqli_num_rows($res5)/mysqli_num_rows($res4))*100); 
			$html.="<td align=center>".round(((mysqli_num_rows($res5)/mysqli_num_rows($res4))*100),2).""."</td>";
		}
		$total+=mysqli_num_rows($res4);
		$present+=mysqli_num_rows($res5);				

	}

	if($total==0)
		$html.= "<td align=center>0</td>";
	else{
		$tot=round((($present/$total)*100),2); 
		$html.="<td align=center>".$tot."</td>";
	}


	$html.="</tr>";

}
$html.="</table>"; 


$html.="<br/><br/><br/><br/><br/><br/>";
$html.="<table border='1' cellspacing='0' align=center cellspacing='0' >";
$html.="<tr> <th> subject id </th> <th> subject name </th></tr>";
$c=mysqli_query($con3,"select * from subject_class where classid='$course' order by subjectid asc");
while($re=mysqli_fetch_array($c))
{
	$html.="<tr>

	<th>". $re["subjectid"]. "</th>
	<th>".$re["subject_title"] ."</th>
	</tr>";

}

$html.="</table>";


$html.="<br/><br/>";
$html.="<h3 align=right style=margin-bottom:0>HOD</h3>";
$html.="<h3 align=right style=margin-top:0>Department Of ".ucwords($dept)."</h3>";
$html.="</body>";
$html.="</html>";
$dompdf->loadHtml(html_entity_decode($html));	
$dompdf->setPaper('A4', 'portrait'); //portrait or landscape
$dompdf->render();
$dompdf->stream("attendance",array("Attachment"=>0));

?>
