<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
            //..............Query for fetch name,admissionno and courseid of student..............
$query="select distinct(name),admissionno,courseid from stud_details join current_class where admissionno='$admissionno'";	

$res=mysql_query($query);
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><b>SESSIONAL MARKS VIEW</b></h1>
		</div>
	</div>
	<div class="table-responsive">
		<table   class="table table-hover table-bordered" >
			<tr>
				<th style="text-align: center;"> NAME</th>
				<th style="text-align: center;"> ADMISSION NUMBER</th>
				<th style="text-align: center;"> COURSE</th>
			</tr>
			
			<?php
			while($row =mysql_fetch_assoc($res))
				
			{
				echo "<tr>";
				echo '<td style="text-align: center;">'.$row['name'].'</td>';
				echo '<td style="text-align: center;">'.$row['admissionno'].'</td>';
				echo '<td  style="text-align: center;">'.$row['courseid'].'</td>';
				
				
				
			}
			?>
		</table>
	</div>
	<?php 
			//..............Query for fetch subjectid,subject_title and sessional_marks..............
	// $query="select distinct(subjectid),subject_title,sessional_marks from sessional_marks natural join subject_class where  studid='$admissionno' AND status='verified by HOD'";
			//..............Query for fetch subjectid,subject_title and sessional_marks..............
	$query="select distinct(subjectid),subject_title,sessional_marks,sessional_remark from each_sessional_marks natural join subject_class where  studid='$admissionno'  and series_no = 1 ";
	
	
	$res=mysql_query($query);
	
	if(mysql_num_rows($res) > 0){

		?>
		<h3>1st Series</h3>

		<div class="table-responsive">
			<table   class="table table-hover table-bordered" >
				<tr>

					<th style="text-align: center;"> SUBJECT CODE</th>
					<th style="text-align: center;"> SUBJECT NAME</th>
					<th style="text-align: center;">SESSIONAL MARKS</th>
					<th style="text-align: center;">SESSIONAL REMARK </th>
				</tr>

				<?php
				while($row =mysql_fetch_assoc($res))
				{

					echo "<tr>";
					echo '<td style="text-align: center;">'.$row['subjectid'].'</td>';
					echo '<td style="text-align: center;">'.$row['subject_title'].'</td>';
					echo '<td  style="text-align: center;">'.$row['sessional_marks'].'</td>';
					echo '<td  style="text-align: center;">'.$row['sessional_remark'].'</td>';


				}
				?>
			</tbody>

		</table>
	</div>

<?php } ?>



<?php 
			//..............Query for fetch subjectid,subject_title and sessional_marks..............
	// $query="select distinct(subjectid),subject_title,sessional_marks from sessional_marks natural join subject_class where  studid='$admissionno' AND status='verified by HOD'";
			//..............Query for fetch subjectid,subject_title and sessional_marks..............
$query="select distinct(subjectid),subject_title,sessional_marks,sessional_remark from each_sessional_marks natural join subject_class where  studid='$admissionno' and series_no = 2  ";


$res=mysql_query($query);
if(mysql_num_rows($res) > 0){
	?>

	<h3>2nd Series</h3>

	<div class="table-responsive">
		<table   class="table table-hover table-bordered" >
			<tr>

				<th style="text-align: center;"> SUBJECT CODE</th>
				<th style="text-align: center;"> SUBJECT NAME</th>
				<th style="text-align: center;">SESSIONAL MARKS</th>
				<th style="text-align: center;">SESSIONAL REMARK</th>
			</tr>

			<?php
			while($row =mysql_fetch_assoc($res))
			{

				echo "<tr>";
				echo '<td style="text-align: center;">'.$row['subjectid'].'</td>';
				echo '<td style="text-align: center;">'.$row['subject_title'].'</td>';
				echo '<td  style="text-align: center;">'.$row['sessional_marks'].'</td>';
				echo '<td  style="text-align: center;">'.$row['sessional_remark'].'</td>';


			}
			?>
		</tbody>

	</table>
</div>
<?php } ?>





</div>
<?php

include("includes/footer.php");
?>