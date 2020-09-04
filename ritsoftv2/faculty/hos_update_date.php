<?php
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/header.php");
include("includes/connection3.php");
include("includes/sidenav.php");
//session_start();
$uname=$_SESSION['fid'];

$se = false;
?>
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

        $('#date').attr('max', maxDate);
        $('#date1').attr('max', maxDate);

      }
      );
    </script>
    <script>



      function show()
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

        var e = document.getElementById("class");
        var subject = e.options[e.selectedIndex].value;

        var date = document.getElementById("date").value;

        xmlhttp.open("GET","show_attendance.php?class="+subject+"&date="+date,true);
        xmlhttp.send();

        xmlhttp.onreadystatechange=function() 
        {
          if(xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("attendance").innerHTML=xmlhttp.responseText;

          }
        }
      }


      function show1()
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

        var e = document.getElementById("class");
        var subject = e.options[e.selectedIndex].value;

        var date = document.getElementById("date1").value;

        xmlhttp.open("GET","show_attendance.php?class="+subject+"&date="+date,true);
        xmlhttp.send();

        xmlhttp.onreadystatechange=function() 
        {
          if(xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("attendance").innerHTML=xmlhttp.responseText;

          }
        }
      }




    </script>



    <script>



     $(document).ready(function() {       

      $("#hour1").change(function () {
        var str = "";
        if ($("#sub option:selected").val()=='')
        {
                //$("#errmsg").html("Please select subject");
                 //$().message("Select subject!");
                 $('#btnshow').attr('disabled', 'disabled');  
               }
               else
               {

                $('#btnshow').removeAttr('disabled');
              }
            });
    });



     $(document).ready(function() {
       $("#hour").change(function () {
        var str = "";
        if ($("#sub option:selected").val()=='')
        {
                //$("#errmsg").html("Please select subject");
                 //$().message("Select subject!");
                 $('#button1').attr('disabled', 'disabled');  
               }
               else
               {

                $('#button1').removeAttr('disabled');
              }
            });
     });







     $(document).ready(function() {
       $("#class").change(function () {
        var str = "";
        if ($("#sub option:selected").val()=='')
        {
                //$("#errmsg").html("Please select subject");
                 //$().message("Select subject!");
                 $('#button').attr('disabled', 'disabled');  
               }
               else
               {

                $('#button').removeAttr('disabled');
              }
            });
     });
     String.prototype.replaceAll = function(search, replacement) {
      var target = this;
      return target.replace(new RegExp(search, 'g'), replacement);
    };

    function doSomeStf ( str){
      console.log(str);
      console.log(str.replaceAll(',','-'));
      showDate ( str);
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
          try { 


           jQuery(document).ready(function($) {

          // $.fn.datepicker.defaults.format = "yyyy-mm-dd";
          $('.date').datepicker({
            format: 'yyyy-mm-dd' ,
            autoclose: true
          }).on('changeDate', function (ev) { 
            show();

            doSomeOther();
          });

        });





           if(xmlhttp.responseText.trim().length > 0 ) {
            $('#hoursMe').css('display', 'block');
            show();
          }



          doSomeOther();
        } catch(err){}

      }
    }


  }


  var doSomeOther = ( ) =>  {

    $('#date2').css('display', 'none');
    
    $dateStaRT = $('#date').closest('.date').attr('data-date-start-date');
    $date = $('#date').closest('.date').attr('data-date-end-date');





    $strTo = '<div class="input-group date no-contro" data-provide="datepicker"   data-date-start-date="'+$dateStaRT+'" data-date-end-date ="'+$date+'" >'+
    ' <input type="text" class="form-control mydate datepicker-autoclose"  value="'+ $dateStaRT+'"  id="date1"   name="date1" placeholder="Date " required >'+
    '<div class="input-group-addon">'+
    '<span class="fa fa-calendar"></span>'+
    '</div>';

    $('#date2').html($strTo);

    $('#date2').css('display', 'block');

  };

</script>






