<?php
include ('connection.php');
include('check.php');

function encryptData($value){
   $key = "1234567890123456";
   $text = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
   return $crypttext;
}

function decryptData($value){
   $key = "1234567890123456";
   $crypttext = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
   return trim($decrypttext);
}
if(isset($_GET['delete_id']))
{
 $sql_query="DELETE FROM upload WHERE id=".$_GET['delete_id'];
 mysqli_query($con,$sql_query);
 header("Location: admin-view-details.php");
 ?>
<script>
    document.getElementById('demo').innerHTML = "deleted";
    </script>
<?php
}
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Record deleted.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Something went wrong. Try again.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<title>View schedules</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
        <script type="text/javascript">
        function delete_id(id)
        {
        if(confirm('Sure To Remove This Record ?'))
        {
            window.location.href='admin-view-details.php?delete_id='+id;
        }
        }
        </script>
	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<div class="page-inner">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
                                    <div id="gtco-logo"><a href="upload.php">Exam Schedule <em>.</em></a></div>
				</div>
                            <?php if(!empty($statusMsg)){
            echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
            } ?>
            
				<div class="col-xs-8 text-right menu-1">
					<ul>
                                            <li><a href="upload.php">Upload</a></li>
                                            <li><a href="admin-view-details.php">View</a></li>
						<li class="btn-cta"><a href="logout.php"><span>Logout</span></a></li>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_2.jpg); height: 80px ">
		<div class="overlay"></div>
	</header>
	
	
            <div id="gtco-features">
                <?php
    $sql="SELECT * FROM upload order by date desc";
    $result=mysqli_query($con,$sql);
    if(isset($_GET["id"]))
    {
        $filename = "uploads/".$_GET["id"];
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));

        $DecryptedData=decryptData($contents);
    //create a folder named uploads in project directory
        $handle = fopen("uploads/temp.pdf", "w");
        $contents = fwrite($handle,$DecryptedData);
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=uploads\temp.pdf");
        @readfile('uploads\temp.pdf');
    }

    ?>
		<div class="gtco-container">
                    <h2 class="text-center">Schedules</h2>
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Section</th>
                                    <th>Details</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
               while ($rows=mysqli_fetch_assoc($result))
                {
			
              
                echo '<tr id=echo $rows[id];>';
                   echo '<td>'.$rows["date"].'</td>';
				echo '<td>'.$rows["time"].'</td>';
				  echo "<td><a href=view-details.php?id=".rawurlencode($rows['fname']).">View </a></td>";?>
				<td><a href="javascript:delete_id(<?php echo $rows['id']; ?>)"><img src="b_drop.png" alt="Delete" /></a></td>
                                  <?php echo "</tr>";
                }
                ?>
                           
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>
			
		</div>
	</div>

	<div id="gtco-subscribe">
		
	</div>

	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>About <span class="footer-logo">Splash<span>.<span></span></h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore eos molestias quod sint ipsum possimus temporibus officia iste perspiciatis consectetur in fugiat repudiandae cum. Totam cupiditate nostrum ut neque ab?</p>
					</div>
				</div>

				<div class="col-md-4 col-md-push-1">
					<div class="gtco-widget">
						<h3>Links</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Knowledge Base</a></li>
							<li><a href="#">Career</a></li>
							<li><a href="#">Press</a></li>
							<li><a href="#">Terms of services</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>Get In Touch</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-phone"></i> +1 234 567 890</a></li>
							<li><a href="#"><i class="icon-mail2"></i> info@FreeHTML5.co</a></li>
							<li><a href="#"><i class="icon-chat"></i> Live Chat</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://FreeHTML5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

