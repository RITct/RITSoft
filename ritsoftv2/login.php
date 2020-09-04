<?php
include("header.php");
include("connection.php");
?> 
<script src='https://www.google.com/recaptcha/api.js'></script>

 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


 <style>
 .card {
 	box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
 	transition: 0.3s;
 	width: 40%;
 	border-radius: 5px;
 }

 .card:hover {
 	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
 }

 img {
 	border-radius: 5px 5px 0 0;
 }

 .container {
 	padding: 2px 16px;
 }
</style>





<script>
	function showmodal()
	{
		document.getElementById('id01').style.display='block';
	}
</script>

<?php
if(isset($_POST['login']))
{
	//if(isset($_POST['g-recaptcha-response']))
		//$captcha=$_POST['g-recaptcha-response'];

	//if(!$captcha){
		//echo "<script>alert('Please check the the captcha form')</script>";

	//}
	//else
	//{
		//$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfwrU0UAAAAAJL8H-Bs-5ube4YBdZ3ng8koWLFW&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		/*if($response['success'] == false)
		{
			echo "<script>alert('wrong captcha')</script>";

		}
		else
		{*/
                       
			$uname=$_POST['username'];
			$pwd=$_POST['password']; 

                         $uname = preg_replace("/[^a-zA-Z0-9@._]/", "", $uname);
                         $pwd = preg_replace("/[^a-zA-Z0-9@.#$*_]/", "", $pwd);
                         
			$r=mysql_query("select usertype from login where username='$uname' and password='$pwd'",$con) or die(mysql_error());
			$n=mysql_num_rows($r);

 //echo  mysql_error(); 
			if($n == 1 )
			{
				$_SESSION['logid']=$uname;
				$_SESSION['opwd']=$pwd; 
				if($uname==$pwd)  
				{
					 echo "<script>window.location.href='changepassword.php#pass'</script>";  
				}	  
				else
				{
					$row=mysql_fetch_array($r);
					if ($row['usertype']=="admin")
					{
						$_SESSION['adminid']=$uname; 
						$_SESSION['utype']=$row['usertype']; 
  // echo "<script>alert('Logged In Successfully')</script>";
						echo "<script>window.location.href='admin/dash_home.php'</script>";
					}
					elseif ($row['usertype']=="student")
					{
						$x=mysql_query("select admissionno from stud_details where admissionno='$uname' ",$con);
						$y=mysql_num_rows($x);
						if($y == 1 )
						{
							$ro=mysql_fetch_array($x);
						        $_SESSION['admissionno']=$ro['admissionno'];
						// *	$_SESSION['studid']=$uname;
							$_SESSION['utype']=$row['usertype'];
	 //echo "<script>$('#my-modal').modal({ show: 'false'}); </script>";
   // echo "<script>alert('Logged In Successfully')</script>";
							echo "<script>window.location.href='student/dash_home.php'</script>";
                                                   // echo "<script>window.location.href='index.php'</script>";
						}

					}

					elseif ($row['usertype']=="office")
					{
						$_SESSION['officeid']=$uname;
						$_SESSION['utype']=$row['usertype'];
  //echo "<script>alert('Logged In Successfully')</script>";
						echo "<script>window.location.href='office/dash_home.php'</script>";
					}
                   elseif ($row['usertype']=="admission")
					{
						$_SESSION['admofficeid']=$uname;
						$_SESSION['utype']=$row['usertype'];
  //echo "<script>alert('Logged In Successfully')</script>";
						echo "<script>window.location.href='admission.php'</script>";
					}

					elseif ($row['usertype']=="faculty")
					{
						$x=mysql_query("select fid from faculty_details where email='$uname' or phoneno='$uname'",$con);
						$y=mysql_num_rows($x);
						if($y == 1 )
						{
							$ro=mysql_fetch_array($x);
							$_SESSION['fid']=$ro['fid'];

							$faid=$ro['fid'];

							$_SESSION['facultyid']=$uname;
   //$_SESSION['utype']=$row['usertype'];
							$resu =mysql_query("select * from faculty_designation where fid='$faid' ",$con);
							$z=mysql_num_rows($resu);
							if($z == 0 )
							{
								echo "<script>window.location.href='faculty/dash_home.php'</script>"; 
							}

							else
							{	   
								?>

								<style type="text/css">
								.mystyle-pop {
									z-index: 17 !important; 
									}.mystyle-pop .w3-modal-content{
										z-index: 17 !important;
										box-shadow: 0 8px 6px -6px black;
									}
									.now-on-top {
										/*display: none;*/
									}

									.mystyle-pop  input[type=submit] {
										margin-top:1pc;
									}

									.mystyle-pop>div {
										padding-bottom: 20px;
									}
								</style>

								<div id="id01" class="w3-modal mystyle-pop">
									<div class="w3-modal-content w3-animate-top w3-card-6">
										<header class="w3-container w3-teal"> 
											<span onclick="document.getElementById('id01').style.display='none'" 
											class="w3-button w3-display-topright">&times;</span>

											<h2 align="center">Select your Designation</h2>
										</header>
										<br>
										<br> 

										<?php


										$faid=$_SESSION['fid'];
										$result =mysql_query("select * from faculty_designation where fid='$faid' ",$con);
										echo '<div class="span12 ">';

										while ($i=mysql_fetch_assoc($result)) 
										{
											$des=$i["designation"]; 
											?>



											<?php		  
											if($des=='principal')
											{
												$_SESSION['utype']="principal";
												?>  
												<div class="row">
													<div class="col-md-4">
													</div>
													<div class="col-md-4">
														<input type="submit" class="btn btn-primary btn-block" value="  PRINCIPAL  " onclick="window.location.href='principal/dash_home.php'" />
													</div>
													<div class="col-md-4">
													</div>
												</div>
												<?php
											} 
											else if($des=='student_affairsdean' )
											{
												$_SESSION['utype']="principal";
												?>  
												<div class="row">
													<div class="col-md-4">
													</div>
													<div class="col-md-4">
														<input type="submit" class="btn btn-primary btn-block" value="  STUDENT AFFAIRS DEAN  " onclick="window.location.href='principal/dash_home.php'" />
													</div>
													<div class="col-md-4">
													</div>
												</div>
												<?php
											} 

											else if($des=='ugdean')
											{
												$_SESSION['utype']="ugdean";
												?>		
												<div class="row">
													<div class="col-md-4">
													</div>
													<div class="col-md-4 ">
														<input type="submit" class="btn btn-primary btn-block" value="   UGDEAN   "  onclick="window.location.href='ugdean/dash_home.php'" />
													</div>
													<div class="col-md-4">
													</div>
												</div>
												<?php		
											}
											else if($des=='pgdean')
											{
												$_SESSION['utype']="pgdean";
												?>	
												<div class="now">
													<div class="row">
														<div class="col-md-4">
														</div>
														<div class="col-md-4">
															<input type="submit" class="btn btn-primary btn-block" value="   PGDEAN    " onclick="window.location.href='pgdean/dash_home.php'" /> 
														</div>
														<div class="col-md-4"></div>
													</div>
												</div>
												<?php
											}
											else if($des=='hod')
											{
												$_SESSION['utype']="hod";
												?>
												<div class="row">
													<div class="col-md-4"></div>

													<div class="col-md-4">
														<input type="submit" class="btn btn-primary btn-block" value="      HOD    " onclick="window.location.href='hod/dash_home.php'" />

													</div>

													<div class="col-md-4"></div>
												</div>
												<?php 
											} 
											else if($des=='faculty')
											{
												$_SESSION['utype']="faculty";
												?>
												<div class="row">
													<div class="col-md-4"></div>
													<div class="col-md-4 " >
														<input type="submit" class="btn btn-primary btn-block" value="   FACULTY   " onclick="window.location.href='faculty/dash_home.php'" />
													</div>
													<div class="col-md-4"></div>
												</div>
												<?php
											}
											else if($des=='staff advisor')   
											{ 
												$_SESSION['utype']="staffadvisor";
												?>
												<div class="row">
													<div class="col-md-4"></div>

													<div class="col-md-4">
														<input type="submit" class="btn btn-primary btn-block" value="STAFF ADVISOR" onclick="window.location.href='staffadvisor/home1.php'" />
													</div>
													<div class="col-md-4"></div>
												</div>
												<?php	
											}

											echo ' <div class="col-md-4">';
											echo '<br>';
											echo '</div>';
										}
									} 
									?>

								</div>	 

							</div>




						</div>



						<?php
// echo "<script>alert('Logged in Successfully')</script>";
	//echo "<script>window.location.href='faculty/'</script>";
						echo "<script>showmodal();</script>";
					} 
				}
				elseif ($row['usertype']=="parent")
				{
					$x=mysql_query("select parentid from parent where guard_email='$uname' or guard_contactno='$uname'",$con);
					$y=mysql_num_rows($x);
					if($y == 1 )
					{
						$ro=mysql_fetch_array($x); 
						$_SESSION['parentid']=$ro['parentid'];
						$_SESSION['pid']=$uname;
						$_SESSION['utype']=$row['usertype'];

						echo "<script>window.location.href='parent/dash_home.php'</script>"; 
						echo "<script>alert('PARENT')</script>";
					}
				}
			}
		}
		else
			echo "<script>alert('Incorrect username or password')</script>";
	}
//}
//}
?> 
<style>
td {
	padding:0 15px 0 15px;
	padding-top: 10px;
	padding-bottom: 10px;

}
.set-center {
	padding: 2pc 0;
	background: rgba(255, 255, 255, 0.9);
	z-index: 15;
}
.carousel-item {
	height: 100%;
}
br {
	display: none;
}

.now-on-top {
	position: absolute;
	top: 18%;
	width: 100%;
}
footer {
	position: absolute;
	width: 100%;
	bottom: 0;
	padding: 1.5pc 0 !important;

}
.carousel-indicators , .carousel-control-prev, .carousel-control-next, .carousel-caption {
	display: none !important;
}

</style>

<div class="now-on-top">
	<div class="row">

		<div class="col-md-12  ">

			<center>
				<div class="col-md-5 set-center"> 



					<h1 style ="color : #fffff;"> Login </h1>


					<script type="text/javascript"> 


						//function validateRecaptcha(){ 

							//if(grecaptcha.getResponse().length == 0){
								//alert('Please click the reCAPTCHA checkbox');
								//return false;
							//}
							//return true;
						//}


					</script>


					<br> 
                                       <!--   <form id="login" method="post" onsubmit="return validateRecaptcha();"> -->
					<form id="login" method="post">
						

                                                         <table>
							<tr>

								<td>
									<input type="text" name="username" class="form-control" placeholder="Username" required />
								</td>
							</tr>
							<tr>
								<td>
									<input type="password" name="password" class="form-control" placeholder="Password" required pattern="^[A-Za-z0-9@.\s]{2,50}$" title="Text contains only AlphaNumeric ,Space ,@ and Period"  /> 
								</td>
							</tr>
							<!-- <tr>
								<td>
									<div class="g-recaptcha" data-sitekey="6LfwrU0UAAAAAIlBFiHL7S77hwb-GPgZPhITfD0J"  ></div>
								</td>
							</tr> -->
							<tr>
								<td>
									<input type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" name="login" value= "Login"/>
									
									
								</td>
							</tr>
						</table> 
					</form>
					<br><br><a href="forgotpwd.php"> Forgot Password</a>

				</div>
			</center>

		</div>

	</div>
</div>

<?php include("footer.php"); ?>
