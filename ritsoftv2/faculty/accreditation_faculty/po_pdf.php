<?php
# @Date:   2019-09-30T13:21:00-07:00
# @Last modified time: 2019-11-10T22:17:01-08:00

	include("connection.php");
	require("fpdf181/fpdf.php");

	class ConductPDF extends FPDF {
function vcell($c_width,$c_height,$x_axis,$text){
$w_w=$c_height/4;
$w_w_1=$w_w+2;
$w_w1=$w_w+$w_w+$w_w+3;
$w_w2=$w_w+$w_w+$w_w+$w_w+$w_w+3;
$w_w3=$w_w+$w_w+$w_w+$w_w+$w_w+$w_w+$w_w+3;
$len=strlen($text);// check the length of the cell and splits the text into 7 character each and saves in a array 

$lengthToSplit = 78;
if($len>$lengthToSplit){
$w_text=str_split($text,$lengthToSplit);
$this->SetX($x_axis);
$this->Cell($c_width,$w_w_1,$w_text[0],'','','');
if(isset($w_text[1])) {
    $this->SetX($x_axis);
    $this->Cell($c_width,$w_w1,$w_text[1],'','','');
}
if(isset($w_text[2])) {
    $this->SetX($x_axis);
    $this->Cell($c_width,$w_w2,$w_text[2],'','','');
}
if(isset($w_text[3])) {
    $this->SetX($x_axis);
    $this->Cell($c_width,$w_w3,$w_text[3],'','','');
}
$this->SetX($x_axis);
$this->Cell($c_width,$c_height,'','LTRB',0,'L',0);
}
else{
    $this->SetX($x_axis);
    $this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);
	}
    }
 }
	
$pdf = new ConductPDF('P','mm',array(300,300));
	
      
	$result= mysqli_query($con,"SELECT * FROM tbl_po ORDER BY po_code") or die (mysqli_error());

	//$pdf=new FPDF('P','mm',array(300,300));
		$pdf->AddPage();
		$pdf->SetFont("Arial","B",22);

			

		$pdf->Cell(250,1,"Rajiv Gandhi Institute Of Technology",0,0,'C');

	  $pdf->Ln();
			$pdf->SetFont("Arial","",18);
			$pdf->Cell(250,25,"Govt. Engineering College,Kottayam-686501",0,0,'C');
         $pdf->Ln();
			
						$pdf->SetFont("Arial","",14);

						$pdf->Cell(250,10,"PROGRAM OUTCOMES",0,0,'C');

						$pdf->Ln();
			$pdf->SetFont("Arial","",10);
		//	$pdf->Cell(50,30,'Duration: 1:30 hr');
		//	$pdf->Cell(50,70,'Maximum Marks:30');
		//$pdf->cell(20);
		$c_width=50;
		$c_height=25;
		

		$pdf->Cell($c_width,20,'PO CODE',1,0,'C'); 
		

		$pdf->Cell(70,20,'PO NAME',1,0,'C');


		$pdf->Cell(140,20,'PO DESCRIPTION',1,0,'C'); // Third header column

$pdf->Ln();
//$pdf->cell(20);
$x_axis=$pdf->getx();
//$pdf->Ln();
			while ($row= mysqli_fetch_array ($result) )
		{
			$pdf->cell(20);
			//$pdf->SetXY(72,10); //TO INDENT
			$pdf->SetFont("Arial","",10);

			$pdf->vcell($c_width,$c_height,$x_axis,"{$row['po_code']}");
			
$x_axis=$pdf->getx();

			$pdf->vcell(70,$c_height,$x_axis,"{$row['po_name']}");

$x_axis=$pdf->getx();

			$pdf->vcell(140,$c_height,$x_axis,"{$row['po_description']}");
			

   $pdf->Ln();
   $x_axis=$pdf->getx();
   //$pdf->Ln();
$pdf->cell(20);
		}

  		$pdf->Output();

?>
