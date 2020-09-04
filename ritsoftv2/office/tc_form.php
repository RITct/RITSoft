<?php
include("includes/header.php");
?>
<script>
	function getname()
	{
		document.getElementById('form2').submit();
	}
</script>
<?php
$ad_no="AA";
	//This is used for header and side navigation links.


include("includes/sidenav.php");

$ad_no="";
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><span style="font-weight:bold;">TRANSFER CERTIFICATE
			</span></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	
	<form id="form2" name="form2" method="post" action="" enctype="multipart/form-data" class="sear_frm" >
		<div class="form-group ">
			<label for="a_no">Full Admission No:</label>
			<input type="text" class="form-control" id="a_no" name="a_no"  onchange="getname()" >
		</div>
		
		<?php
		if(isset($_POST['a_no']))
		{
			$ad_no=$_POST['a_no'];
			
		}
		?>
	</form>

	<form id="form1" name="form1" method="post" action="tc_pdf.php" enctype="multipart/form-data" class="sear_frm" target="_blank" >
		
		<?php
		//link for connection.php
		include	"includes/dboperation.php";
		if($ad_no!=0)
		{
			if(!preg_match('/^([0-9A-Z]+)$/', $ad_no))
				echo "<script>alert('Please input admission number in Capital letter!!')</script>";
			else
			{
		//Retrieve all tc details from table 'tc'.
				$obj12=new dboperation();
				$query12="SELECT * FROM tc where adm_no='$ad_no' ";		
				$result12=$obj12->selectdata($query12);
				$row=$obj12->fetch($result12);
				$id=$row[1];
				if($id == $ad_no)
					echo "<script>alert('TC already Issued!!')</script>";
				else
				{	
		//Retrieve student details from table 'stud_details'.
					$obj5=new dboperation();
					$query5="SELECT * FROM stud_details WHERE admissionno = '$ad_no' ";	
					$result5=$obj5->selectdata($query5);
					while($row=$obj5->fetch($result5))
					{
						$adno=("$row[0]");
						$na=("$row[1]");
						$db=("$row[2]");
						$rlgn=("$row[4]");
						$cst=("$row[5]");
						$dt=("$row[6]");
						$coa=("$row[30]");
					}
		//Retrieve class details from table 'current_class'.
					$obj99=new dboperation();
					$query99="SELECT * FROM current_class WHERE studid = '$ad_no' ";
					$result99=$obj99->selectdata($query99);
					while($row=$obj99->fetch($result99))
					{
						$cid=("$row[0]");
						$sid=("$row[1]");
						$rlno=("$row[2]");
					}
		//Retrieve all tc details in descending order of tc_no from table 'tc'.
					$obj6=new dboperation();
					$query6="SELECT * FROM tc ORDER BY tc_no DESC LIMIT 1";
					$result6=$obj6->selectdata($query6);
					$row=$obj6->fetch($result6);
					$tc_id=$row[0];
					$next_tc_id=$tc_id+1;
					//$issue_date=date('Y-m-d');
	

					$caste=$rlgn."-".$cst; 
				}
			}
		}
$issue_date=date('Y-m-d');

		
		?>
		
		

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="tc_no">TC No</label>
				<input type="text" class="form-control"  name="tc_no" id="tc_no" value="<?php  echo $next_tc_id?>"  required>
			</div>
			<div class="form-group col-md-6">
				<label  for="adno">Admission No</label>
				<input type="text" class="form-control" name="adno" id="adno" value="<?php echo $ad_no?>" >
				
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="name">Name Of Student</label>
				<input type="text" class="form-control"  name="name" id="name" value="<?php  echo $na?>"  required>
			</div>
			<div class="form-group col-md-6">
				<label  for="dob">Data Of Birth</label>
				<input type="date" class="form-control" name="dob" id="dob" value="<?php echo $db?>" required>
				
			</div>
		</div>

<!-- should be removed after correcting stored procedure.... -->
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="dobw">Date of Birth (in words)</label>
				<input type="text" class="form-control"  name="dobw" id="dobw" value=""  required>
			</div>
		</div>







		
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="caste">Caste & Religion</label>
				<input type="text" class="form-control"  name="caste" id="caste" value="<?php  echo $caste?>"  required>
			</div>
			<div class="form-group col-md-6">
				<label  for="dte">Year Of Admission</label>
				<input type="text" class="form-control" name="dte" id="dte" value="<?php echo $dt?>" >
				
			</div>
		</div>
		
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="class">Classes to which Admitted</label>
				<input type="text" class="form-control"  name="class" id="class" value="<?php echo $coa?>" required>
			</div>
			<div class="form-group col-md-6">
				<label  for="leaving">Date of Leaving</label>
				<input type="date" class="form-control" name="leaving" id="leaving" value="" required>
				
			</div>
		</div>
		
		
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="relive">Classes from which Relived</label>
				<input type="text" class="form-control"  name="relive" id="relive" value="" required>
			</div>
			<div class="form-group col-md-6">
				<label  for="higher">Whether qualified for promotion to higher class</label>
				<input type="text" name="higher" id="higher" required class="form-control" >
				<!--	<option selected>----Choose----</option>
					<option value="Yes" >Yes</option>
					<option value="No" >No</option>
				</select> -->
				
			</div>
		</div>
		
		
		<div class="form-row">
			
			<div class="form-group col-md-6">
				<label  for="fee">Whether all the fees and other due have been paid</label>
				<select name="fee" id="fee" required class="form-control" >
					<option selected>----Choose----</option>
					<option value="No" >No</option>
                                        <option value="Yes" >Yes</option>
                                        <option value="NA" >NA</option>

				</select>
				
			</div>
			
			<div class="form-group col-md-6">
				<label  for="concession">Whether the student was receipt of the fee concession</label>
				<select class="form-control" name="concession" id="concession"  required class="form-control" >
					<option selected>----Choose----</option>
                                        <option value="No" >No</option>
					<option value="Yes" >Yes</option>
                                        <option value="NA" >NA</option>

				</select>
				
			</div>
		</div>
		
		
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="application">Date of application of TC</label>
				<input type="date" class="form-control" name="application" id="application" value="" required>
			</div>
			<div class="form-group col-md-6">
				<label for="issue">Date of Issue of TC</label>
				<input type="date" class="form-control" name="issue" id="issue"  value="<?php echo $issue_date?>"  class="form-control">
				
			</div>
		</div>
		<input type="hidden" name="id" id="id"  value="<?php echo $id?>" />
		
		<div class="form-row">
			<div class="form-group col-md-6">
				<label or="reason">Reason for Leaving</label>
				<input name="reason" class="form-control" id="reason" value="" required>
			</div>
			<div class="form-group col-md-6">
				<label  for="institution">Institution to which the student intends proceeding </label>
				<input type="text" class="form-control" name="institution" id="institution" class="form-control">
				
			</div>
		</div>
		<input type="hidden" name="classid" id="classid"  value="<?php echo $cid?>" />
		<input type="hidden" name="studid" id="studid"  value="<?php echo $sid?>" />
		<input type="hidden" name="rollno" id="rollno"  value="<?php echo $rlno?>" />

		
		<div align="center">
			<input type="submit" name="submit" id="submit" value="PRINT TC" class="btn btn-primary" />
			<input type="reset" name="submit2" id="submit2" value="CLEAR"  class="btn btn-primary" />
			
		</div>
		
	</form>
</div>
</html>

<?php
	// Link for footer.php
include("includes/footer.php");
?>
