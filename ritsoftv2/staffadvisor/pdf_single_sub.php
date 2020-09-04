<?php
include("includes/connection3.php");
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dept=strtolower($_REQUEST["dept"]);
$bs=strtolower($_GET['bs']);
$sub_t=$_GET['sub_t'];
$cid=$_GET['cid'];
$subj=$_GET['subj'];
$cls=$_GET['cls'];
$cls2=$_GET['cls2'];
$st=$_GET['st'];
$date1=$_GET['date1'];
$date2=$_GET['date2'];
$e=$_GET['e'];
$d1=date('d-m-Y',strtotime($_GET["date1"]));
$d2=date('d-m-Y',strtotime($_GET["date2"]));


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




$html=""; 
$html.='<html>';
$html.='<head>';
$html.='<h2 style=margin-bottom:0><center>Rajiv Gandhi Institute Of Technology</center></h2>';
if($cid=='MCA'|| $cid =='BARCH')
{
	
	$html.='<h2 style=margin-top:0 ><center>'.$cls2.' '.$cid.' Attendance Percentage </center></h2>';
}
else
{
	
	$html.='<h2 style=margin-top:0 ><center>'.$cls2.' '.$cid.' '.ucwords($bs).' Attendance Percentage </center></h2>';
}
$html.='<h3 style=margin-top:0><center>(From: '.$d1.' To: '.$d2.') </center></h3>';
$html.='<h3 style=margin-top:0><center>'.$subj.' -- '.$sub_t.'<small style="padding-left: 5px; font-size:12px;">('.$type0.')</small></center></h2>';

if($type0 == 'LAB' ) {

    $res4=mysqli_query($con3,"SELECT batch_name FROM lab_batch WHERE batch_id in ( $batch) ");
    $batchName = "";
    while($rs4=mysqli_fetch_array($res4)){
        if($batchName != "")
            $batchName = $batchName. ",  " ;
        $batchName = $batchName.$rs4["batch_name"];
    }

    $html.='<h5 style=margin-top:10px;><center> batches included '.$batchName.'</center></h5>';
}

$html.='</head>';
$html.='<body>';               
$html .= '
<table border="1" align="center">
<colgroup valign="bottom">
<tr>
<th align="center" width="6%"><b>RollNo</b></th>
<th align="center" width="60%" ><b>Name</b></th>
<th align="center"  width="50%"><b>Total No: Of Hours Attended</b></th>
<th align="center"  width="50%"><b>Total No: Of Hours Taken</b></th>
<th align="center"  width="50%"><b>Attendance (%)</b></th>
</tr>';




while($rs2=mysqli_fetch_array($res2))
{       
 $sid=$rs2["rollno"];
 $name=$rs2["name"];
 $total=0;
 $present=0;
 $res3=mysqli_query($con3,"select * from subject_allocation where subjectid='$subj' and classid='$cls' and fid='$st' ");
 while($rs3=mysqli_fetch_array($res3))
    {	$html.='
<tr>
<td align="center" height="16" valign="middle">'.$sid.'</td>
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

<td align="center" valign="middle">0</td></tr>';
else {



  $present=(mysqli_num_rows($res5)/mysqli_num_rows($res4))*100;
  $html.='<td align="center" valign="middle">'.round($present,2).'</td></tr>'; 
}



}
}








$html.= '   </table>';
$html.='<br/><br/> ';
$html.="<h3 align=right style=margin-bottom:0>HOD</h3>";
$html.="<h3 align=right style=margin-top:0>Department Of ".ucwords($dept)."</h3>";
$html.="</body>";
$html.="</html>";
$dompdf->loadHtml(html_entity_decode($html));	
$dompdf->setPaper('A4', 'portrait'); //portrait or landscape
$dompdf->render();
$dompdf->stream("attendance",array("Attachment"=>0));

?>       
