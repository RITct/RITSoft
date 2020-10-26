<?php
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/header.php");
include("../connection.mysqli.php");
include("includes/sidenav.php");
//session_start();
$uname=$_SESSION['fid'];
$se = false;
?>


<?php


if ($_POST) { 

	$_SESSION['POST'] =  $_POST; 
	echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
	exit();
}
if (isset($_SESSION ['POST'])) {
	$_POST = $_SESSION['POST'];
	unset($_SESSION['POST']);
}


?>

<div id="page-wrapper">
	<link href="jquery-ui.css" rel="stylesheet">
	<script src="jquery.js" type="text/javascript"></script>
	<script src="jquery-ui.js" type="text/javascript"></script>
	<script>
		$(document).ready(function()
		{
			var dtToday = new Date();
  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
  var day = dtToday.getDate(); 
  //var day1= date('Y-m-d', strtotime('-2 day',strtotime($date_raw)));
  


        //var  day1 = strtotime('-3 day', time());
        var year = dtToday.getFullYear();
        if(month < 10)
        	month = '0' + month.toString();
        if(day < 10)
        	day = '0' + day.toString();



        var maxDate = year + '-' + month + '-' + day;

        $('#date').attr('max', maxDate);

    }
    );
</script>
<script>
	function showsub(str)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","getsub_att.php?id="+str,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function() 
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("sub").innerHTML=xmlhttp.responseText;

				showDate( str );
			}
		}
	}

	function getbatch(str)
	{
		$('#showBat').css('display', 'none');
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","getbatch.php?id="+str,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function() 
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("batch").innerHTML=xmlhttp.responseText;
				if(xmlhttp.responseText.trim().length  > 0)
					$('#showBat').css('display', 'table-row');
			}
		}

		forDelte();
	}


	function show() {

		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		var e = document.getElementById("class");
		var subject = e.options[e.selectedIndex].value;

		var date = document.getElementById("date").value;

		xmlhttp.open("GET","show_attendance.php?class="+subject+"&date="+date,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
			if(xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("attendance").innerHTML=xmlhttp.responseText;

			}
		}
		forDelte();

	}



	function showDate ( str) {

		$('#hoursMe').css('display', 'none');

		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","getDate.php?id="+str,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function() 
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("pdate").innerHTML=xmlhttp.responseText; 
				try { 


					jQuery(document).ready(function($) {

          // $.fn.datepicker.defaults.format = "yyyy-mm-dd";
          $('.date').datepicker({
          	format: 'yyyy-mm-dd' ,
          	autoclose: true
          }).on('changeDate', function (ev) { 
          	show();
          });

      });





					if(xmlhttp.responseText.trim().length > 0 ) {
						$('#hoursMe').css('display', 'block');
						show();
					}



				} catch(err){}

			}
		}


	}


	function  forDelte() {

		$('#hoursDelte').css('display', 'none');
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		var e = document.getElementById("class");
		var subject = e.options[e.selectedIndex].value;

		var e = document.getElementById("subject");
		var subjecta = e.options[e.selectedIndex].value;

		var date = document.getElementById("date").value;

		xmlhttp.open("GET","show_attendance_date.php?class="+subject+"&subject="+subjecta+"&date="+date,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
			if(xmlhttp.readyState==4 && xmlhttp.status==200) {

				$('#hoursDelte').css('display', 'block');
				document.getElementById("hoursDelte").innerHTML=xmlhttp.responseText;

			}
		}
	}


</script>

<script>


	$(document).ready(function() {
		$("#sub").change(function () {
			var str = "";
			if ($("#sub option:selected").val()=='')
			{
                //$("#errmsg").html("Please select subject");
                 //$().message("Select subject!");
                 $('#btnshow').attr('disabled', 'disabled');  
             }
             else
             {

             	$('#btnshow').removeAttr('disabled');
             }
         });
	});






	$(document).ready(function() {
		$("#class").change(function () {
			var str = "";
			if ($("#sub option:selected").val()=='')
			{
                //$("#errmsg").html("Please select subject");
                 //$().message("Select subject!");
                 $('#button').attr('disabled', 'disabled');  
             }
             else
             {

             	$('#button').removeAttr('disabled');
             }
         });
	});



	function doInIn(){


		var e = document.getElementById("hour_to");
		var str = e.options[e.selectedIndex].value;

		var e = document.getElementById("subject");
		var subje = e.options[e.selectedIndex].value;
		if((subje+"").length  > 0){
			subje = subje.split('-')[0];
		}


		str= parseInt(str.trim());
		if( str > 0  ) {

			$('#attendance>table tr td').css({
				color: 'black',
				background: 'white'
			}); 
			$('#attendance>table tr td:nth-child('+(2+str)+')').each(function(index, el) {
				$this = $(this);
				arrE = [];
				$("input:checkbox[name='batch[]']:checked").each(function(){
					arrE.push($(this).val());
				});

				if ($("input:checkbox[name='batch[]']").length > 0) {

					for (var i = arrE.length - 1; i >= 0; i--) {


						if(arrE[i] == $this.attr('batch')) {
							$this.css({
								color: 'white',
								background: 'red'
							});
						}
					}

				} else {  
					if(subje.trim()  == $this.attr('subject').trim() ) {
						$this.css({
							color: 'white',
							background: 'red'
						});
					}

				}

			});

		}



	}

	function showHour(str){ 
		doInIn();
	} 

	$(document).on('change', "input:checkbox[name='batch[]']", function(event) {
		console.log('changed');		
		doInIn();
	});

	function validate(form) {
		valid  = true;


		$ty = $('#hour_to').val();
		if($ty == null){  
			alert('select a valid hour !');
			valid  = false;
		}

		if ($("input:checkbox[name='batch[]']").length > 0) {
			arrE = [];
			$("input:checkbox[name='batch[]']:checked").each(function(){
				arrE.push($(this).val());
			});
			if(arrE.length < 1){
				alert('select a Batch !');
				valid  = false;
			} 

		} 
		if(!valid) {
			return false;
		}
		return confirm('Do you really want to submit the form?');

	}

