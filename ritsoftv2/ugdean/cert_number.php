<?php
include("includes/header.php");
include('../connection.php');
error_reporting(0);
include("includes/sidenav.php");
 $course=$_SESSION['courseid'];
 $classid=$_SESSION['classid'];
 //echo $admis;
//$name1=$_SESSION['name'];
//echo $name1;
 $rcpt_no="";
 //echo $classid;
?>
<div id="page-wrapper">

<form id="form1" name="form1" method="post" action="p3.php">
<div align="center">
    <p>&nbsp;</p>
	<center>
    <table width="700" height="279" border="0" background="img2/116209-desktop-wallpaper-desktop-wallpaper-1920x1200.jpg">
      <tr bgcolor="#002040">
        <td><th height="57" colspan="4" scope="row"><font color="#FFFFFF"><h3><b>STUDENT CERTIFICATE</h3></b</th></td>
      </tr>
      <tr>
        <?PHP
 //echo "second".$course.$branch.$spec;
	 //include('db_connection.php');
	$sql="select rcpt_no from serialno where classid='$classid'";
	 $result1=  mysql_query($sql);
	  while($db_field=mysql_fetch_array($result1))
	{ $rcpt_no=$db_field['rcpt_no'];
		}
	//$rcpt_no=str_pad($rcpt_no+1,3,0,STR_PAD_LEFT);
	
				
		
	
	
		
	//$rcpt_no=str_pad($rcpt_no+1,3,0,STR_PAD_LEFT);
	//$sql="insert into serial_no values(null,$d_id,$rcpt_no,$adm)";
	//
			
		
	
	 //$rcpt_no=str_pad($rcpt_no+1,3,0,STR_PAD_LEFT);
	 	
	?>
        <th width="154" height="120" scope="row">Certificate Number</th>
        <td width="230"><input type="text" name="no" id="no" value="<?php echo $rcpt_no; ?>">
		</td>
		
      </tr>
      <tr>
       <td> <th height="94" colspan="2" scope="row"><input type="submit" name="ok" id="ok" value="OK"> </th></td>
      </tr>
    </table>
	</center>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<?php

include("includes/footer.php");
?>