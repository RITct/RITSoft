<?php
$connection=mysqli_connect("localhost","root","","ritsoft");
$count=0;
$c=[];
$m=0.0;
$totalattainmnt=array();
if(isset($_POST['id']))
{
$query="SELECT * FROM tbl_co WHERE subjectid='".$_POST['id']."' ";
$result=mysqli_query($connection,$query);
$c=array($result);
$count=count($c);
?>
<table class="table table-bordered" id="dynamic">
	<tr>
	<th rowspan="2">Course<br> Outcome(co)</th>
	<th  colspan="7">
	Attainment level in Percentage</th>
	<th rowspan="2">
	Attainment in <br>Percentage
	</th>
	<th rowspan="2">
	Final
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
		echo $row['co_code'];
$query1="SELECT * FROM internal WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' AND test_no='1' ";
$result1=mysqli_query($connection,$query1);
$row1=mysqli_fetch_array($result1);
$query2="SELECT * FROM assignment WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' ";
$result2=mysqli_query($connection,$query2);
$row2=mysqli_fetch_array($result2);
$query3="SELECT * FROM internal WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' AND test_no='2' ";
$result3=mysqli_query($connection,$query3);
$row3=mysqli_fetch_array($result3);
$query4="SELECT * FROM normalized_internal_attainment WHERE subjectid='".$_POST['id']."' ";
$result4=mysqli_query($connection,$query4);
$row4=mysqli_fetch_array($result4);
$query5="SELECT * FROM survey_attainment WHERE subjectid='".$_POST['id']."' AND co_code='".$row['co_code']."' ";
$result5=mysqli_query($connection,$query5);
while($row5=mysqli_fetch_array($result5))
{
	?>

	<tr>
	<td><?php echo $row['co_code'];?></td>	<td><?php echo $row1['attainmnt_percent'];?><br><input type="text" name="data1per[]" size="3"></td><td><?php echo $row2['attainmnt_percent'];?><br><input type="text" name="data2per[]" size="3"></td><td><?php echo $row4['attainmnt_percent'];?><br><input type="text" name="data3per[]" size="3"></td><td><?php echo $row3['attainmnt_percent'];?><br><input type="text" name="data4per[]" size="3"></td><td>Marks in<br> External<br> Exam</td><td>X</td><td><?php echo $row5['attainmnt_percent'];?><br><input type="text" name="syrveyper[]" size="3"></td>

	<?php

//	$m= ($row1['attainmnt_percent'] * $_POST['data1per']) /100 + ($row2['attainmnt_percent'] * $_POST['data2per']) /100 + ($row4['attainmnt_percent'] * $_POST['data3per']) /100 +($row3['attainmnt_percent'] * $_POST['data4per']) /100 +($row5['attainmnt_percent'] * $_POST['surveyper']) /100 ;
//array_push($totalattainmnt[],$m);
}

}
if(isset($_POST['calculate']))
{
	for($i=1;$i<=$count;$i++)
	{
		?>
	<td><?php echo $totalattainmnt;?></td><td></td>
	<?php
	}
}
}

 ?>
 </tr>
 <tr ><td colspan="10"><center>I=</center></td></tr>
</table>
