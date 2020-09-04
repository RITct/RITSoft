<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = mysql_connect("localhost", "root", "", "rit");
include("includes/connection.php");


//..............................................................................
if(isset($_POST['add_no']))
{
    $add_no=$_POST['add_no'];
    
    $search_query=  explode("/", $add_no);
    
    //print_r($search_query);
    
    
    $sql = mysql_query("SELECT classid FROM class_details WHERE courseid='$search_query[0]' AND semid='$search_query[1]' AND deptname='$search_query[3]' AND branch_or_specialisation='$search_query[2]'");
  
	 while($row = mysql_fetch_array($sql)){
                $classid= $row['classid'];
	 }
				 
			// echo $classid;	
				
  	
				
}	
?>

<div class="table-responsive">
	<table width="50%"  class="table table-hover table-bordered">
   		<tr>
    		<th style="text-align: center;">ADMISSION NUMBER</th>
    		<th style="text-align: center;">NAME</th>
   			<?php
				
					$re=mysql_query("select subjectid from subject_class where classid='$classid'");
       				 while($d=mysql_fetch_array($re)){
							$subjectid=$d["subjectid"];
    		?>
    		<th align="center">
   				<?php echo $subjectid; ?>
    		</th>
			<?php }?>
            
		</tr>
		<?php $st=1;
			
				$resul=mysql_query("select distinct(studid)from sessional_marks where classid='$classid' order by(studid)");
           		while($dat=mysql_fetch_array($resul))
            	{
            		$studid=$dat["studid"];
					$re=mysql_query("select name from stud_details where admissionno='$studid'");
               		while($d=mysql_fetch_array($re))
                	{
                    	$name=$d["name"];
                	}
		?>
		<tr>
			<td align="center"><?php echo $studid;?></td>
            <td align="center"><?php echo $name;?></td>
                <?php
                	$re=mysql_query("select subjectid from subject_class where classid='$classid'");
                	while($d=mysql_fetch_array($re))
                	{
                    	$subjectid=$d["subjectid"];
                    	$sessional_marks='--';
          				$result=mysql_query("select * from sessional_marks where classid='$classid' and studid='$studid' and subjectid='$subjectid' order by(subjectid)");
                		while($data=mysql_fetch_array($result))
                		{	
                    		$classid=$data["classid"];
                    //$studid=$data["studid"];
                    		$subid=$data["subjectid"];
                    		$data["sessional_marks"];
                    		$sessional_marks=$data["sessional_marks"];
            				//$status=$data["status"];
                 		}
							?>
					<td align="center"><?php /*echo $subjectid; echo " : ";*/ echo $sessional_marks;?></td>
                	<?php
            			}
                		
					?>
                    
                	<?php
                		
                	?>
                    
                	<?php
						//}
                	?>
       		 </tr><br>       
			<?php
    			}
    		?>
    </table> 
	</div>
