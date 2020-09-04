<?php
include("includes/header.php");
include("includes/sidenav.php");

?>


<div id="page-wrapper">
	<div class="row">

		<br><br>
		<?php
		$s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
		$r = mysql_fetch_assoc($s);
		$deptname=$r["deptname"];

		$sql ="select * from class_details  where deptname='$deptname' and active like '%YES'";
		$result = mysql_query($sql);
		?>

		<form class="form-horizontal" id="now-select-data" >
			<div class="form-group"> 
				<div class="col-sm-12">

					<select name='clsid' id="clsid" class="form-control"  required>


						<option value =''>Select</option>
						<?php
						while ($row = mysql_fetch_array($result)) {
         // if($row["classid"]==$clsid)
              //echo '<option value="' . $row["classid"] .'" selected="selected">' . $row["classid"] .'</option>';
         // else
            //  echo '<option value="' . $row["classid"] .'">' . $row["classid"] .'</option>';
							echo "<option value='" . $row["classid"] ."'>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";   

						} 
						?>        

					</select>

				</div>
			</div>


			<div class="form-group"> 
				<div class="col-sm-12 text-center">					
					<button type="submit" id="generate" class=" btn btn-info btn-lg ">generate</button>
				</div>

			</div>


		</form>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div id="result">
				
			</div>
		</div>
	</div>
</div>


<script src="jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

 //......................................................................   

 $(document).on("submit", "#now-select-data", function(e){
 	e.preventDefault();


 	var classid = $('#clsid').val();

 	var resultDropdown = $("#result");

 	$loadingTag= '<div class="text-center"><img src="../vendor/images/loading.gif"></div>';
 	resultDropdown.html($loadingTag);
 	$(this).find('button[type=submit]').prop('disabled', true);
 	$.post("stud_backend3.php", {classid:classid}).done(function(data){  
 		resultDropdown.empty();
 		resultDropdown.html(data);

 		$('#now-select-data').find('button[type=submit]').prop('disabled', false);
 	}); 

 }); 
//......................................................................................       
});
</script>

<?php
include("includes/footer.php");
?>
