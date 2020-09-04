<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection3.php");
ob_start();
$st=$_SESSION['fid'];


$se = true;
?>




<style type="text/css">
table
{
	border-collapse:collapse;
}
table,table tr,table th,table td
{
	text-align: center;
	vertical-align:middle !important;
}
.tablecolred
{
	background-color:rgba(255,0,0,0.4);
}
.tablecolgreen
{
	background-color:rgba(0,255,0,0.4);
}
.tablecolgrey
{
	background-color:rgba(0,0,0,0.4);
}
.tableborder *
{
	border-color:#000000 !important;
}
table.result th,table.result td
{
	outline:1px solid #000000;
}
tr.head th
{
	position:sticky;
	top:0;
	background-color:#FFFFFF;
	z-index:10;
}
table.result tr td:nth-child(3)
{
	position:sticky;
	left:0;
	background-color:#FFFFFF;
	z-index:5;
}
th#cenhead
{
	position:sticky !important;
	top:0;
	left:0;
	background-color:#FFFFFF;
	z-index:15;
}
</style>


<div id="page-wrapper">



	<div class="row">
		<div  class="col-sm-12">



			<script type="text/javascript">
				if(typeof jQuery == 'undefined'){
					document.write('<script src="../dash/vendor/jquery/jquery.min.js"></'+'script>');
				}
			</script>
			<script>
				function getbatch(x)
				{
					return;
				}
				function showsub(str)
				{
					var xmlhttp;
					if(window.XMLHttpRequest)
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
						}
					}
				}
				function showDate ( str)
				{

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


</script>














<link href="jquery-ui.css" rel="stylesheet">
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-ui.js" type="text/javascript"></script>
<script>
	$(document).ready(function()
	{
		var dtToday = new Date();
  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
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


});
	});

</script>




