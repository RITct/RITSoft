<?php
session_start();
ob_start();
error_reporting(0);
if(!(isset($_SESSION['logid'])))
	header('Location:../login.php');
	
?>

<?php
include("includes/header.php");

include("includes/sidenav.php");
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;">CHANGE PASSWORD
               
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
<script type="text/javascript"language="javascript">
$(document).ready(function(){
   $("#form1").validationEngine();
});
</script>

<form id="form1" name="form1" method="post" action="" class="sear_form">
<div class="form-row">
 	<div class="form-group col-md-6">
      <label for="occupation">Old Password</label>
	  <input type="password" class="form-control" placeholder="Old Password" id="oldpwd" name="oldpwd"  required="">
		</div>
		<div class="form-group col-md-6">
      <label  for="income"><strong>New Password</strong></label>
	  <input type="password" class="form-control" placeholder="New Password" id="newpwd" name="newpwd"  required="">
      
    </div>
</div>
  <div class="form-group ">
      <label for="name"><strong>Confirm Password</strong></label>
      <input type="password" class="form-control" placeholder="Confirm Password" id="conpwd" name="conpwd" >
    </div>
    
   <div align="center">
       <button type="submit" value="Change" name="change" id="button" class="btn btn-primary">Change Password</button>
       </div>
  </div>
</form>
<?php
if (isset($_REQUEST['change']))
{
	$old_pwd=$_POST['oldpwd'];
	$new_pwd=$_POST['newpwd'];
	$con_pwd=$_POST['conpwd'];
	
	include "includes/dboperation.php";
	$obj5=new dboperation();
	$query5="SELECT * FROM login WHERE username = '".$_SESSION['logid']."'";
	$result5=$obj5->selectdata($query5);
	$row=$obj5->fetch($result5);
	//$pwd=("$row[1]");
	
	if($row['password'] == $old_pwd ){
		if($new_pwd == $con_pwd){
	$obji=new dboperation();
    $queryi = "UPDATE login SET password = '".$new_pwd."' WHERE username = '".$_SESSION['logid']."'";
		  $obji->Ex_query($queryi);
		//	$qry = mysql_query("UPDATE login SET password = '".$new_pwd."' WHERE username = '".$_SESSION['log_user']."'");
			if($queryi){
				echo '<script>alert("Password updated successfully.")</script>';
				header('Location:../login.php');
			}
			else
				echo '<script>alert("Error. Please try after sometime")</script>';
		}else{
			echo '<script>alert("Password mismatching.")</script>';
		}
	}else{
		echo '<script>alert("Old password is wrong.")</script>';
	}
}
include("includes/footer.php");
?>

