<?php

/**
 * @Author: indran
 * @Date:   2018-08-16 06:40:20
 * @Last Modified by:   indran
 * @Last Modified time: 2018-08-16 22:49:46
 */ 

include("includes/header.php");
include("includes/sidenav.php");



if ($_POST) { 

	$_SESSION['POST'] =  $_POST; 
	echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
	exit();
}
if (isset($_SESSION ['POST'])) {
	$_POST = $_SESSION['POST'];
	unset($_SESSION['POST']);
}


$message = array();




?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Duty Leave</title>
	<style type="text/css">
	body{
		font-family: Arail, sans-serif;
	}
	/* Formatting search box */
	.search-box{
		width: 300px;
		position: relative;
		display: inline-block;
		font-size: 14px;
	}
	.search-box input[type="text"]{
		height: 32px;
		padding: 5px 10px;
		border: 1px solid #CCCCCC;
		font-size: 14px;
	}
	.result{
		position: absolute;        
		z-index: 999;
		top: 100%;
		left: 0;
	}
	.search-box input[type="text"], .result{
		width: 100%;
		box-sizing: border-box;
	}
	/* Formatting result items */
	.result p{
		margin: 0;
		padding: 7px 10px;
		border: 1px solid #CCCCCC;
		border-top: none;
		cursor: pointer;
	}
	.result p:hover{
		background: #f2f2f2;
	}

	body {
		background: white;
	}

	th, td {
		text-align: left;
		padding: 8px;
	}
	.loading-result {
		padding: 15px 0 !important;
		background-image: url(../images/loading-bar.gif);
		background-size: auto;
		background-position: center;
		background-repeat: no-repeat;
	}
	.search-box .result {
		background: white;
	}

	tr:nth-child(even){background-color: #f2f2f2}
}

