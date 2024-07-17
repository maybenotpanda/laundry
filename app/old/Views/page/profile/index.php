<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <!-- <li class="active"><a href="#tab_1" data-toggle="tab">Data Diri</a></li> -->
                        <li class="active"><a href="#tab_1<?= $e['employeeid']; ?>" data-toggle="tab" aria-expanded="true">Profil</a></li>
                        <li><a href="#akun" data-toggle="tab">Akun</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="tab_1<?= $e['employeeid']; ?>">
                            <!-- Post -->
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" value="<?= $e['first_name']; ?> <?= $e['last_name']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" value="<?= $e['address']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Nomor Tlp.</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" value="<?= $e['phone']; ?>" readonly>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="akun">
                            <form class="form-horizontal" action="/profile/update/<?= user()->id; ?>" method="post">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-3 control-label">Nama Pengguna</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= user()->username; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" value="<?= user()->email; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-3 control-label">Kata Sandi Baru</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" placeholder="Kata sandi" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-3 control-label">Ulangi Kata Sandi Baru</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="pass_confirm" placeholder="Ulangi Kata sandi" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->

            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?= base_url(); ?>/dist/img/<?= user()->image; ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?= user()->username; ?></h3>
                        <p class="text-muted text-center">Software Engineer</p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- /.box -->
<!-- /.content -->
<?= $this->endSection(); ?>