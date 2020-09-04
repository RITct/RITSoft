<?php
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/header.php");
include("includes/sidenav.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/connection3.php");

//session_start();
//$bs="";
//$c="";
//$s="";
//$e="";
//$sub_t="";
//$class="";
//$date1="";
//$date2="";
$st=$_SESSION['fid'];


$se = true;
?>
<script type="text/javascript"> 
  if(typeof jQuery == 'undefined'){
    document.write('<script src="../dash/vendor/jquery/jquery.min.js"></'+'script>');
  }
</script> 
<title>Attendance</title>
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

    xmlhttp.open("GET","getsub_att.php?id="+str,true);
    xmlhttp.send();

    xmlhttp.onreadystatechange=function() 
    {
      if(xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("sub").innerHTML=xmlhttp.responseText;
        showDate ( str) ;
      }
    }
  }

  function showDate ( str) {

    $('#hoursMe').css('display', 'none');

    var xmlhttp;
    if (window.XMLHttpRequest)
    {
      xmlhttp=new XMLHttpRequest();
    }
    else
    {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("GET","getDate.php?id="+str,true);
    xmlhttp.send();

    xmlhttp.onreadystatechange=function() 
    {
      if(xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("pdate").innerHTML=xmlhttp.responseText; 
        

        $('#date').attr('id', 'date1');
        $('#date1').attr('name', 'date1'); 


        try { 


         jQuery(document).ready(function($) {

          // $.fn.datepicker.defaults.format = "yyyy-mm-dd";
          $('.date').datepicker({
            format: 'yyyy-mm-dd' ,
            autoclose: true
          }).on('changeDate', function (ev) {   
            console.log("f");
            doSomeOther();
          });

        });





         if(xmlhttp.responseText.trim().length > 0 ) {
          $('#hoursMe').css('display', 'block');
          
        }


        doSomeOther();
      } catch(err){}

    }
  }


}


var doSomeOther = ( ) =>  { 
  $('#datex2').css('display', 'none');
  $dateStaRT = $('.mydate').val();
  $date = $('.mydate').closest('.date').attr('data-date-end-date');





  $strTo = '<div class="input-group date " data-provide="datepicker"   data-date-start-date="'+$dateStaRT+'" data-date-end-date ="'+$date+'" >'+
  ' <input type="text" class="form-control mydate datepicker-autoclose"  value="'+ $dateStaRT+'"  id="date2"   name="date2" placeholder="Date " required >'+
  '<div class="input-group-addon">'+
  '<span class="fa fa-calendar"></span>'+
  '</div>';

  $('#datex2').html($strTo);

  

  $('#datex2').css('display', 'block');

};



console.log('doSomeOther');
// $(document).on('change', '.mydate', function(event) {
//   // event.preventDefault();
//   console.log('doSomeOther');
//   doSomeOther();
// });


</script>














<div id="page-wrapper">
  <link href="jquery-ui.css" rel="stylesheet">
  <script src="jquery.js" type="text/javascript"></script>
  <script src="jquery-ui.js" type="text/javascript"></script>
  <script>
    $(document).ready(function()
    {
      var dtToday = new Date();
  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
  var day = dtToday.getDate(); 
  //var day1= date('Y-m-d', strtotime('-2 day',strtotime($date_raw)));
  


        //var  day1 = strtotime('-3 day', time());
        var year = dtToday.getFullYear();
        if(month < 10)
          month = '0' + month.toString();
        if(day < 10)
          day = '0' + day.toString();



        var maxDate = year + '-' + month + '-' + day;

        $('#date1').attr('max', maxDate);
        $('#date2').attr('max', maxDate);
      }
      );

    function getbatch(str) {

      $('#batchP').css('display', 'none');
      var xmlhttp;
      if (window.XMLHttpRequest)
      {
        xmlhttp=new XMLHttpRequest();
      }
      else
      {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.open("GET","getbatch.php?id="+str,true);
      xmlhttp.send();

      xmlhttp.onreadystatechange=function() 
      {
        if(xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          if( (xmlhttp.responseText+"").trim().length > 0)
            $('#batchP').css('display', 'table-row');
          document.getElementById("batch").innerHTML=xmlhttp.responseText;

        }
      }  
    }




    $(document).ready(function($) {
      $('.doShowDetails').attr("disabled","false");

      $(document).on('click', '.doShowDetails', function(event) {
        event.preventDefault();
        search = $(this).attr('href'); 


        $.ajax({url: search, success: function(result){ 
          $('#myModal .modal-body').html( result ); 
        }});
        $('#myModal .modal-body').html( `

          <div style="width: 100%; text-align: center; padding: 1rem;">
          <img src="../images/loading-bar.gif">
          </div>

          ` ); 
        $('#myModal').modal('show');

    // console.log(search);
    // search =  JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')
    // console.log(search);



  });
    });

  </script>

</head>
<body>




  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="">View details </h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <form name="form1" method="post" action="elective_action.php" id="doSubmitAttConf" style="display: none;"> </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
        </div>
      </div>

    </div>
  </div>



  <div class="map_contact">
   <div class="container">

    <h3 class="tittle"></h3>
    <div class="contact-grids" align="center">

     <div class="col-md-8 contact-grid" style="text-align:center">
      <form method="post" enctype="multipart/form-data" action="single_sub_staff_view.php"><br><br><br>
        <h2>View Attendance</h2>

        <table  align="center" width="700" class="table table-hover table-bordered">

          <tr><td><label>
          Class</label></td><td>
            <select name="class" onChange="showsub(this.value)" class="form-control">
              <option>select</option>
              <?php
              $c=mysqli_query($con3,"select distinct(classid) from subject_allocation where fid='$st'");

              while($res=mysqli_fetch_array($c))
              {
               $res1=mysqli_query($con3,"select *from class_details where classid='$res[classid]' and active='YES'");
               while($rs=mysqli_fetch_array($res1))
               {
                ?>
                <option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
                  <?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
                  <?php       $dept=$rs['deptname'];
                  $cid=$rs['courseid'];
                  $bs=$rs['branch_or_specialisation'];
                }
              }
              ?>
            </select>

          </td></tr>
          <tr><td><label>Subject</label> </td> <td><div id="sub">
            <select name="sub" class="form-control">
              <option>select</option>
            </select></td>
          </tr>
          <tr id="batchP" style="display: none;">
            <td><label>Batch</label> </td>
            <td>
              <div id="batch"></div>
            </td>
          </tr>

          <tr>
            <td>

              <label>Date from</label> </td>



              <td id="pdate"> 

                <!-- <input type="date" name="date1" id="date1" class="form-control" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />   -->

              </td>


            </tr>
            <tr><td><label>Date to</label></td>
              <td>
                <div id="datex2"  style="display: none;">


               <!--  <input type="date" name="date2" id="date2"class="form-control" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />
               -->
             </div>



           </td>
         </tr>
       </table>
<!--<input type="date" name="date1" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />
  <input type="date" name="date2" placehodler="dd/mm/yyyy" value="<?php echo date("d/m/Y"); ?>" />-->
  <input type="submit" name="btnshow"  value="View Attendance" class="btn btn-primary" />
  &nbsp;
  &nbsp;
  &nbsp;
  &nbsp;
  <!--input type="submit" name="submit" value="print"  /> -->
</form>

<?php

?>
<?php
if(isset($_POST["btnshow"]) && isset($_POST["sub"]))
{
	$class=explode(",",$_POST['class']);
	$s=explode("-",$_POST['sub']);
  $date1=$_POST["date1"];

        //echo $date1;
  $date2=$_POST["date2"];	
  ?>
  <style type="text/css">
  #wrapper {
    overflow-x: hidden;
  }
</style>







<?php if(isset($_POST['date1']) && isset($_POST['date2'])): ?>
<table class="table table-bordered" style="margin-top: 2rem;">




  <?php if( isset($_POST['class'])){ 
   $class1=explode(",",$_POST['class']);?>

   <tr>
    <td  >
      <b> Class : </b>
    </td>
    <td  >
        <?php //echo $_POST['class'];
        echo $class1[1]." ".$class1[2]; 
        ?>
      </td>
    </tr>
  <?php } ?>

  <?php if( isset($_POST['sub'])):// $s1=explode("-",$_POST['sub']);
  ?>
  <tr>
    <td  >
      <b> Subject : </b>
    </td>
    <td  >
      <?php  

      $res=mysqli_query($con3,"SELECT * FROM subject_class WHERE subjectid ='".explode('-', $_POST['sub'])[0]."' ");

      if(mysqli_num_rows($res) > 0){
       while($rs=mysqli_fetch_array($res)) {  

        echo $rs["subject_title"];   
      }
    }
    ?>
    <sub>
      <?php


      echo $_POST['sub']; ?>
    </sub>
  </td>
</tr>
<?php endif; ?>

<?php  if( isset($_POST['batch'])): ?>
  <tr>
    <td >
      <b> Batch : </b>
    </td>
    <td >
      <?php 

      foreach ($_POST['batch'] as $key => $value) {
        if($key !=0 )
          echo ", ";

        $re74=mysqli_query($con3,"select * from lab_batch where batch_id='$value'  ");
        if(($rs0=mysqli_fetch_array($re74))) { echo $rs0['batch_name'];
                                                     // $batch3=$rs0['batch_name'];
      }


    }?>

  </td>
</tr>
<?php endif; ?>

<?php if( isset($_POST['date'])): ?>
  <tr>
    <td  >
      <b> Date : </b>
    </td>
    <td  >
      <?php echo $_POST['date']; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if( isset($_POST['hour'])): ?>
  <tr>
    <td >
      <b> Hour : </b>
    </td>
    <td >
      <?php echo $_POST['hour']; ?>
    </td>
  </tr>
<?php endif; ?>

<tr> 
  <td><label>Date from</label> : <?php if(isset($_POST['date1'])) echo $_POST['date1'] ; ?></td>
  <td><label>Date to</label> : <?php if(isset($_POST['date2'])) echo $_POST['date2'] ; ?></td>
</tr>



<?php if(  true ): ?>
 <!-- <tr  >
    <td>
      <b> Total Hours Taken : </b>
    </td>
    <td>

      <?php 

      $class=explode(",",$_POST['class']);
      $s=explode("-",$_POST['sub']);
      $date1=$_POST["date1"];

        //echo $date1;
      $date2=$_POST["date2"]; 


      $re74=mysqli_query($con3,"select count(date) AS count from attendance where   date BETWEEN '$date1' AND '$date2' and subjectid='".$s[0]."' and classid='$class[0]' group by date,hour ");

      $tothrs=mysqli_num_rows($re74);   // echo $tothrs; 

       //if(($rs0=mysqli_fetch_array($re74))) { echo $rs0['count']; }


      ?>

    </td>
  </tr> -->


<?php endif; ?>



</table>
<?php endif; ?>

<table class="table table-hover table-bordered">
 &nbsp;
 &nbsp;
 &nbsp;
 &nbsp;
 <tr>
  <td>Roll No</td>
  <td>Name</td>
  <td>Total Hrs Present</td>
  <td>Total Hrs Taken</td>

  <td>
    <?php
    //echo "select subject_title from subject_class where subjectid='$s[0]' and type='$s[1]'";
    //$res6=mysqli_query($con3, "select subject_title from subject_class where subjectid='$s[0]' and type='$s[1]'");
  //while($rs4=mysqli_fetch_array($res6))
   //echo $rs4;
    //echo "select * from subject_allocation where subjectid='$res6[subjectid]' and  classid='$class[0]' and fid='$st'";
 //while($rs4=mysqli_fetch_array($res6))   {
    $type0 = '';
    $res=mysqli_query($con3,"select * from subject_allocation where subjectid='$s[0]' and  classid='$class[0]' and fid='$st'");// order by subjectid asc");
    $r1=mysqli_query($con3,"select * from subject_class where subjectid='$s[0]'");
    while($r2=mysqli_fetch_array($r1))  {
      $sub_t=$r2["subject_title"];
      $type0 = $r2["type"];
    }
//echo "select * from subject_allocation where subjectid='$s[0]' and  classid='$class[0]' and fid='$st'";
 //}
    while($rs=mysqli_fetch_array($res))
    {
     ?><?php echo $rs["subjectid"]; ?>
     <?php
   }
   ?>
 </td>
 <td></td>
</tr>
<?php
	//$res2=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$class[0]' and a.new_sem='$class[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");


$batch="";
$i = 0;
if(isset($_POST['batch'])){
  foreach($_POST['batch'] as $selected){
    $selected = "'$selected'";

    if($i==0)
     $batch=$selected;
   else
    $batch=$batch.",".$selected;
  $i++;
} 
} 

/*
SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.studid IN ( SELECT * FROM `lab_batch_student` l LEFT JOIN lab_batch b ON b.batch_id = l.batch_id ) AND c.classid='PG28' and c.studid=b.admissionno order by c.rollno asc
*/
$batch = trim($batch);

$res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$class[0]' and c.studid=b.admissionno order by c.rollno asc");

if($type0 == 'ELECTIVE') {

  $res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.studid IN ( SELECT stud_id FROM `elective_student`
    WHERE sub_code = '$s[0]' ) AND c.classid='$class[0]' and c.studid=b.admissionno order by c.rollno asc");
} else if(isset($_POST['batch'])){
  if($type0 == 'LAB') {   



    if( $batch== "'all'"){

      $res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.studid IN ( SELECT l.studid FROM `lab_batch_student` l LEFT JOIN lab_batch b ON b.batch_id = l.batch_id WHERE b.sub_code ='$s[0]'  ) AND c.classid='$class[0]' and c.studid=b.admissionno order by c.rollno asc"); 
    } else {
     $res2=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.studid IN ( SELECT l.studid FROM `lab_batch_student` l LEFT JOIN lab_batch b ON b.batch_id = l.batch_id WHERE b.sub_code ='$s[0]' AND b.batch_id IN ( $batch ) ) AND c.classid='$class[0]' and c.studid=b.admissionno order by c.rollno asc"); 
   }

   
 }  
}


while($rs2=mysqli_fetch_array($res2))
{
 $_SESSION['admis']=$rs2["studid"];
 $admis=$_SESSION['admis'];
 $name=$rs2["name"];

 $i=1;
 $sid=$rs2["rollno"];
 ?>           
 <tr>
  <td><?php echo $rs2["rollno"]; ?></td>
  <td><?php echo $rs2["name"]; ?></td>
  <?php
  $total=0;
  $present=0;
				$res3=mysqli_query($con3,"select * from subject_allocation where subjectid='$s[0]' and classid='$class[0]' and fid='$st' ");//order by subjectid asc");
				while($rs3=mysqli_fetch_array($res3))
				{
					
					$res4=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$class[0]' AND ( status = 'P' OR status = 'A' )") ;
					$e=mysqli_num_rows($res4);
                                        //echo "$e<\br>";
          $res5=mysqli_query($con3,"select distinct date,subjectid,hour from attendance where studid='$rs2[studid]' and date BETWEEN '$date1' AND '$date2' and subjectid='$rs3[subjectid]' and classid='$class[0]' and status='P'");
          $e1=mysqli_num_rows($res5);
                                //        echo $e1;
          ?>
          <td><?php echo $e1;?></td>
          <td><?php echo $e;?></td>
          <td><?php if(mysqli_num_rows($res4)==0)
          echo "0%";
          else{
           $present=(mysqli_num_rows($res5)/mysqli_num_rows($res4))*100;
                                   //elseif (mysqli_num_rows($res4<0)) 
                                 //echo "0%";   

           if($present<85)
           {
            ?>
            <font color="#FF0000"><?php echo round($present,2)." %"; ?></font>
            <?php 
          }
          else
          {
           echo round($present,2)." %";
         }
       }	
       ?>
     </td>
     <?php						
   }
   ?>
   <td> <a class="doShowDetails" disabled="disabled" href="attendance_search_subject.php?date1=<?php echo "$date1";?>&date2=<?php echo "$date2";?>&subj=<?php echo "$s[0]";?>&admis=<?php echo $admis;?>&name=<?php echo "$name"; ?>&class=<?php echo "$class[0]";  ?>">View details </a></td>
 </tr>
 <?php
}

?>

<?php
$res1new=mysqli_query($con3,"select *from class_details where classid='$class[0]' and active='YES'");
               while($rsnew=mysqli_fetch_array($res1new))
               {
                  $dept1=$rsnew['deptname'];
                  $semid1=$rsnew['semid'];
                  $courseid1=$rsnew['courseid'];
                  $branch_or_specialisation1=$rsnew['branch_or_specialisation'];


               }
?>


</table>
<table align="center">    &nbsp;
  &nbsp;
  &nbsp;
  &nbsp;
  &nbsp;                       
  <tr>
    <td> <!-- <a target='_blank' href="pdf_single_sub.php?subj=<?php echo "$s[0]";?>&dept=<?php echo "$dept1";?>&e=<?php echo "$e";?>&sub_t=<?php echo "$sub_t";?>&bs=<?php echo "$bs";?>&cid=<?php echo "$cid";?>&cls=<?php echo "$class[0]";?>&cls2=<?php echo "$class[2]";?>&st=<?php echo "$st";?>&date1=<?php echo "$date1";?>&date2=<?php echo "$date2";?>&batch=<?php echo "$batch";?>">Print</a>&nbsp;&nbsp;&nbsp;&nbsp;-->

<a target='_blank' href="pdf_single_sub.php?subj=<?php echo "$s[0]";?>&dept=<?php echo "$dept1";?>&e=<?php echo "$e";?>&sub_t=<?php echo "$sub_t";?>&bs=<?php echo "$branch_or_specialisation1";?>&cid=<?php echo "$courseid1";?>&cls=<?php echo "$class[0]";?>&cls2=<?php echo "$semid1";?>&st=<?php echo "$st";?>&date1=<?php echo "$date1";?>&date2=<?php echo "$date2";?>&batch=<?php echo "$batch";?>">Print</a>&nbsp;&nbsp;&nbsp;&nbsp;

      <a target='_blank' href="excel.php?subj=<?php echo "$s[0]";?>&dept=<?php echo "$dept";?>&e=<?php echo "$e";?>&sub_t=<?php echo "$sub_t";?>&bs=<?php echo "$bs";?>&cid=<?php echo "$cid";?>&cls=<?php echo "$class[0]";?>&cls2=<?php echo "$class[2]";?>&st=<?php echo "$st";?>&date1=<?php echo "$date1";?>&date2=<?php echo "$date2";?>&batch=<?php echo "$batch";?>">Export to Excel</a></td>


    </tr></table>
    <?php
  }
  ?>
</body>
</html>
<?php include("includes/footer.php");   ?>
