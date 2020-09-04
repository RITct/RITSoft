<?php 
	include("includes/connection.php");
?>
<?php
if (isset($_POST["curr_sem"]) && isset($_POST["next_sem"]) && isset($_POST["status"])) {
	$curr_sem=$_POST["curr_sem"];
	$next_sem=$_POST["next_sem"];
	$status=$_POST["status"];
	mysql_query("update semregstatus set status='$status' where curr_sem='$curr_sem' and next_sem='$next_sem'") or die(mysql_error());
	mysql_query("update class_details set active='NO' where classid='$curr_sem'") or die(mysql_error());
	mysql_query("update class_details set active='YES' where classid='$next_sem'") or die(mysql_error());
	if($status==1)
	{echo "Semester registration started";}
	else
	{

$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
				$r=mysql_fetch_assoc($l);
				$acd_year=$r["acd_year"];
				$cur=explode('-',$acd_year);
				
				$y1= $cur[0]-1;
				$y2= $cur[1]-1;

				$acd_year=$y1."-".$y2;

mysql_query("insert into stud_sem_registrationold(reg_id,adm_no,classid,apl_status,apl_date,apv_status,apv_date,batch_id,previous_sem,new_sem,remarks,form_data,date,acd_year) select reg_id,adm_no,classid,apl_status,apl_date,apv_status,apv_date,batch_id,previous_sem,new_sem,remarks,form_data,date,'$acd_year' from stud_sem_registration where classid='$curr_sem'") or die(mysql_error());
mysql_query("delete from stud_sem_registration where classid='$curr_sem'") or die(mysql_error());



	$ch="select distinct fid from staff_advisor where fid in (select fid from staff_advisor where classid='$curr_sem')";
 $r=mysql_query($ch);
 while($row=mysql_fetch_array($r))
 {
 $fid=$row['fid'];

 $ch1="select * from staff_advisor where fid='$fid'";
	$r1=mysql_query($ch1);
	if (mysql_num_rows($r1)==1){
          
mysql_query("delete from faculty_designation where designation like '%advisor' and fid ='$fid'") or die(mysql_error());

}

mysql_query("delete from staff_advisor where classid='$curr_sem' and fid='$fid'") or die(mysql_error());

}
	
	echo "semester registration completed";
	
	
	}
}
?>
