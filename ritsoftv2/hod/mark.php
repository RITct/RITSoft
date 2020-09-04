<?php
    include("includes/header.php");
    include("includes/sidenav.php");

    
?>

<div id="page-wrapper">   
                <div class="row">
                    <div class="col-lg-12" >
                
<br><br>
<form action="" method="post">
	<label>Class:</label>
	<?php
		$s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
		$r = mysql_fetch_assoc($s);
		$deptname=$r["deptname"];

		$sql ="select * from class_details  where deptname='$deptname'";
		$result = mysql_query($sql);
	?>
<select name='clsid' class="form-control" onchange="this.form.submit()">
<option value =''>Select</option>
<?php
	while ($row = mysql_fetch_array($result)) {
	 echo "<option value='" . $row["classid"] ."'>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";   
	}
	echo "</select>";
?>        
</form>
        <div class="row">
                <div class="col-lg-12" >
                    <h1 class="page-header" align="center">
                    <?php
						if(isset($_POST["clsid"]))    {
						$classid=$_POST["clsid"];
                        $r=mysql_query("select courseid,semid from class_details where classid='$classid'");
                        while($d=mysql_fetch_array($r))
                        {
                            $co=$d["courseid"];
                            $sem=$d["semid"];
                        }
                        echo $co;
                    ?>       
                        SEMESTER
                    <?php
                        echo $sem;                  }
                    ?> 
                    </h1>                           
                </div>
        </div>

<div class="table-responsive">
  <table width="50%"  class="table table-hover table-bordered">
   <tr>
    <th style="text-align: center;">ADMISSION NUMBER</th>
    <th style="text-align: center;">NAME</th>
	<th style="text-align: center;">REG.NO</th>
    <?php
	if(isset($_POST["clsid"])){
$classid=$_POST["clsid"];
//echo $classid;

$re=mysql_query("select subject_code from university_mark where semester='$classid'");
                while($d=mysql_fetch_array($re))
                {
                    $subjectid=$d["subject_code"];
                    ?>
                    <th align="center">
                        <?php echo $subjectid; ?>
                            
                        </th>
                        <?php
                }}
                ?>
					 
                    <th style="text-align: center;">STATUS</th>

                </tr>









        <?php $st=1;
		//if(isset($_POST["clsid"])){
//$classid=$_POST["clsid"];
//echo $classid;
if(isset($_POST["clsid"])){

$classid=$_POST["clsid"];
           $resul=mysql_query("select distinct(studid),registerno from university_mark where semester='$classid' order by(studid)");
            while($dat=mysql_fetch_array($resul))
            {
            //$c=0;
                $studid=$dat["studid"];
				$regno=$dat["registerno"];


                //$res=mysql_query("select rollno from current_class where studid='$studid'");
                ////while($da=mysql_fetch_array($res))
                //{
                    //$rollno=$da["rollno"];
                //}
                $re=mysql_query("select name from stud_details where admissionno='$studid'");
                while($d=mysql_fetch_array($re))
                {
                    $name=$d["name"];
                }

//}
?>

                
                <tr>
                    <td align="center"><?php echo $studid;?></td>
                    <td align="center"><?php echo $name;?></td>
					<td align="center"><?php echo $regno;?></td>
                <?php
                $re=mysql_query("select subject_code from university_mark where semester='$classid'");
                while($d=mysql_fetch_array($re))
                {
                    $subjectid=$d["subject_code"];
                    $sessional_marks='--';
          
                $result=mysql_query("select * from university_mark where semester='$classid' and studid='$studid' and subject_code='$subjectid' order by(subject_code)");
                
                while($data=mysql_fetch_array($result))
                {	$total=0;
                    $classid=$data["semester"];
                    //$studid=$data["studid"];
                    $subid=$data["subject_code"];
                    $data["mark"];
                    
                    $marks=$data["mark"];
            		$total=$total+$marks;
                   // $status=$data["status"];
                    //if($status=="verification pending")
                    //{
                      //  $st=0;
                    //}
					//else{?>
					
					<?php
					//}
					
                    ?>
                    
                <?php



                }   
            
            ?>
                <td align="center"><?php /*echo $subjectid; echo " : ";*/ echo $marks;?></td>
                <?php
            }
                ?>
                <?php
               if($total>=350)
                {
                 ?>
				 <td style="text-align: center; color:green" > P </td>	   
                <?php
                }
                else
                {
                  //  $st=1;
                ?>
                 <td style="text-align: center; color:red" > F </td>	   
                <?php
                 }
                ?>
        </tr>


        
        <br>       

    <?php
   }
	}
    ?>
    </table>
</div>

  <div class="table-responsive">
  <table width="50%"  class="table table-hover table-bordered">

 
    <tr> <th> Subject Id </th> <th> Subject Name </th></tr>
    <?php
    if(isset($_POST["clsid"])){
           $classid=$_POST["clsid"];

    
        $c=mysql_query("select * from subject_class where classid='$classid' order by subjectid asc");
        while($re=mysql_fetch_array($c))
        {
    ?>
    <tr>    
        <th scope="col"><?php echo $re["subjectid"]; ?></th>
        <th scope="col" align="left"><?php echo $re["subject_title"]; ?></th>
    </tr>
    <?php
}
}
    ?>
    </table>
</div>
</div></select></form></div></div></div>
<?php  include("includes/footer.php");    ?>