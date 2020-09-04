 <?php
include("includes/header.php");
include("includes/sidenav.php");
?>


<script src="jquery.js"></script>

<script type="text/javascript">
function getbranch(a)
{
	console.log(a);
  $.post("fetchbranch.php",{ key : a},
  function(data){
    $('#data').html(data);
  });
}
</script>

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Change Active Semester</h2>
                    </div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Course</label>
						<select class="form-control" onchange="getbranch(this.value)">
							<option value="">--select--</option>
							<?php
							$l=mysql_query("select distinct courseid from class_details") or die(mysql_error());
							while ($r=mysql_fetch_assoc($l)) {
								echo '<option value="'.$r["courseid"].'">'.$r["courseid"].'</option>';
							}

							?>
						</select>
					</div>
					<div id="data"></div>
					
				
</div>
</div>



 <?php
include("includes/footer.php");
?>  