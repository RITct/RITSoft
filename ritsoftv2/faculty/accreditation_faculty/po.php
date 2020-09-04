
<?php

include("header.php");
    include("connection.php");
    include("sidenav.php");

?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PROGRAM OUTCOMES</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
/*function deleteRow(po_code)
{
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function()
	{
		if(xhttp.readyState==4 &&xhttp.status==200)
		{ alert("Deleted");
		}
	};
	document.getElementById("table").deleteRow(x);
	xhttp.open("GET","delete.php",true);
	xhttp.setReuestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+po_code);
}*/

</script>

</head>

<body>
	
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
				<form action="#" method="post">
				<h3 class="page-header"><b><center>PROGRAM OUTCOMES</center></b></h3>
				
					<div class="table-responsive">
					<table class="table table-hover table-bordered">
			 <thead>
				 <th>	PO CODE </th>
				 <th>	PO NAME  </th>
				 <th> PO DESCRIPTION </th>
			 </thead>
<?php

$result=mysqli_query($con,"select * from tbl_po");
while($row=mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['po_code'] . "</td>";
	echo "<td>" . $row['po_name'] . "</td>";
	echo "<td>" . $row['po_description'] . "</td>";
	
	/*?>
	<td>
	<input type="submit" class="btn btn-primary" title="PRINT" name="edit" value="PRINT"></input>
	<?php
	if(isset($_POST['edit']))
	{
		
		 echo "<script type='text/javascript'>alert('Are you sure')</script>";
		$c=$this->$row['po_code'];
		$query=mysqli_query($sql,"delete from tbl_po where po_code='".$c."'");
	
	}
	?>
	</td>*/
	
	echo "</tr>";
}
echo "</table>";
?>
  </table>
	</div>
	
	
	<div class="button-panel">
		<input type="submit" class="btn btn-info" title="PRINT" name="print" value="PRINT"></input>
		&emsp;
		<input type="submit" class="btn btn-info" title="BACK" name="back" value="BACK"></input>
    </div>
</form>
	</div>
	
</div>
	<?php
if (isset($_POST['print']))
{
	echo '<script> window.location="po_pdf.php"; </script>';
}
if (isset($_POST['back']))
{
	echo '<script> window.location="dash_home.php"; </script>';
}
	?>

<?php
    include("footer.php");
?>