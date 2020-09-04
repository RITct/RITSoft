<?php
    if(isset($_POST['excel']))
    {
        
        $link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2","ritsoftv2");
        $add_no=$_POST['add_no'];
        $category=$_POST['category'];

        $sql = "SELECT * FROM faculty_details WHERE $category='$add_no'";
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
$objSheet->setTitle('FACULTY DETAILS');

 

// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A1:E1')->getFont()->setBold(true)->setSize(12);

$objSheet->getCell('A1')->setValue('FACULTY ID');
$objSheet->getCell('B1')->setValue('Name');
$objSheet->getCell('C1')->setValue('DEPTNAME');
$objSheet->getCell('D1')->setValue('PHONENO');
$objSheet->getCell('E1')->setValue('EMAIL');


      
     $i=2;
        while($row = mysqli_fetch_array($result)){
           
       $objSheet->getCell('A'.$i)->setValue($row['fid']);
       $objSheet->getCell('B'.$i)->setValue($row['name']);
       $objSheet->getCell('C'.$i)->setValue($row['deptname']);
       $objSheet->getCell('D'.$i)->setValue($row['phoneno']);
       $objSheet->getCell('E'.$i)->setValue($row['email']);
       
       
       
       $i=$i+1;

       } 
       $objSheet->getColumnDimension('A')->setAutoSize(true);
       $objSheet->getColumnDimension('B')->setAutoSize(true);
       $objSheet->getColumnDimension('C')->setAutoSize(true);
       $objSheet->getColumnDimension('D')->setAutoSize(true);
       $objSheet->getColumnDimension('E')->setAutoSize(true);
       
      


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