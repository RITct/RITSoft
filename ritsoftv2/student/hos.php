<?php
$con=mysqli_connect("localhost","root","","ritsoft1");
session_start();
$uname=$_SESSION['unm'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Marks</title>
<script>
function showsub(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.open("GET","getsub.php?id="+str,true);
xmlhttp.send();

xmlhttp.onreadystatechange=function() 
{
if(xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("sub").innerHTML=xmlhttp.responseText;

}
}
}
</script>
</head>
<body>


<div class="map_contact">
	<div class="container">
		
		<h3 class="tittle"><center>sessional mark</center></h3>
		<div class="contact-grids" align="center">
			
			<div class="col-md-8 contact-grid" style="text-align:center">
				<form method="post" enctype="multipart/form-data" action="hos.php">
					 <table  align="center" width="700">
<tbody>
<tr><td> Class</td>  <td>  
<select name="class" onchange="showsub(this.value)">
<option>select</option>
<?php
$c=mysqli_query($con,"select distinct(classid) from subject_allocation where fid='$uname'");

while($res=mysqli_fetch_array($c))
{
	$res1=mysqli_query($con,"select *from class_details where classid='$res[classid]' and active='YES'");
	while($rs=mysqli_fetch_array($res1))
	{
?>
<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
<?php
}
}
?>
</select>
</td></tr>


<tr><td>Subject </td> <td><div id="sub">
<select name="sub" >
<option>select</option>
</select>

</div> </td></tr>
<tr><td><input type="submit" name="btnshow"  action="hos.php" value="Enter marks"  />  </td></tr> 
<form name="form1" method="post">

  <?php
$con=mysqli_connect("localhost","root","","ritsoft1");
if(isset($_POST['btnshow']))
{
	?>
    <table width="80%" border="1">
  <tr>
    <td>Roll No</td>
    <td>Name</td>
    <td>Marks</td>
  </tr>
  
    <?php
	
	
	$a=explode(",",$_POST['class']);
	$b=$_POST['sub'];
	
	?>
    <input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
    <input type="hidden" value="<?php echo $b; ?>" name="b"/>
    <?php
	$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
	$i=0;
	while($rs=mysqli_fetch_array($res))
	{
		$sid=$rs["rollno"];
		?>           
  <tr>
    <td><?php echo $rs["rollno"]; ?></td>
    <td><?php echo $rs["name"]; ?></td>
    <td><input type="textbox" name="mark[<?php echo $i; ?>]"  /></td>
  </tr>
   <?php
   $i++;
		}
		?>
        
    <tr>
   
 
    
    <td><input type="submit" name="submit" value="Enter Mark"/></td>  </tr>
	</table>
        <?php
}
	?>
    </form>



    <?php
 
	if(isset($_POST["submit"]))
	{
	$a=explode(",",$_POST['a']);
	$b=$_POST['b'];
       
	$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
	
        $st=$_POST['mark'];
         $i=0;
	while($rs=mysqli_fetch_array($res))
	{       
		$sid=$rs["adm_no"];
		 $st=$_POST['mark'];
                //echo "insert into  sessional_marks values('$a[0]','$sid','$b','$st[$i]')<br/>";
                   
			mysqli_query($con,"insert into  sessional_marks values('$a[0]','$sid','$b','$st[$i]')");
			$i++;
	}
	}
	?>
          
<tr><td><input type="submit" name="btnsave" value="save"  />  </td><td> <input type="reset" value="clear" /></td></tr>
</body>
</table>

				</form>
			</div>
		
		</div>
		
	</div>
</div>


</body>

</html>



