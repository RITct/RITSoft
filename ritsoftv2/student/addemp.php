<?php
session_start();
include("includes/connection.php");

if (isset($_POST['submit'])) {

	$studid=$_SESSION["admissionno"];
	$url = 'temp.jpg';

    $filename = compress_image($_FILES["file"]["tmp_name"], $url, 50);   
   	//........Query for update stud_details table........
	$sql ="update stud_details set image= '" . addslashes(file_get_contents($url)) . "' , image_status  = 'Not Verified'  where admissionno='$studid'";
	mysql_query($sql) or die(mysql_error()); 
	unlink($url);
	echo "<script>alert('Uploaded Successfully')</script>";
	echo "<script>window.location.href='dash_home.php'</script>";
}
function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);  

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($source_url);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($source_url);

    		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}

?>