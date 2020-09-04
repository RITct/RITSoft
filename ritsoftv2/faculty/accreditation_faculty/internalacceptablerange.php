<?php
session_start();
header("Content-type: text/html; charset=utf-8");
$connection=mysqli_connect("localhost","root","","ritsoft");
include('header.php');
include('sidenav.php');
$fid="";
$fid= $_SESSION["username"];
$m=0;
$mark=[];
$attainmnt=0;
$noattain=0;
$c=0;
$attainper=0.0;
$tot=0;
$ar=[];
$arr=[];
$st=0;
$j=0;
$a="";
$b="";
$sum=array('0');
$s=0;
$atpe=0;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>I Value</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
 <script type="text/javascript" src="js/jquery.min.js"></script>

  </head>


  <body>
  	<div class="row 1">
  		<div class="col-md-3">

  		</div>
  		<div class="col-md-8">
  			<div class="panel panel-danger" style="margin-top:80px;">
  				<div class="panel-heading">
  					<h3 class="panel-title">I calculation</h3>
  				</div>
  				<div class="panel-body">
  <form name="qes" method="post" enctype="multipart/formdata" action="#">


  	<fieldset class="form-group">
  			<label for="course">COURSE ID</label>
  			<select class="form-control" name="cid" id="cid"><!--course selection-->

          <?php
		  $output='';
          $query = "SELECT subjectid FROM subject_allocation WHERE fid= '".$fid."'  ";
          $result = mysqli_query($connection, $query);
          $output .= '<option value="">Select course</option>';
          while($row = mysqli_fetch_array($result))
           {
              $output .= '<option value="'.$row["subjectid"].'">'.$row["subjectid"].'</option>';
            }
          echo $output;

		  ?>

          </select>
        </fieldset><!--fetching course id-->
		<br>
		<br>
		 <table id="dynamic">
					 <thead>
						 <th colspan="3">	Acceptable Mark Range </th>
						 <th> <button type="button" name="add" id="add" class="btn btn-success"> + </button> </th>
					 </thead>
					 <tr><!--acceptable range and threshold value getting-->
					 <td> <input class="form-control" type="text" size="20" name="from[]" id="from"></td><td>to</td><td><input class="form-control" type="text" size="20" name="to[]" id="to"></td>
					 <td><button type="button" name="btn_remove" id="btn_remove" class="btn btn-danger btn_remove">X</button></td>
					</tr>
				 </table>

		<br>
		<br>
<button align="right" type="submit" name="submit" class="btn btn-info" id="bt"> Submit </button>
<br>
<br>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
$(document).ready(function(e)
	{

		var i=1;
		var max= 100;
		$("#add").click(function(e){
		if(i<=max)
		    {
				++i;
				$('#dynamic').append('<tr id="row'+i+'"> <td> <input class="form-control" type="text" size="20" name="from[]" id="from"></td><td>to</td><td><input class="form-control" type="text" size="20" name="to[]" id="to"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>></tr>');

			}

		});
	$("#bt").click(function(e){
	var x = i;
	  createCookie("gfg", x,"50");
function createCookie(name, value, days)
{
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
}
	});
$(document).on('click','.btn_remove',function(e){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
		i--;
});

	});

</script>
<?php
//submit button action
if(isset($_POST['submit']))
{


$course=$_POST['cid'];
$m= $_COOKIE["gfg"];
$_SESSION['cid']=$course;
$_SESSION['m']=$m;
$c=$m+1;

$d=250/$c;
//echo $d;
$_SESSION['d']=$d;

$query="SELECT * FROM normalized_internal WHERE subjectid= '$course' ";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($result))
{

	$st=$st+1;
	$tot=$row['total'];
	$_SESSION['tot']=$tot;
    $_SESSION['st']=$st;
for($i=0;$i<$m;$i++)
{

$mark[$i]=$row['mark'];
$ar=$_POST['from'];
$arr=$_POST['to'];
if($mark[$i]>=$ar[$i] && $mark[$i]<$arr[$i])
{

$sum[$i]= $sum[$i] +1;
$attainmnt=$attainmnt+$sum[$i];
}
}
}
$atpe=($attainmnt/$st);
$attainper= $atpe * 10;
$_SESSION['percent']=$attainper;
$result=mysqli_query($connection,"SELECT * FROM normalized_internal_attainment WHERE subjectid='$course'");
$countsur=mysqli_num_rows($result);
if($countsur > 0)
{

}
else{

$query1="INSERT INTO normalized_internal_attainment(`subjectid`,`attainmnt_percent`)VALUES('".$course."','".$attainper."')";
$insert=mysqli_query($connection,$query1);
if(!$insert)
{
	echo mysqli_errno($connection);
}
else
{
echo "inserted";
}
}

?>
	<table class="table table-bordered" id="dynamic_field">

		<tr>
			<td colspan="<?php echo $c; ?>"><center>Normalized Internal Marks: &nbsp;&nbsp;Maximum Marks=<?php echo (isset($tot))?$tot:''; ?>&nbsp;&nbsp;No of Students=<?php echo (isset($st))?$st:'';?></center></td>

			 <?php echo (isset($se))?$se:''; ?> </center></td>

		</tr>
		<tr>
		<th></th>
		<?php for($i=0;$i<$m;$i++)
		{?>
			<th>Acceptable Range</th>
		<?php
		}
		?>
		</tr>
		<tr>
			<td rowspan="2">Number of students who scored<br> marks in the range </td>
			<?php
			$_SESSION['ar']=array();
			$_SESSION['arr']=array();
			$_SESSION['sum']=array();
			for($i=0;$i<$m;$i++)
			{
				$a=$ar[$i];
			array_push($_SESSION['ar'],$a);
				$b=$arr[$i];
				array_push($_SESSION['arr'],$b);
				?>
			<td><center>Marks:<?php echo (isset($a))?$a:'';?>to <?php echo (isset($b))?$b:'';?></center></td>
			<?php
			}
			?>

		</tr>
		<tr>
		<?php
		for($i=0;$i<$m;$i++)
		{   if(isset($sum[$i]))
			{
			$s=$sum[$i];

			}
			else
			{
				$s=0;
			}
			array_push($_SESSION['sum'],$s);
			?>

			<td><center><?php echo (isset($sum[$i]))?$sum[$i]:'';?></center></td>
		<?php
		}
		?>

		</tr>
		<tr>
			<td colspan="<?php echo $c; ?>" >
    <center>Attainment Level in Percentage=<?php echo (isset($attainper))?$attainper:'';?>%</center>
			</td>
		</tr>


	</table>
<?php
}
?>
		</div>
		<br>
		<br>



 <a href="http://localhost/amsa/fpdf/pdfinternal.php";>Print</a>

  </form>
  <div class="panel-footer">

  	</div>
  </div>
  <div class="col-md-1">
  </div>


   <!--END PANEL-->
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
