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




<?php

if (isset($_POST["key"])) {

  if($_POST["key"] != "")
  {

    $branch=$_POST["key"];
    $l=mysql_query("select classid from class_details where active='YES' and CONCAT(courseid,'-',branch_or_specialisation)='$branch' order by semid") or die(mysql_error());
    if(mysql_num_rows($l)>0)
    {
      ?>













      <div class="panel panel-default">
        <div class="panel-heading">
          Class Details
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  
                  <th>Current Semester</th>
                  <th>Next Semester</th>
                  <th>Start</th>
                  <th>Complete</th>

                  <th>Summary</th>
                  
                </tr>
              </thead>
              <tbody>
              </tbody>

              <?php 
              while ($r=mysql_fetch_assoc($l)) {
                
                $classid=$r["classid"];
                $z=mysql_query("select curr_sem,next_sem,status from semregstatus where curr_sem='$classid'") or die(mysql_error());
                while($x=mysql_fetch_assoc($z))
                {
                  if ($x["status"]==1)
                  {

                   $a='disabled="disabled"';
                   $m='';
                 }
                 else
                 {
                   $a=''; 
                   $m='disabled="disabled"';
                 }

                 ?>
                 <tr>
                  <td><?php
                  $curr_sem=$x["curr_sem"];
                  $d=mysql_query("select semid from class_details where classid='$curr_sem'")or die(mysql_error());
                  $b=mysql_fetch_assoc($d);
                  echo $b["semid"]; 

                  ?></td>

                  <td>
                    
                    <?php
                    $next_sem=$x["next_sem"];
                    if ($next_sem=="NIL") {
                      echo "NIL";
                    }
                    else
                    {
                      $d=mysql_query("select semid from class_details where classid='$next_sem'")or die(mysql_error());
                      $b=mysql_fetch_assoc($d);
                      echo $b["semid"]; 
                    }
                    ?>

                  </td>

                  <td>
                    <?php
                    if ($next_sem!="NIL") {
                      ?>
                      <input type="submit" onclick="updatestart('<?php echo $curr_sem; ?>')" class="btn btn-primary btn-block" <?php echo $a ?>  value="Start" id="start<?php echo $curr_sem ?>" >
                      <?php
                    }
                    ?>
                  </td>
                  <td>
                   <?php
                   if ($next_sem!="NIL") {
                     ?>
                     <input type="submit" onclick="updatecomplete('<?php echo $curr_sem; ?>','<?php echo $next_sem; ?>')" <?php echo $m ?> class="btn btn-success btn-block" value="Complete" id="complete<?php echo $curr_sem ?>">
                     <?php
                     if($x["status"]==1)
                     {
                      echo "On Going";
                      $k=mysql_query("select count(studid) as c from current_class where classid='$curr_sem' and studid not in(select adm_no from stud_sem_registration where classid='$curr_sem')") or die(mysql_error());
                      $q=mysql_fetch_assoc($k);

                      $c_count=$q["c"];
                      $k=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$curr_sem'") or die(mysql_error());
                      $q=mysql_fetch_assoc($k);
                      $n_count=$q["c"];

                      $c_count+= $n_count;

                     // $c_count+= $n_count;
                      
                      echo "<br>No.of Students Registered : ".$n_count;
                      echo "<br>No.of Students not Registered : ".($c_count-$n_count);
                      echo "<br>Total Students : ".$c_count;
                    }
                  }
                  else
                  {
                   ?>
                   <input type="submit" onclick="setlast('<?php echo $curr_sem  ?>')" class="btn btn-danger btn-block" value="Finish" name="">

                   <?php
                 }
                 
                 ?>
               </td>
               <td>
                 <?php
                 if ($next_sem!="NIL") {
                   ?>
                   <a href="" onclick="getsum('<?php echo $curr_sem; ?>')" data-toggle="modal" data-target="#myModal">Summary</a>
                   <?php
                 }
                 ?>
               </td>
                                            <!-- 
                                            <td>

<label class="switch">
  <input type="checkbox" <?php echo $a; ?> onclick="update(this.value)"  value="<?php echo $r['classid'] ?>" name="<?php echo $r['classid'] ?>" id="<?php echo $r['classid'] ?>">
  <span class="slider round"></span>
</label>
</td> -->
</tr>
<?php
} 
}
?>
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

<script src="jquery.js"></script>



<script type="text/javascript">




  function getsum(a)
  {
    $.post("semsumreg.php",{ key : a},
      function(data){
        $('#datasum').html(data);
      });
  }



  function setlast(a)
  {
   if(confirm("Proceed only if the semester is completed.\nDo you want proceed?"))
   {
    var b=document.getElementById("branch").value;
    console.log(branch);
    $.post("updatelast.php",
    {
      classid: a,
      branch: b
    },
    function(data, textStatus)
    {
      alert(data);
      
      var b=document.getElementById("branch").value;
      getclass(b);
    });
  }
}


function updatestart(a)
{
  if(confirm("Do you want to start semester registartion?"))
  {
    console.log(a);
    var s;
    s=1;
    var ct=document.getElementById('start'+a);
    var st=document.getElementById('complete'+a);
    
    $.post("updatestatus.php",
    {
      classid: a,
      status: s
    },
    function(data, textStatus)
    {
      alert(data);
      st.disabled=false;
      ct.disabled=true;
      var branch=document.getElementById("branch").value;
      getclass(branch);
    });
  } 
}
function updatecomplete(a,b)
{
  if(confirm("Do you want to complete semester registartion?"))
  {
    console.log(a);
    var s;
    s=0;
    var ct=document.getElementById('complete'+a);
    var st=document.getElementById('start'+a);
    
    $.post("updatecomplete.php",
    {
      curr_sem: a,
      next_sem: b,
      status: s
    },
    function(data, textStatus)
    {
      alert(data);
      st.disabled=false;
      ct.disabled=true;
      var branch=document.getElementById("branch").value;
      getclass(branch);

    });
  } 
}
</script>




<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Semester Registration</h4>
      </div>
      <div class="modal-body">

       <div id="datasum">
        
       </div>
     </div>

     <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
  
</div>
</div>
