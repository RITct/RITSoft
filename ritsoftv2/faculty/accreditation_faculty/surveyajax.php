<?php
$connection=mysqli_connect("localhost","root","","ritsoft");
session_start();
$c=0;
$q="";
$notacc=0;
$acc3=0;
$acc4=0;
$acc5=0;
$acceptable=0;
$n=0;
$ar=array();
if(isset($_POST['id']))
{
  $_SESSION['id']=$_POST['id'];
  $query="SELECT * FROM survey_attainment WHERE subjectid='".$_POST["id"]."' ";
  $result=mysqli_query($connection,$query);

  ?>

	<table class="table table-bordered" id="dynamic">

		<tr >
			<td colspan="7"><center>Consolidated Course End Survey Analysis,&nbsp;&nbsp;No of Students=<?php echo (isset($st))?$st:'';?></center></td>

			   </tr>
		<tr>
		<th rowspan="2">Number of <br>Students Scored<br> in the Range</th>
	    <th>Not Acceptable</th>
		<th colspan="3">Acceptable Range</th>
		<th rowspan="2">Total in the Acceptable Range</th>
    <th rowspan="2">Attainment level in Percentage</th>
		</tr>
		<tr>
		<th>Marks:1\& 2</th>
		<th>Marks:3</th>
		<th>Marks:4</th>
		<th>Marks:5</th>
		</tr>
     <?php
	 while($row=mysqli_fetch_array($result))
	 {
     $notacc=$row['unsure'] + $row['notconfident'];
     $acc3=$row['average'];
     $acc4=$row['confident'];
     $acc5=$row['highconfident'];
     $acceptable=$acc3+$acc4+$acc5;
     $tot=$acc3+$acc4+$acc5+$notacc;
     $attainmnt=($acceptable/$tot)*100;
     ?>

		 <tr><td><?php echo $row['co_code'];?></td><td><?php echo $notacc;?></td><td><?php echo $acc3; ?></td><td><?php echo $acc4; ?></td><td><?php echo $acc5; ?></td>
       <td><?php echo $acceptable; ?></td><td><?php echo $attainmnt; ?></td></tr>
		 <?php
     array_push($ar,$row['co_code']);
    }
    $c=mysqli_num_rows($result);
$n=$n+$c;
     }
  ?>
	</table>
  <button align="right" type="submit" name="submit" class="btn btn-info" id="bt"> Submit </button>
<?php
  if(isset($_POST['submit']))
  {
    for($i=1;$i<=$n;$i++)
    {
    $query1="INSERT INTO survey_attainment(`attainmnt_percent`) WHERE subjectid='".$_POST["id"]."' AND co_code='".$ar[$i]."' ";
    $insert=mysqli_query($connection,$query1);
    if(!$insert)
    {
      echo mysqli_errno();
    }
    else
    {
      echo "inserted";
    }
  }
  }
  ?>
