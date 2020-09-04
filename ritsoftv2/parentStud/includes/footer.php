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

    <script src="../dash/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../dash/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../dash/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../dash/vendor/raphael/raphael.min.js"></script>
    <script src="../dash/vendor/morrisjs/morris.min.js"></script>
    <script src="../dash/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dash/dist/js/sb-admin-2.js"></script>

</body>

</html>
