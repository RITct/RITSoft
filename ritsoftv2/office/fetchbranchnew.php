 <script  src="jquery.js"></script>
<script type="text/javascript">
  function getsem(a)  {  
  	$('#loadingmessage1').show();
  	$('#data1').hide();
    console.log(a);
    $.post("fetchsemnew.php",{ key : a},
      function(data)  {
      	$('#data1').show();
        $('#data1').html(data);
        $('#loadingmessage1').hide();
      });
  }
</script>
 <?php
include("../connection.php");
if (isset($_POST["key"])) {
	if ($_POST["key"]!="") {
		$courseid=$_POST["key"];
		$l=mysql_query("select distinct branch_or_specialisation from class_details where courseid='$courseid'") or die(mysql_error());

		?>
		<div class="col-sm-4">
    		<label>Branch</label>
    		<select class="form-control" onchange="getsem(this.value)">
    			<option value="--select--">--select--</option>
    			<?php
    			while ($r=mysql_fetch_assoc($l)) {
    				echo '<option value="'.$courseid.'-'.$r["branch_or_specialisation"].'">'.$r["branch_or_specialisation"].'</option>';
    			}
    			?>
    		</select>
    	</div>
	<div id='loadingmessage1' style='display:none'>
  <img src='includes/loading.gif'  style="position: fixed;
    top: 60%;
    left: 50%;
 	width: 30%;
    transform: translate(-50%, -50%);" />
</div>

    	
<div id="data1" style="display: none;">

</div>

<?php
	}
}
 ?>