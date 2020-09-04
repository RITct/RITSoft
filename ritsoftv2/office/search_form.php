<?php
/*This is used for header and side navigation links......  */
include("includes/header.php");
include("includes/sidenav.php");

?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
   
$(document).ready(function(){
    
 //............................................................................
    $('#add_no').on("keyup input", function(){
	<!--first goes to backend-search.php-->
        /* Get input value on change */
        var add_no = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(add_no.length){
            $.get("backend-search.php", {add_no: add_no}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
	
	<!--if searching a student through admission number.....-->
	
    $(document).on("click", ".result .add_no", function(){
        $(this).parents(".search-box").find('#add_no').val($(this).text());
        $(this).parent(".result").empty();
   });
     $(document).on("click", ".result .add_no", function(){
           <!--second goes to backend-search2.php-->
		   
         var add_no =$('#add_no').val();
          
            $.ajax({
             type: "POST",
             url: "backend-search2.php",
             data: "add_no="+add_no,
             cache: false,
             success: function(result){

            $('#student-details').html(result) ;
            document.getElementById("student-details").innerHTML = result;

}
});
});


//......................................................................................



//......................................................................   
	<!--if searching a student through name...-->
    $('#name').on("keyup input", function(){
        /* Get input value on change */
		<!--first goes to backend-search.php-->
        var name = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(name.length){
            $.get("backend-search.php", {name: name}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });

    $(document).on("click", " .result .name", function(){
        $(this).parents(".search-box").find('#name').val($(this).text());
        $(this).parent(".result").empty();
   });
   <!--second goes to backend-search2.php-->
     $(document).on("click", ".result .name", function(){
        
         var name =$('#name').val();
          
            $.ajax({
             type: "POST",
             url: "backend-search2.php",   
             data: "name="+name,
             cache: false,
             success: function(result){

            $('#student-details').html(result) ;
            document.getElementById("student-details").innerHTML = result;

}
});
});


//......................................................................................

       
});


</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;"> STUDENT SEARCH 
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
 
    <!--...........................Searching Students by admission number or student name.................................-->
    <div class="search-box">
	
    <strong>Search by Admission No: </strong> <input type="text" onchange="clearvalue('name')" class="form-control" autocomplete="off" placeholder="Add No" id="add_no"/>
        <div class="result"></div>
    </div>
    <!--............................................................-->
    
    <!--............................................................-->

   <div class="search-box">
      <strong>Search by Name:</strong>  <input type="text"  class="form-control" onchange="clearvalue('add_no')" autocomplete="off" placeholder="Name" id="name"/>
        <div class="result"></div>
    </div>
    
    <div id="student-details"></div>
</div>
<script type="text/javascript">
    
     function clearvalue(a)
    {

        var c=document.getElementById(a);
        c.value="";
            }
</script>
<?php

include("includes/footer.php");
?>