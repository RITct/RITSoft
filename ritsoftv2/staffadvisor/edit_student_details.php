<?php
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");
 $count=0;
error_reporting(0);
 $classid=$_SESSION["classid"];
$fid=$_SESSION["fid"];
 ?>


 <div id="page-wrapper" style="height: auto;">

    <div class="row">
        <div class="col-lg-12" >
            <h1 class="page-header">STUDENT DETAILS OF 
                <?php
            //Retreving semester details
                $r=mysql_query("select courseid,semid from class_details where classid='$classid'");
                while($d=mysql_fetch_array($r))
                {
                    $co=$d["courseid"];
                    $sem=$d["semid"];
                }
                        //echo $co;
                ?>       
                SEMESTER
                <?php
                echo $sem;
                ?>       
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="table-responsive">
      <table width="50%"  class="table table-hover table-bordered">
        <tr>
            <th style="text-align: center;">ROLL NUMBER</th>
            <th style="text-align: center;">ADMISSION NUMBER</th>
            <th style="text-align: center;">STUDENT NAME</th>
            <th style="text-align: center;">STUDENT EMAIL</th>
            <th style="text-align: center;">STUDENT MOBILE</th>
            <th style="text-align: center;">PARENT MOBILE</th>
           <!-- <th style="text-align: center;">PARENT EMAIL</th> -->

            <th style="text-align: center;">EDIT PARENT DETAILS</th>
            <th style="text-align: center;">EDIT STUDENT DETAILS</th>

        </tr>

        <?php
//reading registration details
        $l=mysql_query("select students_list from staff_advisor where fid='$fid' and classid='$classid'") or die(mysql_error());
        $r=mysql_fetch_assoc($l);
        $s=explode('-', $r["students_list"]);
        for ($i=$s[0]; $i <=$s[1] ; $i++) { 
 			       	
      
        $resul=mysql_query("select studid,rollno from current_class where classid='$classid' and rollno='$i' order by(rollno)");
        while($data=mysql_fetch_array($resul))
        {
            $adm_no=$data["studid"];

            $rollno=$data["rollno"];

            $result=mysql_query("select name,email,mobile_phno from stud_details where admissionno='$adm_no'");

            while($dat=mysql_fetch_array($result))
            {
              $name=$dat["name"];
              $email=$dat["email"];
              $mobile_phno=$dat["mobile_phno"];
              $result1=mysql_query("select parentid  from parent_student where admissionno='$adm_no'");



              while($dat1=mysql_fetch_array($result1))
              {
                  $parentid=$dat1["parentid"];
              }



              $result2=mysql_query("select guard_contactno,guard_email  from parent where parentid='$parentid'");
              while($dat2=mysql_fetch_array($result2))
              {
                  $guard_contactno=$dat2["guard_contactno"];
                  $guard_email=$dat2["guard_email"];
              }


              ?>
              <tr >
                <td align="center"><?php  echo $rollno;?></td>
                <td align="center"><?php  echo $adm_no;?></td>
                <td align="center"><?php  echo $name;?></td>
                <td align="center"><?php  echo $email;?></td>
                <td align="center"><?php  echo $mobile_phno;?></td>
                <td align="center"><?php  if(isset($guard_contactno)) {echo $guard_contactno;} else { echo "Parent details Not avaliable";} ?></td>
               <!-- <td align="center"><?php  echo $guard_email; ?></td> -->



               <td>  <?php if(isset($guard_contactno)){ ?> <a href="editparent.php?pid=<?php echo $parentid;?>&sid=<?php echo $adm_no;?>">EDIT PARENT DETAILS</a>
                     <?php } else { echo "Not Found";}  ?> </td>
                    
               <td>   <a href="editstud.php?sid=<?php echo $adm_no;?>">EDIT STUDENT DETAILS</a></td>
                   






            </tr>
            <?PHP
        }
    }
}
    ?>
</table> 
</div>

<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>

<!-- /#wrapper -->   
<?php

include("includes/footer.php");
?>