</style>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		// $('#add_no').hide();
    // $('#excel_btn').hide();
 //......................................................................   
 $('#add_no').on("keyup input", function(){
 	/* Get input value on change */
 	var add_no = $(this).val();
 	var category = $('#category').val();

 	var resultDropdown = $(this).siblings(".result");
 	
 	resultDropdown.html('<p class="loading-result"></p>');

 	if(add_no.length){
 		$.get("backend-search.php", {add_no: add_no,category:category}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
 	} else{
 		resultDropdown.empty();
 	}
 });
 $(document).on("click", ".result .add_no", function(){
 	$(this).parents(".search-box").find('#add_no').val($(this).text());
 	$(this).parent(".result").html('');
 });
 $(document).on("click", ".result .add_no", function(){

 	var add_no =$(this).attr('adm_no').trim();
 	var category = $('#category').val();

 	$('#student-details').html('<div class="loading-result"></div>') ;
 	$(this).parent(".result").html('');
 	$.ajax({
 		type: "POST",
 		url: "student_details_for_leave.php",
 		data: {add_no:add_no,category:category},
 		cache: false,
 		success: function(result){

 			$('#student-details').html(result) ;
 			document.getElementById("student-details").innerHTML = result;

 			$(this).parent(".result").html('');

          // $.fn.datepicker.defaults.format = "yyyy-mm-dd";
          $('.date').datepicker({
          	format: 'yyyy-mm-dd' ,
          	autoclose: true,
          	endDate: '0d'
          }).on('changeDate', function (ev) { 

          	doFindSubjectByHour();
          });



      }
  });
 });

 $('#category').on('change', function() {

 	var category_val =$('#category').val();
 	if( category_val == 0)
 	{
 		$('#add_no').hide();
   // $('#excel_btn').hide();

}
else
{
	$('#add_no').show();  
	$('#excel_btn').show(); 
}

});


//......................................................................................



//......................................................................   
$('#name').on("keyup input", function(){
	/* Get input value on change */
	var name = $(this).val();
	var resultDropdown = $(this).siblings(".result");
	if(name.length){
		$.get("backend-search.php", {name: name}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
	} else{
		resultDropdown.empty();
	}
});



//......................................................................................

$(document).on('change', '#hour', function(event) { 
	doFindSubjectByHour();
});


function doFindSubjectByHour () {

	$('#showFinalForSubmit').html('<div class="loading-result"></div>') ;

	console.log('doFindSubjectByHour'); 
	$date = $('#date').val();
	$hour = $('#hour').val(); 
	console.log( $date, $hour);

	$.ajax({
		type: "POST",
		url: "find_subject_by.php",
		data: {date:$date,hour:$hour},
		cache: false,
		success: function(result){
			result = $(result);
			$('#showFinalForSubmit').html(result) ; 

		}
	});


}

function submitFormea () {
	console.log('form');
	$admissionno = $('#admissionno').val();
	$date = $('#date').val();
	$hour = $('#hour').val();
	$subject = $('#subject').val();
	console.log($admissionno, $date, $hour, $subject);

}

// ==========================================================================

$(document).on('click', '.okaySongleSubmit', function(event) {
	event.preventDefault();
	$form = $(this).closest('form');
	$rmakrsa = $form.find('.remark');
	var person = prompt("Please enter your remark", $rmakrsa.val() );
	$rmakrsa.val(person);
	if( confirm('Do you really want to add duty leave?') ){ 
		$form.submit();
	}
});


});
</script>
</head>
<div id="page-wrapper">
	<body>

		<?php  

		if ( 
			isset($_POST['admissionno']) &&
			isset($_POST['date']) &&
			isset($_POST['hour']) &&
			isset($_POST['subject']) &&
			isset($_POST['okay_ind']) 
		) {

			include("../connection.mysqli.php");


			$admissionno = $_POST['admissionno'];
			$date = $_POST['date'];
			$hour = $_POST['hour'];
			$subject = $_POST['subject'];
			$okay_ind = $_POST['okay_ind'];
			$remark = NULL;
			if(isset($_POST['remark']))
				$remark = $_POST['remark'];

			include("../connection.php");

			$x=true;
			$re4=mysqli_query($con3," SELECT * FROM  duty_leave  WHERE  studid = '$admissionno' AND	subjectid = '$subject' AND	leave_date = '$date' AND 	hour = '$hour' ");
			while(($rs1=mysqli_fetch_array($re4))) { 
				$x=false; 
			}

			if($x){
				$mysql = " INSERT INTO  duty_leave ( studid,	subjectid,	leave_date,	hour,	remark)  VALUES ('$admissionno',	'$subject',	'$date',	'$hour',	'$remark')  ";

				if ($con3->query($mysql) === TRUE) {

					$message [0] = 2;
					$message [1] = 'duty leave successfully added';  

					$mysql = "  UPDATE attendance SET status = 'P' WHERE   studid = '$admissionno' AND	subjectid = '$subject' AND	date = '$date' AND 	hour = '$hour' AND status='A' "; 
					if ($con3->query($mysql) === TRUE) {

						$message [0] = 1;
						$message [1] = 'duty leave successfully added and attendance updated';  
					}






				} else {

					$message [0] = 4;
					$message [1] = 'invalid input';  
				}


			} else  {

				$message [0] = 3;
				$message [1] = 'duty leave already added'; 
			}

			

		}
		if ( 
			isset($_POST['admissionno']) &&
			isset($_POST['date']) &&
			isset($_POST['hour']) &&
			isset($_POST['subject']) &&
			isset($_POST['okay_ind_reove']) 
		) {

			include("../connection.mysqli.php");


			$admissionno = $_POST['admissionno'];
			$date = $_POST['date'];
			$hour = $_POST['hour'];
			$subject = $_POST['subject'];
			$okay_ind_reove = $_POST['okay_ind_reove'];


			include("../connection.php");

			$x=true;
			$re4=mysqli_query($con3," SELECT * FROM  duty_leave  WHERE  studid = '$admissionno' AND	subjectid = '$subject' AND	leave_date = '$date' AND 	hour = '$hour' ");
			while(($rs1=mysqli_fetch_array($re4))) { 
				$x=false; 
			}

			if(!$x){
				$mysql = "  DELETE FROM duty_leave WHERE  studid = '$admissionno' AND	subjectid = '$subject' AND	leave_date = '$date' AND 	hour = '$hour'  ";

				if ($con3->query($mysql) === TRUE) {

					$message [0] = 2;
					$message [1] = 'duty leave successfully removed';  

					$mysql = "  UPDATE attendance SET status = 'A' WHERE   studid = '$admissionno' AND	subjectid = '$subject' AND	date = '$date' AND 	hour = '$hour' AND status='P' "; 
					if ($con3->query($mysql) === TRUE) {

						$message [0] = 2;
						$message [1] = 'duty leave successfully removed and attendance updated';  
					}






				} else {

					$message [0] = 4;
					$message [1] = 'invalid input';  
				}


			} else  {

				$message [0] = 3;
				$message [1] = 'duty leave not found'; 
			}

			

		}


		?>




		<!--............................................................-->

		<form method="post" action="excel.php">
			<b><h4> <center style="text-transform: uppercase;">Duty Leave</center> </h4></b>
			<table style=" margin-top: 0px; " class=" table2">
				<tr>
					<td>
						<select name="category" id="category" style=" height: 32px">
							<option value="0">Select</option>
							<option value="admissionno">Admission No</option>
							<option value="name" selected="selected">Name</option>
						</select>
					</td>
					<td>
						<div class="search-box">
							<input type="text" autocomplete="off"  id="add_no" name="religion"/>
							<div class="result"></div>
						</div>
					</td>
					<td style="width: 100%;">
						<div class="  text-right">
							<a href="duty_leave_export.php?adm_no=0" class="btn btn-warning  btn-sm pull-right">export </a>
						</div>
					</td>
					
				</tr>
			</table>
		</form>


		<!--............................................................-->

		<!--............................................................-->
<!--    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Name" id="name"/>
        <div class="result"></div>
    </div>-->

    <div id="student-details" style="min-height: 200px;">
    	<?php echo show_theme_error($message); ?> 
    </div>
</div>
</body>


</html>
<?php

include("includes/footer.php");
?>
