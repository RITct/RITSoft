<?php
include("includes/header.php");
include("includes/sidenav.php");

$classid=$_SESSION["classid"];
include("../connection.mysqli.php");
//session_start();
$st=$_SESSION['fid'];
//echo $st;
?>
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


	function showsub(str) {
		showDate ( str) ;
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

		<?php if(isset($_POST['date1']) && isset($_POST['date2']) ): ?>

		$('#date1').datepicker('update', '<?php echo $_POST['date1']; ?>');
		$('#date2').datepicker('update', '<?php echo $_POST['date2']; ?>'); 
	<?php  endif; ?> 

};



$(document).ready(function($) {

	<?php if(isset($_POST['class']) ): ?> 
		showsub( $('#class').val() ); 
	<?php  endif; ?> 

});


</script>


<div id="page-wrapper">
	<form  id="form1" name="form1" method="post" enctype="multipart/form-data"> 
		<label for="course">Class </label>
		<select name="class" id="class" onChange="showsub(this.value)"  class="form-control">
			<option selected="selected" disabled="disabled">select</option>
			<?php
			$res=mysqli_query($con3,"select * from staff_advisor where fid='$st' and classid='$classid'");
			while($rs=mysqli_fetch_array($res))
			{
				$res1=mysqli_query($con3,"select *from class_details where classid='$rs[classid]' and active='YES'");
				while($rs1=mysqli_fetch_array($res1))
				{

					$se = "";
					if(isset($_POST['class']))
						if($_POST['class'] == $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'].",".$rs['students_list'] )
							$se = " selected='selected' ";


						?>
						<option <?php echo $se ; ?> value="<?php echo $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'].",".$rs['students_list'];?>">
							<?php echo $rs1['courseid'];?>,S<?php echo $rs1['semid'];?>,<?php echo $rs1['branch_or_specialisation'];?></option>

							<?php
							$bs=$rs1['branch_or_specialisation'];
							$dept=$rs1['deptname'];
							$cid=$rs1['courseid'];

						}
					}
					?>
				</select><label>From Date</label>  


				<div id="pdate"> 

					<!--<input type="date" name="date1" id="date1" class="form-control"required />  -->

				</div> 

				<br/>
				<label>To Date</label> 
				<div id="datex2"  style="display: none;">


					<!--   <input type="date" name="date2" id="date2" class="form-control" required />"   -->
				</div>


				<br/>
				<input type="submit"  name="btnshow" value="submit"  class="btn btn-primary"/><br/>
			</form>
			<?php
			if(isset($_POST["btnshow"]))
			{
				$class=explode(",",$_POST['class']);
				$date1=$_POST["date1"];
				$date2=$_POST["date2"];	
	//print_r($class);
				$student=explode("-",$class[4]);
				$semester=$class[2];


				?>
				<table class="table table-hover table-bordered" >
					&nbsp;
					&nbsp;
					&nbsp;
					&nbsp;                       

					<tr>
						<th>Leave Date</th>
						<th>Hour</th>
						<th>Admission NO</th>
						<th>Roll No</th>
						<th>Name</th> 
						<th>Remark</th>
						<th>Added on</th>
					</tr>
					<?php
					$j=$student[0];
					$k=$student[1];
					while($j<=$k)
					{ 

		//$res2=mysqli_query($con3,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and c.rollno='$j' order by c.rollno asc");
					 	$res2=mysqli_query($con3,"SELECT *,  DATE_FORMAT(date, '%D %M,%Y %r' ) AS date  FROM `duty_leave` d LEFT JOIN stud_details s ON s.admissionno = d.studid LEFT JOIN current_class c ON c.studid = d.studid  where c.classid='$class[0]'  and c.rollno='$j' order by c.rollno asc");

				 	while($rs2=mysqli_fetch_array($res2))
						{  
							$_SESSION['admis']=$rs2["studid"];
							$admis=$_SESSION['admis'];
							$name=$rs2["name"];

							$i=1;
							$sid=$rs2["rollno"];
							?>           
							<tr>
								<td> <?php echo $rs2["leave_date"]; ?></td>
								<td> <?php echo $rs2["hour"]; ?></td>
								<td><?php echo $rs2["admissionno"]; ?></td>
								<td><?php echo $rs2["rollno"]; ?></td>
								<td><?php echo $rs2["name"]; ?></td> 
								<td><?php  echo $rs2['remark']; ?> </td>
								<td><?php  echo $rs2['date']; ?> </td>
							</tr>
							<?php
						}
						$j++;
					}
					?>

				</table><br/>
				<table align="center">    &nbsp;
					&nbsp;
					&nbsp;
					&nbsp;
					&nbsp;                       

					<tr>

					</tr>
				</table>
				<a target="_blank" href="staff_advisor_xlL.php?j=<?php echo $student[0]; ?>&k=<?php echo $student[1]; ?>&cls=<?php echo $class[0]; ?>&e=<?php echo $date1; ?>&f=<?php echo $date2; ?>">Export Excel</a>&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="staff_advisor_view_pdfL.php?j=<?php echo $student[0]; ?>&cid=<?php echo $cid; ?>&k=<?php echo $student[1]; ?>&bs=<?php echo $bs; ?>&dept=<?php echo $dept; ?>&d=<?php echo $semester; ?>&cls=<?php echo $class[0]; ?>&e=<?php echo $date1; ?>&f=<?php echo $date2; ?>">Print PDF</a><br/>

			 
<div class="row" style="margin: 2rem;"> 
	
</div>


				<?php
			}
			?>
		</div>
		<?php include("includes/footer.php");   ?>
