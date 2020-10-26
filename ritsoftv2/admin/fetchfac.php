<?php 
include("../connection.php");

?> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function getdesig(a)
{
	console.log(a);
 $.post( 
                  "fetchdesig.php",
                  { key: a },
                  function(data) {
                     $('#data1').html(data);
                  }
               );
}
			   </script>
<div class="col-md-6">
<div class="form-group">
<label>Faculty:</label>
<select class="form-control" name="facid" onchange="getdesig(this.value)" required> 
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
<div id="data1">

</div>



 