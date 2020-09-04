<?php

include("includes/header.php");

include("includes/sidenav.php");
if(isset($_GET["id"]))

	$admisno=$_GET['id'];
else	

 $admisno=$_SESSION['adm'];

$issued_by=$_SESSION['fid'];

$name="";
$course="";
$batch="";
$sem="";
$year="";
include('includes/connection1.php');
?>



<?php

$sql="select * from stud_details  where admissionno='$admisno'";
$result=  mysql_query($sql);
while($db_field=mysql_fetch_array($result))
{ 
  $name=$db_field["name"];
  $course=$db_field["courseid"];
$_SESSION['courseid']=$course;
  }
$sql2="select * from current_class  where studid='$admisno'";
$result2=  mysql_query($sql2);
while($db_field1=mysql_fetch_array($result2))
{ 
	$classid=$db_field1["classid"];
$_SESSION['classid']=$classid;

}
$sqll="select * from class_details  where classid='$classid'";
$result1=  mysql_query($sqll);
while($dbfield=mysql_fetch_array($result1))
{ 

  $branch=$dbfield["branch_or_specialisation"];
  $sem=$dbfield["semid"];    
}

$l=mysql_query("select acd_year from academic_year where status=1") or die(mysql_error());
				$r=mysql_fetch_assoc($l);
				$acd_year=$r["acd_year"];

?>

<div id="page-wrapper">

  <form name="form1" method="post"  bgcolor="#292929"  >
   <ul class="errorMessages"></ul>
   <div align="center">
    <p>&nbsp;</p>
    <table width="737" height="946" border="0" background="img2/116209-desktop-wallpaper-desktop-wallpaper-1920x1200.jpg" bordercolor="#00486A">
      <tr bgcolor="#002040">
        <th height="65" colspan="2" scope="row"><font color="#FFFFFF"><center><h3><b>STUDENT CERTIFICATE</center></h3></b></th>
        </tr>
<tr>
          <td width="174" height="65" scope="row"><div align="left">Admission No:</div></td>
          <td ><input type="text" class="form_control"name="admno" id="admno"  value="<?php  echo $admisno; ?> " required readonly> </td>
        </tr>

        <tr>
          <td width="174" height="65" scope="row"><div align="left">Name</div></td>
          <td ><input type="text" class="form_control"name="name" id="name"  value="<?php  echo $name; ?>" required> </td>
        </tr>
        <tr>
          <td height="71" scope="row"><div align="left">Course</div></td>
          <td>
            <input type="text" name="course" id="course"  value="<?php  echo $course; ?> " required readonly></td> 
          </tr>
          <tr>
            <td height="45" scope="row"><div align="left"><label id="branchlabel">Branch</label></div></td>
            <td>  
              <input type="text" name="branch" id="branch"  value="<?php  echo $branch; ?>" required readonly>
            </td>
          </tr>
          <tr>
            <td height="69" scope="row"><div align="left">Semester</label></div></td>
            <td>   <input type="text" name="semester" id="semester"  value="<?php  echo $sem; ?> " required></td>

          </tr>

<tr>
            <td height="69" scope="row"><div align="left">Academic Year</label></div></td>
            <td>   <input type="text" name="year" id="year"  value="<?php  echo $acd_year; ?> " required></td>

          </tr>


          <tr>
            <td height="129" scope="row">Purpose For Certificate</td>
            <td><textarea name="purpose" cols="45" rows="5" id="purpose" required></textarea></td>
          </tr>
          <tr>
            <td height="40" scope="row"><div align="left">Date</div></td>
            <td><input type="date" name="date" id="date" value="" required></td>
          </tr>
          <tr>
            <td colspan="2" scope="row"> <div align="right">
              <p align="center">
                <input type="submit" name="submit" id="submit" value="submit"></p></div></td>
              </tr>
            </table>
            <p><font size="-1">Developed by MCA Department</font>
            </p>
          </div>
        </div>



        <?php
        if(isset($_REQUEST['submit']))
        {


$_SESSION['admno']=$_POST['admno'];
$_SESSION['name']=$_POST['name'];
$_SESSION['purpose']=$_POST['purpose'];
$_SESSION['date']=$_POST['date'];
$_SESSION['semester']=$_POST['semester'];
$_SESSION['branch']=$_POST['branch'];
//$_SESSION['spec']=$spec;
$_SESSION['course']=$_POST['course'];
$_SESSION['year']=$_POST['year'];


        $c=mysql_query("INSERT INTO serialno values('000','$classid','$issued_by','$admisno')") or die(mysql_error());			

       echo "<script language='JavaScript' type='text/JavaScript'>
       window.location='cert_number.php';
       </script>";




     }
     ?>

    
   </form>
 </div>
 <?php

 include("includes/footer.php");
 ?>
 <script>
  var createAllErrors = function() {
    var form = $( this ),
    errorList = $( "ul.errorMessages", form );

    var showAllErrorMessages = function() {
      errorList.empty();

            // Find all invalid fields within the form.
            var invalidFields = form.find( ":invalid" ).each( function( index, node ) {

                // Find the field's corresponding label
                var label = $( "label[for=" + node.id + "] "),
                    // Opera incorrectly does not fill the validationMessage property.
                    message = node.validationMessage || 'Invalid value.';

                    errorList
                    .show()
                    .append( "<li><span>" + label.html() + "</span> " + message + "</li>" );
                  });
          };

        // Support Safari
        form.on( "submit", function( event ) {
          if ( this.checkValidity && !this.checkValidity() ) {
            $( this ).find( ":invalid" ).first().focus();
            event.preventDefault();
          }
        });

        $( "input[type=submit], button:not([type=button])", form )
        .on( "click", showAllErrorMessages);

        $( "input", form ).on( "keypress", function( event ) {
          var type = $( this ).attr( "type" );
          if ( /date|email|month|number|search|tel|text|time|url|week/.test ( type )
            && event.keyCode == 13 ) {
            showAllErrorMessages();
        }
      });
      };

      $( "form" ).each( createAllErrors );
    </script>

