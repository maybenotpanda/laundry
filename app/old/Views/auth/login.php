  <?= $this->extend('auth/layouts/app'); ?>
  <?= $this->section('content'); ?>
  <div class="login-box">
      <div class="login-logo">
          <a href="<?= base_url('login'); ?>"><b>MyMango</b>.id</a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
          <p class="login-box-msg">Login akun MyMango</p>
          <?= view('Myth\Auth\Views\_message_block') ?>
          <form action="<?= route_to('login') ?>" method="post">
              <div class="form-group has-feedback">
                  <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="Nama Pengguna atau Email">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                  <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Kata Sandi">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <!-- /.col -->
              <div class="col-xs">
                  <button type="submit" class="btn btn-warning btn-block">Login</button>
              </div>
              <!-- /.col -->
          </form>
          <p>Tidak memiliki akun?<a href="<?= route_to('register') ?>" class="text-center"> Buat akun</a>

      </div>
      <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <?= $this->endSection(); ?>