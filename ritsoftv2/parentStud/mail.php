<?php
 
 class sendconfirm
{

public	function sendchange($cname,$staffcur)
{
	
	
	
	require_once("class.phpmailer.php");
	 // include the class name
	 $cname=$cname;
	 $mail_to = $staffcur;
    
	
			$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587 465 465
			$mail->IsHTML(true);
			$mail->Username = "parentrit@gmail.com";
			$mail->Password = "parent1234";
			$mail->SetFrom("parentrit@gmail.com");
			$mail->Subject = $cname;
			$mail->Body = "Dear Sir/Madam, <br>From".$cname." <br><br>".$cname."Convener Changed.Please contact Admin for further Details.<br><br> Thanking You...";
			$mail->AddAddress($mail_to);//here mailid is fetched from the database
			//$mail->AddAttachment($file_name);
	   if(!$mail->Send())
		{
		unset($mail);
         $senddet=$senddet."<br>Sending Failed to ".$staffcur;
        	}
        else 
	{
	unset($mail);
	
	    $senddet=$senddet."<br>mail send to  ".$staffcur;
        
        }
		return($senddet);
       

}

	
}