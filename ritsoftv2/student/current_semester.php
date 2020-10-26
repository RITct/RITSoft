<?php
/**
 * @Author: indran
 * @Date:   2018-08-24 15:32:57
 * @Last Modified by:   indran
 * @Last Modified time: 2018-08-24 15:47:14
 */
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");
$admissionno=$_SESSION["admissionno"];


?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<marquee scrolldelay="5"><h1 class="page-header"><b style="text-transform: uppercase;">current semester</b></h1></marquee>
		</div>
	</div>
	<?php 


	$query="select * from current_class where studid='$admissionno'";	
	$res=mysql_query($query);
	$row =mysql_fetch_assoc($res);

	$quer="select * from class_details where classid ='" . $row['classid'] . "'";
	$l=mysql_query($quer);
	$r=mysql_fetch_assoc($l);


	?>
	<form method="post" action="form_filling.php">
		<div class="table-responsive">
			<table   class="table table-hover table-bordered" border="4">
				<tr>
					<th style="text-align: center;"> ADMISSION NUMBER<?php echo '<td style="text-align: center;">'.$admissionno.'</td>'?></th>
				</tr>
				<tr>
					<th style="text-align: center;"> SEMESTER <?php echo '<td style="text-align: center;">'.$r['semid'].'</td>'?></th>
				</tr>
				<tr>
					<th style="text-align: center;"> ROLL NO <?php echo '<td style="text-align: center;">'.$row['rollno'].'</td>'?></th>
				</tr>
				
				<tr>

					<th style="text-align: center;">ADMISSION STATUS <td style="text-align: center;"><?php echo $row["adm_status"];?>

					

				</td></th>
			</tr>




		</table>
	</form>	
</div>		
<?php

include("includes/footer.php");
?>
