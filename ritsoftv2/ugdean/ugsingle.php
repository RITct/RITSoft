<?php
include("includes/header.php");
?>
<!DOCTYPE html>
<?php


include("includes/sidenav.php");
?>
<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position:relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 35px;
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
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
   /* border: 1px solid #ddd;*/
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
    $('#excel_btn').hide();
 //......................................................................   
    $('#add_no').on("keyup input", function(){
        /* Get input value on change */
        var add_no = $(this).val();
        var category = $('#category').val();
        if($('#add_no').val()=="")
            $('#student-details').hide();
        $('#loadingmessage').show();
        var resultDropdown = $(this).siblings(".result");
        if(add_no.length){
            $.get("ugbackend.php", {add_no: add_no,category:category}).done(function(data){
                // Display the returned data in browser
                $('#loadingmessage').hide();
                resultDropdown.html(data);
            });
        } else{
          $('#loadingmessage').hide();
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
            $('#loadingmessage').show();
            $('#student-details').hide();
            $.ajax({
             type: "POST",
             url: "ugbackend2.php",
             data: {add_no:add_no,category:category},
             cache: false,
             success: function(result){
               $('#loadingmessage').hide();
               $('#student-details').show();
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
     $('#excel_btn').hide();
     
  }
  else
  {
    $('#add_no').show();  
    $('#excel_btn').show(); 
  }
  
});


//......................................................................................



//......................................................................   
   
   


//......................................................................................






    
       
});


</script>
<div id="page-wrapper">
<form method="post" action="excel_single.php">
			<div class="row">
                <div class="col-lg-12">
					
					<h1 class="page-header"><span style="font-weight:bold;"> STUDENT SEARCH 
                    </span></h1>
                </div>
            </div>
            <table style=" margin-top: 55px; " class=" table2">
            <tr>
                <td><b><h5>SEARCH BY</b><h5></td>
                    <td><select name="category" id="category" style=" height: 35px">
                     <option value="0">Select</option>
                     <option value="admissionno">Admission No</option>
                     <option value="name">Name</option>
                     <option value="courseid">Course</option>
                     <option value="branch_or_specialisation">Branch Or Specialization</option>
                     <option value="religion">Religion</option>
                     <option value="caste">Caste</option>
                    </select>
                </td>
                <td>
                    <div class="search-box">
                    <input type="text" autocomplete="off"  id="add_no" name="add_no"/>
                    <div class="result"></div>
                    </div>
                </td>
                <td>
                   
                </td>
            </tr>
        </table>
       
         
    
    <!--............................................................-->
    
    <!--............................................................-->
<!--    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Name" id="name"/>
        <div class="result"></div>
    </div>-->
    <div id='loadingmessage' style='display:none'>
  <img src='includes/1.gif' style="display: block; margin-left: auto;
    margin-right: auto;
    width: 10%;"  />
</div>


    <div id="student-details"></div>
 </form>
	</div>

<?php

include("includes/footer.php");
?>