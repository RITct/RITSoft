<?php



	require("fpdf.php");

       $sql=mysqli_connect("localhost","root","","ritsoft");
	   session_start();
     $course_code="";
	 $se="";
	 $thr="";
	 $n="";
	 $per="";
	 if(isset($_SESSION['cid']))
{

	 $course_code=$_SESSION['cid'];
}
else
{$course_code=0;}
if(isset($_SESSION['se']))
{


 $se=$_SESSION['se'];
}else
{$se=0;}

if(isset($_SESSION['thr']))
{

$thr=$_SESSION['thr'];
}
else
{$thr=0;}
if(isset($_SESSION['$per']))
{

$per=$_SESSION['$per'];
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



$c=0;
$m=0;
$y=0;
$y1=0;
 $result1= mysqli_query($sql,"select * from ical_table WHERE subjectid='$course_code'") or die (mysqli_error());



 $pdf=new FPDF('P','mm',array(300,300));
	 $pdf->AddPage();
	 $pdf->SetFont("Arial","B",22);

	 $pdf->Cell(250,5,"Rajiv Gandhi Institute Of Technology",0,0,'C');

	 $pdf->Ln();
		 $pdf->SetFont("Arial","",10);
		 $pdf->Cell(250,20,"Govt. Engineering College,Kottayam-686501",0,0,'C');
					 $pdf->Ln();

					 $pdf->SetFont("Arial","",18);

		 $pdf->SetFont("Arial","",10);
		 //$pdf->Cell(50,30,'Duration: 1:30 hr');
		 //$pdf->Cell(50,70,'Maximum Marks:30');
	 $pdf->Cell(70);

	 //$pdf->Cell(20,10,'Question No',0,0,'C'); // First header column
 //	$pdf->Cell(20,10,'Question',0,0,'C'); // Second header column


$pdf->Ln();
  $n=mysqli_num_rows($result1);
//	$pdf->Cell(20,10,"{$n}",0,0,'C');
		 while ($row= mysqli_fetch_array ($result1) )
	 {
		 $pdf->Ln();
		$c= $row['tot'];


		 //$pdf->SetXY(72,10); //TO INDENT
		 $pdf->SetFont("Arial","",10);

		 $pdf->Cell(20,10,"{$row['co_code']}",0,0,'C');

$pdf->Ln();
		$pdf->Cell(250,10,"Test={$row['series_no']}  Thershold={$row['threshold']}  No: of students={$row['tot']}+{$row['absenties']} absentees",1,0,'C');
		$pdf->Ln();
		$pdf->Cell(150,10,'',1,0,'C');
		$pdf->Cell(50,10,'Not Acceptable range',1,0,'C');$pdf->Cell(50,10,'Acceptable range',1,0,'C');
		$pdf->Ln();
		$pdf->Cell(150,20,'Number of students who scored marks in the range',1,0,'C');

		$pdf->Cell(50,10,"Mark:<{$row['threshold']}",1,0,'C');

		$pdf->Cell(50,10,"Mark:>{$row['threshold']}",1,0,'C');
$pdf->Ln();
		$pdf->Cell(150,10,' ',0,0,0);
		$pdf->Cell(50,10,"{$row['atnd']}",1,0,'C');
		$pdf->Cell(50,10,"{$row['abs']}",1,0,'C');
		$pdf->Ln();
		$pdf->Cell(250,10,"Attainment Level in Percentage={$row['per']}%",1,0,'C');

$pdf->Ln();
}
//

//$pdf->Cell(50,10,"Mark:<{$thr}",1,0,'C');

//$pdf->Cell(50,10,"Mark:>{$thr}",1,0,'C');
//$pdf->SetXY(160,85);
//$pdf->Cell(50,10,"{$attainstudno}",1,0,'C');
//$pdf->Cell(50,10,"{$noattain}",1,0,'C');
//$pdf->Ln();
////$pdf->Cell(250,10,"Attainment Level in Percentage={$per}%",1,0,'C');

		//$pdf->SetFont("Arial","",10);
		//	$pdf->Cell(250,30," ",0,0,'C');
      //      $pdf->Ln();

		//$pdf->Cell(70,10,'CO',1,0,'C'); // First header column
		//$pdf->Cell(70,10,'Description',1,0); // Second header column





  		$pdf->Output();

?>
