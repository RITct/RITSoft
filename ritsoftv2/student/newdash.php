<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");

if(isset($_POST["bugsubmit"]))
{

$to = "senterror01@gmail.com";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";
if (mail($to, $subject, $body)) {
echo("<p>Email successfully sent!</p>");
} else {
echo("<p>Email delivery failed…</p>");
}

}
	

	
?>

<script src="jquery.js"></script>

<script type="text/javascript">
//function fetchsub(a)
//{
	//$.post("getsubject.php",{ key : a},
//	function(data){
	//	$('#data').html(data);
	//});
//}
</script>


  
      <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><b>BUG REPORTING</b></h1>
			</div>
	  <form id="form1" name="form1" method="post"  enctype="multipart/form-data" class="sear_frm" >
	  
	  
  
	  <div class="form-group col-md-6">
      <label>ERROR TYPE</label>
	   <select class="form-control" onchange="fetchsub(this.value)" name="semester">
  
   <option  value="">--select--</option>
    
	<option  value="issue">issue</option>
	<option  value="bug">bug</option>
		</select>
		
    </div>
		  <div class="form-group col-md-6">
      <label>DESCRIPTION</label>
	<input class="form-control"  type="text" name="desc" value=" ">
	
		
    </div>

	<td>
<input type="submit" class="btn btn-primary"  name="bugsubmit" value= "SUBMIT"/>
</td>
	
<div id="data">
             
			 
 </div>


  
        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    
                 <?php
                // session_start();
                // include('connection.php');
            //    include ('mail.php');
			$to=$_POST["to"];
			echo $to;
			$type=$_POST["type"];
			$msg=$_POST["Message"];
			$subject=$_POST["Subject"];
			$res= mysql_query("select sysdate() as day from dual");
			while ($row=mysql_fetch_assoc($res)){
				$date=$row['day'];
			}
			if($to=='HOD')
			{
				$designation='hod';
				$query="SELECT hod FROM department WHERE deptname = (SELECT deptname FROM class_details WHERE classid = (SELECT classid FROM current_class WHERE studid =  '{$_SESSION['admissionno']}' ) )";
			    $res=mysql_query($query);
    			while($row =mysql_fetch_assoc($res))
    			{
    				
    					$id=$row['hod'];
    			}
    		}
			else if($to=='StaffAdvisor')
			{
				$designation='staff advisor';
				$query="select fid from staff_advisor where classid=(SELECT classid FROM current_class WHERE studid =  '{$_SESSION['admissionno']}' ) ";
				$res=mysql_query($query);
    			while($row =mysql_fetch_assoc($res))
    			{
    					$id=$row['fid'];
    			}
			}
			
			else if ($to=='PG')
			{
				$designation='pgdean';
			    $query="SELECT fid FROM faculty_designation WHERE designation='pgdean'";
			    $res=mysql_query($query);
			    while($row =mysql_fetch_assoc($res))
			    {
			         $id=$row['fid'];
			    }
			}
			else if ($to=='UG') 
			{
				$designation='ugdean';
			    $query="SELECT fid FROM faculty_designation WHERE designation='ugdean'";
			    $res=mysql_query($query);
			    while($row =mysql_fetch_assoc($res))
			    {	        
			        $id=$row['fid'];
			    }
			}
			else if ($to=='Principal')
			{
				$designation='principal';
			    $query="SELECT fid FROM faculty_designation WHERE designation='principal'";
			    $res=mysql_query($query);
			    while($row =mysql_fetch_assoc($res))
			    {
			        
			        $id=$row['fid'];
			    }
			}
			echo $designation;
			$student="select name from stud_details where admissionno='{$_SESSION['admissionno']}'";
			$res3=mysql_query($student);
			while($row =mysql_fetch_assoc($res3))
			{
			    
			    $stud=$row['name'];
			}
			$sql="insert into complaint (stud_id,fid,com_type,subject,content,com_time,designation)values('".$_SESSION["admissionno"]."','".$id."','".$type."','".$subject."','".$msg."','".$date."','".$designation."')";
			$query=mysql_query($sql);
			require_once("classes/class.phpmailer.php");
			// include the class name
			$mail="select email from faculty_details where fid='{$id}'";
			$q=mysql_query($mail);
			while($row=mysql_fetch_assoc($q)){
			    $mail_to=$row['email'];
			}
			
			$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587 465
			$mail->IsHTML(true);
			$mail->Username = "youradmin@yourdomain.com";
			$mail->Password = "youradminmailpassword";
			$mail->SetFrom("youradmin@yourdomain.com");
			$mail->Subject =" New Grievance from parent";
			$mail->Body = "Dear Sir/Madam, <br>New grievance from parent of ".$stud. ".<br>
                                            <table>
                                            <tr>
                                                <td>Complaint type</td>
                                                <td> : </td>
                                                <td>".$type."</td>
                                            </tr>
                                            <tr>
                                                <td>Subject</td>
                                                <td> : </td
                                                <td>".$subject."</td>
                                            </tr>
                                            </table>
                                            <br> <br><br>Login for more details........<br><br> Thanking You...";
			$mail->AddAddress($mail_to);//here mailid is fetched from the database
			//$mail->AddAttachment($file_name);
			if(!$mail->Send())
			{
			    unset($mail);
			    $senddet="<br>Sending Failed to ".$mail_to;
			}
			else
			{
			    unset($mail);
			    
			    $senddet="<br>mail send to  ".$mail_to;
			    
			}
						
		  echo "<script>window.location.href='grievances.php'</script>";
		  echo "<script>alert($subject)</script>";
		  
?>			
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

    </div>
    <!-- /#wrapper -->   

	<?php

include("includes/footer.php");
?>