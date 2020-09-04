<?php
include("header1.php");
if(!isset($_SESSION['admofficeid']))
{
  echo "<script>alert('Session Expired')</script>";
  echo "<script>window.location.href='login.php'</script>";
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style type="text/css">
.select2-selection.select2-selection--single {
	height: 38px;
}
#religion_root>label {
	width: 100%;
}
#religion_root .select2 {
	width: 100% !important;
}
</style>


<script type="text/javascript">
	$(document).ready(function() {


		var getReligion = () => {
			$.ajax({
				url: 'get_ajax_data.php',
				type: 'POST',
				data:  {action: 'get-all-religion'} ,  
				success: function(response) {  
					$religions = '';
					if(response.length>0){
						$religions = '<label for="religion">Religion</label><select class="form-control" id="religion" name="religion"  required>  <option value="0" selected="selected" disabled="disabled">------- Select --------</option>';
						for($o = 0 ; $o < response.length ; $o++){
							$religions += '<option value="' + response[$o]['value'] + '">' + response[$o]['name'] + '</option>';
						}
						$religions += '<option value="other" >------- other religion --------</option></select>';
						$('#religion_root').html($religions); 
						$('#religion').select2();  
					}
				},
				error: function( response){
					console.log('Error'); 
				}
			});

		};

		var getCastByRelig = ( $cas) => { 
			$('#caste_root').html( '<div class=" text-center" style="height: 100%;background: url(\'images/loading-bar.gif\') 50% 50% no-repeat;"> </div>');  

			$.ajax({
				url: 'get_ajax_data.php',
				type: 'POST',
				data:  {action: 'get-a-caste', religion: $cas } ,  
				success: function(response) { 
					$caste = '<label for="caste">Caste</label><select class="form-control" id="caste" name="caste"  required=""><option value="0" selected="selected" disabled="disabled">------- Select --------</option>';
					if(response.length>0)
						for($o = 0 ; $o < response.length ; $o++){
							$caste += '<option value="' + response[$o]['value'] + '">' + response[$o]['name'] + '</option>';
						}  
						$caste += '<option value="other" >------- other caste --------</option>';
						$caste += '</select>' 
						$('#caste_root').html($caste);   						
						$('#caste').select2();  
					},
					error: function( response){
						console.log('Error'); 
					}
				});


		};

		$(document).on('change', '#religion', function(event) {
			event.preventDefault();
			$('#caste_root').html('');   
			$('#religion-added').remove();
			if($('#religion').val() == 0){
				alert('select one'); 
			} else if($('#religion').val() == 'other'){
				$religions  = '<input type="text" class="form-control " style="margin: 10px 0px;" id="religion-added" name="religion" placeholder="Enter religion manually" required>'
				$('#religion_root').append($religions);   
				$caste = '<label for="caste">Caste</label> <input type="text" class="form-control" id="caste" name="caste" placeholder="Enter caste manually" required>'
				$('#caste_root').html($caste);    

			} else{
				getCastByRelig($('#religion').val()); 
			}
		});

		$(document).on('change', '#caste', function(event) {
			event.preventDefault();

			if($('#religion').val() == 0){
				alert('select one'); 
			} else if($('#caste').val() == 'other'){
				$caste = '<label for="caste">Caste</label> <input type="text" class="form-control" id="caste" name="caste" placeholder="Enter caste manually" required>'
				$('#caste_root').html($caste);    
			} 

		});



		$(document).on('change', '#category', function(event) {
			event.preventDefault();

			$('#category-added').remove();
			if($('#category').val() == 0){
				alert('select one'); 
			} else if($('#category').val() == 'other'){
				$religions  = '<input type="text" class="form-control " style="margin: 10px 0px;" id="category-added" name="category" placeholder="Enter category manually" required>' 
				$('#category_root').append($religions);   
			}  
		});


		// $("#religion").change(function() {
		// 	var rel= $(this).val();
		// 	if(rel!= "") {
		// 		$.ajax({
		// 			url:"getcaste.php",
		// 			data:{castvalue:rel},
		// 			type:'POST',
		// 			success:function(response) {
		// 				console.log(response);
		// 				$("#caste").html(response);
		// 			}
		// 		});
		// 	} else {
		// 		$("#caste").html("<option value=''>------- Select --------</option>");
		// 	}
		// });




		setTimeout(function (){
			getReligion();
		}, 1);

	});

