<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection1.php");

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
				<h1 class="page-header">Add Subject</h1>
			</div>
		</div>

		

		<form id="addsub" action = "addsub.php" method = "POST" enctype = "" onsubmit="return validate();">
			<table  id="outer1" align="center" style="padding-top:40px">
				<tr>
					<td>Subject-ID: <span class="required">*</span></td>
					<td>
						<input required="required" class="form-control" pattern="^[A-Za-z0-9]+$" id="Text1" type="text" name="subid" style="text-transform:uppercase; width: 400px" />
					</td>
				</tr>
				<tr>
					<td>Subject Title: <span class="required">*</span></td>
					<td>
						<input required="required" class="form-control" autocomplete="off" id="Text1" type="text" name="name" style="text-transform:uppercase; width: 400px" />
					</td>
				</tr>
				<tr>
					<td>Semester: <span class="required">*</span></td>
					<td>
						<select name="deptname" id="deptname" class="form-control">
							<option value="--select--">--select--</option>
							<?php

							$sql="select * from class_details where deptname='$deptname' and active like '%YES%' ";
							$r=mysql_query($sql,$con);
							while($result=mysql_fetch_array($r)){
							//echo '<option value="'.$result['semid'].'">'.$result['semid'].'</option>';
								echo "<option value='" . $result["classid"] ."'>".$result["courseid"]."-".$result["semid"]."-".$result["branch_or_specialisation"]."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Type: <span class="required">*</span></td>
					<td>
						<select name="type" id="type" class="form-control">
							<option value="--select--">--select--</option>
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
							<input required="required" class="form-control" id="Text1" type="text" step="any" name="inpass" style="text-transform:uppercase; width: 400px" onkeypress="return isNumberKey(event)" />
						</td>
					</tr>
					<tr>
						<td>Internal Maximum Mark : <span class="required">*</span></td>
						<td>
							<input required="required" class="form-control" id="Text1" type="text" name="inmax" style="text-transform:uppercase; width: 400px" />
						</td>	
					</tr>
					<tr>
						<td>External Pass Mark : <span class="required">*</span></td>
						<td>
							<input required="required" class="form-control" id="Text1" type="text" name="expass" style="text-transform:uppercase; width: 400px" onkeypress="return isNumberKey(event)"/>
						</td>
					</tr>
					<tr>
						<td>External Maximum Mark : <span class="required">*</span></td>
						<td>
							<input required="required" class="form-control" id="Text1" type="text" name="exmax" style="text-transform:uppercase; width: 400px" />
						</td>
						<tr>
							<td><input style="width:200px" class="btn btn-primary" id="submit" type="submit" value="Submit" name="submit"/></td>


						</tr>
					</table>
				</form>
				<?php include("includes/footer.php");?>
