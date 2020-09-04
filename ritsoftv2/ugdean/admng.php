<?php
  include("includes/header.php");
  include("includes/sidenav.php");
  include("includes/connection1.php");
  $fid=$_SESSION['fid'];
?>

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 25px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: -6px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 30px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span>Manage Admission
                    </span></h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php
         if (isset($_POST["status"])) {
         	$status=$_POST["status"];
         	if ($status==1) 
         	{
         	mysql_query("update admission_status set status=0 where course='UG'") or die(mysql_error());
     	   	echo "<script>alert('UG admission closed')</script>";
     	    }
         	else
         {
         	mysql_query("update admission_status set status=1 where course='UG'") or die(mysql_error());
         	echo "<script>alert('UG admission started')</script>";
         	}
     }

?>

<form method="post" name="form1" id="form1">
<div class="row">
	<div class="col-sm-4">

	</div>
	<div class="col-sm-4">
				
		<?php
			$l=mysql_query("select status from admission_status where course='UG'") or die(mysql_error());
			$r=mysql_fetch_assoc($l);
			$status=$r["status"];
			if ($r["status"]==1) {
				$v='checked="checked"';
			}
			else
				$v='';

		
		?>
<h2> <?php if($status==1)

echo "Admission started"; 
else
echo "Admission not started"; 

  ?> </h2>


	<label class="switch">
  <input type="checkbox" id="status" name="st" onchange="update()"   <?php echo $v; ?> >
 
  <span class="slider round"></span>
</label>
</div>
</div>
 <input type="hidden" name="status" value="<?php echo $status ?>" >
</form>


  </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->   
<?php
    include("includes/footer.php");
?> 
<script type="text/javascript">
	function update()
	{
		var c=document.getElementById("status");
		if(c.checked)
		{
		if(confirm('Do you want to start admission?'))

		document.getElementById("form1").submit();
		}
		else if(c.checked ==false)
		{
			if(confirm('Do you want to close admission?'))

		document.getElementById("form1").submit();
		}
}
</script>