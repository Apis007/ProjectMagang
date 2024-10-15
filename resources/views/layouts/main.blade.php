<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    @yield("contents")
    <!-- Main Sidebar Container -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="template/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="template/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="template/plugins/raphael/raphael.min.js"></script>
    <script src="template/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="template/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="template/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="template/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="template/dist/js/pages/dashboard2.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="template/plugins/jszip/jszip.min.js"></script>
    <script src="template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

    </script>
</body>

</html>
