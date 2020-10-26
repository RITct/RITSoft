<?php
	//This is used for header and side navigation links.
include("includes/header.php");

include("includes/sidenav.php");
include "../connection.php";

?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    
                      <h3 style="color:red;" class="page-header"> Different Scholarship Schemes...</h3>
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
    
	   <form id="form1" name="form1" method="post" action="" enctype="" class="sear_frm">
             
                <?php
                
        echo "<br><br><br><div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th>SL.NO:</th>
			<th>Scholarship Name</th>
		        <th>Edit Details</th> 
			<th>Delete</th>
			
    </tr>"; 
	
	/*Fetching Datas and showing in the corresponding feilds in a table format.........*/
	$i=1;        
                     
  $sql=mysql_query("SELECT * from scholarship_type");
    while($r=mysql_fetch_assoc($sql)){
        $sname=$r['schol_name'];
        $sid=$r['id'];
      
            
                                echo "<tr align='centre'>";
				echo "<td align='centre'>" . $i . "</td>";
				echo "<td align='centre'>" . $r['schol_name'] . "</td>";	
				
?>
<td><a href="edit_scholar_type.php?sid=<?php echo $sid;?>" >EDIT</a></td>

<td><a href="delete_scholar_type.php?sid=<?php echo $sid;?>" >DELETE</a></td>
	<?php			
				
				echo "</tr>";
				$i++;
            }
			echo "</table>"; 
			echo "</div>"; 
			
?>			
</form>
</div>
<?php
	// Link for footer.php
include("includes/footer.php");
?>
