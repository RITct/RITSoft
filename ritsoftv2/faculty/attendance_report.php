<?php
ob_start();
session_start();
include("../connection.mysqli.php");
if(!isset($_SESSION['fid']))
{
  die("Error : Not Logged in");
}
$classid="";
$sub="";
$sdate="";
$edate="";
if(isset($_GET['classid']) && isset($_GET['sub']) && isset($_GET['sdate']) && isset($_GET['edate']))
{
  $classid=$_GET['classid'];
  $sub=$_GET['sub'];
  $sdate=$_GET['sdate'];
  $edate=$_GET['edate'];
}
ExportReports('excel');
function ExportReports($parameter1)
{
    global $con3;
    global $con;
    $con3 = $con;
    global $classid;
    global $sub;
    global $sdate;
    global $edate;
    include_once('PHPExcel/IOFactory.php');

    $objPHPExcel = new PHPExcel;

    $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");


    $currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';

    $numberFormat = '#,#0.##;[Red]-#,#0.##';



    $objSheet = $objPHPExcel->getActiveSheet();

    $objSheet->setTitle($sub.' Attendance Report');

    $objSheet->getStyle('A1:AAA1')->getFont()->setBold(true)->setSize(12);

    $objSheet->getCell('A1')->setValue('Roll No');
    $objSheet->getCell('B1')->setValue('Admission No');
    $objSheet->getCell('C1')->setValue('Student');
    $objSheet->getColumnDimension('A')->setAutoSize(true);
    $objSheet->getColumnDimension('B')->setAutoSize(true);
    $objSheet->getColumnDimension('C')->setAutoSize(true);



    $c=mysqli_query($con3,"SELECT distinct date,hour FROM attendance WHERE classid='".$classid."' and subjectid='".$sub."' and date between '".$sdate."' and '".$edate."' order by date,hour;");
    $harray=array();
    while($res=mysqli_fetch_array($c))
    {
      $harray[$res[0].";".$res[1]]=$res[1];
    }
    $r='C';//3rd column
    foreach($harray as $date => $hour)
    {
      $r++;
      $date=explode(";",$date)[0];
      $dat=date("d / M / Y ( D )",strtotime($date))." [ ".$hour;
      if($hour==1)
      {
        $dat.="st";
      }
      else if($hour==2)
      {
        $dat.="nd";
      }
      else if($hour==3)
      {
        $dat.="rd";
      }
      else
      {
        $dat.="th";
      }
      $dat.="hour ]";
      $objSheet->getCell($r."1")->setValue($dat);
      //$objSheet->getColumnDimension($r)->setAutoSize(true);
    }
    class attendance
    {
      public $name="";
      public $rollno="";
      public $att=array();
      function __construct($rollno,$name)
      {
        $this->name=$name;
        $this->rollno=$rollno;
      }
      function setAttendance($datehour,$status)
      {
        $this->att[$datehour]=$status;
      }
      function getAttendance($date)
      {
        if(array_key_exists($date,$this->att))
        {
          $value=$this->att[$date];
          if($value=="P")
          {
            return "P";
          }
          if($value=="A")
          {
            return "A";
          }
        }
        return "-";
      }
    }
    $qr="SELECT C.rollno,S.admissionno as stdid,S.name FROM stud_details as S left join current_class as C on S.admissionno=C.studid where C.classid='".$classid."' order by C.rollno;";
    $cy=mysqli_query($con3,$qr);
    $studlist=array();
    while($resb=mysqli_fetch_assoc($cy))
    {
      $studlist[$resb['stdid']]=new attendance($resb['rollno'],$resb['name']);
    }
    foreach($harray as $xdate => $hr)
    {
      $xdate=explode(";",$xdate)[0];
      $qr="SELECT hour,studid,status FROM attendance where classid='".$classid."' and date='".$xdate."' order by studid,hour asc;";
      $cz=mysqli_query($con3,$qr);
      while($resc=mysqli_fetch_assoc($cz))
      {
        if(array_key_exists($resc['studid'],$studlist))
        $studlist[$resc['studid']]->setAttendance($xdate.":".$hr,$resc['status']);
      }
    }
    $r=2;
    foreach($studlist as $id => $student)
    {
      $objSheet->getCell('A'.$r)->setValue($student->rollno);
      $objSheet->getCell('B'.$r)->setValue($id);
      $objSheet->getCell('C'.$r)->setValue($student->name);
      $c='D';//4th column
      foreach($harray as $date => $hour)
      {
        $date=explode(";",$date)[0];
        $x=$student->getAttendance($date.":".$hour);
        $objSheet->getCell($c.$r)->setValue($x);
        $c++;
      }
      $r++;
    }



    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$sub.'_Attendance_Report.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');
    exit;

}

?>
