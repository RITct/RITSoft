<?php
include("includes/header.php");
?>
<!DOCTYPE html>
<?php
include("includes/sidenav.php");
include("includes/connection1.php");
?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
 //......................................................................   
    $('#add_no').on("keyup input", function(){
        /* Get input value on change */
        var add_no = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(add_no.length){
            $.get("attbackend-search.php", {add_no: add_no}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    $(document).on("click", ".result .add_no", function(){
        $(this).parents(".search-box").find('#add_no').val($(this).text());
        $(this).parent(".result").empty();
   });
     $(document).on("click", ".result .add_no", function(){
        
         var add_no =$('#add_no').val();
          
            $.ajax({
             type: "POST",
             url: "attbackend-search2.php",
             data: "add_no="+add_no,
             cache: false,
             success: function(result){

            $('#student-details').html(result) ;
            document.getElementById("student-details").innerHTML = result;

}
});
});


//......................................................................................
$('#name').on("keyup input", function(){
        /* Get input value on change */
        var name = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(name.length){
            $.get("attbackend-search.php", {name: name}).done(function(data){
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
     $(document).on("click", ".result .name", function(){
        
         var name =$('#name').val();
          
            $.ajax({
             type: "POST",
             url: "attbackend-search2.php",
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
 
    <!--............................................................-->
    <div class="search-box">
	
    <strong>SEARCH BY ADMISSION NO </strong> <input type="text"  class="form-control" autocomplete="off" placeholder="Add No" id="add_no"/>
        <div class="result"></div>
    </div>
    <!--............................................................-->
    
    <!--............................................................-->

   <div class="search-box">
      <strong>SEARCH BY NAME </strong>  <input type="text"  class="form-control" autocomplete="off" placeholder="Name" id="name"/>
        <div class="result"></div>
    </div>
    
    <div id="student-details"></div>
</div>
<?php

include("includes/footer.php");
?>