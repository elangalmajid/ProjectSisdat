
<script type="text/javascript" src="Plugin/DataTables/Buttons-2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="Plugin/DataTables/jQuery-3.6.0/jquery-3.6.0.js"></script>
<script type="text/javascript" src="Plugin/DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="Plugin/DataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="Plugin/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="Plugin/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="Plugin/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="Plugin/DataTables/Buttons-2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="Plugin/DataTables/Buttons-2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    });
</script>