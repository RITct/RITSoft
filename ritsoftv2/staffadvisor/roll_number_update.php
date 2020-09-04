<?php
/**
 * @Author: indran
 * @Date:   2018-07-02 13:57:35
 * @Last Modified by:   indran
 * @Last Modified time: 2018-07-02 17:50:23
 */
include("includes/header.php");
?>
<!-- Staff advisor home page -->
<?php

$fid=$_SESSION["fid"]; 
$classid=$_SESSION["classid"];
include("includes/sidenav.php");

$uname=$_SESSION['fid'];


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


if(isset($_POST['roll']) && isset($_POST['class_final'])){ 
	$class_id = $_POST['class_final'];
	$rollNo = $_POST['roll'];
	$mysql = ''; 
	foreach ($rollNo as $key => $value) {
		$mysql = " UPDATE current_class SET rollno = $value WHERE classid = '$class_id' AND studid = '$key'  ";

		mysql_query($mysql) ;
	}
	// echo $mysql;
	// echo	$e=mysql_query($mysql) ;

	echo '<script type="text/javascript"> alert("values updated"); </script>';

}

?>





<style type="text/css">
.header-fixed {
	position: fixed;
	top: 0px; display:none;
	background-color:white;
} 
#wrapper {
	display: inline-table;
}
#page-wrapper {
	display: block;
}
</style>
<div id="page-wrapper">  
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					
					<h3 class="tittle my-5 text-capitalize"><center>update roll number</center></h3>
				</div>
				<div class="box-body">
					<div>
						<form class="form" method="post">
							<div class="form-group">
								<label class="form-label text-capitalize">class</label>

								<select name="class" class="form-control class" id="class">
									<option selected="selected" disabled="disabled">select</option>
									<?php 
									$resul=mysql_query("select distinct(classid) from staff_advisor where fid='$uname'and classid='$classid'");
									while($data=mysql_fetch_array($resul)) {
										$classid=$data["classid"];
										$res1=mysql_query("select * from class_details where classid='$classid' and active='YES'");
										while($rs=mysql_fetch_array($res1)) {
											$meSElected = '';
											if(isset($_POST['class'])){
												if($_POST['class'] == $rs['classid']){ 
													$meSElected = ' selected="selected" ';
												}					
											}  
											?>
											<option value="<?php echo $rs['classid'];   ?>"  <?php echo $meSElected; ?>>
												<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?>	
											</option>
											<?php
										}
									}
									?>
								</select>	
							</div>					
						</form>
					</div>
					<div style="margin: 2rem 0;">

						<?php if (isset($_POST['class']))  : ?>

							<div class="row">
								<div class="col-md-12">
									<div class="pull-right text-right" style="margin: 1pc 0px;">
										<div class="btn-group col-md-9" role="group" aria-label="Basic example">
											<button type="button" class="btn btn-sm btn-secondary rollno">sort by roll no</button>
											<button type="button" class="btn btn-sm btn-secondary admissionno">sort by admissionno</button>
											<button type="button" class="btn btn-sm btn-secondary name">sort by name</button>
											<button type="button" class="btn btn-sm btn-secondary autosort" style="position: relative;">
												<input type="checkbox" name="" id="makeautono" class="" style="margin: 0;position: relative;top: 3px;"> auto 
												<div style="position: absolute; left: 0; right: 0; top: 0; bottom: 0; z-index: 9;"></div>
											</button>
										</div>

										<div class="col-md-3">
											<button class="btn btn-sm btn-warning text-uppercase saveMedude"> update roll no</button>
										</div>
									</div>
								</div>
							</div>



							<table class="table roottable table-hover table-fiexd-head">
								<thead style=" background: #222; color: white; ">
									<tr  > 
										<th class="col-sm-2">Old Roll No</th>
										<th class="col-sm-3">admission number</th>
										<th class="col-sm-4">Name</th>
										<th class="col-sm-3">New Roll No</th>
									</tr> 
								</thead>
								<tbody>
									<?php 

									$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='".$_POST['class']."' and c.studid=b.admissionno order by c.rollno asc"); 
									$i=0;
									while($rs=mysql_fetch_array($res)) {  
										$sid=$rs["studid"];
										$name=$rs['name'];
										$nr_rollno = $rs["rollno"];
										echo " 

										<tr adno='$sid' oldroll='$nr_rollno' >
										<td>$nr_rollno</td>
										<td>$sid</td>
										<td>$name</td>
										<td>
										<input type='number' class='newrollno' name='newroll[$sid]' value='$nr_rollno'>
										</td>
										</tr>

										";

									} 

									?>





								</tbody>
							</table> 

							<table class="header-fixed table table-hover "></table>
						<?php endif; ?>
					</div>



				</div>
			</div>

		</div> 
	</div> 
</div> 

