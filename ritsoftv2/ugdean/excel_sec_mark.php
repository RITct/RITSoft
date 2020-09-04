<?php
    if(isset($_POST['excel']))
    {
        $reli=$_POST['religion'];
        
        $search_query=  explode("/", $reli);
        
        $link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2","ritsoftv2");
         $sql = "SELECT A.classid,B.subjectid FROM class_details A LEFT JOIN subject_class B ON A.classid=B.classid WHERE A.courseid='$search_query[0]' AND A.semid='$search_query[1]' AND A.deptname='$search_query[3]' AND A.branch_or_specialisation='$search_query[2]'";
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
$objSheet->setTitle('My sales report');

 

// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A1:H1')->getFont()->setBold(true)->setSize(12);

$objSheet->getCell('A1')->setValue('admissionno');
$objSheet->getCell('B1')->setValue('Name');

$cell_l = 'C';
while($row = mysqli_fetch_array($result)){
                                                        $classid=$row["classid"];
							$subjectid=$row["subjectid"];
                                                        
                                                         $cell=$cell_l."1";
                                                       


$objSheet->getCell($cell)->setValue($subjectid);
$cell_l++;
}

$sql="select distinct(A.studid),B.name from sessional_marks A LEFT JOIN stud_details B ON A.studid=B.admissionno where A.classid='$classid' order by(A.studid)";
$result = mysqli_query($link, $sql);
     $i=2;
        while($row = mysqli_fetch_array($result)){
            $studid=$row["studid"];
           
       $objSheet->getCell('A'.$i)->setValue($row['studid']);
       $objSheet->getCell('B'.$i)->setValue($row['name']);
       
       
      
     $sql2="select subjectid from subject_class where classid='$classid'";
     $result2 = mysqli_query($link, $sql2);
     $cell_l = 'C';
                	while($d=mysqli_fetch_array($result2))
                	{
                    	$subjectid=$d["subjectid"];
                    	$sessional_marks='--';
          				$sql3="select * from sessional_marks where classid='$classid' and studid='$studid' and subjectid='$subjectid' order by(subjectid)";
                                         $result3 = mysqli_query($link, $sql3);
                                         
                		while($data=mysqli_fetch_array($result3))
                		{	
                    		$classid=$data["classid"];
                    //$studid=$data["studid"];
                    		$subid=$data["subjectid"];
                    		$data["sessional_marks"];
                    		$sessional_marks=$data["sessional_marks"];
            				//$status=$data["status"];
                 		}
                                
                              
                                                        $cell=$cell_l.$i;
       
       $objSheet->getCell($cell)->setValue($sessional_marks);
       
       $cell_l++;
      
       

       }
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