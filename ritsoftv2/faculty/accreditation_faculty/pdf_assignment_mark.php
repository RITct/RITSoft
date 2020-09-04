<?php
# @Date:   2019-09-30T13:21:00-07:00
# @Last modified time: 2019-11-10T22:17:01-08:00

$con=mysqli_connect("localhost","root","","ritsoft");
session_start();
$uname=$_SESSION['fid'];
	include("includes/fpdf181/fpdf.php");
  $pdf=new FPDF('P','mm',"A4");
  $pdf->AddPage();
  //$result1= mysqli_query($con,"SELECT * FROM each_series_marks  ORDER BY studid") or die (mysqli_error());
  if(isset($_POST['btnshow'])!=null)
  {

    $a=explode(",",$_POST['class']);
    $b=explode("-",$_POST['sub']);
    $assignmentno=$_POST['assignmentno'];
		$l=mysqli_query($con,"SELECT * from each_assignment_mark_entry where subjectid='$b[0]' and classid='$a[0]' AND assignmentno = '$assignmentno'");
		if(mysqli_num_rows($l)!=0)
		{

    	$resul=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");
    	while($data=mysqli_fetch_array($resul))
    	{
      $classid=$data["classid"];
      $res1=mysqli_query($con,"select * from class_details where classid='$classid' and active='YES'");
      while($rs=mysqli_fetch_array($res1))
      {
        $pdf->SetFont("Arial","B",19);
        $pdf->Cell(180,10,"Rajiv Gandhi Institute Of Technology",0,0,'C');
        $pdf->Ln();
        $pdf->SetFont("Arial","B",16);
        $pdf->Cell(180,10,"Department of {$rs['branch_or_specialisation']}",0,0,'C');
        $pdf->Ln();
      	}
			}
    	$k=mysqli_query($con,"SELECT * FROM subject_class where subjectid='$b[0]' ");
    	$rs1=mysqli_fetch_array($k);
    	$pdf->SetFont("Arial","B",16);
    	$pdf->Cell(180,10,"{$rs1['subjectid']} {$rs1['subject_title']}",0,0,'C');
    	$pdf->Cell(50,30,"",0,0);

    	$pdf->Ln();
		 $pdf->Cell(40);
		 $pdf->SetFont("Arial","",12);
    	$pdf->Cell(20,10,'Roll no',1,0,'C'); // First header column
	  	$pdf->Cell(60,10,'Name',1,0,'C'); // Second header column
		$pdf->Cell(20,10,'Mark',1,0,'C'); // First header column
		
    	$pdf->Ln();
			if($b[1]=='ELECTIVE')
			{
				$res2=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,elective_student e where c.classid='$a[0]' and c.studid=b.admissionno and e.sub_code='$b[0]' and e.stud_id=c.studid order by c.rollno asc");
    		while($rs=mysqli_fetch_array($res2))
    		{
			 $pdf->Cell(40);
						$pdf->SetFont("Arial","",10);
			      $pdf->Cell(20,10,"{$rs["rollno"]}",1,0,'C');
			      $pdf->Cell(60,10,"{$rs["name"]}",1,1,'L');
						$k=mysqli_query($con,"SELECT * FROM each_assignment_mark_entry  ORDER BY studid") or die (mysqli_error());
			  		$row=mysqli_fetch_array($k);


						$pdf->SetFont("Arial","",10);
						$pdf->Cell(20,10,"{$row['mark']}",1,0,'C');
			      $pdf->Ln();
				}
			}
			else
			{
				$res=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");
				while($rs=mysqli_fetch_array($res))
	    	{
				 $pdf->Cell(40);
						$pdf->SetFont("Arial","",10);
			      $pdf->Cell(20,10,"{$rs["rollno"]}",1,0,'C');
			      $pdf->Cell(60,10,"{$rs["name"]}",1,0,'L');
		    		$k=mysqli_query($con,"SELECT * FROM each_assignment_mark_entry  ORDER BY studid") or die (mysqli_error());
		    		$row=mysqli_fetch_array($k);

						$pdf->SetFont("Arial","",10);
						$pdf->Cell(20,10,"{$row['mark']}",1,0,'C');
			      $pdf->Ln();
			}
		}
	}
	else
	{
		?>
	<script>
		alert("Marks not entered yet!!Check entered values");
		window.location="print_assignment_mark.php";
	</script>
	<?php
}		}

			$pdf->Cell(250,30," ",0,0,'C');
            $pdf->Ln();
$pdf->Ln();
	$pdf->Output();

?>
