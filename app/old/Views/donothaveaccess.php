<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyMango.id | <?= $title; ?> </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url(); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/bower_components/font-awesome/css/font-awesome.min.css">
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
        .error-content{
            padding-top: 15px !important;
        }
        
        .content{
            min-height: 400px !important;
        }
          @media (max-width: 991px){
 .error-content{
            padding-top: 0px !important;
        }
}
        
    </style>
</head>

<body class="hold-transition skin-yellow-light sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><img src="<?= base_url(); ?>/icon.png"></span>
                <span class="logo-lg"><b>Mango</b>.id</span>
            </a>
            <nav class="navbar navbar-static-top">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url(); ?>/dist/img/<?= user()->image; ?>" class="user-image" alt="User Image">
                                <span ><?= user()->username; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= base_url(); ?>/dist/img/<?= user()->image; ?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?= user()->username; ?>
                                        <small>Bergabung Sejak <?= date('d M y', strtotime(user()->created_at)); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull">
                                        <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-block">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- content -->
        <!-- Content Header (Page header) -->
<section class="content">
          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Something wrong.</h3>
              <p>
                Your account, do not have access. please contact admin for more information
              </p>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section>

            </div>

    <script src="<?= base_url(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url(); ?>/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>/dist/js/demo.js"></script>
</body>

</html>