<?php
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"]; //parent id from session
?>
  
        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>SESSIONAL MARKS
                         
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
           
			</div>
            <!-- /.row -->
            
		<div class="table-responsive">
            <?php
            $query="select distinct(subjectid),subject_title,sessional_marks from sessional_marks natural join subject_class where  studid='{$_SESSION['admissionno']}' and status='Verified by H.O.D'";
            
            $res=mysqli_query($conn,$query);
            echo "<table class='table table-hover table-bordered'>
                <tr>
					<th> SUBJECT CODE: </th>
                    <th> SUBJECT NAME: </th>
                    <th>SESSIONAL MARKS:</th>
                 </tr>";
            $i=0;
            while($row =mysqli_fetch_assoc($res))
            {
                $i++;
                echo "<tr>";
                echo "<td>".$row['subjectid']."</td>";
                echo "<td>".$row['subject_title']."</td>";
                echo "<td>".$row['sessional_marks']."</td>";
                
                
            }
            if($i==0)
            {
                echo '<tr><td colspan="3"><center><b>No records found.......!</b></center></td></tr> ';
            }
            ?>
     </table>
     </div>
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