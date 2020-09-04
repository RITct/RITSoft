<?php
# @Date:   2019-09-30T13:21:00-07:00
# @Last modified time: 2019-11-10T22:17:01-08:00


	require("fpdf.php");

       $sql=mysqli_connect("localhost","root","","ritsoft");
	   session_start();
     $course_code="";
 $course_code=$_SESSION['$course_id'];
 $attainper=$_SESSION['ecalattainper'];
 $val=$_SESSION['ecalval'];
 $c=0;
 $m=0;
	$result1= mysqli_query($sql,"select * from external_percent,subject_class where external_percent.subjectid=subject_class.subjectid AND external_percent.subjectid='$course_code'") or die (mysqli_error());



	$pdf=new FPDF('P','mm',array(300,300));
		$pdf->AddPage();
		$pdf->SetFont("Arial","B",22);

		$pdf->Cell(250,5,"Rajiv Gandhi Institute Of Technology",0,0,'C');

	  $pdf->Ln();
			$pdf->SetFont("Arial","",10);
			$pdf->Cell(250,20,"Govt. Engineering College,Kottayam-686501",0,0,'C');
            $pdf->Ln();

						$pdf->SetFont("Arial","",18);

						$pdf->Cell(250,20,"E_CALCULATION",0,0,'C');

						$pdf->Ln();
			$pdf->SetFont("Arial","",5);
			//$pdf->Cell(50,30,'Duration: 1:30 hr');
			//$pdf->Cell(50,70,'Maximum Marks:30');
		//$pdf->Cell(70);




$pdf->Ln();
			while ($row= mysqli_fetch_array ($result1) )
		{
			$pdf->Ln();
		 $c= $row['subjectid'];


			//$pdf->SetXY(72,10); //TO INDENT
			$pdf->SetFont("Arial","",10);
      $pdf->Cell(40,40,'Course Id:',1,0,'C');
$pdf->Cell(70,40,'Course Title:',1,0,'C');
if(isset($_SESSION['$studno']))
{

	$m= $_SESSION['$studno'];
}
else{
	$m=0;
}
$pdf->Cell(70,25,"No: of student={$m}",1,0,'C');
$pdf->Cell(50,40,'No of Students Scored in:',1,0,'C');
$pdf->Cell(50,40,'Level attainment in percentage:',1,0,'C');
$pdf->SetXY(120,120);
$pdf->Cell(10,15,'O',1,0,'C');
$pdf->Cell(10,15,'A+',1,0,'C');
$pdf->Cell(10,15,'A',1,0,'C');
$pdf->Cell(10,15,'B+',1,0,'C');
$pdf->Cell(10,15,'B',1,0,'C');
$pdf->Cell(10,15,'C',1,0,'C');
$pdf->Cell(10,15,'P',1,0,'C');
$pdf->Cell(55,10,'between the acceptable range',0,0,'L');
$pdf->Cell(70,10,' in percentage:',0,0,'L');
$pdf->SetXY(10,135);
			$pdf->Cell(40,10,"{$row['subjectid']}",1,0,'C');

	 $pdf->Cell(70,10,"{$row['subject_title']}",1,0,'C');
	$pdf->Cell(10,10,"{$row['O']}",1,0,'C');
$pdf->Cell(10,10,"{$row['A+']}",1,0,'C');
$pdf->Cell(10,10,"{$row['A']}",1,0,'C');
$pdf->Cell(10,10,"{$row['Bp']}",1,0,'C');
$pdf->Cell(10,10,"{$row['Bo']}",1,0,'C');
$pdf->Cell(10,10,"{$row['C']}",1,0,'C');
$pdf->Cell(10,10,"{$row['P']}",1,0,'C');





			if(isset($_SESSION['$gradestart']))
			{

				$m1= $_SESSION['$gradestart'];
			}
			else{
				$m1=0;
			}

			    $pdf->Cell(50,10,"{$val}",1,0,'C');
					  $pdf->Cell(50,10,"{$attainper}",1,0,'C');
            $pdf->Ln();



			//$pdf->Cell(180,10,"{$row['po_description']}",1,0);


		}


		//$pdf->SetFont("Arial","",10);
		//	$pdf->Cell(250,30," ",0,0,'C');
      //      $pdf->Ln();

		//$pdf->Cell(70,10,'CO',1,0,'C'); // First header column
		//$pdf->Cell(70,10,'Description',1,0); // Second header column





  		$pdf->Output();

?>
