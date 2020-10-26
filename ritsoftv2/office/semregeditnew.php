<?php

/**
 * @Author: indran
 * @Date:   2018-07-02 22:25:42
 * @Last Modified by:   indran
 * @Last Modified time: 2018-08-15 17:09:12
 */
?>


<form method="post" id="form1" action="sem_verificationnew.php">
	<input type="hidden" name="classid" value="<?php echo $classid ?>">
</form>
<script type="text/javascript">
	function redirect()
	{
		
		document.getElementById('form1').submit();
	}
</script>

<?php
include_once("../connection.php");

if(isset($_POST['bulk'])){
	if($_POST['bulk'] == true){


		function doActionNow( $arry){
			// var_dump($arry);
			// echo "<br>";



			$reg_id = $arry['id1']; 
			$id2 = $arry['id2']; 
			$classid=$arry["id3"];

			if($id2==1) {
				$x="Approved by office";
				mysql_query("UPDATE stud_sem_registration SET apl_status='Approved',apv_status='$x',remarks='' WHERE reg_id='$reg_id'")or die(mysql_error());
		//archiving data
				$l=mysql_query("select * from stud_sem_registration where apl_status='Approved' and reg_id='$reg_id'")or die(mysql_error());

				$r=mysql_fetch_assoc($l); 
				$classid=$r['classid'];
				$new_sem=$r["new_sem"];
				$studid=$r["adm_no"];
                               mysql_query("UPDATE notification SET status=0 where rec_id='$studid'")or die(mysql_error());
				$l1=mysql_query("select courseid,branch_or_specialisation from class_details where classid='$classid'")or die(mysql_error());

				$r1=mysql_fetch_assoc($l1); 
				$branch_or_specialisation=$r1["branch_or_specialisation"];
				$courseid=$r1["courseid"];

				$l2=mysql_query("select classid from class_details where courseid='$courseid' and branch_or_specialisation ='$branch_or_specialisation' and semid='$new_sem'")or die(mysql_error());
				$r2=mysql_fetch_assoc($l2); 
				$newclassid=$r2["classid"];
				$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
				$r=mysql_fetch_assoc($l);
				$acd_year=$r["acd_year"];
				$cur=explode('-',$acd_year);
				
				$y1= $cur[0]-1;
				$y2= $cur[1]-1;

				$acd_year=$y1."-".$y2;

//1. archiving current class details

				mysql_query("insert into current_classold(classid,studid,rollno,year) select classid,studid,rollno,'$acd_year' from current_class_semreg where classid='$classid' and studid='$studid'") or die(mysql_error());
				
//2. archiving sessional marks		
          // mysql_query("insert into sessional_marksold(classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,acd_year) select classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,'$acd_year' from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
	
//3. archiving series exam marks
           //  mysql_query("insert into each_sessional_marksold(series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,acd_year) select series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,'$acd_year' from each_sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());

				
//4. archiving attendance
  // mysql_query("insert into attendanceold(attid,date,hour,subjectid,classid,studid,status,acd_year) select attid,date,hour,subjectid,classid,studid,status,'$acd_year' from attendance where classid='$classid' and studid='$studid'") or die(mysql_error());
				
//5. archiving elective
 // mysql_query("insert into elective_studentold(sub_code,stud_id,acd_year,classid) select sub_code,stud_id,'$acd_year','$classid' from elective_student where stud_id='$studid'") or die(mysql_error());
				
				
//6. archiving lab student details
 // mysql_query("insert into lab_batch_studentold(studid,batch_id,acd_year,classid) select studid,batch_id,'$acd_year','$classid' from lab_batch_student where studid='$studid'") or die(mysql_error());

//7. archiving duty leave

 // mysql_query("insert into duty_leaveold(id,studid,subjectid,leave_date,hour,remark,date,acd_year,classid) select id,studid,subjectid,leave_date,hour,remark,date,'$acd_year','$classid' from duty_leave where studid='$studid'") or die(mysql_error());
				
				
		//deleteing details from main table		
		
				
//mysql_query("delete from attendance where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from each_sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from elective_student where stud_id='$studid'") or die(mysql_error());
//mysql_query("delete from lab_batch_student where studid='$studid'") or die(mysql_error());
//mysql_query("delete from duty_leave where studid='$studid'") or die(mysql_error());
	
				
				
				
			//update current class of students
				
				//mysql_query("delete from stud_sem_registration where classid='$classid' and adm_no='$studid'and reg_id='$reg_id'") or die(mysql_error());
                               // mysql_query("update current_class set classid='$newclassid', adm_status = 'APPROVED' where classid='$classid' and studid='$studid'") or die(mysql_error());

           mysql_query("update current_class set adm_status = 'APPROVED' where classid='$newclassid' and studid='$studid'") or die(mysql_error());
           mysql_query("update current_class_semreg set classid='$newclassid', adm_status = 'APPROVED' where classid='$classid' and studid='$studid'") or die(mysql_error());

			}  
		}














		if(isset($_POST['id1'])){
			foreach ($_POST['id1'] as $key => $value) {
				if (isset($_POST['action'][$key])) {
					
					$now = array( 
						'id1' => $_POST['id1'][$key],
						'id2' => $_POST['id2'][$key],
						'id3' => $_POST['id3'][$key],
						'action' => $_POST['action'][$key],

					); 
					if ($now['action'] == 1) {
						
						doActionNow($now);
					}

				}
			} 
		}

		echo "<script>redirect()</script>";
		exit();
	}
}



