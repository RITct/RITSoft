 <table class="table table-bordered" id="dynamic_field">
					 <thead>

						 <th>Marks Scored</th>
						 <th>Total Mark  For the Questions Selected</th>

					 </thead>




			<?php
$connection=mysqli_connect("localhost","root","","ritsoft");
session_start();
$_SESSION['que']=array();
$cn=[];
 $_SESSION['co_code']=$_POST["co_code"];

	   $query="SELECT qno FROM `internal_question_co_correlation` WHERE co_code='".$_POST["co_code"]."' AND series_id='".$_POST["ser_id"]."' ";
	   $result=mysqli_query($connection,$query);
	   $cn= array($result);
	   $c=count($cn);
	   while($row=mysqli_fetch_array($result))
	   {

	 $ques= $row['qno'];
	 array_push($_SESSION['que'],$row['qno']);
	 for($i=1;$i<=$c;$i++)
		   {
	   ?>
			        <tr>

						 <td> <input type="text" name="qno[]" id="qno"  value=<?php echo (isset($ques))?$ques:'';?>></td>
						 <td> <input type="text" name="total[]" id="total"></td>

				    </tr>

		<?php

		}

		}

	  ?>
	  </table>
