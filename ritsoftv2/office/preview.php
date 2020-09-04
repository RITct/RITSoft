<?php 
session_start();
error_reporting(0);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Semester Registration</title>
</head>

<body onLoad="javascript :window .print();">
<form id="form2" name="form1" method="post" action="preview.php">
  <?php
include('includes/dboperation.php');

$adm=$_SESSION['adm'];

	
	/*$psemester='Nil';
	$check="select * from stud_sem_registration where adm_no='$adm' ";
	 $check_result=mysql_query($check);
	 $num_check=mysql_num_rows($check_result);

	$squery="select sem_id  from sem_batch where batch_id=(select batch_id from stud_batch_rel where adm_no='$adm')";
	 $sresult=mysql_query($squery);
	 
	 while($db_field=mysql_fetch_assoc($sresult))
	{ 
	$sem_id=$db_field['sem_id'];
	
	$sem="select semester from sem where sem_id=$sem_id";
	$sem_result=mysql_query($sem);
	while($db_field=mysql_fetch_assoc($sem_result))
	{
	$semester=$db_field['semester'];
	}
	$sem_id=$sem_id-1;
	$sem="select semester from sem where sem_id=$sem_id";
	$sem_result=mysql_query($sem);
	while($db_field=mysql_fetch_assoc($sem_result))
	{
	$psemester=$db_field['semester'];
	}
	} 
	$query2="select batch_id from stud_batch_rel where adm_no='$adm' ";
	 $result2=mysql_query($query2);
	 while($db_field=mysql_fetch_assoc($result2))
	{ 
	$batch_id=$db_field['batch_id'];
	}
	$co="select course from courses where id=(select course_id from course_specialization where course_spec_id=(select course_spec_id from batch where batch_id=$batch_id))";
	$resultco=mysql_query($co);
	 while($db_field=mysql_fetch_assoc($resultco))
	{
		$course= $db_field['course'];
	}
	$sp="select specialisation from specialization where spec_id=(select spec_id from course_specialization where course_spec_id=(select course_spec_id from batch where batch_id=$batch_id))";
	$resultsp=mysql_query($sp);
	 while($db_field=mysql_fetch_assoc($resultsp))
	{
		$spec=$db_field['specialisation'];
	}

	
	$query3="insert into stud_sem_registration(reg_id,adm_no,apl_status,apl_date,apv_status,batch_id,previous_sem,new_sem) values(null,'$adm','Applied',NOW(),'Not Approved',$batch_id,'$psemester','$semester')";
	 $result3=mysql_query($query3);
	*/

$query="select * from stud_details where admissionno='$adm'";
 $result=mysql_query($query);
	
	while($db_field=mysql_fetch_assoc($result))
	{ 
	$name=$db_field['name'];
	
	$yr=$db_field['	year_of_admission'];
	$adr=$db_field['address'];
	
	$tel=$db_field['mobile'];
	
	}
	//$sc="select shname from scolarship where shid=(select shid from stud_screlation where adm_no='$adm')";
 //$scresult=mysql_query($sc);
// $num=mysql_num_rows($scresult);
 //if($num>0)
// {
// while($db_field=mysql_fetch_assoc($scresult))
// {
//	 $shname=$db_field['shname'];
 //}
 //}
// else
 //{
//	 $shname='NIL';
 //}
 $yr=$s=date("d-m-Y",strtotime($yr));
		 
		 
?>
  <div align="center">
   <table width="700" border="0" align="center">
  <tbody>
   <tr><td width="500" align="center"><h3>RAJIV GANDHI INSTITUTE OF TECHNOLGY, KOTTAYAM </h3></td></tr>
   <tr><td width="500" align="center"><strong>VELLOOR P.O, KOTTAYAM - 686 501</td></tr>
   <tr><td width="500" align="center"> <strong>APPLICATION FOR PROMOTION</strong></td></tr>
  </tbody>
