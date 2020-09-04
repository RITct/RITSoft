<?php
session_start();
//error_reporting(0);
ob_start();
 $tp_no = $_SESSION['temp'];

 $emailid=$_SESSION['emailid'];


include "dboperation.php";
$obj5=new dboperation();
$query5="SELECT * FROM temp WHERE temp_no = '$tp_no' and email='$emailid'"; 
$result5=$obj5->selectdata($query5);
while($row=$obj5->fetch($result5)) { 

// if( true) {
/*
	$row = '{"0":"50","temp_no":"50","1":"name how eokir","name":"name how eokir","2":"2018-07-31","dob":"2018-07-31","3":"O","gender":"O","4":"CHRISTIAN","religion":"CHRISTIAN","5":"Latin Catholics-OEC-ST","caste":"Latin Catholics-OEC-ST","6":"2018","year_of_admission":"2018","7":"dddd@sss","email":"dddd@sss","8":"1122112233","mobile_phno":"1122112233","9":"66776677885","land_phno":"66776677885","10":" sf sdferus slrs 3u4ehr ljfsiu 4rlsfdurlw8e3y4r fusdkjh \r\nser74 uhufjsdfhlsi8urowe8i7rhyworhsdfsdlfhslri uwe \r\nrsweiuhslfiud","address":" sf sdferu,s slrs 3u4ehr ljfsiu 4rlsfdurlw8e3y4r fusdk,jh \r\nser74 uhufjsdfhlsi8urowe8i7rhyworhsdfsdlfhslri uwe sf sdferus slrs 3u4ehr ljfsiu 4rlsfdurlw8e,3y4r fusdkjh \r\nser74 uhufjsdfhlsi8urowe8i7rh hslri uwe fusdkjh \r\nser74 uhufjsdfhlsi8urowe8i7rh hslri uwe \r\nrsweiuhslfiud","11":"22","rollno":"22","12":"33","rank":"33","13":"222","quota":"222","14":"name someting","school_1":"name someting","15":"1233333,2018","regno_1":"1233333,2018","16":"some name for testing","board_1":"some name for testing","17":"33","percentage_1":"33","18":"11111","school_2":"11111","19":"1111111,2018","regno_2":"1111111,2018","20":"1111111111","board_2":"1111111111","21":"33","percentage_2":"33","22":"3","no_chance1":"3","23":"BARCH","courseid":"BARCH","24":"ARCHITECTURE","branch_or_specialisation":"ARCHITECTURE","25":"","image":"","26":null,"gate_score":null,"27":"Lateral","admission_type":"Lateral","28":"1","entry_sem":"1","29":null,"exit_sem":null,"30":"B-","blood":"B-","31":"gfffd","name_guardian":"gfffd","32":"Grand Father","relation":"Grand Father","33":"dddddfff","occupation":"dddddfff","34":"454","income":"454","35":"3344334433","guard_contactno":"3344334433","36":"ssss@ddddd","guard_email":"ssss@ddddd","37":"33","physics":"33","38":"33","chemistry":"33","39":"33","maths":"33","40":"33","total_marks":"33","41":"33","percentage":"33","42":"","school_3":"","43":"","degree_course":"","44":"","degree_regno":"","45":"0","degree_marks":"0","46":null,"degree_percent":null,"47":"","board_3":"","48":"Submitted","status":"Submitted","49":"33","last_institution":"33"}';



	$row = json_decode($row, true);  

	
*/


	$co=$row['courseid'];
	$sp=$row['branch_or_specialisation'];
	$bc=$row['year_of_admission'];
	$todays_date=date("d-M-Y");
	$na=$row['name'];
	$db=$row['dob'];
	$source = $row["dob"];
	$date1 = new DateTime($source);
	$dateins= $date1->format('d-m-Y');
	$db=$dateins;

	$sx=$row['gender'];
	$rlgn=$row['religion'];
	$cst=$row['caste'];
	$mob=$row['mobile_phno'];
	$mail=$row['email'];
	$nagd=$row['name_guardian'];
	$rel=$row['relation'];
	$occpn=$row['occupation'];
	$inc=$row['income'];
	$adrs=$row['address'];
	$phno=$row['land_phno'];
	$csem=$row['entry_sem'];
	$rlno=$row['rollno'];
	$rnk=$row['rank'];
	$qta=$row['quota'];
	$scl1=$row['school_1'];
	$rgno1=$row['regno_1'];
	$brd1=$row['board_1'];
	$scl2=$row['school_2'];
	$rgno2=$row['regno_2'];
	$brd2=$row['board_2'];
	$scl3=$row['school_3'];
	$rgno3=$row['degree_regno'];
	$brd3=$row['board_3'];
	$chnc=$row['no_chance1'];
	$nalast=$row['last_institution'];
	$tot=$row['total_marks'];
	$phy=$row['physics'];
	$chem=$row['chemistry'];
	$math=$row['maths'];
	$bld=$row['blood'];
	$gate=$row['gate_score'];
	$ug_mark=$row['degree_marks'];

        $ug_per_cgpa=$row['degree_percent'];
	$gmob=$row['guard_contactno'];
	$gemail=$row['guard_email'];
	$admtype=$row['admission_type'];
	$tcno=$row['tc_no_adm'];
	$tcdate=$row['tc_date_adm'];
	$datetc = new DateTime($tcdate);
	$tcdate= $datetc->format('d-m-Y');
	
	
	

}
require('mc_table.php');
// $co="MCA";
$pdf=new PDF_HTML();
$pdf->PDF('P','mm','A4');
$pdf->AliasNbPages();
//$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();
$pdf->Image('images/rcrd.jpg', 0, 0, $pdf->w, $pdf->h);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',12); 
$pdf->Text(60,25,"RAJIV GANDHI INSTITUTE OF TECHNOLOGY");
$pdf->SetFont('Arial','B',10); 
$pdf->Text(88,30,"ADMISSION DETAILS");

