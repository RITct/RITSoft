<?php 
include("connection.php");
include("header.php");

include("sidenav.php");
global $i;
global $insert;
?>

<!--<script src="jquery.js"></script>-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Outcome Add</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<style>
	#selectpo {
		color: red;
	}
	</style>
  </head>
  <body>
  

   <div class="row 1">
      <div class="col-md-3">

      </div>
      <div class="col-md-8">
		
			<form name="co_add" action="" method="post">
			<!--<div class="split left">
			<div class="centered">
			-->
        <div class="panel panel-danger" style="margin-top:80px;">
          <div class="panel-heading">
            <h3 class="panel-title">COURSE OUTCOME ADD</h3>
          </div>
          <div class="panel-body">
		  <div class="split left">
			<div class="centered">
            <!-- <form name="co_add" method="post" action="#">-->
            <fieldset class="form-group">
                <label for="co">CO Code</label>
				<input class="form-control" type="text" name="co_code" id="co_code" placeholder="Eg: CO1" required="required">
			
			   </fieldset>
			     <fieldset class="form-group">
					<label for="co_name">CO Name</label>
				<input class="form-control" type="text" name="co_name" id="co_name" placeholder="Eg: Programming" required="required">
				</fieldset>
				<fieldset class="form-group">
					<label for="year">Date</label>
				<input class="form-control" type="text" name="year" id="year" placeholder="yyyy-mm-dd" required="required">
				</fieldset>
              <fieldset class="form-group">
				<label for="select">Select  relative  POs:</label><label id="selectpo">*Mandatory</label>
				<br>
				<input type="checkbox" name='check1' value='po1' id="check1">PO1
<select name='d1'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check2' value='po2' id="check2">PO2
<select name='d2'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check3' value='po3' id="check3">PO3
<select name='d3'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check4' value='po4' id="check4">PO4
<select name='d4'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check5' value='po5' id="check5">PO5
<select name='d5'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check6' value='po6' id="check6">PO6
<select name='d6'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> <br><br>
<input type="checkbox" name='check7' value='po7' id="check7">PO7
<select name='d7'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check8' value='po8' id="check8">PO8
<select name='d8'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check9' value='po9' id="check9">PO9
<select name='d9'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&emsp;&nbsp;
<input type="checkbox" name='check10' value='po10' id="check10">PO10
<select name='d10'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&nbsp;&nbsp;


<input type="checkbox" name='check11' value='po11' id="check11">PO11
<select name='d11'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&nbsp;&nbsp;

<input type="checkbox" name='check12' value='po12' id="check12">PO12
<select name='d12'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select><br><br>

<input type="checkbox" name='check13' value='pso1' id="check13">PSO1
<select name='d13'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&nbsp;&nbsp;

<input type="checkbox" name='check14' value='pso2' id="check14">PSO2
<select name='d14'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&nbsp;&nbsp;

<input type="checkbox" name='check15' value='pso3' id="check15">PSO3
<select name='d15'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&nbsp;&nbsp;

<input type="checkbox" name='check16' value='pso4' id="check16">PSO4
<select name='d16'>
<option value="0">Select</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
</select> &emsp;&nbsp;&nbsp;


</fieldset>
 <div class="button-panel">
		<input type="submit" class="btn btn-info" title="Save" name="submit" value="submit"></input>
    </div>


</div>
</div>
  <div class="split right">
    <div class="centered">
      <br>
      
      <br>

                                    <?php


                                    $result=mysqli_query($con,"select * from tbl_po");


                                		echo "<table border='1'>
                                		<tr>
                                		<th>PO CODE</th>
                                		<th>PO NAME</th>
                                		<th>PO DESCRIPTION</th>
                                		</tr>";
                                		while($row=mysqli_fetch_array($result))
                                		{
                                			echo "<tr>";
                                			echo "<td>" . $row['po_code'] . "</td>";
                                			echo "<td>" . $row['po_name'] . "</td>";
                                			echo "<td>" . $row['po_description'] . "</td>";
                                			echo "</tr>";
                                		}
                                		     echo "</table>";
                                			?>


                             </td>
                             </tr>
                         </table>
                       </em></p>
                     </div>
                     </div>
</div>

<?php
global $c;

