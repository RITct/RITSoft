<?php
//$con=mysqli_connect("localhost","root","","ritsoft");
include("includes/header.php");
include("includes/dbopen.php");
include("includes/sidenav.php");
//session_start();
$uname=$_SESSION['fid'];
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


      function show()
      {
        console.log('do');
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





     function showsub(str) {
      showDate ( str) ;
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
          // $.fn.datepicker.defaults.format = "yyyy-mm-dd";
          $('.date').datepicker({
            format: 'yyyy-mm-dd' ,
            autoclose: true
          }).on('changeDate', function (ev) {   
            show();
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

</head>
<body>
  <table class="table table-hover table-bordered" width="100%" border="1" >
    <tr>
      <td width="40%" valign="top">


        <form method="post" enctype="multipart/form-data" action="hod_hour_edit.php">
          <table  class="table table-hover table-bordered" align="center" width="100%" border="1">

            <tr>
              <td><label> Class</label></td>  
              <td>  
                <select name="class" id="class" onChange="showsub(this.value)"  class="form-control">
                  <option selected="selected" disabled="disabled">select</option>
                  <?php
                  $res=mysqli_query($con3,"select * from department where hod='$uname'");

                  if($rs=mysqli_fetch_array($res))
                  {
                   $res1=mysqli_query($con3,"select *from class_details where deptname='$rs[deptname]' and active='YES'");

                   while($rs1=mysqli_fetch_array($res1))
                   { 

                    ?>
                    <option value="<?php  $class=$rs1['classid']; echo $rs1['classid'].",".$rs1['courseid'].",S".$rs1['semid'].",".$rs1['branch_or_specialisation'];?>">
                      <?php echo $rs1['courseid'];?>,S<?php echo $rs1['semid'];?>,<?php echo $rs1['branch_or_specialisation'];?></option>
                      <?php
                      $bs=$rs1['branch_or_specialisation'];
                      $dept=$rs1['deptname'];
                    }
                  }
                  ?>
                </select><br /> 
              </td>
            </tr>

            <tr>
             <td><label>Date</label></td>
             <td>
              <div id="pdate"> 

                <!--  <input type="date" name="date" id="date" class="form-control"  placehodler="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" /> -->

              </div> 

            </td>
          </tr>


          <tr>
            <td><label style="text-transform: normal;">Choose hour to be swapped</label></td>
            <td><select name="hour" id="hour" class="form-control">
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
          <td><label style="text-transform: normal;">Choose hour to be swapped with</label></td>
          <td><select name="hour1" id="hour1" class="form-control">
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
        <td><input type="submit" id="btnshow" name="btnshow" value="Update Hour" class="btn btn-primary"  disabled="disabled"/></td></tr> 
      </table>
    </form>


    <?php        


    if(isset($_POST["btnshow"]))
      {		$s="";
    $e="";
    $d="";
    $a=explode(",",$_POST['class']);
	//$b=explode("-",$_POST['sub']);
    $c=$_POST["date"];
    $d=$_POST["hour"];
    $cd=$_POST["hour1"];
    $s=mysqli_query($con3,"select * from attendance where date='$c' and classid='$a[0]' and hour='$d'");
    $rs=mysqli_fetch_array($s);
    if($rs!=0)
    {
     $e=mysqli_query($con3,"update attendance set hour= (case hour when '$d' then '$cd' when  '$cd' then $d end) where date='$c' and classid='$a[0]' and hour='$d' or hour='$cd' ");
   }
   else
   {
    ?>
    <script>
      alert("No Data");
      window.location="hod_hour_edit.php";
    </script>
    <?php
  }



  if($e>0)
  {
    ?>
    <script>
      alert("Update Successful");
      window.location="hod_hour_edit.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Error In Updation");
      window.location="hod_hour_edit.php";
    </script>
    <?php
  }
}

?>    




</td>
<td valign="top">

  <div id="attendance">


    <table class="table table-hover table-bordered" width="100%" border="1" >
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
