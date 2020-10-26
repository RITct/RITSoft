<?php
session_start();
include("../connection.php");
 if(isset($_POST['key']))
 {
	 $studid=$_SESSION["admissionno"];
	 $key=$_POST['key'];
	$key1=$_POST['key1'];

	$l=mysql_query("SELECT  subject_class.subjectid,subject_class.subject_title,external_pass_mark as pass,external_mark FROM subject_class WHERE subject_class.classid = '$key'") or die(mysql_error());
	
 
  
 
 
 ?>
 <div class="form-row">
			<table   class="table table-hover table-bordered" >
			<tr>
					<th style="text-align: center;" > SUBJECT </th>
					<th style="text-align: center;"> 
					<?php 
					if($key1=="mark")
						echo "MARK";
					else
						echo "GRADE";
					?>
			
					
						</th>
			 </tr>
 				 <tr>
		<?php  while($r=mysql_fetch_assoc($l))
	 { 
		$title=$r["subject_title"];
		$subcode=trim($r["subjectid"]);
		$pmark=$r["pass"];
		$tmark=$r["external_mark"];
		$z=mysql_query("select mark,registerno from university_mark where semester='$key' and studid='$studid' and subject_code='$subcode'") or die(mysql_error());
		if($x=mysql_fetch_assoc($z))
		{
			$_SESSION["edit"]=1;
			$_SESSION["regno"]=$x["registerno"];
			$mark=$x["mark"];
			
			if($x["mark"] >= $pmark)
			{
				if($x["mark"]=="O")
					$os="selected";
				else if($x["mark"]=="A+")
					$os1="selected";
				else if($x["mark"]=="A")
					$os2="selected";
				else if($x["mark"]=="B+")
					$os3="selected";
				else if($x["mark"]=="B")
					$os4="selected";
				else if($x["mark"]=="C")
					$os5="selected";
				else if($x["mark"]=="P")
					$os6="selected";
				else if($x["mark"]=="F")
					$os7="selected";
				else if($x["mark"]=="FE")
					$os8="selected";
				else if($x["mark"]=="I")
					$os8="selected";
				else
					$os9="";
			
					
 ?>

	<td><input type="text" class="form-control" disabled="disabled"  id="subject"  value="<?php echo $title;  ?>" placeholder="" required=""></td>
	 <td>
	 
	 
	<select class="form-control" name="<?php echo $subcode; ?>" >
	<option <?php echo $os; ?> value="">--select--</option>
	<option  value="O">O</option>
	<option value="A+">A+</option>
	<option value="A">A</option>
	<option value="B+">B+</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="P">P</option>
	<option value="F">F</option>
 	<option value="FE">FE</option>
	<option value="I">I</option>
	</select>
	 </td>
	 </tr>
	
			<?php }else
			{	
			?>
			<td><input type="text" class="form-control" disabled="disabled" id="subject"  value="<?php echo $title;  ?>" placeholder="" required=""></td>
	 
	 <td><input type="number" class="form-control" id="mark" value="<?php echo $mark; ?>" name="<?php echo $subcode; ?>" placeholder="" pattern="^[0-9]{1,3}"  min=0  max="<?php echo $tmark; ?>" required name="mark[<?php echo $mark; ?>]"></td>
	 </tr>
	 <?php }}
else
{
	$_SESSION["edit"]=0;
?>
<td><input type="text" class="form-control" disabled="disabled"  id="subject"  value="<?php echo $title;  ?>" placeholder="" required=""></td>
	 <td>
	 <?php if($key1=="mark")
	 {		 ?>
	 <input type="number" class="form-control"  id="mark" name="<?php echo $subcode; ?>" placeholder="" pattern="^[0-9]{1,3}"  min=0  max="<?php echo $tmark; ?>" required=""></td>
	 <?php
	 }	 
	 else
	 {
	?>
	<select class="form-control" name="<?php echo $subcode; ?>" >
	<option value="">--select--</option>
	<option value="O">O</option>
	<option value="A+">A+</option>
	<option value="A">A</option>
	<option value="B+">B+</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="P">P</option>
	<option value="F">F</option>
 	<option value="FE">FE</option>
	<option value="I">I</option>
	</select>
	<?php 
	 }
	 ?>
	 </tr>

<?php }	}?>
	</table>
	
	</div>

	<div class="form-row">
   <div class="form-group col-md-6">
 
  <button type="submit" value="" name="markpost" id="markpost_btn" class="btn btn-primary">Submit</button>
 </div>
     </div>
 <?php 
 }
 
 ?>