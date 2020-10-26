<?php
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/header.php");
include("../connection.mysqli.php");
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

      }
      );
    </script>
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

            showDate( str );
          }
        }
      }

      function getbatch(str)
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

        xmlhttp.open("GET","getbatch.php?id="+str,true);
        xmlhttp.send();

        xmlhttp.onreadystatechange=function() 
        {
          if(xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("batch").innerHTML=xmlhttp.responseText;

          }
        }
      }


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
          });

        });





             if(xmlhttp.responseText.trim().length > 0 ) {
              $('#hoursMe').css('display', 'block');
              show();
            }



          } catch(err){}

        }
      }


    }

  </script>

  <script>


    $(document).ready(function() {
     $("#sub").change(function () {
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


 </script>

</head>
<body>
  <table class="table table-hover table-bordered" width="100%" border="1" >
    <tr>
      <td width="40%" valign="top">


        <form method="post" enctype="multipart/form-data" action="hos_update_hour.php"  onsubmit="return confirm('Do you really want to update hour attendance?');">
          <table  class="table table-hover table-bordered" align="center" width="100%" border="1">

            <tr>
              <td><label> Class</label></td>  
              <td>  
                <select name="class" id="class" class="form-control" onchange="showsub(this.value) ">
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
              </td>
            </tr>

            <tr><td><label>Subject </label></td> 
              <td><div id="sub">
                <select name="sub" class="form-control ">
                  <option>select</option>
                </select></div></td></tr>
                <tr>
                 <td><label>Date</label></td>
                 <td id="pdate">




                  <!-- <input type="date" name="date" id="date" class="form-control"  placehodler="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" />  -->

                </td>
              </tr>
              <tr>
<!--<td>Batch </td>
<td><div id="batch" class="form-control">
</div>
</td>-->
</tr>
<tr>
  <td><label>Hour To Be Changed</label></td>
  <td><select name="hour" class="form-control">
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
  <td><label>Change Hour To </label></td>
  <td><select name="hour1" class="form-control">
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
  <td><input type="submit" name="btnshow" id="btnshow" value="Update Hour" class="btn btn-primary"  disabled="disabled"/>  </td></tr> 
</table>
</form>

<?php

if(isset($_POST["btnshow"]))
  {	$e="";
$a=explode(",",$_POST['class']);
$b=explode("-",$_POST['sub']);
$c=$_POST["date"];
$d=$_POST["hour"];
$cd=$_POST["hour1"];

$res=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");

$i=0;


$res156=mysqli_query($con3,"select * from duty_leave where hour='$d' and leave_date='$c' and subjectid='$b[0]'  ");

if (mysqli_num_rows ( $res156 ) > 0) {
  ?>
  <script>
    alert("\t \tUnsuccessful Updation \n ( Duty leave assigned,  Please contact Staff Advisor for further updation) ");
    window.location="hos_update_hour.php";
  </script>
  <?php
} else {




  $s=mysqli_query($con3,"SELECT * from attendance where date='$c' and hour='$cd' ");
  while($s1=mysqli_fetch_array($s))
    { $i++;
    }
    if($i>0)
      {    ?>
        <script>
          alert("\t \tUnsuccessful Updation \n (Please contact HOD for further updation) ");
          window.location="hos_update_hour.php";
        </script>
        <?php
      }
      else
      {
       while($rs=mysqli_fetch_array($res))
       {
        $sid=$rs["studid"];
        $rt=mysqli_query($con3,"SELECT status from attendance where date='$c'and subjectid='$b[0]' and hour='$d' and studid='$sid'");

        while($rt1=mysqli_fetch_array($rt))
        {
         $sat=$rt1["status"];       

					//	echo "update attendance set hour='$cd' where date='$c'and subjectid='$b[0]' and hour='$d'<br/>";
         $e=mysqli_query($con3,"update attendance set hour='$cd',status='$sat',subjectid='$b[0]' where date='$c' and subjectid='$b[0]' and hour='$d' and studid='$sid'");



       }
     }
     if($e>0)
     {
       ?>
       <script>
        alert("Update Successfully");
        window.location="hos_update_hour.php";
      </script>
      <?php
    }
    else
    {
     ?>
     <script>
      alert("Error In Updation");
      window.location="hos_update_hour.php";
    </script>
    <?php
  }

}
}
}
?>    




</td>
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