<?php
include("includes/header.php");
$fid=$_SESSION["fid"]; 
//include("includes/sidenav.php");
//faculty id from session
//$fid='KTU01';


//READING FACULTY NAME AND DEPARTMENT
$resul=mysql_query("select name,deptname from faculty_details where fid='$fid'");
while($dat=mysql_fetch_array($resul))
{
    $fname=$dat["name"];
    $fdeptname=$dat["deptname"];

}
?>

	
		<?php
//reading class id from staff adviser
$resul1=mysql_query("select classid from staff_advisor where fid='$fid'");
$dat1=mysql_fetch_array($resul1);
if(mysql_num_rows($resul1)==1)
{
$_SESSION["classid"]=$dat1['classid'];
?>
<script type="text/javascript"> 
  	location.replace("home.php");
  	</script>

<?php

}
else
{

?>
<form id="addemp" name="form1" action = "" method = "POST">
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><span style="font-weight:bold;">WELCOME
                <?php
                $r=mysql_query("select name from faculty_details where fid='$fid'");
                while($d=mysql_fetch_array($r))
                {
                    $fname=$d["name"];
                    
                }

                echo $fname;
                ?>       



            </span></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="form-group">
	<label class="col-sm-4 control-label" for="admtype"><h1>Select Class</h1> </label><br><br>
	<div class="col-sm-8">



<?php
$resul=mysql_query("select classid from staff_advisor where fid='$fid'");

while($dat=mysql_fetch_array($resul))
{
$classid=$dat["classid"];
$r=mysql_query("select * from class_details where classid='$classid'");
$d=mysql_fetch_array($r);
$semid=$d["semid"];
$course=$d["courseid"];
$branch=$d["branch_or_specialisation"];



?>
<label class="radio-inline">
			<input id="classtype" name="classtype" value="<?php echo $classid;  ?>" type="radio" checked> <?echo $course."/S".$semid."/".$branch; ?>
		</label><br><br><br>
		

  <?php  
}
}

?>

<button type="submit" value="Submit" name="button" id="button" class="">Submit</button>
</form>



<?php
if (isset($_POST['button']))
{
$_SESSION["classid"]=$_POST['classtype'];
//echo $_POST['classtype'];

echo '<script type="text/javascript"> location.replace("home.php"); </script>';
}


//$_SESSION["classid"]=$classid;


include("includes/footer.php");
?>
