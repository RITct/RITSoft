<?php
session_start();
include("includes/connection.php");
  if(isset($_POST['submit2']))
  {
	//include('select.php');
 // include('clear.php');
  	$_POST['name']=" ";
  	$_POST['adm']="";
  	$_POST['branch']="";
  	$_POST['sem']="";
  	$_POST['year']='';
  	$_POST['purpose']="";
  	echo "<script language='JavaScript' type='text/JavaScript'>
  	<!--
  	window.location='index.php';
//-->
  	</script>
  	";
  }
  
  else
  {
  	$rcpt_no=0;
  	if( $_SESSION['name']==""||$_SESSION['adm']==""||$_SESSION['year']==""||
  		$_SESSION['purpose']=="")
  	{
  		echo '<script language="javascript">';
  		echo 'alert("Please enter fields")';

  		echo '</script>'; 
  		echo "<script language='JavaScript' type='text/JavaScript'>
  		<!--
  		window.location='index.php';
//-->
  		</script>
  		";

  	}



  	else
  	{

//page for creating pdf document
  		require('mc_table.php');
 //creating object and opening functions 
  		$pdf=new PDF_HTML();
  		$pdf->PDF('L','mm','A4');
  		$pdf->AliasNbPages();
  		$pdf->SetAutoPageBreak(true, 15);
  		$pdf->AddPage();
  		$pdf->SetFont('Times','B',9); 
//receiving values from student certificate form
  		if($_SESSION['name']=='')
  		{
  			echo '<script language="javascript">';
  			echo 'alert("Please enter Name")';

  		}
  		else
  		{
  			$name=$_SESSION['name'];
  			$name=strtoupper($name);

  			$len=strlen($name);

  		}

  		if($_SESSION['adm']=='')
  		{
  			echo '<script language="javascript">';
  			echo 'alert("Please enter Admission Number")';

  		}
  		else
  		{
  			$adm=$_SESSION['adm'];
  		}



  		$branch="";
  		$branch=$_SESSION['spec'];
  		$branch=strtoupper($branch);

  		$sem=$_SESSION['sem'];

  		$sem_no=substr($sem,-1);
  		if($sem=='S10')
  		{
  			$sem_no=substr($sem,-2);
  		}
  		if($sem_no=='1')
  		{
  			$upper='st';
  		}
  		else if($sem_no=='2')
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

  		if($_SESSION['purpose']=='')
  		{
  			echo '<script language="javascript">';
  			echo 'alert("Please enter Purpose")';

  		}
  		else
  		{
  			$purpose=$_SESSION['purpose'];
  		}
  		$slname="";
  		$d=date("d/m/Y");
  		$course="";
  		$course=$_SESSION['courseid'];
  		if($_SESSION['dtype']=='principal')
  		{
  			$issued='Principal';
  		}
  		else if($_SESSION['dtype']=='ugdean')
  		{
  			$issued='UG Dean';

  		}
  		else if($_SESSION['dtype']=='pgdean')
  		{
  			$issued='PG Dean';

  		}
  		else if($_SESSION['dtype']=='hod')
  		{
  			$issued='Head Of The Department';

  		}

 // $no=$_POST['No'];
  		$spec="";
  		$spec=$_SESSION['spec'];
  		$spec=strtoupper($spec);
  		if($spec=='(CHOOSE SPECIALIZATION)')
  		{
  			if($course="MCA")
  			{
  				$spec=" ";
  			}
  			$spec="";
  		}
  		else
  			{$branch=" ";
  	}
  	if($course=='M.TECH'||$course=='MCA'||$course=='B.ARCH')
  	{
  		$slname=$course;
  		$branch="";
  	}
  	else
  	{
  		if($branch=='CIVIL ENGINEERING')
  		{
  			$slname='CE';
  		}
  		else if($branch=='MECHANICAL ENGINEERING')
  			$slname='ME';
  		else if($branch=='ELECTRONICS AND ELECTRICAL ENGINEERING')
  			$slname='EEE';
  		else if($branch=='COMPUTER SCIENCE & ENGINEERING')
  			$slname='CSE';
  		else if($branch=='ELECTRONICS & COMMUNICATION ENGINEERING')
  			$slname='ECE';
  	}
 //code for fetching serial number from database
  	include('includes/connection1.php');
  	$sl_no='';

//$d_id="";

  	$rcpt_no=$_POST['no'];	
  	if($course=='B.TECH')
  	{
  		$sql="select d.classid from class_details d where  d.courseid='$course' and d.branch_or_specialisation='$branch'";
  		$result=  mysql_query($sql);
  		while($db_field=mysql_fetch_assoc($result))
  		{ 

	//$rcpt_no=$db_field['rcpt_no'];
  			$d_id=$db_field['classid'];
	//echo $a1;
  		}


	//$rcpt_no=str_pad($rcpt_no+1,3,0,STR_PAD_LEFT);

  	}
  	else if($course=='MCA'||$course=='B.ARCH')
  	{
  		$branch="";
  		$sql="select d.classid from class_details d where  d.courseid='$course'";;
  		$result=  mysql_query($sql);
  		while($db_field=mysql_fetch_assoc($result))
  		{ 

	//$rcpt_no=$db_field['rcpt_no'];
  			$d_id=$db_field['classid'];
	//echo $a1;
  		}

  	}
  	else if($course=='M.TECH')
  	{
  		$sql="select d.classid from class_details d where  d.courseid='$course' and d.branch_or_specialisation='$spec'";
  		$result=  mysql_query($sql);
  		while($db_field=mysql_fetch_assoc($result))
  		{ 

	//$rcpt_no=$db_field['rcpt_no'];
  			$d_id=$db_field['classid'];
  			echo $d_id;
  		}

  	}



  	$sql2="insert into serial_no values(null,5,$rcpt_no,$adm)";
  	$result=mysql_query($sql2);	

 //$sql="i"; 
  //$s=date("d-m-Y",strtotime($d));

 //$p=wordwrap($purpose,8,"\n",true);
 //setting pdf documents contents
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
 //ENLARGES THE FIRST LETTER OF NAME)
 /*
  $pdf->SetFont('Times','BI',14);
  $x=0;
  for($i=0;$i<$len;$i++)
  {
	  if($i==0)
	  {
	  $pdf->SetFont('Times','BI',17);
	   $pdf->Text(150-1,70,$name[$i]);
	  }
	  else
	  {
		  if($name[$i]==" ")
		  {$x=$x+10;
		   $pdf->Text(150+$x+4,70,$name[$i]." ");
			  $pdf->SetFont('Times','BI',17);
	  $pdf->Text(150+$x,70,$name[$i+1]);
	  $i=$i+1;
		  }
		  else
		  {
		  $x=$x+3.9;
		   $pdf->SetFont('Times','BI',11);
	   $pdf->Text(150+$x,70,$name[$i]);
		  }
		  if($i==$len-1)
		  {
			  $pdf->SetFont('Times','BI',12);
	   $pdf->Text(150+$x+10,70,"(Admission NO:".$adm.")");
		  }
		  
	  }
	} */
 //ENLARGE COURSE AND SEMESTER INFO

//$pdf->Text(180,90,$var);
  //$pdf->Text(180,70,$name);
	$pdf->SetDash(1,1);
	$pdf->Line(145,70,290,70);
	$pdf->SetFont('Times','BI',10);
	$pdf->Text(90,80,"is a bonafide student of");
	$pdf->SetFont('Times','BI',11);

	$pdf->Text(126,80,$sem_no."   SEMESTER ".$course."  ".$branch.$spec);
	$pdf->setLeftMargin(127);
	$pdf->subWrite(133,$upper,10);
//$pdf->Write(90,$upper);

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
//$pdf->SetXY(101,101);
//$x=GetX();
	$pdf->SetFont('Times','BI',12);
	$pdf->setLeftMargin(99);
	$pdf->Write(7,$purpose);
	$pdf->SetDash(1,1);
	$pdf->Line(95,108,290,108);
 //$pdf->MultiCell(15,6,$purpose,0,'',0,1,'','L',true);
//$pdf->MultiCell(1,5,$branch,0,'j',false);
//$pdf->Cell(50, 10,$p, 0, 0, 'L');
//$pdf->Write(50, 10,$purpose, 0, 0, 'L');
 //$pdf->Text(110,110,"  ................................................................................................................... ");
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
	
	if($spec!="")
	{
		$pdf->SetFont('Times','B',10);
		$pdf->Text(1,100,"Branch :");

		$pdf->SetFont('Times','B',6.5);
		$pdf->Text(15,100,$spec);
	}
//	$pdf->setLeftMargin(90);
//$pdf->Write(1,$branch);
	$pdf->SetFont('Times','B',10);
	$pdf->Text(1,110,"Period :".$year);
	$pdf->Text(1,140,"Date:".$d);
	$pdf->SetFont('Times','BI',11);
	$pdf->Text(42,140,$issued);

	// $htmlTable='<TABLE>
//<TR>
//<TD></TD></TABLE>';
//$pdf->WriteHTML2("<br><br><br>$htmlTable");
	//$Y_Fields_Name_position = 20;
//Table position, under Fields Name
//$Y_Table_Position = 26;

			//$pdf=new PDF_MC_Table();
//$pdf->AddPage();
	$pdf->SetDash(1,1);
	$pdf->Line(83,1,83,200);
//$pdf->LineGraph(190,100);
//$pdf->subWrite(8,'H',33);
//$pdf->Write(10,'ello world');
//$pdf->Line($xOfTheStart,$yOfTheStart,$xOfTheEnd,$yOfTheEnd);
//$pdf->Line(50,50,80,80);
//$strf=$name;
//$strf=strtoupper($strf);
//$pdf->Write(30,$strf);
//$pdf->SetFontSize(25);
//$strfnew=preg_replace("/[a-z]+/e","strtoupper('')",$strf);
//$strf=strtoupper($strf);
//$pdf->Write(10,$strf[1].$strfnew[0]);
//$pdf->Write(30,$strf,$strfnew);
	$pdf->Output();
}
}

?>


