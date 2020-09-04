<?php
include("includes/header.php");
   $link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");
    include("includes/sidenav.php");
     
ob_start();
//session_start();
//if(!isset($_SESSION['fid']))
//{
  //  header('location:../login.php');
//}
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
table
{
padding-top: 20px;

}
    
th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
}

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
            $.get("stud_backend.php", {add_no: add_no,category:category}).done(function(data){
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
             url: "stud_backend2.php",
             data: {add_no:add_no,category:category},
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
<body>
    
    
    <!--............................................................-->
    
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" align="center"><span>Class Search</span></h1>
        </div>
        </div>
    </div>

    <form method="post" action="excel_studclass.php">
    <div class="row">
        <div class="col-lg-12">
            <div class="search-box">
			     <input type="text" class="form-control" autocomplete="off"  id="add_no" name="religion" placeholder="class"/>
                 <div class="result"></div>
            </div>
            
    <div id="student-details"></div>
</form>	
</body>
</html>
<?php
    include("includes/footer.php");
?>