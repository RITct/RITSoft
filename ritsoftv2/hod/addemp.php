<?php
session_start();
include("includes/connection1.php");
function random_password( $length = 8 ) 
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}
if (isset($_POST['submit'])) 
{
	$fid=strtoupper($_POST['fid']);
	$name=strtoupper($_POST['name']);
	$deptname=$_SESSION['deptname'];
	$phoneno=$_POST['phoneno'];
	$email=$_POST['email'];
	$ch="select * from faculty_details where email='$email'";
	$res=mysql_query($ch);
	if (mysql_num_rows($res) > 0)
		{?>
			<script type="text/javascript"> alert("User Already Exists with the given mail id.");
			location.replace("empreg.php");
		</script>
		
	<?php }
	
	$check="select * from faculty_details where fid like '$fid'";
	$result=mysql_query($check);
	if (mysql_num_rows($result) > 0) 
	{
		?>

		<script type="text/javascript"> alert("User Already Exists");
		location.replace("empreg.php");
	</script>

	<?php
}
else	
{

	$image0 = null;
			// if(!isset( $_FILES['file']))
	if(!$_FILES['file']['tmp_name']=="")
		$image0 = addslashes(file_get_contents($_FILES['file']['tmp_name']));


	$sql ="insert into faculty_details(fid,name,deptname,phoneno,email,photo)value('$fid','$name','$deptname','$phoneno','$email',
	'$image0')";
	

	if(mysql_query($sql)== TRUE) 
	{ 
		$pass=random_password(8);
		mysql_query("insert into login values('$email','$pass','faculty')") or die(mysql_error());
		mysql_query("insert into faculty_designation values('$fid','faculty')") or die(mysql_error());
		/*if (!class_exists("phpmailer")) 
		{
			require_once("classes/class.phpmailer.php");
	} 
 // include the class name
			$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587 465
			$mail->IsHTML(true);
			$mail->Username = "youradmin@yourdomain.com";
			$mail->Password = "youradminmailpassword";
			$mail->SetFrom("youradmin@yourdomain.com");
			$mail->Subject = "RITSOFT | Login Details";
			$mail->Body = "Your Login Credentials for RITSOFT Account<br>"."Username : ".$email."<br>Password : ".$pass."<br>URL: http://rit.ac.in/ritsoft<br><br>Thanks";
			$mail->AddAddress($email);//here mailid is fetched from the database
			
			$mail->Send();
			unset($mail); */

$subjectmail="RITSOFT | Login Details";
$contentmail='
			Your Login Credentials for RITSOFT Account
			Username: '.$email.'
			Password: '.$pass.'
			------------------------
 			Thanking You';
 			$sucessm=mail($email,$subjectmail,$contentmail);



		}
		?>

		<script type="text/javascript"> alert("Staff Added Successfully");
		location.replace("empreg.php");
	</script>

	<?php
}
}
else	
{			
	?>
	<script type="text/javascript"> alert("Failed");
	location.replace("empreg.php");
</script> 

<?php	  
} 

?>
