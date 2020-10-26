<?php
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/header.php");
include("../connection.mysqli.php");
include("includes/sidenav.php");
//session_start();
$uname=$_SESSION['fid'];
$se = false;
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
  var day1 = (dtToday.getDate())-2;
  


        //var  day1 = strtotime('-3 day', time());
// var  day1 = strtotime('-7 day', time());
        var year = dtToday.getFullYear();
        if(month < 10)
        	month = '0' + month.toString();
        if(day < 10)
        	day = '0' + day.toString();
        if(day1 < 10)
        	day1='0'+day1.toString();


        var m = year + '-' + month + '-' + day1;       
        var maxDate = year + '-' + month + '-' + day;
//   $('#date').attr('min', m);
 // $('#date').attr('min', m);
$('#date').attr('max', maxDate);

}
);
</script>
<script>
	function showsub(str) {
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

		xmlhttp.open("GET","getDate1.php?id="+str,true);
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
          // show();
      }



  } catch(err){}

}
}


}




$(document).on('click', '.datepicker .table-condensed .day', function(event) {
  // event.preventDefault();
  console.log('changed');
  // show();
});

$(document).on('change', '.mydate', function(event) {
  // event.preventDefault();
  console.log('changed');
  // show();
});



$(document).on('change', '#subject', function(event) {
	$this = $(this);
    // showDate($this.val());
    // console.log($this.val());
    
});


function getbatch(str) {
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

		}
	} 
	show();
}


function show() {

	$('#attendance').css('display', 'none');

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

	var rSub = e.options[e.selectedIndex].value;


	var date = document.getElementById("date").value;

	xmlhttp.open("GET","show_attendance.php?class="+subject+"&date="+date+"&subject="+rSub,true);
	xmlhttp.send();

	xmlhttp.onreadystatechange=function() 
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{ 
			document.getElementById("attendance").innerHTML=xmlhttp.responseText;

			$('#attendance').css('display', 'block');
		}
	}
}




$(document).ready(function() {

	$(document).on('submit', '#doSubmitAtt', function(event) {
		event.preventDefault();
		$this = $(this);
		$table = $this.find('table');

		$script = ` <table class="table table-bordered table-hover" style="width: 100%; text-align: center;">
		<thead>
		<th>Roll No</th>
		<th>Name</th>
		</thead>
		<tbody> `;
		$fd =0;
		$table.find('tr').each(function(index, el) {
			if($(this).find("input[type='checkbox']").prop('checked')==false) {
				$rollNo = $(this).find('td:nth-child(1)').text();
				$name = $(this).find('td:nth-child(2)').text();

				$script = $script + ` 

				<tr>
				<td>${$rollNo}</td>
				<td>${$name}</td>
				</tr>
				`;


				$fd++;
			}
		});
		$script = $script + ` </tbody>
		</table> `;

		if($fd == 0 ) {
			$script = ` <div class="alert alert-success" style="text-align: center; width: 100%;"> <p>no absent marked</p> </div> `;
		} 
		$('#myModal .modal-body').html( $script );

		$('#myModal').modal('show');


		return false;

	});

	$(document).on('click', '#saveMeNow', function(event) {
		event.preventDefault();
		$('#doSubmitAttConf').html( $('#doSubmitAtt').html() ); 
		$('#doSubmitAttConf').attr( "action", $('#doSubmitAtt').attr('action') ); 
		$('#doSubmitAtt table').find('tr').each(function(index, el) {
			$fggdf = true;
			$id = $(this).find("input[type='checkbox']").attr('name');
			if($(this).find("input[type='checkbox']").prop('checked')==false) {
				$fggdf = false; 
			} 
			$('#doSubmitAttConf input[type="checkbox"][name="'+$id+'"]').prop('checked', $fggdf); 

		}); 
		$('#doSubmitAttConf').find('input[type="submit"]').click(); 
		$('#myModal').modal('hide');

	});



});




</script>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="color: red;">confirm list of absent students </h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<form name="form1" method="post" action="elective_action.php" id="doSubmitAttConf" style="display: none;"> </form>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="saveMeNow"  >SAVE</button>
			</div>
		</div>

	</div>
</div>
<!--<script>
function validate()
{
   var s1 = document.getElementById('class').value;
  // var s2 = document.getElementById('type').value;
   if(s1=="select"){
   		alert("Please select class");
		return false;
	}
	
	//if(s2=="--select--"){
   		//alert("Please select type");
		//return false;
	//}
	else
	return true;
}

</script>
-->

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





	function validate(form) {
		valid  = true;


		/*$ty = $('#hoursMe').val();
		if($ty == null){  
			alert('select a valid hour !');
			valid  = false;
		}*/



              if ($("input:checkbox[name='check_list[]']").length > 0) {
                               arrE11 = [];
                         $("input:checkbox[name='check_list[]']:checked").each(function(){
				arrE11.push($(this).val());
			});


				if(arrE11.length < 1){
				alert('select an Hour !');
				valid  = false;
			} 
			}


		if ($("input:checkbox[name='batch[]']").length > 0) {
			arrE = [];
			$("input:checkbox[name='batch[]']:checked").each(function(){
				arrE.push($(this).val());
			});
			if(arrE.length < 1){
				alert('select a Batch !!');
				valid  = false;
			} 

		} 
		if(!valid) {
			return false;
		}
		return confirm('Do you really want to enter attendance?');

	}

