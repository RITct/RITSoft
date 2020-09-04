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
			<h1 class="page-header" align="center"><span>View Subject </span></h1>
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
							<th>Subject-ID</th>
							<th>Subject</th>

							<th>Type</th>
							<th>Internal Pass Mark</th>
							<th>Internal Max</th>
							<th>External Pass Mark</th>
							<th>External Max</th>
							<th></th>
						</tr>
						<?php
						if(isset($_POST["clsid"])){
							$classid=$_POST["clsid"];

							$sql =mysql_query("select * from subject_class where classid='$classid'");
							while($dat=mysql_fetch_array($sql))
							{
								$subjectid=$dat["subjectid"];
								$title=$dat["subject_title"];
								$type=$dat["type"];
								$inpass=$dat['internal_passmark'];
								$inmax=$dat['internal_mark'];
								$expass=$dat['external_pass_mark'];
								$exmax=$dat['external_mark'];

								?>

								<tr>
									<td><?php echo $subjectid;?></td>
									<td><?php echo $title;?></td>

									<td><?php 
									if ($type=="CORE")	echo "Theory";
									elseif ($type=="ELECTIVE") echo "Elective";
									elseif ($type=="LAB") 	echo "Practical";

									?>

								</td>
								<td><?php echo $inpass;?></td>
								<td><?php echo $inmax;?></td>
								<td><?php echo $expass;?></td>
								<td><?php echo $exmax;?></td>


								<td><a href="removesubject.php?subjectid=<?php echo $subjectid ;?>&classid=<?php echo $classid;?>" onclick="return confirm('Are you sure to delete?');">REMOVE</a>
									<?php echo "  |  ";?><a href="subject_edit.php?subid=<?php echo $subjectid ;?>&classid=<?php echo $classid;?>">EDIT</a>


								</td>

							</tr>

							<?php


						}
					}	 
					?>

				</table>
				<?php include("includes/footer.php"); ?>

