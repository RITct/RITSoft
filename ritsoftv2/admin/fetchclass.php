<?php
include("includes/connection.php");

  ?>
 <style>
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 25px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: -6px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 30px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<script type="text/javascript">
	function update(a)
	{
		var s;
		var chk=document.getElementById(a);
		if(chk.checked)
			s='YES';
		else
			s='NO';
		console.log(chk.value);

		$.post("updatestatus.php",
	{
		classid: a,
		status: s
	},
	function(data, textStatus)
	{
		alert(data);
	}); 
	}
</script>




<?php

if (isset($_POST["key"])) {
	if ($_POST["key"] != "") {
		$branch=$_POST["key"];
		
		$l=mysql_query("select classid,semid from class_details where concat(courseid,'-',branch_or_specialisation)='$branch' order by semid ") or die(mysql_error());
		if(mysql_num_rows($l))
		{
			?>










 <div class="panel panel-default">
                        <div class="panel-heading">
                            &nbsp;
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th>Semester</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      </tbody>

                                      <?php 
                                      while ($r=mysql_fetch_assoc($l)) {
                                      
                                      $classid=$r["classid"];
                                      $z=mysql_query("select active from class_details where classid='$classid'") or die(mysql_error());
                                      $x=mysql_fetch_assoc($z);
                                      if ($x["active"]=="YES") {
                                      	$a='checked="checked"';
                                      }
                                      else
                                      	$a=''; 

                                      ?>
                                        <tr>
                                            <td><?php echo $r["semid"]; ?></td>
                                            <td>

<label class="switch">
  <input type="checkbox" <?php echo $a; ?> onclick="update(this.value)"  value="<?php echo $r['classid'] ?>" name="<?php echo $r['classid'] ?>" id="<?php echo $r['classid'] ?>">
  <span class="slider round"></span>
</label>
                                            </td>
                                        </tr>
                                     <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->




			<?php
		}
	}
}

?>








