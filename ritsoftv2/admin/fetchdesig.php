
<?php

include("includes/connection.php");
if(isset($_POST["key"]))
{

$student_affairsdean=$faculty=$hod=$pgdean=$ugdean=$faculty=$principal="";
$key=$_POST["key"];
$l=mysql_query("select * from faculty_designation where fid='$key'") or die(mysql_error());

while($r=mysql_fetch_assoc($l))
{
if($r["designation"]=="faculty") 
$faculty='checked="checked"';
else if($r["designation"]=="hod") 
$hod='checked="checked"';
else if($r["designation"]=="ugdean")
$ugdean='checked="checked"';	
else if($r["designation"]=="pgdean")
$pgdean='checked="checked"';
else if($r["designation"]=="principal")
$principal='checked="checked"';	
else if($r["designation"]=="student_affairsdean")
$student_affairsdean='checked="checked"'; 	
}
?>	
 
<br>
<br>
<br>
<br>
 
  <div class="row">
    <div class="col-sm-4" >
      <div class="form-check">
    <input type="checkbox" name="principal" <?php echo $principal; ?>  id="checkbox101"  value="principal">
    <label for="checkbox101"  >PRINCIPAL</label>
</div>
</div>
    
	<div class="col-sm-4" ><div class="form-check">
    <input type="checkbox" name="pgdean" <?php echo $pgdean; ?>  id="checkbox102" value="pgdean">
    <label  for="checkbox102">PG DEAN</label>
</div>
</div>
    <div class="col-sm-4" ><div class="form-check">
    <input type="checkbox" name="ugdean" <?php echo $ugdean; ?>  id="checkbox103" value="ugdean">
    <label  for="checkbox103">UG DEAN</label>
</div>
</div>
  </div>
  
  
 
  <div class="row">
    <div class="col-sm-4" >
<div class="form-check">
    <input type="checkbox" name="hod" <?php echo $hod; ?>  id="checkbox104" value="hod" >
    <label  for="checkbox104">HOD</label>
</div>
 
	</div>
    <div class="col-sm-4" ><div class="form-check">
    <input type="checkbox" name="faculty"  <?php echo $faculty; ?> id="checkbox106" value="faculty">
    <label  for="checkbox106">FACULITY</label>
    
</div>
</div>

<div class="col-sm-4" ><div class="form-check">
    <input type="checkbox" name="student_affairsdean"  <?php echo $student_affairsdean; ?> id="checkbox107" value="student_affairsdean">
    <label  for="checkbox107">Student Affairs Dean</label>
    
</div>
</div>
    </div>
 


<br>
<br>
  <div class="row"> 
   <div class="col-sm-4">
   </div>
 <div class="col-sm-4">
<input type="submit" class="btn btn-primary btn-block" name="submit" value= "Submit"/>
</div>
<div>
<?php

}

?>