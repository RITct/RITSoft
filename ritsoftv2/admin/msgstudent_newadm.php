<?php
//include("includes/header.php");
//include("includes/sidenav.php");

$i=0;

$file = fopen('welcomesms1.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE) {
	
	$name=$line[0];
$phno = $line[1];
$msg='Dear '.$name.', Congratulations and Hearty welcome to RIT!! Please report on 22nd July at 9.30 AM at College Auditorium - RIT Family.';
sendmsg($phno,$msg);
  //$line is an array of the csv elements
 //print_r($line);

$i=$i+1;

}
echo "<script> alert(' Messages Send successfully') </script>";

fclose($file);

function sendmsg($to,$msg)
{
		//sms text
       $text = urlencode($msg);
 
        $curl = curl_init();
 
        // Send the POST request with cURL
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => "http://reseller.smschub.com/api/sms/format/xml",
        CURLOPT_POST => 1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array('X-Authentication-Key:edf87d1db55f64a7918a0ef0b427dfe9', 'X-Api-Method:MT'),
        CURLOPT_POSTFIELDS => array(
                        'mobile' => $to,
                        'route' => 'TL',
                        'text' => $text,
                        'sender' => 'RITKTM')));
 
    // Send the request & save response to $response
    $response = curl_exec($curl);
 
    // Close request to clear up some resources
    curl_close($curl);
 
    // Print response
   // print_r($response);

}

//include("includes/footer.php");



?>
