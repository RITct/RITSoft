<?php 
include("includes/header.php");
?>
<script src="jquery.js"></script>

<script type="text/javascript">
function getfac(a)
{
  $.post("fetchfac.php",{ key : a},
  function(data){
    $('#data').html(data);
  });
}
</script>

<?php
include("includes/sidenav.php");
include("includes/connection.php");
$stid=$_SESSION['admissionno'];
//........select login student name
$s1=mysql_query("select name from stud_details where admissionno='$stid'",$con);
$y1=mysql_num_rows($s1);
if($y1 == 1 )
{
 $ro=mysql_fetch_array($s1); 
 $sname=$ro['name'];
}
echo $sname;
//.......select login student course and semester
$s2=mysql_query("select courseid,semid,deptname from class_details where classid in(select classid from current_class where studid='$stid')",$con);
$y2=mysql_num_rows($s2);
if($y2 == 1 )
{
 $ro=mysql_fetch_array($s2); 
 $course=$ro['courseid'];
 $sem=$ro['semid'];
 $dept=$ro['deptname'];
}
//select current class
$sql=mysql_query("select classid from current_class where studid='$stid'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$clid=$result['classid'];


$sql=mysql_query("select status from feedback_status where classid='$clid' and deptname='$dept'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$st=$result['status'];
if($st==0)
{
	echo "<script type='text/javascript'>alert('Your Feedback Session is Not Started Yet !Please Wait.')</script>";
	echo "<script>window.location.href='dash_home.php'</script>";
}

if($st==1)
{
	
?>

<!DOCTYPE html>
<html>
<head>
<title>
Feedback
</title>
</head>
<body>
 <div id="wrapper">

    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Give your feedback</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>           
<form method="post" action="">
<?php
?>
<div class="row">
<div class="col-md-6">
<label>Choose Subject :</label>

 <select class="form-control" name="subdrop" onchange="getfac(this.value)" required="required">
                    <option value="">--select--</option>
<?php
//$sql="select subject_title from subject_class where subjectid in(select subjectid from subject_allocation where classid in(select classid from current_class where studid='$stid'))";
$sql="select subject_title,subjectid from subject_class where classid in(select classid from current_class where studid='$stid') and type!='ELECTIVE'";
$r=mysql_query($sql,$con);
while ($result=mysql_fetch_array($r)){
echo '<option value="'.$result['subjectid'].'">'.$result['subject_title'].'</option>' ;
  }
//query to fetch subject titles corresponding to login student
 $sql="select subject_title,subjectid from subject_class sc,elective_student es where sc.subjectid=es.sub_code and es.stud_id='$stid'";
 $r=mysql_query($sql,$con);
while ($result=mysql_fetch_array($r)){
echo '<option value="'.$result['subjectid'].'">'.$result['subject_title'].'</option>' ;
  }

  ?>
						
						
</select>
				</div>
<div class="col-md-6">
  <div id="data"></div>
</div>
</div>
<?php
$subjectid="";
$s4=mysql_query("select classid from current_class where studid='$stid'",$con);	//query to fetch classid of login student
$y4=mysql_num_rows($s4);
if($y4==1)
{
	$ro=mysql_fetch_array($s4);
	$classid=$ro['classid'];
}

if(isset($_POST["submit"]))
{		
	// $c=$_POST['subdrop'];
	// //select subid
	// $s3=mysql_query("select subjectid from subject_class where subject_title='$c' and classid='$classid'",$con);
 //    $y3=mysql_num_rows($s3);
	// if($y3 == 1 )
	// {
	// 	$ro=mysql_fetch_array($s3); 
	// 	$subjectid=$ro['subjectid'];

	// }
  $fac=$_POST["fac"];	
  $subjectid=$_POST['subdrop'];
	$q1=$_POST['knowledge'];  //variables storing values of radio button
	$q2=$_POST['clarity'];
	$q3=$_POST['willingness'];
	$q4=$_POST['engage'];
	$q5=$_POST['dictate'];
	$q6=$_POST['ability'];
	$q7=$_POST['speed'];
	$q8=$_POST['encourage'];
	$q9=$_POST['behaviour'];
	$q10=$_POST['Sincerity'];
	$q11=$_POST['effectiveness'];
	$q12=$_POST['comment'];
	$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
			$r=mysql_fetch_assoc($l);
			$prev=$r["acd_year"];

	//checking whether exists
$ch=mysql_query("select * from feedback_stud where studid='$stid' and subjectid='$subjectid' and fid='$fac'",$con);
$chr=mysql_num_rows($ch);
if($chr>=1)
{
	    echo "<script type='text/javascript'>alert('You are already given feedback')</script>";

}
else
{

	$squ=mysql_query("insert into feedback_stud values('','$stid','$prev','$subjectid','$fac')",$con) or die(mysql_error());
	$s=mysql_query("insert into mainfeedback values('$dept','$sem','$subjectid','$prev','','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$q11','$q12','$fac')",$con) or die(mysql_error());
	if ($s and $squ) 
	{
    echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
	}
}//close else
}//close button submit

?>

<br>
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             select your response
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

    <thead>
  <tr>
  
    <th>Question</th>

    <th>Response</th> 
    

  </tr>
    </thead>

   <tbody>
   <tr>
 <td>1. Knowledge of the teacher in the subject 
</td>
  
  <td> <div class="radio"><label> <input type="radio" name="knowledge"  value="17.75" required="required"> Excellent</input></label></div>
 
<div class="radio"><label> <input type="radio"  name="knowledge" value="14.125" required="required"> Good</label></div>

<div class="radio"><label> <input type="radio"  name="knowledge" value="10.28125" required="required"> Fair</label></div>

 <div class="radio"><label> <input type="radio"  name="knowledge" value="3.53125" required="required"> Poor </label></div>

 <div class="radio"><label><input type="radio"  name="knowledge" value="8" required="required"> None </label> </div>
 
</td>
   

  </tr>





<tr>
<td>2. Clarity and understandability of teachers explanations
</td>

  <td> <div class="radio"><label> <input type="radio" name="clarity" value="14.5" required="required"> Excellent </label> </div>
  
<div class="radio"> <label><input type="radio" name="clarity" value="11.8125" required="required"> Good </label> </div>
  
<div class="radio"><label><input type="radio" name="clarity" value="8.1125" required="required"> Fair </label> </div>
 
 <div class="radio"><label><input type="radio" name="clarity" value="2.0125" required="required"> Poor </label> </div>
 
<div class="radio"><label><input type="radio" name="clarity" value="4.0875" required="required"> None</td> </label> </div>
</tr>

<tr>
<td>3. Teachers willingness to help</td>

<td>
  <div class="radio"><label><input type="radio" name="willingness" value="7.5" required="required"> Excellent</label> </div>
  
<div class="radio"><label><input type="radio" name="willingness" value="5.7125" required="required"> Good</label> </div>
  
<div class="radio"><label><input type="radio" name="willingness" value="4.0375" required="required"> Fair</label> </div>
  
<div class="radio"><label><input type="radio" name="willingness" value="1.125" required="required"> Poor</label> </div>
 
<div class="radio"><label><input type="radio" name="willingness" value="2.2125" required="required"> None</label> </div> </td>
</tr>

<tr>
<td>4. Approximate % of classes not engaged by the teacher</td>

<td> 
 <div class="radio"><label><input type="radio" name="engage" value="5.85" required="required"> <10% </label> </div>
  
<div class="radio"><label><input type="radio" name="engage" value="3.6625" required="required"> 10-25% </label> </div>
  
<div class="radio"><label><input type="radio" name="engage" value="1.9125" required="required"> >25% </label> </div>
 
 <div class="radio"><label><input type="radio" name="engage" value="1.6375" required="required"> None </label> </div>
</td> 
</tr>

<tr><td>5.Whether the teacher dictates notes only without explanations</td>

<td><div class="radio"><label><input type="radio" name="dictate" value="4" required="required"> No </label> </div>
 

 <div class="radio"><label><input type="radio" name="dictate" value="0.67375" required="required"> Yes </label> </div>
 
<div class="radio"><label><input type="radio" name="dictate" value="1.65" required="required"> None </label> </div></td></tr>

<tr>
<td>6.Teachers ability to organize lectures</td>

<td>
 <div class="radio"><label><input type="radio" name="ability" value="9.25" required="required"> Excellent </label> </div>
  
<div class="radio"><label><input type="radio" name="ability" value="6.34125" required="required">Satisfactory </label> </div>
 
 <div class="radio"><label><input type="radio" name="ability" value="2.5" required="required"> inadequate </label> </div>

 <div class="radio"><label><input type="radio" name="ability" value="3.1625" required="required"> None </label> </div> </td></tr>

<tr>
<td>7.Speed of presentation </td>

<td><div class="radio"><label><input type="radio" name="speed" value="4.75" required="required"> Just Right </label> </div> 

  <div class="radio"><label><input type="radio" name="speed" value="1.34125" required="required"> Too Fast </label> </div>
 
 <div class="radio"><label><input type="radio" name="speed" value="1.19125" required="required"> Too Slow </label> </div>
 
<div class="radio"><label><input type="radio" name="speed" value="1.4" required="required"> None </label> </div>
</td>
</tr>

<tr>
<td>8.Does the teacher encourage questioning?</td>

<td><div class="radio"><label><input type="radio" name="encourage" value="6.875" required="required"> Yes </label> </div>

 <div class="radio"><label> <input type="radio" name="encourage" value="3.89375" required="required"> Sometimes </label> </div> 
 
 <div class="radio"><label><input type="radio" name="encourage" value="0.7375" required="required"> No </label> </div>

 <div class="radio"><label><input type="radio" name="encourage" value="1.775" required="required"> None </label> </div>
</td>
</tr>


<tr>
<td>9.Behavior of the teacher</td>
<td>
<div class="radio"><label><input type="radio" name="behaviour" value="6.75" required="required"> Pleasant </label> </div>
 
 <div class="radio"><label><input type="radio" name="behaviour" value="2.7825" required="required">indifferent </label> </div>
 
 <div class="radio"><label><input type="radio" name="behaviour" value="1.27875" required="required"> UnPleasant </label> </div>

<div class="radio"><label><input type="radio" name="behaviour" value="1.9375" required="required"> None </label> </div>
</td>
</tr>

<tr>
<td>10.Sincerity of the teacher</td>

<td><div class="radio"><label><input type="radio" name="Sincerity" value="11.5" required="required"> Sincere </label> </div>

  <div class="radio"><label><input type="radio" name="Sincerity" value="1.325" required="required"> Not Sincere </label> </div>
 
 <div class="radio"><label><input type="radio" name="Sincerity" value="5.06375" required="required"> Unable to judge </label> </div>

 <div class="radio"><label><input type="radio" name="Sincerity" value="4.025" required="required"> None </label> </div>
</td>
</tr>

<tr>
<td>11.Overall teaching effectiveness of the teacher</td>

<td><div class="radio"><label><input type="radio" name="effectiveness" value="11.25" required="required"> Excellent </label> </div>
  
<div class="radio"><label><input type="radio" name="effectiveness" value="9.025"required="required">Good </label> </div>

  <div class="radio"><label><input type="radio" name="effectiveness" value="6.45625" required="required"> Fair </label> </div>
  
<div class="radio"><label><input type="radio" name="effectiveness" value="1.5625" required="required"> Poor </label> </div>
 
<div class="radio"><label><input type="radio" name="effectiveness" value="2.025" required="required"> None </label> </div> </td>
</tr>

<tr>
<td>12.Strength,weakness and any other relevant information about the teacher</td>

<td><textarea class="form-control" name="comment" rows="3" cols="100"></textarea>
</td>
</tr>
 </tbody>
                              </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    
       
     
<div class="row">
<div class="col-md-6">
<input type="submit" class="btn btn-primary btn-lg btn-block"  name="submit" value="Submit" align="middle"/>
</div>

<div class="col-md-6">
<input type="reset" class="btn btn-danger btn-lg btn-block" name="reset" value="Reset"/>
</div>
</div>
<br>
<br>
</div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
     </div>
            <!-- /.row -->
   </div>
        <!-- /#page-wrapper -->
</form>

			
      
    </div>
    <!-- /#wrapper -->

</html>

<?php
}
include("includes/footer.php");
?>

