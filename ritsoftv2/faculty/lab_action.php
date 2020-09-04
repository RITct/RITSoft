 <?php
// $con=mysqli_connect("localhost","root","","ritsoft");
 include("includes/connection3.php");
 //session_start();
 $uname=$_SESSION['fid'];
 if(isset($_POST["submit"]))
 {
 	$a=explode(",",$_POST['a']);
 	$b=explode("-",$_POST['b']);
 	$c=$_POST["date"];



 	// $d=$_POST["hour"];

 	$e=explode(",",$_POST["batch"]);
 	$g=0;

foreach($_POST['hour'] as $d) {
//echo $d;

 	 for($i=0;$i<sizeof($e);$i++)
 	{
	//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c,lab_batch_student l where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and l.batch_id='$e[$i]' and l.admissionno=a.adm_no order by c.rollno asc");
 		$res=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,lab_batch_student l where c.classid='$a[0]' and c.studid=b.admissionno and l.batch_id='$e[$i]' and l.studid=c.studid order by c.rollno asc");

 		while($rs=mysqli_fetch_array($res))
 		{
 			
 			$sid=$rs["studid"];
 			$resoIn = mysqli_query($con3,"SELECT * FROM attendance where  date = '$c' and hour= '$d' and classid = '$a[0]' and studid = '$sid' ");

 			if(mysqli_num_rows($resoIn) == 0) {

 				if(isset($_POST[$rs["studid"]]))
 					$st="P";
 				else
 					$st="A";
			//echo "insert into attendance values('0','$c','$d','$b[0]','$a[0]','$sid','$st')<br/>";
 				$g=mysqli_query($con3,"insert into attendance values('0','$c','$d','$b[0]','$a[0]','$sid','$st')");

 			}
 		}
 	}
 	if($g>0)
 	{
 		?>
 		<script>
 			alert("Insert Successful");
 			window.location="hos_att.php";
 		</script>
 		<?php
 	}
 	else
 	{
 		?>
 		<script>
 			alert("Error In Insertion");
 			window.location="hos_att.php";
 		</script>
 		<?php
 	}


}  

 }
 ?>