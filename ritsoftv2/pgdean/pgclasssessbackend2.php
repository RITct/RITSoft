<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = mysql_connect("localhost", "root", "", "rit");
include("../connection.php");
$classid="";

//..............................................................................
if(isset($_POST['add_no']))
{
    $add_no=$_POST['add_no'];
    
    $search_query=  explode("/", $add_no);
    
    //print_r($search_query);
    
    
    $sql = mysql_query("SELECT A.classid,B.subjectid FROM class_details A LEFT JOIN subject_class B ON A.classid=B.classid WHERE A.courseid='$search_query[0]' AND A.semid='$search_query[1]' AND A.deptname='$search_query[3]' AND A.branch_or_specialisation='$search_query[2]'");
    
    
    
    
    
    
}	
?>

<div class="table-responsive">
	<table width="50%"  class="table table-hover table-bordered">
       <tr>
          <th style="text-align: center;">ADMISSION NUMBER</th>
          <th style="text-align: center;">NAME</th>
          <?php
          
          
          while($row = mysql_fetch_array($sql)){
            $classid=$row["classid"];
            $subjectid=$row["subjectid"];
            ?>
            <th align="center">
             <?php echo $subjectid; ?>
         </th>
     <?php }?>
     
 </tr>
 <?php $st=1;

 $resul=mysql_query("select distinct(A.studid),B.name from sessional_marks A LEFT JOIN stud_details B ON A.studid=B.admissionno where A.classid='$classid' order by(A.studid)");
 while($dat=mysql_fetch_array($resul))
 {
  $studid=$dat["studid"];
  $name=$dat["name"];
  
  ?>
  <tr>
     <td align="center"><?php echo $studid;?></td>
     <td align="center"><?php echo $name;?></td>
     <?php
     $re=mysql_query("select subjectid from subject_class where classid='$classid'");
     while($d=mysql_fetch_array($re))
     {
       $subjectid=$d["subjectid"];
       $sessional_marks='--';
       $result=mysql_query("select * from sessional_marks where classid='$classid' and studid='$studid' and subjectid='$subjectid' order by(subjectid)");
       while($data=mysql_fetch_array($result))
       {	
          $classid=$data["classid"];
                    //$studid=$data["studid"];
          $subid=$data["subjectid"];
          $data["sessional_marks"];
          $sessional_marks=$data["sessional_marks"];
            				//$status=$data["status"];
      }
      ?>
      <td align="center"><?php /*echo $subjectid; echo " : ";*/ echo $sessional_marks;?></td>
      <?php
  }

  ?>

  <?php

  ?>

  <?php
						//}
  ?>
</tr>      
<?php
}
?>
</table> 
</div>