</script>
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
		if(!isset($_SESSION['tempno']))
		{
			$query6="SELECT * FROM temp ORDER BY temp_no DESC LIMIT 1";
			$result6=$obj6->selectdata($query6);
			if(mysqli_num_rows($result6)==0)
			{
				$tp_no=1;
			}
			else
			{
				$row=$obj6->fetch($result6);
				$t_no=$row[0];
				$tp_no=$t_no+1;
			} 


			$obj1=new dboperation();
			$q1="INSERT INTO `temp` (`temp_no`) values($tp_no)";
			$obj1->Ex_query($q1);
			$_SESSION['tempno']=$tp_no;

		}
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
		$cst=$_POST['caste']."-".$_POST['category'];;
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
	
	
	
	
	$t=$_SESSION['tempno'];
	$obj=new dboperation();
	$img=addslashes(file_get_contents($_FILES['file']['tmp_name']));
	
	$q="update `temp` set `courseid`='$co', `branch_or_specialisation`='$sp',`year_of_admission`='$todays_date', `name`='$na', `dob`='$db', `gender`='$sx', `religion`='$rlgn', `caste`='$cst', `mobile_phno`='$mob', `land_phno`='$phno', `email`='$mail', `address`='$adrs', `admission_type`='$admtype', image='$img',`blood`='$bld',`name_guardian`='$nagd', `guard_contactno`='$pmob',`relation`='$rel', `occupation`='$occpn', `income`='$inc', `guard_email`='$pemail' where `temp_no`='$t'";
	
	$obj->Ex_query($q);
	

//$obj=new dboperation();
//$q="INSERT INTO `temp` (`temp_no`, `courseid`, `branch_or_specialisation`,`year_of_admission`, `name`, `dob`, `gender`, `religion`, `caste`, `mobile_phno`, `land_phno`, `email`, `address`, `admission_type`, `image`,`blood`,`name_guardian`, `guard_contactno`, `relation`, `occupation`, `income`, `guard_email`) VALUES ('$tp_no', '$co', '$sp', '$todays_date', '$na', '$db', '$sx', '$rlgn','$cst', '$mob', '$phno', '$mail', '$adrs', '$admtype', '" . addslashes(file_get_contents($_FILES['file']['tmp_name'])) . "','$bld', '$nagd', '$pmob', '$rel', '$occpn', '$inc', '$pemail')";
	
		// $p="INSERT INTO `parent` (`parentid`, `name_guardian`, `guard_contactno`, `relation`, `occupation`, `income`, `guard_email`) VALUES ('$pr_no', '$nagd', '$pmob', '$rel', '$occpn', '$inc', '$pemail')";
		//$s="INSERT INTO `parent_student` (`admissionno`,`parentid`) VALUES ('$tp_no','$pr_no')";


	//$obj->Ex_query($q);


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

		$_SESSION['acc']=$t;
		//echo "<script>location.href='dashboard_student.php?menu=ug'</script>";
		echo "<script>location.href='admission_ug_student.php'</script>";
	}
	if($co == 'BARCH')
	{
		$_SESSION['acc']=$t;
		//echo "<script>location.href='dashboard_student.php?menu=ug'</script>";
		echo "<script>location.href='admission_ug_student.php'</script>";
	}
	if($co == 'MCA')
	{
		$_SESSION['acc']=$t;
		echo "<script>location.href='admission_pg_student.php'</script>";
		//echo "<script>location.href='dashboard_student.php?menu=pg'</script>";
	}
	if($co == 'MTECH')
	{
		$_SESSION['acc']=$t;
		echo "<script>location.href='admission_pg_student.php'</script>";
		//echo "<script>location.href='dashboard_student.php?menu=pg'</script>";

	}
	else
	{

		$_SESSION['acc']=$t;
		echo "<script>location.href='dashboard_student.php?menu=pg'</script>";
	//	echo "<script>location.href='admission_pg_student.php'</script>";
	}
	
	unset($_SESSION['tempno']);	
	
}
?>



