<?php
include("includes/header.php");
include("includes/sidenav.php");
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header" align="center"><span>View Staff Advisors</span></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">


			<form id="subview" action = "" method = "POST" enctype = "">
				<?php
				$s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
				$r = mysql_fetch_assoc($s);
				$deptname=$r["deptname"];

				$sql ="select * from class_details  where deptname='$deptname'";
				$result = mysql_query($sql);
		//and active like '%YES%'"
				?>

			</form>
			<br><br>
			<div class=".col-sm-6 .col-md-5 .col-md-offset-2 .col-lg-6 .col-lg-offset-0">


				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

					<tr>
						<th>Faculty Name</th>
						<th>Semester</th>
						<th>Students List</th>
						<th>Remove</th>
					</tr>
					<?php

					$sql =mysql_query("select * from staff_advisor where classid in (select classid from class_details where deptname in(select deptname from department where hod='$hodid'))");

					while($dat=mysql_fetch_array($sql))
					{
						$staffid=$dat['fid'];
			//$fid=$dat["fid"];
						$class=$dat["classid"];
						$stud=$dat["students_list"];
						

						$sql1=mysql_query("select name from faculty_details where fid='$staffid'");
						while($r=mysql_fetch_array($sql1)){
							$name=$r["name"];

							$sql2 =mysql_query("select semid  from class_details where classid ='$class'");
							while($res=mysql_fetch_array($sql2)){
								$sem=$res["semid"];
								?>
								
								<tr>
									<td><?php echo $name;?></td>
									<td><?php echo "S";echo $sem;?></td>
									<td><?php echo $stud;?></td>
									<td><a href="deletestaffadvisor.php?staffid=<?php echo $staffid;?> & clid=<?php echo $class;?>" onclick="return confirm('Are you sure to delete?');">REMOVE</a></td>
								</tr>

							</tr>
							
							<?php
						}
					}
				}	 
				?>

			</table>

		</div>
	</div>
</div>
</div>
<?php 
include("includes/footer.php");
?>


