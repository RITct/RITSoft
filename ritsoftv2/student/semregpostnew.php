<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");

//if(isset($_POST["Next_btn"])!=null)
//{
   // $admissionno1=$_SESSION["admissionno"];

    //$class_id=$_SESSION["index"];
    //echo $class_id;
//}
//$x=str_split($class_id);
//$y="P";
//if($x[0]==$y)
//{
//$result=mysql_query("select cur_sem from pg where admno='$admission_no'");
//}
$sem = 0;

$l=mysql_query("select classid from current_class_semreg where studid='$admissionno'") or die(mysql_error());
if(mysql_num_rows($l)==0)
{
  $r=mysql_fetch_assoc($l);
  $classid=$r["classid"];
    
  $l=mysql_query("select semid,courseid,branch_or_specialisation from class_details where classid='$classid'") or die(mysql_error());
  $r=mysql_fetch_assoc($l);
  $semid=$r["semid"];
  $courseid=$r["courseid"];
  $branch=$r["branch_or_specialisation"];
  
  $newsemid=$semid+1;

  $l=mysql_query("select * from semregstatus where status=1 and curr_sem='$classid'") or die(mysql_error());

  if (mysql_num_rows($l)==0) {
   echo "<script>alert('semester registration unavailable')</script>"; 
   echo "<script>window.location.href='dash_home.php'</script>"; 
 }
}

$l11=mysql_query("select * from stud_sem_registration where adm_no='$admissionno' and apv_status='Approved by office'") or die(mysql_error());
if(mysql_num_rows($l11) > 0){
  //echo "<script>window.location.href='semregviewnew.php'</script>";
  echo "<script>alert('semester registration unavailable')</script>"; 
   echo "<script>window.location.href='dash_home.php'</script>"; 
}

$l1=mysql_query("select * from stud_sem_registration where adm_no='$admissionno'") or die(mysql_error());
if(mysql_num_rows($l1) > 0)
  echo "<script>window.location.href='semregviewnew.php'</script>";






$result=mysql_query("select semid from class_details where classid =(select classid from current_class_semreg where studid = '$admissionno' )");
while($dat1=mysql_fetch_array($result))
{
  $sem=$dat1["semid"];
   // $scourse=$dat["courseid"];

}
$re=mysql_query("select * from current_class_semreg where studid = '$admissionno' ");
while($dat2=mysql_fetch_array($re))
{
  $classid=$dat2["classid"];
   // $scourse=$dat["courseid"];

}

//while($data=mysql_fetch_array($result))
//{   
//$cur_sem=$data["cur_sem"];
?>


<div id="page-wrapper">
 <div class="col-lg-12">
  <h1 class="page-header"><b>SEMESTER REGISTRATION</b></h1>
</div>
<form id="form1" name="form1" method="post" action="form_fillingnew.php" enctype="multipart/form-data" class="sear_frm" >

 <div class="form-row">
  <div class="form-group col-md-6">
    <label for="religion">Admission no</label>
    <input type="text" class="form-control" disabled="disabled" id="admission_no" name="admission_no"  value="<?php echo $admissionno; ?>">
    <input type="hidden" class="form-control" id="admission_no" name="admission_no"  value="<?php echo $admissionno; ?>">
    <input type="hidden" class="form-control" id="class_id" name="class_id"  value="<?php echo $classid; ?>">
  </div>
  
</div>


<div class="form-row">
 <div class="form-group col-md-6">
  <label for="caste">Previous semester</label>
  <input class="form-control" disabled="disabled" type="text" name="pre_sem" value="<?php echo $sem; ?>">
  <input class="form-control" type="hidden" name="pre_sem" value="<?php echo $sem; ?>">
</div>

<div class="form-group col-md-6">
 <label for="caste">New semester</label>
 <input class="form-control" disabled="disabled" type="text" name="new_sem" value="<?php echo $sem+1; ?>">
 <input class="form-control" type="hidden" name="new_sem" value="<?php echo $sem+1; ?>">
</div>
</div>


<div class="form-row">
 <div class="form-group col-md-6">
  <label for="caste">Application Date</label>
  <input class="form-control" type="text" name="admission_no" value="<?php echo date("Y-m-d"); ?>" disabled="disabled">
</div>
</div>

<div class="form-row">
  <br>
  <br>
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <button type="submit" value="" name="semreg_btn" id="semreg_btn" class="btn btn-primary btn-block">Submit</button>
  </div>
</div>         


</form> 
</div>
<?php

include("includes/footer.php");
?>
