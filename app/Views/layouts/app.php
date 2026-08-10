<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyMango.id | <?= $title; ?> </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url(); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/favicon.png" />
    <style>
        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }

        .example-modal .modal {
            background: transparent !important;
        }
    </style>
</head>

<body class="hold-transition skin-yellow-light sidebar-mini">
    <div class="wrapper">

        <!-- header -->
        <?= $this->include('layouts/header'); ?>
        <!-- ./header -->

        <!-- sidebar -->
        <?= $this->include('layouts/sidebar'); ?>
        <!-- ./sidebar -->
        <!-- content -->
        <?= $this->renderSection('content'); ?>
        <!-- content -->

        <!-- footer -->
        <?= $this->include('layouts/footer'); ?>
        <!-- ./footer -->

    </div>

    <script src="<?= base_url(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url(); ?>/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>/dist/js/demo.js"></script>
    <script src="<?= base_url(); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= base_url(); ?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= base_url(); ?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- <script src="/plugins/jszip/jszip.min.js"></script> -->
    <!-- <script src="/plugins/pdfmake/pdfmake.min.js"></script> -->
    <!-- <script src="/plugins/pdfmake/vfs_fonts.js"></script> -->
    <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2()

            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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
    <?= $this->renderSection('scripts'); ?>
</body>

</html>