<?php

/**
 * @Author: indran
 * @Date:   2018-10-07 22:28:30
 * @Last Modified by:   indran
 * @Last Modified time: 2018-10-07 22:28:39
 */ 

if(false){



	include("../connection.mysqli.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
	$isOkay = false;

	$id=explode("-",$_REQUEST["id"]);
	if(isset($id[1])){
		if($id[1]=="LAB" ) {
			$isOkay = true;
			if( true){

				$res=mysqli_query($con3,"select * from lab_batch where sub_code='$id[0]' and classid='$id[2]'");
				while($rs=mysqli_fetch_array($res)) {
					?>
					<input type="checkbox" name="batch[]" value="<?php echo $rs['batch_id']; ?>"/><?php echo $rs["batch_name"]; ?>
					<?php			
					$isOkay = false;
				}
			}


		}
	}

	if($isOkay) {
		?>

		<div class="alert alert-warning">
			<p>Create a lab batch first</p>
		</div>

		<input type="checkbox" style="display: none !important;" name="batch[]" value="true"/> 
		<?php	
	}




} else   {
	include("../connection.mysqli.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
	$isOkay = false;

	$id=explode("-",$_REQUEST["id"]);
	if(isset($id[1])){
		if($id[1]=="LAB" ) {
			$isOkay = true;
			if( true){
				?>
				<select class="form-control " name="batch[]" >
					<option value="all">All</option>
					<?php
					$res=mysqli_query($con3,"select * from lab_batch where sub_code='$id[0]'");
					while($rs=mysqli_fetch_array($res)) {
						?>
						<option   value="<?php echo $rs['batch_id']; ?>"/><?php echo $rs["batch_name"]; ?></option>
						<?php			
						$isOkay = false;
					}
					?>
				</select>

				<?php
			}


		}
	}

	if($isOkay) {
		?>

		<div class="alert alert-warning">
			<p>Create a lab batch first</p>
		</div>

		<input type="checkbox" style="display: none !important;" name="batch[]" value="true"/> 
		<?php	
	}
}

?>