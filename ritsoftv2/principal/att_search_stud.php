<?php
//session_start();
//$con=mysqli_connect("localhost","root","","ritsoft5");
include("includes/connection1.php");
include("includes/header.php");
include("includes/sidenav.php");
//include('includes/connection.php');
error_reporting(0);

$datea="";  
$hour="";
$name="";
$admisno=$_SESSION['adm'];
$name=$_SESSION['n'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="jquery-ui.css" rel="stylesheet">
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-ui.js" type="text/javascript"></script>
<script>
$(document).ready(function()
{
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
  var day = dtToday.getDate(); 
  //var day1= date('Y-m-d', strtotime('-2 day',strtotime($date_raw)));
  
    
 
        //var  day1 = strtotime('-3 day', time());
  var year = dtToday.getFullYear();
  if(month < 10)
      month = '0' + month.toString();
  if(day < 10)
      day = '0' + day.toString();
  
    
       
  var maxDate = year + '-' + month + '-' + day;

   $('#date1').attr('max', maxDate);
    $('#date2').attr('max', maxDate);
}
);
</script>

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
<div class="row">
  <div class="col-md-6">
    <label>
      ADMISSION NO
    </label>
    <input type="text" disabled="disabled" class="form-control" name="" value="<?php echo $admisno; ?>">
  </div>

  <div class="col-md-6">
    <label>
      NAME
    </label>
    <input type="text" disabled="disabled" name="" class="form-control" value="<?php echo $name; ?>">
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <label>
      Date From
    </label>
    <input type="date" name="date1" id="date1" class="form-control" placeholder="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>"/>
  </div>
<div class="col-md-6">
  <label>
    Date To
  </label>
  <input type="date" name="date2" id="date2" class="form-control" placeholder="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" /> 
</div>
</div>
<br>

<div class="row">
<div class="col-sm-4">
  
</div>
<div class="col-sm-4">
  <input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit" />
</div>
</div>
</form>
<!--Admission No :<input type="text" id="txtadmission" name="txtadmission" value="" required="true" />-->
 <br>
 <?php
 if(isset($_POST["submit"]))
{
  ?>
<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ABSENT DATES AND HOURS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" style="margin-top: 0px">
                                    <thead>
                                        <tr>
                                            <th><center> Absent Date</center></th>
                                            <th><center>Hour</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 
                                        <?php

//$admisno=$_POST["txtadmission"];
$date1=$_POST["date1"]; 
$date2=$_POST["date2"]; 

$dat=mysqli_query($con,"select distinct(date),classid from attendance where studid='$admisno' and date BETWEEN '$date1' and '$date2' and status='A'");

while($result=mysqli_fetch_array($dat))   
{       $c=$result["classid"];
  $date=$result["date"];
  ?>
 
    
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


                                 
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

</div>






<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            SUBJECTWISE ATTENDANCE DETAILS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" style="margin-top: 0px">
                                    <thead>
                                        <tr>
                                          
    <?php
        
  $res=mysqli_query($con,"select * from subject_allocation where classid='$c' order by subjectid asc");
  while($rs=mysqli_fetch_array($res))
  {
  ?>
    <th><center><?php echo $rs["subjectid"]; ?></center></th>
    <?php
  }
  ?>
  <th>Total</th>

                                           </tr>
                                    </thead>
                                    <tbody>
                




    
    
       </tr><tr>     
   		<?php
				$total=0;
				$present=0;
				$res3=mysqli_query($con,"select * from subject_allocation where classid='$c' order by subjectid asc");
				while($rs3=mysqli_fetch_array($res3))
			{
					
					$res4=mysqli_query($con,"select * from attendance where studid='$admisno' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid like'PG%'");
					$res5=mysqli_query($con,"select * from attendance where studid='$admisno' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid like'PG%' and status='P'");
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
                                    
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

</div>







<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            SUBJECT CODE DETAILS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" style="margin-top: 0px">
                                    <thead>
                                        <tr>
                                              <?php
//  $class=explode(",",$_REQUEST['class']); 
 //$class=explode(",",$_POST['class']);
 ?>
  <th> <center> subject id </center> </th> <th><center> subject name </center></th>
 </tr>
 
                    
 </thead>
                                    <tbody>

  
  <?php
	$c=mysqli_query($con,"select * from subject_class where classid='$c' order by subjectid asc");
while($re=mysqli_fetch_array($c))
{
	?>
      <tr>
    
        <td scope="col"><?php echo $re["subjectid"]; ?></td>
        <td scope="col" align="left"><?php echo $re["subject_title"]; ?></td>
      </tr>
      <?php
}}
?>

                                    
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

</div>



</div>
<?php

include("includes/footer.php");
?>
