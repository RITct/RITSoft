<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection1.php");
?>
<script  src="jquery.js"></script>

<script type="text/javascript">
  function fetchsubject(a)
  { 
    console.log(a);
    $.post("getsub.php",{ key : a},
      function(data){
        $('#data').html(data);
      }); 
  }
</script>

<script>
  function validate()
  {
   var s1 = document.getElementById('classid').value;
   var s2 = document.getElementById('subjectid').value;
   if(s1=="--select--"){
    alert("Please select Semester");
    return false;
  }
  if(s2=="--select--"){
    alert("Please select Subject");
    return false;
  }

  return true;
} 
</script>
<?php
$staffid=$_GET['staffid'];
$_SESSION['fidd']=$staffid;

$classid=$_GET["classid"];
$subjectid=$_GET["subid"];
$type=$_GET["type"];
?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header" align="center"><span>Subject Allocation</span></h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">

      <form id="suballoc" action = "suballoceditback.php" method = "POST" enctype = "">
<input type="hidden" name="oldfid" value="<?php echo $staffid; ?>">
        <table  id="outer1" align="center" style="padding-top:40px">
          <br><br>
          <tr>
            <td>
              <label>Semester:<span class="required">*</span></label>
            </td>
            <input type="hidden" name="classid" value="<?php echo $classid; ?>">
            <td><select onchange="fetchsubject(this.value)" disabled="disabled" name="classid" class="form-control">
              <option value="--select--">--select--</option>
              <?php

              $sql="select * from class_details where deptname in(select deptname from faculty_details where fid='$hodid' and active like '%YES%')";
              $r=mysql_query($sql,$con);
              while($result=mysql_fetch_array($r))   
              {
                if($result["classid"] ==$classid)
                {
                  $z='selected="selected"';
                }
                else
                  $z="";
                echo "<option value='" . $result["classid"] ."'".$z.">".$result["courseid"]."-".$result["semid"]."-".$result["branch_or_specialisation"]."</option>";
              }
              ?> 
            </select></td>
          </tr>

          <tr>
            <td>
             <label>Subject :<span class="required">*</span></label>
           </td>
           <td>
            <input type="hidden" name="subjectid" value="<?php echo $subjectid ?>">
            <div id ="data">
              <select name="subjectid" disabled="disabled" id="subjectid" class="form-control">
               <option value="--select--">--select--</option>
               <?php

               $sql1="select subject_title,subjectid from subject_class where classid='$classid'";;
               $re=mysql_query($sql1,$con);
               while($result1=mysql_fetch_array($re))   
               {
                if($result1["subjectid"] ==$subjectid)
                {
                  $z='selected="selected"';
                }
                else
                  $z="";
                echo "<option value='".$result1["subjectid"]."'".$z.">".$result1["subject_title"]."</option>";
              }
              ?> 
            </select>
          </div>
        </td>
      </tr>

      <tr>
       <td>
        <label>Faculty Name:<span class="required">*</span></label>
      </td>  
      <td>
       <div id ="data2">
        <?php
        $sql="select * from faculty_details where fid='$staffid'";   $r=mysql_query($sql,$con);
        $re=mysql_fetch_assoc($r);
        $n=$re["name"]; 
        ?>
        <input list="name" value="<?php echo $n ?>" autocomplete="off" name="name" class="form-control" type="text" onChange="fillname(this.value)"/>    
        <datalist id="name">
         <option value="--select--">--select--</option>
         <?php

         $l=mysql_query("select deptname from department where hod='$hodid'",$con) or die(mysql_error());
         $r=mysql_fetch_assoc($l);
         $dept=$r["deptname"];
         $sql="select * from faculty_details where name like '$name%' ";   $r=mysql_query($sql,$con);
         while($result=mysql_fetch_array($r)){ 
        
          echo "<option value='" . $result["name"] ."'>".$result["name"]."-".$result["deptname"]."-".$result["phoneno"]."</option>";
        }
        ?>  
      </datalist></div></td> 
    </tr>

    <tr>
      <td>

        <label>Faculty ID:<span class="required"></span></label>
      </td>

      <td>
        <div id ="data1">

         
          <input list="fid" value="<?php echo $staffid ?>" disabled="disabled" autocomplete="off" class="form-control" name="fid" type="text" />
          <datalist id="fid">
            <option value="--select--">--select--</option>
            <?php
            $sql="select * from faculty_details where deptname='$dept'";
            $r=mysql_query($sql,$con);
            while($result=mysql_fetch_array($r)){
              echo '<option value="'.$result['fid'].'">'.$result['fid'].'</option>';
              echo  '<input  name="fid" type="hidden" value="'.$result['fid'].'"/>';
            }


            ?>
             <input type="hidden" name="fid" value="<?php echo $staffid ?>">  
          </datalist></div></td>
        </tr>
        <tr>
          <td>
            <label>Type:*</label>
          </td>
            <td>
<?php
if ($type=="main") {
  $v1='checked="checked"';
  $v2="";
}
else
{
$v2='checked="checked"';
$v1="";
}
?>
    <label class="radio-inline">
    <input type="radio" value="main" <?php echo $v1; ?> required="required"  name="type">Main
    </label>
    <label class="radio-inline">
    <input type="radio" name="type" <?php echo $v2; ?> required="required" value="sub">Sub
    </label>
  </td>

        </tr>
        <tr>
          <td></td>
          <td><input style="width:100px" id="submit" class="btn btn-primary" type="submit" value="submit" name="submit"/></td>           
        </tr>

      </table>
    </form>

  </div>
</div>
</div>


<script src="jquery.js"></script>
<script type="text/javascript">
  function fillname(x)
  {
    $.post("load.php", { key:x },
      function(data) {
        $('#data1').html(data);
      });
  }

</script>




<?php 
include("includes/footer.php");
?>