$pdf->SetFont('Arial','B',8); 
$pdf->Text(18,35,"PERSONAL DATA");

$pdf->SetFont('Times','',10);
$pdf->Text(20,40,"Temporary No and Date:     ".$tp_no." , ".$todays_date);
$pdf->SetFont('Times','',9);

$pdf->Text(175,42,"Affix Photo");
$pdf->SetFont('Times','',10); 

$pdf->Text(20,45,"1. Name of candidate");
$pdf->Text(100,45,": ".$na);

$pdf->Text(20,50,"2. Date of Birth in Christian Era");
$pdf->Text(100,50,": ".$db);

$pdf->Text(20,55,"3. Gender");
$pdf->Text(100,55,": ".$sx);

$pdf->Text(20,60,"4. Blood Group");
$pdf->Text(100,60,": ".$bld);

$pdf->Text(20,65,"5. Religion / Caste");
$pdf->Text(100,65,": ".$rlgn." / ".$cst);

$pdf->Text(20,70,"6. Email Address and Mobile No.");
$pdf->Text(100,70,": ".$mail.",".$mob);

$pdf->Text(23,75,"(a)  Name of Parent/Guardian");
$pdf->Text(100,75,": ".$nagd);

$hrefY = 80;
$pdf->Text(23,80,"(b)  Permanent address of Parent/Guardian");


/* ==================================================*/
$lineBreak = 60; /*==== 300 uh okay 200 great =======*/
/* ==================================================*/



 $adrs = strtolower($adrs);

$adrs = ucwords($adrs);

$adrs = str_replace("/\n"," ",$adrs);
$adrs = str_replace("#\s+#"," ",$adrs);

$adrs = str_replace(",",", ",$adrs);
$adrs = str_replace(".",". ",$adrs);


$addArr  = explode(" " , $adrs);
$lineArr = array();
$len = 0;
$eachline = '';
foreach ($addArr as $key => $value) {  
	$tmpln = strlen($value); 
	$len += $tmpln; 
	if($len >= $lineBreak){  
		array_push($lineArr, $eachline);
		$eachline = '';
		$len = $tmpln;
	} 
	if( $tmpln ){
		if($tmpln >= $lineBreak ){
			$ty = str_split($value ,$lineBreak);
			foreach ($ty as $keya => $valuea) {
				if(strlen($valuea) > 0 ){ 
					if($keya == (sizeof($ty) -1 )){
						$eachline .= ' ' . $valuea; 						
						$len =  strlen($valuea);
					} else {
						array_push($lineArr, $valuea);
					}
				}
			}
		} else {
			$eachline .= ' ' . $value; 
		}
	}
}

