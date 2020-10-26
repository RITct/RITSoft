<?php

/**
 * @Author: indran
 * @Date:   2018-07-02 21:14:47
 * @Last Modified by:   indran
 * @Last Modified time: 2018-07-02 22:58:04
 */



// This is used for header, sidenavigation, connection links 
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");

if(isset($_POST["classid"]))  
	$classid=$_POST["classid"]; 
else
	$classid="";  


$nomorris = true;
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
<script  src="jquery.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  function getsemdata(a)  {  
    console.log(a);
    $.post("fetchsemdatanew.php",{ key : a},
      function(data)  {
        $('#data').html(data);

        $('.DataTable').DataTable();
      });
  };

  function setid(a,b) {
    console.log(a); 
    document.getElementById('reg_id').value = a;
    document.getElementById('classid').value = b;

  };
</script>

<div id="page-wrapper">
  <div class="row">
   <br><br>
   <?php
// fetching data from class_details 
   $sql ="select * from class_details  where classid in (select curr_sem from semregstatus where current_class=1)";
   $result = mysql_query($sql);
   ?>
   <select name='clsid' id="clsid" class="form-control" onchange="getsemdata(this.value)">
    <!-- select option	-->
    <option value =''>--select--</option>
    <?php
    while ($row = mysql_fetch_array($result))   {
     if ($classid==$row["classid"]) 
      $se="selected";
    else
      $se="";
    echo "<option value='" . $row["classid"] ."'".$se.">".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";   
  }
  echo "";
  echo "";
  ?>     
</select>   
<script type="text/javascript">getsemdata('$classid');</script>

<div class="col-lg-12" >
  <h1 class="page-header" align="center">SEMESTER VERIFICATION</h1>

  <a  href="semregviewnew.php" target="_blank" style="float: right;">Summary</a>
</div>

</div>
<br>
<div class="table-responsive">
	<div id="data">
	</div>
</div>
</div>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
   <form method="post" action="semregeditnew.php">

     <div class="modal-content">
      <div class="modal-header">
       Remarks
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body">

      <div data-role="popup" id="myPopup" class="ui-content" style="min-width:300px;">
        <?php

        ?>

        <div>

          <input class="ui-accessible" type="hidden" name="reg_id" id="reg_id" >
          <input type="hidden" name="classid" id="classid">
          <label for="text" class="ui-hidden-accessible">Message:</label>
          <textarea type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter remarks here!"></textarea>

        </div>

      </div>


    </div>
    <div class="modal-footer">
      <input type="submit" data-inline="true" class="btn btn-primary" value="Send" name="btn_send" id="btn_send">
    </div>
  </div>
</form>
</div>
</div>

<!-- /.row -->

<!-- /#wrapper --> <!-- 
</select></div></div></body></html>   -->


<script type="text/javascript">
  $(document).ready(function($) {
    $(document).on('click', '.check-all', function(event) {
      event.preventDefault(); 
      if($(this).attr('now-check') == 'true'){
        $('#bulk-ok-form').find('input[type=checkbox]').prop('checked', false);
        $(this).attr('now-check','false' );
      } else {
        $('#bulk-ok-form').find('input[type=checkbox]').prop('checked', true);
        $(this).attr('now-check','true' );
      }

    });
  });
</script>

<?php
// Link for footer.php 
include("includes/footer.php");
?>
