<?php 
	include("includes/connection.php");
?>
<?php
if (isset($_POST["classid"]) && isset($_POST["branch"]) ) {
	$classid=$_POST["classid"];
	$branch=$_POST["branch"];
	// $res=mysql_query("select classid from class_details where concat(courseid,'-',branch_or_specialisation)='$branch' and semid in (1,3,5,7,9)") or die(mysql_error());
	// while($r=mysql_fetch_assoc($res))
	// {
	// $semid=$r["classid"];
	// $x=mysql_query("select * from semregstatus where curr_sem='$semid' and status=1") or die(mysql_error());
	// if(mysql_num_rows($x)==0)
	mysql_query("update class_details set active='YES' where concat(courseid,'-',branch_or_specialisation)='$branch' and semid=1") or die(mysql_error());
// }

// $res=mysql_query("select classid from class_details where concat(courseid,'-',branch_or_specialisation)='$branch' and semid in (2,4,6,8,10)") or die(mysql_error());
// 	while($r=mysql_fetch_assoc($res))
// 	{
// 	$semid=$r["classid"];
// 	$x=mysql_query("select * from semregstatus where curr_sem='$semid' and status=1") or die(mysql_error());
// 	if(mysql_num_rows($x)==0)
// 	mysql_query("update class_details set active='NO' where classid='$semid'") or die(mysql_error());
// }

mysql_query("update class_details set active='NO' where classid='$classid'") or die(mysql_error());

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



//current year..................

$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
				$r=mysql_fetch_assoc($l);
				$acd_year=$r["acd_year"];
                                $cur=explode('-',$acd_year);
                                 
                                  $y1= $cur[0]-1;
                                  $y2= $cur[1]-1;

                                   $acd_year=$y1."-".$y2; 

mysql_query("insert into current_classold(classid,studid,rollno,year) select classid,studid,rollno,'$acd_year' from current_class where classid='$classid'") or die(mysql_error());
mysql_query("insert into sessional_marksold(classid,studid,subjectid,sessional_marks,acd_year) select classid,studid,subjectid,sessional_marks,'$acd_year' from sessional_marks where classid='$classid'") or die(mysql_error());
mysql_query("insert into attendanceold(attid,date,hour,subjectid,classid,studid,status,acd_year) select attid,date,hour,subjectid,classid,studid,status,'$acd_year' from attendance where classid='$classid'") or die(mysql_error());
mysql_query("delete from attendance where classid='$classid'") or die(mysql_error());
mysql_query("delete from sessional_marks where classid='$classid'") or die(mysql_error());
mysql_query("delete from login where username in (select studid from current_class where classid='$classid')") or die(mysql_error());
mysql_query("delete from current_class where classid='$classid'") or die(mysql_error());




//.........................//



	echo "Semester Completed and Started new admission";
}
?>
