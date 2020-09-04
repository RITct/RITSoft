<?php
include("includes/header.php");
$msg='';
$c=0;
//session_start();
include("includes/sidenav.php");
include("includes/connection.php");
$_SESSION['uname']=$_SESSION['admissionno'];

if (!isset($_SESSION['uname'])) 
{
  
  echo '<script type="text/javascript">alert("You are out of session..Please login again");</script>';;
 }
 else{
 $uname=$_SESSION['uname'];

$res1=mysql_query("SELECT * from academic_year where status=1");

while ( $row11= mysql_fetch_assoc($res1)) {
$acd_year=$row11['acd_year'];

}
 
//$qry_check="SELECT * from hostel_stud_reg where admn_status in('submitted','ranked','allocated') and ADMNO='".$uname."'";
$res_check=mysql_query("SELECT * from hostel_stud_reg where admn_status in('submitted','ranked','allocated') and ADMNO='$uname' and status=1");
$num_rec=mysql_num_rows($res_check);
	if($num_rec!=0)
		{
			//$msg= 'You are already submitted the application...to download the application form <a href="hostel_applicationdownload.php"><i>click here</i></a>';
			//$msg= 'You submitted the application...to download the application form <a href="hostel_applicationdownload.php"><i>click here</i></a>';
			$msg=" Status : Application Sucessfully Submitted";
		}
		
//$qrys="SELECT * from stud_details sd,class_details cd ,current_class cc where sd.admissionno='".$uname."' and cc.studid='".$uname."' and cd.classid=cc.classid";
//print_r($qrys);

$result=mysql_query("SELECT * from stud_details sd,class_details cd ,current_class cc where sd.admissionno='$uname' and cc.studid='$uname' and cd.classid=cc.classid");
$records=mysql_num_rows($result);
	if($records==0)
		{
			echo '<script>alert("You are not yet registered in RIT SOFT")</script>';
		}
else{
        while ( $row= mysql_fetch_assoc($result)) {
        $admn=$row['admissionno'];
        $name=$row['name'];
        $address=$row['address'];
        $gender=$row['gender'];
        $dob=$row['dob'];
        $brnch=$row['courseid'];
        $rank=$row['rank'];
        $sem=$row['semid'];
        $rank=$row['rank'];
        $mob=$row['mobile_phno']; 
        
        }
	
}

}/// this for else codition to check the sesson variable ha svalue or not 
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><b>Application for admission to Mens/Ladies Hostels for the period <?php echo $acd_year ?> </b></h3>
		</div>
	</div>
