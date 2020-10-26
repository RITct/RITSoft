<?php

$subid=$_GET['subid'];
$classid=$_GET['classid'];
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");


$sql=mysql_query("select * from department where hod='$hodid'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$deptname=$result['deptname'];

?>
<script>
	function validate()
	{
		var s1 = document.getElementById('deptname').value;
		var s2 = document.getElementById('type').value;
		if(s1=="--select--"){
			alert("Please select class");
			return false;
		}

		if(s2=="--select--"){
			alert("Please select type");
			return false;
		}
		return true;
	}

	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;

		return true;
	}
</script>

<div id="page-wrapper">

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Subject</h1>
			</div>
		</div>

		<?php

		$sql1="select * from subject_class where subjectid='$subid' and classid='$classid'";
		$res=mysql_query($sql1,$con);
		while($resul=mysql_fetch_array($res))
		{

			$name=$resul['subject_title'];
			$classid=$resul['classid'];
			$type=$resul['type'];
			$inpass=$resul['internal_passmark'];
			$inmax=$resul['internal_mark'];
			$expass=$resul['external_pass_mark'];
			$exmax=$resul['external_mark'];


		}
		?>

		<form id="editsub" action = "editsub.php" method = "POST" enctype = "" onsubmit="return validate();">
			<table  id="outer1" align="center" style="padding-top:40px">
				<tr>
					<td>Subject-ID: <span class="required">*</span></td>
					<td>
						<input  required="required" class="form-control" id="Text1" pattern="^[A-Za-z0-9]+$" type="text" name="subid" style="text-transform:uppercase; width: 400px" value="<?php echo   $subid; ?>"/>
<input id="sid" name="sid" type="hidden" value="<?php echo   $subid; ?>">
					</td>
				</tr>
				<tr>
					<td>Subject Title: <span class="required">*</span></td>
					<td>
						<input  required="required" class="form-control" autocomplete="off" id="Text1" type="text" name="name" style="text-transform:uppercase; width: 400px" value="<?php echo   $name; ?>"/>
					</td>
				</tr>
				<tr>
					<td>Semester: <span class="required">*</span></td>
					<td>
						<select name="deptname" id="deptname" class="form-control">
							<?php

							$sql="select * from class_details where deptname='$deptname' and active like '%YES%' ";
							$r=mysql_query($sql,$con);
							while($result=mysql_fetch_array($r)){
								if($result["classid"] ==$classid)
								{
									$z='selected="selected"';
								}
								else
									$z="";
							//echo '<option value="'.$result['semid'].'">'.$result['semid'].'</option>';
								echo "<option value='" . $result["classid"] ."'".$z.">".$result["courseid"]."-".$result["semid"]."-".$result["branch_or_specialisation"]."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Type: <span class="required">*</span></td>
					<td>
						<input type="hidden" value="<?php echo $type; ?>" name="type">
						<select name="type" id="type" class="form-control">
							<option value="<?php $type ?>"><?php echo   $type; ?></option>
							<option value="CORE">THEORY</option>
							<option value="LAB">PRACTICAL</option>
							<option value="ELECTIVE">ELECTIVE THEORY</option>
							<option value="LAB">MINI PROJECT</option>
							<option value="LAB">MAIN PROJECT</option>
						</td>
					</tr>
					<tr>
						<td>Internal Pass Mark : <span class="required">*</span></td>
						<td>
							<input required="required" class="form-control" id="Text1" type="text" step="any" name="inpass" style="text-transform:uppercase; width: 400px" onkeypress="return isNumberKey(event)" value="<?php echo   $inpass; ?>"/>
						</td>
					</tr>
					<tr>
						<td>Internal Maximum Mark : <span class="required">*</span></td>
						<td>
							<input required="required" class="form-control" id="Text1" type="number" name="inmax" style="text-transform:uppercase; width: 400px" value="<?php echo   $inmax; ?>"/>
						</td>	
					</tr>
					<tr>
						<td>External Pass Mark : <span class="required">*</span></td>
						<td>
							<input required="required" class="form-control" id="Text1" type="text" name="expass" style="text-transform:uppercase; width: 400px" onkeypress="return isNumberKey(event)" value="<?php echo   $expass; ?>"/>
						</td>
						<input type="hidden" name="sub_id" value="<?= $subid ?>" />
					</tr>
					<tr>
						<td>External Maximum Mark : <span class="required">*</span></td>
						<td>
							<input required="required" class="form-control" id="Text1" type="text" name="exmax" style="text-transform:uppercase; width: 400px" value="<?php echo   $exmax; ?>"/>
						</td>
						<tr>
							<td><input style="width:200px" class="btn btn-primary" id="submit" type="submit" value="Submit" name="submit"/></td>


						</tr>
					</table>
				</form>
				<?php include("includes/footer.php");?>
