<?php  

include 'PHPExcel/IOFactory.php';

$arrayMark = array();


if (! isset($_FILES['selected_excel'])) {
	echo '<div class="alert alert-danger"> <strong>danger!</strong> unknown file type</div>'; 
} else {

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["selected_excel"]["name"]);
	$uploadOk = 1;
	if(isset($_POST["classid"]) && isset($_POST["sub_code"])) {

		$allowed =  array('xls','xlsx');
		$filename = $_FILES['selected_excel']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION); 

		if(!in_array($ext,$allowed) ) { 
			echo '<div class="alert alert-danger"> <strong>danger!</strong> unknown file type</div>'; 
		} else { 

			$inputFileName = $_FILES["selected_excel"]["tmp_name"];
			try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				$ydie = 'Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage();

				echo '<div class="alert alert-danger"> <strong>danger!</strong>$ydie</div>'; 
			}


			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();


			$identifr = "rollno";
			$targert = "mark";




			$identifr = trim($identifr," ");
			$targert = strtolower($targert );

			$identifrid = -1;
			$targertid = -1;

			for ($row = 1; $row <= $highestRow; $row++){ 
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
					NULL,
					TRUE,
					FALSE);
				if( $identifrid < 0 || $targertid < 0){
					foreach ($rowData[0] as $key => $value) {
						$value = trim($value," ");
						$value = strtolower($value);

						$identifr = trim($identifr," ");
						$targert = strtolower($targert );

						if($value == $identifr )
							$identifrid = $key;

						if($value == $targert )
							$targertid = $key;

					}
				} else { 
					array_push($arrayMark , array(
						'id' =>  strtolower($rowData[0][ $identifrid ] ) ,
						'value' => strtolower($rowData[0][ $targertid ] )
					));
				}


			}

			if( $identifrid < 0 && $targertid < 0) {  
				echo '<div class="alert alert-danger"> <strong>danger!</strong>cannot find any valid data</div>'; 
			}  

			if( empty($arrayMark) ) {  
				echo '<div class="alert alert-warning"> <strong>warning!</strong>cannot find any valid data</div>'; 
			}  


		}

	}

}

include("connection.php");

$isSet = false;

$a0 = $_POST['classid'];
$b0 = $_POST['sub_code'];
$b1 = $_POST['sub_code_ex'];

?>


<?php 


// $sessional_remark ="" ;
// $sessional_status =""  ;


// if( isset($_POST['sessional_remark'])  ){
// $sessional_remark = $_POST['sessional_remark']; 
// }


// if(  isset($_POST['sessional_status'])){ 
// $sessional_status = $_POST['sessional_status'] ;
// }


// echo '<input type="hidden" value="'. $sessional_remark  .'" name="sessional_remark">';
// echo '<input type="hidden" value="'. $sessional_status .'" name="sessional_status">';

?>

<table width="100%" border="1" align="center" class="table table-hover table-bordered">
	<tr>
		<td>Roll No</td>
		<td>Name</td>
		<td>Marks</td>
		<td>Remark</td>
	</tr>

	<?php




	?>

	<?php




	if($b1=='ELECTIVE') {

		$res22=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,elective_student e where c.classid='$a0' and c.studid=b.admissionno and e.sub_code='$b0' and e.stud_id=c.studid order by c.rollno asc");
		$i=0;
		while($rs=mysql_fetch_array($res22)) {
			$sid=$rs["rollno"]; 
			$innerId = $rs["rollno"]; 
			?>           
			<tr>
				<td><?php echo $rs["rollno"]; ?></td>
				<td><?php echo $rs["name"]; ?></td>
				<td>
					<input type="number" id="textd" onkeyup="success()" required="true"    step=".01"  
					name="mark[<?php echo $rs["rollno"]; ?>]" value="<?php

					foreach ($arrayMark as $key => $value) { 
						if($value['id'] == strtolower( trim( $innerId  , " " ) ) ){
							echo trim($value['value'], " "); 
							$isSet = true;
						}
					}


					?>" />
				</td>
				<td> <textarea name="remark[<?php echo $rs["rollno"]; ?>]"></textarea></td>
			</tr>
			<?php
			$i++;
		}




	} 
	else{

	//$res=mysql_query("SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
		$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a0' and c.studid=b.admissionno order by c.rollno asc");

	//exit();
		$i=0;
		while($rs=mysql_fetch_array($res)) {
			$sid=$rs["rollno"]; 
			$innerId = $rs["rollno"]; 
			?>           
			<tr>
				<td><?php echo $rs["rollno"]; ?></td>
				<td><?php echo $rs["name"]; ?></td>
				<!--  pattern="^[0-9]{1,3}" -->
				<td><input type="number" id="textd" onkeyup="success()" required="true" step=".01"     name="mark[<?php echo $rs["rollno"]; ?>]"   value="<?php

				foreach ($arrayMark as $key => $value) { 
					if($value['id'] == strtolower( trim( $innerId  , " " ) ) ){
						echo trim($value['value'], " "); 
						$isSet = true;
					}
				}


				?>"  /></td>
				<td> <textarea name="remark[<?php echo $rs["rollno"]; ?>]"></textarea></td>
			</tr>
			<?php
			$i++;
		}

	}?>


</table>

<?php
if ($isSet) {
	?>
	<div class="col-md-8 contact-grid " style="text-align:center ; margin-bottom: 1pc;">
		<input type="submit" class="btn btn-primary" id="button" name="submit"   value="Save"/>   <!--<input type="reset" class="btn btn-primary" onclick="window.location.href='hos.php'" value="clear" />-->

	</div>

	<?php
} else {
	?>

	<div class="col-md-8 contact-grid " style="text-align:center ; margin-bottom: 1pc;">
		<input type="submit" class="btn btn-primary" id="button" name="submit" disabled ="disabled" value="Save"/>   <!--<input type="reset" class="btn btn-primary" onclick="window.location.href='hos.php'" value="clear" />-->

	</div>
	<?php
}
?>
