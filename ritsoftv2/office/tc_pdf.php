<?php
// For Transfer Certificate PDF generation.//
	//To fetch data from database automatically.
if(isset($_POST['submit']))
{
	$tc_no=$_POST['tc_no'];
	$adno=$_POST['adno'];
	$name=$_POST['name'];
	$dob=$_POST['dob'];
	$caste=$_POST['caste'];
	$todays_date=date('Y-m-d');
	$dte=$_POST['dte'];
	$class=$_POST['class'];
	$leaving=$_POST['leaving'];
	$relive=$_POST['relive'];
	$higher=$_POST['higher'];
	$fee=$_POST['fee'];
	$concession=$_POST['concession'];
	$application=$_POST['application'];
	$issue=$_POST['issue'];
	$reason=$_POST['reason'];
	$institution=$_POST['institution'];
	$classid=$_POST['classid'];
	$studid=$_POST['studid'];
	$rollno=$_POST['rollno'];
	//link for connection.php
	include "includes/dboperation.php";

         	 // $q10="";
	                               //date of birth in words

                                $obj12=new dboperation();
				$query12="select date_to_words('".$dob."')";		
				$result12=$obj12->selectdata($query12);
				$row=$obj12->fetch($result12);
				$dobwords=$row[0];
 
//should be removed after correcting stored procedure....
				$dobwords=$_POST['dobw'];

				
				//check whether student in current class
	                       // $obj13=new dboperation();			
				//$query13="select * from current_class where studid='$admno'";		
				//$result13=$obj13->selectdata($query13);
				//$row1=$obj13->fetch($result13);
				//$num=mysql_num_rows($result13);
				$resul=mysql_query("select * from current_class where studid='$adno'");

                                




	//Insert tc details into table 'tc'.
	$obj=new dboperation();
	$q="INSERT INTO `tc` (`tc_no`, `adm_no`, `tc_date`, `reason`) VALUES ('$tc_no', '$adno', '$issue', '$reason')";
	$obj->Ex_query($q);

	//Update table 'stud_details'.
	$objtc=new dboperation();
	$qtc="UPDATE `stud_details` SET exit_sem='$relive' WHERE `admissionno`='$adno'";
	$objtc->Ex_query($qtc); 

	//Update table 'stud_details'.
	$objstat=new dboperation();
	$qstat="UPDATE `stud_details` SET status='Completed' WHERE `admissionno`='$adno'";
	$objstat->Ex_query($qstat); 
	
	if(mysql_num_rows($resul)==1)
	{
$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
	$r=mysql_fetch_assoc($l);
	$acd_year=$r["acd_year"];
	//Insert old class details into table 'current_classold' after generate TC.
	$objold=new dboperation();
	$qold="INSERT INTO `current_classold` (`classid`, `studid`, `rollno`, `year`) VALUES ('$classid', '$studid', '$rollno', '$acd_year')";
	$objold->Ex_query($qold);

	//2. archiving sessional marks	
	
	//$resq1=mysql_query("select * from sessional_marks where studid='$adno'");	
	if(mysql_num_rows($resq1)>0)
	{
         mysql_query("insert into sessional_marksold(classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,acd_year) select classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,'$acd_year' from sessional_marks where studid='$adno'") or die(mysql_error());
           }
	
//3. archiving series exam marks
$resq1=mysql_query("select * from each_sessional_marks where studid='$adno'");	
	if(mysql_num_rows($resq1)>0)
	{
            mysql_query("insert into each_sessional_marksold(series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,acd_year) select series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,'$acd_year' from each_sessional_marks where studid='$adno'") or die(mysql_error());
}
		
//4. archiving attendance
$resq1=mysql_query("select * from attendance where studid='$adno'");	
	if(mysql_num_rows($resq1)>0)
	{
   mysql_query("insert into attendanceold(attid,date,hour,subjectid,classid,studid,status,acd_year) select attid,date,hour,subjectid,classid,studid,status,'$acd_year' from attendance where studid='$adno'") or die(mysql_error());
		}				
//5. archiving elective
$resq1=mysql_query("select * from elective_student where studid='$adno'");	
	if(mysql_num_rows($resq1)>0)
	{
  mysql_query("insert into elective_studentold(sub_code,stud_id,acd_year,classid) select sub_code,stud_id,'$acd_year','$classid' from elective_student where stud_id='$adno'") or die(mysql_error());
			}	
				
//6. archiving lab student details
$resq1=mysql_query("select * from lab_batch_student where studid='$adno'");	
	if(mysql_num_rows($resq1)>0)
	{
  mysql_query("insert into lab_batch_studentold(studid,batch_id,acd_year,classid) select studid,batch_id,'$acd_year','$classid' from lab_batch_student where studid='$adno'") or die(mysql_error());
}
//7. archiving duty leave
$resq1=mysql_query("select * from duty_leave where studid='$adno'");	
	if(mysql_num_rows($resq1)>0)
	{
  mysql_query("insert into duty_leaveold(id,studid,subjectid,leave_date,hour,remark,date,acd_year,classid) select id,studid,subjectid,leave_date,hour,remark,date,'$acd_year','$classid' from duty_leave where studid='$adno'") or die(mysql_error());
				
		}		
		//deleteing details from main table		
		
			
mysql_query("delete from attendance where studid='$adno'") or die(mysql_error());
mysql_query("delete from sessional_marks where studid='$adno'") or die(mysql_error());
mysql_query("delete from each_sessional_marks where studid='$adno'") or die(mysql_error());
mysql_query("delete from elective_student where stud_id='$adno'") or die(mysql_error());
mysql_query("delete from lab_batch_student where studid='$adno'") or die(mysql_error());
mysql_query("delete from duty_leave where studid='$adno'") or die(mysql_error());
	
	
/**/
	
	}

	//Delete class details from table 'current_class' after generate TC.
	$objclz=new dboperation();
	$qclz="DELETE  FROM `current_class` WHERE `studid`='$adno'";
	$objclz->Ex_query($qclz);
	
	//Delete login details from table 'login' after generate TC.
	$objlog=new dboperation();
	$qlog= "DELETE  FROM `login` WHERE `username`='$adno'";
	$objlog->Ex_query($qlog);
        //Changing date format
$source = $issue;
$date1 = new DateTime($source);
$issue= $date1->format('d-m-Y');

$source = $application;
$date1 = new DateTime($source);
$application= $date1->format('d-m-Y');

$source = $leaving;
$date1 = new DateTime($source);
$leaving= $date1->format('d-m-Y');

$source = $dob;
$date1 = new DateTime($source);
$dob= $date1->format('d-m-Y');


	require('mc_table.php');
	//Transfer Certificate PDF generation. 
	$pdf=new PDF_HTML();
	$pdf->PDF('P','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	//Set college details.
	$pdf->Image('images/frame1.jpg', 0, 0, $pdf->w, $pdf->h);
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','B',18); 
	$pdf->Text(38,46,"RAJIV GANDHI INSTITUTE OF TECHNOLOGY");
	$pdf->SetTextColor(200,0,0);
	$pdf->SetFont('Arial','',14);
	$pdf->Text(40,52,"(Department of Technical Education, Government of Kerala)");
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','',12);
	$pdf->Text(39,57,"Govt. Engineering College, Vellore (P.O), Pampady, Kottayam - 686501");
	$pdf->Text(65,62,"Ph: 0481-2507763/2506153, Fax:0481 - 2506153");
	$pdf->Text(75,67,"Email: info@rit.ac.in, Web:www.rit.ac.in");

	$pdf->AddFont('OldeEnglish-Regular','','OLDE ENGLISH REGULAR.php');
	$pdf->SetFont('OldeEnglish-Regular','',35);
	$pdf->Text(65,87,"Transfer Certificate");

	$pdf->SetTextColor(255,0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Text(20,77,"TC No : ".$tc_no);
	//Set student details.
	$pdf->Text(150,77,"Admission No : ".$adno);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','',10);

	$pdf->Text(27,103,"1. Name of student");
	$pdf->Text(100,103,": ".$name);

	$pdf->Text(27,113,"2. Date of birth");
	$pdf->Text(100,113,": ".$dob);
        
        $pdf->Text(100,124,"(".$dobwords.")");


	$pdf->Text(27,133,"3. Caste and religion");
	$pdf->Text(100,133,": ".$caste);

	$pdf->Text(27,143,"4. Date of admission");
	$pdf->Text(100,143,": ".$dte);

	$pdf->Text(27,153,"5. Class to which admitted");
	$pdf->Text(100,153,": ".$class);

	$pdf->Text(27,163,"6. Date of leaving");
	$pdf->Text(100,163,": ".$leaving);

	$pdf->Text(27,173,"7. Class from which relieved");
	$pdf->Text(100,173,": ".$relive);

	$pdf->Text(27,183,"8. Whether qualified for promotion to");
	$pdf->Text(32,188,"   higher class");
	$pdf->Text(100,183,": ".$higher);

	$pdf->Text(27,193,"9. Whether all fees and other dues");
	$pdf->Text(33,198,"have been paid");
	$pdf->Text(100,193,": ".$fee);

	$pdf->Text(27,203,"10. Whether the student was receipt");
	$pdf->Text(33,208,"of fee concession");
	$pdf->Text(100,203,": ".$concession);

	$pdf->Text(27,213,"11. Date of application of TC");
	$pdf->Text(100,213,": ".$application);

	$pdf->Text(27,223,"12. Date of issue of TC");
	$pdf->Text(100,223,": ".$issue);

	$pdf->Text(27,233,"13. Reason for leaving");
	$pdf->Text(100,233,": ".$reason);

	$pdf->Text(27,243,"14. Institution to which the student");
	$pdf->Text(33,248,"intends proceeding");
	$pdf->Text(100,243,": ".$institution);

	$issuedate=date('d-m-Y');	 

	$pdf->Text(30,260,"Verified By");
	$pdf->Text(30,270,"Clerk");
	$pdf->Text(70,270,"Superintendent");
	$pdf->Text(30,278,"Date : ".$issue);
	$pdf->Text(150,280,"Principal");
	//Print TC
	$pdf->Output();
}
?>