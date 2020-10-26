<?php
include("includes/header.php");
include("../connection.mysqli.php");
include("includes/sidenav.php");
//$pid=$_SESSION["parentid"]; //parent id from session
?>
<script type="text/javascript">
function validate()
{

if( document.edit.email.value == "" )
 { 
  alert( "write your email" );
  document.edit.email.focus() ; 
  return false;
  }
if( document.edit.phone.value == "" )
 { 
  alert( "write your phone number" );
  document.edit.phone.focus() ; 
  return false;
  }
	 return( true );
  }
</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>UPDATE CONTACT
                         
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
            <!-- /.row -->
                      
           <div>
       		<div>
<form method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-6">
<label>Email </label>
<input type="email" name="email" class="form-control" />
</div>
<div class="col-md-6">
<label>Phone number </label>
<input type="text" name="phone" class="form-control"/>
</div>
</div>
<br>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
<input type="Submit" value="Update"  onClick="return(validate());" class="btn btn-primary btn-block" name="Send"/>
</div>
</div>
</form>
</div>
<?php
if(isset($_POST["Send"]))
{		
	$mail=$_POST['email'];
	$ph=$_POST['phone'];
	$find="select guard_contactno,guard_email from parent where parentid='".$_SESSION["parentid"]."'";
	 $res= mysqli_query($conn,$find); // find current details
			while ($row=mysqli_fetch_assoc($res)){
				$curphone=$row['guard_contactno'];
				$curmail=$row['guard_email'];
			}
	$sql="update parent set guard_email='".$mail."', guard_contactno='".$ph."' where parentid='".$_SESSION["parentid"]."'";
	$query=mysqli_query($conn,$sql);
	echo '<script type="text/javascript">alert("Mail id and phone number updated");</script>';
	$sq="update login set username='".$ph."' where username='".$curmail."' OR username='".$curphone."'";
	echo $sq;
	$query=mysqli_query($conn,$sq);
	echo '<script type="text/javascript">alert("Username is your phone number");</script>';
	echo "<script>window.location.href='dash_home.php'</script>";
}
?>
</center>

                     </div>
                
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    
                        </div>
                        <!-- /.panel-heading -->
                       
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                        <!-- /.panel-body -->
                      
                        <!-- /.panel-footer -->
                  </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->   
<?php
include("includes/footer.php");
?>