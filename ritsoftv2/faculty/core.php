CORE
<script src="jquery.min.js"></script>
<script>
  $(document).ready(function()
  {
    $("#btns").click(function()
//function uncheck()
{
	$(".chk").attr("checked",false);
	//document.getElementById("chk").checked=false;
}
);
  }
  );


  $(document).ready(function()
  {
    $("#btns2").click(function()
//function uncheck()
{
	$(".chk").attr("checked",true);
	//document.getElementById("chk").checked=false;
}
);
  }
  );
</script>
<form name="form1" method="post" action="core_action.php" id="doSubmitAtt">
  <?php
  include("includes/connection3.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
  if(isset($_POST['btnshow']))
  {
    ?>
    <table class="table table-hover table-bordered">
      <tr>
        <th>Roll No</th>
        <th>Name</th>
        <th>Attedance</th>
      </tr>
      <?php
      $a=explode(",",$_POST['class']);
      $b=explode("-",$_POST['sub']);
      $date=$_POST["date"];
      //$hour=$_POST["hour"];
      ?>
      <input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
      <input type="hidden" value="<?php echo $b[0]; ?>" name="b"/>
      <input type="text" value="<?php echo $date; ?>" name="date"/>
      <!-- <input type="hidden" value="<?php echo $hour; ?>" name="hour"/> -->

<?php foreach ($_POST['check_list'] as $check){ ?>
      <input type="hidden" name="hour[]" value="<?php echo $check ?>">
<?php
      }   

?>


      <?php
//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
      $res=mysqli_query($con3,"SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");

      $i=1;
      while($rs=mysqli_fetch_array($res))
      {
        $sid=$rs["rollno"];
        ?>
        <tr>
          <td><?php echo $rs["rollno"]; ?></td>
          <td><?php echo $rs["name"]; ?></td>
          <td><input type="checkbox" value="present" class="chk" name="<?php echo $rs["studid"];?>" checked="checked"/></td>
        </tr>
        <?php
        $i++;
      }
      ?>
      <tr> 
        <td><input type="button" value="un check all" name="btncheckall" id="btns" onclick="uncheck()" class="btn btn-primary"/></td>
        <td><input type="button" value="check all" name="btncheckall" id="btns2" onclick="uncheck()" class="btn btn-primary"/></td>
        <td><input type="submit" name="submit" value="Mark Attendance" class="btn btn-primary"/></td>
        
      </tr>
    </table>
    <?php
  }
  ?>
</form>