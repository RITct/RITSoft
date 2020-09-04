<?php
$connection=mysqli_connect("localhost","root","","ritsoft");
$count=0;
$c=[];
$m=0.0;
$n=0;
$num1=0;

$totalattainmnt=array();

        $query="SELECT * FROM tbl_co WHERE subjectid='RLMCA103' ";
        $result=mysqli_query($connection,$query);
        $c=array($result);
        $count=count($c);
        ?>
         <table class="table table-bordered" id="dynamic_field">
        <?PHP
        while($row=mysqli_fetch_array($result))
        {
          $n=$n+1;
        $query1="SELECT * FROM internal WHERE subjectid='RLMCA103' AND co_code='".$row['co_code']."' AND test_no='1' ";
        $result1=mysqli_query($connection,$query1);
        $num1= $num1+ mysqli_num_rows($result1);
        $row1=mysqli_fetch_array($result1);
        $query2="SELECT * FROM assignment WHERE subjectid='RLMCA103' AND co_code='".$row['co_code']."' ";
        $result2=mysqli_query($connection,$query2);
        $row2=mysqli_fetch_array($result2);
        $query3="SELECT * FROM internal WHERE subjectid='RLMCA103' AND co_code='".$row['co_code']."' AND test_no='2' ";
        $result3=mysqli_query($connection,$query3);
        $row3=mysqli_fetch_array($result3);
        $query4="SELECT * FROM normalized_internal_attainment WHERE subjectid='RLMCA103' ";
        $result4=mysqli_query($connection,$query4);
        $row4=mysqli_fetch_array($result4);
        $query5="SELECT * FROM survey_attainment WHERE subjectid='RLMCA103' AND co_code='".$row['co_code']."' ";
        $result5=mysqli_query($connection,$query5);
        $row5=mysqli_fetch_array($result5);
      }

echo $num1;
for($i=1;$i<=$num1;$i++)
{
?>

 <tr rowspan="<?php echo $num; ?>"> <td>Data1(Ist Internal)</td><td><input type="text" name="test1[]" id="test1"  value=""></td><td><input type="text" name="test01[]" id="test11"  value=""></td></tr>
<?php
}
?>
 						  <tr rowspan="2"> <td >Data2()</td><td>Assignment 1 Mark<input type="text" name="asignmnt2" id="asignmnt2"><br>Assignment 2 Mark<input type="text" name="asignmnt2" id="asignmnt2"></td><td><input type="text" name="asignmnt1per" id="asignmnt1">
                <br><input type="text" name="asignmnt2per" id="asignmnt1"></td></tr>
 						  <tr><td>Data3(Normalized Inetrnal Mark)</td><td><input type="text" name="normalint" id="normalint"></td><td><input type="text" name="normalint1" id="normalint1"></td></tr>
 						  <tr> <td>Data4(Test 2)</td><td><input type="text" name="test2" id="test2"  value=""></td><td><input type="text" name="test21" id="test21"  value=""></td></tr>
 						  <tr> <td>Data5(External Mark)</td><td><input type="text" name="external" id="external"  value=""></td><td><input type="text" name="external1" id="external1"  value=""></td></tr>
 						  <tr> <td>Rubrics</td><td><input type="text" name="rubrics" id="rubrics"  value=""></td><td><input type="text" name="rubrics1" id="rubrics1"  value=""></td></tr>
 						  <tr> <td>IAT(Course Exit Survey)</td><td><input type="text" name="survey" id="survey"  value=""></td><td><input type="text" name="survey1" id="survey1"  value=""></td></tr>
 </table >
