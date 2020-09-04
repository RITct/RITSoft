<?php
session_start();
$con=mysql_connect("localhost","root","");
mysql_select_db("ritsoft2",$con);
$hodid='KTU01';
if(isset($_POST["clsid"])){
	$classid=$_POST["clsid"];
}
?>
<html>
<body>
	<form action="" method="post">
		<label>Class:</label>
		<?php
		$s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
		$r = mysql_fetch_assoc($s);
		$deptname=$r["deptname"];
		//echo $deptname;
		$sql ="select * from class_details  where deptname='$deptname'";
		$result = mysql_query($sql,$con);
		?>
		<select name='clsid' onchange="this.form.submit()">
			<option value =''>Select</option>
			<?php
			while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row["classid"] ."'>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";
			}
			echo "</select>";
			?>        
		</form>
	</body>
	</html>
	<table>
		<tr><th>Faculty Name</th><th>Subject-ID</th><th>Subject</tr>
			<?php
			if(isset($_POST["clsid"])){
				$classid=$_POST["clsid"];
				$sql =mysql_query("select * from subject_allocation where classid='$classid'",$con);
				if(mysql_num_rows($sql)>0){
					while($r=mysql_fetch_array($sql))
					{
						$subjectid=$r["subjectid"];
						$fid=$r["fid"];
						$sql1=mysql_query("select s.subject_title,f.name from subject_class s,faculty_details f where s.subjectid='$subjectid' and f.fid='$fid'",$con);
						while($r1=mysql_fetch_array($sql1)){
							$title=$r1["subject_title"];
							$name=$r1["name"];
							?>
							<tr>
								<td><?php echo $name;?></td>
								<td><?php echo $subjectid;?></td>
								<td><?php echo $title;?></td>
							</tr>
							<?php
						}
					}
				}
				else{
					?>
					<td><?php echo "No Records Found";?></td>
					<?php
				}
			}
			?>

		</table>