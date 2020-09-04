<?php 
include("includes/connection.php");

?> 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="col-md-6">
<div class="form-group">
<label>Faculty:</label>
<select class="form-control" name="facid" required> 
<option value="" selected disabled hidden>Select</option>
  <?php 
  $key=$_POST["key"];
  //echo $key;
	$result=mysql_query("SELECT name,fid FROM faculty_details where deptname='$key'");

		
     while ($row = mysql_fetch_array($result, MYSQL_BOTH)) 
	 {
  ?>     
	<option value="<?php echo $row[1]; ?>"><?php echo $row[0]; ?> </option>
  <?php
		  
	 }
  
  ?>
  

</select> 

<?php 
  
  //$fid=facid;
  //$res=mysql_query("select designation from faculty_designation where fid='$fid'");

?>  
</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;"><div class="form-check">
    <input type="checkbox" name="check_list[]"  id="checkbox101"  value="principal">
    <label for="checkbox101"  >PRINCIPAL</label>
</div></div>
    <div class="col-sm-4" style="background-color:lavenderblush;"><div class="form-check">
    <input type="checkbox" name="check_list[]"  id="checkbox102" value="pgdean">
    <label  for="checkbox102">PG DEAN</label>
</div></div>
    <div class="col-sm-4" style="background-color:lavender;"><div class="form-check">
    <input type="checkbox" name="check_list[]"  id="checkbox103" value="ugdean">
    <label  for="checkbox103">UG DEAN</label>
</div></div>
  </div>
  </div>
 <div class="container">  
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;">
	

<div class="form-check">
    <input type="checkbox" name="check_list[]"  id="checkbox104" value="hod" >
    <label  for="checkbox104">HOD</label>
</div>
       
	
	
	
	
	</div>
    <div class="col-sm-4" style="background-color:lavenderblush;"><div class="form-check">
    <input type="checkbox" name="check_list[]"  id="checkbox106" value="faculty">
    <label  for="checkbox106">FACULITY</label>
    
</div></div>
    </div>
  </div>
  </div>
 
  </div>
</div>
<div class="col-md-6" >
<div class="form-group" align="right"> 
<input type="submit" class="btn btn-primary  " name="submit" value= "Submit"/>
</div>
<div> 

 