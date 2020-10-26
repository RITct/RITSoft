<?php
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
   var s2 = document.getElementById('fid').value;
   if(s1=="--select--"){
   		alert("Please select class");
		return false;
	}
	
	if(s2=="--select--"){
   		alert("Please select faculty");
		return false;
	}
	return true;
}

</script>

<div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Allocate Staff Advisor</h1>
                    </div>
				</div>
 
		
    
		<form id="addsub" action = "addstaff.php" method = "POST" enctype = "" onsubmit="return validate();">
		<table  id="outer1" align="center" style="padding-top:40px">
					
					<td>Class: <span class="required">*</span></td>
					<td>
					<select name="deptname" id="deptname" class="form-control">
					<option value="--select--">--select--</option>
					<?php

		$s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
		$r = mysql_fetch_assoc($s);
		$deptname=$r["deptname"];

		$sql ="select * from class_details  where deptname='$deptname' and active like '%YES%'";
		$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result)) {
	 echo "<option value='" . $row["classid"] ."'>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";   
 	}				
						
 						//$sql="select * from class_details where deptname='$deptname' and active like '%YES%'";
						//$r=mysql_query($sql,$con);
						//while($result=mysql_fetch_array($r)){
						//	echo '<option value="'.$result['classid'].'">'.$result['classid'].'</option>';
							//echo "<option value='" . $row["classid"] ."'>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";
						
					?>
					</select>
					</td>
				</tr>
				<td>Faculty-ID: <span class="required">*</span></td>
					<td>
					<select name="fid" id="fid" class="form-control">
					<option value="--select--">--select--</option>
					<?php
						
 						$sql="select * from faculty_details where deptname='$deptname'";
						$r=mysql_query($sql,$con);
						while($result=mysql_fetch_array($r)){
							echo '<option value="'.$result['fid'].'">'.$result['name'].'</option>';
							//echo "<option value='" . $row["classid"] ."'>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";
						}
					?>
					</select>
					</td>
					<tr>
					<td>RollNo (From-To): <span class="required">*</span></td>
					<td><input required="required" autocomplete="off" class="form-control" id="Text1" type="text" name="list"  width: 400px" /></td>					</tr>
					
				<tr>
        			<td><input style="width:200px" class="btn btn-primary" id="submit" type="submit" value="Submit" name="submit"/></td>
					
					
      			</tr>
      	</table>
	  </form>
 
    </div>
</div>


<?php 
	include("includes/footer.php");
?>