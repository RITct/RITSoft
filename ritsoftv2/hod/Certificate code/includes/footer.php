<script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>      

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


    <script src="../../dash/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../dash/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../dash/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../dash/vendor/raphael/raphael.min.js"></script>
    <script src="../../dash/vendor/morrisjs/morris.min.js"></script>
    <script src="../../dash/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dash/dist/js/sb-admin-2.js"></script>

</body>

</html>
