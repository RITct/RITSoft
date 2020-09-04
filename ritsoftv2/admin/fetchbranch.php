 <?php
include("includes/connection.php");
 ?>
 <script src="jquery.js"></script>

<script type="text/javascript">
function getclass(a)
{
	console.log(a);
  $.post("fetchclass.php",{ key : a},
  function(data){
    $('#data1').html(data);
  });
}
</script>
 <?php
if (isset($_POST["key"])) {
	if ($_POST["key"]!="") {
		$course=$_POST["key"];
		$l=mysql_query("select distinct branch_or_specialisation as branch from class_details where courseid='$course'") or die(mysql_error());
		if(mysql_num_rows($l))
		{
?>



<div class="col-md-6">
						<label>Branch</label>
						<select class="form-control" onchange="getclass(this.value)">
							<option value="">--select--</option>
							<?php
							
							while ($r=mysql_fetch_assoc($l)) {
								echo '<option value="'.$course.'-'.$r["branch"].'">'.$r["branch"].'</option>';
							}

							?>
						</select>
					</div>
				</div> 
			</div>
				<div id="data1"></div>
<?php
		}
	}
}

 ?>