<?php 
session_start();
?>
<script src="jquery.js"></script>

<script type="text/javascript">
function gettype(a,b)
{
	$.post("fetchmark.php",{ key : a,key1 : b},
	function(data){
		$('#data3').html(data);
	});
}
</script>

 <?php
 session_start();
include("includes/connection.php");
 if(isset($_POST['key']))
 {
	 $studid=$_SESSION["admissionno"];
	 $key=$_POST['key'];
	 //.........query for select subjectid,subject_title,external_mark,external_pass_mark from subject_class..........
	$l=mysql_query("SELECT  subject_class.subjectid,subject_class.subject_title,external_pass_mark as pass,external_mark FROM subject_class WHERE subject_class.classid = '$key'") or die(mysql_error());
	
 
  
 
 
 ?>
 
 <?php
 //.........query for select registerno and mark from university_mark..........
 $q=mysql_query("select registerno,mark from university_mark where semester='$key' and studid='$studid'") or die(mysql_error());//$key is a session variable 
 if($w=mysql_fetch_assoc($q))
 {
	 $reg=$w["registerno"];
	
	 ?>
 <div class="form-group col-md-6">
      <label for="registerno">REGISTER NUMBER</label>
	  
 <input type="text" disabled="disabled" value="<?php echo $reg ?>"  class="form-control" id="registerno" name="registerno"  value="" >
    </div>
	 <div class="form-group col-md-6">
      <label for="registerno">MARK OR GRADE</label>
<?php
	if(is_numeric($w["mark"]))//evaluate whether mark is a number 
		
	{
		echo "<script>gettype('".$key."','mark')</script>"
?>	
	<select class="form-control" disabled="disabled" name="mg">
	   <option value="">--select--</option>
	  <option selected="selected" value="mark">Mark</option>
	   <option value="grade">Grade</option>
	  </select>
	<?php
	}
	else 
	{
		echo "<script>gettype('".$key."','grade')</script>"
		?>
	<select class="form-control" disabled="disabled" name="mg">
	   <option value="">--select--</option>
	  <option  value="mark">Mark</option>
	   <option selected="selected" value="grade">Grade</option>
	  </select>
	<?php 
	}
	?>
	   </div>
 <?php 
 }
 else
 {
?>
 <div class="form-group col-md-6">
      <label for="registerno">REGISTER NUMBER</label>
	  
      <input type="text"  class="form-control" id="registerno" name="registerno"  value="" pattern="^[A-Z0-9]+$">
    </div>
	 <div class="form-group col-md-6">
      <label for="registerno">MARK OR GRADE</label>
	  
	<select class="form-control" onchange="gettype('<?php echo $key ?>',this.value)" name="mg">
	   <option value="">--select--</option>
	  <option value="mark">Mark</option>
	   <option value="grade">Grade</option>
	  </select>
	   </div>
 <?php 
 }
 }
 ?>
<div id="data3"></div>