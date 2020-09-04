<?php 
	include("includes/connection.php");
?>
<?php
if (isset($_POST["classid"]) && isset($_POST["branch"]) ) {
	$classid=$_POST["classid"];
	$branch=$_POST["branch"];
	

	//enabling first semester
	
	mysql_query("update class_details set active='YES' where concat(courseid,'-',branch_or_specialisation)='$branch' and semid=1") or die(mysql_error());

// disabling last semester

mysql_query("update class_details set active='NO' where classid='$classid'") or die(mysql_error());



// disabling last semester in semregstatus

mysql_query("update semregstatus set current_class=0 where curr_sem='$classid'") or die(mysql_error());

// enabling first  semester in semregstatus---get classid from class details table

$c11="select classid from class_details where concat(courseid,'-',branch_or_specialisation)='$branch' and semid=1";
 $r11=mysql_query($c11);
 $row11=mysql_fetch_array($r11);
 $sem1=$row11['classid'];

// enabling first  semester in semregstatus

        mysql_query("update semregstatus set current_class=1 where curr_sem='$sem1'") or die(mysql_error());




// deleting staff advisor of the corresponding class
$ch="select distinct fid from staff_advisor where fid in (select fid from staff_advisor where classid='$classid')";
 $r=mysql_query($ch);
 while($row=mysql_fetch_array($r))
 {
 $fid=$row['fid'];

 $ch1="select * from staff_advisor where fid='$fid'";
	$r1=mysql_query($ch1);
	if (mysql_num_rows($r1)==1){
          
mysql_query("delete from faculty_designation where designation like '%advisor' and fid ='$fid'") or die(mysql_error());

}

mysql_query("delete from staff_advisor where classid='$classid' and fid='$fid'") or die(mysql_error());

}
//** end staff advisor deleting code


//current year..................

$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
				$r=mysql_fetch_assoc($l);
				$acd_year=$r["acd_year"];
                                $cur=explode('-',$acd_year);
                                 
                                  $y1= $cur[0]-1;
                                  $y2= $cur[1]-1;

                                   $acd_year=$y1."-".$y2; 
                                   
//insert details into current classold......

mysql_query("insert into current_classold(classid,studid,rollno,year) select classid,studid,rollno,'$acd_year' from current_class where classid='$classid'") or die(mysql_error());


//1. archiving sessional marks		
           mysql_query("insert into sessional_marksold(classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,acd_year) select classid,studid,subjectid,sessional_marks,sessional_remark,verification_status,sessional_date,'$acd_year' from sessional_marks where classid='$classid'") or die(mysql_error());
	
//2. archiving series exam marks
             mysql_query("insert into each_sessional_marksold(series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,acd_year) select series_no,classid,studid,subjectid,sessional_marks,sessional_remark,status,sessional_date,'$acd_year' from each_sessional_marks where classid='$classid'") or die(mysql_error());

				
//3. archiving attendance
   mysql_query("insert into attendanceold(attid,date,hour,subjectid,classid,studid,status,acd_year) select attid,date,hour,subjectid,classid,studid,status,'$acd_year' from attendance where classid='$classid'") or die(mysql_error());
				
//4. archiving elective
  mysql_query("insert into elective_studentold(sub_code,stud_id,acd_year,classid) select sub_code,stud_id,'$acd_year','$classid' from elective_student where stud_id in (select studid from current_class where classid='$classid')") or die(mysql_error());
				
				
//5. archiving lab student details
  mysql_query("insert into lab_batch_studentold(studid,batch_id,acd_year,classid) select studid,batch_id,'$acd_year','$classid' from lab_batch_student where studid in (select studid from current_class where classid='$classid')") or die(mysql_error());

//6. archiving duty leave

  mysql_query("insert into duty_leaveold(id,studid,subjectid,leave_date,hour,remark,date,acd_year,classid) select id,studid,subjectid,leave_date,hour,remark,date,'$acd_year','$classid' from duty_leave where studid in (select studid from current_class where classid='$classid')") or die(mysql_error());
				
				

//***deleteing details from main table		
						
mysql_query("delete from attendance where classid='$classid'") or die(mysql_error());
mysql_query("delete from sessional_marks where classid='$classid'") or die(mysql_error());
mysql_query("delete from each_sessional_marks where classid='$classid'") or die(mysql_error());
mysql_query("delete from elective_student where stud_id in (select studid from current_class where classid='$classid')") or die(mysql_error());
mysql_query("delete from lab_batch_student where studid in (select studid from current_class where classid='$classid')") or die(mysql_error());
mysql_query("delete from duty_leave where studid in (select studid from current_class where classid='$classid')") or die(mysql_error());
//***  




//delete from login and current class...
mysql_query("delete from login where username in (select studid from current_class where classid='$classid')") or die(mysql_error());
mysql_query("delete from current_class where classid='$classid'") or die(mysql_error());




//.........................//
//mysql_query("delete from faculty_designation where designation like '%advisor' and fid in(select fid from staff_advisor where //classid='$classid')") or die(mysql_error());
//mysql_query("delete from staff_advisor where classid='$classid'") or die(mysql_error());






	echo "Semester Completed and Started new admission";
}
?>
