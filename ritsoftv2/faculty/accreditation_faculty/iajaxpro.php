<?php
$connection=mysqli_connect("localhost","root","","ritsoft");
session_start();
$count=0;
$c=[];
$m=0.0;
$n=0;
$count=0;
$c=[];
$m=0.0;
$n=0;
$num1=0;
$num2=0;
$num3=0;
$num4=0;
$num5=0;
$course_id=$_POST["id"];
$_SESSION['course']=$_POST["id"];
$totalattainmnt=array();
$_SESSION['data1array']=array();
$_SESSION['data2array']=array();
$_SESSION['data3array']=array();
$_SESSION['data4array']=array();
$_SESSION['surveyval']=array();

if(isset($_POST['id']))
{
		$query="SELECT * FROM tbl_co WHERE subjectid='$course_id' ";
        $result=mysqli_query($connection,$query);
        $c=array($result);
        $count=count($c);
        ?>
        <?php
        while($row=mysqli_fetch_array($result))
        {
          $n=$n+1;
        $query1="SELECT * FROM internal WHERE subjectid='$course_id' AND co_code='".$row['co_code']."' AND test_no='1' ";
        $result1=mysqli_query($connection,$query1);
		$num1= $num1+ mysqli_num_rows($result1);
        $row1=mysqli_fetch_array($result1);
        $query2="SELECT * FROM assignment WHERE subjectid='$course_id' AND co_code='".$row['co_code']."' ";
        $result2=mysqli_query($connection,$query2);
		$num2=$num2 + mysqli_num_rows($result2);
        $row2=mysqli_fetch_array($result2);
		$query3="SELECT * FROM normalized_internal_attainment WHERE subjectid='$course_id' ";
        $result3=mysqli_query($connection,$query3);
		$num5=$num5+mysqli_num_rows($result3);
        $row3=mysqli_fetch_array($result3);
        $query4="SELECT * FROM internal WHERE subjectid='$course_id' AND co_code='".$row['co_code']."' AND test_no='2' ";
        $result4=mysqli_query($connection,$query4);
		$num3=$num3+mysqli_num_rows($result4);
        $row4=mysqli_fetch_array($result4);
        $query5="SELECT * FROM survey_attainment WHERE subjectid='$course_id' AND co_code='".$row['co_code']."' ";
        $result5=mysqli_query($connection,$query5);
		$num4=$num4 + mysqli_num_rows($result5);
        $row5=mysqli_fetch_array($result5);
      }

echo $num1;
?>
<table>
<tr rowspan="<?php echo $num1; ?> <td >">Data1(Ist Internal)Enter Percentage</td></tr>
<?php
for($i=1;$i<=$num1;$i++)
{
?>
<tr><td><input type="text" name="test1[]" id="test1"  value=""></td></tr>
<?php
}
?>
</table>
<table>
 <tr rowspan="<?php echo $num2;?> <td >">Data2(Assignment)Enter Percentage</td></tr>
<?php
echo $num2;
for($j=1;$j<=$num2;$j++)
{
?>
<tr><td><input type="text" name="asignmnt[]" id="asignmnt"  value=""></td></tr>
<?php
}
?>
</table>
<table>
<tr rowspan="<?php echo $num5; ?>"><td>Data3(Normalized Internal Mark)Enter Percentage</td></tr>
<?php
for($j=1;$j<=$num5;$j++)
{
?>
<tr><td><input type="text" name="nrmlinternal[]" id="nrmlinternal"  value=""></td></tr>
<?php
}
?>
</table>
<table>
<tr rowspan="<?php echo $num3; ?>"><td>Data4(II nd Internal)Enter Percentage</td></tr>
<?php
for($i=1;$i<=$num3;$i++)
{
?>
<tr><td><input type="text" name="test2[]" id="test2"  value=""></td></tr>
<?php
}
?>
</table>
<table>
<tr><td>Data5(Marks in the External Exam)Enter Percentage</td></tr>
<tr><td><input type="text" name="external" id="external"  value=""></td></tr>
</table>
<table>
<tr><td>IAT(Indirect Assessment Tool)Enter Percentage</td></tr>
<tr><td><input type="text" name="surveyper" id="surveyper"  value=""></td></tr>
</table>
<table>
<tr><td>Rubrics,Enter Percentage</td></tr>
<tr><td><input type="text" name="rbcs" id="rbcs"  value=""></td></tr>
</table>
<?php
$query="SELECT * FROM tbl_co WHERE subjectid='".$_POST['id']."' ";
$result=mysqli_query($connection,$query);
?>
<table class="table table-bordered" id="dynamic_field">
	<tr>
	<th rowspan="2">Course<br> Outcome(co)</th>
	<th  colspan="7">
	Attainment level in Percentage</th>
	<th rowspan="2">
	Attainment in <br>Percentage
	</th>
	<th rowspan="2">
	Achievement Goal(70%)
	</th>
	</tr>
	<tr>
	<th>Data1</th>
	<th>Data2</th>
	<th>Data3</th>
	<th>Data4</th>
	<th>Data5</th>
	<th>Rubrics</th>
	<th>IAT</th>
	</tr>
<?php
while($row=mysqli_fetch_array($result))
{
$query1="SELECT * FROM internal WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' AND test_no='1' ";
$result1=mysqli_query($connection,$query1);
$row1=mysqli_fetch_array($result1);
$query2="SELECT * FROM assignment WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' ";
$result2=mysqli_query($connection,$query2);
$row2=mysqli_fetch_array($result2);
$query3="SELECT * FROM normalized_internal_attainment WHERE subjectid='".$_POST['id']."' ";
$result3=mysqli_query($connection,$query3);
$row3=mysqli_fetch_array($result3);
$query4="SELECT * FROM internal WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' AND test_no='2' ";
$result4=mysqli_query($connection,$query4);
$row4=mysqli_fetch_array($result4);
$query5="SELECT * FROM survey_attainment WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' ";
$result5=mysqli_query($connection,$query5);
$row5=mysqli_fetch_array($result5)

	?>

	<tr>
	<td><?php echo $row['co_code'];?></td>	<td><?php echo $row1['attainmnt_percent'];?></td>
  <td><?php echo $row2['attainmnt_percent'];?></td><td><?php echo $row3['attainmnt_percent'];?></td>
  <td><?php echo $row4['attainmnt_percent'];?></td><td>Marks in<br> External<br> Exam</td><td>X</td><td><?php echo $row5['attainmnt_percent'];?></td><td></td><td></td>

	<?php

//	$m= ($row1['attainmnt_percent'] * $_POST['data1per']) /100 + ($row2['attainmnt_percent'] * $_POST['data2per']) /100 + ($row4['attainmnt_percent'] * $_POST['data3per']) /100 +($row3['attainmnt_percent'] * $_POST['data4per']) /100 +($row5['attainmnt_percent'] * $_POST['surveyper']) /100 ;
//array_push($totalattainmnt[],$m);


}
array_push($_SESSION['data1array'],isset($_POST['test1']));
array_push($_SESSION['data2array'],isset($_POST['asignmnt']));
array_push($_SESSION['data3array'],isset($_POST['nrmlinternal']));
array_push($_SESSION['data4array'],isset($_POST['test2']));
array_push($_SESSION['surveyval'],isset($_POST['surveyper']));


}?>
 </tr>
 <tr ><td colspan="10"><center>I=</center></td></tr>
</table>
