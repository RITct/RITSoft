    <?php
     // session_start();
//$con=mysqli_connect("localhost","root","","ritsoft");
    include("includes/connection1.php");
  
    $uname=$_SESSION['fid'];
    if(strlen($_REQUEST['class'])>1 && strlen($_REQUEST["date"])>1)
    { 

      $a=explode(",",$_REQUEST['class']);
      // $subr=explode(",",$_REQUEST['subject']);
      $date=$_REQUEST["date"];
      $subIdd = array();

      ?>
      <table class="table table-hover table-bordered">
        <tr>
          <th rowspan="2" scope="col">Roll No</th>
          <th rowspan="2" scope="col">Name</th>
          <th scope="col">Hour 1</th>
          <th scope="col">Hour 2</th>
          <th scope="col">Hour 3</th>
          <th scope="col">Hour 4</th>
          <th scope="col">Hour 5</th>
          <th scope="col">Hour 6</th>
        </tr>
        <tr>
         <?php
         for($i=1;$i<=6;$i++)
         {
           ?>
           <th align="center"> <span style="font-size: 10px;"><?php
           // echo "select * from subject_class c,attendance a where a.subjectid=c.subjectid and a.hour='$i' and a.date='$date' and a.classid='$a[0]'";

//            echo "select * from subject_class c,attendance a where a.subjectid=c.subjectid and a.hour='$i' and a.date='$date' and a.classid='$a[0]'";
// $st1v  = "select DISTINCT(c.subjectid) from subject_class c,attendance a where a.subjectid=c.subjectid and a.hour='$i' and a.date='$date' and a.classid='$a[0]'";



           $res=mysqli_query($con,"SELECT * FROM subject_class WHERE classid='$a[0]' and subjectid IN ( select DISTINCT(c.subjectid) from subject_class c,attendance a  where a.subjectid=c.subjectid and a.hour='$i' and a.date='$date' and a.classid='$a[0]' )");
           $acrho = 0;
           if(mysqli_num_rows($res) > 0){
             while($rs=mysqli_fetch_array($res))
             {
              if( $acrho   != 0) {
                echo " / ";
              } 

              echo $rs["subject_title"];   


              if($rs["type"]=="ELECTIVE")
                echo "<sub  style='color: blue;'>ELECTIVE</sub>";
              else if($rs["type"]=="LAB"){
                array_push($subIdd, array( 'hour' => $i, 'subject' =>$rs["subjectid"] ));

                echo "<sub style='color: orange;'>LAB</sub>";
              }  

              $acrho++;
            }
          }
          else
            echo "--";				
          ?></span></th>
          <?php
        }
        ?>
      </tr>
      <?php
//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
      $res=mysqli_query($con,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");

      $i=1;
      while($rs=mysqli_fetch_array($res)) {
        $sid=$rs["rollno"];
        ?>
        <tr>
          <td><?php echo $rs["rollno"]; ?></td>
          <td><?php echo $rs["name"]; ?></td>

          <?php
          for($i=1;$i<=6;$i++)
          {

            ?>
            <td align="center" batch="<?php
            foreach($subIdd as $singe){
              if( $singe['hour'] == $i){
                if($singe['subject'] && isset($rs['studid'])) { 
                 $quey =  " SELECT * FROM `lab_batch_student` l LEFT JOIN lab_batch b ON l.batch_id = b.batch_id WHERE l.studid = '".$rs['studid']."' AND b.sub_code= '".$singe['subject']."' ";
                 $resdfd=mysqli_query($con, $quey);
                 $cods = '';

                 if( $resdfd)
                 while($rrts=mysqli_fetch_array($resdfd)) {
                  $cods = $rrts['batch_id'];

                }

                echo $cods ;
              }

            }
          }

          ?>"   subject="<?php

          $resSE=mysqli_query($con, "select * from attendance where hour='$i' and date='$date' and studid='$rs[studid]' and classid='$a[0]'");
          if($rsr=mysqli_fetch_array($resSE)) {
            echo $rsr["subjectid"];
          }

          ?>"> <?php
          $res1=mysqli_query($con,"select * from attendance where hour='$i' and date='$date' and studid='$rs[studid]' and classid='$a[0]'");




          if($rs1=mysqli_fetch_array($res1)){  
           $statuStar =  $rs1["status"];  
           if( strtolower(trim($rs1["status"])) == 'p'){ 
             $res156=mysqli_query($con,"select * from duty_leave where hour='$i' and leave_date='$date' and studid='$rs[studid]' and subjectid='$rs1[subjectid]'  ");

             if (mysqli_num_rows ( $res156 ) > 0) { 
              $statuStar = '<b style="padding-right:0.5rem;">P</b> <span class="" style="padding: 5px;background:  green;border-radius:  50px;position:  absolute;" title="duty leave assigned"><span></span></span>';
            }
          } else {
            $statuStar = ' <span style="color:red; font-weight: 800;"  >'.$statuStar.'</span> ';
          }

          echo  $statuStar;

        } else {

          echo "--";				
        }
        ?></td>
        <?php
      }
      ?>
    </tr>
    <?php
  }
  ?>
</table></td>
</tr>
</table>
<?php
}
else
{
	?>
  <table class="table table-hover table-bordered">
    <tr>
      <th rowspan="2" scope="col">Roll No</th>
      <th rowspan="2" scope="col">Name</th>
      <th scope="col">Hour 1</th>
      <th scope="col">Hour 2</th>
      <th scope="col">Hour 3</th>
      <th scope="col">Hour 4</th>
      <th scope="col">Hour 5</th>
      <th scope="col">Hour 6</th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" align="center"><strong>No Data To Display</strong></td>
    </tr>
  </table></td>
</tr>
</table>
<?php
}
?>
<?php include("includes/footer.php");   ?>