<button type="button" class="hidden" data-toggle="modal" id="myModalFather"  data-target="#myModal"></button>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Save New Roll Number</h4>
			</div>
			<div class="modal-body">
				<p class="text-capitalize text-danger">verify new roll numbers.</p>

				<table class="table table-hover ">
					<thead>
						<tr class="bg-darck"> 
							<th>admission number</th>
							<th>Name</th>
							<th>New Roll No</th>
						</tr> 
					</thead>
					<tbody id="confirm_op">

					</tbody>

				</table> 
			</div>
			<div class="modal-footer">

				<form class="" method="post" id="finalform">
				</form>
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>


<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function($) {

		if($(".table-fiexd-head").length > 0){
			$('.header-fixed').css('width', $('.table-fiexd-head').width());

			var tableOffset = $(".table-fiexd-head").offset().top;
			var $header = $(".table-fiexd-head > thead").clone();
			var $fixedHeader = $(".header-fixed").append($header);

			$(window).bind("scroll", function() {

				var offset = $(this).scrollTop();
				console.log(offset);
				if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
					$fixedHeader.show();
				}
				else if (offset < tableOffset) {
					$fixedHeader.hide();
				}
			});
		}

		$(document).on('change', '.class', function(event) {
			event.preventDefault(); 
			$(this).closest('form').submit();
		});


		function sortTableNum(table, order, nth) {
			var asc   = order == 'asc',
			tbody = table.find('tbody');

			tbody.find('tr').sort(function(a, b) { 
				var A =  $('td:nth-child(' + nth + ')', a).text();
				var B =  $('td:nth-child(' + nth + ')', b).text(); 
				if (asc) { 
					return A.localeCompare(B, false, {numeric: true})
				} else { 
					return B.localeCompare(A, false, {numeric: true})
				}
			}).appendTo(tbody);
		}


		$(document).on('click', '.rollno', function(event) {
			event.preventDefault(); 
			$sort  = $(this).attr('sort');
			$sort = $sort == 'asc' ? 'desc' : 'asc';
			$(this).attr('sort', $sort); 
			sortTableNum( $('.roottable'), $sort, 1); 
			$('#makeautono').prop('checked', false);
		});

		$(document).on('click', '.admissionno', function(event) {
			event.preventDefault(); 
			$sort  = $(this).attr('sort');
			$sort = $sort == 'asc' ? 'desc' : 'asc';
			$(this).attr('sort', $sort); 
			sortTableNum( $('.roottable'), $sort, 2); 
			$('#makeautono').prop('checked', false);
		});

		$(document).on('click', '.name', function(event) {
			event.preventDefault(); 
			$sort  = $(this).attr('sort');
			$sort = $sort == 'asc' ? 'desc' : 'asc';
			$(this).attr('sort', $sort); 
			sortTableNum( $('.roottable'), $sort, 3); 
			$('#makeautono').prop('checked', false);
		});


		var checkRollNo  = () => {
			$('.roottable').find('tbody tr').each(function(index, el) {
				$(this).find('input[type=number]').val(index + 1 );
			});
		};

		$(document).on('click', '.autosort', function(event) {
			event.preventDefault();
			console.log(	$(this).find('input[type=checkbox]'));
			if($(this).find('input[type=checkbox]').prop('checked') == true){
				$(this).find('input[type=checkbox]').prop('checked', false);	
			} else {			
				$(this).find('input[type=checkbox]').prop('checked', true);		
				checkRollNo ();
			}
		});

		$(document).on('change', '.newrollno', function(event) {
			if($('#makeautono').prop('checked') == true){ 
				$tr = $(this).closest('tr');
				curonno = $(this).val();
				nowUpdate = false; 
				$('.roottable').find('tbody tr').each(function(index, el) {
					if($tr.attr('adno') == $(this).attr('adno'))
						nowUpdate = true; 
					if(nowUpdate){
						$(this).find('input[type=number]').val( curonno++ );
					}
				});


			}
		});


		$(document).on('click', '.saveMedude', function(event) {
			event.preventDefault(); 			
			$("#myModalFather").click();
			$okTable = '';
			$okForm= '';
			$('.roottable').find('tbody tr').each(function(index, el) {
				$okTable += '<tr>';
				$okTable += '<td>' + $(this).find('td:nth-child(2)').text().trim() + '</td>';
				$okTable += '<td>' + $(this).find('td:nth-child(3)').text().trim() + '</td>';
				$okTable += '<td>' + $(this).find('td:nth-child(4) input[type=number]').val() + '</td>';

				$okTable += '</tr>';

				$okForm += '<input required type="hidden" name="roll[' + $(this).find('td:nth-child(2)').text().trim() + ']" value="' + $(this).find('td:nth-child(4) input[type=number]').val() + '">'; 

			});
			$okForm += '<input type="hidden" name="class_final" value="' +  $('#class').val() + '">';
			$okForm += '<div class=""> <div class="pull-right"> <button class="btn btn-info " type="submit">save</button> </div> </div>';
			$('#confirm_op').html($okTable);
			$('#finalform').html($okForm);

		});




	});
</script>

<?php

include("includes/footer.php");
?>
