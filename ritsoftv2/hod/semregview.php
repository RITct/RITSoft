  <?php
include("includes/header.php");
include("includes/sidenav.php");
?>

<script  src="jquery.js"></script>
<script type="text/javascript">
  function getsemdata(a)  {  
  	$('#loadingmessage').show();
  	$('#data').hide();
    console.log(a);
    $.post("fetchsum.php",{ key : a},
      function(data)  {
      	$('#data').show();
        $('#data').html(data);
        $('#loadingmessage').hide();
      });
  }
</script>
 <div id="page-wrapper" style="height: auto;" >
 	
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">SEMESTER VERIFICATION SUMMARY
			</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
         
    <?php
    $s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
    $r = mysql_fetch_assoc($s);
    $deptname=$r["deptname"];

    $sql ="select * from class_details  where deptname='$deptname' and active like '%YES'";
    $result = mysql_query($sql);
    ?>

    <select name='clsid' id="clsid" class="form-control" onchange="getsemdata(this.value)">
      <option value =''>--select--</option>
      <?php
      while ($row = mysql_fetch_array($result)) {
         // if($row["classid"]==$clsid)
              //echo '<option value="' . $row["classid"] .'" selected="selected">' . $row["classid"] .'</option>';
         // else
            //  echo '<option value="' . $row["classid"] .'">' . $row["classid"] .'</option>';
       
       echo "<option value='" . $row["classid"] ."''>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";   

     }
     
     ?>        
			
	</select>	

		<br>
		<div id='loadingmessage' style='display:none'>
  <img src='includes/loading.gif' style="display: block; margin-left: auto;
    margin-right: auto;
    width: 30%;" height="50%" width="50%" />
</div>
<div id="data" style="display: none;">
	


</div>




</div>






















	<?php

include("includes/footer.php");
?>
