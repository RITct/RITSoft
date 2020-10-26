<?php
include("includes/header.php");
include("../connection.mysqli.php");
include("includes/sidenav.php");

//$con=mysqli_connect("localhost","root","","ritsoft");
//session_star
$st=$_SESSION['fid'];
?>
<title>Attendance</title>
<style type="text/css">
 table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
   /* border: 1px solid #ddd;*/
}

th, td {
    text-align: left;
    padding: 25px;
}

tr:nth-child(even){background-color: #f2f2f2} 
</style>
<link href="jquery-ui.css" rel="stylesheet">
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-ui.js" type="text/javascript"></script>
<script>
$(document).ready(function()
{
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
  var day = dtToday.getDate(); 
  //var day1= date('Y-m-d', strtotime('-2 day',strtotime($date_raw)));
  
    
 
        //var  day1 = strtotime('-3 day', time());
  var year = dtToday.getFullYear();
  if(month < 10)
      month = '0' + month.toString();
  if(day < 10)
      day = '0' + day.toString();
  
    
       
  var maxDate = year + '-' + month + '-' + day;

   $('#date1').attr('max', maxDate);
    $('#date2').attr('max', maxDate);
}
);
</script>


<script language="javascript" type="text/javascript">

function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getdept(course) {		
		
		var strURL="getdept.php?course="+course;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('department').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
	function getspecialization(course,department) {		
		
		var strURL="getspec.php?course="+course+"&department="+department;
		//alert(strURL);
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('specialization').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
	function getsemester(course,department,specialization) {		
		
		var strURL="getsemester.php?course="+course+"&department="+department+"&specialization="+specialization;
		//alert(strURL);
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('semester').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	</script>
</head>


 <div id="page-wrapper">
<form id="form1" name="form1" method="post" action="">
    <div class="row">
    <div class="col-lg-12">
	<h1 class="page-header"><span style="font-weight:bold;"> CLASS ATTENDANCE DETAILS
       </span></h1>
       </div>
       </div>
      <label for="course">Select Course</label>
  <select name="course" id="course" onChange="getdept(this.value)" class="form-control" >
  <option>select </option>
  <option >MCA</option>
<option> MTECH</option>
<option >BARCH</option>
<option> BTECH</option>
  </select>
  <label for="dept">Select Department</label>
  <div id="department">
  <select name="dept" id="dept" class="form-control">
  <option>select </option>
  </select>
  </div>
  <label for="spec">Select Specialisation</label>
  <div id="specialization">
  <select name="spec" id="spec" class="form-control">
  <option>select </option>
  </select>
  </div>
  <label for="sem">Select Semester</label>
  <div id="semester">
  <select name="sem" id="sem" class="form-control">
  <option>select </option>
  </select>
  </div>
 <label>From Date</label>  <input type="date" name="date1" id="date1" class="form-control" required/><br/>
  <label>To Date</label> <input type="date" name="date2" id="date2" class="form-control" required/><br/>
 <input type="submit"  name="submit" value="submit"  class="btn btn-primary"/>
</form>
<?php
if(isset($_POST["submit"]))
{
	$course=$_POST["course"];
	$dept=$_POST["dept"];
	$spec=$_POST["spec"];
	$semester=$_POST["semester"];
	$date1=$_POST["date1"];
	$date2=$_POST["date2"];
	$p=0;
	$sum=0;	
	?>
    <!--<a href="principal_print.php?a=<?php //echo $course; ?>&b=<?php //echo $dept; ?>&c=<?php //echo $spec; ?>&d=<?php //echo $semester; ?>&e=<?php //echo $date1; ?>&f=<?php //echo $date2; ?>">Print PDF</a>-->
    <?php
	$res=mysqli_query($con,"select * from class_details where courseid='$course' and deptname='$dept' and branch_or_specialisation='$spec' and semid='$semester'");
	$rs=mysqli_fetch_array($res);
	$classid=$rs["classid"];
	
	?>
    <table class="table table-hover table-bordered">
    <tr>
    <th>Roll no</th>
    <th>Students</th>
    <?php
	$res1=mysqli_query($con,"select * from subject_class where classid='$classid' order by subjectid asc");
	while($rs1=mysqli_fetch_array($res1))
	{
	?>
    <th><?php echo $rs1["subject_title"]; ?></th>
    
    <?php
	}
	?>
<th>Total</th>
	     
    </tr>
   
    <?php
	$p=0;
	$sum=0;
	//$res2=mysqli_query($con,"SELECT * FROM current_class c,stud_sem_registration s where c.classid='$classid' and s.new_sem='S$semester' and c.studid=s.adm_no order by rollno asc");
	$res2=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$classid' and c.studid=b.admissionno order by c.rollno asc");
	
	while($rs2=mysqli_fetch_array($res2))
	{	
	$studid=$rs2["studid"];
	$res3=mysqli_query($con,"select * from stud_details where admissionno='$studid'");
	$rs3=mysqli_fetch_array($res3);
	$name=$rs3["name"];
	
	?>
    <tr>
   
    <td><?php echo $rs2["rollno"]; ?></td>
    <td><?php echo $name; ?></td>
   
    <?php
	$res4=mysqli_query($con,"select * from subject_class where classid='$classid' order by subjectid asc");
	while($rs4=mysqli_fetch_array($res4))
	{
		$subjectid=$rs4["subjectid"];
		?>
           
        <?php
		
		$res5=mysqli_query($con,"select * from attendance where date BETWEEN '$date1' AND '$date2' and studid='$studid' and classid='$classid' and subjectid='$subjectid'");
		$total=mysqli_num_rows($res5);
		$res6=mysqli_query($con,"select * from attendance where date BETWEEN '$date1' AND '$date2' and studid='$studid' and classid='$classid' and subjectid='$subjectid' and status='P'");
		$present=mysqli_num_rows($res6);
		
		//$percent=0;
		if($present==0)
			$percent=0;
		else
			$percent=$present/$total;
			$p+=mysqli_num_rows($res6);;
		    $sum+=mysqli_num_rows($res5);
	?>
    <td><?php echo round($percent*100); ?></td>
    <?php
	}
	?>    
    <td><?php 
				if($sum==0)
				echo "0";
				else
				echo round(($p/$sum)*100); ?></td></tr>
                
    
	<?php
	}
	?>
  
    </table>
    <?php
}




?>


<a target="_blank" href="principal_xl.php?cls=<?php echo $classid; ?>&e=<?php echo $date1; ?>&f=<?php echo $date2; ?>">Export to Excel</a>
</div>

</div>
<?php

include("includes/footer.php");
?>