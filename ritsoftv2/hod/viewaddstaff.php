<?php
	include("includes/header.php");
	include("includes/sidenav.php");
?>

<div id="page-wrapper">   
	            <div class="row"><div class="col-lg-12" >
                    <h1 class="page-header"> Faculty Details</h1>
             </div>

<table border="1" align="center" 
           style="background-color: #FFFFFF; width: 955px;" cellpadding="5">
            
            <tr style="font-family: 'Times New Roman', Times, serif; 
                font-size: 18px; font-weight: bold; color: #FFFFFF; 
                background-color: #000000">                                          
<div class="row">
                <div class="col-lg-12">
			
	<div class=".col-sm-6 .col-md-5 .col-md-offset-2 .col-lg-6 .col-lg-offset-0">
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <th>Faculty ID</th>
	 <th>Faculty Name</th>
    <th>Department</th>
	<th>E-Mail ID</th>
	<th>Contact Number</th>
	<th>Photo</th>
	<th>Edit</th>
	<th>Delete</th>
	</tr>


<?php
 $sql ="select * from faculty_details where fid not like 'DUMMY%' and deptname in(select deptname from department where hod='$hodid');";
      $result = mysql_query($sql,$con)
      ?>
      
     
	<?php		
          if (mysql_num_rows($result) > 0) {	
             // output data of each row
         while($row = mysql_fetch_assoc($result)) {
			 $staffid=$row['fid'];
?>
			 
			<tr>
				<td><?php echo strtoupper($row['fid']);?></td>
				<td><?php echo strtoupper($row['name']);?></td>
				<td><?php echo strtoupper($row['deptname']);?></td><?php
			
			echo "<td>";
			echo $row['email'];echo "</td>";
			
			echo "<td>";
			echo $row['phoneno'];echo "</td>";
			
			echo "<td>";
			echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" width="100" height="100" onerror="this.onerror=null;this.src=\'../vendor/images/default.png\';" />';
			echo "<td>";			
?>
			<a href="editstaff.php?staffid=<?php echo $staffid;?>" >EDIT </a></td>			
			<td><a href="deletestaff.php?staffid=<?php echo $staffid;?>" onclick="return confirm('Are you sure to delete?');">DELETE</a></td>
			</tr>
<?php
		}
	 }
	 else	{		
		echo '<td>No RECORDS FOUND</tr>';				
	 }
?>

</table>
</form>

<?php 
	include("includes/footer.php");
?>
