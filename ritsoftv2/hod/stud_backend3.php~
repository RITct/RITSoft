<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");



//..............................................................................
if(isset($_POST['classid'])) {
	$classid=$_POST['classid'];





	$sql = "SELECT * FROM stud_details A LEFT JOIN current_class B ON A.admissionno=B.studid LEFT JOIN class_details C ON B.classid=C.classid WHERE C.classid='$classid'    ORDER BY A.name ASC";

	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){

			?>                

			<div class="table-responsive">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

					<tr>
						<th>ROLL_NO</th>
						<th>ADMISSIONNO</th>
						<th>NAME</th> 
					</tr>
					<?php    
					foreach ($result  as $key => $row) {


						 // rollno ? mysqli_query($conn, $sql)

						echo "<tr>";
						echo "<td>" .$row['rollno']  . "</td>";
						echo "<td>" . $row['admissionno'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";	 
						echo "</tr>";

						if(( $key + 1 ) != $row['rollno'] ) {
							$sql = "UPDATE current_class SET rollno = " . ( $key + 1 )  . " WHERE studid = '" .  $row['admissionno'] . "' AND  classid = '" . $classid  . "' " ; 
							$resultInner = mysqli_query($link, $sql); 
						}

						


					}
					echo "</table></div>";
					// echo "<input type='submit' name='excel' value='Download Excel' style=' height: 32px' id='excel_btn'>"; 


            // Close result set
					mysqli_free_result($result);
				} else{
					echo "<p>No matches found</p>";
				}  
			}

		}

//........................................................................................................................

//................................................................................

		mysqli_close($link);
		?>