<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style type="text/css">
   
   table {
	   margin-top: 200px;
    border-collapse: collapse;
    border-spacing: 10px;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
	text-align:center;
}

tr:nth-child(even){background-color: #f2f2f2}
text-align:center;
}
</style>

<?php
error_reporting(0);
//session_start();
//$con=mysqli_connect("localhost","root","","ritsoft5");
include("../connection.mysqli.php");
include("includes/header.php");
include("includes/sidenav.php");
include('../connection.php');


$datea="";	
$hour="";
$name="";
$admisno=$_SESSION['adm'];
$name=$_SESSION['n'];
?>
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;"> ATTENDANCE DETAILS 
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

<label for="txtstudid"></label>
<form id="form1" name="form1" method="post" action="">
<table>

</tr><?php

echo "ADMISSION NO:$admisno";
?></tr><br>
<br><tr><?php
echo "NAME:$name";?>
</tr>

<tr><td>
<!--Admission No :<input type="text" id="txtadmission" name="txtadmission" value="" required="true" />-->
 Date From<input type="date" name="date1" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>"/></td>
<td>Date To<input type="date" name="date2" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" /> </td>
<td><input type="submit" name="submit" value="Submit" /></td>
<table>
<table border="1">
    
 <tr> <strong><h2 style="font-size:250%;"> ABSENT DATES AND HOURS</h2> </strong>
 
    
 <tr><th style='text-align:center;'>Absent Date </th> <th style='text-align:center;'> Hour </th></tr>
<?php
if(isset($_POST["submit"]))
{
//$admisno=$_POST["txtadmission"];
$date1=$_POST["date1"];	
$date2=$_POST["date2"];	

$dat=mysqli_query($con,"select distinct(date),classid from attendance where studid='$admisno' and date BETWEEN '$date1' and '$date2' and status='A'");

while($result=mysqli_fetch_array($dat)) 	
{       $c=$result["classid"];
	$date=$result["date"];
	?>
 <tr></tr>
    
    <tr>
    <td><?php echo $date; ?></td>
    <td>
    <?php
$sql=mysqli_query($con,"select distinct(hour) from attendance where studid='$admisno' and date='$date' and status='A'");	
while($result=mysqli_fetch_array($sql)) 	
{	
	$hour=$result["hour"];
	 //
	 echo "&nbsp;&nbsp;&nbsp;&nbsp; $hour" ;
}	
?>
</td>
</tr>
<?php
}

?>
</tr>
</table>




	<h2 style="font-size:250%;">SUBJECTWISE ATTENDANCE DETAILS</h2>
   <table border="1" width="100%">
    <tr>

    </tr>
       <tr>
    <?php
        
	$res=mysqli_query($con,"select * from subject_allocation where classid='$c' order by subjectid asc");
	while($rs=mysqli_fetch_array($res))
	{
	?>
    <td><?php echo $rs["subjectid"]; ?></td>
    <?php
	}
	?>
    <td>Total</td>
    
       </tr><tr>     
   		<?php
				$total=0;
				$present=0;
				$res3=mysqli_query($con,"select * from subject_allocation where classid='$c' order by subjectid asc");
				while($rs3=mysqli_fetch_array($res3))
			{
					
					$res4=mysqli_query($con,"select * from attendance where studid='$admisno' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid like'UG%'");
					$res5=mysqli_query($con,"select * from attendance where studid='$admisno' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid like'UG%' and status='P'");
					?>
              		<td><?php 
					if(mysqli_num_rows($res4)==0)
					echo "0%";
					else
					echo  round((mysqli_num_rows($res5)/mysqli_num_rows($res4))*100)."%"; ?></td>
					<?php
					$total+=mysqli_num_rows($res4);
					$present+=mysqli_num_rows($res5);						
				}
				?>
                <td><?php 
				if($total==0)
				echo "0%";
				else
				echo round(($present/$total)*100)."%"; ?></td>
    
			</tr>
			<?php
		
		//$j++;
	
	?>
</table>
<h2 style="font-size:250%;">SUBJECT CODE DETAILS</h2>


   <table width="34%" border="1" cellpadding="0" cellspacing="0">
    <?php
//	$class=explode(",",$_REQUEST['class']);	
 //$class=explode(",",$_POST['class']);
 ?>
 
  <tr> <th> subject id </th> <th> subject name </th></tr>
  <?php
	$c=mysqli_query($con,"select * from subject_class where classid='$c' order by subjectid asc");
while($re=mysqli_fetch_array($c))
{
	?>
      <tr>
    
        <th scope="col"><?php echo $re["subjectid"]; ?></th>
        <th scope="col" align="left"><?php echo $re["subject_title"]; ?></th>
      </tr>
      <?php
}}
?><tr> 
        </table>


</form>
</div>
<?php

include("includes/footer.php");
?>