<div class=" " align="center">

	<div class=" " style="text-align:center">
		<form method="post" enctype="multipart/form-data" action=""><br><br><br>
			<h2>View Attendance</h2>

			<table align="center" width="700" class="table table-hover table-bordered">

				<tr><td style="vertical-align:middle;"><label>Class</label></td><td>
					<select name="class" class="form-control" onChange="showsub(this.value)">
						<option>select</option>
						<?php
						$c=mysqli_query($con3,"select distinct(classid) from subject_allocation where fid='$st'");

						while($res=mysqli_fetch_array($c))
						{
							$res1=mysqli_query($con3,"select * from class_details where classid='$res[classid]' and active='YES'");
							while($rs=mysqli_fetch_array($res1))
							{
								?>
								<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>" >
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
					<tr>
						<td style="vertical-align:middle;"><label>Start Date</label> </td>

	              <td>
									<?php
									echo '<div class="input-group date" data-provide="datepicker">'.
									' <input type="text" class="form-control mydate datepicker-autoclose"  value="';
									if(isset($_POST['sdate']) && !empty($_POST['sdate']))
									echo $_POST['sdate'];
									else
									echo date("Y-m-d");
									echo '"  id="date"   name="sdate" placeholder="Date " required >'.
									'<div class="input-group-addon">'.
									'<span class="fa fa-calendar"></span>'.
									'</div>'.
									'</div>';
									?>
						</td>
					</tr>
					<tr id="batchP">
						<td style="vertical-align:middle;"><label>End Date</label> </td>
	              <td>
									<?php
									echo '<div class="input-group date" data-provide="datepicker">'.
									' <input type="text" class="form-control mydate datepicker-autoclose"  value="';
									if(isset($_POST['edate']) && !empty($_POST['edate']))
									echo $_POST['edate'];
									else
									echo date("Y-m-d");
									echo '"  id="date"   name="edate" placeholder="Date " required >'.
									'<div class="input-group-addon">'.
									'<span class="fa fa-calendar"></span>'.
									'</div>'.
									'</div>';
									?>
						</td>
					</tr>


				</table>

	<input type="submit" name="btnshow"  value="View Attendance" class="btn btn-primary" /><br><br><br>

</form>





</div>
</div>


<?php
if(isset($_POST['btnshow']))
{
	$class=explode(",",$_POST['class']);
	$classid = $class[0];
	$sub="";
	if(isset($_POST['sub']))
	{
		$sub=explode("-",$_POST['sub'])[0];
	}
	?>
<center>
	<input type="button" value="Download Excel" class="btn btn-primary" onclick="window.open('attendance_report.php?classid=<?php echo $classid; ?>&sub=<?php echo $sub; ?>&sdate=<?php echo $_POST['sdate']; ?>&edate=<?php echo $_POST['edate']; ?>','_blank');"/>
</center>
<div class="row">
	<div  class="col-sm-12">
		<h1>Attendance Status</h1>

		<div class="" style="margin-top: 3rem;">


			<table border="1" class="table tableborder result">
				<thead></thead>
				<tbody>
					<tr class="head">
						<th>Roll no</th>
						<th>Admission no</th>
						<th id="cenhead">Student</th>
						<?php
						$sdate=$_POST['sdate'];
						$edate=$_POST['edate'];
						$c=mysqli_query($con3,"SELECT distinct date,hour FROM attendance WHERE classid='".$classid."' and subjectid='".$sub."' and date between '".$sdate."' and '".$edate."' order by date,hour;");
						$harray=array();
						while($res=mysqli_fetch_array($c))
						{
							$harray[$res[0].";".$res[1]]=$res[1];
						}
						foreach($harray as $date => $hour)
						{
							$date=explode(";",$date)[0];
							echo "<th style='min-width:100px;'>".date("d / M / Y ( D )",strtotime($date))."<br>[ ".$hour."<sup>";
							if($hour==1)
							{
								echo "st";
							}
							else if($hour==2)
							{
								echo "nd";
							}
							else if($hour==3)
							{
								echo "rd";
							}
							else
							{
								echo "th";
							}
							echo "</sup> hour ]</th>";
						}
						?>
					</tr>
						<?php
							class attendance
							{
								public $name="";
								public $rollno="";
								public $att=array();
								function __construct($rollno,$name)
								{
									$this->name=$name;
									$this->rollno=$rollno;
								}
								function setAttendance($datehour,$status)
								{
									$this->att[$datehour]=$status;
								}
								function getAttendance($date)
								{
									if(array_key_exists($date,$this->att))
									{
										$value=$this->att[$date];
										if($value=="P")
										{
											return array("tablecolgreen","P");
										}
										if($value=="A")
										{
											return array("tablecolred","A");
										}
									}
									return array("tablecolgrey","-");
								}
							}
							$qr="SELECT C.rollno,S.admissionno as stdid,S.name FROM stud_details as S left join current_class as C on S.admissionno=C.studid where C.classid='".$classid."' order by C.rollno;";
							$cy=mysqli_query($con3,$qr);
							$studlist=array();
							while($resb=mysqli_fetch_assoc($cy))
							{
								$studlist[$resb['stdid']]=new attendance($resb['rollno'],$resb['name']);
							}
							foreach($harray as $xdate => $hr)
							{
								$xdate=explode(";",$xdate)[0];
								$qr="SELECT hour,studid,status FROM attendance where classid='".$classid."' and date='".$xdate."' order by studid,hour asc;";
								$cz=mysqli_query($con3,$qr);
								while($resc=mysqli_fetch_assoc($cz))
								{
									if(array_key_exists($resc['studid'],$studlist))
									$studlist[$resc['studid']]->setAttendance($xdate.":".$hr,$resc['status']);
								}
							}
							foreach($studlist as $id => $student)
							{
								echo "<tr>";
								echo "<td style='font-family:sans-serif;'>".$student->rollno."</td>";
								echo "<td>".$id."</td>";
								echo "<td>".$student->name."</td>";
								foreach($harray as $date => $hour)
								{
									$date=explode(";",$date)[0];
									$x=$student->getAttendance($date.":".$hour);
									echo "<td class='$x[0]'>".$x[1]."</td>";
								}
								echo "</tr>";
							}
						?>



	</tbody>
</table>
</div>
</div>
</div>



<?php
}
?>


</div>



<?php include("includes/footer.php");   ?>
