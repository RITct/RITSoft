<?php
session_start();
include "includes/dboperation.php";

?>
 <!DOCTYPE html>
<html>
<body>
<?php



if (isset($_POST['button']))										//Code after Submit Button is clicked....
{

$studstatus=$_POST['studstatus'];

if($studstatus == "going")
{
$tmp=$_SESSION['tmpcheck'];
// $tmp=$_POST['tempno'];

$s=mysql_query("select status from temp where temp_no='$tmp'");
$row=mysql_fetch_assoc($s);
$status=$row["status"];


if($status == "Verified")      //Checking Duplication! Whether the student is already taken admission or not!
{
	echo "<script>alert('Already Submitted!')</script>";
 unset($_SESSION['tmpcheck']);
$tmp="";
 
	header("Location:verification.php");
	
}
else
{


$pic=$_SESSION["pic"];
$co=$_POST['course1'];
$code=$_POST['code'];
$st_id=$_POST['st_id'];
$next_st_id=$_POST['next_st_id'];
$st_id1=$_POST['st_id1'];
$next_st_id1=$_POST['next_st_id1'];
$sp=$_POST['spec'];
$bc=$_POST['bch'];
$admno=$_POST['adm_no'];
$todays_date=$_POST['dte'];
$na=$_POST['name'];
$db=$_POST['dob'];
$sx=$_POST['gender'];
$rlgn=$_POST['religion'];
$cst=$_POST['caste']."-".$_POST['category'];
$mob=$_POST['mobile'];
$mail=$_POST['email'];
$semail=$_POST['semail'];
$gdcontact=$_POST['gdcontact'];
$guard_contact=$_POST['guard_contact'];
$gdemail=$_POST['gdemail'];
$nagd=$_POST['name_guard'];
$rel=$_POST['relation'];
$occpn=$_POST['occupation'];
$inc=$_POST['income'];
$adrs=$_POST['address'];
$phno=$_POST['phone'];
$csem=$_POST['cur_sem'];
$rlno=$_POST['roll_num'];
$rnk=$_POST['rank_no'];
$qta=$_POST['quota'];
$scl1=$_POST['school_1'];
$rgno1=$_POST['reg_no_yr_1'];
$brd1=$_POST['board_1'];
$per1=$_POST['per1'];
$scl2=$_POST['school_2'];
$rgno2=$_POST['reg_no_yr_2'];
$brd2=$_POST['board_2'];
$per2=$_POST['per2'];
$chnc=$_POST['no_chance'];
$tot=$_POST['total'];
$phy=$_POST['physics'];
$chem=$_POST['chemistry'];
$math=$_POST['maths'];
$admtype=$_POST['admtype'];
$blood=$_POST['blood'];
$score=$_POST['score'];
$college_name=$_POST['college_name'];
$university=$_POST['university'];
$deg_co=$_POST['degree_course'];
$deg_regno=$_POST['degree_regno'];
$deg_marks=$_POST['degree_marks'];
$deg_per=$_POST['degree_percent'];
$hid=$_POST['c'];
$nalast=$_POST['namelast']; 
$tcno=$_POST['tcno'];
$tcdate=$_POST['tcdate'];
$admdate=$_POST['admdate'];

		//$file=$_FILES['file']['name'];

	$obj=new dboperation();


	$q="INSERT INTO `stud_details`(`admissionno`, `name`, `dob`, `gender`, `religion`, `caste`, `year_of_admission`, `email`, `mobile_phno`, `land_phno`, `address`, `rollno`, `rank`, `quota`, `school_1`, `regno_1`, `board_1`,`percentage_1`, `school_2`, `regno_2`, `board_2`,`percentage_2`, `no_chance1`, `name_last_studied`, `courseid`, `branch_or_specialisation`, `branch_code`,`image`, `gate_score`, `admission_type`, `entry_sem`, `blood`,`status`,`tc_no_adm`,`tc_date_adm`,`date_of_admission`) VALUES ('$admno', '$na', '$db', '$sx', '$rlgn','$cst', '$todays_date', '$mail', '$mob','$phno', '$adrs', '$rlno', '$rnk', '$qta', '$scl1', '$rgno1','$brd1', '$per1','$scl2', '$rgno2', '$brd2','$per2', '$chnc','$nalast','$co','$sp','$code','" . addslashes($pic) . "', '$score', '$admtype','$csem', '$blood', 'On Going','$tcno','$tcdate','$admdate')";
	$obj->Ex_query($q);
	unset($_SESSION["pic"]);

	$l=mysql_query("select classid from class_details where branch_or_specialisation='$sp' and courseid='$co' and semid='$csem'") or die(mysql_error()); 
	$r=mysql_fetch_assoc($l);
	$classid=$r["classid"];

	$obj=new dboperation();
	$obj->Ex_query("insert into current_class(studid,classid) values('$admno','$classid')"); 

	 if($guard_contact != $gdcontact)					//Checking whether the parent or guardian is already exist or not!
	 {
	 	$objpa=new dboperation();
	 	$q2pa="INSERT INTO `parent`(`name_guard`, `guard_contactno`, `relation`, `occupation`, `guard_email`, `income`) VALUES ('$nagd','$gdcontact','$rel','$occpn','$gdemail','$inc')";
	 	$objpa->Ex_query($q2pa);
	 }

	 $res5=mysql_query("SELECT max(parentid) as pid from parent") or die(mysql_error());
	 $x=mysql_fetch_assoc($res5);
	 $ress=$x["pid"];


	 $objpa2=new dboperation();
	 $q2pa2="INSERT INTO `parent_student`(`admissionno`, `parentid`) VALUES ('$admno','$ress')";
	 $objpa2->Ex_query($q2pa2);


	 $objlog=new dboperation();
	 $qlog="INSERT INTO `login`(`username`, `password`, `usertype`) VALUES ('$admno','$admno','student')";
	 $objlog->Ex_query($qlog);



	//inserting datas into correspnding tables...UG students to UGstudent_Qualification and PG students to PGstudent_Qualification..!

	 if($co == 'BTECH')
	 {
	 	$obj2=new dboperation();
	 	$q2="INSERT INTO `ugstudent_qual`(`admissionno`, `physics`, `chemistry`, `maths`, `total_marks`, `percentage`) VALUES ('$admno', '$phy' , '$chem', '$math', '$tot', '$per2')";
	 	$obj2->Ex_query($q2);

	 	$obj11=new dboperation();
	 	$q11="UPDATE last_adm_no SET ug='$next_st_id' WHERE `ug`='$st_id'";
	 	$obj11->Ex_query($q11);
	 }
	 elseif($co == 'BARCH')
	 {
	 	$objb=new dboperation();
	 	$qb="INSERT INTO `ugstudent_qual`(`admissionno`, `physics`, `chemistry`, `maths`, `total_marks`, `percentage`)VALUES ('$admno', '$phy' , '$chem', '$math', '$tot', '$per2')";
	 	$objb->Ex_query($qb);

	 	$obja=new dboperation();
	 	$qa="UPDATE last_adm_no SET ug='$next_st_id' WHERE `ug`='$st_id'";
	 	$obja->Ex_query($qa);
	 }
	 elseif($co == 'MCA')	 	 
	 {	 
	 	$obj7=new dboperation();
	 	$q7="INSERT INTO `pgstudent_qual` (`admissionno`, `college_name`, `university`, `degree_course`, `degree_regno`, `degree_marks`, `degree_percent`) VALUES ('$admno','$college_name','$university', '$deg_co' , '$deg_regno', '$deg_marks', '$deg_per')";
	 	$obj7->Ex_query($q7);

	 	$obj1c=new dboperation();
	 	$q1c="UPDATE last_adm_no SET pg='$next_st_id1' WHERE `pg`='$st_id1'";
	 	$obj1c->Ex_query($q1c);  
	 } 
	 else
	 {
	 	$objc=new dboperation();
	 	$qc="INSERT INTO `pgstudent_qual` (`admissionno`, `college_name`, `university`, `degree_course`, `degree_regno`, `degree_marks`, `degree_percent`) VALUES ('$admno','$college_name','$university', '$deg_co' , '$deg_regno', '$deg_marks', '$deg_per')";
	 	$objc->Ex_query($qc);  

	 	$obj1d=new dboperation();
	 	$q1d="UPDATE last_adm_no SET pg='$next_st_id1' WHERE `pg`='$st_id1'";
	 	$obj1d->Ex_query($q1d);   
	 }
	 
	 $ob1=new dboperation();
	 $q1="UPDATE temp SET status='Verified' WHERE temp_no='$tmp'";
	 $ob1->Ex_query($q1); 
   unset($_SESSION['tmpcheck']);
          ?>


	
	 <script>

alert("Details are entered successfully");
location.replace("verification.php");

</script>
          <?php

        // header("Location:verification.php");

	}

}//end if

//..........................................


if($studstatus == "discont")
{
$tmp=$_SESSION['tmpcheck'];
// $tmp=$_POST['tempno'];

$s=mysql_query("select status from temp where temp_no='$tmp'");
$row=mysql_fetch_assoc($s);
$status=$row["status"];


if($status == "Verified")      //Checking Duplication! Whether the student is already taken admission or not!
{
	echo "<script>alert('Already Submitted!')</script>";
 unset($_SESSION['tmpcheck']);
$tmp="";
 
	header("Location:verification.php");
	
}
else
{


$pic=$_SESSION["pic"];
$co=$_POST['course1'];
$code=$_POST['code'];
$st_id=$_POST['st_id'];
$next_st_id=$_POST['next_st_id'];
$st_id1=$_POST['st_id1'];
$next_st_id1=$_POST['next_st_id1'];
$sp=$_POST['spec'];
$bc=$_POST['bch'];
$admno=$_POST['adm_no'];
$todays_date=$_POST['dte'];
$na=$_POST['name'];
$db=$_POST['dob'];
$sx=$_POST['gender'];
$rlgn=$_POST['religion'];
$cst=$_POST['caste']."-".$_POST['category'];
$mob=$_POST['mobile'];
$mail=$_POST['email'];
$semail=$_POST['semail'];
$gdcontact=$_POST['gdcontact'];
$guard_contact=$_POST['guard_contact'];
$gdemail=$_POST['gdemail'];
$nagd=$_POST['name_guard'];
$rel=$_POST['relation'];
$occpn=$_POST['occupation'];
$inc=$_POST['income'];
$adrs=$_POST['address'];
$phno=$_POST['phone'];
$csem=$_POST['cur_sem'];
$rlno=$_POST['roll_num'];
$rnk=$_POST['rank_no'];
$qta=$_POST['quota'];
$scl1=$_POST['school_1'];
$rgno1=$_POST['reg_no_yr_1'];
$brd1=$_POST['board_1'];
$per1=$_POST['per1'];
$scl2=$_POST['school_2'];
$rgno2=$_POST['reg_no_yr_2'];
$brd2=$_POST['board_2'];
$per2=$_POST['per2'];
$chnc=$_POST['no_chance'];
$tot=$_POST['total'];
$phy=$_POST['physics'];
$chem=$_POST['chemistry'];
$math=$_POST['maths'];
$admtype=$_POST['admtype'];
$blood=$_POST['blood'];
$score=$_POST['score'];
$college_name=$_POST['college_name'];
$university=$_POST['university'];
$deg_co=$_POST['degree_course'];
$deg_regno=$_POST['degree_regno'];
$deg_marks=$_POST['degree_marks'];
$deg_per=$_POST['degree_percent'];
$hid=$_POST['c'];
$nalast=$_POST['namelast']; 
$tcno=$_POST['tcno'];
$tcdate=$_POST['tcdate'];
$admdate=$_POST['admdate'];
		//$file=$_FILES['file']['name'];

	$obj=new dboperation();


	$q="INSERT INTO `stud_details`(`admissionno`, `name`, `dob`, `gender`, `religion`, `caste`, `year_of_admission`, `email`, `mobile_phno`, `land_phno`, `address`, `rollno`, `rank`, `quota`, `school_1`, `regno_1`, `board_1`,`percentage_1`, `school_2`, `regno_2`, `board_2`,`percentage_2`, `no_chance1`, `name_last_studied`, `courseid`, `branch_or_specialisation`, `branch_code`,`image`, `gate_score`, `admission_type`, `entry_sem`, `blood`, `status`,`tc_no_adm`,`tc_date_adm`,`date_of_admission`) VALUES ('$admno', '$na', '$db', '$sx', '$rlgn','$cst', '$todays_date', '$mail', '$mob','$phno', '$adrs', '$rlno', '$rnk', '$qta', '$scl1', '$rgno1','$brd1', '$per1','$scl2', '$rgno2', '$brd2','$per2', '$chnc','$nalast','$co','$sp','$code','" . addslashes($pic) . "', '$score', '$admtype','$csem', '$blood', 'Discontinued','$tcno','$tcdate','$admdate')";
	$obj->Ex_query($q);
	unset($_SESSION["pic"]);

	$l=mysql_query("select classid from class_details where branch_or_specialisation='$sp' and courseid='$co' and semid='$csem'") or die(mysql_error()); 
	$r=mysql_fetch_assoc($l);
	$classid=$r["classid"];

	$obj=new dboperation();
	//$obj->Ex_query("insert into current_class(studid,classid) values('$admno','$classid')"); 

	 if($guard_contact != $gdcontact)					//Checking whether the parent or guardian is already exist or not!
	 {
	 	$objpa=new dboperation();
	 	$q2pa="INSERT INTO `parent`(`name_guard`, `guard_contactno`, `relation`, `occupation`, `guard_email`, `income`) VALUES ('$nagd','$gdcontact','$rel','$occpn','$gdemail','$inc')";
	 	$objpa->Ex_query($q2pa);
	 }

	 $res5=mysql_query("SELECT max(parentid) as pid from parent") or die(mysql_error());
	 $x=mysql_fetch_assoc($res5);
	 $ress=$x["pid"];


	 $objpa2=new dboperation();
	 $q2pa2="INSERT INTO `parent_student`(`admissionno`, `parentid`) VALUES ('$admno','$ress')";
	 $objpa2->Ex_query($q2pa2);


	 $objlog=new dboperation();
	// $qlog="INSERT INTO `login`(`username`, `password`, `usertype`) VALUES ('$admno','$admno','student')";
	// $objlog->Ex_query($qlog);



	//inserting datas into correspnding tables...UG students to UGstudent_Qualification and PG students to PGstudent_Qualification..!

	 if($co == 'BTECH')
	 {
	 	$obj2=new dboperation();
	 	$q2="INSERT INTO `ugstudent_qual`(`admissionno`, `physics`, `chemistry`, `maths`, `total_marks`, `percentage`) VALUES ('$admno', '$phy' , '$chem', '$math', '$tot', '$per2')";
	 	$obj2->Ex_query($q2);

	 	$obj11=new dboperation();
	 	$q11="UPDATE last_adm_no SET ug='$next_st_id' WHERE `ug`='$st_id'";
	 	$obj11->Ex_query($q11);
	 }
	 elseif($co == 'BARCH')
	 {
	 	$objb=new dboperation();
	 	$qb="INSERT INTO `ugstudent_qual`(`admissionno`, `physics`, `chemistry`, `maths`, `total_marks`, `percentage`)VALUES ('$admno', '$phy' , '$chem', '$math', '$tot', '$per2')";
	 	$objb->Ex_query($qb);

	 	$obja=new dboperation();
	 	$qa="UPDATE last_adm_no SET ug='$next_st_id' WHERE `ug`='$st_id'";
	 	$obja->Ex_query($qa);
	 }
	 elseif($co == 'MCA')	 	 
	 {	 
	 	$obj7=new dboperation();
	 	$q7="INSERT INTO `pgstudent_qual` (`admissionno`, `college_name`, `university`, `degree_course`, `degree_regno`, `degree_marks`, `degree_percent`) VALUES ('$admno','$college_name','$university', '$deg_co' , '$deg_regno', '$deg_marks', '$deg_per')";
	 	$obj7->Ex_query($q7);

	 	$obj1c=new dboperation();
	 	$q1c="UPDATE last_adm_no SET pg='$next_st_id1' WHERE `pg`='$st_id1'";
	 	$obj1c->Ex_query($q1c);  
	 } 
	 else
	 {
	 	$objc=new dboperation();
	 	$qc="INSERT INTO `pgstudent_qual` (`admissionno`, `college_name`, `university`, `degree_course`, `degree_regno`, `degree_marks`, `degree_percent`) VALUES ('$admno','$college_name','$university', '$deg_co' , '$deg_regno', '$deg_marks', '$deg_per')";
	 	$objc->Ex_query($qc);  

	 	$obj1d=new dboperation();
	 	$q1d="UPDATE last_adm_no SET pg='$next_st_id1' WHERE `pg`='$st_id1'";
	 	$obj1d->Ex_query($q1d);   
	 }
	 
	 $ob1=new dboperation();
	 $q1="UPDATE temp SET status='Verified' WHERE temp_no='$tmp'";
	 $ob1->Ex_query($q1); 
   unset($_SESSION['tmpcheck']);
          ?>


	
	 <script>

alert("Details are entered successfully");
location.replace("verification.php");

</script>
          <?php

        // header("Location:verification.php");

	}

}//end if



}	  ?>


</body>

</html>


