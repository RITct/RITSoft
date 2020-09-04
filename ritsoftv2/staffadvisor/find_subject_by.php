<?php
/**
 * @Author: indran
 * @Date:   2018-08-16 12:41:21
 * @Last Modified by:   indran
 * @Last Modified time: 2018-08-16 14:48:42
 */
session_start();

$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");


?>
<?php 
$subject = null;
$subjectid = null;

$isOk = false;

if(isset($_POST['date']) && isset($_POST['hour'])) {

	$date = $_POST['date'];
	$hour = $_POST['hour'];
	$classid =  $_SESSION['classid'];

	$sql = "SELECT * FROM attendance WHERE date='$date' AND hour='$hour' AND  classid='$classid' ORDER BY attid DESC LIMIT 1 ";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){ 
			while($row = mysqli_fetch_array($result)){
				
				$sql = "SELECT * FROM subject_class WHERE subjectid = '".$row['subjectid']."' ";
				if($resultIn = mysqli_query($link, $sql)){
					if(mysqli_num_rows($resultIn) > 0){ 
						while($rowIn = mysqli_fetch_array($resultIn)){
							$isOk = true; 
							$subject  =  $rowIn['subject_title'] .' - '. $rowIn['type'];

							$subjectid = $row['subjectid'];
						}
					}
				} 

			}
		}
	} else {
		$isOk = false;

	}

}

?>

<?php if($isOk && !is_null($subject)) : ?>

	<div class="row form-group" style="margin-top: 2rem;">
		<div class="col-sm-3 col-md-2">
			<label class="form-label" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				subject
			</label>
		</div>
		<div class="col-sm-9 col-md-8">
			<input type="hidden" name="subject"  class="form-control subject" id="subject" value="<?php  echo $subjectid; ?>">
			<p style="text-align: left;" class="form-control subject">
				<?php  echo $subject; ?>
			</p>
		</div>
	</div>
	<div class="row form-group" style="margin-top: 2rem;">
		<div class="col-sm-3 col-md-2">
			<label class="form-label" style="text-transform: capitalize; font-weight: 700; float: right; text-align: right; padding-right: 1rem;">
				remarks
			</label>
		</div>
		<div class="col-sm-9 col-md-8">
			<textarea class="form-control " id="remark" name="remark" placeholder="enter remarks .... "></textarea>

		</div>
	</div>



	<div class="row form-group" style="margin-top: 2rem; text-align: center;">

		<div class="col-sm-12">
			<input type="submit" name="okay_ind" class="btn btn-primary " style="text-transform: capitalize;" value="approve duty leave">
		</div>
	</div>

	<?php else: ?>

		<div class="row" style="margin-top: 2rem;">

			<div class="col-sm-12  text-center ">
				<label class="string text-warning" style="text-transform: capitalize; font-weight: 700;  text-align: center; padding-right: 1rem;">
					<i class="fa fa-exclamation-triangle " style="padding-right: 0.25rem;"></i> attendance not yet added 
				</label>
			</div>




		</div>


		<?php endif; ?>