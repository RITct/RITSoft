<?php
/**
 * @Author: indran
 * @Date:   2018-10-24 14:53:19
 * @Last Modified by:   indran
 * @Last Modified time: 2018-10-25 12:57:56
 */ 
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/header.php");
include("includes/sidenav.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/connection3.php");

//session_start();
//$bs="";
//$c="";
//$s="";
//$e="";
//$sub_t="";
//$class="";
//$date1="";
//$date2="";
$st=$_SESSION['fid'];


$se = true;
?>




<style type="text/css">
.ttable-09 th, .ttable-09 td {
	text-align: center;
}
</style>


<div id="page-wrapper">


	<?php




	$subjects = array();


$result=mysqli_query($con3,"select * from subject_allocation where fid='$st'");//order by subjectid asc");

if(mysqli_num_rows($result ) > 0)
	while($each_result=mysqli_fetch_array($result)) { 
		array_push($subjects, array( 'subject' => $each_result['subjectid'] , 'class' => $each_result['classid'] ));   
	}




	?>


	<div class="row">
		<div  class="col-sm-12">



			<script type="text/javascript"> 
				if(typeof jQuery == 'undefined'){
					document.write('<script src="../dash/vendor/jquery/jquery.min.js"></'+'script>');
				}
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
							showDate ( str) ;
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

					xmlhttp.open("GET","getDate.php?id="+str,true);
					xmlhttp.send();

					xmlhttp.onreadystatechange=function() 
					{
						if(xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							document.getElementById("pdate").innerHTML=xmlhttp.responseText; 


							$('#date').attr('id', 'date1');
							$('#date1').attr('name', 'date1'); 


							try { 


								jQuery(document).ready(function($) {

          // $.fn.datepicker.defaults.format = "yyyy-mm-dd";
          $('.date').datepicker({
          	format: 'yyyy-mm-dd' ,
          	autoclose: true
          }).on('changeDate', function (ev) {   
          	console.log("f");
          	doSomeOther();
          });

      });





								if(xmlhttp.responseText.trim().length > 0 ) {
									$('#hoursMe').css('display', 'block');

								}


								doSomeOther();
							} catch(err){}

						}
					}


				}


				var doSomeOther = ( ) =>  { 
					$('#datex2').css('display', 'none');
					$dateStaRT = $('.mydate').val();
					$date = $('.mydate').closest('.date').attr('data-date-end-date');





					$strTo = '<div class="input-group date " data-provide="datepicker"   data-date-start-date="'+$dateStaRT+'" data-date-end-date ="'+$date+'" >'+
					' <input type="text" class="form-control mydate datepicker-autoclose"  value="'+ $dateStaRT+'"  id="date2"   name="date2" placeholder="Date " required >'+
					'<div class="input-group-addon">'+
					'<span class="fa fa-calendar"></span>'+
					'</div>';

					$('#datex2').html($strTo);



					$('#datex2').css('display', 'block');

				};



				console.log('doSomeOther');
// $(document).on('change', '.mydate', function(event) {
//   // event.preventDefault();
//   console.log('doSomeOther');
//   doSomeOther();
// });


</script>














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

        $('#date1').attr('max', maxDate);
        $('#date2').attr('max', maxDate);
    }
    );

	function getbatch(str) {

		$('#batchP').css('display', 'none');
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","getbatch_drop.php?id="+str,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function() 
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				if( (xmlhttp.responseText+"").trim().length > 0)
					$('#batchP').css('display', 'table-row');
				document.getElementById("batch").innerHTML=xmlhttp.responseText;

			}
		}  
	}




	$(document).ready(function($) {
		$('.doShowDetails').attr("disabled","false");

		$(document).on('click', '.doShowDetails', function(event) {
			event.preventDefault();
			search = $(this).attr('href'); 


			$.ajax({url: search, success: function(result){ 
				$('#myModal .modal-body').html( result ); 
			}});
			$('#myModal .modal-body').html( `

				<div style="width: 100%; text-align: center; padding: 1rem;">
				<img src="../images/loading-bar.gif">
				</div>

				` ); 
			$('#myModal').modal('show');

    // console.log(search);
    // search =  JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')
    // console.log(search);



});
	});