if(strlen($eachline) > 0){
	array_push($lineArr, $eachline); 
}
foreach ($lineArr as $key => $value) {  
	if($key == 0) 
		$pdf->Text(100,$hrefY, ": ".$value);	
	else
		$pdf->Text(100,$hrefY, "  ".$value);	


	$hrefY +=4;

}


// $pdf->Text(100,$hrefY,": ".$adrs);


$hrefY +=3;
$pdf->Text(28,$hrefY,"Email Address and Mobile No.");
$pdf->Text(100,$hrefY,": ".$gmob.", ".$gemail);

$hrefY +=5;
$pdf->Text(28,$hrefY,"Telephone No");
$pdf->Text(100,$hrefY,": ".$phno);

$hrefY +=5;
$pdf->Text(23,$hrefY,"(c)  Relation with the pupil");
$pdf->Text(100,$hrefY,": ".$rel);

$hrefY +=5;
$pdf->Text(23,$hrefY,"(d)  Annual income of Parent/Guardian");
$pdf->Text(100,$hrefY,": ".$inc);

$hrefY +=5;
$pdf->SetFont('Arial','B',8); 
$pdf->Text(18,$hrefY,"ALLOTMENT DETAILS");

$hrefY +=5;
$pdf->SetFont('Times','',10);
$pdf->Text(23,$hrefY,"(a) Course / Specialisation");
$pdf->Text(100,$hrefY,": ".$co." / ".$sp);

$hrefY +=5;
$pdf->Text(23,$hrefY,"(b) Entrance Roll No");
$pdf->Text(100,$hrefY,": ".$rlno);

$hrefY +=5;
$pdf->Text(23,$hrefY,"(c) Entrance Rank");
$pdf->Text(100,$hrefY,": ".$rnk);

$hrefY +=5;
$pdf->Text(23,$hrefY,"(d) Quota and Admission Type");
$pdf->Text(100,$hrefY,": ".$qta.", ".$admtype);