</script>

</head>
<body>
	<table class="table table-hover table-bordered" width="100%" border="1" >
		<tr>
			<td width="40%" valign="top">


				<form method="post" enctype="multipart/form-data" action="hos_delete_hour.php" onsubmit=" return validate(this)">
					<table  class="table table-hover table-bordered" align="center" width="100%" border="1">

						<tr>
							<td><label> Class</label></td>  
							<td>  
								<select name="class" id="class" class="form-control" onchange="showsub(this.value) ">
									<option>select</option>
									<?php
									$c=mysqli_query($con3,"select distinct(classid) from subject_allocation where fid='$uname'");

									while($res=mysqli_fetch_array($c))
									{
										$res1=mysqli_query($con3,"select *from class_details where classid='$res[classid]' and active='YES'");
										while($rs=mysqli_fetch_array($res1))
										{
											?>
											<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
												<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
												<?php
											}
										}
										?>
									</select> 
								</td>
							</tr>

							<tr><td><label>Subject </label></td> 
								<td><div id="sub">
									<select name="sub" class="form-control ">
										<option>select</option>
									</select></div></td></tr>
									<tr>
										<td><label>Date</label></td>
										<td id="pdate">




											<!-- <input type="date" name="date" id="date" class="form-control"  placehodler="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" />  -->

										</td>
									</tr>

									<tr>
										<td><label>Hour To Be Deleted</label></td>
										<td>
											<div id="hoursDelte">

											</div>
	<!-- 	<select name="hour" class="form-control">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
		</select> -->
		<!-- <div id="hour"></div> -->
	</td>
</tr>
<tr id="showBat" style="display: none;">
	<td>Batch </td>
	<td>
		<div id="batch" class="">
		</div>
	</td>
</tr>







<tr>
	<td></td>
	<td><input type="submit" name="btnshow" id="btnshow" value="Delete Hour" class="btn btn-primary"  disabled="disabled"/>  </td></tr> 
</table>
</form> 
<?php

if(isset($_POST["btnshow"]) && isset($_POST["class"]) && isset($_POST["date"]) && isset($_POST["hour"])  ) {

	

	$res156=mysqli_query($con3,"select * from duty_leave where hour='".$_POST["hour"]."' and leave_date='".$_POST["date"]."'    ");

	if (mysqli_num_rows ( $res156 ) > 0) {
		?>
		<script>
			alert("\t \tUnsuccessful Deletion \n ( Duty leave assigned,  Please contact Staff Advisor for further updation) ");
			window.location="hos_delete_hour.php";
		</script>
		<?php
	} else {
		

		$e="";
		$a=explode(",",$_POST['class']);
		$b=explode("-",$_POST['sub']);
		$c=$_POST["date"];
		$d=$_POST["hour"];
		$subIdd = '0';

		$batch="";
		$i = 0;
		if(isset($_POST['batch'])){
			foreach($_POST['batch'] as $selected){
				if($i==0)
					$batch=$selected;
				else
					$batch.=",".$selected;
				$i++;
			} 
		}


		$res=mysqli_query($con3,"select * from subject_class c,attendance a where a.subjectid=c.subjectid and a.hour='$d' and a.date='$c' and a.classid='$a[0]'");
		if($rs=mysqli_fetch_array($res)) { 
			$subIdd = $rs["type"];
		}

		$e = 0;
		if ($subIdd == 'LAB') {

			$quey =  "  ";

			$quer = "  DELETE FROM attendance WHERE date='$c'and subjectid='$b[0]' and hour='$d' AND studid IN ( SELECT l.studid FROM `lab_batch_student` l LEFT JOIN lab_batch b ON l.batch_id = b.batch_id WHERE  b.batch_id IN ( $batch ) AND  b.sub_code= '".$b[0]."' )  ";
			$e = 1;
		} else {

			$quer = "  DELETE FROM attendance WHERE date='$c'and subjectid='$b[0]' and hour='$d'  ";
			$e = 1;
		}
		$e=mysqli_query($con3,$quer);


		if($e>0  )
		{
			?>
			<script>
				alert("Deleted Successfully");
			// window.location="hos_delete_hour.php";
		</script>
		<?php
	}
	else
	{
		?>
		<script>
			alert("Error In Deletion");
			// window.location="hos_delete_hour.php";
		</script>
		<?php
	} 
	
}

} 
?>    




</td>
<td valign="top">

	<div id="attendance">


		<table  class="table table-hover table-bordered" width="100%" border="1">
			<tr>
				<th rowspan="2" scope="col">Roll No</th>
				<th rowspan="2" scope="col">Name</th>
				<th scope="col">Hour 1</th>
				<th scope="col">Hour 2</th>
				<th scope="col">Hour 3</th>
				<th scope="col">Hour 4</th>
				<th scope="col">Hour 5</th>
				<th scope="col">Hour 6</th>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table></td>
	</tr>
</table>


</div>

<br />
<br />
<br />






</body>

</html>




<?php include("includes/footer.php");   ?>