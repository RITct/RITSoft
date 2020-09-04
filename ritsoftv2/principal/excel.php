<?php
if(isset($_POST['excel']))
{
  $reli=$_POST['religion'];
  $category=$_POST['category'];
  $link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");
  $sql = "SELECT * FROM stud_details WHERE $category='$reli'";
  $result = mysqli_query($link, $sql);
  
  
  require('../PHPExcel.php');

// create new PHPExcel object
  $objPHPExcel = new PHPExcel;

// set default font
  $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

// set default font size
  $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

// create the writer
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");


// currency format, € with < 0 being in red color
  $currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';

// number format, with thousands separator and two decimal points.
  $numberFormat = '#,#0.##;[Red]-#,#0.##';

  

// writer already created the first sheet for us, let's get it
  $objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
  $objSheet->setTitle('STUDENT DETAILS');

  

// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
  $objSheet->getStyle('A1:AE1')->getFont()->setBold(true)->setSize(12);

  $objSheet->getCell('A1')->setValue('admissionno');
  $objSheet->getCell('B1')->setValue('Name');
  $objSheet->getCell('C1')->setValue('dob');
  $objSheet->getCell('D1')->setValue('gender');
  $objSheet->getCell('E1')->setValue('religion');
  $objSheet->getCell('F1')->setValue('caste');
  $objSheet->getCell('G1')->setValue('year_of_admission');
  $objSheet->getCell('H1')->setValue('email');
  $objSheet->getCell('I1')->setValue('mobile_phno');
  $objSheet->getCell('J1')->setValue('land_phno');
  $objSheet->getCell('K1')->setValue('address');
  $objSheet->getCell('L1')->setValue('rollno');
  $objSheet->getCell('M1')->setValue('rank');
  $objSheet->getCell('N1')->setValue('quota');
  $objSheet->getCell('O1')->setValue('school_1');
  $objSheet->getCell('P1')->setValue('regno_1');
  $objSheet->getCell('Q1')->setValue('board_1');
  $objSheet->getCell('R1')->setValue('percentage_1');
  $objSheet->getCell('S1')->setValue('school_2');
  $objSheet->getCell('T1')->setValue('regno_2');
  $objSheet->getCell('U1')->setValue('board_2');
  $objSheet->getCell('V1')->setValue('percentage_2');
  $objSheet->getCell('W1')->setValue('no_chance1');
  $objSheet->getCell('X1')->setValue('courseid');
  $objSheet->getCell('Y1')->setValue('branch_or_specialisation');

  
  $i=2;
  while($row = mysqli_fetch_array($result)){
   
   $objSheet->getCell('A'.$i)->setValue($row['admissionno']);
   $objSheet->getCell('B'.$i)->setValue($row['name']);
   $objSheet->getCell('C'.$i)->setValue($row['dob']);
   $objSheet->getCell('D'.$i)->setValue($row['gender']);
   $objSheet->getCell('E'.$i)->setValue($row['religion']);
   $objSheet->getCell('F'.$i)->setValue($row['caste']);
   $objSheet->getCell('G'.$i)->setValue($row['year_of_admission']);
   $objSheet->getCell('H'.$i)->setValue($row['email']);
   $objSheet->getCell('I'.$i)->setValue($row['mobile_phno']);
   $objSheet->getCell('J'.$i)->setValue($row['land_phno']);
   $objSheet->getCell('K'.$i)->setValue($row['address']);
   $objSheet->getCell('L'.$i)->setValue($row['rollno']);
   $objSheet->getCell('M'.$i)->setValue($row['rank']);
   $objSheet->getCell('N'.$i)->setValue($row['quota']);
   $objSheet->getCell('O'.$i)->setValue($row['school_1']);
   $objSheet->getCell('P'.$i)->setValue($row['regno_1']);
   $objSheet->getCell('Q'.$i)->setValue($row['board_1']);
   $objSheet->getCell('R'.$i)->setValue($row['percentage_1']);
   $objSheet->getCell('S'.$i)->setValue($row['school_2']);
   $objSheet->getCell('T'.$i)->setValue($row['regno_2']);
       //$objSheet->getCell('Z'.$i)->setValue($row['dob']);
   $objSheet->getCell('U'.$i)->setValue($row['percentage_2']);
   $objSheet->getCell('W'.$i)->setValue($row['no_chance1']);
      // $objSheet->getCell('AC'.$i)->setValue($row['no_chance2']);
   $objSheet->getCell('X'.$i)->setValue($row['courseid']);
   $objSheet->getCell('y'.$i)->setValue($row['branch_or_specialisation']);
   
   
   $i=$i+1;

 } 
 $objSheet->getColumnDimension('A')->setAutoSize(true);
 $objSheet->getColumnDimension('B')->setAutoSize(true);
 $objSheet->getColumnDimension('C')->setAutoSize(true);
 $objSheet->getColumnDimension('D')->setAutoSize(true);
 $objSheet->getColumnDimension('E')->setAutoSize(true);
 $objSheet->getColumnDimension('F')->setAutoSize(true);
 $objSheet->getColumnDimension('G')->setAutoSize(true);
 $objSheet->getColumnDimension('H')->setAutoSize(true);
 $objSheet->getColumnDimension('I')->setAutoSize(true);
 $objSheet->getColumnDimension('J')->setAutoSize(true);
 $objSheet->getColumnDimension('K')->setAutoSize(true);
 $objSheet->getColumnDimension('L')->setAutoSize(true);
 $objSheet->getColumnDimension('M')->setAutoSize(true);
 $objSheet->getColumnDimension('N')->setAutoSize(true);
 $objSheet->getColumnDimension('O')->setAutoSize(true);
 $objSheet->getColumnDimension('P')->setAutoSize(true);
 $objSheet->getColumnDimension('Q')->setAutoSize(true);
 $objSheet->getColumnDimension('R')->setAutoSize(true);
 $objSheet->getColumnDimension('S')->setAutoSize(true);
 $objSheet->getColumnDimension('T')->setAutoSize(true);
 $objSheet->getColumnDimension('U')->setAutoSize(true);
 $objSheet->getColumnDimension('V')->setAutoSize(true);
 $objSheet->getColumnDimension('W')->setAutoSize(true);
 $objSheet->getColumnDimension('X')->setAutoSize(true);
 $objSheet->getColumnDimension('Y')->setAutoSize(true);
 


//Setting the header type
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 header('Content-Disposition: attachment;filename="file.xlsx"');
 header('Cache-Control: max-age=0');

 $objWriter->save('php://output');
 exit;
 
}

$_SESSION['alert']=$alert;
if(isset($_SERVER['HTTP_REFERER']))
{
  header('Location: ' . $_SERVER['HTTP_REFERER']);   
}
else 
{
  header('Location:loginpage.php');     
}

?>