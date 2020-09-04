<?php
/*This is used for header and side navigation links......  */
include("includes/header.php");
include("includes/sidenav.php");

?>



<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;">SEARCH SCHOLARSHIP DETAILS
                      
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
      

			
   <form id="form1" name="form1" method="post" action="backend-search_scholarship2.php" class="sear_frm">
<div class="form-row">
 <div class="form-group">
     <strong>Search by Admission no:</strong>  <input type="text"  class="form-control"  name="add_no"  placeholder="Admission No" id="add_no"/>
       
    </div>
    </div>
    <div class="form-row">
 <div class="form-group">
    <div align="center">
	<button type="submit" value="submit" name="submit" id="submit" class="btn btn-primary">Submit</button> 
 </form>
</div>
    </div></div>


<?php

include("includes/footer.php");
?>
