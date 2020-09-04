<?php
include("header.php");
if(isset($_POST['send']))
{
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$msg=$_POST['message'];
	if (!class_exists("phpmailer")) {
	require_once("classes/class.phpmailer.php");
	} // include the class name
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
			$mail->Subject = "Enquiry | ".$name;
			$mail->Body = "Name : ".$name."<br>"."Phone : ".$phone."<br>"."Email : ".$email."<br><br>"."Message <br>----------------------------------------<br>".nl2br($msg);
			$mail->AddAddress("youradmin@yourdomain.com");//here mailid is fetched from the database
			
	   if(!$mail->Send())
		{
		unset($mail);
       echo "<script>alert('Message Send Unsuccessfully')</script>";     
        	}
        else 
	{
	unset($mail);
       echo "<script>alert('Message Send Successfully')</script>";     
        }

}
?>
<div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Contact
       
      </h1>

      
      <!-- Content Row -->
      <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
          <!-- Embedded Google Map -->
          <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=Rajiv%20Gandhi%20Institute%20of%20Technology%2CKottayam+(RIT)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Contact Details</h3>
          <p>
            Rajiv Gandhi Institute of Technology, Pampady
            <br>Kottayam
            <br>
          </p>
          <p>
            <abbr title="Phone">P</abbr>: 0481 2507763
          </p>
          <p>
            <abbr title="Email">E</abbr>:
            <a href="mailto:info@rit.ac.in">info@rit.ac.in
            </a>
          </p>
          <p>
            <abbr title="Hours">W</abbr>:
            <a href="http://www.rit.ac.in">www.rit.ac.in</a>
          </p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Contact Form -->
      <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <div class="row">
        <div class="col-lg-8 mb-4">
         <!-- <h3>Send us a Message</h3>
          <form name="sentMessage" id="contactForm"  method="post">
            <div class="control-group form-group">
              <div class="controls">
                <label>Full Name:</label>
                <input name="name" type="text" required="required" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Phone Number:</label>
                <input type="tel" name="phone" class="form-control" required="required" id="phone" required data-validation-required-message="Please enter your phone number.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email Address:</label>
                <input type="email" name="email" required="required" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Message:</label>
                <textarea rows="10" cols="100" required="required" name="message" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
              </div>
            </div>
            <div id="success"></div> -->
            <!-- For success/fail messages -->
           <!-- <input name="send" type="submit" class="btn btn-primary" id="sendMessageButton" value="Send Message">  -->
          </form>
        </div>

      </div>
      <!-- /.row -->

    </div>
    
<?php
include("footer.php");
?>