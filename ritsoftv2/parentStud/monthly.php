<?php
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"];//parent id from session
?>
  
        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>MONTHLY ATTENDANCE
                        

                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  			
	
            <!-- /.row -->
           
		<div>
			<form method="post" enctype="multipart/form-data">
			<div class="row">
			<div class="col-md-6">
        <label>FROM:</label>
				<input type="date" name="date1" placehodler="dd-mm-yyyy" class="form-control" value="<?php  echo date("d-m-Y"); ?>" />
		</div>
		<div class="col-md-6">
		<label>TO:</label>
                <input type="date" name="date2" placehodler="dd-mm-yyyy" class="form-control" value="<?php  echo date("d-m-Y"); ?>" /><br>
		</div>	
				<input style="width:200px" id="Submit" type="submit" value="View Attendence" onClick="return(validate());" class="btn btn-primary"  name="btnshow"/><br>
		</div>
		</form>
		</div><br>
		<div class="table-responsive">
            <?php
            
            if(isset($_POST["btnshow"]))
            {
                $date1=$_POST["date1"];
                $d1=date("Y-m-d",strtotime($date1));
                //echo $d1;
                $date2=$_POST["date2"];
                $d2=date("Y-m-d",strtotime($date2));
                //echo $d2;
                if ($date1 >= $date2)
                {
                    echo "Inavlid Entry";
                }
                else
                {
                    $query="SELECT sub1, pr, wo, subject_title FROM (SELECT subjectid AS sub1, subject_title, count( HOUR ) AS pr FROM attendance NATURAL JOIN subject_class WHERE STATUS = 'Y' AND studid = '{$_SESSION['admissionno']}' AND date BETWEEN '$d1' AND '$d2' GROUP BY subjectid)e, (SELECT subjectid AS sub2, count( HOUR ) AS wo FROM attendance WHERE studid = '{$_SESSION['admissionno']}' AND date BETWEEN '$d1' AND '$d2' GROUP BY subjectid)d WHERE sub1 = sub2";
        		
        			$res=mysqli_query($conn,$query);
        			 echo "<table class='table table-hover table-bordered'>
                        <tr>
        					<th> SUBJECT CODE </th>
                            <th> SUBJECT NAME</th>
                            <th>ATTENDANCE PERCENT</th>
                         </tr>";
                    $sum=0;
                    $i=0;
        			while($row =mysqli_fetch_assoc($res))
        			{
        						$i++;
        						echo "<tr>";
        						echo "<td>".$row['sub1']."</td>";
        						echo "<td>".$row['subject_title']."</td>";
        						$per=($row['pr']/$row['wo'])*100;
        						echo "<td>".$per."</td>";
        						$sum=$sum+$per;
        						echo "</tr>";
        			}
        			if($i==0)
        			{
        			    echo '<tr><td colspan="3"><center><b>No records found.......!</b></center></td></tr> ';
        			}
        			else
        			{
        			    $agr=$sum/$i;
        			    echo "<tr>
			<td>        </td>
			<td>TOTAL</td>
			<td>". $agr."</td>
		</tr>";
        			}
                }
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