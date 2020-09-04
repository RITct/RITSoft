<?php
/**
 * @Author: indran
 * @Date:   2018-10-18 20:07:45
 * @Last Modified by:   indran
 * @Last Modified time: 2018-10-21 20:11:24
 */
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
$count=0;

$classid=$_SESSION["classid"];



$series = 1;

if (isset($_GET['series'])) {
	if($_GET['series'] == '1' || $_GET['series'] == '2')
		$series = $_GET['series'];
}

?>


<div id="page-wrapper">

	<div class="row">
		<div class="col-md-8 col-sm-12" >
			<h1 class="page-header">SERIES MARK OF 
				<?php
				$r=mysql_query("select courseid,semid from class_details where classid='$classid'");
				while($d=mysql_fetch_array($r))
				{
					$co=$d["courseid"];
					$sem=$d["semid"];
				}
                        //echo $co;
				?>       
				SEMESTER
				<?php
				echo $sem;
				?>       
			</h1>
		</div>

		<div class="col-md-4 col-sm-12" style="padding: 3.5rem 0;" >
			<form method="get">
				<select class="form-control" name="series" onchange="this.form.submit()">
					<option selected disabled>select series </option>	

					<option  <?php if($series == '1') echo " selected "; ?> value="1" >1st series </option>	
					<option  <?php if($series == '2') echo " selected "; ?> value="2" >2nd series </option>	
				</select>
			</form>
		</div>

		<!-- /.col-lg-12 -->
	</div>
	<div class="table-responsive">
		<table width="50%"  class="table table-hover table-bordered" id="talbew">
			<tr>
				<th style="text-align: center;">ADMISSION NUMBER</th>
				<th style="text-align: center;">ROLL NO</th>
				<th style="text-align: center;">NAME</th>
				<?php
				$re=mysql_query("select * from subject_class where classid='$classid'");
				while($d=mysql_fetch_array($re))
				{
					$subjectid=$d["subjectid"];
					$subject_title=$d["subject_title"];
					?>
					<th align="center">
						<small><?php echo $subject_title; ?> </small><sub style=" color: #337ab7; "><?php echo $subjectid; ?></sub>

					</th>
					<?php
				}
				?>

			</tr>





			<!-- Fetching sessional mark of individual students -->



			<?php $st=1;
			$resul=mysql_query("SELECT distinct(e.studid)from each_sessional_marks e LEFT JOIN  current_class c  ON e.studid = c.studid  where e.classid='$classid' AND e.series_no = '$series' order by c.rollno  ");
			while($dat=mysql_fetch_array($resul))
			{
            //$c=0;
				$studid=$dat["studid"];


				$rollno = 0;
				$res=mysql_query("select rollno from current_class where studid='$studid'");
				while($da=mysql_fetch_array($res))
				{
					$rollno=$da["rollno"];
				}

				$re=mysql_query("select name from stud_details where admissionno='$studid'");
				while($d=mysql_fetch_array($re))
				{
					$name=$d["name"];
				}

				?>


				<tr>
					<td align="center"><?php echo $studid;?></td>
					<td align="center"><?php echo $rollno;?></td>
					<td align="center"><?php echo $name;?></td>
					<?php
					$re=mysql_query("select subjectid from subject_class where classid='$classid'");
					while($d=mysql_fetch_array($re))
					{
						$subjectid=$d["subjectid"];
						$sessional_marks='--';

						$result=mysql_query("select * from each_sessional_marks where classid='$classid' and studid='$studid' and subjectid='$subjectid' AND  series_no = '$series' order by(subjectid)");

						while($data=mysql_fetch_array($result))
						{
							$classid=$data["classid"];
                    //$studid=$data["studid"];
							$subid=$data["subjectid"];
							$data["sessional_marks"];

							$sessional_marks=$data["sessional_marks"];

							?>

							<?php



						}   

						?>
						<td align="center"><?php /*echo $subjectid; echo " : ";*/ echo $sessional_marks;?></td>
						<?php
					}
					?>

				</tr>



				<?php
			}
			?>
		</table> 
	</div>
	<button class="btn btn-primary" onclick="PrintElem('page-wrapper')">Print</button>
	<button class="btn btn-primary" id="nodatexl">excel</button>


	<!-- /.row -->
	<div class="row">





		<!-- /.row -->
		<div class="row">
			<div class="col-lg-8">

			</div>
			<!-- /.panel-heading -->

			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->

		<!-- /.panel-body -->

		<!-- /.panel-footer -->
	</div>
	<!-- /.panel .chat-panel -->
</div>
<!-- /.col-lg-4 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

<form id="gooddnowdatafor" action="html_to_xl.php" method="post" target="_blank" style="display: none;">
	<input type="hidden" name="html">
</form>

</div>
<!-- /#wrapper -->   
<?php

include("includes/footer.php");
?>

<script type="text/javascript">
	$(document).ready(function($) {
		$(document).on('click', '#nodatexl', function(event) {
			event.preventDefault(); 
			$this = $('#talbew'); 
			$html =  $this.html() + ""; 
			$('#gooddnowdatafor').find('input').val( $html );
			$('#gooddnowdatafor').submit();

		});
		
	});


</script>