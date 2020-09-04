<?php
# @Date:   2019-09-30T13:21:00-07:00
# @Last modified time: 2019-11-10T22:17:01-08:00

$con=mysqli_connect("localhost","root","","ritsoft");
session_start();
$uname=$_SESSION['fid'];
	include("includes/fpdf181/fpdf.php");
  $pdf=new FPDF('P','mm',array(300,300));
  $pdf->AddPage();

      if(isset($_POST['btnshow'])!=null)
      {

        $a=explode(",",$_POST['class']);
        $b=explode("-",$_POST['sub']);
        $seriesno=$_POST['seriesno'];
		$l2=mysqli_query($con,"SELECT * from each_question_paper where subjectid='$b[0]' and classid='$a[0]' AND seriesno = '$seriesno' ORDER BY qno");
			if(mysqli_num_rows($l2)!=0)
			{
        $resul=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");
        while($data=mysqli_fetch_array($resul))
        {
          $classid=$data["classid"];
          $res1=mysqli_query($con,"select * from class_details where classid='$classid' and active='YES'");
          while($rs=mysqli_fetch_array($res1))
          {

	$result1= mysqli_query($con,"SELECT * FROM each_question_paper where seriesno ='$seriesno' AND classid ='$classid' AND subjectid ='$b[0]' ORDER BY qno") or die (mysqli_error());
	// $result2= mysqli_query($con,"SELECT * FROM tbl_co where subjectid ='PH100'");
	// $result3= mysqli_query($con,"SELECT * FROM subject_class where subjectid ='PH100'");
	// $result4= mysqli_query($con,"SELECT * FROM class_details where classid ='S1CE'");

              $pdf->SetFont("Arial","B",22);
              $pdf->Cell(250,10,"Rajiv Gandhi Institute Of Technology",0,0,'C');
              $pdf->Ln(15);
              $pdf->SetFont("Arial","B",18);
              $pdf->Cell(250,10,"Department of {$rs['branch_or_specialisation']}",0,0,'C');
              $pdf->Ln(15);
            }
          }
          $k=mysqli_query($con,"SELECT * FROM subject_class where subjectid='$b[0]' ");
          $rs1=mysqli_fetch_array($k);
          $pdf->SetFont("Arial","B",18);
          $pdf->Cell(250,10,"{$rs1['subjectid']} {$rs1['subject_title']}",0,0,'C');
          $pdf->Cell(70,30,"",0,0);
          $pdf->Ln();

      		$pdf->Cell(70);
      		$pdf->SetFont("Arial","",18);
      		$pdf->Cell(70,10,'Question No',1,0,'C'); // First header column
      		$pdf->Cell(70,10,'Mapped CO',1,0,'C'); // Second header column
          $pdf->Ln();
		        while ($row= mysqli_fetch_array ($result1) )
		          {

          			$pdf->Cell(70);
          			$pdf->SetFont("Arial","",10);
          			$pdf->Cell(70,10,"{$row['qno']}",1,0,'C');
          			$pdf->Cell(70,10,"{$row['co']}",1,0,'C');
          			//$pdf->Cell(180,10,"{$row['po_description']}",1,0);
                $pdf->Ln();
            	}
	          $pdf->Cell(250,30," ",0,0,'C');
            $pdf->Ln();

		//$pdf->Cell(70,10,'CO',1,0,'C'); // First header column
		//$pdf->Cell(70,10,'Description',1,0); // Second header column
    $result2=mysqli_query($con,"SELECT * FROM tbl_co where subjectid='$b[0]' ");
    while ($row1= mysqli_fetch_array ($result2) )
		{
			$pdf->Cell(70);
			//$pdf->SetXY(72,10); //TO INDENT
			$pdf->SetFont("Arial","",10);
			$pdf->Cell(20,10,"{$row1['co_code']}",0,0,'C');
			$pdf->Cell(20,10,"-",0,0,'C');
			$pdf->Cell(70,10,"{$row1['co_name']}",0,0,'L');
      $pdf->Ln();
		}
      $pdf->Ln();
	  }
	else
	{?>
	<script>
		alert("No such entries exist!!!, Check entered values");
		window.location="print_questionpaper.php";
	</script>
<?php
}	
    }
  	$pdf->Output();

?>
