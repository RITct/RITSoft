<?php
include("includes/header.php");
  include("../connection.php");
  include("includes/sidenav.php");
?>
<script type="text/javascript">
function validate()
{

if( document.AddResponse.Response.value == "" )
 { 
  alert( "Select To address" );
  document.complaint.to.focus() ; 
  return false; 
  }
   return( true );
  }
</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>GRIEVANCE
                         
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
            <!-- /.row -->
            <center>
            <div class="table-responsive">
              <?php
              $id=$_GET['id'];
              $query1="select id_com,stud_id,subject,content,com_time,response from complaint where id_com='".$id."'";
              $res=mysql_query($query1,$con);
              echo "<table class='table table-hover table-bordered'>";
              while($row =mysql_fetch_assoc($res))
              {
                  $query1="select distinct(name),admissionno,classid from stud_details s,current_class c where s.admissionno='{$row['stud_id']}' and s.admissionno=c.studid";
                  $res1=mysql_query($query1,$con);
                  if($row1 =mysql_fetch_assoc($res1))
                  {
                      $stud=$row1['admissionno'];
                      echo "<tr>";
                      echo "<td> Name </td>";
                      $name=$row1['name'];
                      echo "<td>".$row1['name']."</td></tr>";
                      echo "<tr><td>Admision number </td> <td>".$row1['admissionno']."</td></tr>";
                      $query2="select * from class_details where classid='".$row1['classid']."'";
                      $res2=mysql_query($query2,$con);
                      while($row2 =mysql_fetch_assoc($res2))
                      {
                          echo "<tr><td>Course </td><td>".$row2['courseid']."</td></tr>";
                          echo "<tr><td>Semester</td> <td>".$row2['semid']."</td></tr>";
                          echo "<tr><td>Branch/specialisation </td><td>".$row2['branch_or_specialisation']."</td></tr>";
                          echo "<tr><td>Department </td> <td>".$row2['deptname']."</td></tr>";
                      }
                  
                  }
                  echo "<tr><td>Subject of grievance</td><td>".$row['subject']."</td></tr>";
                  $sub=$row['subject'];
                  $com=new DateTime($row['com_time']);
                  echo "<tr><td>Grievance</td><td>".$row['content']."</td></tr>";
                  echo "<tr><td>Complaint time</td><td>".$com->format('d-m-Y')."</td></tr>";
              }
      ?>
      </table>
           <div>
          <?php
       $result= mysql_query("select sysdate() as day from dual",$con); // find current date 
      while ($row=mysql_fetch_assoc($result)){
        $date=$row['day'];
      }
  $id=$_GET['id'];
  //echo $id;
?>
<div>
<form method="post" enctype="multipart/form-data">
<table>
<tr>
<td>
<label>Reply </label>
</td>
<td>
<textarea name="Response" cols="40"  rows="6"></textarea>
</td>
<td>
<input type="Submit" value="Send"  onClick="return(validate());" class="btn btn-primary" name="Send"/>
</td>
</tr>
</table>
</form>
</div>
<?php
if(isset($_POST["Send"]))
{   //echo $date;
    $sql="update complaint set response='".$_POST['Response']."', res_time='".$date."',status=1 where id_com='".$id."'";
    $query=mysql_query($sql,$con);
    require_once("classes/class.phpmailer.php");
    // include the class name
    $mail="select guard_email,guard_contactno from parent where parentid=(select parentid from parent_student where admissionno='".$stud."')";
	var_dump($mail);
    $res3= mysql_query($mail,$con); // find mailid
	if ($rows=mysql_fetch_assoc($res3))
    {
        $mail_to=$rows['guard_email'];
		$phno=$rows['guard_contactno'];
    }
   
    if($mail_to)
    {
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
		$mail->Subject =" Replay for grievance";
		$mail->Body = "<h1>Grivances/Replay</h1>Dear Sir/Madam, <br>We have noticed your registered grievance on '".$sub."' of ".$name." <br>Replay is generated.<br><br>Login for more details........<br><br> Thanking You...";
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
    }
    else
    {
	include("../../../projects/msgclass.php");
	//path should be corrected; msgclass.php file outside your RITsoftv2 , under projects directory
	$s=sendmsg($phno,"Replied for your complaint.Please Login.... ");
	echo $s;
    }
    echo "<script>window.location.href='response.php'</script>";
}
?>
</center>

                     </div>
                
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