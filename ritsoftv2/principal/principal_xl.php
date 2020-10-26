<?php //$con3=mysqli_connect("localhost","root","","ritsoft");
include("../connection.mysqli.php");
$st=$_SESSION['fid'];

$sum="";
$cls=$_REQUEST["cls"];
//$dept=$_REQUEST["b"];
//$spec=$_REQUEST["c"];
//$semester=$_REQUEST["d"];
$date1=$_REQUEST["e"];
$date2=$_REQUEST["f"];
$html="";
$html.="<html>";
$html.="<table border='1' cellspacing='0' align=center cellspacing='0' width='100%'>";
$html.="<tr><th>Roll no</th>";
$html.="<th>Name</th>";
$res1=mysqli_query($con,"select * from subject_class where classid='$cls' order by subjectid asc");
	while($rs1=mysqli_fetch_array($res1))
	{
            $html.="<th>".$rs1["subjectid"]."(%)</th>";
        }
$html.="<th> Total(%) </th>";
$html.="</tr>";

		//$res2=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$course' and a.new_sem='$semester' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
		$res2=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$cls' and c.studid=b.admissionno order by c.rollno asc");

                    while($rs2=mysqli_fetch_array($res2))
                    {	//$html.="<tr>vcjhgcgcgcgcgc</tr>";
                        $html.="<tr>";
                        $html.="<td align=center>".$rs2["rollno"]."</td>";
                         $html.="<td >".strtoupper($rs2["name"])."</td>";


                                $total=0;
				$present=0;
				$res3=mysqli_query($con,"select * from subject_allocation where classid='$cls' order by subjectid asc");
				while($rs3=mysqli_fetch_array($res3))
				{
					
					$res4=mysqli_query($con,"select * from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$cls'");
					$res5=mysqli_query($con,"select * from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$cls' and status='P'");

			if(mysqli_num_rows($res4)==0)
					$html.="<td align=center>0</td>";
					else
					{ $sum=round(((mysqli_num_rows($res5)/mysqli_num_rows($res4))*100),0); 
					  $html.="<td align=center>".$sum."</td>";
                                        }
						$total+=mysqli_num_rows($res4);
					$present+=mysqli_num_rows($res5);				
				
				}
				
				if($total==0)
				$html.= "<td align=center>0</td>";
				else{
				$tot=round((($present/$total)*100),0); 
                $html.="<td align=center>".$tot."</td>";
                                    }
						
		
$html.="</tr>";

}
$html.="</table>";
    	
                                $filename = "Principal_Attendance_Percentage_" . date('Ymd') . ".xls";

                                header("Content-type:application/octet-stream");
                                 header("Content-Disposition: attachment; filename=\"$filename\"");
//                                header("Content-Disposition:attachment;filename:download.xls");
                                echo $html;


?>

