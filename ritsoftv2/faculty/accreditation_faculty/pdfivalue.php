<?php



	require("fpdf.php");
  $sql=mysqli_connect("localhost","root","","ritsoft");
session_start();
  $pdf=new FPDF('P','mm',array(300,300));
 	 $pdf->AddPage();
 	 $pdf->SetFont("Arial","B",22);

 	 $pdf->Cell(250,5,"Rajiv Gandhi Institute Of Technology",0,0,'C');

 	 $pdf->Ln(); $pdf->Ln(); $pdf->Ln(); $pdf->Ln();
		 $pdf->SetFont("Arial","",10);
   $pdf->Cell(30,30,"Course Outcome",1,0,'C');
   $pdf->Cell(170,20,'Attainment level in percentage',1,0,'C');
   $pdf->Cell(40,30,'Attainment in percentage',1,0,'C');
   $pdf->Cell(40,30,'Attainment Goal',1,0,'C');
$pdf->SetXY(40,50);
   $pdf->Cell(20,10,"Data1",1,0,'C');
      $pdf->Cell(20,10,"Data2",1,0,'C');
         $pdf->Cell(20,10,"Data3",1,0,'C');
            $pdf->Cell(20,10,"Data4",1,0,'C');
               $pdf->Cell(50,10,"Data5",1,0,'C');
                  $pdf->Cell(20,10,"Rubrics",1,0,'C');
                     $pdf->Cell(20,10,"IAT",1,0,'C');
										 $pdf->SetXY(250,50);
                      $pdf->Cell(20,10,"70%",0,0,'C');
     $pdf->SetXY(10,60);


     //$course_code=$_SESSION['id'];
     $d1=$_SESSION['data1array'];
     $d2=$_SESSION['data2array'];
     $d3=$_SESSION['data3array'];
     $d4=$_SESSION['data4array'];
     $d5=$_SESSION['surveyval'];
$s=[];
	$Ifinal=0;
$n=0;
$z=0;
$y=1;
$count=5;
$ival=0.0;
$totalattainmnt=[];
     	$crsid=$_SESSION['course'];
 $result= mysqli_query($sql,"SELECT * FROM tbl_co WHERE subjectid='$crsid' ") or die (mysqli_error());
	$i=0;
	$querys="SELECT * FROM tbl_co WHERE subjectid='$crsid' ";
	$results=mysqli_query($sql,$querys);
	$rows=mysqli_fetch_array($results);
	array_push($s,$rows['co_code']);
 $n= mysqli_num_rows($result);
 $z=$n;
 $n=$n-$n+1;
 while($row= mysqli_fetch_array ($result))
 {

$pdf->Cell(30,20,"{$row['co_code']}",1,0,'C');



 $result1=mysqli_query($sql,"SELECT * FROM internal WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' AND test_no='1' ");
 $row1=mysqli_fetch_array($result1);
 $a=$row1['attainmnt_percent'];
 $pdf->Cell(20,20,"{$a}",1,0,'C');
 $result2=mysqli_query($sql,"SELECT * FROM assignment WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' ");
  $row2=mysqli_fetch_array($result2);
$b=$row2['attainmnt_percent'];
 $pdf->Cell(20,20,"{$b}",1,0,'C');
 $result3=mysqli_query($sql,"SELECT * FROM normalized_internal_attainment WHERE subjectid='$crsid' ");
  $row3=mysqli_fetch_array($result3);
  $ce=$row3['attainmnt_percent'];
  $pdf->Cell(20,20,"{$ce}",1,0,'C');
  $result4=mysqli_query($sql,"SELECT * FROM internal WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' AND test_no='2' ");
  $row4=mysqli_fetch_array($result4);
$d=$row4['attainmnt_percent'];
$pdf->Cell(20,20,"{$d}",1,0,'C');
  $result5=mysqli_query($sql,"SELECT * FROM survey_attainment WHERE subjectid='$crsid' AND co_code='".$row['co_code']."' ");
  $row5=mysqli_fetch_array($result5);
  $e=$row5['attainmnt_percent'];
// $m=( ($a * isset($_SESSION['data1array'][$i]))/100 + ($b * isset($d2[$i])) /100 + ($ce * isset($d3[$i])) /100 +( $d* isset($d4[$i])) /100 +($e * $d5) /100 );
foreach($s as $key=>$value)
{
$m= ( $a * $d1[$key]) /100 + ($b * $d2[$key]) /100 + ($ce * $d3[$key]) /100 +($d * $d4[$key]) /100 +($e * $d5) /100;
$totalattainmnt[$key]=$m;
}


    $pdf->Cell(50,20,"Marks in External Range",1,0,'C');



  $pdf->Cell(20,20,"X",1,0,'C');
  $pdf->Cell(20,20,"{$e}",1,0,'C');
	 $pdf->Cell(40,20,"{$totalattainmnt[$key]}",1,0,'C');
	 $ival=$ival+$totalattainmnt[$key];
	 if($totalattainmnt[$key]>=70)
	 {
	 $pdf->Cell(40,20,"YES ",1,0,'C');
	 }
	 else
	 {
	 $pdf->Cell(40,20,"NO ",1,0,'C');
	 }
$pdf->Ln();
}

if(isset($ivalue)>=70)
{
$Ifinal=3;
}
elseif(isset($ivalue)>=60)
{
$Ifinal=2;
}
else
{
$Ifinal=1;
}

 $pdf->Cell(280,10,"I= {$Ifinal}",1,0,'C');

  		$pdf->Output();

 //echo $ivalue;
 ?>







     /






?>
