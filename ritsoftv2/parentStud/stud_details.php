<?php
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"];//parent id from session
?>
  
        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>STUDENT DETAILS
                        

                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  			            <!-- /.row -->
            <?php
            $id=$_GET['id'];
            $query="select distinct(name),admissionno,classid from stud_details join current_class where admissionno='{$id}'";
			$res=mysqli_query($conn,$query);
			echo '<table cellpadding=1 cellspacing=1 font color="black">';
            
            while($row =mysqli_fetch_assoc($res))
			{
						echo "<tr>";
                        echo "<td> Name </td><td>: </td>";
                        echo "<td>".$row['name']."</td></tr>";
						echo "<tr><td>Admision number </td><td>: </td> <td>".$row['admissionno']."</td></tr>";
						$query2="select * from class_details where classid='".$row['classid']."'";
						$res1=mysqli_query($conn,$query2);
						while($row1 =mysqli_fetch_assoc($res1))
						{
						    echo "<tr><td>Course </td><td> : </td> <td>".$row1['courseid']."</td></tr>";
						    echo "<tr><td>Semester</td><td> : </td> <td>".$row1['semid']."</td></tr>";
						    echo "<tr><td>Branch/specialisation </td><td>: </td> <td>".$row1['branch_or_specialisation']."</td></tr>";
						    echo "<tr><td>Department </td><td>: </td> <td>".$row1['deptname']."</td></tr>";
						}
						
						
			}
		?>
		</table>
		
                
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