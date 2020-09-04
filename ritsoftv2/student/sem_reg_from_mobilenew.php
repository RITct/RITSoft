<?php
// For Transfer Certificate PDF generation.//
	//To fetch data from database automatically.
// echo 'registration.php';
if(session_id() == '') {
session_start();
}







if( !isset($_POST['admission_no'])){
	echo "<script>window.location.href='semregpostnew.php'</script>";
	exit();
}

$name = $_POST['name'];
$branch = $_POST['branch'];
$class_id = $_POST['class_id'];
$rollno = $_POST['rollno'];
$admission_no = $_POST['admission_no'];
$year_of_admission = $_POST['year_of_admission'];
$promotion_class = $_POST['promotion_class'];
$last_class = $_POST['last_class'];
$discontinued_and_reason = $_POST['discontinued_and_reason']; //Period during which the study in the college was discontinued and reason there of
$registered_for_pre_semester  = $_POST['registered_for_pre_semester'];//Whether registered for pre-semester 
$subject_to_pass = $_POST['subject_to_pass'];// The subject in which you have to pass in respect of previous class
$fees_paid = $_POST['fees_paid'];// Whether fees has been paid for all instalments of previous semsters 
$eligible_fee_concession = $_POST['eligible_fee_concession'];//Whether eligible for fee concession if so with nature of concession 
$shortage_of_attendance = $_POST['shortage_of_attendance'];//Whether there was any shortage of attendance for any of the previous semester and whether condonation has been obtained 
$Present_residential_address  = $_POST['Present_residential_address'];//Present residential address for correspondence and phone no. 
$place = $_POST['place'];
$phone = $_POST['phone'];







require('mc_table.php');

$pdf=new PDF_HTML();
$pdf->PDF('P','mm','A4');


$pdf->SetAutoPageBreak(true, 0);

$pdf->AliasNbPages();
$pdf->AddPage();
	//Set college details.
// $pdf->Image('images/frame1.jpg', 0, 0, $pdf->w, $pdf->h);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',16); 
$pdf->Text(46,19,"RAJIV GANDHI INSTITUTE OF TECHNOLOGY");

$pdf->SetFont('Arial','',12);
$pdf->Text(60,25,"Govt. Engineering College, Kottayam - 686501");


$pdf->SetFont('Arial','B',13); 
$pdf->Text(66,34,"APPLICATION FOR PROMOTION ");


$pdf->SetFont('Arial','B',13); 
$pdf->Text(65,35,"_____________________________");



$tempH = 39.5;

$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'1.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Name of the student with admission No. and branch ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);




$pdf->SetTextColor(13, 27, 66);

$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5, $name . ',  ' . $admission_no . ', ' . $branch, 0 );




$tempH = $tempH + 12;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'2.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Year of first admission to this college  ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5,$year_of_admission ,0 );





$tempH = $tempH + 8;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'3.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Class to which promotion is sought for  ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5,' S' . $promotion_class,0 );




$tempH = $tempH + 8;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'4.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Class & Semester last studied with class number  ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5,' S' . $last_class . ', ' . $rollno ,0 );







$tempH = $tempH + 13;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'5.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Period during which the study in the college was discontinued and reason there of',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5, $discontinued_and_reason,0 );





$tempH = $tempH + 18;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'6.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Whether registered for pre-semester ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5, $registered_for_pre_semester  ,0 );





$tempH = $tempH + 8;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'7.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'The subject in which you have to pass in respect of previous class  ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5,$subject_to_pass  ,0);





$tempH = $tempH + 13;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'8.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Whether fees has been paid for all instalments of previous semesters  ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);


$pdf->SetTextColor(13, 27, 66);

$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5,$fees_paid ,0 );



$tempH = $tempH + 11;
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','B',14);
// $pdf->Cell(10,10,'9.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->Cell(70,5,' OR ',0,0,'C',0);
$pdf->SetXY(100,$tempH);
// $pdf->Cell(5,10,':',0,0,'R',0);





