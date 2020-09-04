<?php
include("includes/connection.php");
include("includes/header.php");
$subjectid=$_GET['id'];

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
$acdyear=date("Y");
$prev=$acdyear-1;
$prev.="-". $acdyear; 
$i=1;
$sq=mysql_query("SELECT qs12 FROM mainfeedback WHERE subjectid='$subjectid' and acdyear='$prev' and qs12!=''",$con);

while ($re=mysql_fetch_array($sq))
{
	$row=$re['qs12'];
	//echo $row;
	echo $i." .".$re['qs12'];
	$i=$i+1;
	echo "<br>";
}
?>
 </form>
</body>
</html>

<?php
include("includes/footer.php");
?>

