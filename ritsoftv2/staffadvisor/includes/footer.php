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
<script type="text/javascript">
    if(typeof jQuery == 'undefined'){
        document.write('<script src="../dash/vendor/jquery/jquery.min.js"></'+'script>');
    }

</script>



<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../dash/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../dash/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../dash/vendor/raphael/raphael.min.js"></script>
<!-- <script src="../dash/vendor/morrisjs/morris.min.js"></script>  -->
<!-- <script src="../dash/data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript
     <script src="../dash/dist/js/sb-admin-2.js"></script>
 -->
 <!-- ===================================================== bootstrap datepicker ======================================================================= -->

 <link rel="stylesheet" type="text/css" href="../css/bootstrap-datepicker.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
 <script type="text/javascript" src="../js/bootstrap-datepicker.min.js" charset="UTF-8"></script>

 <script type="text/javascript">
    jQuery(document).ready(function($) {

        $.fn.datepicker.defaults.format = "yyyy-mm-dd";
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd' 
        });  
        $.fn.datepicker.defaults.autoclose = true;

        /*
        $('input[type="date"]').each(function(index, el) {
            $this = $(this);
            val = $this.val();
            name = $this.attr('name');
            id = $this.attr('id');
            $ty = '<div class="input-group date" data-provide="datepicker" data-date-end-date="0d"  >'+
            ' <input type="text" class="form-control datepicker-autoclose"  value="'+val+'" id="'+id+'"   name="'+name+'" placeholder="Date " required >'+
            '<div class="input-group-addon">'+
            '<span class="fa fa-calendar"></span>'+
            '</div>'; 
            $(this).replaceWith( $ty );

        });
        */
    });
</script>
<!-- ====================================================== bootstrap end ============================================================================ -->



</body>

</html>
