<?php
include("includes/header.php");
include("includes/sidenav.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP Live MySQL Database Search</title>
  <style type="text/css">
  body{
    font-family: Arail, sans-serif;
  }
  /* Formatting search box */
  .search-box{
    width: 300px;
    position: relative;
    display: inline-block;
    font-size: 14px;
  }
  .search-box input[type="text"]{
    height: 32px;
    padding: 5px 10px;
    border: 1px solid #CCCCCC;
    font-size: 14px;
  }
  .result{
    position: absolute;        
    z-index: 999;
    top: 100%;
    left: 0;
  }
  .search-box input[type="text"], .result{
    width: 100%;
    box-sizing: border-box;
  }
  /* Formatting result items */
  .result p{
    margin: 0;
    padding: 7px 10px;
    border: 1px solid #CCCCCC;
    border-top: none;
    cursor: pointer;
  }
  .result p:hover{
    background: #f2f2f2;
  }
  table {
    margin-top: 200px;
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    /*border: 1px solid #ddd;*/
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even){background-color: #f2f2f2}
}

</style>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#add_no').hide();
    // $('#excel_btn').hide();
 //......................................................................   
 $('#add_no').on("keyup input", function(){
  /* Get input value on change */
  var add_no = $(this).val();
  var category = $('#category').val();

  var resultDropdown = $(this).siblings(".result");
  if(add_no.length){
    $.get("backend-search.php", {add_no: add_no,category:category}).done(function(data){
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
   var category = $('#category').val();
   $.ajax({
     type: "POST",
     url: "backend-search2.php",
     data: {add_no:add_no,category:category},
     cache: false,
     success: function(result){

      $('#student-details').html(result) ;
      document.getElementById("student-details").innerHTML = result;

    }
  });
 });

 $('#category').on('change', function() {

  var category_val =$('#category').val();
  if( category_val == 0)
  {
   $('#add_no').hide();
   // $('#excel_btn').hide();

 }
 else
 {
  $('#add_no').show();  
  $('#excel_btn').show(); 
}

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
</head>
<div id="page-wrapper">
  <body>


    <!--............................................................-->
    
    <form method="post" action="excel.php">
      <b><h4> <center>BASIC SEARCH</center> </h4></b>
      <table style=" margin-top: 0px; " class=" table2">
        <tr>
          <td>
            <select name="category" id="category" style=" height: 32px">
             <option value="0">Select</option>
             <option value="admissionno">Admission No</option>
             <option value="name">Name</option>
                    <!---- <option value="courseid">Course</option>
                      <option value="branch_or_specialisation">Branch Or Specialization</option>
                     <option value="religion">Religion</option>
                     <option value="caste">Caste</option>---->
                   </select>
                 </td>
                 <td>
                  <div class="search-box">
                    <input type="text" autocomplete="off"  id="add_no" name="religion"/>
                    <div class="result"></div>
                  </div>
                </td>
                <td>
                  <input type="submit" name="excel" value="Download Excel" style=" height: 32px" id="excel_btn">
                </td>
              </tr>
            </table>
          </form>


          <!--............................................................-->

          <!--............................................................-->
<!--    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Name" id="name"/>
        <div class="result"></div>
      </div>-->

      <div id="student-details"></div>
    </div>
  </body>


  </html>
  <?php

  include("includes/footer.php");
  ?>
