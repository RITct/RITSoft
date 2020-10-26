<?php

/**
 * @Author: indran
 * @Date:   2018-09-09 11:34:15
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-09 11:34:32
 */ 
include("../connection.php");
?>


<?php 
$contents = "   ";

if (isset($_POST["key"]) && isset($_POST["semme"])) {





	if (isset($_POST["key"])) {

		if($_POST["key"] != "") {

			$branch=$_POST["key"];
			$l=mysql_query("select classid, branch_or_specialisation from class_details where CONCAT(courseid,'-',branch_or_specialisation)='$branch' AND semid  ='".$_POST['semme']."' order by semid") or die(mysql_error());
			if(mysql_num_rows($l)>0) {

				?> 
				<?php
				while ($r=mysql_fetch_assoc($l)) {

					$classid=$r["classid"];

					$z=mysql_query("select curr_sem,next_sem,status from semregstatus where curr_sem='$classid' and current_class=1  ") or die(mysql_error());
					while($x=mysql_fetch_assoc($z)) { 
						$curr_sem=$x["curr_sem"];
						$d=mysql_query("select semid from class_details where classid='$curr_sem'   ")or die(mysql_error());
						$b=mysql_fetch_assoc($d);


						


						$contents = $contents. "	<table  width='100%' border='1' class=\"table   table-striped\">
						<tr >
						<th colspan='2' align='center' width='750'>

						<br><br> <h3 width='200' height='300' size='40' align='center'><b>SEMESTER REGISTRATION STATUS</b></h3> <br><br>

						</th>

						</tr>
						<tr>
						<td width='550' ><b>Branch</b></td>
						<td width='200' >".  $r["branch_or_specialisation"] ."</td>
						</tr>


						<tr>
						<td width='550' ><b>Current Semester</b></td>
						<td width='200' >";
						$curr_sem=$x["curr_sem"];
						$d=mysql_query("select semid from class_details where classid='$curr_sem'")or die(mysql_error());
						$b=mysql_fetch_assoc($d);
						$contents = $contents.  $b["semid"]; 

						$contents = $contents. "</td>
						</tr>

						<tr>
						<td width='550' ><b>Next Semester</b></td>
						<td width='200' >";


						$next_sem=$x["next_sem"];
						if ($next_sem=="NIL") {
							echo "NIL";
						}
						else
						{
							$d=mysql_query("select semid from class_details where classid='$next_sem'")or die(mysql_error());
							$b=mysql_fetch_assoc($d);
							$contents = $contents.  $b["semid"]; 
						}
						$contents = $contents. "</td>
						</tr>";

						$rtsts  = "Not started";
						if($x["status"]==1){
							$rtsts  = "On Going "; 
						} 


						$contents = $contents."
						<tr>
						<td width='550' ><b>Semester Registration</b></td>
						<td width='200' >". $rtsts. "</td>
						</tr>";



						


						$k=mysql_query("select count(studid) as c from current_class_semreg where classid='$curr_sem' and studid not in(select adm_no from stud_sem_registration where classid='$curr_sem')") or die(mysql_error());
						$q=mysql_fetch_assoc($k);

						$c_count=$q["c"];
						$k=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$curr_sem'") or die(mysql_error());
						$q=mysql_fetch_assoc($k);
						$n_count=$q["c"];

						$c_count+= $n_count;


						$contents = $contents. "	<tr>
						<td width='550' ><b>Total Students</b></td>
						<td width='200' >".$c_count . "</td>
						</tr>";

						$contents = $contents. "	

						<tr>
						<td width='550' ><b>Students Registered</b></td>
						<td width='200' > ". $n_count ."</td>
						</tr>
						<tr>
						<td width='550' ><b>Students Not Registered	 </b></td>
						<td width='200' >".($c_count-$n_count)."</td>
						</tr>

						<tr>
						<td width='550' ><b>Approved by office</b></td>
						<td width='200' > ";



// apl_status='Approved' AND 
						$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND  apl_status='Approved' AND apv_status = 'Approved by office' ") or die(mysql_error());
						$qx=mysql_fetch_assoc($kx);
						$contents = $contents. " " . $qx["c"] . "</td>
						</tr>

						<tr>
						<td width='550' ><b>Verification Pending by office</b></td>
						<td width='200' >";
// apl_status='' AND 
						$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND apv_status = 'Approved by HOD'") or die(mysql_error());
						$qx=mysql_fetch_assoc($kx);
						$contents = $contents.   $qx["c"] . "</td>
						</tr>

						<tr>
						<td width='550' ><b>Verification Pending by HOD</b></td>
						<td width='200' >";
// apl_status='' AND 
						$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND (apv_status = 'Approved by staff advisor' or apv_status ='Rejected by office')") or die(mysql_error());
						$qx=mysql_fetch_assoc($kx);
						$contents = $contents.   $qx["c"] . "</td>
						</tr>

						<tr>
						<td width='550' ><b>Verification Pending by staff advisor</b></td>
						<td width='200' >"; 
// apl_status='' AND 
						$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND (apv_status = 'Not Approved' or apv_status='Rejected by HOD')") or die(mysql_error());
						$qx=mysql_fetch_assoc($kx);
						$contents = $contents.   $qx["c"] . "</td>
						</tr>
						<tr>
						<td  width='550' ><b>No: of Students application rejected by staff advisor (Re-apply)</b></td>
						<td  width='200'  max-width='200'>";

// apl_status='' AND 
						$kx=mysql_query("select count(distinct adm_no) as c from stud_sem_registration where classid='$classid' AND apv_status = 'Rejected by staff advisor'") or die(mysql_error());
						$qx=mysql_fetch_assoc($kx);
						// $contents = $contents.  $qx["c"]." <sub  > (Should be Verified by Staff Advisor)</sub>".
						$contents = $contents.  $qx["c"]." <sub style='display:none;'> </sub>".
						"</td>
						</tr> Students Re-apply should be Verified by Staff Advisor, if any


						</table>
						";


						// echo $contents;

 //$sql="i"; 
  //$s=date("d-m-Y",strtotime($d));

 //$p=wordwrap($purpose,8,"\n",true);
 //setting pdf documents contents
						require('html_pdf.php');

						// echo $contents;
						// echo "<textarea>$contents</textarea>";

						$pdf=new PDF();
						$pdf->AddPage();

						// $pdf->Footer('d');

						$pdf->SetFont('Arial','I',8);  
						$pdf->Cell( 0, 10,  "". date("M,d, Y h:i:s A"), 0, 0, 'R' ); 


						$pdf->SetFont('Arial','',12);


						$pdf->WriteHTML($contents);   
						$pdf->Output();




					}
				}

			}
		}
	}





}


?>