</script>




<div class=" " align="center">

	<div class=" " style="text-align:center">
		<form method="post" enctype="multipart/form-data" action=""><br><br><br>
			<h2>View Attendance</h2>

			<table  align="center" width="700" class="table table-hover table-bordered">

				<tr><td><label>
				Class</label></td><td>
					<select name="class" onChange="showsub(this.value)" class="form-control">
						<option>select</option>
						<?php
						$c=mysqli_query($con3,"select distinct(classid) from subject_allocation where fid='$st'");

						while($res=mysqli_fetch_array($c))
						{
							$res1=mysqli_query($con3,"select *from class_details where classid='$res[classid]' and active='YES'");
							while($rs=mysqli_fetch_array($res1))
							{
								?>
								<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
									<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
									<?php       $dept=$rs['deptname'];
									$cid=$rs['courseid'];
									$bs=$rs['branch_or_specialisation'];
								}
							}
							?>
						</select>

					</td></tr>
					<tr><td><label>Subject</label> </td> <td><div id="sub">
						<select name="sub" class="form-control">
							<option>select</option>
						</select></td>
					</tr>
					<tr id="batchP" style="display: none;">
						<td><label>Batch</label> </td>
						<td>
							<div id="batch"></div>
						</td>
					</tr>


				</table>
<!--<input type="date" name="date1" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />
	<input type="date" name="date2" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />-->
	<input type="submit" name="btnshow"  value="View Attendance" class="btn btn-primary" />
	&nbsp;
	&nbsp;
	&nbsp;
	&nbsp;
	<!--input type="submit" name="submit" value="print"  /> -->
</form>





</div>
</div>


<?php if( isset($_POST['btnshow'])): ?>



	<?php 

	$class=explode(",",$_POST['class']);
	$s=explode("-",$_POST['sub']);

	$classid = $class[0];
	$subjectid = $s[0];


	?>




	<table class="table table-bordered" style="margin-top: 2rem;">




		<?php if( isset($_POST['class'])){ 
			$class1=explode(",",$_POST['class']);?>

			<tr>
				<td  >
					<b> Class : </b>
				</td>
				<td  >
        <?php //echo $_POST['class'];
        echo $class1[1]." ".$class1[2]; 
        ?>
    </td>
</tr>
<?php } ?>

  <?php if( isset($_POST['sub'])):// $s1=explode("-",$_POST['sub']);
  ?>
  <tr>
  	<td  >
  		<b> Subject : </b>
  	</td>
  	<td  >
  		<?php  

  		$res=mysqli_query($con3,"SELECT * FROM subject_class WHERE subjectid ='".explode('-', $_POST['sub'])[0]."' ");

  		if(mysqli_num_rows($res) > 0){
  			while($rs=mysqli_fetch_array($res)) {  

  				echo $rs["subject_title"];   
  			}
  		}
  		?>
  		<sub>
  			<?php


  			echo $_POST['sub']; ?>
  		</sub>
  	</td>
  </tr>
<?php endif; ?>

<?php  if( isset($_POST['batch'])): ?>
	<tr>
		<td >
			<b> Batch : </b>
		</td>
		<td >
			<?php 

			foreach ($_POST['batch'] as $key => $value) {
				if($key !=0 )
					echo ", ";

				$re74=mysqli_query($con3,"select * from lab_batch where batch_id='$value'  ");
				if(($rs0=mysqli_fetch_array($re74))) { echo $rs0['batch_name'];
                                                     // $batch3=$rs0['batch_name'];
			}


		}?>

	</td>
</tr>
<?php endif; ?>

