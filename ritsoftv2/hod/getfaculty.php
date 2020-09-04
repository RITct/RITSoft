<?php
	       $sql="select * from faculty_details";
	       $r=mysql_query($sql,$con);
	       while($result=mysql_fetch_array($r)){
		        echo '<option value="'.$result['fid'].'">'.$result['fid'].'</option>';
	       }
	   ?>	