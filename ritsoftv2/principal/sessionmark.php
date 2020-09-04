<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
$admissionno=$_SESSION['adm'];

			$query="select distinct(name),admissionno,courseid from stud_details join current_class where admissionno='$admissionno'";	
		
			$res=mysql_query($query);
?>

			<div id="page-wrapper">
		
            <div class="table-responsive">
			<table   class="table table-hover table-bordered" >
                <tr>
					<th style="text-align: center;"> NAME</th>
                    <th style="text-align: center;"> ADMISSION NUMBER</th>
                    <th style="text-align: center;"> COURSE</th>
                </tr>
			
            <?php
			while($row =mysql_fetch_assoc($res))
				
			{
						echo "<tr>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['admissionno']."</td>";
						echo "<td>".$row['courseid']."</td>";
						
						
			}
		?>
		</table>
		</div>
			<?php
	        $query="select distinct(subjectid),subject_title,sessional_marks from sessional_marks natural join subject_class where  studid='$admissionno'";
		
			$res=mysql_query($query);
			?>
			
			
            <div class="table-responsive">
			<table   class="table table-hover table-bordered" >
                <tr>
		
					<th style="text-align: center;"> SUBJECT CODE</th>
                    <th style="text-align: center;"> SUBJECT NAME</th>
                    <th style="text-align: center;">SESSIONAL MARKS</th>
                 </tr>
		 
			<?php
			while($row =mysql_fetch_assoc($res))
			{
						
						echo "<tr>";
						echo "<td>".$row['subjectid']."</td>";
						echo "<td>".$row['subject_title']."</td>";
						echo "<td>".$row['sessional_marks']."</td>";
						
						
			}
		?>
       </tbody>
      
	  </table>
	 </div>
	   </div>
<?php

include("includes/footer.php");
?>