<?php if( isset($_POST['date'])): ?>
	<tr>
		<td  >
			<b> Date : </b>
		</td>
		<td  >
			<?php echo $_POST['date']; ?>
		</td>
	</tr>
<?php endif; ?>

<?php if( isset($_POST['hour'])): ?>
	<tr>
		<td >
			<b> Hour : </b>
		</td>
		<td >
			<?php echo $_POST['hour']; ?>
		</td>
	</tr>
<?php endif; ?>





</table>



<div class="row">
	<div  class="col-sm-12">
		<h1>Attendance Status</h1>

		<div class="" style="margin-top: 3rem;">


			<table style="text-align: center;" class="table table-bordered ttable-09">
				<thead></thead>
				<tbody>
					<tr>
						<th rowspan="2">Date</th>
						<th colspan="6">Hour</th>
					</tr>
					<tr> 
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
					</tr>




					<?php 

					$classids = '';

					foreach ($subjects as $key => $value) {
						if($classids != '')
							$classids .= ',';
						$classids .= "'".$value['class']."'";
					}


					$subjectsa = '';

					foreach ($subjects as $key => $value) {
						if($subjectsa != '')
							$subjectsa .= ',';
						$subjectsa .= "'".$value['subject']."'";
					}

						$result=mysqli_query($con3,"select * from attendance where  classid = '$classid' AND subjectid = '$subjectid'  ORDER BY date ASC LIMIT 1 ");//order by subjectid asc");
						$startDate = null;
						if(mysqli_num_rows($result ) > 0)
							while($rs3=mysqli_fetch_array($result)) {
								$startDate = $rs3['date'];
							}




							if( $startDate) { 
								while ( strtotime($startDate) <= strtotime(date('Y-m-d'))) {  
									?>


									<tr> 
										<th><?php echo $startDate; 
										$nouda = date('w', strtotime($startDate));
										echo " <sub style='color: #453232 ;'>" . date('D', strtotime("Sunday +{$nouda} days")) . "</sub>";

										?></th>


										<?php 
										for ($fu=1; $fu <= 6; $fu++) { 

											$finalEx = "";
						$resulta=mysqli_query($con3,"select * from attendance where hour = $fu AND date = '$startDate'  AND subjectid  = '$subjectid' GROUP BY (  studid ) ORDER BY date ASC   ");//order by subjectid asc");

						if(mysqli_num_rows($resulta ) > 0){
							$subj = "";

							while($rs3=mysqli_fetch_array($resulta)) {
								


								$reshrtr=mysqli_query($con3,"SELECT * FROM subject_class WHERE subjectid ='".$rs3['subjectid']."' LIMIT 1 ");

								if(mysqli_num_rows($reshrtr) > 0){
									while($rssd=mysqli_fetch_array($reshrtr)) {  

										$subj = $rssd["subject_title"];   
									}
								}
								$subj =  $subj . "  - ". $rs3['subjectid'];



							}

							$finalEx  = '<td  style="background: #00ff09a6; " title="'.$subj.'" ><i class="fa fa-thumbs-o-up" stitle="attendance added"  tyle="color: green;"></i></td>';
						} else {
							$finalEx = ' <td  style="background: #898984; " title="attendance missing or different subjects"><i class="fa fa-thumbs-o-down"></i></td>';
						}


						?>

						<?php

						echo $finalEx ;
					} 
					?>


				</tr> 

				<?php






				$startDate = date('Y-m-d', strtotime($startDate. ' + 1 days')); 
			}
		}




				// $result=mysqli_query($con3,"select * from attendance where subjectid='$s[0]' and classid='$class[0]' and fid='$st' ");//order by subjectid asc");

				// if(mysqli_num_rows($result ) > 0)
				// 	while($rs3=mysqli_fetch_array($res3)) {

				// 	}
		?>



	</tbody>
</table>
</div>
</div>
</div>



<?php endif; ?>


</div>



<?php include("includes/footer.php");   ?>
