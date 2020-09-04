<?php
session_start();
include("includes/connection3.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
//include("includes/connection.php");
$st=$_SESSION['fid'];
$html='';
$dept=$_GET['dept'];
$bs=$_GET['bs'];
$sub_t=$_GET['sub_t'];
$cid=$_GET['cid'];
$subj=$_GET['subj'];
$cls=$_GET['cls'];
$cls2=$_GET['cls2'];
$st=$_GET['st'];
$date1=$_GET['date1'];
$date2=$_GET['date2'];
$e=$_GET['e'];


$type0 = '';
$r1=mysqli_query($con3,"select * from subject_class where subjectid='$subj'");
while($r2=mysqli_fetch_array($r1))  {
  $sub_t=$r2["subject_title"];
  $type0 = $r2["type"];
}


$batch="";
$i = 0;
if(isset($_GET['batch'])){ 
  $batch= $_GET['batch'];
}


//$res2=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$cls' and a.new_sem='$cls2' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
$res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$cls' and c.studid=b.admissionno order by c.rollno asc");

if($type0 == 'ELECTIVE') {

  $res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.studid IN ( SELECT stud_id FROM `elective_student`
    WHERE sub_code = '$subj' ) AND c.classid='$cls' and c.studid=b.admissionno order by c.rollno asc");
} else   if($type0 == 'LAB' ) {   

  $res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.studid IN ( SELECT l.studid FROM `lab_batch_student` l LEFT JOIN lab_batch b ON b.batch_id = l.batch_id WHERE b.sub_code ='$subj' AND b.batch_id IN ( $batch ) ) AND c.classid='$cls' and c.studid=b.admissionno order by c.rollno asc"); 
}   






$html .= '
<table border="1"  >
<colgroup valign="bottom">
<tr>
<th align="center" width="6%" rowspan="2"><b>RollNo</b></th>
<th align="center" width="40%" rowspan="2"><b>Name</b></th>

</tr>
<tr>

<td align="center" height="15"><b>Total No: Of Hours Attended</b></td>
<td align="center" height="15"><b>Total No: Of Hours Taken</b></td>

<td align="center" height="15"><b>Attendance Percentage(%)</b></td></tr>';

while($rs2=mysqli_fetch_array($res2))
{       
  $sid=$rs2["rollno"];
  $name=$rs2["name"];
  $total=0;
  $present=0;
  $res3=mysqli_query($con3,"select * from subject_allocation where subjectid='$subj' and classid='$cls' and fid='$st' ");
  while($rs3=mysqli_fetch_array($res3))
    {$html.='
  <tr>
  <td align="center" height="18" valign="middle">'.$sid.'</td>
  <td valign="middle">'.strtoupper($name).'</td> ';

$res4=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$cls' AND ( status = 'P' OR status = 'A' )");

  $res5=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$cls' and status='P'");
  $rr=mysqli_num_rows($res5);
  $aa=mysqli_num_rows($res4);

  $html.='

  <td align="center" valign="middle">'.$rr.'</td>';

  $html.='
<td align="center" valign="middle">'.$aa.'</td>';
  


  if(mysqli_num_rows($res4)==0)
    $html.='

  <td align="center" valign="middle">0</td>';
  else {


    $present=(mysqli_num_rows($res5)/mysqli_num_rows($res4))*100;
    $html.='
    <td align=center>'.round($present,2).'</td></tr>'; 
  }



}
}








$html.= '   </table>';       

$filename = "Attendance_Percentage_" . date('Ymd') . ".xls";

header("Content-type:application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
//                                header("Content-Disposition:attachment;filename:download.xls");
echo $html;
?>
