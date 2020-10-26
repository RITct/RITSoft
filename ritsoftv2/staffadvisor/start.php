<?php
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 80px;
  height: 50px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 40px;
  width: 40px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>
<body>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Control Feedback</h1>
                    </div>
				</div>


<?php
$hodid=$_SESSION['fid'];
//select department of login hod
$sql=mysql_query("select deptname from department where hod='$hodid'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$deptname=$result['deptname'];
if(isset($_POST["start"]))
{
	$status=1;
	$start_date=date("Y-m-d");
	//$stop_date=date("Y-m-d");
	$s=mysql_query("update feedback_status set status='$status', start_date='$start_date' WHERE deptname='$deptname'",$con);
	
	$sql=mysql_query("select status from feedback_status where deptname='$deptname'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$st=$result['status'];
if($st==1)
{
	echo " <h3 > " ;
	?>
	<center>
	<?php
		echo " Now students of $deptname department are allowed to give their feedback" ;
		?>
		</center>
		<?php
		
}
	
}

if(isset($_POST["stop"]))
{
	$status=0;
	$stop_date=date("Y-m-d");
	$s=mysql_query("update feedback_status set status='$status', stop_date='$stop_date' WHERE deptname='$deptname'",$con);
	
	$sql=mysql_query("select status from feedback_status where deptname='$deptname'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$st=$result['status'];
if($st==0)
{
	echo " <h3 > " ;
	?>
	<center>
	<?php
		echo " Now students of $deptname department are Not allowed to give their feedback" ;
		?>
		</center>
		<?php
		
}
//current date
$acdyear=date("Y");
$prev=$acdyear-1;
$prev.="-". $acdyear; 
//echo $prev;
//calculation of feedback and storage into table
$sql1=mysql_query("select count(*) as count,s.subjectid,sc.subject_title,fd.fid from  mainfeedback mf,subject_allocation s, 
subject_class sc,faculty_details fd where mf.subjectid=s.subjectid and s.subjectid=sc.subjectid and 
fd.fid=s.fid and fd.deptname='$deptname' and mf.acdyear='$prev' group by s.subjectid;",$con);
while ($re=mysql_fetch_array($sql1))
{
	$cnt=$re['count'];
	$subid=$re['subjectid'];
	$title=$re['subject_title'];
	$fid=$re['fid'];
	$tei = 0;
if($cnt==0)
{
	 echo "<script>alert('No feedback for $title')</script>";
}
else
{
	$kn1=mysql_query("SELECT COUNT(*) as ckn1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs1=17.75",$con);
if($kn1)
 {
    while($krow1=mysql_fetch_assoc($kn1))
  {
	//echo $krow1['ckn1'];
	$a1 = $krow1['ckn1'];
  }
 }
 $kn2=mysql_query("SELECT COUNT(*) as ckn2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs1=14.125",$con);
if($kn2)
 {
    while($krow2=mysql_fetch_assoc($kn2))
  {
	//echo $krow2['ckn2'];
	$a2 = $krow2['ckn2'];
  }
 }
$kn3=mysql_query("SELECT COUNT(*) as ckn3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs1=10.28125",$con);
if($kn3)
 {
    while($krow3=mysql_fetch_assoc($kn3))
  {
	//echo $krow3['ckn3'];
	$a3 = $krow3['ckn3'];
  }
 }
$kn4=mysql_query("SELECT COUNT(*) as ckn4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs1=3.53125",$con);
if($kn4)
 {
    while($krow4=mysql_fetch_assoc($kn4))
  {
	//echo $krow4['ckn4'];
	$a4 = $krow4['ckn4'];
  }
 }
$kn5=mysql_query("SELECT COUNT(*) as ckn5 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs1=8",$con);
if($kn5)
 {
    while($krow5=mysql_fetch_assoc($kn5))
  {
	//echo $krow5['ckn5'];
	$a5 = $krow5['ckn5']; 
  }
 }
 //calculation
 $i1 = ( ( $a1 * 17.75 ) + ( $a2 * 14.125) + ( $a3 * 10.28125) + ( $a4 * 3.53125) + ( $a5 * 8) ) / $cnt;
//$r1 = number_format((float)$i1, 2, '.', '');
$tei = $tei + $i1;

$cl1=mysql_query("SELECT COUNT(*) as ccl1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs2=14.5",$con);
if($cl1)
 {
    while($clrow1=mysql_fetch_assoc($cl1))
  {
	//echo $clrow1['ccl1'];
	$a1 = $clrow1['ccl1'];
  }
 }
$cl2=mysql_query("SELECT COUNT(*) as ccl2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs2=11.8125",$con);
if($cl2)
 {
    while($clrow2=mysql_fetch_assoc($cl2))
  {
	//echo $clrow2['ccl2'];
	$a2 = $clrow2['ccl2'];
  }
 }
$cl3=mysql_query("SELECT COUNT(*) as ccl3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs2=8.1125",$con);
if($cl3)
 {
    while($clrow3=mysql_fetch_assoc($cl3))
  {
	//echo $clrow3['ccl3'];
	$a3 = $clrow3['ccl3'];
  }
 }
$cl4=mysql_query("SELECT COUNT(*) as ccl4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs2='2.0125'",$con);
if($cl4)
 {
    while($clrow4=mysql_fetch_assoc($cl4))
  {
	//echo $clrow4['ccl4'];
	$a4 = $clrow4['ccl4'];
  }
 }

 $cl5=mysql_query("SELECT COUNT(*) as ccl5 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs2=4.0875",$con);
if($cl5)
 {
    while($clrow5=mysql_fetch_assoc($cl5))
  {
	//echo $clrow5['ccl5'];
	$a5 = $clrow5['ccl5'];
  }
 }
 $i2 = ( ( $a1 * 14.5 ) + ( $a2 * 11.8125) + ( $a3 * 8.1125) + ( $a4 * 2.0125) + ( $a5 * 4.0875) ) / $cnt;
//$r2 = number_format((float)$i2, 2, '.', '');
//echo $i2;
$tei = $tei + $i2;

 $w1=mysql_query("SELECT COUNT(*) as cw1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs3=7.5",$con);
if($w1)
 {
    while($wrow1=mysql_fetch_assoc($w1))
  {
	//echo $wrow1['cw1'];
	$a1 = $wrow1['cw1'];
  }
 }
$w2=mysql_query("SELECT COUNT(*) as cw2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs3=5.7125",$con);
if($w2)
 {
    while($wrow2=mysql_fetch_assoc($w2))
  {
	//echo $wrow2['cw2'];
	$a2 = $wrow2['cw2'];
  }
 }
$w3=mysql_query("SELECT COUNT(*) as cw3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs3=4.0375",$con);
if($w3)
 {
    while($wrow3=mysql_fetch_assoc($w3))
  {
	//echo $wrow3['cw3'];
	$a3 = $wrow3['cw3'];
  }
 }
$w4=mysql_query("SELECT COUNT(*) as cw4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs3=1.125",$con);
if($w4)
 {
    while($wrow4=mysql_fetch_assoc($w4))
  {
	//echo $wrow4['cw4'];
	$a4 = $wrow4['cw4'];
  }
 }
$w5=mysql_query("SELECT COUNT(*) as cw5 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs3=2.2125",$con);
if($w5)
 {
    while($wrow5=mysql_fetch_assoc($w5))
  {
	//echo $wrow5['cw5'];
	$a5 = $wrow5['cw5'];
  }
 }
 $i3 = ( ( $a1 * 7.5 ) + ( $a2 * 5.7125) + ( $a3 * 4.0375) + ( $a4 * 1.125) + ( $a5 * 2.2125) ) / $cnt;
//$r3 = number_format((double)$i3, 2, '.', '');
//echo $i3;
$tei = $tei + $i3;

$en1=mysql_query("SELECT COUNT(*) as cen1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs4=5.85",$con);
if($en1)
 {
    while($enrow1=mysql_fetch_assoc($en1))
  {
	//echo $enrow1['cen1'];
	$a1 = $enrow1['cen1'];
  }
 }
$en2=mysql_query("SELECT COUNT(*) as cen2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs4=3.6625",$con);
if($en2)
 {
    while($enrow2=mysql_fetch_assoc($en2))
  {
	//echo $enrow2['cen2'];
	$a2 = $enrow2['cen2'];
  }
 }
$en3=mysql_query("SELECT COUNT(*) as cen3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs4=1.9125",$con);
if($en3)
 {
    while($enrow3=mysql_fetch_assoc($en3))
  {
	//echo $enrow3['cen3'];
	$a3 = $enrow3['cen3'];
  }
 }
$en4=mysql_query("SELECT COUNT(*) as cen4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs4=1.6375",$con);
if($en4)
 {
    while($enrow4=mysql_fetch_assoc($en4))
  {
	//echo $enrow4['cen4'];
	$a4 = $enrow4['cen4'];
  }
 }
 $i4 = ( ( $a1 * 5.85 ) + ( $a2 * 3.6625) + ( $a3 * 1.9125) + ( $a4 * 1.6375) ) / $cnt;
//$r4 = number_format((double)$i4, 2, '.', '');
//echo $i4;
$tei = $tei + $i4;

$d1=mysql_query("SELECT COUNT(*) as cd1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs5=4",$con);
if($d1)
 {
    while($drow1=mysql_fetch_assoc($d1))
  {
	//echo $drow1['cd1'];
	$a1 = $drow1['cd1'];
  }
 }
$d2=mysql_query("SELECT COUNT(*) as cd2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs5=0.67375",$con);
if($d2)
 {
    while($drow2=mysql_fetch_assoc($d2))
  {
	//echo $drow2['cd2'];
	$a2 = $drow2['cd2'];
  }
 }
$d3=mysql_query("SELECT COUNT(*) as cd3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs5=1.65",$con);
if($d3)
 {
    while($drow3=mysql_fetch_assoc($d3))
  {
	//echo $drow3['cd3'];
	$a3 = $drow3['cd3'];
  }
 }
 $i5 = ( ( $a1 * 4 ) + ( $a2 * 0.67375) + ( $a3 * 1.65) ) / $cnt;
//$r5 = number_format((double)$i5, 2, '.', '');
//echo $i5;
$tei = $tei + $i5;

$ab1=mysql_query("SELECT COUNT(*) as cab1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs6=9.25",$con);
if($ab1)
 {
    while($abrow1=mysql_fetch_assoc($ab1))
  {
	//echo $abrow1['cab1'];
	$a1 = $abrow1['cab1'];
  }
 }
$ab2=mysql_query("SELECT COUNT(*) as cab2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs6=6.34125",$con);
if($ab2)
 {
    while($abrow2=mysql_fetch_assoc($ab2))
  {
	//echo $abrow2['cab2'];
	$a2 = $abrow2['cab2'];
  }
 }
$ab3=mysql_query("SELECT COUNT(*) as cab3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs6=2.5",$con);
if($ab3)
 {
    while($abrow3=mysql_fetch_assoc($ab3))
  {
	//echo $abrow3['cab3'];
	$a3 = $abrow3['cab3'];
  }
 }
$ab4=mysql_query("SELECT COUNT(*) as cab4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs6=3.1625",$con);
if($ab4)
 {
    while($abrow4=mysql_fetch_assoc($ab4))
  {
	//echo $abrow4['cab4'];
	$a4 = $abrow4['cab4'];
  }
 }
 $i6 = ( ( $a1 * 9.25 ) + ( $a2 * 6.34125) + ( $a3 * 2.5) + ( $a4 * 3.1625 ) ) / $cnt;
//$r6 = number_format((double)$i6, 2, '.', '');
//echo $i6;
$tei = $tei + $i6;

$s1=mysql_query("SELECT COUNT(*) as cs1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs7=4.75",$con);
if($s1)
 {
    while($srow1=mysql_fetch_assoc($s1))
  {
	//echo $srow1['cs1'];
	$a1 = $srow1['cs1'];
  }
 }
$s2=mysql_query("SELECT COUNT(*) as cs2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs7=1.34125",$con);
if($s2)
 {
    while($srow2=mysql_fetch_assoc($s2))
  {
	//echo $srow2['cs2'];
	$a2 = $srow2['cs2'];
  }
 }
$s3=mysql_query("SELECT COUNT(*) as cs3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs7=1.19125",$con);
if($s3)
 {
    while($srow3=mysql_fetch_assoc($s3))
  {
	//echo $srow3['cs3'];
	$a3 = $srow3['cs3'];
  }
 }
$s4=mysql_query("SELECT COUNT(*) as cs4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs7=1.4",$con);
if($s4)
 {
    while($srow4=mysql_fetch_assoc($s4))
  {
	//echo $srow4['cs4'];
	$a4 = $srow4['cs4'];
  }
 }
 $i7 = ( ( $a1 * 4.75 ) + ( $a2 * 1.34125 ) + ( $a3 * 1.19125 ) + ( $a4 * 1.4 ) ) / $cnt;
//$r7 = number_format((double)$i7, 2, '.', '');
//echo $i7;
$tei = $tei + $i7;

$t1=mysql_query("SELECT COUNT(*) as ct1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs8=6.875",$con);
if($t1)
 {
    while($trow1=mysql_fetch_assoc($t1))
  {
	//echo $trow1['ct1'];
	$a1 = $trow1['ct1'];
  }
 }
$t2=mysql_query("SELECT COUNT(*) as ct2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs8=3.89375",$con);
if($t2)
 {
    while($trow2=mysql_fetch_assoc($t2))
  {
	//echo $trow2['ct2'];
	$a2 = $trow2['ct2'];
  }
 }
$t3=mysql_query("SELECT COUNT(*) as ct3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs8=0.7375",$con);
if($t3)
 {
    while($trow3=mysql_fetch_assoc($t3))
  {
	//echo $trow3['ct3'];
	$a3 = $trow3['ct3'];
  }
 }
$t4=mysql_query("SELECT COUNT(*) as ct4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs8=1.775",$con);
if($t4)
 {
    while($trow4=mysql_fetch_assoc($t4))
  {
	//echo $trow4['ct4'];
	$a4 = $trow4['ct4'];
  }
 }
 $i8 = ( ( $a1 * 6.875 ) + ( $a2 * 3.89375 ) + ( $a3 * 0.7375 ) + ( $a4 * 1.775 ) ) / $cnt;
//$r8 = number_format((double)$i8, 2, '.', '');
//echo $i8;
$tei = $tei + $i8;

$b1=mysql_query("SELECT COUNT(*) as cb1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs9=6.75",$con);
if($b1)
 {
    while($brow1=mysql_fetch_assoc($b1))
  {
	//echo $brow1['cb1'];
	$a1 = $brow1['cb1'];
  }
 }
$b2=mysql_query("SELECT COUNT(*) as cb2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs9=2.7825",$con);
if($b2)
 {
    while($brow2=mysql_fetch_assoc($b2))
  {
	//echo $brow2['cb2'];
	$a2 = $brow2['cb2'];
  }
 }
$b3=mysql_query("SELECT COUNT(*) as cb3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs9=1.27875",$con);
if($b3)
 {
    while($brow3=mysql_fetch_assoc($b3))
  {
	//echo $brow3['cb3'];
	$a3 = $brow3['cb3'];
  }
 }
$b4=mysql_query("SELECT COUNT(*) as cb4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs9=1.9375",$con);
if($b4)
 {
    while($brow4=mysql_fetch_assoc($b4))
  {
	//echo $brow4['cb4'];
	$a4 = $brow4['cb4'];
  }
 }
 $i9 = ( ( $a1 * 6.75 ) + ( $a2 * 1.27875 ) + ( $a3 * 2.7825 ) + ( $a4 * 1.9375 ) ) / $cnt;
//$r9 = number_format((double)$i9, 2, '.', '');
//echo $i9;
$tei = $tei + $i9;
$si1=mysql_query("SELECT COUNT(*) as csi1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs10=11.5",$con);
if($si1)
 {
    while($sirow1=mysql_fetch_assoc($si1))
  {
	//echo $sirow1['csi1'];
	$a1 = $sirow1['csi1'];
  }
 }
$si2=mysql_query("SELECT COUNT(*) as csi2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs10=1.325",$con);
if($si2)
 {
    while($sirow2=mysql_fetch_assoc($si2))
  {
	//echo $sirow2['csi2'];
	$a2 = $sirow2['csi2'];
  }
 }
$si3=mysql_query("SELECT COUNT(*) as csi3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs10=5.06375",$con);
if($si3)
 {
    while($sirow3=mysql_fetch_assoc($si3))
  {
	//echo $sirow3['csi3'];
	$a3 = $sirow3['csi3'];
  }
 }
$si4=mysql_query("SELECT COUNT(*) as csi4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs10=4.025",$con);
if($si4)
 {
    while($sirow4=mysql_fetch_assoc($si4))
  {
	//echo $sirow4['csi4'];
	$a4 = $sirow4['csi4'];
  }
 }
 $i10 = ( ( $a1 * 11.5 ) + ( $a2 * 1.325 ) + ( $a3 * 5.06375 ) + ( $a4 * 4.025 ) ) / $cnt;
//$r10 = number_format((double)$i10, 2, '.', '');
//echo $i10;
$tei = $tei + $i10;

$o1=mysql_query("SELECT COUNT(*) as co1 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs11=11.25",$con);
if($o1)
 {
    while($orow1=mysql_fetch_assoc($o1))
  {
	//echo $orow1['co1'];
	$a1 = $orow1['co1'];
  }
 }
$o2=mysql_query("SELECT COUNT(*) as co2 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs11=9.025",$con);
if($o2)
 {
    while($orow2=mysql_fetch_assoc($o2))
  {
	//echo $orow2['co2'];
	$a2 = $orow2['co2'];
  }
 }
$o3=mysql_query("SELECT COUNT(*) as co3 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs11=6.45625",$con);
if($o3)
 {
    while($orow3=mysql_fetch_assoc($o3))
  {
	//echo $orow3['co3'];
	$a3 = $orow3['co3'];
  }
 }
$o4=mysql_query("SELECT COUNT(*) as co4 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs11=1.5625",$con);
if($o4)
 {
    while($orow4=mysql_fetch_assoc($o4))
  {
	//echo $orow4['co4'];
	$a4 = $orow4['co4'];
  }
 }
$o5=mysql_query("SELECT COUNT(*) as co5 FROM mainfeedback WHERE subjectid='$subid' and acdyear='$prev' and qs11=2.025",$con);
if($o5)
 {
    while($orow5=mysql_fetch_assoc($o5))
  {
	//echo $orow5['co5'];
	$a5 = $orow5['co5'];
  }
 }
$i11 = ( ( $a1 * 11.25 ) + ( $a2 * 9.025 ) + ( $a3 * 6.45625 ) + ( $a4 * 1.5625 ) + ( $a5 * 2.025 ) ) / $cnt;
//$r11 = number_format((double)$i11, 2, '.', '');
//echo $i11;
$tei = $tei + $i11;
//insert into table feedback_index
$ch=mysql_query("select * from feedback_index where deptname='$deptname' and fid='$fid' and subjectid='$subid' and acdyear='$prev'",$con);
$chr=mysql_num_rows($ch);
if($chr>=1)
{
	$s=mysql_query("update feedback_index set indexmark='$tei' where deptname='$deptname' and fid='$fid' and subjectid='$subid' and acdyear='$prev'",$con);
}
else
{
	$s=mysql_query("insert into feedback_index values('','$deptname','$fid','$subid','$prev','$tei')",$con);
}


 
}//close else

}//while close
}	//stop click close
if(isset($_POST['submit']))
{
$sql=mysql_query("select status from feedback_status where deptname='$deptname'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$st=$result['status'];
if($st==1)
{
	echo "<script type='text/javascript'>alert('Feedback Allowed for $deptname department')</script>";
	 //echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
}
if($st==0)
{
	echo "<script type='text/javascript'>alert('Feedback Not Allowed for $deptname department')</script>";
}

}

?>
<?php
$sql=mysql_query("select status from feedback_status where deptname='$deptname'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$st=$result['status'];

if($st==1)
{
	$qw="ON";
$c='checked="checked"';
}
else
{
	$c="";
	$qw="OFF";
}
	?>
<form method="post">
<center>
<div class="row">
                <div class="col-lg-12">
<label class="switch">
	<input type="hidden" name="status" value="0">
 <input type="checkbox" name="status" <?php echo $c; ?> value="1" onchange="this.form.submit()">
  <span class="slider round"></span>
  
</label>

</div>
</div>
<b><?php echo $qw; ?></b>
</center>
</form>
</body>
</div>
                <!-- /.row -->
 </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        </div>
		</html>

    <!-- /#wrapper --> 
<?php

include("includes/footer.php");
?>