if($co == 'BTECH' || $co =='BARCH') {
	$hrefY +=5;

// $pdf->Text(23,130,"(e) Gate score");
	$pdf->SetFont('Arial','B',8); 
	$pdf->Text(18,$hrefY,"ACADEMIC DATA");

	$hrefY +=5;
	$pdf->SetFont('Times','',10);
	$pdf->Text(20,$hrefY,"8. (a)  Name of institution studied (SSLC)");
	$pdf->Text(100,$hrefY,": ".$scl1);

	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(b)  Reg. No. and year of passing the exam");
	$pdf->Text(100,$hrefY,": ".$rgno1);
	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(c)  Name of the Board / university");
	$pdf->Text(100,$hrefY,": ".$brd1);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"9. (a)  Name of institution (qualifying exam)");
	$pdf->Text(100,$hrefY,": ".$scl2);
	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(b)  Reg. No. and year of passing the exam");
	$pdf->Text(100,$hrefY,": ".$rgno2);
	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(c)  Name of the Board / university");
	$pdf->Text(100,$hrefY,": ".$brd2);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"10. No. of chances for qualifying exam");
	$pdf->Text(100,$hrefY,": ".$chnc);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"11. Name of Institution last studied");
	$pdf->Text(100,$hrefY,": ".$nalast);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"12. No. and date of TC received");
	$pdf->Text(100,$hrefY,": ".$tcno.", ".$tcdate);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"13. Total marks obtained for the qualifying exam");
	$pdf->Text(100,$hrefY,": ".$tot);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"14. Marks obtained for");
	$hrefY +=5;
	$pdf->Text(25,$hrefY,"(a) Physics");
	$pdf->Text(45,$hrefY,": ".$phy);
	$pdf->Text(60,$hrefY,"(b) Chemistry");
	$pdf->Text(85,$hrefY,": ".$chem);
	$pdf->Text(95,$hrefY,"(c) Mathematics");
	$pdf->Text(120,$hrefY,": ".$math);

	$hrefY +=5; 
	$pdf->SetFont('Arial','B',8); 
	$pdf->Text(90,$hrefY,"DECLARATION");
	$pdf->SetFont('Times','',10);
	$hrefY +=5; 
	$pdf->Text(50,$hrefY,"The information given above are true in the best of my knowledge and belief.");

	$hrefY +=9;
	$pdf->Text(20,$hrefY,"Signature of parent/guardian");
	$pdf->Text(140,$hrefY,"Signature of student");

	$hrefY +=5; 
	$pdf->Text(75,$hrefY,"DETAILS OF DOCUMENTS ATTACHED");

	$hrefY +=7;
	$pdf->Text(20,$hrefY,"1. SSLC/SSC pass certificate / marks statement & proof of Date of Birth.");
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"2. PDC / +2 / VHSE /DIPLOMA pass certificate / marks statement.");
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"3. Transfer certificate and conduct certificate.");
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"4. Medical certificate");
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"5. Selection Memo.");

	$hrefY -=20;
	$pdf->Text(135,$hrefY,"6.  Admit Card(Hall ticket).");
	$hrefY +=5;
	$pdf->Text(135,$hrefY,"7.  Mark list.");
	$hrefY +=5;
	$pdf->Text(135,$hrefY,"8.  Fee Recipient (from bank).");
	$hrefY +=5;
	$pdf->Text(135,$hrefY,"9.  Migration certificate");
	$hrefY +=5;
	$pdf->Text(135,$hrefY,"10. Affidavit by the Student & Parent.");

	$pdf->SetFont('Times','',9);
	$hrefY +=5;
	$pdf->Text(25,$hrefY,"The candidates are directed to keep with them, attested true copies of certificates and other relevant records before");
	$hrefY +=5;
	$pdf->Text(25,$hrefY,"submitting for admission.");

	$pdf->SetFont('Arial','B',8); 
	$hrefY +=5;
	$pdf->Text(90,$hrefY,"FOR OFFICE USE ONLY");
	$pdf->SetFont('Times','',10);
	$hrefY +=8;
	$pdf->Text(35,$hreY,"Admission No.");
	$hrefY +=0;
	$pdf->Text(145,$hrefY,"Fee Receipt No.");
	$hrefY +=5;
	$pdf->Text(90,$hrefY,"May be admitted");
	$hrefY +=8;
	$pdf->Text(35,$hrefY,"Signature of the verifier");
	$hrefY +=0;
	$pdf->Text(145,$hrefY,"Principal");
}

//if($co == 'BARCH') 
//{

