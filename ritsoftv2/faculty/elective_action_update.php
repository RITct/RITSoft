 <?php
 //$con=mysqli_connect("localhost","root","","ritsoft");
 include("../connection.mysqli.php");
//session_start();
$uname=$_SESSION['fid'];
	if(isset($_POST["submit"]))
	{
	$a=explode(",",$_POST['a']);
	$b=explode("-",$_POST['b']);
	$c=$_POST["date"];
	$d=$_POST["hour"];
	
	//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c,elective_student e where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and e.sub_code='$b[0]' and e.stud_id=a.adm_no order by c.rollno asc");
	$res=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,elective_student e where c.classid='$a[0]' and c.studid=b.admissionno and e.sub_code='$b[0]' and e.stud_id=c.studid order by c.rollno asc");
        $i=1;
	$e=0;
	while($rs=mysqli_fetch_array($res))
	{
		$sid=$rs["studid"];
		if(isset($_POST[$rs["studid"]]))
			$st="P";
			else
			$st="A";
			//echo "update attendance set status='$st',subjectid='$b[0]' where date='$c' and studid='$sid' and hour='$d'<br/>";

//check whether details in attendance table, if so update otherwise insert

                $r11=mysqli_query($con3,"select * from attendance where date='$c' and studid='$sid' and hour='$d'");
                //$d11=mysqli_fetch_array($r11);
                if(mysqli_num_rows($r11)==0)
                {
                  $e=mysqli_query($con3,"insert into attendance(date,hour,subjectid,classid,studid,status)values('$c','$d','$b[0]','$a[0]','$sid','$st')");

                }

               else 
               {
		$e=mysqli_query($con3,"update attendance set status='$st',subjectid='$b[0]' where date='$c' and studid='$sid' and hour='$d'");
               }
			$i++;
	}
	if($e>0)
	{
		?>
        <script>
		alert("Insert Successfully");
		window.location="hos_update.php";
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert("Error In Updation");
		window.location="hos_update.php";
		</script>
        <?php
	}
	}
	?>