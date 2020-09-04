
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<?php

include("header.php");
include("connection.php");
?>

<?php

 
 if(isset($_POST['submit']))
 {

  session_start();
  $user=$_SESSION['logid'];
  $opwd=$_SESSION['opwd'];
  $pwd1=$_POST['password1'];
  $pwd2=$_POST['password2'];
  $pwd3=$_POST['password3'];
  if($pwd2==$pwd3)
  {
	  if($opwd==$pwd1)
	  {
		  if($user!=$pwd3)
		  {
				$r=mysql_query("update login set password='$pwd2' where username='$user' and password='$pwd1'");
				if($r==null)
				{
					echo "<script>alert('Wrong Current Password')</script>";
				}
				else
				{
					echo "<script>alert('Password Change Sucessfully')</script>";
					echo "<script>window.location.href='login.php'</script>";
				}
		  }
		  else
			  echo "<script>alert('Do not use the username and password as same')</script>";
	  }
      else
	  {
		echo "<script>alert('Correctly enter the old password')</script>";
	  }	  
   } 
   else
   {
     echo "<script>alert('Correctly re-enter the Password')</script>";
   }
 }
?>
<section id="pass" >
<html>
<head>
<style>
 td
 {
   padding:0 15px 0 15px;
   padding-top: 10px;
   padding-bottom: 10px;

 }
 
 </style>
<title>
Change Password
</title>
</head>
<body>
  <center>
<h1> Change Password </h1>
</center>
<center>
<form id="changepswd" method="post">
<table>
  <tr>

  <td>
  <div class="input-group">
  <input type="password" class="form-control pwd" name="password1" placeholder="Old Password" required pattern="^[A-Za-z0-9@.\s]{2,50}$" title="Text contains only AlphaNumeric ,Space ,@ and Period" />  
  <span class="input-group-btn">
            <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
          </span>   
  </div>
  </td>
  </tr> 
<tr>

  <td>
  <input type="password" class="form-control" name="password2" placeholder="New Password" required pattern="^[A-Za-z0-9@.\s]{2,50}$" title="Text contains only AlphaNumeric ,Space ,@ and Period"  /> 
  </td>
</tr>
<tr>

<td>
<input type="password" class="form-control" name="password3" placeholder="Re-enter New Password" required pattern="^[A-Za-z0-9@.\s]{2,50}$" title="Text contains only AlphaNumeric ,Space ,@ and Period"  /> 
</td>
</tr>
<tr>

<td>
<button type="reset" class="btn btn-primary " value="Reset">Cancel</button>
<input type="submit"  class="btn btn-primary " name="submit" value= "Submit"/>
</td>
</tr>
</table>
</center>
</form>
</body>
</html>
</section>
<script>
$(".reveal").on('click',function() {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script>
<?php include("footer.php"); ?> 
 