// $pdf->Text(23,130,"(d)  Gate score");
	//$pdf->SetFont('Arial','B',8); 
	//$pdf->Text(18,135,"ACADEMIC DATA");

	//$pdf->SetFont('Times','',10);
	//$pdf->Text(20,140,"8. (a)  Name of institution studied at SSLC");
	//$pdf->Text(100,140,": ".$scl1);

	//$pdf->Text(23,145,"(b)  Reg. No. and year of passing the exam");
	//$pdf->Text(100,145,": ".$rgno1);

	//$pdf->Text(23,150,"(c)  Name of the Board / university");
	//$pdf->Text(100,150,": ".$brd1);

	//$pdf->Text(20,155,"9. (a)  Name of institution of qualifying exam passed");
	//$pdf->Text(100,155,": ".$scl2);

	//$pdf->Text(23,160,"(b)  Reg. No. and year of passing the exam");
	//$pdf->Text(100,160,": ".$rgno2);

	//$pdf->Text(23,165,"(c)  Name of the Board / university");
	//$pdf->Text(100,165,": ".$brd2);

	//$pdf->Text(20,170,"10. No. of chances for qualifying exam");
	//$pdf->Text(100,170,": ".$chnc);

	//$pdf->Text(20,175,"11. Name of Institution last studied");
	//$pdf->Text(100,175,": ".$nalast);

	//$pdf->Text(20,180,"12. Total marks obtained for the qualifying exam");
	//$pdf->Text(100,180,": ".$tot);

	//$pdf->Text(20,185,"13. Marks obtained for  (a)  Physics");
	//$pdf->Text(100,185,": ".$phy);

	//$pdf->Text(51,190,"(b)  Chemistry");
	//$pdf->Text(100,190,": ".$chem);

	//$pdf->Text(51,195,"(c)  Mathematics");
	//$pdf->Text(100,195,": ".$math);


	//$pdf->SetFont('Arial','B',8); 
	//$pdf->Text(90,200,"DECLARATION");
	//$pdf->SetFont('Times','',10);
	//$pdf->Text(50,205,"The information given above are true in the best of my knowledge and belief.");
	//$pdf->Text(20,210,"Signature of parent/guardian");
	//$pdf->Text(140,210,"Signature of student");

	//$pdf->Text(75,215,"DETAILES OF DOCUMENTS ATTACHED");

	//$pdf->Text(20,222,"1. SSLC/SSC pass certificate / marks statement & proof of Date of Birth.");
	//$pdf->Text(20,227,"2. PDC / +2 / VHSE /DIPLOMA pass certificate / marks statement.");
	//$pdf->Text(20,232,"3. Transfer certificate and conduct certificate.");
	//$pdf->Text(20,237,"4. Medical certificate");
	//$pdf->Text(20,242,"5. Selection Memo.");

	//$pdf->Text(125,222,"6. Admit Card(Hall ticket).");
	//$pdf->Text(125,227,"7. Mark list.");
	//$pdf->Text(125,232,"8. Fee Recipient (from bank).");
	//$pdf->Text(125,237,"9. Migration certificate");
	//$pdf->Text(125,242,"10. Affidavit by the Student & Parent.");
	//$pdf->Text(35,247,"The candidates are directed to keep with them, attested true copies of certificates and other relevant records before");
	//$pdf->Text(20,252,"submitting for admission.");

	//$pdf->SetFont('Arial','B',8); 
	//$pdf->Text(90,257,"FOR OFFICE USE ONLY");
	//$pdf->SetFont('Times','',10);
	//$pdf->Text(35,265,"Admission No.");
	//$pdf->Text(145,265,"Fee Receipt No.");

	//$pdf->Text(90,270,"May be admitted");

	//$pdf->Text(35,282,"Signature of the verifier");
	//$pdf->Text(145,282,"Principal");
//}
if($co == 'MTECH' || $co=='MCA')  {

	$hrefY +=5;

	if($co == 'MTECH') {
		$pdf->Text(23,$hrefY,"(e)  Gate score");
		$pdf->Text(100,$hrefY,": ".$gate);
	}

	$hrefY +=5;

	$pdf->SetFont('Arial','B',8); 
	$pdf->Text(18,$hrefY,"ACADEMIC DATA");
	$hrefY +=5;
	$pdf->SetFont('Times','',10);
	$pdf->Text(20,$hrefY,"8. (a)  Name of institution studied (SSLC)");
	$pdf->Text(100,$hrefY,": ".$scl1);
	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(b)  Reg. No. and year of passing the exam");
	$pdf->Text(100,$hrefY,": ".$rgno1);
	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(c)  Name of the Board / university");
	$pdf->Text(100,$hrefY,": ".$brd1);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"9. (a)  Name of institution (qualifying exam passed)");
	$pdf->Text(100,$hrefY,": ".$scl3);
	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(b)  Reg. No. and year of passing the exam");
	$pdf->Text(100,$hrefY,": ".$rgno3);
	$hrefY +=5;
	$pdf->Text(23,$hrefY,"(c)  Name of the Board / university");
	$pdf->Text(100,$hrefY,": ".$brd3);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"10. No. of chances for qualifying exam");
	$pdf->Text(100,$hrefY,": ".$chnc);
	$hrefY +=5;
	$pdf->Text(20,$hrefY,"11. Name of Institution last studied");
	$pdf->Text(100,$hrefY,": ".$nalast);
	$hrefY +=5;
        $pdf->Text(20,$hrefY,"12. No. and date of TC received");
	$pdf->Text(100,$hrefY,": ".$tcno.", ".$tcdate);
	$hrefY +=5;

	$pdf->Text(20,$hrefY,"12. Percentage / CGPA obtained for the qualifying exam");
	$pdf->Text(100,$hrefY,": ".$ug_per_cgpa);