<script type="text/javascript">
	function validation() {
		//alert("hello");
		var valid=false;
		if(document.getElementById('pMob').value=="")
       			{
       				alert("Please enter your Contact No.");
       				valid=true;
       				return false;
       			}
       			if(document.getElementById('distance').value=="")
       			{
       				alert("Please enter your distance");
       				valid=true;
       				return false;
       			}
       			var regExp = /^(\([0-9]{10}) /;
  //var phone = pMob.match(regExp);
  if ((document.getElementById('pMob').match(regExp)) && (document.getElementById('mob_stu').match(regExp))) {
    //alert('yes');
    return true;
  }
  else
  {
  alert('Please enter a valid phone number');
  return false;
}
   var regexpd=/^(\([0-9]\.[0-9]))/;
		if (document.getElementById('distance').match(regExp)) {
    //alert('yes');
    return true;
  }
  else
  {
  alert('Please enter a valid distance');
  return false;
}
	}
</script>
</head>
<body id="homebody">
	<?php
	//include("studenthome.php");
		
	?>
	<div class="container">
		
	<form name="frm1" method ="POST" action="hostel_applicationsave.php" onsubmit="return validation()">
		<div id="rfm"><h4></h4></div>
	<h3><?php
	 if($msg!='')
	{
		echo $msg;

	 } 
	 else
	 {
	 	?> <!-- <form name="frm1" method ="POST" action="hostel_applicationsave.php"> -->
	</h3>

		<div class="table-responsive-lg">
<table class="table table-striped" border=1 align="left" class="tbl" cellpadding="7" cellspacing="2">
	
 
<tr>
		<td>Admission No</td>
		<td > <input type="text" name="admn" value="<?php if (isset($admn)){echo $admn; } ?>" required readonly></td>
	</tr>
<TR>
 	<td>Name</td>
 <td>
 	 <?php if (isset($name)){ echo $name; }  ?>
  
</td>
</TR>
<tr>
	<td>Permanent address as in Aadhaar card</br>(attach copy of aadhar card)</br></td>
	<td><textarea name="txtaddr" maxlength="500" rows="6" cols="35" required><?php if (isset($address)) {echo $address; } ?> </textarea></br></br>
          
		Mobile No:<input type="text" name="mob_stu" value="<?php if (isset($mob)) {echo $mob;} ?>" required></td></tr>
		<tr><td>Address of Parent/Guardian (in capital letters)</br>
			<td><textarea maxlength="500" name="txtpaddress" rows="6" cols="35" required><?php if (isset($address)) {echo $address; } ?> </textarea>
			</br></br>	Mobile No: <input type="text" name="mob_p" id="pMob" min="10" maxlength="10" required="10 digits should be entered"></td>
		
</tr>
<TR>
 	<td>Post Office </td>
 <td>
 	 <textarea maxlength="200" name="txtpostoff" rows="2" cols="35" required></textarea>  
</td>
</TR>


<tr>
	<td>Details of present residential address</br></td>
	<td><textarea maxlength="500" name="txtaddrpersent" rows="4" cols="35" required><?php if (isset($address)) {echo $address; } ?> </textarea></br></br>
		</td></tr>
		






<tr>
	<td>Gender</td>
	<td> <!-- <input type="radio" name="gender" <?php if (isset($gender)){if($gender=="M"){ echo "checked";}}?>  value="M">Male &nbsp<input type="radio" name="gender" <?php if (isset($gender)){if($gender=="F"){ echo "checked";}}?> value="F" >Female &nbsp<input type="radio" name="gender"  value="others">Others --> 
<input  type="text" name="gender"  value="<?php if (isset($gender)) { echo $gender; } ?>" readonly >
</td>
	
</tr>
<tr><td>Date of birth</td>
<td><input  type="text" name="dob" min="01-01-1990" value="<?php if (isset($dob)) {echo $dob;} ?>" readonly ></td></tr>
	<tr>
		<td>Semester</td>
		<td>
                      <input  type="text" name="semester"  value="<?php if (isset($sem)) {echo $sem; } ?>" readonly >

                <!-- <select name="semester">
		<option>Select one option..</option>
		<option value="1" <?php if($sem==1) echo 'selected="selected"'; ?>>1</option>
		<option value="2" <?php if($sem==2) echo 'selected="selected"'; ?>>2</option>
		<option value="3" <?php if($sem==3) echo 'selected="selected"'; ?>>3</option>
		<option value="4" <?php if($sem==4) echo 'selected="selected"'; ?>>4</option>
		<option value="5" <?php if($sem==5) echo 'selected="selected"'; ?>>5</option>
		<option value="6" <?php if($sem==6) echo 'selected="selected"'; ?>>6</option>
		<option value="7" <?php if($sem==7) echo 'selected="selected"'; ?>>7</option>
		<option value="8" <?php if($sem==8) echo 'selected="selected"'; ?>>8</option>

	</select> -->

</td>
	
		

<tr>
	<td>Priority to which the application belongs</BR>Priority I-SC/ST/PH/BPL/Other States/Central Govt. Nominees</br>
		Priority II(b)-Final year B.tech/B.Arch
	</br>Priority II(c)-Third year B.Tech, third and fourth year B.Arch</br>Priority II(d)-Second year B.Tech/B.Arch
        </br>Priority II(f)-Second year PG Students

</br>(*priority I student must attach the copy of proof)</td>
	<td>
	<table width="500" border="2" cellpadding="4" cellspacing="4">
		<tr>
		<th>Priorities</th><th colspan="2">Please tick</th></tr>
			<tr>
	<td>Priority I</td>
	<td><input type="checkbox" name="prior[]" value="prior1" ><script type="text/javascript"> if($(this). prop("checked") == true){
<?php  $c=1; echo $c;?>

}</script></td>

	<td > <input type="checkbox" name="category[]" value="catsc" > SC
			 <input type="checkbox" name="category[]" value="catst"> ST
			 <input type="checkbox" name="category[]" value="catph"> PH
			 <input type="checkbox" name="category[]" value="catbpl"> BPL
			<br> <input type="checkbox" name="category[]" value="catoherstate"> Other State
			<br> <input type="checkbox" name="category[]" value="catcentral"> Central govt. nominee</TD>
	</tr>
		<tr><td>Priority II(b)</td>
			<td colspan="2"><input type="checkbox" name="prior[]" value="prior2b"></td>
		</tr>
	<tr><td>Priority II(c)</td><td colspan="2"><input type="checkbox" name="prior[]" value="prior2c"></td></tr>
	<tr><td>Priority II(d)</td><td colspan="2"><input type="checkbox" name="prior[]" value="prior2d"></td></tr>
        <tr><td>Priority II(f)</td><td colspan="2"><input type="checkbox" name="prior[]" value="prior2f"></td></tr>

	
</table>
	</td>
</tr>
<tr>
	<td>Specify the category, if belongs to OEC/OBC</td>
	<td><select name="cat">
		<option value="0">Select</option>
		<option value="OBC">OBC</option>
                <option value="OEC">OEC</option>
               </select> </td>
</tr>

<tr>
	<td>Family annual Income (Only for BPL category)</br>(*valid income certificate should be attached)</td>
	<td><input type="text" name="txtincome" id="income"></td>
</tr>
<tr>
	<td>Minimum Google distance from the post</br>office in the address specified in the Adhaar</br>card to RIT pampady</td>
	<td><input type="text" name="txtdist" id="distance" required="Plz fill this field"></td>
</tr>

<tr>

	<td>Avergae SGPA</td>
	<td><input type="text" name="txtsgpa" required> </td>
</tr>


<tr>

	<td>Rank in entrance Exam</td>
	<td><input type="text" name="txtrank" value=<?php if (isset($rank)){echo $rank;} ?>> </td>
</tr>
<tr>

	<td>Any disciplinary action from the college</td>
	

       <td><select name="txtdisp">
		
		<option value="No">NO</option>
                <option value="Yes">YES</option>
               </select> </td>


</tr>


<tr align="center" rowspan="5">
	<br><td  colspan="3" ><input type="submit" name="btsub" value="submit" >
</td>
<!-- <td colspan="3"><input type="Reset" name="btReset" value="Reset"> --> </td>
	</tr></br>
</table>
</div>
</form>
</div>
</body>
</html>

<?php
}
include("includes/footer.php");
?>








