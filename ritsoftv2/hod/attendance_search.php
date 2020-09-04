<title>Untitled Document</title>
</head>
<?php
// include("includes/header.php");
// include("includes/sidenav.php");
include("includes/dbopen.php");
//$con=mysqli_connect("localhost","root","","ritsoft");
//session_start();
//$st=$_SESSION['unm'];
//$adm=$_SESSION['admis'];
//$name=$_SESSION['name'];
//echo $name;
//$datea="";	
//$hour="";
?>
<div id="page-">
  <body>
    <label for="txtstudid"></label>
    <form id="form1" name="form1" method="post" action="">
      <?php
      $admisno=$_GET['admis'];
      $w=0;
      $name=$_GET['name'];
      $cls=$_GET['class'];
//$name=$_GET['name'];
//echo $admisno;
      ?>
      <h4><?php echo $name."(".$admisno.")";?></h4>

      <?php
      $date1=$_GET["date1"];	
      $date2=$_GET["date2"];
      ?>	
      <h4><?php echo "  From  " . date("d-m-Y", strtotime($date1)); ?></h4>
      <h4><?php echo  "  To  " . date("d-m-Y", strtotime($date2));?></h4>
      <table class="table table-hover table-bordered">
       <tr><th>Absent Date </th><th> Subject id </th> <th> Hour </th></tr>
       
       <?php   
       $dat=mysqli_query($con3,"select distinct(date),subjectid from attendance where studid='$admisno' and date BETWEEN '$date1' and '$date2' and status='A'")or die(mysqli_error($con3));
       while($result=mysqli_fetch_array($dat)) 	
       {
         
         $d=$result["date"];
         $subject=$result["subjectid"];
         ?>
         <tr>
          <td><?php echo date("d-m-Y", strtotime($d)); ?></td>
          <td><?php echo $subject; ?></td>
          <td>
            <?php
            $sql=mysqli_query($con3,"select distinct(hour) from attendance where studid='$admisno' and subjectid='$subject' and date='$d' and status='A'") or die(mysqli_error($con3));	
            while($result=mysqli_fetch_array($sql)) 	
            {	
             $hour=$result["hour"];
             echo "&nbsp; &nbsp; &nbsp; $hour";

           }	
           ?>
         </td>
       </tr>
       <?php
       $w++;

     }?></table><?php
     if($w==0)
       echo "No Record Found";
     else
     {
      ?>


      <br />
      <table class="table table-hover table-bordered">
        <?php
	//$class=explode(",",$_REQUEST['class']);	
 //$class=explode(",",$_POST['class']);
        ?>
        
        <tr> <th> subject id </th> <th> subject name </th></tr>
        <?php
        
  //$class=explode(",",$_POST['class']);
	 //$class=$_GET['class'];
        $c=mysqli_query($con3,"select * from subject_class where classid='$cls' order by subjectid asc");
        while($re=mysqli_fetch_array($c))
        {
         ?>
         <tr>
          
          <th scope="col"><?php echo $re["subjectid"]; ?></th>
          <th scope="col" align="left"><?php echo $re["subject_title"]; ?></th>
        </tr>
        <?php
      }
      ?>
    </table>

    <?php
  }
  ?>






</div>

</form>
</body>

<?php include("includes/footer.php"); ?>