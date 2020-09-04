<?php
$sql=mysqli_connect("localhost","root","","ritsoft");
session_start();

include('header.php');
include('sidenav.php');
$co="";
?>



<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FEEDBACK</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  	<div class="row 1">
  		<div class="col-md-2">

  		</div>
  		<div class="col-md-9">

<br>
<br>
<br>
<center>
<h1>Feedback View</h1>

<form name="qes" method="post" enctype="multipart/formdata" action="#">

	<fieldset class="form-group">
<table>
<tr>
<td><label for="course">COURSE</label></td>
<td><input type="text" name="course_code"/></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="View"/></td>

<td>
<a href="http://localhost/amsa/fpdf/pdfdemo.php";>print</a></td>
</tr>
</table>
<?php


if(isset($_POST["submit"]))
{
	$course_code=$_POST['course_code'];
	$_SESSION['course_code']=$course_code;
$result=mysqli_query($sql,"SELECT * FROM survey_question_table WHERE subjectid='$course_code'");
$_SESSION['ex']=array();
$_SESSION['vgd']=array();
$_SESSION['gd']=array();
$_SESSION['ntbd']=array();
$_SESSION['unsure']=array();
while($r=mysqli_fetch_array($result))
{
echo"<table>";
	echo "<tr>";
	echo "<td>" . $r['question_no'] . "</td>";
	echo "<td>" . $r['question'] . "</td>";


	echo "</tr>";
echo"<tr>";

$count5= mysqli_query($sql,"SELECT count(*) FROM survey_rating_table WHERE subjectid='$course_code' AND question_no='".$r['question_no']."' AND rating='5' ");
$c5=mysqli_fetch_array($count5);
$ce5=$c5['count(*)'];

array_push($_SESSION['ex'],$ce5);

echo '<td>  <label for="Exc">Highly Confident</label></td>';
echo"<td><input type='text' name='Excellent' value='$ce5'/></td>";

$count4 = mysqli_query($sql,"SELECT count(*) FROM survey_rating_table WHERE subjectid='$course_code' AND  question_no='".$r['question_no']."' AND rating='4' ");
$c4=mysqli_fetch_array($count4);
$ce4=$c4['count(*)'];

array_push($_SESSION['vgd'],$ce4);
echo '<td>  <label for="vgd">Confident</label>';
echo"<td><input type='text' name='vgd' value='$ce4'/></td>";
$count3 = mysqli_query($sql,"SELECT count(*) FROM survey_rating_table WHERE subjectid='$course_code' AND  question_no='".$r['question_no']."' AND rating='3' ");
$c3=mysqli_fetch_array($count3);
$ce3=$c3['count(*)'];
echo '<td>  <label for="gd">Average</label>';
echo"<td><input type='text' name='gd' value='$ce3' /></td>";

array_push($_SESSION['gd'],$ce3);


$count2 = mysqli_query($sql,"SELECT count(*) FROM survey_rating_table WHERE subjectid='$course_code' AND  question_no= '".$r['question_no']."' AND rating='2' ");
$c2=mysqli_fetch_array($count2);
$ce2=$c2['count(*)'];
echo '<td>  <label for="bd">Not Confident</label>';
echo"<td><input type='text' name='bd' value='$ce2' /></td>";

array_push($_SESSION['ntbd'],$ce2);

$count1 = mysqli_query($sql,"SELECT count(*) FROM survey_rating_table WHERE subjectid='$course_code' AND  question_no='".$r['question_no']."' AND rating='1'");
$c1=mysqli_fetch_array($count1);
$ce1=$c1['count(*)'];
echo '<td>  <label for="wrse">Unsure</label>';
echo"<td><input type='text' name='wrse' value='$ce1' /></td>";

array_push($_SESSION['unsure'],$ce1);

$co=$r['co_code'];
 echo "</tr>";

}
$result=mysqli_query($sql,"SELECT * FROM survey_attainment WHERE subjectid='$course_code' and co_code='$co'");
$countsur=mysqli_num_rows($result);
if($countsur>0)
{
  
}
else{
$query1="INSERT INTO survey_attainment(`subjectid`,`co_code`,`highconfident`,`confident`,`average`,`notconfident`,`unsure`)VALUES('$course_code','$co','$ce5','$ce4','$ce3','$ce2','$ce1')";
$insert=mysqli_query($sql,$query1);
if(!$insert)
{
echo mysqli_errno($sql);
}
else
{
echo "inserted";
}
}

}
echo"</table>";
 ?>

<!--<div class="button-panel">
<input type="submit" class="btn btn-primary" title="print" name="print" value="print"></input>
</div>
</td>
</tr>

</fieldset></div>-->
<div class="col-md-1">

</div>
</div>



<?php

//if(isset($_POST["print"]))
//{
//	header("location:http://localhost/amsa/fpdf/pdfdemo.php");
//}

?>

</form>
</center>
</body>
</html>
<?php

include("footer.php");
?>
