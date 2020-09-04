<?php
include("includes/connection1.php");
//$con=mysqli_connect("localhost","root","","ritsoft");

$id=explode("-",$_REQUEST["id"]);

if($id[1]=="LAB")
{
	$res=mysqli_query($con,"select * from lab_batch where sub_code='$id[0]'");
	while($rs=mysqli_fetch_array($res))
	{
		?>
        <input type="checkbox" name="batch[]" value="<?php echo $rs['batch_id']; ?>"/><?php echo $rs["batch_name"]; ?>
        <?php
	}
}



?>