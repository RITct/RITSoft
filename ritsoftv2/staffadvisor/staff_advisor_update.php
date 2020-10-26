<?php
//$con=mysqli_connect("localhost","root","","ritsoft");
include("../connection.mysqli.php");
include("includes/header.php");
include("includes/sidenav.php");
$classid=$_SESSION["classid"];
//session_start();

$st=$_SESSION['fid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>staff advisor update</title>
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


			<?php if(isset($_POST['date'])  ): ?>

				$('#date').datepicker('update', '<?php echo $_POST['date']; ?>'); 
			<?php  endif; ?> 

		};



		$(document).ready(function($) {

			<?php if(isset($_POST['class']) ): ?> 
				showsub( $('#class').val() ); 
			<?php  endif; ?> 

		});



	</script>

</head>

<body>
	<div id="page-wrapper">
		<form method="post" enctype="multipart/form-data">


			<label for="cls">Class</label>	
			<select name="class" id="class" onChange="showsub(this.value)"    class="form-control">
				<option selected="selected" disabled="disabled">select</option>
				<?php
				$res=mysqli_query($con3,"select * from staff_advisor where fid='$st' and classid='$classid'");
				while($rs=mysqli_fetch_array($res))
				{
					$res1=mysqli_query($con3,"select * from class_details where classid='$rs[classid]' and active='YES'");
					while($rs1=mysqli_fetch_array($res1))
					{ 

						$se = "";
						if(isset($_POST['class']))
							if($_POST['class'] == $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'].",".$rs['students_list'] )
								$se = " selected='selected' ";


							?>
							<option <?php echo $se ; ?>   value="<?php echo $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'].",".$rs['students_list'];?>">
								<?php echo $rs1['courseid'];?>,S<?php echo $rs1['semid'];?>,<?php echo $rs1['branch_or_specialisation'];?></option>
								<?php
							}
						}
						?>
					</select>
					<label for="course">Date:</label>

					<div id="pdate"> 

						<!--<input type="date" name="date" id="date1" placeholder="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" class="form-control" required /> -->

					</div> 

					<br/>
					<input type="submit" name="btnshow" value="View Attendence"  class="btn btn-primary"/>
				</form>
				<form method="post" enctype="multipart/form-data" onsubmit="return confirm('Do you really want to update attendance?');">
					<?php
					if(isset($_POST["btnshow"]))
					{
						$date=$_POST["date"];
	//print_r($class);

						

						?><label for="course">Details:</label> 
						<input type="hidden"  value="<?php

						echo $_POST['class'] ; ?>" name="class" class="form-control"/>

						<input type="text"  value="<?php
						$class=explode(",",$_POST['class']);
						$student=explode("-",$class[4]);

						echo  explode(',', $_POST['class'],2)[1] ; ?>" name="classs" class="form-control"/>
						<label for="course">Date:</label>
						<input type="text" value="<?php echo $_POST['date']; ?>" name="date" class="form-control"/><br/>

						<table class="table table-hover table-bordered">
							<tr>
								<th style="text-align: center;" rowspan="2">Roll No</th>
								<th style="text-align: center;" rowspan="2">Name</th>
								<th style="text-align: center;">Hour 1</th>
								<th style="text-align: center;">Hour 2</th>
								<th style="text-align: center;">Hour 3</th>
								<th style="text-align: center;">Hour 4</th>
								<th style="text-align: center;">Hour 5</th>
								<th style="text-align: center;">Hour 6</th>
							</tr>

							<tr> 
								<?php
								function random_color_part() {
									return str_pad( dechex( mt_rand( 0, 180 ) ), 2, '0', STR_PAD_LEFT);
								}
								function random_color() {
									return random_color_part() . random_color_part() . random_color_part();
								}

								$colors = array();
								for($i=1;$i<=6;$i++)
								{

									?>
									<th align="center" style="    text-align: center;"> <?php
									$qer =  " SELECT * FROM subject_class WHERE subjectid IN ( select DISTINCT(a.subjectid ) from subject_class c,attendance a where a.subjectid=c.subjectid and a.hour='$i' and a.date='".$_POST['date']."' and a.classid='$class[0]'  )";


									$res=mysqli_query($con3, $qer);
									if(mysqli_num_rows($res)!= 0){
										$io = 0;
										while( $rs=mysqli_fetch_array($res) ) {
											$myclor =  random_color();

											$olay = true;
											foreach ($colors as $key => $value) {
												if($value['sub'] ==  $rs["subjectid"]){
													$olay = false;
													$myclor = $value['color'];
												}
											}
											if($olay)
												array_push($colors, array('sub' => $rs["subjectid"], 'title' => $rs["subject_title"], 'color' => $myclor ));

											echo "<span style=' color:#$myclor; '>";
											if(	$io  > 0) echo " / " ;

											echo $rs["subject_title"];	 
											if($rs["type"]=="ELECTIVE")
												echo "<small style='padding: 0 10px; font-size:8px;'>ELECTIVE</small>"; 
											echo "</span>";
										}
										$io ++;
									}  else
									echo "--";				
									?></th>
									<?php
								}
								?>
							</tr>


							<?php
							$j=$student[0];
							$k=$student[1];
							while($j<=$k)
							{ 
		//$res2=mysqli_query($con3,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and c.rollno='$j' order by c.rollno asc");
								$res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$class[0]' and c.studid=b.admissionno and c.rollno='$j' order by c.rollno asc");

								while($rs2=mysqli_fetch_array($res2))
								{
									$i=1;
									$sid=$rs2["rollno"];
									?>           
									<tr>
										<td><?php echo $rs2["rollno"]; ?></td>
										<td><?php echo $rs2["name"]; ?></td>
										<?php
										while($i<=6)
										{

											$colora = 'fff';
											$title = ''; 

											$res3=mysqli_query($con3,"select * from attendance where date='$date' and classid='$class[0]' and studid='$rs2[studid]' and hour='$i'");
											if($rs3=mysqli_fetch_array($res3))
											{	

												foreach ($colors as $key => $value) { 
													if($value['sub'] == $rs3["subjectid"] ){
														$colora = $value['color'];
														$title = $value['title'];}
													} 

													if($rs3["status"]=="P")
													{
														?>
														<td style="text-align: center;"><input type="checkbox" value="present" name="<?php echo $rs2["studid"]."-".$i;?>" checked="checked"/> 

															<span style=" padding: 0.25rem;"><span title="<?php  echo $title ;?>" style="width: 1rem;height: 1rem;background: #<?php  echo $colora ;?>; display: inline-block;border-radius: 50%;"></span></span></td>
															<?php
														}
														else
														{
															?>
															<td style="text-align: center;"><input type="checkbox" value="absent" name="<?php echo $rs2["studid"]."-".$i;?>"/></td>
															<?php
														}
													}
													else
													{
														?>
														<td></td>
														<?php
													}
													$i++;
												}
												?>
											</tr>
											<?php
										}
										$j++;
									}
									?>
								</table>
								<input type="submit" name="submit" value="Update Attendance" class="btn btn-primary"/>
								<?php
							}
							?>
						</form>
						<?php
						if(isset($_POST["submit"]))
						{
							// var_dump($_POST);

							$class=explode(",",$_POST['class']);
							$date=$_POST["date"]; 
							$student=explode("-",$class[4]);
							$j=$student[0];
							$k=$student[1];
							$c = 0;
							$a = 0;
							while($j<=$k)
							{  
		//$res2=mysqli_query($con3,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and c.rollno='$j' order by c.rollno asc");


								$res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$class[0]' and c.studid=b.admissionno and c.rollno='$j' order by c.rollno asc");

								while($rs2=mysqli_fetch_array($res2))
								{ 

									$i=1;
									$sid=$rs2["studid"];
									while($i<=6)
									{
										$status="";
				//echo "<br/>".$sid."-".$i."    ".isset($_POST[$sid."-".$i])."    ";
										if(isset($_POST[$sid."-".$i]))
										{
											$status="P";
											$c=mysqli_query($con3,"update attendance set status='$status' where studid='$sid' and hour='$i' and date='$date' and classid='$class[0]'");
										}
										else
										{
											$status="A";
											$a=mysqli_query($con3,"update attendance set status='$status' where studid='$sid' and hour='$i' and date='$date' and classid='$class[0]'");
										}

										$i++;
									}
								}
								$j++;
							} 

							if($c>0 or $a>0)
							{
		//echo "update sussess";	
								?>
								<script>
									alert("Update Successful");
		//window.location="hos.php";
	</script>
	<?php
}
else
{
	?>
	<script>
		alert(" UnSuccessful");
		//window.location="hos.php";
	</script>
	
	<?php
}
}
?>
</div>
</body>
</html>
<?php  include("includes/footer.php");    ?>
