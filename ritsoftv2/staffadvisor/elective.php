<?php
include("includes/header.php");
include("includes/sidenav.php");
include("includes/connection.php");
$count=0;

$classid=$_SESSION["classid"];
$subid="";
if(isset($_POST['subjectid']))
{
	$subid=$_POST['subjectid'];
    
    echo "<script>window.location.href='elective.php?id=$subid'</script>"; 
}
?>      
}

<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12" >
            <h1 class="page-header">ELECTIVE ALLOCATION 
                
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12" >
            <?php
            $sql="select subject_title,subjectid from subject_class where classid='$classid' AND type='ELECTIVE'";

            if(isset($_GET["id"]))
            {
               $subid=$_GET["id"];
               
           }

           
           ?>      
           <form method="post">        
             <select name="subjectid" required="required" onchange="this.form.submit()" class="form-control">
                <option value="s">--select--</option>
                
                
                <?php
                $r=mysql_query($sql) or die(mysql_error());
                while($result=mysql_fetch_array($r))    {
                	if($subid==$result["subjectid"])
                		$s='selected="selected"';
                	else
                		$s="";
                  echo '<option value="'.$result['subjectid'].'" '.$s.'>'.$result['subject_title'].'</option>';
              }?>

          </select>
      </form>
  </div>
  <!-- /.col-lg-12 -->
</div>
<?php
if(isset($_POST['subjectid']) || isset($_GET["id"]))
{
    if($_GET["id"]!="s")
    {
        ?>


<form method="post" action="electalloc.php">
    <input type="hidden" name="subjectid" value="<?php echo $subid; ?>">
        <div class="table-responsive">



         
          <table width="50%"  class="table table-hover table-bordered">
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">ROLL NUMBER</th>
                <th style="text-align: center;">ADMISSION NUMBER</th>
                <th style="text-align: center;">STUDENT NAME</th>
                <th style="text-align: center;"></th>
                <th style="text-align: center;"></th>

            </tr>

            <?php
            $i= 1;
            //reading student details

            /*
            *
             $resul=mysql_query("SELECT current_class.studid,rollno FROM current_class WHERE current_class.classid='$classid' and current_class.studid not in(SELECT elective_student.stud_id from elective_student WHERE elective_student.sub_code='$subid') order by rollno");


      newly added new query  AND current_class.studid  in ( select admissionno from stud_details )
            *
            */
            $resul=mysql_query("SELECT current_class.studid,rollno FROM current_class WHERE current_class.classid='$classid' and current_class.studid not in(SELECT elective_student.stud_id from elective_student WHERE elective_student.sub_code='$subid') AND current_class.studid  in ( select admissionno from stud_details ) order by rollno");
            while($data=mysql_fetch_array($resul))
            {
                $adm_no=$data["studid"];

                $rollno=$data["rollno"];

                // echo "select name from stud_details where admissionno='$adm_no'";

                $result=mysql_query("select name from stud_details where admissionno='$adm_no'");
                while($dat=mysql_fetch_array($result))
                {
                  $name=$dat["name"];
              }
              ?>
              <tr >
                <td align="center"><?php echo $i;  ?></td>
                <td align="center"><?php  echo $rollno;?></td>
                <td align="center"><?php  echo $adm_no;?></td>
                <td align="center"><?php  echo $name;?></td>
                <td align="center">
                    <input type="checkbox" name="student[<?php echo  $adm_no; ?>]">
                </td>
                
                <td>
                    <div class="btn-group">
                        <a href="electalloc.php?id=<?php echo $adm_no; ?>&sid=<?php echo $subid; ?>">ADD</a>
                    </div>
                </td>
            </tr>
            <?PHP

            $i++;
        }
        ?>
    </table> 
</div>


<div class="row">
    <div class="col-sm-12 text-right">
        <input type="submit"  class="btn btn-sm btn-danger" name="bulk_studnets" value="save">
        
    </div>
    
</div>

</form>

<?php
}
}
?>



<!-- /.row -->
<div class="row">
    
    
    
    
    
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