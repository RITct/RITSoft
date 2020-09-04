<?php
    if(isset($_POST['excel']))
    {
        $reli=$_POST['religion'];
        
        $search_query=  explode("/", $reli);
        
        $link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");
        $sql = "SELECT * FROM stud_details A LEFT JOIN current_class B ON A.admissionno=B.studid LEFT JOIN class_details C ON B.classid=C.classid WHERE A.courseid='$search_query[0]' AND C.semid='$search_query[1]' AND C.deptname='$search_query[3]' AND A.branch_or_specialisation='$search_query[2]' ";
        $result = mysqli_query($link, $sql);
        
        
      require('PHPExcel.php');

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
$objSheet->setTitle('My sales report');

 

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
$objSheet->getCell('L1')->setValue('semid');
$objSheet->getCell('M1')->setValue('department');
$objSheet->getCell('R1')->setValue('rank');
$objSheet->getCell('S1')->setValue('quota');
$objSheet->getCell('T1')->setValue('school_1');
$objSheet->getCell('U1')->setValue('regno_1');
$objSheet->getCell('V1')->setValue('board_1');
$objSheet->getCell('W1')->setValue('percentage_1');
$objSheet->getCell('X1')->setValue('school_2');
$objSheet->getCell('Y1')->setValue('regno_2');
$objSheet->getCell('Z1')->setValue('board_2');
$objSheet->getCell('AA1')->setValue('percentage_2');

$objSheet->getCell('AD1')->setValue('courseid');
$objSheet->getCell('AE1')->setValue('branch_or_specialisation');

      
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
       $objSheet->getCell('L'.$i)->setValue($row['semid']);
       $objSheet->getCell('M'.$i)->setValue($row['deptname']);
       $objSheet->getCell('R'.$i)->setValue($row['rank']);
       $objSheet->getCell('S'.$i)->setValue($row['quota']);
       $objSheet->getCell('T'.$i)->setValue($row['school_1']);
       $objSheet->getCell('U'.$i)->setValue($row['regno_1']);
       $objSheet->getCell('V'.$i)->setValue($row['board_1']);
       $objSheet->getCell('W'.$i)->setValue($row['percentage_1']);
       $objSheet->getCell('X'.$i)->setValue($row['school_2']);
       $objSheet->getCell('Y'.$i)->setValue($row['regno_2']);
       $objSheet->getCell('Z'.$i)->setValue($row['dob']);
       $objSheet->getCell('AA'.$i)->setValue($row['percentage_2']);
       
       $objSheet->getCell('AD'.$i)->setValue($row['courseid']);
       $objSheet->getCell('AE'.$i)->setValue($row['branch_or_specialisation']);
       
       
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
       $objSheet->getColumnDimension('R')->setAutoSize(true);
       $objSheet->getColumnDimension('S')->setAutoSize(true);
       $objSheet->getColumnDimension('T')->setAutoSize(true);
       $objSheet->getColumnDimension('U')->setAutoSize(true);
       $objSheet->getColumnDimension('V')->setAutoSize(true);
       $objSheet->getColumnDimension('W')->setAutoSize(true);
       $objSheet->getColumnDimension('X')->setAutoSize(true);
       $objSheet->getColumnDimension('Y')->setAutoSize(true);
       $objSheet->getColumnDimension('Z')->setAutoSize(true);
       $objSheet->getColumnDimension('AA')->setAutoSize(true);
       
       $objSheet->getColumnDimension('AD')->setAutoSize(true);
       $objSheet->getColumnDimension('AE')->setAutoSize(true);
      


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