$tempH = $tempH + 8;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
// $pdf->Cell(10,10,'9.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Whether eligible for fee concession if so with nature of concession  ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5, $eligible_fee_concession ,0 );



$tempH = $tempH + 13;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'9.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Whether there was any shortage of attendance for any of the previous semester and whether condonation has been obtained ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5,$shortage_of_attendance ,0 );




$tempH = $tempH + 23;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'10.',0,0,'L',0);
$pdf->SetXY(30,($tempH + 2.5));
$pdf->MultiCell(70,5,'Present residential address for correspondence and phone no. ',0 );
$pdf->SetXY(100,$tempH);
$pdf->Cell(5,10,':',0,0,'R',0);



$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(110,($tempH + 2.5));
$pdf->MultiCell(75,5, $Present_residential_address . ',    ' . $phone  ,0 );





$tempH = $tempH + 25;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(165,5,'Certified that the particulars furnished above are true and I am willing to undergo any of punishment including expulsion from the college if it is found that any of the above statement is false. ',0);


$tempH = $tempH + 13;

$pdf->SetTextColor(0,0,0);

$pdf->SetXY(20,$tempH); 
$pdf->Cell(15,10,'Place',0,0,'L',0);
$pdf->SetXY(35,$tempH); 
$pdf->Cell(5,10,':',0,0,'L',0);


$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(40,$tempH); 
$pdf->Cell(30,10, $place ,0,0,'L',0);


$tempH = $tempH + 6;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH); 
$pdf->Cell(15,10,'Date',0,0,'L',0);
$pdf->SetXY(35,$tempH); 
$pdf->Cell(5,10,':',0,0,'L',0);

$pdf->SetTextColor(13, 27, 66);
$pdf->SetXY(40,$tempH); 
$pdf->Cell(30,10,date('d-m-Y') ,0,0,'L',0);


$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','I',10);
$pdf->SetXY(125,$tempH); 
$pdf->Cell(60,10,'Signature of the candidate ',0,0,'R',0);


$pdf->SetFont('Arial','',10);  

// $pdf->Ln(5);


$tempH = $tempH + 12	;

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',12);   
$pdf->Cell(165,5,'(FOR USE OF DEPARTMENT)  ',0,0,'C',0);

$tempH = $tempH + 5;

$pdf->SetXY(20,$tempH);
$pdf->SetFont('Arial','',10);   
$pdf->Cell(165,5,'Verified and recommended / not recommended   ',0,0,'C',0);



$tempH = $tempH + 10;


$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,$tempH); 
$pdf->Cell(20,10,'For Office use ',0,0,'L',0);

$pdf->SetXY(125,$tempH-2); 
$pdf->Cell(60,10,'HEAD OF DEPARTMENT  ',0,0,'R',0);

$pdf->SetXY(125,$tempH+2); 

$tempH = $tempH + 1;
$pdf->SetXY(20,$tempH); 
$pdf->Cell(20,10,'___________ ',0,0,'L',0);


$tempH = $tempH + 10;
$pdf->SetXY(40,$tempH); 
$pdf->MultiCell(110 ,7,'Particulars of column 8 & 9 verified and found correct / incorrect Promotion granted / not granted. ',0);



$tempH = $tempH + 15;


$pdf->SetXY(20,$tempH); 
$pdf->Cell(20,10,'For Library Use  ',0,0,'L',0);

$tempH = $tempH + 1;
$pdf->SetXY(20,$tempH); 
$pdf->Cell(20,10,'___________ ',0,0,'L',0);

$tempH = $tempH + 4;


$pdf->SetXY(20,$tempH); 
$pdf->Cell(20,10,'Dues  ',0,0,'L',0);

$pdf->SetXY(125,$tempH); 
$pdf->Cell(60,10,'PRINCIPAL  ',0,0,'R',0);


$file_name = "d.pdf";
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$file_name."\""); 

	//Print TC
$pdf->Output(' Semester Registration.pdf', 'D');




