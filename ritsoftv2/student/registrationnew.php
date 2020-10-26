<?php 
if(session_id() == '') {
session_start();
  }?>
<html>
<head>
</head>
<body>

  <?php
  include("../connection.php");
  
  /* if(session_id() == '') {
    session_start();
  } */


  if ($_POST) {  
    $_SESSION['POST'] =  $_POST; 
    echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
    exit();
  }

  if (isset($_SESSION ['POST'])) {
    $_POST = $_SESSION['POST'];
    unset($_SESSION['POST']);
  }

  
  if(isset($_POST["semreg_btn"]) || isset($_POST["re_semreg_btn"]))  {

   $admission_no=$_POST["admission_no"];
   $class_id=$_POST["class_id"];
   // $application_date=$_POST["application_date"];
   $pre_sem=$_POST["last_class"];
   $new_sem=$_POST["promotion_class"];
   $apv_status= "Not Approved";
   $apl_status="Applied";
   // echo $admission_no;
 //   echo $application_date;
    //echo $new_sem;
   if(isset($_POST["semreg_btn"]) )  {
    $json = json_encode($_POST);

   // echo "<script>window.location.href='semregviewnew.php'</script>";
    mysql_query("insert into stud_sem_registration(adm_no,classid,apl_status,apl_date,apv_status,previous_sem,new_sem,form_data) values('".$admission_no."','".$class_id."','".$apl_status."','".date("Y-m-d")."','".$apv_status."','".$pre_sem."','".$new_sem."','".$json."')  ON DUPLICATE KEY UPDATE    
      adm_no='$admission_no', 
      classid = '$class_id',
      apl_status = '$apl_status',
      apl_date = '".date("Y-m-d")."',
      apv_status = '$apv_status',
      previous_sem = '$pre_sem',
      new_sem = '$new_sem', 
      form_data = '$json'  ")or die(mysql_error());

    echo "<script>alert('Registered Successfully')</script>";

  } else {


// here we want to check two cases 1. resubmit after reject by staff advisor 2. already submit--form filling reprint--here update only form_data
 //$admission_no=$_POST["admission_no"];
$l1=mysql_query("select * from stud_sem_registration where adm_no='$admission_no'") or die(mysql_error());

if(mysql_num_rows($l1) == 1)
{
    $row =mysql_fetch_assoc($l1);
    $apv_status1=$row['apv_status'];
    $apl_status1=$row['apl_status'];
    $form_data1=$row['form_data'];

     if($apv_status1=='Rejected by staff advisor' && $apl_status1=='Applied')
   {   

    $json = json_encode($_POST);
    
    mysql_query("update stud_sem_registration set adm_no='$admission_no', 
      classid = '$class_id',
      apl_status = '$apl_status',
      apl_date = '".date("Y-m-d")."',
      apv_status = '$apv_status',
      previous_sem = '$pre_sem',
      new_sem = '$new_sem', 
      form_data = '$json' where adm_no='$admission_no'") or die(mysql_error());
    echo "<script>alert('Re-submitted Successfully')</script>";
 
}

if($apl_status1=='Applied' && empty($form_data1) && $apv_status1!='Rejected by staff advisor'  )
   {   

    $json = json_encode($_POST);
    
    mysql_query("update stud_sem_registration set adm_no='$admission_no', 
      classid = '$class_id',
      apl_status = '$apl_status1',
      apv_status = '$apv_status1',
      previous_sem = '$pre_sem',
      new_sem = '$new_sem', 
      form_data = '$json' where adm_no='$admission_no'") or die(mysql_error());
    echo "<script>alert('Re-Printed and update data Successfully')</script>";
 
}

}


} 
 

include 'Mobile_Detect.php';
  $detect = new Mobile_Detect();


  ?> <?php if ($detect->isMobile()  ) :?>

  
  <script type="text/javascript">


    let xhr = new XMLHttpRequest(); 
    xhr.open('POST', 'sem_reg_from_mobilenew.php'); 
    xhr.responseType = 'blob';
    let formData = new FormData();



    <?php
    foreach ($_POST as $a => $b) {
      echo ' formData.append("'.htmlentities($a).'", "'.htmlentities($b).'"); ';
    } 
    ?>
    xhr.send(formData); 

    xhr.onload = function(e) {
     if (this.status == 200) { 
      console.log(this.response);
      var blob = new Blob([this.response], {type: 'image/pdf'}); 
      let a = document.createElement("a");
      a.style = "display: none";
      document.body.appendChild(a); 
      let url = window.URL.createObjectURL(blob);
      a.href = url;
      a.download = 'Semester Registration.pdf'; 
      a.click(); 
      window.URL.revokeObjectURL(url);
      setTimeout(function(){
        window.location.href = 'semregviewnew.php';
      },100);
    }else{ 
    }
  };
</script>


<?php else: ?> 

  <form id="myForm" action="sem_reg_fromnew.php"    method="post">
    <?php
    foreach ($_POST as $a => $b) {
      echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
    }
    ?>
  </form>
  <script type="text/javascript">
    alert(' you must make sure that the document is saved, it is only generated once !! ');

    // $("form").attr('target', '_blank');
    document.getElementById('myForm').submit();
  </script>
<?php endif; ?>
<?php
  // echo "<script>window.location.href='semregviewnew.php'</script>";


} else {
 echo "<script>window.location.href='semregviewnew.php'</script>";
}
?>
</body>
</html>