<?php
include("header.php");
?>

    <div class="container">
    	<h2>ADMISSION</h2>
    	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" class="sear_frm" >


    	<?php
include "dboperation.php";
$cid="";
$cat="";
$tp_no="";
$acc="";
$todays_date=date('Y');
$obj6=new dboperation();

	$query6="SELECT * FROM temp ORDER BY temp_no DESC LIMIT 1";
	$result6=$obj6->selectdata($query6);
	$row=$obj6->fetch($result6);
	$t_no=$row[0];
	$tp_no=$t_no+1;

	/*$query7="SELECT * FROM parent ORDER BY parentid DESC LIMIT 1";
	$result7=$obj6->selectdata($query7);
	$row1=$obj6->fetch($result7);
	$p_no=$row1[0];
	$pr_no=$p_no+1;*/

if (isset($_REQUEST['button']))
{
		$co=$_POST['course1'];
		$sp=$_POST['spec'];
		//$bc=$_POST['bch'];
	$admtype=$_POST['admtype'];
		$todays_date=date('Y');
		$na=$_POST['name'];
		$db=$_POST['dob'];
		$sx=$_POST['gender'];
		$blood=$_POST['blood'];
		$rlgn=$_POST['religion'];
		$cst=$_POST['caste'];
		$mob=$_POST['mobile'];
		$pmob=$_POST['pmobile'];
		//$lnmob=$_POST['lnmobile'];
		$mail=$_POST['email'];
		$nagd=$_POST['name_guard'];
		$rel=$_POST['relation'];
		$occpn=$_POST['occupation'];
		$inc=$_POST['income'];
		$adrs=$_POST['textarea'];
		$phno=$_POST['phone'];
		$bld=$_POST['blood'];
		$pemail=$_POST['pemail'];
		//$file=$_post[''];
		// $tmpName     = $_FILES['file']['tmp_name'];       // name of the temporary stored file name

		 //$fp = fopen($tmpName, 'r');  // open a file handle of the temporary file
      //    $file  = fread($fp, filesize($tmpName)); // read the temp file
      //    fclose($fp); // close the file handle
	/*$file=$_FILES['file']['name'];
	$tempname=$_FILES['file']['tmp_name'];
	echo $type=$_FILES['file']['type'];
	if(($type=='image/gif')||($type=='image/jpeg')||($type=='image/bmp'))
	{
		$ran=rand();
		$file=$ran.$file;
		$tmp="upload/photo/".$file;
		move_uploaded_file($tempname,$tmp);
	}
	 $ran=rand();*/
	 $obj=new dboperation();
     $q="INSERT INTO `temp` (`temp_no`, `courseid`, `branch_or_specialisation`,`year_of_admission`, `name`, `dob`, `gender`, `religion`, `caste`, `mobile_phno`, `land_phno`, `email`, `address`, `admission_type`, `image`,`blood`,`name_guardian`, `guard_contactno`, `relation`, `occupation`, `income`, `guard_email`) VALUES ('$tp_no', '$co', '$sp', '$todays_date', '$na', '$db', '$sx', '$rlgn','$cst', '$mob', '$phno', '$mail', '$adrs', '$admtype', '" . addslashes(file_get_contents($_FILES['file']['tmp_name'])) . "','$bld', '$nagd', '$pmob', '$rel', '$occpn', '$inc', '$pemail')";
		// $p="INSERT INTO `parent` (`parentid`, `name_guardian`, `guard_contactno`, `relation`, `occupation`, `income`, `guard_email`) VALUES ('$pr_no', '$nagd', '$pmob', '$rel', '$occpn', '$inc', '$pemail')";
		//$s="INSERT INTO `parent_student` (`admissionno`,`parentid`) VALUES ('$tp_no','$pr_no')";


	 $obj->Ex_query($q);


/*	$obj5=new dboperation();
	$query5="SELECT * FROM courses WHERE course = '$co' ";
	$result5=$obj5->selectdata($query5);
	$row=$obj5->fetch($result5);
	$cat=$row[2]; */

/*	$obj6=new dboperation();
	$query6="SELECT MAX(admissionno) FROM stud_details";
	$result6=$obj6->selectdata($query6);
	$row=$obj6->fetch($result6);
	$tp_no=$row[0]; */

	if($co == 'BTECH')
	{
		$_SESSION['acc']=$tp_no;
		//echo "<script>location.href='dashboard_student.php?menu=ug'</script>";
 	 echo "<script>location.href='admission_ug_student.php'</script>";
	}
	if($co == 'BARCH')
	{
		$_SESSION['acc']=$tp_no;
		//echo "<script>location.href='dashboard_student.php?menu=ug'</script>";
		echo "<script>location.href='admission_ug_student.php'</script>";
	}
	if($co == 'MCA')
	{
		$_SESSION['acc']=$tp_no;
		echo "<script>location.href='admission_pg_student.php'</script>";
		//echo "<script>location.href='dashboard_student.php?menu=pg'</script>";
 	}
	if($co == 'MTECH')
	{
		$_SESSION['acc']=$tp_no;
		echo "<script>location.href='admission_pg_student.php'</script>";
		//echo "<script>location.href='dashboard_student.php?menu=pg'</script>";

	}
	else
	{

		$_SESSION['acc']=$tp_no;
		echo "<script>location.href='dashboard_student.php?menu=pg'</script>";
	//	echo "<script>location.href='admission_pg_student.php'</script>";
	}
}
?>



 <div class="form-row">
 	<div class="form-group col-md-6">
      <label for="Course">Course</label>
      <?php
