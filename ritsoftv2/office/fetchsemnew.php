  <script  src="jquery.js"></script>
<script type="text/javascript">
  function getsemdata(a)  {  
  	$('#loadingmessage2').show();
  	$('#data2').hide();
    console.log(a);
    $.post("fetchsumnew.php",{ key : a},
      function(data)  {
      	$('#data2').show();
        $('#data2').html(data);
        $('#loadingmessage2').hide();
      });
  }
</script>
 <?php
include("includes/connection.php");
if (isset($_POST["key"])) {
	if ($_POST["key"]!="") {
		$branch=$_POST["key"];
		
		$l=mysql_query("select semid,classid from class_details where concat(courseid,'-',branch_or_specialisation)='$branch' and classid in (select curr_sem from semregstatus where current_class=1)") or die(mysql_error());

		?>
		<div class="col-sm-4">
    		<label>Semester</label>
    		<select class="form-control" onchange="getsemdata(this.value)">
    			<option value="--select--">--select--</option>
    			<?php
    			while ($r=mysql_fetch_assoc($l)) {
    				echo '<option value="'.$r["classid"].'">'.$r["semid"].'</option>';
    			}
    			?>
    		</select>
    	</div>
    </div>
<br>
<br>


	<div id='loadingmessage2' style='display:none'>
  <img src='includes/loading.gif'  style="position: fixed;
    top: 60%;
    left: 50%;
 	width: 30%;
    transform: translate(-50%, -50%);" />
</div>

    	
<div id="data2" style="display: none;">

</div>

<?php
	}
}
 ?>
