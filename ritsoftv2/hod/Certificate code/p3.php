<?php
session_start();
$rcpt_no=0;
  	

  		  	$name=$_SESSION['name'];
  			$name=strtoupper($name);

  			//$len=strlen($name);

  		  	$adm=$_SESSION['admno'];
  		


  		  	$branch=$_SESSION['branch'];
  		//$branch=strtoupper($branch);

  		$sem=$_SESSION['semester'];

                 $sem_no=$_SESSION['semester'];
  		//$sem_no=substr($sem,-1);
  		/*if($sem=='S10')
  		{
  			$sem_no=substr($sem,-2);
  		}*/
  		if($sem_no==1)
  		{
  			$upper='st';
  		}
  		else if($sem_no==2)
  		{
  			$upper='nd';

  		}
  		else if($sem_no=='3')
  		{
  			$upper='rd';
  		}

  		else
  		{
  			$upper="th";
  		}
  		if($_SESSION['year']=='')
  		{
  			echo '<script language="javascript">';
  			echo 'alert("Please enter Academic Year")';

  		}
  		else
  		{
  			$year=$_SESSION['year'];
  		}

  		 $purpose=$_SESSION['purpose'];
  		
  		 $d=$_SESSION['date'];

//Changing date format
$source = $d;
$date1 = new DateTime($d);
$d= $date1->format('d-m-Y');

  		
  		$course=$_SESSION['course'];
                $issued='Head Of The Department';

//start: this not working.....

$slname="";


  	if($course === 'MTECH')       

//|| $course=='MCA'|| $course =='BARCH')
  	{
  		$slname=$course;
echo 'hi';

  		
  	}
  	else
  	{
  		if($branch == 'CIVIL ENGINEERING')
  		{
  			$slname='CE';
  		}
  		if($branch == 'MECHANICAL ENGINEERING')
  			$slname='ME';
  		if($branch == 'ELECTRONICS AND ELECTRICAL ENGINEERING')
  			$slname='EEE';
  		if($branch == 'COMPUTER SCIENCE & ENGINEERING')
  			$slname='CSE';
  		if($branch == 'ELECTRONICS & COMMUNICATION ENGINEERING')
  			$slname='ECE';
  	}
//end: upto this not working..............




  	include('includes/connection1.php');
  	
  	$rcpt_no=$_POST['no'];	
  	
require('mc_table.php'); 
  		$pdf=new PDF_HTML();
  		$pdf->PDF('L','mm','A4');
  		$pdf->AliasNbPages();
  		$pdf->SetAutoPageBreak(true, 15);
  		$pdf->AddPage();
  		$pdf->SetFont('Times','B',9); 
	
  	$purpose=ucfirst($purpose);
  	$pdf->Rect(88,2,206,180);
  	$pdf->Image("download.jpg",180,4,25,25);
  	$pdf->Text(175,35,"GOVERNMENT OF KERALA");
  	$pdf->SetFont('Times','B',12);

  	$pdf->Text(150,40,"RAJIV GANDHI INSTITUTE OF TECHNOLOGY ");
  	$pdf->SetFont('Times','B',10);
  	$pdf->Text(180,45,"KOTTAYAM-686501");
  	$pdf->Text(94,50,"No:RIT/".$course."/".$year."/".$rcpt_no);


  	$pdf->Image("download.jpg",25,4,25,25);
  	$pdf->SetFont('Times','B',8);
  	$pdf->Text(20,35,"GOVERNMENT OF KERALA");
  	$pdf->SetFont('Arial','B',10);

  	$pdf->Text(5,40,"Rajiv Gandhi Institute Of Technology");
  	$pdf->SetFont('Arial','B',8);
  	$pdf->Text(25,45,"KOTTAYAM-686501");
  	$pdf->Text(5,50,"No:RIT/".$course."/".$year."/".$rcpt_no);



  	$pdf->SetFont('Times','BI',18);
  	$pdf->Text(176,58,"CERTIFICATE ");

  	$pdf->SetFont('Times','BI',10);    
  	$pdf->Text(105,70,"Certified that Shri/Kumari ");
  	$pdf->SetFont('Times','BI',12);
  	$pdf->Text( 155,70,$name."          "."(Admission No:".$adm.")");  


	$pdf->SetDash(1,1);
	$pdf->Line(145,70,290,70);
	$pdf->SetFont('Times','BI',10);
	$pdf->Text(90,80,"is a bonafide student of");
	$pdf->SetFont('Times','BI',11);

	$pdf->Text(126,80,$sem."   SEMESTER ".$course."- ".$branch);
	$pdf->setLeftMargin(127);
	$pdf->subWrite(133,$upper,10);


	$pdf->SetDash(1,1);
	$pdf->Line(126,80,290,80);
	$pdf->SetFont('Times','BI',10); 
	$pdf->Text(90,90,"of this institution during the year ");
	$pdf->SetFont('Times','BI',14);
	$pdf->Text(180,90,$year);
	$pdf->SetDash(1,1);
	$pdf->Line(145,90,290,90);

	$pdf->SetFont('Times','BI',10);
	$pdf->Text(90,100,"This certificate is issued on his/her request for  ");
	$pdf->SetDash(1,1);
	$pdf->Line(162,100,290,100);
	$pdf->SetXY(172,95.5);

	$pdf->SetFont('Times','BI',12);
	$pdf->setLeftMargin(99);
	$pdf->Write(7,$purpose);
	$pdf->SetDash(1,1);
	$pdf->Line(95,108,290,108);

	$pdf->SetFont('Times','B',10);
	$pdf->Text(94,135,"Date:".$d);
	$pdf->Text(94,140,"Place:Pampady ");
	$pdf->SetFont('Times','BI',12);
	$pdf->Text(240,140,$issued);
	$pdf->SetFont('Times','B',10);
	$pdf->Text(1,60,"Name:".$name);
	$pdf->Text(1,70,"Admission Number :".$adm);
	$pdf->Text(1,80,"Semester : ".$sem);
	$pdf->Text(1,90,"Course :".$course);
	
	//if($spec!="")
	//{
		$pdf->SetFont('Times','B',10);
		$pdf->Text(1,100,"Branch :");

		$pdf->SetFont('Times','B',7);
		$pdf->Text(15,100,$branch);
	//}
	$pdf->SetFont('Times','B',10);
	$pdf->Text(1,110,"Period :".$year);
	$pdf->Text(1,140,"Date:".$d);
	$pdf->SetFont('Times','BI',11);
	$pdf->Text(42,140,$issued);

	$pdf->SetDash(1,1);
	$pdf->Line(83,1,83,200);
      $pdf->Output();

?>


