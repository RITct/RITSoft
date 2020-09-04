



<?php
# @Date:   2019-09-30T13:21:00-07:00
# @Last modified time: 2019-11-10T22:17:01-08:00

$con=mysqli_connect("localhost","root","","ritsoft");
session_start();
$uname=$_SESSION['fid'];
	include("includes/fpdf181/fpdf.php");

	$pdf=new FPDF('P','mm',"A4");
	$pdf->AddPage();
    if(isset($_POST['btnshow'])!=null)
    {
      $a=explode(",",$_POST['class']);
      $b=explode("-",$_POST['sub']);
      $seriesno=$_POST['seriesno'];

			$sum=0;
			$l2=mysqli_query($con,"SELECT * from each_question_paper where subjectid='$b[0]' and classid='$a[0]' AND seriesno = '$seriesno' ORDER BY qno");
			if(mysqli_num_rows($l2)!=0)
			{
				while($s=mysqli_fetch_array($l2))
				{
					if($s['choice']!='yes')
					{
						$sum=$sum+$s['maxmark'];
					}
				$series=$s['seriesno'];
				if($series=='1')
				{
					$val='First';
				}
				else {
					$val='Second';
				}
				$date =$s['d_date'];
$yr= date("F, Y", strtotime($date));				
				$class=$s['classid'];
				$sql=mysqli_query($con,"SELECT semid from class_details where classid='$class'");
				$result2=mysqli_fetch_array($sql);
				if($result2['semid']=='1')

							$sem="First";
				elseif($result2['semid']=='2')

					$sem="Second";
				elseif($result2['semid']=='3')

						$sem="Third";
				elseif($result2['semid']=='4')

							$sem="Fourth";
				elseif($result2['semid']=='5')
						$sem="Fifth";
			elseif($result2['semid']=='6')

							$sem="Sixth";
	elseif($result2['semid']=='7')

								$sem="Seventh";
				else
					$sem="Second";
			}
      	$resul=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");
      	while($data=mysqli_fetch_array($resul))
      	{
        $classid=$data["classid"];
        $res1=mysqli_query($con,"select * from class_details where classid='$classid' and active='YES'");
        while($rs=mysqli_fetch_array($res1))
        	{
	          $pdf->SetFont("Arial","B",20);
	          $pdf->Cell(170,10,"Rajiv Gandhi Institute Of Technology",0,0,'C');
	          $pdf->Ln();
	          $pdf->SetFont("Arial","B",18);
	          $pdf->Cell(180,10,"Department of {$rs['branch_or_specialisation']}",0,0,'C');
	          $pdf->Ln();
       		}
				}

       	$k=mysqli_query($con,"SELECT * FROM subject_class where subjectid='$b[0]' ");
       	$rs1=mysqli_fetch_array($k);
        $pdf->SetFont("Arial","B",15);
				$pdf->Cell(180,10,"{$sem} Semester {$val} Series Test - {$yr}",0,0,'C');
				$pdf->Ln();
				// $pdf->Cell(180,10,"",0,0,'C');
				// $pdf->Ln();
        $pdf->Cell(180,10,"{$rs1['subjectid']} {$rs1['subject_title']}",0,0,'C');
        $pdf->Ln();

		$pdf->SetFont("Arial","B",10);
				if($sum=='50')
				{
					$pdf->Cell(70,20,'Duration: 2 hr',0,0,'L');
				}
				elseif ($sum=='30')
				{
					$pdf->Cell(70,20,'Duration: 1:30 hr',0,0,'L');
				}
				else
				{
					$pdf->Cell(70,20,'Duration: 1 hr',0,0,'L');
				}

				$pdf->Cell(110,20,"Maximum Marks:{$sum}",0,1,'R');
				$pdf->Cell(30);
	      $pdf->SetFont("Arial","B",15);
	      $pdf->Cell(140,30,"PART-A",0,0,'C');
	      $pdf->Ln();
				$l=mysqli_query($con,"SELECT * from each_question_paper where subjectid='$b[0]' and classid='$a[0]' AND seriesno = '$seriesno' ORDER BY qno");
				while($row= mysqli_fetch_array ($l))
				{
					if($row['part']=="Part A")
					{
						if($row['choice']=="yes")
						{
							$pdf->SetFont("Arial","",12);
							$pdf->Cell(10,10,"{$row['qno']}.",0,0,'C');
							$pdf->Cell(140,10,"{$row['question']}",0,0,'L');
							$pdf->Cell(40,10,"({$row['maxmark']})",0,1,'R');
							$pdf->Cell(70,10,"OR",0,1,'C');
							//$pdf->Ln();
						}
						else{

					$pdf->SetFont("Arial","",12);
					$pdf->Cell(10,10,"{$row['qno']}.",0,0,'C');
					$pdf->Cell(140,10,"{$row['question']}",0,0,'L');
					$pdf->Cell(40,10,"({$row['maxmark']})",0,1,'R');
					// $pdf->Ln();
				}}
				}
				$pdf->Cell(30);
				$pdf->SetFont("Arial","B",15);
				$pdf->Cell(140,20,"PART B",0,0,'C');
				$pdf->Ln();
				$l1=mysqli_query($con,"SELECT * from each_question_paper where subjectid='$b[0]' and classid='$a[0]' AND seriesno = '$seriesno' ORDER BY qno");
				while($row1= mysqli_fetch_array ($l1))
				{
				if($row1['part']=="Part B")
					{
									//$pdf->SetXY(72,10); //TO INDENT
						if($row1['choice']=="yes")
						{
							$pdf->SetFont("Arial","",12);
							$pdf->Cell(10,10,"{$row1['qno']}.",0,0,'C');
							$pdf->Cell(140,10,"{$row1['question']}",0,0,'L');
							$pdf->Cell(40,10,"({$row1['maxmark']})",0,1,'R');
							$pdf->Cell(150,10,"OR",0,1,'C');
							//$pdf->Ln();
						}
						else{
							$pdf->SetFont("Arial","",12);
							$pdf->Cell(10,10,"{$row1['qno']}.",0,0,'C');
							$pdf->Cell(140,10,"{$row1['question']}",0,0,'L');
							$pdf->Cell(40,10,"({$row1['maxmark']})",0,1,'R');
							$pdf->Ln();
						}
					}
				}
	}
	else
	{?>
	<script>
		alert("No such question paper exist!!!, Check entered values");
		window.location="print_questionpaper.php";
	</script>
	<?php
}		}
	$pdf->Output();
?>
pdf_question_paper.php
Displaying pdf_question_paper.php.