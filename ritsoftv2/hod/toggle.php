<?php 
session_start();
include("../connection.php");
 ?>
 <style>
	.switch {
		position: relative;
		display: inline-block;
		width: 80px;
		height: 50px;
	}

	.switch input {display:none;}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 40px;
		width: 40px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked + .slider {
		background-color: #2196F3;
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>
<?php


if (isset($_POST["key"])) {
$classid=$_POST["key"];
$_SESSION["classid"]=$classid;
if($classid!="")
{
$sql=mysql_query("select status from feedback_status where classid='$classid'");

	$result=mysql_fetch_array($sql);

$st=$result['status'];

if($st==1)
{
	$qw="ON";
	$c='checked="checked"';
}
else
{
	$c="";
	$qw="OFF";
}

?>
<center>
	<br>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<label class="switch">
				<input type="hidden" name="status" value="0">
				<input type="checkbox" name="status" <?php echo $c; ?> value="1" onchange="this.form.submit()">
				<span class="slider round"></span>
				
			</label>

		</div>
	</div>
	
</center>
<?php
}
}

 ?>