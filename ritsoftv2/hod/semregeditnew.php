<?php 
if (isset($_POST["classid"])) {
	$classid=$_POST["classid"];
}
if (isset($_GET["id3"])) {
	$classid=$_GET["id3"];
}

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
				$x="Approved by HOD";
				mysql_query("UPDATE stud_sem_registration SET apv_status='$x',remarks='' WHERE reg_id='$reg_id'")or die(mysql_error());
			}


		}












		if(isset($_POST['id1'])){
			foreach ($_POST['id1'] as $key => $value) {

				if(isset($_POST['action'][$key])) {
					$now = array( 
						'id1' => $_POST['id1'][$key],
						'id2' => $_POST['id2'][$key],
						'id3' => $_POST['id3'][$key],
						'action' => $_POST['action'][$key]

					); 
					if($now['action'] == 1)
						doActionNow($now);
				}
			} 
		}
		
		echo "<script>redirect()</script>";
		exit();
	}
} else {


	if(isset($_POST["btn_send"])!=null) {
		$reg_id=$_POST["reg_id"];
		$remarks=$_POST["remarks"];
		$x="Rejected by HOD";
		mysql_query("UPDATE stud_sem_registration SET apv_status='$x',remarks='$remarks' WHERE reg_id='$reg_id'")or die(mysql_error());
		echo "<script>redirect()</script>";

	} else {
		$reg_id = $_GET['id']; 
		$id2 = $_GET['id2']; 
		if($id2==1)
		{
			$x="Approved by HOD";
			mysql_query("UPDATE stud_sem_registration SET apv_status='$x',remarks='' WHERE reg_id='$reg_id'")or die(mysql_error());
			echo "<script>redirect()</script>";
		}

	}

}




?>



