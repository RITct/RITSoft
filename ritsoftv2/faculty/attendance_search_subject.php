
<title>Untitled Document</title>
</head>
<?php
// include("includes/header.php");
// include("includes/sidenav.php"); 
include("includes/connection3.php");

?>
<div  > 
	<label for="txtstudid"></label>
	<form id="form1" name="form1" method="post" action="">
		<?php
		$admisno=$_GET['admis'];
		$w=0;
		$name=$_GET['name'];
		$cls=$_GET['class'];
		$s=$_GET['subj'];
//$name=$_GET['name'];
//echo $admisno;
		?>
		<h4><?php echo $name."(".$admisno.")";?></h4>



		<h4><?php echo "  Roll No:  " ;



		$res=mysqli_query($con3,"SELECT * FROM current_class WHERE studid ='$admisno' AND classid = '$cls' ");

		if(mysqli_num_rows($res) > 0){
			while($rs=mysqli_fetch_array($res)) {  

				echo $rs["rollno"];   
			}
		}



		?></h4>


		<?php
		$date1=$_GET["date1"];	
		$date2=$_GET["date2"];
		?>	
		<h4><?php echo "  From  " . date("d-m-Y", strtotime($date1)) ;?></h4>
		<h4><?php echo  "  To  " . date("d-m-Y", strtotime($date2));?></h4>
		<table border="1" class="table table-hover table-bordered">
			<tr><th>Absent Date </th> <th> Hour </th></tr>

			<?php   
			$dat=mysqli_query($con3,"select distinct(date) from attendance where studid='$admisno' and date BETWEEN '$date1' and '$date2' and subjectid='$s' and status='A'")or die(mysqli_error($con3));
			while($result=mysqli_fetch_array($dat)) 	
			{

				$d=$result["date"];
	//$subject=$result["subjectid"];
				?>
				<tr>
					<td><?php echo date("d-m-Y", strtotime($d)); ?></td>
					<td>
						<?php
						$sql=mysqli_query($con3,"select distinct(hour) from attendance where studid='$admisno' and subjectid='$s' and date='$d' and status='A'") or die(mysqli_error($con3));	
						while($result=mysqli_fetch_array($sql)) 	
						{	
							$hour=$result["hour"];
							echo "&nbsp; &nbsp; &nbsp; $hour";

						}	
						?>
					</td>
				</tr>
				<?php
				$w++;

			}?></table><?php
			if($w==0)
				echo "No Record Found";
			else
			{
				?>


				<br />

				<?php
			}
			?>



		</form>


	</div>

	<?php include("includes/footer.php"); ?>