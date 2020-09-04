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
    width: 600px;
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

</style>
<script src="jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

 //......................................................................   
 $('#add_no').on("keyup input", function(){
    /* Get input value on change */
    var add_no = $(this).val();
    var category = $('#category').val();

    var resultDropdown = $(this).siblings(".result");
    if(add_no.length){
        $.get("pgclasssessbackend.php", {add_no: add_no,category:category}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
    } else{
        resultDropdown.empty();
    }
});

    //excel_btn


    $(document).on("click", ".result .add_no", function(){
        $(this).parents(".search-box").find('#add_no').val($(this).text());
        $(this).parent(".result").empty();
    });
    $(document).on("click", ".result .add_no", function(){

     var add_no =$('#add_no').val();
     var category = $('#category').val();
     $.ajax({
         type: "POST",
         url: "pgclasssessbackend2.php",
         data: {add_no:add_no,category:category},
         cache: false,
         success: function(result){
            result += "<input type='submit' name='excel' value='Download Excel' style=' height: 35px' id='excel_btn'>";
            $('#student-details').html(result) ;
            document.getElementById("student-details").innerHTML = result;

        }
    });
 });

    $(document).on("click", "#student-details #excel_btn", function(){

        var add_no =$('#add_no').val();
        var category = $('#category').val();
        $.ajax({
           type: "POST",
           url: "pgclasssessbackend2.php",
           data: {add_no:add_no,category:category},
           cache: false,
           success: function(result){  

            var f = $('#excel_form');
            f.find('input[name=data]').val(result);
            f.find('input[name=name]').val('file'); 
            f.submit(); 
        }
    });
    });



//......................................................................................












});
</script>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="excel_pgclasssess.php">
             <h1 class="page-header"><span style="font-weight:bold;"> CLASS SESSIONALMARK SEARCH 
             </span></h1>
         </div>
     </div>
     <table style=" margin-top: 0px; " class=" table2">
        <tr>
         <td><b><h5>SEARCH BY</b><h5></td>
            <td>
                <div class="search-box">
                    <input type="text" autocomplete="off"  id="add_no" name="religion" placeholder="enter a class"/>
                    <div class="result"></div>
                </div>
            </td>

        </tr>
    </table>


    
    <!--............................................................-->
    
    <!--............................................................-->
<!--    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Name" id="name"/>
        <div class="result"></div>
    </div>-->
    
    <div id="student-details" style="padding: 20px 0px;"></div>

</form>	
<form id="excel_form" method="post" action="as_excel.php" target="_blank" style="display: none !important;">
    <input type="hidden" name="data" value="" />
    <input type="hidden" name="name" value="" /> 
</form>
</div>
<?php
include("includes/footer.php");
?>