$obj1=new dboperation();
echo '<select name="course1" id="course1" class="form-control" onchange="getcourse()">';
echo "<option value=''>Choose...</option>";

$order = "SELECT distinct courseid FROM class_details where semid=1 ";
$result=$obj1->selectdata($order);
while($f=$obj1->fetch($result))
{
		if(isset($_POST['course1']))
		 {
			 echo '<option ';
			 if($_REQUEST['course1']==$f['courseid'])
			 echo 'selected = "selected" ';
			 echo " value='$f[0]' >".$f[0]."</option>";


		 }
		else
		{
					echo "<option id='' value=".$f[0].">".$f[0]."</option>";
		}


}

      echo '</select>';

	   if(isset($_POST['course1']))
		 {
		 	$co=$_POST['course1'];

		 }
		 else
		 {
		 }
	  ?>
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Branch</label>
      <?php

echo '<select name="spec" id="spec" class="form-control" onchange="getspec()">';
echo "<option value=''>Choose...</option>";


$obj2=new dboperation();
$order2 = "SELECT distinct branch_or_specialisation FROM class_details WHERE courseid = '$co' ";
$result2=$obj2->selectdata($order2);
while($f2=$obj2->fetch($result2))
{
		if(isset($_POST['spec']))
		 {
			 echo '<option ';
			 if($_REQUEST['spec']==$f2['branch_or_specialisation'])
			 echo 'selected = "selected" ';
			 echo " value='$f2[0]' >".$f2[0]."</option>";


		 }
		else
		{
					echo "<option id='' value=".$f2[0].">".$f2[0]."</option>";
		}


}


      echo '</select>';

	   if(isset($_POST['spec']))
		 {
		 	$sp=$_POST['spec'];

		 }
		 else
		 {
		 }
	  ?>
    </div>
    
    </div>



    <div class="form-group">
   <label class="col-sm-4 control-label" for="admtype">Admission Type</label>
   <div class="col-sm-8">
     <label class="radio-inline">
      <input id="admtype" name="admtype" value="Normal" type="radio">
      Normal</label>
     <label class="radio">
      <input id="admtype" name="admtype" value="Lateral" type="radio">
      Lateral</label>
     <label class="radio-inline">
      <input id="admtype" name="admtype" value="Transfer" type="radio">
      Transfer</label>
   </div>
  </div>
   

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="dob">DOB</label>
      <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" required="">
    </div>
