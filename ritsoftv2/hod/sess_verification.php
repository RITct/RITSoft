<?php
include("includes/header.php");
?>
<script  src="jquery.js"></script>
<script type="text/javascript">
    var datad = null;
    function getsemdata(a)
    {	
        console.log(a);
        if((a+'').length > 0){

          $.post("fetchsessdata.php",{ key : a},
              function(data){
                datad = data;
                data += "<input type='submit' name='excel' value='Download Excel' style=' height: 35px' id='excel_btn'>";


                $('#data').html(data);
            }); 
      }

  }



  $(document).on("click", "#excel_btn", function(){
   
    if(datad != null){
        var f = $('#excel_form');
        f.find('input[name=data]').val(datad);
        f.find('input[name=name]').val('file'); 
        f.submit(); 
    }



});
</script>

<?php
//include("includes/header.php");
include("includes/sidenav.php");
//include("dbopen.php");
 // $count=0;
 //session_start();
 // $count=0;
	//$hodid=$_SESSION['hodid'];
if(isset($_POST["clsid"])){
  $classid=$_POST["clsid"];		
}
if(isset($_POST['cid']))
{		
  $clsid=$_POST['cid'];
}
else
  $clsid="";		
?>

<?php
  //  $classid=$_SESSION["classid"];

?>


<div id="page-wrapper">
    <br><br>


    <?php
    $s=mysql_query("select deptname from faculty_details where fid ='$hodid'",$con);
    $r = mysql_fetch_assoc($s);
    $deptname=$r["deptname"];

    $sql ="select * from class_details  where deptname='$deptname'  and active like '%YES'";
    $result = mysql_query($sql);
    ?>
    <select name='clsid' id="clsid" class="form-control" onchange="getsemdata(this.value)">
        <option value =''>Select class</option>

        <?php
        while ($row = mysql_fetch_array($result)) {
           echo "<option value='" . $row["classid"] ."'>".$row["courseid"]."-S".$row["semid"]."-".$row["branch_or_specialisation"]."</option>";   

       }
       echo "</select>";
       echo "<script>getsemdata('$clsid');</script>";
       ?>        

       <div class="row">
        <div class="col-lg-12" >
            <h1 class="page-header">SESSIONAL MARK VERIFICATION
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="table-responsive">


     <div id="data">

     </div>

     <form id="excel_form" method="post" action="as_excel.php" target="_blank" style="display: none !important;">
        <input type="hidden" name="data" value="" />
        <input type="hidden" name="name" value="" /> 
    </form>
</div>
<!-- /.row -->
<!-- /#wrapper -->   

<?php
include("includes/footer.php");
?>
