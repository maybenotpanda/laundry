<?= $this->extend('auth/layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>MyMango</b>.id</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Daftar akun karyawan</p>

        <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= route_to('register') ?>" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Nama Pengguna" value="<?= old('username') ?>">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="Email" value="<?= old('email') ?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Kata sandi" autocomplete="off">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="Ulangi Kata sandi" autocomplete="off">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <!-- /.col -->
            <div class="col-xs">
                <button type="submit" class="btn btn-warning btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </form>

        <p>Saya sudah memiliki akun? <a href="<?= route_to('login') ?>" class="text-center">Login</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<?= $this->endSection(); ?>