<div class="form-row">
	<div class="form-group col-md-6">
		<label for="Course">Course</label>
		<?php
		$obj1=new dboperation();
		echo '<select name="course1" id="course1" class="form-control" required onchange="getcourse(this.value)">';
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
//checking admission status

			if($co == 'BTECH' ||$co == 'BARCH')
			{

			}
			if($co == 'MCA' ||$co == 'MTECH')
			{
			}

			

		}
		else
		{
		}
		?>
	</div>
	<div class="form-group col-md-6">
		<label for="inputState">Branch</label>
		<?php

		echo '<select name="spec" id="spec" class="form-control" required onchange="getspec()">';
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
			<input id="admtype" name="admtype" value="Normal" type="radio" required>
		Normal</label>
		<label class="radio">
			<input id="admtype" name="admtype" value="Lateral" type="radio" required>
		Lateral</label>
		<label class="radio-inline">
			<input id="admtype" name="admtype" value="Transfer" type="radio" required>
		Transfer</label>
		<label class="radio-inline">
			<input id="admtype" name="admtype" value="Spot" type="radio" required>
		Spot Admission</label>

	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
		<label for="name">Name</label>
		<input type="text" pattern="[^,;':\x22]*$" title="Invalid input:single,double quotes,colon, comma, senicolon etc not allowed" class="form-control" id="name" name="name" placeholder="Full Name" required="">
	</div>
	<div class="form-group col-md-6">
		<label for="dob">DOB</label> 
		<div class="input-group date" data-provide="datepicker">
			<input type="text" class="form-control"  id="dob"   name="dob" placeholder="Date of Birth" required >
			<div class="input-group-addon">
				<span class="fa fa-calendar"></span>
			</div>
		</div>

	</div>
</div>

<link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js" charset="UTF-8"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$.fn.datepicker.defaults.format = "yyyy-mm-dd";
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd' 
		});
	});
</script>

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
	$(document).ready(function($) {
		$( "#dob" ).datepicker();
		$( "#dob" ).datepicker( "option", "dateFormat",'yy-mm-dd' );  

		$( "#dob" ).datepicker( "option", "changeYear", true );
		$.datepicker.setDefaults({
			altFormat: "yy-mm-dd" ,
			showAnim: "slideDown",			
			
		}); 
	});
</script> -->

<div class="form-group">
	<label class="col-sm-4 control-label" for="gender">Gender</label>
	<div class="col-sm-8">
		<label class="radio-inline">
			<input id="gender" name="gender" value="M" type="radio" required>
		Male</label>
		<label class="radio-inline">
			<input id="gender" name="gender" value="F" type="radio" required>
		Female</label>
		<label class="radio-inline">
			<input id="gender" name="gender" value="O" type="radio" required>
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

