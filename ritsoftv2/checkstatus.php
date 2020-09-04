 <?php

include("connection.php");
if (isset($_POST["course"])) {
	if ($_POST["course"]!="") {
		if($_POST["course"]=="MCA" or $_POST["course"]=="MTECH")
			{
			$l=mysql_query("select status from admission_status where course='PG' and status=1") or die(mysql_error());
			if(mysql_num_rows($l)==0)
				echo "0";
			else
				echo "1";
		}
		else if($_POST["course"]=="BTECH" or $_POST["course"]=="BARCH")
		{
			$l=mysql_query("select status from admission_status where course='UG' and status=1") or die(mysql_error());
			if(mysql_num_rows($l)==0)
				echo "0";
			else
				echo "1";

		}
	}
}

 ?>