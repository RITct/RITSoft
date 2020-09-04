<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
include_once('../msgclass.php');


 $count=0;
error_reporting(0);
 $classid=$_SESSION["classid"];
$fid=$_SESSION["fid"];
 ?>
<div id="page-wrapper">  
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					
					<h3 class="tittle my-5 text-capitalize"><center>SEND SMS TO STUDENTS</center></h3> <br><br><br>
				</div>


<div class="box-body">
<div>

<form id="form1" name="form1" method="post" action="" enctype="" class="sear_frm" onsubmit="return confirm('Are you sure, Do you want to send the message?');">
<div class="form-row">

 	<div class="form-group col-md-6">
      <label  for="adno">SUBJECT </label>
	  <input type="text" class="form-control" name="subj" id="subj" required>
     </div>
	</div>
      
   
	<div class="form-row">
 	<div class="form-group col-md-6">
      <label  for="name">MESSAGE</label> 
	  <textarea rows="5" cols="5" class="form-control"  name="msg" id="msg" required> </textarea>
	</div> </div>
	         

      <div align="center">
	   <button type="submit" value="submit" name="submit" id="submit" class="btn btn-primary">SEND MESSAGE</button> 
			  </div>

 
</form>

</div>
</div>


 
    
        <?php


if(isset($_POST["submit"]))
{
	
	$msg1=$_POST['msg']; 
	$subj=$_POST["subj"];
        // $msg="Dear Sir/Madam , ".$subj." -- ".$subj;
$status="Sending message to the following students failed due to missing details";
//reading registration details
        $l=mysql_query("select students_list from staff_advisor where fid='$fid' and classid='$classid'") or die(mysql_error());
        $r=mysql_fetch_assoc($l);
        $s=explode('-', $r["students_list"]);
        for ($i=$s[0]; $i <=$s[1] ; $i++) { 
 			       	
      
        $resul=mysql_query("select studid,rollno from current_class where classid='$classid' and rollno='$i' order by(rollno)");
        while($data=mysql_fetch_array($resul))
        {
            $adm_no=$data["studid"];

            $rollno=$data["rollno"];

            $result=mysql_query("select name,email,mobile_phno from stud_details where admissionno='$adm_no'");

               if(mysql_num_rows($result)==0)

                          {
                             $status=$status." <br>".$rollno." ".$name.", ";
                             $y=1;
                          }

            while($dat=mysql_fetch_array($result))
            {
              $name=$dat["name"];
              $email=$dat["email"];
              $mobile_phno=$dat["mobile_phno"];
              $msg="Dear ".$name.", ".$subj." - ".$msg1;

                            
                         if(!empty($mobile_phno))
                          {
                             sendmsg($mobile_phno,$msg);

                          }
                          else 
                          { 
                             $status=$status." <br>".$rollno." ".$name.", ";
                             $y=1;
                          }


              }


}




}

if(!isset($y))
{$status="Message send sucessfully";}

echo '<script> alert("Messages send, view message sending status"); </script>';
echo "<script>window.location.href='smsstatus.php?status=".$status."'</script>";



}
?>


  
<?php

include("includes/footer.php");
?>