if(isset($_POST['submit']))
{
	
	
if(isset($_SESSION['crs_id']))
{
	$c=$_SESSION['crs_id'];
}
		$co_code=mysqli_real_escape_string($con,$_POST["co_code"]);
		$co_name=mysqli_real_escape_string($con,$_POST["co_name"]);
		$year=$_POST["year"];
		$dept=$_SESSION['deptname'];
		$d_val1=0;
		$d_val2=0;
		$d_val3=0;
		$d_val4=0;
		$d_val5=0;
		$d_val6=0;
		$d_val7=0;
		$d_val8=0;
		$d_val9=0;
		$d_val10=0;
		$d_val11=0;
		$d_val12=0;
		$d_val13=0;
		$d_val14=0;
		$d_val15=0;
		$d_val16=0;
		
			
			
			$d_val1=$_POST['d1'];
			$d_val2=$_POST['d2'];
			$d_val3=$_POST['d3'];
			$d_val4=$_POST['d4'];
			$d_val5=$_POST['d5'];
			$d_val6=$_POST['d6'];
			$d_val7=$_POST['d7'];
			$d_val8=$_POST['d8'];
			$d_val9=$_POST['d9'];
			$d_val10=$_POST['d10'];
			$d_val11=$_POST['d11'];
			$d_val12=$_POST['d12'];
			$d_val13=$_POST['d13'];
			$d_val14=$_POST['d14'];
			$d_val15=$_POST['d15'];
			$d_val16=$_POST['d16'];
		
		/*if($d_val1==0 AND $d_val2==0 AND $d_val3==0 AND $d_val4==0 AND $d_val5==0 AND $d_val6==0 AND $d_val7==0 AND 
		   $d_val8==0 AND $d_val9==0 AND $d_val10==0 AND $d_val11==0 AND $d_val12==0 AND $d_val13==0 AND $d_val14==0 AND 
		   $d_val15==0 AND $d_val16==0)
		   {
			  		 echo "<script type='text/javascript'>alert('Please select relative PO's.!')</script>";
		
		   }
		   
			if(!isset($_POST['check1']) AND !isset($_POST['check2']) AND !isset($_POST['check3']) AND !isset($_POST['check4'])	
			AND !isset($_POST['check5']) AND !isset($_POST['check6']) AND !isset($_POST['check7']) AND !isset($_POST['check8'])
			AND !isset($_POST['check9']) AND !isset($_POST['check10']) AND !isset($_POST['check11']) AND !isset($_POST['check12'])
			AND !isset($_POST['check13']) AND !isset($_POST['check14']) AND !isset($_POST['check15']) AND !isset($_POST['check16']))
			{
				
			  		 echo "<script type='text/javascript'>alert('Please select relative PO's.!')</script>";
			}*/
		
			if(isset($_POST['check1']) OR isset($_POST['check2']) OR isset($_POST['check3']) OR isset($_POST['check4'])	
			OR isset($_POST['check5']) OR isset($_POST['check6']) OR isset($_POST['check7']) OR isset($_POST['check8'])
			OR isset($_POST['check9']) OR isset($_POST['check10']) OR isset($_POST['check11']) OR isset($_POST['check12'])
			OR isset($_POST['check13']) OR isset($_POST['check14']) OR isset($_POST['check15']) OR isset($_POST['check16']))
			{
						
						$query="INSERT INTO `tbl_co`(`co_code`,`co_name`,`subjectid`,`deptname`,`date`) VALUES
			('".$co_code."','".$co_name."','".$c."','".$dept."','".$year."')";
					$insert= mysqli_query($con,$query);
					
		    $q="INSERT INTO `co_po_correlation`(`co_code`,`po1`,`po2`,`po3`,`po4`,`po5`,`po6`,`po7`,`po8`,`po9`,`po10`,`po11`,`po12`,
			`pso1`,`pso2`,`pso3`,`pso4`,`course_id`) VALUES('".$co_code."','".$d_val1."',
			'".$d_val2."','".$d_val3."','".$d_val4."','".$d_val5."','".$d_val6."','".$d_val7."','".$d_val8."','".$d_val9."',
			'".$d_val10."','".$d_val11."','".$d_val12."','".$d_val13."','".$d_val14."','".$d_val15."','".$d_val16."','".$c."')";
			
		$i=mysqli_query($con,$q);
			$flag=1;
			}
		if($i and $insert)
		{
		 echo "<script type='text/javascript'>alert('CO added successfully!')</script>";
		}
				
	    else
	    {
		
		echo "<script type='text/javascript'>alert('Error in insertion')</script>";
	    }
	
}	
   	
	?>

  
  </div>
  </div>
  



	<a href="http://localhost:8080/myproject/faculty/dash_home.php"> Back to home</a>

	
  </div>
 </body>
 
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>
<?php
include("footer.php");
?>