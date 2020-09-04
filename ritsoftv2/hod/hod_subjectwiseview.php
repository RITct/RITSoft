<?php
include("includes/header.php");
include("includes/sidenav.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/dbopen.php");
//session_start();
$st=$_SESSION['fid'];
//$class="";
//echo $st;
$date1="";
$date2="";
$c="";
$semester="";

$nomorris = false;
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



          // $.fn.datepicker.defaults.format = "yyyy-mm-dd";
          $('.date').datepicker({
          	format: 'yyyy-mm-dd' ,
          	autoclose: true
          }).on('changeDate', function (ev) {   
          	doSomeOther();
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



<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="">View details </h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<form name="form1" method="post" action="elective_action.php" id="doSubmitAttConf" style="display: none;"> </form>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
			</div>
		</div>

	</div>
</div>

<form method="post" class="form-group" enctype="multipart/form-data">

	<select name="class"  id="class" onChange="showsub(this.value)"   class="form-control">
		<option selected="selected" disabled="disabled">select</option>
		<?php
		$res=mysqli_query($con3,"select * from department where hod='$st'");

		if($rs=mysqli_fetch_array($res))
		{
			$res1=mysqli_query($con3,"select *from class_details where deptname='$rs[deptname]' and active='YES'");

			while($rs1=mysqli_fetch_array($res1))
			{ 

				$se = "";
				if(isset($_POST['class']))
					if($_POST['class'] ==   $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'])
						$se = " selected='selected' ";


					?>
					<option  <?php echo $se ; ?> value="<?php  $class=$rs1['classid']; echo $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'];?>">
						<?php echo $rs1['courseid'];?>,S<?php echo $rs1['semid'];?>,<?php echo $rs1['branch_or_specialisation'];?></option>
						<?php
						$bs=$rs1['branch_or_specialisation'];
						$dept=$rs1['deptname'];
						$cid=$rs1['courseid'];
					}
				}
				?>
			</select><br />
			<label>From Date</label>

			<div id="pdate"> 

				<!--<input type="date"  class="form-control"  name="date1" id="date1" placeholder="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" required />  -->

			</div> 
			<br />
			<label>To Date</label>

			<div id="datex2"  style="display: none;">


				<!--  <input type="date"  class="form-control" name="date2" id="date2" placeholder="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" required />  -->
			</div>

			<br />
			<input type="submit" name="btnshow" value="View Attendence"   class="btn btn-primary"/><br />
		</form>

		<?php
		if(isset($_POST["btnshow"]))
		{
			$class=explode(",",$_POST['class']);
			$c=$class[0];
			$date1=$_POST["date1"];
			$date2=$_POST["date2"];	
			$semester=$class[2];
    //echo "$semester  hvcghchch";
	//print_r($class);
//	$student=explode("-",$class[4]);

			?>
			<table class="table table-hover table-bordered" >


				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;                       


				<tr>
					<th>Roll No</th>
					<th>Name</th>
					<?php
					$res=mysqli_query($con3,"select * from subject_class where classid='$class[0]' order by subjectid asc");
					while($rs=mysqli_fetch_array($res))
					{
						?>
						<td><?php echo $rs["subjectid"]; ?></td>
						<!--<tr><td> <a href="attendance_search.php?date1=<?php // echo "$date1";?>&date2=<?php //echo "$date2";?>">View details </a></td></tr>-->
						<?php
					}
					?>
					<th>Total</th>
					<th>view</th>

					<?php
//	$j=$student[0];
	//$k=$student[1];
	//while($j<=$k)
//	{ 
					?><?php
//		$res2=mysqli_query($con3,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
					$res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$class[0]' and c.studid=b.admissionno order by c.rollno asc");

					while($rs2=mysqli_fetch_array($res2))
					{

						$_SESSION['admis']=$rs2["studid"];
						$admis=$_SESSION['admis'];
						$name=$rs2["name"];
						$i=1;
						$sid=$rs2["rollno"];
						?>         
						<tr>
							<td><?php echo $rs2["rollno"]; ?></td>
							<td><?php echo $rs2["name"]; ?></td>
							<?php
							$total=0;
							$present=0;
							$res3=mysqli_query($con3,"select * from subject_class where classid='$class[0]' order by subjectid asc");
							while($rs3=mysqli_fetch_array($res3))
							{

								$res4=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$class[0]' and ( status = 'P' OR status = 'A' )");
								$res5=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$class[0]' and status='P'");
								?>
								<td><?php 
								if(mysqli_num_rows($res4)==0){
									if( $rs3['type'] == 'ELECTIVE') {
										$tro ="SELECT * FROM elective_student WHERE sub_code = '$rs3[subjectid]' AND stud_id ='$rs2[studid]' ";
										$res49=mysqli_query($con3, $tro);
										if(mysqli_num_rows($res49)==0){
											echo '--';
										} else{
											echo "0%";
										}
									} else {
										echo "0%";
									}
								}
								else
									echo round(((mysqli_num_rows($res5)/mysqli_num_rows($res4))*100),2)."%"; ?></td>
								<?php
								$total+=mysqli_num_rows($res4);
								$present+=mysqli_num_rows($res5);						
							}
							?>
							<td><?php 
							if($total==0)
								echo "0%";
							else
				//$percentage = (($present/$total)*100);
				//echo number_format((float)$fpercentage, 2, '.', ''); 
				//echo (round($percentage));
								echo round((($present/$total)*100),2)."%"; ?></td>
							<td> <a  class="doShowDetails" disabled="disabled"  href="attendance_search.php?date1=<?php echo "$date1";?>&date2=<?php echo "$date2";?>&admis=<?php echo $admis;?>&name=<?php echo "$name"; ?>&class=<?php echo "$class[0]";  ?>">View details </a></td>

						</tr>
						<?php
					}
		//$j++;
				}
				?>
			</table>

			<?php

			?>

			<a target="_blank" href="hod_print_pdf_2.php?&cid=<?php echo $cid; ?>&a=<?php echo $c; ?>&bs=<?php echo $bs; ?>&dept=<?php echo $dept; ?>&d=<?php echo $semester; ?>&e=<?php echo $date1; ?>&f=<?php echo $date2; ?>">Print PDF</a><br />
			<a target="_blank" href="hod_xl.php?a=<?php echo $c; ?>&bs=<?php echo $bs; ?>&dept=<?php echo $dept; ?>&d=<?php echo $semester; ?>&e=<?php echo $date1; ?>&f=<?php echo $date2; ?>">Export to Excel</a>


		</table ><br />
		<table class="table table-hover table-bordered">
			<?php
//	$class=explode(",",$_REQUEST['class']);	
 //$class=explode(",",$_POST['class']);
			?>

			<tr> <th> SUBJECT ID </th> <th> SUBJECT NAME</th></tr>
			<?php
			$c=mysqli_query($con3,"select * from subject_class where classid='$class[0]' order by subjectid asc");
			while($re=mysqli_fetch_array($c))
			{
				?>
				<tr>

					<th><?php echo $re["subjectid"]; ?></th>
					<th><?php echo $re["subject_title"]; ?></th>
				</tr>
				<?php
			}
			?>
		</table>

	</div>
</div>
<?php  include("includes/footer.php");    ?>
