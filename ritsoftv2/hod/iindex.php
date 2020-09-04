<?php 
session_start();
?>
<head>

<script type="text/javascript">
function Checkcolor(val)
{
	var element=document.getElementById('color');
	var element2=document.getElementById('branch');
	var element3=document.getElementById('branchlabel')
	if(val=='M.TECH')
	{
		element.style.display='block';
		element2.style.display='none';
		element3.style.display='none';
		}
		
		else
		{
		element.style.display='none';
		element2.style.display='block';
		element3.style.display='block';
		}
		if(val=='MCA'||val=='B.ARCH')
		{
		element2.style.display='none';
		element3.style.display='none';
		}
}



</script>


</head>


<form name="form1" method="post"  bgcolor="#292929" >
 <ul class="errorMessages"></ul>
  <div align="center">
    <p>&nbsp;</p>
    <table width="737" height="946" border="0" background="img2/116209-desktop-wallpaper-desktop-wallpaper-1920x1200.jpg" bordercolor="#00486A">
      <tr bgcolor="#002040">
        <th height="65" colspan="2" scope="row"><font color="#FFFFFF">STUDENT CERTIFICATE </th>
      </tr>
      <tr>
        <th width="174" height="65" scope="row"><div align="left">Name</div></th>
        <td width="553"><input type="text" name="name" id="name" requiredz></td>
      </tr>
      <tr>
        <th height="77" scope="row"><div align="left">Admission Number</div></th>
        <td><input type="text" name="adm" id="adm" required></td>
      </tr>
      <tr>
        <th height="71" scope="row"><div align="left"><strong>Course</strong></div></th>
        <td><select name="course" id="course" onChange="Checkcolor(this.value);">
          <option val="1">B.TECH</option>
          <option val="2">B.ARCH</option>
          <option val="3">MCA</option>
          <option value="M.TECH">M.TECH</option>
        </select>
       
        <select name="color" id="color" style='display:none'>
<option>(Choose Specialization)</option>      
<option>Transportation Engineering</option>
<option>Industrial Engineering & Management</option>
<option>Industrial Drives & controls Engineering</option>
<option>Advanced Communication & information System Engg.</option>
<option>Advanced Electronics & Communication Engg.</option>
<option>Computer Science & Engineering</option>
</select></td>
      </tr>
      <tr>
        <th height="45" scope="row"><div align="left"><label id="branchlabel">Branch</label></div></th>
        <td><select name="branch" id="branch">
          <option>CIVIL ENGINEERING</option>
          <option>ELECTRONICS AND ELECTRICAL ENGINEERING</option>
          <option>MECHANICAL ENGINEERING</option>
          <option>COMPUTER SCIENCE & ENGINEERING</option>
          <option>ELECTRONICS & COMMUNICATION ENGINEERING</option>
        </select></td>
      </tr>
      <tr>
        <th height="69" scope="row"><div align="left">Semester</div></th>
        <td><select name="sem" id="sem">
          <option>S1</option>
          <option>S2</option>
          <option>S3</option>
          <option>S4</option>
          <option>S5</option>
          <option>S6</option>
          <option>S7</option>
          <option>S8</option>
          <option>S9</option>
          <option>S10</option>
        </select></td>
      </tr>
      <tr>
        <th height="78" scope="row"><div align="left">Academic Year</div></th>
        <td><input type="text" name="year" id="year" required></td>
      </tr>
      <tr>
        <th height="129" scope="row">Purpose For Certificate</th>
        <td><textarea name="purpose" cols="45" rows="5" id="purpose" required></textarea></td>
      </tr>
      <tr>
        <th height="87" scope="row"><div align="left">Certificate issued by</div></th>
        <td><select name="issued" id="issued">
          <option>PG Dean</option>
          <option>UG Dean</option>
          <option>Head of the Department</option>
          <option>Principal</option>
        </select></td>
      </tr>
      <tr>
        <th height="87" scope="row"><div align="left">Date</div></th>
        <td><input type="text" name="date" id="date" value="<?php echo date("d/m/Y"); ?>"></td>
      </tr>
      <tr>
        <th colspan="2" scope="row"> <div align="right">
          <p align="center">
            <input type="submit" name="submit" id="submit" value="SUBMIT">
            <?php
			if(isset($_POST['submit'])){
				
				$branch=$_POST['branch'];
				$spec=$_POST['color'];
				
				$course=$_POST['course'];
				
				//$_SESSION['branch']=$_POST['branch'];
				//$_SESSION['$spec']=$_POST['color'];
				//$spec=strtoupper($spec);

//echo $branch.$course;
 
		//echo $spec.$branch;
		
		echo "<script language='JavaScript' type='text/JavaScript'>
<!--
window.location='cert_number.php';
//-->
</script>
";

$_SESSION['name']=$_POST['name'];
$_SESSION['adm']=$_POST['adm'];
$_SESSION['year']=$_POST['year'];
$_SESSION['purpose']=$_POST['purpose'];

$_SESSION['issued']=$_POST['issued'];
$_SESSION['date']=$_POST['date'];
$_SESSION['sem']=$_POST['sem'];
$_SESSION['branch']=$branch;
$_SESSION['spec']=$spec;
$_SESSION['course']=$course;


			}
 ?>
			
            <input type="submit" name="submit2" id="submit2" value="CLEAR">
          </p>
          <p><font size="-1">Developed by MCA Department</font>
          </p>
        </div></th>
      </tr>
    </table>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  
</form>
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
