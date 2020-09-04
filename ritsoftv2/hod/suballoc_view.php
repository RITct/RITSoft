<?php
include("includes/header.php");
include("includes/sidenav.php");

if(isset($_POST["clsid"]))	{
	$classid=$_POST["clsid"];
}
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header" align="center"><span>Subject Allocation</span></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">


			<form id="subview" action = "" method = "POST" enctype = "">
				<?php
				$s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
				$r = mysql_fetch_assoc($s);
				$deptname=$r["deptname"];

				$sql ="select * from class_details  where deptname='$deptname' and active like '%YES%'";
				$result = mysql_query($sql);
				?>
				<select name='clsid' class="form-control" onchange="this.form.submit()">
					<option value =''>Select class</option>
					<?php
					while ($row = mysql_fetch_array($result)) {
						echo "<option value='" . $row["classid"] ."'>" . $row["courseid"] . "-S" . $row["semid"] . "-" . $row["branch_or_specialisation"] . "</option>";
						
					}
					echo "</select>";
					?>  
				</form>
				<br><br>
				<div class=".col-sm-6 .col-md-5 .col-md-offset-2 .col-lg-6 .col-lg-offset-0">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

						<tr>
							<th>Faculty Name</th>
							<th>Subject-ID</th>
							<th>Subject</th>
							<th></th>
							<th></th>
						</tr>
						<?php
						if(isset($_POST["clsid"])){
							$classid=$_POST["clsid"];

							$sql =mysql_query("select * from subject_allocation where classid='$classid' and classid in (select classid from class_details where active like '%YES%' and deptname in(select deptname from department where hod='$hodid'))");
							while($dat=mysql_fetch_array($sql))
							{
								$subjectid=$dat["subjectid"];
								$fid=$dat["fid"];
								$type=$dat["type"];
								$sql1=mysql_query("select subject_title from subject_class where subjectid='$subjectid' and classid='$classid'");
								while($r1=mysql_fetch_array($sql1)){
									$title=$r1["subject_title"];
									
									
									$sql2=mysql_query("select name from faculty_details where fid='$fid'");
									while($r=mysql_fetch_array($sql2)){
										$name=$r["name"];
										
										?>
										
										<tr>
											<td><?php echo $name;?></td>
											<td><?php echo $subjectid;?></td>
											<td><?php echo $title;?></td>
											<td><?php echo ucfirst($type); ?></td>
											<td><a href="suballocedit.php?staffid=<?php echo $fid;?>&subid=<?php echo $subjectid ?>&classid=<?php echo $classid; ?>&type=<?php echo $type ?>" >EDIT </a>	<?php echo " | ";?>	
												<a href="suballocremove.php?staffid=<?php echo $fid;?>&subid=<?php echo $subjectid ?>&classid=<?php echo $classid; ?>&type=<?php echo $type ?>" onclick="return confirm('Are you sure to delete?');">DELETE</a></td>
												

											</tr>
											
											<?php
										}
									}
								}
							}	 
							?>

						</table>


