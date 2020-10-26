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






      $(document).ready(function() {

        $(document).on('submit', '#doSubmitAtt', function(event) {
          event.preventDefault();
          $this = $(this);
          $table = $this.find('table');

          $script = ` <table class="table table-bordered table-hover" style="width: 100%; text-align: center;">
          <thead>
          <th>Roll No</th>
          <th>Name</th>
          </thead>
          <tbody> `;
          $fd =0;
          $table.find('tr').each(function(index, el) {
            if($(this).find("input[type='checkbox']").prop('checked')==false) {
              $rollNo = $(this).find('td:nth-child(1)').text();
              $name = $(this).find('td:nth-child(2)').text();

              $script = $script + ` 

              <tr>
              <td>${$rollNo}</td>
              <td>${$name}</td>
              </tr>
              `;


              $fd++;
            }
          });
          $script = $script + ` </tbody>
          </table> `;

          if($fd == 0 ) {
            $script = ` <div class="alert alert-success" style="text-align: center; width: 100%;"> <p>no absent marked</p> </div> `;
          }
          console.log($script);
          $('#myModal .modal-body').html( $script );

          $('#myModal').modal('show');

          console.log('do stuff');

          return false;

        });

        $(document).on('click', '#saveMeNow', function(event) {
          event.preventDefault();
          $('#doSubmitAttConf').html( $('#doSubmitAtt').html() ); 
          $('#doSubmitAttConf').attr( "action", $('#doSubmitAtt').attr('action') ); 
          $('#doSubmitAtt table').find('tr').each(function(index, el) {
            $fggdf = true;
            $id = $(this).find("input[type='checkbox']").attr('name');
            if($(this).find("input[type='checkbox']").prop('checked')==false) {
              $fggdf = false; 
            } 
            $('#doSubmitAttConf input[type="checkbox"][name="'+$id+'"]').prop('checked', $fggdf); 

          }); 
          $('#doSubmitAttConf').find('input[type="submit"]').click(); 
          $('#myModal').modal('hide');

        });



      });




    </script>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: red;">confirm list of absent students </h4>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <form name="form1" method="post" action="elective_action.php" id="doSubmitAttConf" style="display: none;"> </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveMeNow"  >SAVE</button>
          </div>
        </div>

      </div>
    </div>


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

    function validate(form) {
      valid  = true;


      

      if ($("input:checkbox[name='batch[]']").length > 0) {
        arrE = [];
        $("input:checkbox[name='batch[]']:checked").each(function(){
          arrE.push($(this).val());
        });
        if(arrE.length < 1){
          alert('select a Batch !');
          valid  = false;
        } 

      } 
      if(!valid) {
        return false;
      }
      return confirm('Do you really want to update attendance?');

    }

  </script>


</head>
<body>
  <table class="table table-hover table-bordered" >
    <tr>
      <td width="40%" valign="top">


        <form method="post" enctype="multipart/form-data" action="hos_update.php"  onsubmit="  return validate(this)">
          <table  class="table table-hover table-bordered" >

            <tr>
              <td><label> Class</label></td>  
              <td>  
                <select name="class" id="class" onchange="showsub(this.value)" class="form-control">
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
            <tr>
             <td><label>Date:</label></td>
             <td id="pdate">




              <!--  <td><input type="date" name="date" id="date" class="form-control"  placehodler="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" /></td>  -->

            </td>
            
          </tr>

          <tr><td><label>Subject</label> </td> 
            <td><div id="sub">
              <select name="sub" class="form-control">
                <option>select</option>
              </select></div></td></tr>
              <tr>
                <td><label>Batch </label></td>
                <td><div id="batch">
                </div>
              </td>
            </tr>
            <tr>
              <td><label>Hour</label> </td>
              <td><select name="hour" onchange="gethour(this.value)" class="form-control">
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
            <td></td>
            <td><input type="submit" name="btnshow" id="btnshow" value="Update Attendence"  class="btn btn-primary" disabled="disabled"/>  </td></tr> 
          </table>
        </form>



        <div style="margin-top:1rem ; ">

          <?php if( isset($_POST['class'])): ?>
            <div class="row">
              <div class="col-sm-4 " style="text-align: right;">
                <b> Class : </b>
              </div>
              <div class="col-sm-8" style="text-align: left;">
                <?php echo $_POST['class']; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if( isset($_POST['sub'])): ?>
            <div class="row">
              <div class="col-sm-4 " style="text-align: right;">
                <b> Subject : </b>
              </div>
              <div class="col-sm-8" style="text-align: left;">
                <?php echo $_POST['sub']; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if( isset($_POST['batch'])): ?>
            <div class="row">
              <div class="col-sm-4 " style="text-align: right;">
                <b> Batch : </b>
              </div>
              <div class="col-sm-8" style="text-align: left;">
                <?php foreach ($_POST['batch'] as $key => $value) {
                  if($key !=0 )
                    echo ", ";

                  $re74=mysqli_query($con3,"select * from lab_batch where batch_id='$value'  ");
                  if(($rs0=mysqli_fetch_array($re74))) { echo $rs0['batch_name']; }
                  

                }?>

              </div>
            </div>
          <?php endif; ?>

          <?php if( isset($_POST['date'])): ?>
            <div class="row">
              <div class="col-sm-4 " style="text-align: right;">
                <b> Date : </b>
              </div>
              <div class="col-sm-8" style="text-align: left;">
                <?php echo $_POST['date']; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if( isset($_POST['hour'])): ?>
            <div class="row">
              <div class="col-sm-4 " style="text-align: right;">
                <b> Hour : </b>
              </div>
              <div class="col-sm-8" style="text-align: left;">
                <?php echo $_POST['hour']; ?>
              </div>
            </div>
          <?php endif; ?>


          <?php if( isset($_POST['class'])): ?>

          <?php endif; ?>


        </div>


        <?php

        if(isset($_POST["btnshow"]))
          {$i=0;
            $sub=explode("-",$_POST["sub"]);
            $cls=explode(",",$_POST["class"]);
            $hr=$_POST["hour"];
            $d=$_POST["date"];
            $c=mysqli_query($con3,"SELECT * FROM attendance where classid='$cls[0]'  and subjectid='$sub[0]' and date='$d' and hour='$hr'");
            while($re=mysqli_fetch_array($c))
            {
              $i++;
            }
            if($i>0)
            {

             $sub=explode("-",$_POST["sub"]);
             if($sub[1]=="ELECTIVE")
             {
              include("elective_update.php");
            }
            else if($sub[1]=="LAB")
            {
              include("lab_update.php");
            }
            else
            {
              include("core_update.php");
            }
          }
          else {

           ?>     <script>
            alert("Incorrect details");
//		window.location="hos.php";
</script>
<?php

}

}


?>    




</td>
<td valign="top">

  <div id="attendance">


    <table width="100%" border="1" class="table table-hover table-bordered">
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