<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini"><img src="<?= base_url(); ?>/icon.png"></span>
        <span class="logo-lg"><b>MyMango</b>.id</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url(); ?>/dist/img/<?= user()->image; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= user()->username; ?></span>
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
                            <div class="pull-left">
                                <a href="profile/<?= user()->id; ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-flat">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>