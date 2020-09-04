<?php
# @Date:   2019-11-11T00:31:00-08:00
# @Last modified time: 2019-11-11T21:01:21-08:00
session_start();

	include("connection.php");

	require("fpdf181/fpdf.php");
	
	$c=$_SESSION["course"];
	$d=$_SESSION["deptname"];
       
			 $result= mysqli_query($con,"SELECT * FROM co_po_correlation where course_id='$c'") or die (mysqli_error());
				


			 $result1= mysqli_query($con,"SELECT * FROM tbl_co where subject_id='$c'") or die (mysqli_error());
$k=mysqli_query($con,"SELECT * FROM subject_class where subjectid='".$c."'");
				
				 while($row=mysqli_fetch_array($k))
				{
					$a=$row["subject_title"];
				}

	$pdf=new FPDF('P','mm',array(250,250));
		$pdf->AddPage();



		$pdf->SetFont("Arial","B",22);
		

		$pdf->Cell(250,1,"Rajiv Gandhi Institute Of Technology",0,0,'C');

	  $pdf->Ln();
			$pdf->SetFont("Arial","",18);
			$pdf->Cell(250,20,"Govt. Engineering College,Kottayam-686501",0,0,'C');
         $pdf->Ln();
			$pdf->SetFont("Arial","",16);
			$pdf->Cell(250,8,"Dept of {$d}",0,0,'C');
		 $pdf->Ln();
		 
			$pdf->SetFont("Arial","",14);
			$pdf->Cell(250,9,"{$c}{$a}",0,0,'C');
		 $pdf->Ln();
						$pdf->SetFont("Arial","",14);

						$pdf->Cell(250,10,"CO PO Mapping",0,0,'C');

						$pdf->Ln();

						$pdf->SetFont("Arial","",9);
						//	$pdf->Cell(50,30,'Duration: 1:30 hr');
						//	$pdf->Cell(50,70,'Maximum Marks:30');
						$pdf->cell(20);

						$pdf->Cell(20,15,'CO CODE',1,0,'C'); // First header column
						$pdf->Cell(11,15,'PO1',1,0,'C'); // Second header column
						$pdf->Cell(11,15,'PO2',1,0,'C'); // Third header column

						$pdf->Cell(11,15,'PO3',1,0,'C'); // Second header column
						$pdf->Cell(11,15,'PO4',1,0,'C'); // Third header column

						$pdf->Cell(11,15,'PO5',1,0,'C'); // Third header column
						$pdf->Cell(11,15,'PO6',1,0,'C'); // Second header column
						$pdf->Cell(11,15,'PO7',1,0,'C'); // Third header column
						$pdf->Cell(11,15,'PO8',1,0,'C'); // Second header column
						$pdf->Cell(11,15,'PO9',1,0,'C'); // Third header column
						$pdf->Cell(11,15,'PO10',1,0,'C'); // Second header column
						$pdf->Cell(11,15,'PO11',1,0,'C'); // Third header column
						$pdf->Cell(11,15,'PO12',1,0,'C'); // Third header column
						$pdf->Cell(11,15,'PSO1',1,0,'C'); 
						$pdf->Cell(11,15,'PSO2',1,0,'C'); 
						$pdf->Cell(11,15,'PSO3',1,0,'C'); 
						$pdf->Cell(11,15,'PSO4',1,0,'C'); 


						$pdf->Ln();
$pdf->cell(20);
						while ($row= mysqli_fetch_array ($result) )
						{

						//$pdf->SetXY(72,10); //TO INDENT
						$pdf->SetFont("Arial","",10);
						

						$pdf->Cell(20,15,"{$row['co_code']}",1,0,'C');

						$pdf->Cell(11,15,"{$row['po1']}",1,0,'C');

						$pdf->Cell(11,15,"{$row['po2']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['po3']}",1,0,'C');

						$pdf->Cell(11,15,"{$row['po4']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['po5']}",1,0,'C');

						$pdf->Cell(11,15,"{$row['po6']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['po7']}",1,0,'C');

						$pdf->Cell(11,15,"{$row['po8']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['po9']}",1,0,'C');

						$pdf->Cell(11,15,"{$row['po10']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['po11']}",1,0,'C');

						$pdf->Cell(11,15,"{$row['po12']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['pso1']}",1,0,'C');
						
						$pdf->Cell(11,15,"{$row['pso2']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['pso3']}",1,0,'C');
						$pdf->Cell(11,15,"{$row['pso4']}",1,0,'C');


						$pdf->Ln();
						$pdf->cell(20);


						}


							$pdf->Cell(20,15,"{$c}",1,0,'C');

						 	$pdf->Cell(11,15,"{$_SESSION['po1']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po2']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po3']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po4']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po5']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po6']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po7']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po8']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po9']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po10']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po11']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['po12']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['pso1']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['pso2']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['pso3']}",1,0,'C');
							$pdf->Cell(11,15,"{$_SESSION['pso4']}",1,0,'C');
                                
						$pdf->Ln();
						
											
						
					$pdf->SetFont("Arial","",14);
			$pdf->Cell(250,9,"{$row['co_code']}",0,0,'C');
		 $pdf->Ln();
		 	$pdf->AddPage();
						$pdf->SetFont("Arial","",14);

						$pdf->Cell(250,10,"Course Outcomes",0,0,'C');
				$pdf->Ln();
						$pdf->Ln();

						$pdf->SetFont("Arial","",9);
						//	$pdf->Cell(50,30,'Duration: 1:30 hr');
						//	$pdf->Cell(50,70,'Maximum Marks:30');
						$pdf->cell(80);

						$pdf->Cell(20,10,'CO ',1,0,'C'); // First header column
						$pdf->Cell(70,10,'CO Description',1,0,'C'); // Second header column

						$pdf->Ln();


$pdf->cell(80);
						while ($row= mysqli_fetch_array ($result1) )
						{

						//$pdf->SetXY(72,10); //TO INDENT
						$pdf->SetFont("Arial","",10);


						$pdf->Cell(20,10,"{$row['co_code']}",1,0,'C');

						$pdf->Cell(70,10,"{$row['co_name']}",1,0,'C');


										$pdf->Ln();
						$pdf->cell(80);
						}
  		$pdf->Output();

?>