</head>
<body>
  <table class="table table-hover table-bordered" width="100%" border="1" >
    <tr>
      <td width="40%" valign="top">


        <form method="post" enctype="multipart/form-data" action="hos_update_date.php"  onsubmit="return confirm('Do you really want to change attendance?');">
          <table  class="table table-hover table-bordered" align="center" width="100%" border="1">
           <tr>
            <td> Class</td>  
            <td>  
              <select name="class" id="class" class="form-control" onChange="doSomeStf(this.value)">
                <option>select</option>
                <?php
                $c=mysqli_query($con3,"select distinct(classid) from subject_allocation where fid='$uname'");

                while($res=mysqli_fetch_array($c))
                {
                 $res1=mysqli_query($con3,"select *from class_details where classid='$res[classid]' and active='YES'");
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


              <tr>
               <td>Date To Be Changed</td>
               <td id="pdate">




                  <!-- <input type="date" name="date" id="date" class="form-control"  placehodler="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" />
                   <input type="button" name="button" id="button" value="Show" disabled="disabled" class="btn btn-primary" onclick="show()" />  -->

                 </td>
                 <td>
                 </td>

               </tr>

               <tr>
                <td>Hour To Be Changed</td>
                <td><select name="hour" id="hour" class="form-control">
                 <option>select</option>
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                 <option value="6">6</option>
               </select>
               <div id="hour"></div>
             </td>
           </tr>



           <tr>
             <td>Change Date To</td>
             <td>

              <div id="date2"  style="display: none;">


               <!-- 
 <input type="date" name="date1" id="date1" class="form-control"  placehodler="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" />
               <input type="button" name="button" id="button1" value="Show" class="btn btn-primary" disabled onclick="show1()" />

             -->
           </div>

         </td>

       </tr>


       <tr>
        <td>Change Hour To </td>
        <td><select name="hour1" id="hour1" class="form-control">
          <option>select</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
        </select>
        <div id="hour1"></div>
      </td>
    </tr>


    <tr>
      <td></td>
      <td><input type="submit" name="btnshow" id="btnshow"  value="Update Date" class="btn btn-primary" disabled="disabled"  />  </td></tr> 
    </table>
  </form>
  <?php
  if(isset($_POST["btnshow"]))
  {
    $cls=explode(",",$_POST['class']);
    $h=$_POST["hour"];
    $date=$_POST["date"];
    $h2=$_POST["hour1"];
    $date2=$_POST["date1"];
    $i=0;
    $res=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$cls[0]' and c.studid=b.admissionno order by c.rollno asc");


    $res156=mysqli_query($con3,"select * from duty_leave where hour='$h' and leave_date='$date'   ");
    
    if (mysqli_num_rows ( $res156 ) > 0) {
      ?>
      <script>
        alert("\t \tUnsuccessful Updation \n ( Duty leave assigned,  Please contact Staff Advisor for further updation) ");
        window.location="hos_update_date.php";
      </script>
      <?php
    } else {
     
     // $sub =0;

      $s=mysqli_query($con3,"SELECT subjectid from attendance where date='$date' and hour='$h' and classid='$cls[0]' ");
      while($s1=mysqli_fetch_array($s))
      {
        $sub=$s1['subjectid'];

      }


      $res2=mysqli_query($con3,"select subjectid from subject_allocation where subjectid='$sub' and fid='$uname'"); 
      if(mysqli_fetch_array($res2)!=null)
      { 



        $s2=mysqli_query($con3,"SELECT * from attendance where date='$date2' and hour='$h2' and classid='$cls[0]' ");
        while($s3=mysqli_fetch_array($s2))
        {
          $i++;

        }
        if($i>0)
        {
          ?>            <script>
            alert(" Unsuccessful Updation");
            window.location="hos_update_date.php";
          </script>
          <?php

        }
        else {






          while($rs=mysqli_fetch_array($res))
          {
            $sid=$rs["studid"];
            $rt=mysqli_query($con3,"SELECT status from attendance where date='$date'and subjectid='$sub' and hour='$h' and studid='$sid'");

            while($rt1=mysqli_fetch_array($rt))
            {
              $sat=$rt1["status"];       

              $e=mysqli_query($con3,"update attendance set hour='$h2',status='$sat',subjectid='$sub',date='$date2' where date='$date'and subjectid='$sub' and hour='$h' and studid='$sid'");



            }
          }

          if($e>0)
          {
            ?>
            <script>
              alert("Update Successfully");
              window.location="hos_update_date.php";
            </script>
            <?php
          }





        }


      }  

      else
      {
       ?>
       <script>
        alert(" unsuccessful Updation");
        window.location="hos_update_date.php";
      </script>
      <?php

    }
  }

} 


?>        

<td valign="top">

  <div id="attendance">


    <table  class="table table-hover table-bordered" width="100%" border="1">
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
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>


</div>

<br />
<br />
<br />






</body>

</html>




<?php include("includes/footer.php");   ?>        