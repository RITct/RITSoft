<?php
include("includes/header.php");
include("includes/sidenav.php");
include("../connection.php");
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
            $.get("backend-search.php", {add_no: add_no}).done(function(data){
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
    $('#name').on("keyup input", function(){
        /* Get input value on change */
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
    <h1 class="page-header"><span style="font-weight:bold;"> SESSIONAL MARKS
    </span></h1>
    </div>
    </div>
 
    <!--............................................................-->
    <div class="search-box">
	
    <b><h5>SEARCH BY ADMISSION NO</b></h5> <input type="text"  class="form-control" autocomplete="off" placeholder="Admission No" id="add_no"/>
    <div class="result"></div>
    </div>
    <!--............................................................-->
    
    <!--............................................................-->

   <div class="search-box">
    <b><h5>SEARCH BY NAME </b></h5> <input type="text"  class="form-control" autocomplete="off" placeholder="Name" id="name"/>
        <div class="result"></div>
    </div>
    
    <div id="student-details"></div>
</div>

<?php

include("includes/footer.php");
?>