<div class="row">
	<div class="form-group col-md-4" id="religion_root">
		<label for="religion">Religion</label>  
		<select class="form-control" id="religion" name="religion"  required>                
			<option value='0' selected="selected" disabled="disabled">------- Select --------</option>
		</select> 
	</div>
	<div class="form-group col-md-5" id="caste_root">
		<label for="caste">Caste</label>
		<select class="form-control" id="caste" name="caste"  required="">
			<option value=''>----- Select Religion first ------</option>
		</select>
	</div> 
	<div class="form-group col-md-3" id="category_root">
		<label for="caste">Category</label>
		<select class="form-control" id="category" name="category"  required="">
			<option value='0' selected="selected" disabled="disabled">----- Select Category ------</option>
			<option value='SC' title="SCHEDULED CASTES">SC</option>
			<option value='ST' title="SCHEDULED TRIBES	">ST</option>
			<option value='OEC-SC' title="OTHER ELIGIBLE COMMUNITIES SC">OEC-SC</option>
			<option value='OEC-ST' title="OTHER ELIGIBLE COMMUNITIES ST">OEC-ST</option>
			<option value='SEBC' title="SOCIALLY AND EDUCATIONALLY BACKWARD CLASSES">SEBC</option>
			<option value='GENERAL' title="GENERAL">GENERAL</option>
			<option value="other" >------- other caste --------</option>  
		</select>
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
		<input type="text" pattern="[^,;':\x22]*$" title="Invalid input:single,double quotes,colon, comma, senicolon etc not allowed" id="name_guard" name="name_guard" class="form-control" placeholder="Guardian name" required="">
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
		<input type="text" pattern="[^,;':\x22]*$" title="Invalid input:single,double quotes,colon, comma, senicolon etc not allowed" class="form-control" id="occupation" name="occupation" placeholder="Occupation of guardian" required="">
	</div>
	<div class="form-group col-md-6">
		<label for="income">Annual Income</label>
		<input type="number" class="form-control" id="income" name="income" placeholder="Guardian income" required="">
	</div>
</div>


<div class="form-group col-md-6">
	<label for="address">Address</label>
	<textarea rows="4" cols="20" wrap="hard" class="form-control" maxlength="120" id="address" name="textarea" placeholder="1234 Main St" required=""> </textarea>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
		<label for="phone">Telephone No</label>
		<input type="tel" pattern="^\d{11}$" class="form-control" id="phone" name="phone" placeholder="Ex: 04692660886" >
	</div>
	<div class="form-group col-md-6">
		<label for="inputEmail4">Year of Admission</label>
		<?php   echo "<td> <input type='text' class='form-control' readonly='readonly' value='".$todays_date."'/></td>" ?>
	</div>
</div>

<div class="form-group">
	<div class="row">
		<div class="col-md-6">
			<label for="file">Upload Image</label>
			<input type="file" class="form-control-file" accept="image/jpg,image/jpeg" onchange="loadFile(event)" id="file" name="file">
		</div>
		<div class="col-md-6">
			<img id="output" height=200px width=200px/>
			<script>
				$(document).ready(function() { 
					document.getElementById("output").style.display='none';
				});
				var loadFile = function(event) {
					document.getElementById("output").style.display='block';

					var fileName = document.getElementById("file").value;
					var idxDot = fileName.lastIndexOf(".") + 1;
					var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
					if ( fileName != "") {
						if (extFile=="jpg" || extFile=="jpeg"  ){
							var output = document.getElementById('output');
							output.src = URL.createObjectURL(event.target.files[0]);
						}else{
							alert("Only jpg/jpeg files are allowed!");
							$("#file").val('');
							document.getElementById("output").style.display='none';
						}   
					}
					else
					{
						document.getElementById("output").style.display='none';

					}
				};
			</script>
		</div>
	</div>
</div>
<button type="submit" value="Submit" name="button" id="button" class="btn btn-primary ">Submit</button>


</form>

</div>


<?php
include("footer.php");
?>

<script type="text/javascript">
	function getcourse(a)
	{
		$.post("checkstatus.php",
		{
			course: a

		},
		function(data, textStatus)
		{
			if(data==1)
				document.getElementById('form1').submit();	
			else
			{
				alert(a + ' admission not started');
				document.getElementById('course1').value="";
				$('#spec').empty();
				var option = document.createElement('option');
				option.text ='Choose...';
				option.value = '';
				document.getElementById('spec').add(option, 0);
			}
		});

	}
</script>
