<?php
include("header1.php");
include("connection.php");
?>
<div class="now-on-top">
	<div class="row">

		<div class="col-md-12  ">

			<center>
				<div class="col-md-5 set-center"> 
  

<form name="" method="post" action="">
   <div class="" style="height: 367px"> 
    
      <table id="outer1">
  <thead>
    <tr>
      <th colspan="3">FORGOT PASSWORD</th>
    </tr><tr><td>
    <div id="divform" class="">
                 <label>Username :<span class="required">*</span></label>
                 <input required="required"  id="Text1" type="text"  name="txtemail" style="width:400px" />
                 </div>
               
               
              </td></tr></thead></table>

<table align="center" style="padding-top:40px">

      <tr><td><input style="width:200px" id="submit" type="submit" value="RETRIEVE PASSWORD" name="submit"/></td>
             
         </tr>
      </table> 

      
     </div>
     <!--end sec div2-->


     

</div>
<!--end maindiv-->
</form>
</div>
</div>
</div>


<?php
include("footer.php");
?>




 <?php 
 if (isset($_POST['submit'])) {
      $mailid=$_POST['txtemail'];

$ch="select * from login where username='$mailid'";

 $r=mysql_query($ch);
$row=mysql_fetch_array($r);
 
	   $pwd=$row['password'];
	   $username=$row['username'];
           $usertype=$row['usertype'];

	   
if (mysql_num_rows($r)==0){
?>
<script type="text/javascript"> alert("User does not Exists with the given username.");
			location.replace("index.php");
			</script>



<?php

}

else

{
	//require_once("classes/class.phpmailer.php");

//check faculty.............

if($usertype=='faculty')
{

	 // include the class name

	    
		/*	$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 111; // or 587 465 465
			$mail->IsHTML(true);
			$mail->Username = "youradmin@yourdomain.com";
			$mail->Password ="youradminmailpassword";
			$mail->SetFrom("youradmin@yourdomain.com");
			$mail->Subject = "RITSOFT | Login Details";

			$mail->Body = '
			Your Login Credentials for RITSOFT Account<br>			------------------------<br>
			Username: '.$username.'<br>
			Password: '.$pwd.'<br>
			------------------------<br>
 			Thanking You<br>';
			$mail->AddAddress($mailid);//here mailid is fetched from the database
			//$mail->AddAttachment($file_name); */

$subjectmail="RITSOFT | Login Details";
$contentmail='
			Your Login Credentials for RITSOFT Account
			Username: '.$username.'
			Password: '.$pwd.'
			------------------------
 			Thanking You';
 			$sucessm=mail($mailid,$subjectmail,$contentmail);
	   if($sucessm)
		{
?>
<script type="text/javascript"> alert("Check Your Mail for login details.");
			location.replace("index.php");
			</script>


<?php

}   	        
			
				
	else
	{
	?>

<script type="text/javascript"> alert("FAILED.");
			location.replace("index.php");
			</script>



<?php	
		

	}


}

//check student

if($usertype=='student')
{
$ch1="select * from stud_details where admissionno='$mailid'";

 $r1=mysql_query($ch1);
$row1=mysql_fetch_array($r1);
 
	   $email=$row1['email'];


	 // include the class name

	
		/*	$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587 465 465
			$mail->IsHTML(true);
			$mail->Username = "youradmin@yourdomain.com";
			$mail->Password ="youradminmailpassword";
			$mail->SetFrom("youradmin@yourdomain.com");
			$mail->Subject = "RITSOFT | Login Details";

			$mail->Body = '
			Your Login Credentials for RITSOFT Account<br>			------------------------<br>
			Username: '.$username.'<br>
			Password: '.$pwd.'<br>
			------------------------<br>
 			Thanking You<br>';
			$mail->AddAddress($email);//here mailid is fetched from the database
			//$mail->AddAttachment($file_name); */
$subjectmail="RITSOFT | Login Details";
$contentmail='
			Your Login Credentials for RITSOFT Account
			Username: '.$username.'
			Password: '.$pwd.'
			------------------------
 			Thanking You';
 			$sucessm=mail($email,$subjectmail,$contentmail);
	   if($sucessm)
		{
?>
<script type="text/javascript"> alert("Check Your Mail for login details.");
			location.replace("index.php");
			</script>


<?php

}   	        
			
				
	else
	{
	?>

<script type="text/javascript"> alert("FAILED.");
			location.replace("index.php");
			</script>



<?php	
		

	}


}




	
}









}
?>
      
</body>
</html>
