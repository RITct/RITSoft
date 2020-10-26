<?php
include("includes/header.php");
include("../connection.php");

$subjectid=$_GET['id'];
$fid=$_GET['fid'];
$i=1;

include("includes/sidenav.php");



?>
<!DOCTYPE html>
<html>
<head>
	<title>
		remarks
	</title>
</head>
</body>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Remarks</h1>
			</div>
		</div>
		<form method="post">
			<?php
//current date
			$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
			$r=mysql_fetch_assoc($l);
			$prev=$r["acd_year"];

//...........query retrieving remarks
			$sq=mysql_query("SELECT qs12 FROM mainfeedback WHERE subjectid='$subjectid'and fid='$fid' and acdyear='$prev' and qs12!=''",$con);

			while ($re=mysql_fetch_array($sq))
			{
				$row=$re['qs12'];
	//echo $row;
				echo $i.". ".$re['qs12'];
				$i=$i+1;
				echo "<br>";
			}
			?>
			<br>
			<input type="submit" class="btn btn-primary" name="submit" value="Back" align="middle"/>
			<?php
			if(isset($_POST["submit"]))
			{
				echo "<script>window.location.href='datasheet.php'</script>";

			}
			?>
		</form>
	</body>
	</html>

	<?php
	include("includes/footer.php");
	?>

