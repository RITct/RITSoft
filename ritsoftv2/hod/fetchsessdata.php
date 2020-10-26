
<div class=".col-sm-6 .col-md-5 .col-md-offset-2 .col-lg-6 .col-lg-offset-0">
  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

    <tr>
     <th style="text-align: center;">ADMISSION NUMBER</th>
     <th style="text-align: center;">NAME</th>
     <?php
     include("../connection.php");
     $verSta = "waiting";
     $sessional_status = $verSta;
     if(isset($_POST["key"])){
       $classid=$_POST["key"];

       $re=mysql_query("select subjectid from subject_class where classid='$classid'");
       while($d=mysql_fetch_array($re)){
         $subjectid=$d["subjectid"];

         $ret=mysql_query("SELECT * FROM sessional_status WHERE classid= '$classid' AND subjectid = '$subjectid' AND verification_status = 1 ");
         while($dt=mysql_fetch_array($ret)){
           $verSta=$dt["sessional_status"];
           $sessional_status = $verSta;
         }



         ?>
         <th align="center">
          <?php 
          echo $subjectid; 
          ?>
          <br>
          <p class="form-control" style="width: 100%; text-align: center;  font-weight: 800; text-transform: uppercase;    <?php if($verSta == 'draft'){ echo " color: green;"; }else{ echo " color: blue;";}  ?>">
            <?php echo $verSta; ?>
          </p>

        </th>
      <?php }} ?>

      <th style="text-align: center;">STATUS</th>
    </tr>

    <?php $st=1;
    if(isset($_POST["key"])){
      $classid=$_POST["key"];
      $x=mysql_query("select rollno from current_class where classid='$classid'");

      $resul=mysql_query("select distinct(studid)from sessional_marks where classid='$classid' order by(studid)");
      while($dat=mysql_fetch_array($resul))
      {
       $studid=$dat["studid"];
       $re=mysql_query("select name from stud_details where admissionno='$studid'");
       while($d=mysql_fetch_array($re))
       {
        $name=$d["name"];		
      }

      ?>
      <tr>
        <td align="center"><?php echo $studid;?></td>
        <td align="center"><?php echo $name;?></td>
        <?php
        $verSta = "waiting";
        $verification_status = 0;
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
          $status=$data["verification_status"];
          $verification_status=$data["verification_status"];
         //  if($status=="Verified by staff advisor")
         //  {
         //   $st=0;
         // }
          $verSta=$data["verification_status"];





        }
        ?>
        <td align="center"><?php /*echo $subjectid; echo " : ";*/ echo $sessional_marks;?>




        <div class=" "  style="text-align: center; margin: 1rem 0 ;">
          <?php if( $verification_status == 0): ?>
            <div class=" ">

              <p style=" color: blue; text-transform: uppercase; border: 1px solid; padding: 0.4rem;font-size: 10px;  "> 
                <span> waiting for verification  </span>
              </p>
              <?php 
              $dis_option  = " disabled='disabled' "; ?>
            </div>
            <?php elseif( $verification_status == -1 ):  ?>
              <div class=" ">

                <p style=" color: red; text-transform: uppercase; border: 1px solid; padding: 0.4rem;font-size: 10px;  "> 
                  <span>   rejected </span>
                </p>

              </div>

              <?php elseif( $verification_status == 1   ):  ?>
                <div class=" ">

                  <p style=" color: green; text-transform: uppercase; border: 1px solid; padding: 0.4rem;font-size: 10px;  "> 
                    <span> <?php echo $sessional_status;  ?>  published  </span>
                  </p>



                </div>  
                <?php elseif( $verification_status == 2  ):  ?>
                  <div class=" ">

                    <p style=" color: orange; text-transform: uppercase; border: 1px solid; padding: 0.4rem;font-size: 10px;  "> 
                      <span> <?php echo $sessional_status;  ?> changed  </span>
                    </p>



                  </div>  
                  <?php else: ?>
                    <div class=" ">

                      <p style=" color: green; text-transform: uppercase; border: 1px solid; padding: 0.4rem;font-size: 10px;  "> 
                        <span> <?php echo $sessional_status;  ?>  published  </span>
                      </p>

                    </div>

                  <?php endif; ?>

                </div>


              </td>


    <!--    <p class="form-control" style="width: 100%; text-align: center;  font-weight: 800; text-transform: uppercase;    <?php if($verSta == 'draft'){ echo " color: green;"; }else{ echo " color: blue;";}  ?>">
         <?php echo $verSta; ?>
       </p>
     -->










     <?php
   }
   if($st!=0)
   {
    ?>
    <td align="center"><?php echo $status;?></td>
    <?php
  }
  else
  {
   $st=1;
   ?>
   <td align="center">
    <div class="btn-group">
     <a href="sessedit.php?id=<?php echo $studid; ?>&clsid=<?php echo $classid; ?>">verify</a>
   </div>
 </td>
 <?php
}
?>
</tr>    
<?php
}}
?>
</table> 


<table width="40%" class="table table-striped table-bordered table-hover">

  <tr> <th> SUBJECT ID </th> <th> SUBJECT NAME </th></tr>
  <?php
  $c=mysql_query("select * from subject_class where classid='$classid' order by subjectid asc",$con);
  while($re=mysql_fetch_array($c))
  {
    ?>
    <tr>    
      <td scope="col"><?php echo $re["subjectid"]; ?></th>
        <td scope="col" align="left"><?php echo $re["subject_title"]; ?></th>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>
  <?php  include("includes/footer.php");    ?>