<?php
include("../connection.php");
if (isset($_POST['key'])) {
	
$classid=$_POST["key"];

	 		    $sql="select subject_title,subjectid from subject_class where classid='$classid'";
		
		?>	    
		
   <select name="subjectid" class="form-control">
   		<option value="--select--">--select--</option>
   		
   		
<?php
			     $r=mysql_query($sql) or die(mysql_error());
	 		    while($result=mysql_fetch_array($r))    {
	   		      echo '<option value="'.$result['subjectid'].'">'.$result['subject_title'].'</option>';
	 		    }?>

 </select>

	 <?php		}
		  ?>	
		 