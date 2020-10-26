<?php
session_start();
include_once("../connection.php");
$fid=$_SESSION["fid"];
if(isset($_POST['bulk'])){
	if($_POST['bulk'] == true){


		function doActionNow( $arry){
			// var_dump($arry);
			// echo "<br>";



			$reg_id = $arry['id1']; 
			$id2 = $arry['id2']; 
			$classid=$arry["id3"];
			
			if($id2==1) {


				$x="Approved by staff advisor";
				mysql_query("UPDATE stud_sem_registration SET apv_status='$x',remarks='' WHERE reg_id='$reg_id'")or die(mysql_error());
				$l=mysql_query("select adm_no from stud_sem_registration where reg_id='$reg_id'") or die(mysql_error());
				$r=mysql_fetch_assoc($l);
				$studid=$r["adm_no"];
				$date=date("F j, Y, g:i a");
				mysql_query("insert into notification(data,send_id,rec_id,send_type,rec_type,date) values('Semester Registration Approved By Staff Advisor','$fid','$studid','staff advisor','student','$date')") or die(mysql_error()); 
			}






		}



		if(isset($_POST['id1'])){
			foreach ($_POST['id1'] as $key => $value) {
				if(isset( $_POST['action'][$key])){
					$now = array( 
						'id1' => $_POST['id1'][$key],
						'id2' => $_POST['id2'][$key],
						'id3' => $_POST['id3'][$key],
						'action' => $_POST['action'][$key],

					);  

					if($now['action'] == 1)
						doActionNow($now);

				}
			} 

		} 
	header("Location:sem_verificationnew.php");  // bring back to original page 
	exit();
}
} else {



	if(isset($_POST["btn_send"])!=null) {
		$reg_id=$_POST["reg_id"];
		$remarks=$_POST["remarks"];
		$x="Rejected by staff advisor";
		mysql_query("UPDATE stud_sem_registration SET apv_status='$x',remarks='$remarks' WHERE reg_id='$reg_id'")or die(mysql_error());
		$l=mysql_query("select adm_no from stud_sem_registration where reg_id='$reg_id'") or die(mysql_error());
		$r=mysql_fetch_assoc($l);
		$studid=$r["adm_no"];
		$date=date("F j, Y, g:i a");
		mysql_query("insert into notification(data,send_id,rec_id,send_type,rec_type,date) values('Semester Registration Rejected By Staff Advisor','$fid','$studid','staff advisor','student','$date')") or die(mysql_error());
		header("Location:sem_verificationnew.php");


	} else {
		$reg_id = $_GET['id']; 
		$id2 = $_GET['id2']; 
		if($id2==1) {
			$x="Approved by staff advisor";
			mysql_query("UPDATE stud_sem_registration SET apv_status='$x',remarks='' WHERE reg_id='$reg_id'")or die(mysql_error());
			$l=mysql_query("select adm_no from stud_sem_registration where reg_id='$reg_id'") or die(mysql_error());
			$r=mysql_fetch_assoc($l);
			$studid=$r["adm_no"];
			$date=date("F j, Y, g:i a");
			mysql_query("insert into notification(data,send_id,rec_id,send_type,rec_type,date) values('Semester Registration Approved By Staff Advisor','$fid','$studid','staff advisor','student','$date')") or die(mysql_error()); 
	header("Location:sem_verificationnew.php");  // bring back to original page 
}

}
}
?>



