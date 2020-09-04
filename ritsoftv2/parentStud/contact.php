<?php
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"]; //parent id from session
?>
  
        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>CONTACT INFORMATION
                      
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
 
            <!-- /.row -->
                    
            <h2>HOD</h2>
            <div>
	<table>
		<tbody>
		<?php
		if(isset($_POST["submit"]))
		{
		    $_SESSION['admissionno']=$_POST['studid'];
		}
		$query="SELECT * FROM faculty_details WHERE fid = (SELECT hod FROM department WHERE deptname = (SELECT deptname FROM class_details WHERE classid = (SELECT classid FROM current_class WHERE studid =  '{$_SESSION['admissionno']}' ) ) )";
			$res=mysqli_query($conn,$query);
			while($row =mysqli_fetch_assoc($res))
			{
					echo
					"<tr><td>Name</td><td>:</td><td>{$row['name']}</td></tr></br>
					<tr><td>Phone</td><td>:</td><td>{$row['phoneno']}</td></tr></br>
					<tr><td>Email</td><td>:</td><td>{$row['email']}</td></tr>";
			}
		?>
		</tbody>
	</table>
	</div>
	<div>
	<h2>STAFF ADVISOR</h2>
	<table>
		<tbody>
		<?php
		$query="select * from faculty_details where fid=(select fid from staff_advisor where classid=(SELECT classid FROM current_class WHERE studid =  '{$_SESSION['admissionno']}' ) )";
			$res=mysqli_query($conn,$query);
			while($row =mysqli_fetch_assoc($res))
			{
					echo
					"<tr><td>Name</td><td>:</td><td>{$row['name']}</td></tr></br>
					<tr><td>Phone</td><td>:</td><td>{$row['phoneno']}</td></tr></br>
					<tr><td>Email</td><td>:</td><td>{$row['email']}</td></tr>";
			}
		?>
		</tbody>
	</table>
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