</script>



</head>
<body>
	<table class="table table-hover table-bordered">
		<tr>
			<td width="40%" valign="top">


				<form method="post" enctype="multipart/form-data" action="hos_att.php"  onsubmit="return validate(this);">
					<table class="table table-hover table-bordered" >

						<tr>
							<td> <label> Class</label></td>  
							<td class="row">  
								<div class="col-sm-12" style="padding: 0 1px;">
									<select name="class" id="class" onChange="showsub(this.value)" class="form-control ">
										<option>select</option>
										<?php
//error_reporting(0);
										$c=mysqli_query($con3,"select distinct(classid) from subject_allocation where fid='$uname'");

										while($res=mysqli_fetch_array($c))
										{
											$res1=mysqli_query($con3,"select * from class_details where classid='$res[classid]' and active='YES'");
											echo "select * from class_details where classid='$res[classid]' and active='YES'";
											echo $res[classid];
											while($rs=mysqli_fetch_array($res1))
											{
												?><?php echo $res[classid];?>
												<option  value="<?php echo $rs['classid'].','.$rs['courseid'].',S'.$rs['semid'].','.$rs['branch_or_specialisation'];?>">
													<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
													<?php
												}
											}
											?>
										</select> 
									</div>
              <!--   <div class="col-sm-4" style="padding: 0; text-align: right;">
                  <input type="button" name="button" id="button" value="Show" disabled="disabled" class="btn btn-primary " />

              </div> -->
          </td>
      </tr>

      <tr><td><label>Subject</label></td> 
      	<td><div id="sub">
      		<select name="sub"  id="subChange"  class="form-control">
      			<option>select</option>
      		</select></div></td></tr>
      		<tr>
      			<td><label>Batch</label> </td>
      			<td><div id="batch">
      			</div>
      		</td>
      	</tr>

      	<tr>
      		<td><label> Date</label></td>
      		<td id="pdate">




      			<!-- <input type="date" name="date" id="date" class="form-control"  placehodler="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" />   -->

      		</td>
      	</tr>


      	<tr>
      		<td><label>Hour</label></td>
      		<td>

    <input type="checkbox" name="check_list[]" value="1">1<br>
    <input type="checkbox" name="check_list[]" value="2">2<br>

    <input type="checkbox" name="check_list[]" value="3">3<br>

    <input type="checkbox" name="check_list[]" value="4">4<br>

    <input type="checkbox" name="check_list[]" value="5">5<br>

    <input type="checkbox" name="check_list[]" value="6">6<br>




                       <!--  <select required name="hour" id="hoursMe"  class="form-control">
      			<option value="">select</option>
      			<option value="1"  <?php if(isset($_POST['hour'])) if($_POST['hour'] == '1') echo ' selected ';  ?>>1</option>
      			<option value="2"  <?php if(isset($_POST['hour'])) if($_POST['hour'] == '2') echo ' selected ';  ?>>2</option>
      			<option value="3"  <?php if(isset($_POST['hour'])) if($_POST['hour'] == '3') echo ' selected ';  ?>>3</option>
      			<option value="4"  <?php if(isset($_POST['hour'])) if($_POST['hour'] == '4') echo ' selected ';  ?>>4</option>
      			<option value="5"  <?php if(isset($_POST['hour'])) if($_POST['hour'] == '5') echo ' selected ';  ?>>5</option>
      			<option value="6"  <?php if(isset($_POST['hour'])) if($_POST['hour'] == '6') echo ' selected ';  ?>>6</option>
      		</select>
      		<div id="hour"></div> -->
      	</td>
      </tr>
      <tr>
      	<td></td>
      	<td><input type="submit" name="btnshow"  id="btnshow" action="hos_att.php" value="Enter Attendence" disabled="disabled" class="btn btn-primary" />  </td></tr> 
      </table>
  </form>

  <div style="margin-top:1rem ; ">

  	<?php if( isset($_POST['class'])): ?>
  		<div class="row">
  			<div class="col-sm-4 " style="text-align: right;">
  				<b> Class : </b>
  			</div>
  			<div class="col-sm-8" style="text-align: left;">
  				<?php echo $_POST['class']; ?>
  			</div>
  		</div>
  	<?php endif; ?>

  	<?php if( isset($_POST['sub'])): ?>
  		<div class="row">
  			<div class="col-sm-4 " style="text-align: right;">
  				<b> Subject : </b>
  			</div>
  			<div class="col-sm-8" style="text-align: left;">
  				<?php echo $_POST['sub']; ?>
  			</div>
  		</div>
  	<?php endif; ?>

  	<?php if( isset($_POST['batch'])): ?>
  		<div class="row">
  			<div class="col-sm-4 " style="text-align: right;">
  				<b> Batch : </b>
  			</div>
  			<div class="col-sm-8" style="text-align: left;">
  				<?php foreach ($_POST['batch'] as $key => $value) {
  					if($key !=0 )
  						echo ", ";

  					$re74=mysqli_query($con3,"select * from lab_batch where batch_id='$value'  ");
  					if(($rs0=mysqli_fetch_array($re74))) { echo $rs0['batch_name']; }
  					

  				}?>

  			</div>
  		</div>
  	<?php endif; ?>

  	<?php if( isset($_POST['date'])): ?>
  		<div class="row">
  			<div class="col-sm-4 " style="text-align: right;">
  				<b> Date : </b>
  			</div>
  			<div class="col-sm-8" style="text-align: left;">
  				<?php echo $_POST['date']; ?>
  			</div>
  		</div>
  	<?php endif; ?>

  	<?php if( isset($_POST['hour'])): ?>
  		<div class="row">
  			<div class="col-sm-4 " style="text-align: right;">
  				<b> Hour : </b>
  			</div>
  			<div class="col-sm-8" style="text-align: left;">
  				<?php echo $_POST['hour']; ?>
  			</div>
  		</div>
  	<?php endif; ?>


  	<?php if( isset($_POST['class'])): ?>

  	<?php endif; ?>


  </div>

  <?php

  if(isset($_POST["btnshow"]))
  	{      


 $a=explode(",",$_POST['class']);
  $b=explode("-",$_POST['sub']);
        //echo "dfsasdfdf$b[0]";
       // echo "select * from subject_class where subjectid='$b[0]'";
  $re7=mysqli_query($con3,"select * from subject_class where subjectid='$b[0]' and classid='$a[0]'");
  while(($rs0=mysqli_fetch_array($re7)))
  {
  	$ty1=$rs0['type'];
  }
  $c=$_POST["date"];
  $x=0;


       foreach($_POST['check_list'] as $check) {
	//$d=$_POST["hour"];//echo $d;

          $d=$check;
          
        //echo "select * from attendance where date='$c' and hour='$d'";
       // echo "select hour,subjectid from attendance where date='$c' and hour='$d'  ";
	$res=  mysqli_query($con3,"select hour,subjectid from attendance where date='$c' and hour='$d' and classid='$a[0]' ");
	while(($rs=mysqli_fetch_array($res)))
	{
		$ho=$rs["hour"];
		$sub=$rs["subjectid"];
               // echo ".............$sub";
		$re4=mysqli_query($con3,"select type from subject_class where subjectid='$sub' and classid='$a[0]'");
		while(($rs1=mysqli_fetch_array($re4)))
		{
			$ty=$rs1['type'];

                   // echo "$ty.....................";
		}

               // echo $ho;
		if($ho==$d )
		{ 
			$x=1;

                    //echo "$ty .......$ty1";
                   // echo "sfadfgsghdjtyjut$x";
			if( $ty==$ty1 )
				{  $x=0;
					if($ty1=='CORE')
						$x=1;
					else  if($ty1=='LAB'){
						$batch="";
						$i = 0;
						foreach($_POST['batch'] as $selected){
							if($i==0)
								$batch=$selected;
							else
								$batch.=",".$selected;
							$i++;
						} 


						$x=0;
						$re4=mysqli_query($con3," SELECT * FROM  attendance a  LEFT JOIN   `lab_batch` l   ON l.sub_code = a.subjectid   LEFT JOIN  lab_batch_student s  ON s.batch_id = l.batch_id WHERE s.studid = a.studid AND a.subjectid = '".$b[0]."' AND l.batch_id IN  (".$batch.")  AND  a.date='$c' and a.hour='$d' and a.classid='$a[0]'  ");
						while(($rs1=mysqli_fetch_array($re4))) {

							$x=1;
                   // echo "$ty.....................";
						}


					}
					else if($sub==$b[0]){
						$x=1;

					}
                     //if( $ty1=='CORE' && $ty=='CORE')
                       //   $x=1;
				}
			} 
		}

// echo "sadfasdg$x";       
		if($x==0)
			{	$sub=explode("-",$_POST["sub"]);
		if($sub[1]=="ELECTIVE")
		{
			include_once("elective.php");
		}
		else if($sub[1]=="LAB")
		{
			include_once("lab.php");
		}
		else
		{
			include_once("core.php");
		}
	}
	else 
		{       ?>     <script>
			alert("Data Exist");
//		window.location="hos.php";
</script>
<?php

}

}



}
?>    




</td>
<td valign="top">

	<div id="attendance" style="display: none;">


		<table class="table table-hover table-bordered">
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
<!-- <table><tr><a href="home.php"><button>Back</button></a></tr></table>-->

</div>

<br />
<br />
<br />


</div>              



</body>

</html>
<?php include("includes/footer.php");   ?>



