<?php
session_start();
ob_start();
error_reporting(getenv("MYSQL_USER") ? E_ALL : 0);
ini_set('display_errors', getenv("MYSQL_USER") ? '1' : '0');
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RITSoftv2</title>
    <link rel="icon" type="image/png" href="images/logob.png" />
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style>
	.title {
    font-family: 'Open Sans', sans-serif;
}
	body {
    opacity: 1;
    transition: 1s opacity;
}
body.fade-out {
    opacity: 0;
    transition: none;
}
html {
    background-color: black;
}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
$(function() {
    $('body').removeClass('fade-out');
});

</script>
<script>
function getcourse()
{
  document.getElementById('form1').submit();
}
function getspec()
{
  document.getElementById('form1').submit();
}
function validate()
{
  var course1=document.getElementById("course1").value;
    if(course1=="")
        {
            alert("Choose your course");
            document.getElementById("course1").focus();
            return false;
        }
  var spec=document.getElementById("spec").value;
    if(spec=="")
        {
            alert("Choose your branch");
            document.getElementById("spec").focus();
            return false;
        }
  /*var bch=document.getElementById("bch").value;
    if(bch=="")
        {
            alert("Choose your batch");
            document.getElementById("bch").focus();
            return false;
        }*/
  cho = ""
  le = document.form1.admtype.length
  for (i = 0; i <le; i++)
  {
    if (document.form1.admtype[i].checked)
    {
      cho = document.form1.admtype[i].value
    }
  }
  if (cho == "")
  {
    alert("Enter admission type");
    return false;
  }
   
  chosen = ""
  len = document.form1.gender.length
  for (i = 0; i <len; i++)
  {
    if (document.form1.gender[i].checked)
    {
      chosen = document.form1.gender[i].value
    }
  }
  if (chosen == "")
  {
    alert("Enter your sex");
    return false;
  }
  var blood=document.getElementById("blood").value;
    if(blood=="")
        {
            alert("Enter your blood group");
            document.getElementById("blood").focus();
            return false;
        }
  return true;
}
</script>
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>
<script>document.body.className += ' fade-out';</script>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img class="img-fulid" src="images/logo.png" alt="RIT" style="width:50px" id='Logo'></a></a><h3 style="color :#007bff ; font-family: 'Berkshire Swash', cursive;" ><span style="color :white;">RIT</span>Soft <span style="color :red;">v2</span></h3>
        <!--<h3 style="color :blue ; font-family:'Ubuntu Condensed', sans-serif;" ><span style="color :white;">RIT</span>Soft <span style="color :red;">v2</span></h3>-->
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          <!--<li class="nav-item">
              <a class="nav-link" href="http://mca.rit.ac.in/testing/hostel">Hostel</a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
			<li class="nav-item">
       
              <button class="btn btn-primary"  onclick="window.location.href='login.php#data'">Login</button>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
<header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('images/1.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>RIT Soft</h3>
              <p>Made in RIT</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('images/2.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>RIT Soft</h3>
              <p>Made for RIT</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('images/3.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>RIT Soft</h3>
              <p>Made by RIT</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>
	<br>
	<br>
	<br>
	
<section id="data">