/* $pdf->Text(20,190,"13. Marks obtained for  (a)  Physics");
$pdf->Text(55,19,"(b)  Chemistry");
$pdf->Text(55,195,"(c)  Mathematics"); */	
$hrefY +=10;
$pdf->SetFont('Arial','B',8); 
$pdf->Text(90,$hrefY,"DECLARATION");
$pdf->SetFont('Times','',10);
$hrefY +=5; 
$pdf->Text(50,$hrefY,"The information given above are true in the best of my knowledge and belief.");
$hrefY +=10;
$pdf->Text(20,$hrefY,"Signature of parent/guardian");
$pdf->Text(140,$hrefY,"Signature of student");

$hrefY +=9; 
$pdf->Text(75,$hrefY,"DETAILS OF DOCUMENTS ATTACHED");

$hrefY +=5; 
$pdf->Text(20,$hrefY,"1. SSLC/SSC pass certificate / marks statement & proof of Date of Birth.");
$hrefY +=5; 
$pdf->Text(20,$hrefY,"2. PDC / +2 / VHSE /DIPLOMA pass certificate / marks statement.");
$hrefY +=5; 
$pdf->Text(20,$hrefY,"3. Transfer certificate and conduct certificate.");
$hrefY +=5; 
$pdf->Text(20,$hrefY,"4. Medical certificate");
$hrefY +=5; 
$pdf->Text(20,$hrefY,"5. Selection Memo.");

$hrefY -=20; 
$pdf->Text(135,$hrefY,"6. Admit Card(Hall ticket).");
$hrefY +=5; 
$pdf->Text(135,$hrefY,"7. Mark list.");
$hrefY +=5; 
$pdf->Text(135,$hrefY,"8. Fee Recipient (from bank).");
$hrefY +=5; 
$pdf->Text(135,$hrefY,"9. Migration certificate");
$hrefY +=5; 
$pdf->Text(135,$hrefY,"10. Affidavit by the Student & Parent.");
$hrefY +=5; 
$pdf->Text(25,$hrefY,"The candidates are directed to keep with them, attested true copies of certificates and other relevant records before");
$hrefY +=5; 
$pdf->Text(25,$hrefY,"submitting for admission.");


$pdf->SetFont('Arial','B',8); 
$hrefY +=5; 
$pdf->Text(90,$hrefY,"FOR OFFICE USE ONLY");
$pdf->SetFont('Times','',10);
$hrefY +=8; 
$pdf->Text(35,$hrefY,"Admission No.");
$hrefY +=0; 
$pdf->Text(145,$hrefY,"Fee Receipt No.");
$hrefY +=5; 
$pdf->Text(90,$hrefY,"May be admitted");
$hrefY +=8; 
$pdf->Text(35,$hrefY,"Signature of the verifier");
$hrefY +=0; 
$pdf->Text(145,$hrefY,"Principal");
}
//if($co == 'MCA') 
//{

// $pdf->Text(23,130,"(d)  Gate score");
	//$pdf->SetFont('Arial','B',8); 
	//$pdf->Text(18,135,"ACADEMIC DATA");

	//$pdf->SetFont('Times','',10);
	//$pdf->Text(20,140,"8. (a)  Name of institution studied at SSLC");
	//$pdf->Text(100,140,": ".$scl1);

	//$pdf->Text(23,145,"(b)  Reg. No. and year of passing the exam");
	//$pdf->Text(100,145,": ".$rgno1);

	//$pdf->Text(23,150,"(c)  Name of the Board / university");
	//$pdf->Text(100,150,": ".$brd1);

	//$pdf->Text(20,155,"9. (a)  Name of institution of qualifying exam passed");
	//$pdf->Text(100,155,": ".$scl3);

	//$pdf->Text(23,160,"(b)  Reg. No. and year of passing the exam");
	//$pdf->Text(100,160,": ".$rgno3);

	//$pdf->Text(23,165,"(c)  Name of the Board / university");
	//$pdf->Text(100,165,": ".$brd3);

	//$pdf->Text(20,170,"10. No. of chances for qualifying exam");
	//$pdf->Text(100,170,": ".$chnc);

	//$pdf->Text(20,175,"11. Name of Institution last studied");
	//$pdf->Text(100,175,": ".$nalast);

	//$pdf->Text(20,180,"12. Total marks obtained for the qualifying exam");
	//$pdf->Text(100,180,": ".$ug_mark);
