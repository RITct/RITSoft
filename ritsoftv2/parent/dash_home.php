<?php
include("../connection.mysqli.php");
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"]; //parent id from session

?>
      
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;">WELCOME
                        <?php
                        $query="select name_guard from parent where parentid=".$_SESSION["parentid"]." limit 1";
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res))
                        {                                                        
                            echo $row["name_guard"]; 
                        }
                        ?>
                        


                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  			<div>
  				<?php 
  				$query1="select admissionno,name,image from stud_details where admissionno in (select admissionno from parent_student where parentid='".$_SESSION["parentid"]."')";
                        $res1=mysqli_query($conn,$query1);
                        $i=0;
                        echo "<table class=''>
                               ";
                        while($row1 =mysqli_fetch_assoc($res1))
                        {   
                           $i++;
                            $_SESSION['admissionno']=$row1['admissionno']; 
                            echo ' <tr> <td><img src="data:image/jpeg;base64,'.base64_encode( $row1['image'] ).'" width="200" height="200" onerror="this.onerror=null;this.src=\'../vendor/images/default.png\';"/> </td></tr>';
                            echo '<tr><td><a href="../parentStud/dash_home.php?id='.$row1['admissionno'].'">'.$row1['name'].'</a></td></tr>';
                        }             
                        echo '</table>';
                        $_SESSION['count']=$i;
  				   ?> 
                 </form>      
						</tr>
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