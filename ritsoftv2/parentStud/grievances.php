<?php
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"]; //parent id from session
?>
<head>
 <script type="text/javascript">
function validate()
{

if( document.complaint.to.value == "---select---" )
 { 
  alert( "Select To address" );
  document.complaint.to.focus() ; 
  return false; 
  }

if( document.complaint.type.value == "---select---" )
{ 
 alert( "Select complaint type" );
 document.complaint.type.focus() ; 
 return false; 
 }
if( document.complaint.Subject.value == "" )
{ 
 alert( "Enter the Subject" );
 document.complaint.Subject.focus() ; 
 return false; 
 }
if( document.complaint.Message.value == "" )
{ 
 alert( "Enter your Message" );
 document.complaint.Message.focus() ; 
 return false; 
 }
	 return( true );
  }
</script>
</head>
<body>        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>GRIEVANCES
                         
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  					
            <!-- /.row -->
           	<div>
            
            <div class="table-responsive">
            <?php
            $query="select id_com,subject,content,com_time,response,res_time,designation from complaint where stud_id='{$_SESSION['admissionno']}' order by com_time desc";
            $res=mysqli_query($conn,$query);
            echo "<table class='table table-hover table-bordered'>
                <tr>
					<th>TO</th>
					<th> SUBJECT  </th>
                    <th> MESSAGE </th>
                    <th>MESSAGE TIME</th>
					<th>RESPONSE</th>
					<th>RESPONSE TIME</th>
                 </tr>";
            $i=0;
            while($row =mysqli_fetch_assoc($res))
            {
                $i++;
                echo "<tr>";
				echo "<td>".$row['designation']."</td>";
                echo "<td>".$row['subject']."</td>";
                echo "<td>".nl2br($row['content'])."</td>";
                $com=new DateTime($row['com_time']);
                echo "<td>".$com->format('d-m-Y')."</td>";
                echo "<td>".nl2br($row['response'])."</td>";
                if ($row['res_time']) {
                    $re=new DateTime($row['res_time']);
                    echo "<td>".$re->format('d-m-Y')."</td></tr>";
                }
                else {
                    echo "<td>  </td></tr>";;
                }
            }
            if($i==0)
            {
                echo '<tr><td colspan="5"><center><b>NO complaints yet.......!</b></center></td></tr> ';
            }
            ?>

       </tbody>
     </table>
     </div>
     <h2><center>New complaint</center></h2>
     <form action="complaint.php" name="complaint" method="post">
            <label>Complaint To</label>
            <select name="to" class="form-control">
            <option value="---select---">---select---</option>
            <option value="Principal">Principal</option>
            <option value="PG">PG Dean</option>
            <option value="UG">UG Dean</option>
            <option value="HOD">HOD</option>
            <option value="StaffAdvisor">Staff Advisor</option>
            </select>
            <label>Complaint Type</label>
            <select name="type" class="form-control">
            <option value="---select---">---select---</option>
            <option value="Subject">Subject</option>
            <option value="Class">Class</option>
            <option value="Teachers">Teachers</option>
            <option value="MonthlyAttendance">Monthly attendance</option>
            <option value="HourlyAttendance">Hourly attendance</option>
            <option value="Session">Sessional marks</option>
            <option value="Subject Mark">subject mark</option>
            <option value="others">Others</option>
            </select>
            <label>Subject</label>
            <td><input type="text" class="form-control" value="" name="Subject" maxlength="50"></td>
            <label>Message</label>
            <textarea name="Message" value=""  class="form-control" cols="40"  maxlength="300"rows="6"></textarea><br>
            <input type="Submit" value="Submit" class="btn btn-primary" onClick="return(validate());" name="Send"/>
            </form>
                
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
</body>