</table>
    <table width="876" height="1112" border="0">
     <!-- <tr>
        <th height="97" colspan="2" background="resize-img.php.jpg" scope="row"><p><font color="#CCCCCC">RAJIV GANDHI INSTITUTE OF TECHNOLOGY,KOTTAYAM</font></p>
        <p><font color="#CCCCCC">KOTTAYAM-686 501</font></p>
        <p><font color="#CCCCCC"><U>APPLICATION FOR PROMOTION</U></font></p></th>
      </tr> -->
      <tr>
        <th height="23" scope="row"><div align="left">1. Name</div></th>
        <td  ><label> : <?php echo $name;?></label></td>
      </tr>
      <tr>
        <th width="435" height="30" scope="row"><div align="left">2. Admission No</div></th>
        <td width="346"  >: <?php echo $adm;?>&nbsp;</td>
      </tr>
      <tr>
        <th height="24" scope="row"><div align="left">3. Year Of Admission</div></th>
        <td>: <?php echo $yr;?></td>
      </tr>
      <tr>
        <th height="25" scope="row"><div align="left">4.Course and Stream </div></th>
        <td>: <?php echo $course." & ".$spec;?></td>
      </tr>
      <tr>
        <th height="25" scope="row"><div align="left">5. Class to which promotion saught for</div></th>
        <td>: 
        
	    <?php
		
	echo $semester;
	?></td>
      </tr>
      <tr>
        <th height="21" scope="row"><div align="left">6. Class  last studied </div></th>
        <td>: <?php echo$psemester;?></td>
      </tr>
      <tr>
        <th height="24" scope="row"><div align="left">7. Class Number</div></th>
        <td><label>: <?php echo $clsno; ?></label></td>
      </tr>
      <tr>
        <th height="43" scope="row"><div align="left">8. Period During Which the study int he college was discontinued and reason there of.</div></th>
        <td><label>: <?php echo $reason;?></label></td>
      </tr>
      <tr>
        <th height="28" scope="row"><div align="left">9. Whether registered for pre-semester</div></th>
        <td><label>: <?php echo $yn;?></label></td>
      </tr>
      <tr>
        <th height="41" scope="row"><div align="left">10.  The subject in which you have to pass in respect of previous class </div></th>
        <td>: 
          <label><?php echo $subject;?></label></td>
      </tr>
      <tr>
        <th height="59" scope="row"><div align="left">
          <p>11. Whether fees has paid for all instalments of previous semester</p>
          <p align="center">OR</p>
        </div></th>
        <td><label>: <?php echo $payment;?></label></td>
      </tr>
      <tr>
        <th height="40" scope="row"><div align="left"11.> Whether eligible for fee concession if so with nature of concession</div></th>
        <td>:<label>
          <?php  echo $shname; ?>
        </label></td>
      </tr>
      <tr>
        <th height="33" scope="row"><div align="left">
          <label>12.Whether there was any shortage of attendance for any of the previous Semester and whether condonation has been obtained</label>
        </div></th>
        <td><label>
          : <?php  echo $att; ?>
        </label></td>
      </tr>
      <tr>
        <th height="33" scope="row"><div align="left">13.Present Residential Address for correspondence and Phone Number</div></th>
        <td><label>: <?php echo $adr.",<br>:".$tel; ?></label></td>
      </tr>
      
      <tr>
        <th height="72" colspan="2" scope="row"><p>Certified that the particulars furnished above are true and Iam willing to undergo any kind of punishment includingexpulsion from the college if it is found that any of the above statement is false.</p>
        <p align="left">Place:Pampady</p>
        <p align="left">Date:<?php echo date("d/m/Y"); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature of the Candidate.</p>
        <p align="center">(FOR USE OF DEPARTMENT)</p>
        <p align="center">Verified and recommended/not recommended</p>
        <p align="left">FOR OFFICE USE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HEAD OF DEPARTMENT</p>
        <p align="left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Particulars of column 11 &amp; 12 verified and found correct/incorrect.</p>
        <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Promotion granted / not granted.</p>
        <p align="left">FOR LIBRARY USE</p>
        <p align="left">Dues</p>
        <p align="right">PRINCIPAL</p>
        <p align="right">&nbsp;</p>
        <p align="right">&nbsp;</p></th>
      </tr>
    </table>
  </div>
  
</form>

</body>
</html>