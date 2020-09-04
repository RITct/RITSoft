<?php
$connection=mysqli_connect("localhost","root","","ritsoft");

    $output='';
    if(isset($_POST["id"]))
 {
 $sql = "SELECT co_code FROM each_assignment_topic WHERE subjectid='".$_POST["id"]."' AND topicid='".$_POST["assignmnt_id"]."'  ";
   $result = mysqli_query($connection, $sql);
    $output .= '<option value="">Select</option>';
   while($row = mysqli_fetch_array($result))
     {
          $output .= '<option value="'.$row["co_code"].'">'.$row["co_code"].'</option>';
  }
     echo $output;

}

?>
