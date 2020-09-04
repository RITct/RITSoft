<?php
$connect=mysqli_connect("localhost","root","","ritsoft");

    $output='';
    if(isset($_POST["id"]))
 {
 $sql = "SELECT co_code FROM internal_question_co_correlation WHERE subjectid='".$_POST["id"]."' AND series_id='".$_POST["ser_id"]."' GROUP BY co_code ";
   $result = mysqli_query($connect, $sql);
    $output .= '<option value="">Select</option>';
   while($row = mysqli_fetch_array($result))
     {
          $output .= '<option value="'.$row["co_code"].'">'.$row["co_code"].'</option>';
  }
     echo $output;

}

?>
