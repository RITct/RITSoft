<?php
include("includes/header.php");

include("includes/sidenav.php");
$pid=$_SESSION["parentid"]; //parent id from session
?>
  
        
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>CONSOLIDATED ATTENDANCE
                                       </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    
             <!-- /.row -->
           		<div class="table-responsive">
            <?php
            $query="SELECT sub1, pr, wo,subject_title FROM (SELECT subjectid AS sub1,subject_title,count( HOUR ) AS pr FROM attendance natural join subject_class  WHERE STATUS = 'Y' AND studid = '{$_SESSION['admissionno']}' GROUP BY subjectid
)e, (SELECT subjectid AS sub2, count( HOUR ) AS wo FROM attendance WHERE studid = '{$_SESSION['admissionno']}' GROUP BY subjectid)d WHERE sub1 = sub2";
		
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