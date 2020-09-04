 </div>
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
        console.log('no jQuery');
        document.write('<script type="text/javascript" src="../dash/vendor/jquery/jquery.min.js"></'+'script>');
    }

</script>
<!-- <script src="../dash/vendor/jquery/jquery.min.js"></script> -->
<!-- <script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script> -->


<!-- Bootstrap Core JavaScript -->
<script src="../dash/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../dash/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../dash/vendor/raphael/raphael.min.js"></script>

<?php if( ! isset($nomorris)) : ?>
    <script src="../dash/vendor/morrisjs/morris.min.js"></script>
    <script src="../dash/data/morris-data.js"></script>
<?php endif;  ?>

<!-- Custom Theme JavaScript -->
<script src="../dash/dist/js/sb-admin-2.js"></script>

</body>

</html>