?><?php 
//used for automatic data fetching from database
if (isset($_POST["classid"])) 
{
	$classid=$_POST["classid"];
}
if (isset($_GET["id3"]))
{
	$classid=$_GET["id3"];
}

?>

<?php 
//updating stud_sem_registration
if(isset($_POST["btn_send"])!=null)
{
	$reg_id=$_POST["reg_id"];
	$remarks=$_POST["remarks"];
	$x="Rejected by office";
	mysql_query("UPDATE stud_sem_registration SET apv_status='$x',remarks='$remarks' WHERE reg_id='$reg_id'")or die(mysql_error());
	echo "<script>redirect()</script>";
}
else
{
	$reg_id = $_GET['id']; 
	$id2 = $_GET['id2']; 
	if($id2==1)
	{
		$x="Approved by office";
		mysql_query("UPDATE stud_sem_registration SET apl_status='Approved',apv_status='$x',remarks='' WHERE reg_id='$reg_id'")or die(mysql_error());
		//archiving data
		$l=mysql_query("select * from stud_sem_registration where apl_status='Approved' and reg_id='$reg_id'")or die(mysql_error());

		$r=mysql_fetch_assoc($l); 
		$classid=$r['classid'];
		$new_sem=$r["new_sem"];
		$studid=$r["adm_no"];
                mysql_query("UPDATE notification SET status=0 where rec_id='$studid'")or die(mysql_error());

		$l1=mysql_query("select courseid,branch_or_specialisation from class_details where classid='$classid'")or die(mysql_error());

		$r1=mysql_fetch_assoc($l1); 
		$branch_or_specialisation=$r1["branch_or_specialisation"];
		$courseid=$r1["courseid"];

		$l2=mysql_query("select classid from class_details where courseid='$courseid' and branch_or_specialisation ='$branch_or_specialisation' and semid='$new_sem'")or die(mysql_error());
		$r2=mysql_fetch_assoc($l2); 
		$newclassid=$r2["classid"];
		$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
		$r=mysql_fetch_assoc($l);
		$acd_year=$r["acd_year"];

		$cur=explode('-',$acd_year);
		
		$y1= $cur[0]-1;
		$y2= $cur[1]-1;

		$acd_year=$y1."-".$y2;
//**

		//1. archiving current class details

				mysql_query("insert into current_classold(classid,studid,rollno,year) select classid,studid,rollno,'$acd_year' from current_class_semreg where classid='$classid' and studid='$studid'") or die(mysql_error());
				
//2. archiving sessional marks		
          // mysql_query("insert into sessional_marksold(classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,acd_year) select classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,'$acd_year' from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
	
//3. archiving series exam marks
          //   mysql_query("insert into each_sessional_marksold(series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,acd_year) select series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,'$acd_year' from each_sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());

				
//4. archiving attendance
  // mysql_query("insert into attendanceold(attid,date,hour,subjectid,classid,studid,status,acd_year) select attid,date,hour,subjectid,classid,studid,status,'$acd_year' from attendance where classid='$classid' and studid='$studid'") or die(mysql_error());
				
//5. archiving elective
 // mysql_query("insert into elective_studentold(sub_code,stud_id,acd_year,classid) select sub_code,stud_id,'$acd_year','$classid' from elective_student where stud_id='$studid'") or die(mysql_error());
				
				
//6. archiving lab student details
 // mysql_query("insert into lab_batch_studentold(studid,batch_id,acd_year,classid) select studid,batch_id,'$acd_year','$classid' from lab_batch_student where studid='$studid'") or die(mysql_error());

//7. archiving duty leave

 // mysql_query("insert into duty_leaveold(id,studid,subjectid,leave_date,hour,remark,date,acd_year,classid) select id,studid,subjectid,leave_date,hour,remark,date,'$acd_year','$classid' from duty_leave where studid='$studid'") or die(mysql_error());
				
				
		//deleteing details from main table		
		
				
//mysql_query("delete from attendance where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from each_sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from elective_student where stud_id='$studid'") or die(mysql_error());
//mysql_query("delete from lab_batch_student where studid='$studid'") or die(mysql_error());
//mysql_query("delete from duty_leave where studid='$studid'") or die(mysql_error());
	
				
				
				
			//update current class of students
			
 //mysql_query("update current_class set classid='$newclassid', adm_status = 'APPROVED' where classid='$classid' and studid='$studid'") or die(mysql_error());

 mysql_query("update current_class set adm_status = 'APPROVED' where classid='$newclassid' and studid='$studid'") or die(mysql_error());
 mysql_query("update current_class_semreg set classid='$newclassid', adm_status = 'APPROVED' where classid='$classid' and studid='$studid'") or die(mysql_error());


		
//**		
		
		
		//mysql_query("delete from stud_sem_registration where classid='$classid' and adm_no='$studid'and reg_id='$reg_id'") or die(mysql_error());
                

 	// $l=mysql_query("select * from current_class where classid='$classid' and studid='$studid'") or die(mysql_error());
	// $r=mysql_fetch_assoc($l);
	// $rollno=$r["rollno"];
	// mysql_query("insert into current_classold values('$classid','$studid','$rollno','$acd_year')") or die(mysql_error());
	// $l=mysql_query("select * from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
	// while ($r=mysql_fetch_assoc($l)) {
	// 	$mark=$r["sessional_marks"];
	// 	$subjectid=$r["subjectid"];
	// 	mysql_query("insert into sessional_marksold values('$classid','$studid','$subjectid','$mark','$acd_year')") or die(mysql_error());
	// }
	// $l=mysql_query("select * from ")
	} else if($id2==21) {
		$x="Approved by office";
		mysql_query("UPDATE stud_sem_registration SET apl_status='Approved',apv_status='$x',remarks='' WHERE reg_id='$reg_id'")or die(mysql_error());
		//archiving data
		$l=mysql_query("select * from stud_sem_registration where apl_status='Approved' and reg_id='$reg_id'")or die(mysql_error());

		$r=mysql_fetch_assoc($l); 
		$classid=$r['classid'];
		$new_sem=$r["new_sem"];
		$studid=$r["adm_no"];
                mysql_query("UPDATE notification SET status=0 where rec_id='$studid'")or die(mysql_error());

		$l1=mysql_query("select courseid,branch_or_specialisation from class_details where classid='$classid'")or die(mysql_error());

		$r1=mysql_fetch_assoc($l1); 
		$branch_or_specialisation=$r1["branch_or_specialisation"];
		$courseid=$r1["courseid"];

		$l2=mysql_query("select classid from class_details where courseid='$courseid' and branch_or_specialisation ='$branch_or_specialisation' and semid='$new_sem'")or die(mysql_error());
		$r2=mysql_fetch_assoc($l2); 
		$newclassid=$r2["classid"];
		$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
		$r=mysql_fetch_assoc($l);
		$acd_year=$r["acd_year"];

		$cur=explode('-',$acd_year);
		
		$y1= $cur[0]-1;
		$y2= $cur[1]-1;

		$acd_year=$y1."-".$y2;

//**
		//1. archiving current class details

				mysql_query("insert into current_classold(classid,studid,rollno,year) select classid,studid,rollno,'$acd_year' from current_class_semreg where classid='$classid' and studid='$studid'") or die(mysql_error());
				
//2. archiving sessional marks		
          // mysql_query("insert into sessional_marksold(classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,acd_year) select classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,'$acd_year' from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
	
//3. archiving series exam marks
           //  mysql_query("insert into each_sessional_marksold(series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,acd_year) select series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,'$acd_year' from each_sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());

				
//4. archiving attendance
   //mysql_query("insert into attendanceold(attid,date,hour,subjectid,classid,studid,status,acd_year) select attid,date,hour,subjectid,classid,studid,status,'$acd_year' from attendance where classid='$classid' and studid='$studid'") or die(mysql_error());
				
//5. archiving elective
 // mysql_query("insert into elective_studentold(sub_code,stud_id,acd_year,classid) select sub_code,stud_id,'$acd_year','$classid' from elective_student where stud_id='$studid'") or die(mysql_error());
				
				
//6. archiving lab student details
 // mysql_query("insert into lab_batch_studentold(studid,batch_id,acd_year,classid) select studid,batch_id,'$acd_year','$classid' from lab_batch_student where studid='$studid'") or die(mysql_error());

//7. archiving duty leave

 // mysql_query("insert into duty_leaveold(id,studid,subjectid,leave_date,hour,remark,date,acd_year,classid) select id,studid,subjectid,leave_date,hour,remark,date,'$acd_year','$classid' from duty_leave where studid='$studid'") or die(mysql_error());
				
				
		//deleteing details from main table		
		
				
//mysql_query("delete from attendance where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from each_sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
//mysql_query("delete from elective_student where stud_id='$studid'") or die(mysql_error());
//mysql_query("delete from lab_batch_student where studid='$studid'") or die(mysql_error());
//mysql_query("delete from duty_leave where studid='$studid'") or die(mysql_error());
	
				
				
				
			//update current class of students
			
			
		//mysql_query("update current_class set classid='$newclassid', adm_status='PROVISIONALLY APPROVED' where classid='$classid' and studid='$studid'") or die(mysql_error());
 mysql_query("update current_class set adm_status='PROVISIONALLY APPROVED' where classid='$newclassid' and studid='$studid'") or die(mysql_error());
 mysql_query("update current_class_semreg set classid='$newclassid', adm_status = 'PROVISIONALLY APPROVED' where classid='$classid' and studid='$studid'") or die(mysql_error());
		
//**		
		
		
               //mysql_query("delete from stud_sem_registration where classid='$classid' and adm_no='$studid'and reg_id='$reg_id'") or die(mysql_error());






 	// $l=mysql_query("select * from current_class where classid='$classid' and studid='$studid'") or die(mysql_error());
	// $r=mysql_fetch_assoc($l);
	// $rollno=$r["rollno"];
	// mysql_query("insert into current_classold values('$classid','$studid','$rollno','$acd_year')") or die(mysql_error());
	// $l=mysql_query("select * from sessional_marks where classid='$classid' and studid='$studid'") or die(mysql_error());
	// while ($r=mysql_fetch_assoc($l)) {
	// 	$mark=$r["sessional_marks"];
	// 	$subjectid=$r["subjectid"];
	// 	mysql_query("insert into sessional_marksold values('$classid','$studid','$subjectid','$mark','$acd_year')") or die(mysql_error());
	// }
	// $l=mysql_query("select * from ")
	} 

	echo "<script>redirect()</script>";


}

?>






