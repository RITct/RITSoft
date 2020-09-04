<?php



	require("fpdf.php");

       $sql=mysqli_connect("localhost","root","","ritsoft");
	   session_start();
     $course_code="";
	 $se="";
	 $thr="";
	 $per="";
	 if(isset($_SESSION['cid']))
{

	 $course_code=$_SESSION['cid'];
}
else
{$course_code=0;}
if(isset($_SESSION['tot']))
{


 $tot=$_SESSION['tot'];
}else
{$tot=0;}

if(isset($_SESSION['st']))
{

$st=$_SESSION['st'];
}
else
{$st=0;}
if(isset($_SESSION['percent']))
{

$per=$_SESSION['percent'];
}
else
{$per=0;}
if(isset($_SESSION['attainstud']))
{

$attainstudno=$_SESSION['attainstud'];
}
else
{$attainstudno=0;}
if(isset($_SESSION['noattain']))
{

$noattain=$_SESSION['noattain'];
}
else
{$noattain=0;}




	$pdf=new FPDF('P','mm',array(300,300));
		$pdf->AddPage();
		$pdf->SetFont("Arial","B",22);

		$pdf->Cell(250,5,"Rajiv Gandhi Institute Of Technology",0,0,'C');

	  $pdf->Ln();
			$pdf->SetFont("Arial","",10);
			$pdf->Cell(250,20,"Govt. Engineering College,Kottayam-686501",0,0,'C');
            $pdf->Ln();

						$pdf->SetFont("Arial","",18);

						$pdf->Cell(250,20,"I_CALCULATION",0,0,'C');

						$pdf->Ln();
			$pdf->SetFont("Arial","",10);
			//$pdf->Cell(50,30,'Duration: 1:30 hr');
			//$pdf->Cell(50,70,'Maximum Marks:30');
		//$pdf->Cell(70);




		$pdf->Cell(250,10,"Normalized Internal Marks:  Maximum Marks= {$tot}  No: of students={$st}",1,0,'C');


$pdf->Ln();
$pdf->SetXY(10,65);
if(isset($_SESSION['d']))
{
	$m='';
$d=$_SESSION['d'];
$pdf->Cell("{$d}",10,'',1,0,'C');
$c=250-$d;
$m=$_SESSION['m'];
$m1=$m;
$m2=$m;
while($m>0)
{
$pdf->Cell("{$d}",10,'Acceptable range',1,0,'C');
$m=$m-1;
}
$pdf->Ln();

$pdf->SetXY(10,75);
$pdf->Cell("{$d}",20,'No: of students who ',1,0,0);
for($i=0;$i<$m1;$i++)
{
	if(isset($_SESSION['ar'][$i]))
			{

				$from= $_SESSION['ar'][$i];
			}
			else{
				$from=0;
			}
			if(isset($_SESSION['arr'][$i]))
			{

				$to= $_SESSION['arr'][$i];
			}
			else{
				$to=0;
			}
$pdf->Cell("{$d}",10,"mark {$from} : {$to}  to",1,0,'C');

}
$pdf->Ln();

$pdf->Cell("{$d}",10,'scored mark in a range',0,0,'C');

for($i=0;$i<$m2;$i++)
{
	if(isset($_SESSION['sum'][$i]))
			{

				$sum= $_SESSION['sum'][$i];
			}
			else{
				$sum=0;
			}
$pdf->Cell("{$d}",10,"{$sum}",1,0,'C');

}
$pdf->Ln();
$pdf->Cell(250,10,"Attainment Level in Percentage={$per}%",1,0,'C');
}



  		$pdf->Output();

?>
