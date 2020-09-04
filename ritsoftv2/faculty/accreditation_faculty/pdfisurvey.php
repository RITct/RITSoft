<?php



	require("fpdf.php");

       $sql=mysqli_connect("localhost","root","","ritsoft");
	   session_start();
     $course_code=$_SESSION['id'];
	 $se="";
	 $thr="";
	 $n="";
	 $per="";




$c=0;
$m=0;
$y=0;
$y1=0;
 $result1= mysqli_query($sql,"select * from survey_attainment WHERE subjectid='$course_code'") or die (mysqli_error());



 $pdf=new FPDF('P','mm',array(300,300));
	 $pdf->AddPage();
	 $pdf->SetFont("Arial","B",22);

	 $pdf->Cell(250,5,"Rajiv Gandhi Institute Of Technology",0,0,'C');

	 $pdf->Ln();
$pdf->SetFont("Arial","",10);
$pdf->Ln();
$pdf->SetXY(10,35);
     		$pdf->Cell(250,10,"Consoildated Course End Survey Analysis,  No: of students=",1,0,'C');
     		$pdf->Ln();

     		$pdf->Cell(40,30,'Number of Students',1,0,'C');
        $pdf->Cell(25,20,'Not Acceptable',1,0,'C');
        $pdf->Cell(75,20,'Acceptable Range',1,0,'C');
        $pdf->Cell(55,30,'Total in the Acceptable Range',1,0,'C');
        $pdf->Cell(55,30,'Attainment level in percentage',1,0,'C');
        	$pdf->SetXY(10,65);
        		$pdf->Cell(40,10,'Scored in a Range',0,0,'LC');
              $pdf->Cell(25,10,'Marks:1\& 2',1,0,'C');
                $pdf->Cell(25,10,'Marks:3',1,0,'C');
                  $pdf->Cell(25,10,'Marks:4',1,0,'C');
                    $pdf->Cell(25,10,'Marks:5',1,0,'C');
$pdf->Ln();
		 while ($row= mysqli_fetch_array ($result1) )
	 {


		 $pdf->SetFont("Arial","",10);

     $pdf->Cell(40,10,"{$row['co_code']}",1,0,'C');
     $notacc=$row['unsure'] + $row['notconfident'];
     $acceptable=$row['average'] + $row['confident'] + $row['highconfident'];
     $tot=$acceptable+$notacc;
     $attainmnt=($acceptable/$tot)*100;
 $pdf->Cell(25,10,"{$notacc}",1,0,'C');
  $pdf->Cell(25,10,"{$row['average']}",1,0,'C');
    $pdf->Cell(25,10,"{$row['confident']}",1,0,'C');
       $pdf->Cell(25,10,"{$row['highconfident']}",1,0,'C');
       $pdf->Cell(55,10,"{$acceptable}",1,0,'C');
       $pdf->Cell(55,10,"{$attainmnt}",1,0,'C');
			 $pdf->Ln();
     //$pdf->Cell(50,10,"Mark:>{$row['threshold']}",1,0,'C');


}
//







  		$pdf->Output();

?>
