<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");

?>

<script  src="jquery.js"></script>
<script type="text/javascript">
  function getbranch(a)  {  
  	$('#loadingmessage').show();
  	$('#data').hide();
    console.log(a);
    $.post("fetchbranchnew.php",{ key : a},
      function(data)  {
      	$('#data').show();
        $('#data').html(data);
        $('#loadingmessage').hide();
      });
  }
  
</script>
 <div id="page-wrapper" style="height: auto;" >
 	
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">SEMESTER VERIFICATION SUMMARY
			</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
         
   <div class="row">
    	<div class="col-sm-4">
    		<label>Course</label>
    		<select class="form-control" onchange="getbranch(this.value)">
    			<option value="--select--">--select--</option>
    			<?php 
    				$l=mysql_query("select distinct courseid from class_details") or die(mysql_error());
    				while ($r=mysql_fetch_assoc($l)) {
    					echo '<option value="'.$r["courseid"].'">'.$r["courseid"].'</option>';
    				}

    			 ?>
    		</select>
    	</div>

    	<div id='loadingmessage' style='display:none'>
  <img src='includes/loading.gif'  style="position: fixed;
    top: 60%;
    left: 50%;
 	width: 30%;
    transform: translate(-50%, -50%);" />
</div>

    	
<div id="data" style="display: none;">
</div>




</div> 






















	<?php

include("includes/footer.php");
?>