</div>


<div class="form-group">
   <label class="col-sm-4 control-label" for="gender">Gender</label>
   <div class="col-sm-8">
     <label class="radio-inline">
      <input id="gender" name="gender" value="M" type="radio">
      Male</label>
     <label class="radio-inline">
      <input id="gender" name="gender" value="F" type="radio">
      Female</label>
      <label class="radio-inline">
      <input id="gender" name="gender" value="O" type="radio">
      Other</label>
   </div>
  </div>


  <div class="form-group">
      <label for="blood">Blood Group</label>
      <select id="blood" name="blood" class="form-control" required="">
        <option selected>Choose...</option>
        <option name="blood" value="A+" >A+</option>
 		<option name="blood" value="A-" >A-</option>
 		<option name="blood" value="AB+" >AB+</option>
 		<option name="blood" value="AB-" >AB-</option>
		<option name="blood" value="B+" >B+</option>
		<option name="blood" value="B-" >B-</option>
		<option name="blood" value="O+" >O+</option>
		<option name="blood" value="O-" >O-</option>
      </select>
    </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="religion">Religion</label>
      <input type="text" class="form-control" id="religion" name="religion" placeholder="Enter your religion" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="caste">Caste</label>
      <input type="text" class="form-control" id="caste" name="caste" placeholder="Enter your caste" required="">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="mobile">Mobile</label>
      <input type="tel" pattern="^\d{10}$" class="form-control" id="mobile" name="mobile" placeholder="Ex: 9989865475" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Ex: example@rit.com" required="">
    </div>
  </div>


 <div class="form-row">
 	<div class="form-group col-md-6">
      <label for="name_guard">Name of Guardian</label>
      <input type="text" class="form-control" id="name_guard" name="name_guard" placeholder="Guardian name" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="relation">Relation</label>
      <select id="relation" name="relation" class="form-control" required="">
        <option selected>Choose...</option>
        <option name="relation" value="Father" >Father</option>
			<option name="relation" value="Mother" >Mother</option>
			<option name="relation" value="Grand Father" >Grand Father</option>
			<option name="relation" value="Grand Mother" >Grand Mother</option>
			<option name="relation" value="Brother" >Brother</option>
			<option name="relation" value="Uncle" >Uncle</option>
			<option name="relation" value="Other" >Other</option>
      </select>
    </div>
    
    </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="mobile">Guardian Mobile</label>
      <input type="tel" pattern="^\d{10}$" class="form-control" id="pmobile" name="pmobile" placeholder="Ex: 9989865475" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="pemail">Guardian Email</label>
      <input type="email" class="form-control" id="pemail" name="pemail" placeholder="Ex: example@rit.com">
    </div>
  </div>


 <div class="form-row">
 	<div class="form-group col-md-6">
      <label for="occupation">Occupation</label>
      <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Occupation of guardian" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="income">Annual Income</label>
      <input type="number" class="form-control" id="income" name="income" placeholder="Guardian income" required="">
    </div>
</div>

 
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="textarea" placeholder="1234 Main St" required="">
  </div>

   <div class="form-row">
    <div class="form-group col-md-6">
      <label for="phone">Telephone No</label>
      <input type="tel" pattern="^\d{10}$" class="form-control" id="phone" name="phone" placeholder="Ex: 9989865475" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Year of Admission</label>
       <?php   echo "<td> <input type='text' class='form-control' readonly='readonly' value='".$todays_date."'/></td>" ?>
    </div>
  </div>

<div class="form-group">
    <label for="file">Upload Image</label>
    <input type="file" class="form-control-file" id="file" name="file">
  </div>
<button type="submit" value="Submit" name="button" id="button" class="btn btn-primary">Submit</button>

    
    </form>

  </div>
  

 <?php
include("footer.php");
?>