/* $pdf->Text(20,185,"13. Marks obtained for  (a)  Physics");
$pdf->Text(51,190,"(b)  Chemistry");
$pdf->Text(51,195,"(c)  Mathematics"); 

$pdf->SetFont('Arial','B',8); 
$pdf->Text(90,185,"DECLARATION");
$pdf->SetFont('Times','',10);
$pdf->Text(50,190,"The information given above are true in the best of my knowledge and belief.");
$pdf->Text(20,195,"Signature of parent/guardian");
$pdf->Text(140,195,"Signature of student");

$pdf->Text(75,200,"DETAILES OF DOCUMENTS ATTACHED");

$pdf->Text(20,207,"1. SSLC/SSC pass certificate / marks statement & proof of Date of Birth.");
$pdf->Text(20,214,"2. PDC / +2 / VHSE /DIPLOMA pass certificate / marks statement.");
$pdf->Text(20,221,"3. Transfer certificate and conduct certificate.");
$pdf->Text(20,228,"4. Medical certificate"); 
$pdf->Text(20,235,"5. Selection Memo.");

$pdf->Text(125,207,"6. Admit Card(Hall ticket).");
$pdf->Text(125,214,"7. Mark list.");
$pdf->Text(125,221,"8. Fee Recipient (from bank).");
$pdf->Text(125,228,"9. Migration certificate");
$pdf->Text(125,235,"10. Affidavit by the Student & Parent.");
$pdf->Text(35,240,"The candidates are directed to keep with them, attested true copies of certificates and other relevant records before");
$pdf->Text(20,245,"submitting for admission.");

$pdf->SetFont('Arial','B',8); 
$pdf->Text(90,250,"FOR OFFICE USE ONLY");
$pdf->SetFont('Times','',10);
$pdf->Text(35,258,"Admission No.");
$pdf->Text(145,258,"Fee Receipt No.");

$pdf->Text(90,263,"May be admitted");

$pdf->Text(35,275,"Signature of the verifier");
$pdf->Text(145,275,"Principal");
}*/



/*$pdf->SetTextColor(0,0,255);


$issuedate=date('Y-m-d');  
 

 */






//$pdf->Image("logo.png",25,5);





//$pdf->SetFont('Times','B',14);


 // $pdf->SetDash(2,2);
//$pdf->Line(165,70,250,70);
 // $pdf->SetFont('Times','BI',10);
 //$pdf->Text(100,80,"is a bonafide student of ");
// $pdf->SetFont('Times','BI',14);
//  $pdf->Text(180,80,$branch." ".$sem);



//$pdf->Line(172,100,270,100);
//$pdf->SetXY(172,95.5);
//$pdf->SetXY(101,101);
//$x=GetX();
//$pdf->SetFont('Times','BI',14);
//$pdf->setLeftMargin(99);
//$pdf->Write(7,$purpose);
// ................................................................................................................... ");

  // $htmlTable='<TABLE>
//<TR>
//<TD></TD></TABLE>';
//$pdf->WriteHTML2("<br><br><br>$htmlTable");
  //$Y_Fields_Name_position = 20;
//Table position, under Fields Name
//$Y_Table_Position = 26;

      //$pdf=new PDF_MC_Table();
//$pdf->AddPage();
//$pdf->SetDash(2,2);
//$pdf->Line(85,1,85,200);
//$pdf->LineGraph(190,100);

// $pdf->Output("TC\\TC_".$adno.".pdf",'F');

//unset($_SESSION['acc']);
$pdf->Output();
unset($_SESSION['acc']);
   // header("location: ".$index.php);
?>




