<?php
session_start();
include("../connection.php");
 if(isset($_POST['key']))
 {
	 
	 $admissionno=$_SESSION["admissionno"];
	 $key=$_POST['key'];
	  //.........query for select subjectid,subject_title,external_mark,external_pass_mark from subject_class..........
	$l=mysql_query("SELECT distinct subject_class.subject_title,university_mark.mark,external_pass_mark as pass from university_mark,subject_class where subject_class.classid=university_mark.semester and university_mark.subject_code=subject_class.subjectid and university_mark.semester='$key' and university_mark.studid='$admissionno'") or die(mysql_error());
 ?>



<div class="form-row">
			<table   class="table table-hover table-bordered" >
			<tr>
					<th style="text-align: center;" > SUBJECT </th>
					<th style="text-align: center;">MARK/GRADE</th>
					<th style="text-align: center;">STATUS</th>
			 </tr>
			
	<?php 
		while($r=mysql_fetch_assoc($l))
		{?>
	<tr>
	<td style="text-align: center;" > <?php echo $r["subject_title"]; ?> </td>
	<td style="text-align: center;" > <?php echo $r["mark"]; ?> </td>
	<?php if($r["mark"] >=$r["pass"]) 
	{
	?>
		<td style="text-align: center; color:green" > P </td>	
	<?php
	}
		else
		{	
?>
		<td style="text-align: center; color:red" > F </td>	
	
			
		<?php }
	}
	?>
	</tr>
		
			
			
			 
			 </table>
			

<?php

 }
?> 
			 </div>