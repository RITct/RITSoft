<?php
include("../connection.mysqli.php");
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
$html.="<tr><th>Roll no</th>";
$html.="<th>Name</th>";
$res1=mysqli_query($con3,"select * from subject_class where classid='$cls' order by subjectid asc");
while($rs1=mysqli_fetch_array($res1))
{
        $html.="<th>Total Hours Attended</th>";
        $html.="<th>Total Hours Taken</th>";
	$html.="<th>".$rs1["subjectid"]." - ".$rs1["subject_title"]." (%)"."</th>";
}
$html.="<th> Total(%) </th>";
$html.="</tr>";
while($j<=$k)
	{ 	//$res2=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and c.rollno='$j' order by c.rollno asc");

$res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$cls' and c.studid=b.admissionno and c.rollno='$j' order by c.rollno asc");

while($rs2=mysqli_fetch_array($res2))
{
	$i=1;
	$sid=$rs2["rollno"];
	$html.="<tr>";
	$html.="<td align=center>".$rs2["rollno"]."</td>";
	$html.="<td >".strtoupper($rs2["name"])."</td>";

	
	
	$total=0;
	$present=0;
	$res3=mysqli_query($con3,"select * from subject_class where classid='$cls' order by subjectid asc");
	while($rs3=mysqli_fetch_array($res3))
	{
		
		$res4=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$cls' and ( status = 'P' OR status = 'A' )");
		$res5=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$cls' and status='P'");
		$html.="<td >".mysqli_num_rows($res5)."</td>";
		$html.="<td >".mysqli_num_rows($res4)."</td>";
		if(mysqli_num_rows($res4)==0){
			$tbo =   "0";
			$resulto=mysqli_query($con3,"select * from subject_class where  subjectid='$rs3[subjectid]' and type='ELECTIVE' ");
			if(mysqli_num_rows($resulto) > 0 ) { 
				$resulto1=mysqli_query($con3,"select * from elective_student where  sub_code='$rs3[subjectid]' and stud_id ='".$rs2["studid"]."' ");
				if(mysqli_num_rows($resulto1) <1 ) { 
					$tbo =   "--"; 
				} 
			}  
			

			$html.="<td align=center>$tbo</td>";

		}else
		{
			
			$sum=round(((mysqli_num_rows($res5)/mysqli_num_rows($res4))*100),2); 
			$html.="<td align=center>".$sum."</td>";
		}
		$total+=mysqli_num_rows($res4);
		$present+=mysqli_num_rows($res5);				
		
	}
	if($total==0)
		$html.= "<td>0</td>";
	else{
		$tot=round((($present/$total)*100),2); 
		$html.="<td align=center>".$tot."</td>";
		$html.="</tr>";                                  }
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


