<?php
include("includes/header.php");
include("includes/sidenav.php");

include("includes/connection.php");

$p0=0;
$p1=0;
$p2=0;
$p3=0;
$p4=0;
$sc=0;
$st=0;
$bpl=0;
$ph=0;
$o_state=0;
$central=0;
$sc=0;$st=0;$ph=0;$bpl=0;$o_state=0;$central=0;
$cat="NA";
 $income=0;

 //$uname=$_SESSION['uname'];
$uname=$_POST['admn'];


 $dist=$_POST['txtdist'];
$rank=0;
 $p_address=$_POST['txtpaddress'];
 $p_mob=$_POST['mob_p'];
 $income=$_POST['txtincome'];
 $rank=$_POST['txtrank'];

$disp=$_POST['txtdisp'];
$sgpa=$_POST['txtsgpa'];

$cat=$_POST['cat'];
$permanentadd=$_POST['txtaddr'];
$permanentmob=$_POST['mob_stu'];
$persentadd=$_POST['txtaddrpersent'];
$po=$_POST['txtpostoff'];



if (isset($_POST['prior'])) {

for($i=0;$i<sizeof($_POST['prior']);$i++)
 {
 	 $priority[$i]=$_POST['prior'][$i];
 	
 switch($priority[$i])
{
	case "prior1": $p0=1;break;
	case "prior2b": $p1=1;break;
	case "prior2c": $p2=1;break;
	case "prior2d": $p3=1;break;
        case "prior2f": $p4=1;break;
	default:$p0=0;$p1=0;$p2=0;$p3=0;$p4=0;
}
}
}

if ($p0!=1) {
	$p0=0;
}
if ($p1!=1) {
	$p1=0;
}
if ($p2!=1) {
	$p2=0;
}
if ($p3!=1) {
	$p3=0;
}
if ($p4!=1) {
	$p4=0;
}


if (isset($_POST['category'])) {


for($j=0;$j<sizeof($_POST['category']);$j++)
 {
 	 $category[$j]=$_POST['category'][$j];
 	
switch($category[$j])
{
	case "catsc": $sc=1;break;
	case "catst": $st=1;break;
	case "catph": $ph=1;break;
	case "catbpl": $bpl=1;break;
	case "catoherstate": $o_state=1;break;
	case "catcentral": $central=1;break;
	default:$sc=0;$st=0;$ph=0;$bpl=0;$o_state=0;$central=0;
}
}
}


if ($sc!=1) {
	$sc=0;
}
if ($st!=1) {
	$st=0;
}
if ($ph!=1) {
	$ph=0;
}
if ($o_state!=1) {
	$o_state=0;
}
if ($bpl!=1) {
	$bpl=0;
}
if ($central!=1) {
	$central=0;
}


$res1=mysql_query("SELECT * from academic_year where status=1");

while ( $row11= mysql_fetch_assoc($res1)) {
$acd_year=$row11['acd_year'];

}


//var_dump(mysql_query("insert into hostel_stud_reg(admno,admn_status,distance,income,parent_address,parent_mob,priority1,priority2b,priority2c,priority2d,Entrance_rank,sc,st,ph,bpl,other_state,central,sgpa,disci_action,Permanent_add,Permanent_mob,category,postoffice,present_res_address,priority2f,acd_year)values('$uname','submitted',$dist,$income,'$p_address','$p_mob',$p0,$p1,$p2,$p3,$rank,$sc,$st,'$ph',$bpl,$o_state,$central,$sgpa,$disp,'$permanentadd','$permanentmob','$cat','$po','$persentadd',$p4,'$acd_year')"));


$result=mysql_query("insert into hostel_stud_reg(admno,admn_status,distance,income,parent_address,parent_mob,priority1,priority2b,priority2c,priority2d,Entrance_rank,sc,st,ph,bpl,other_state,central,sgpa,disci_action,Permanent_add,Permanent_mob,category,postoffice,present_res_adress,priority2f,acd_year)values('$uname','submitted','$dist','$income','$p_address','$p_mob','$p0','$p1','$p2','$p3','$rank','$sc','$st','$ph','$bpl','$o_state','$central','$sgpa','$disp','$permanentadd','$permanentmob','$cat','$po','$persentadd','$p4','$acd_year')");

if ($result)
{
	
	echo '<script type="text/javascript">alert("Succefully registered");window.location=\'hostel_application.php\';</script>';

	
}
else
	{
		/*//need to change the location of the web page when registration failed to......echo '<script type="text/javascript">alert("Registration failed");window.location=\'hostel_application.php\';</script>';
	//echo '<script type="text/javascript">alert("Registration failed");window.location=\'applicationsave.php\';</script>';*/
	echo '<script type="text/javascript">alert("Registration failed");window.location=\'hostel_application.php\';</script>';

	
}


?>

