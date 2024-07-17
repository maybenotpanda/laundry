<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<div class="content-wrapper">
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Karyawan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('addemployee'); ?>" method="post" id="text-editor">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">NIK</label>
                            <input type="text" name="nik" class="form-control" placeholder="ex: 1234567890">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nama Depan</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Nama Depan">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Nama Belakang</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Nama Belakang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="ex: Bumiayu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">No HP</label>
                            <input type="text" name="phone" class="form-control" placeholder="ex: 6281234567890">
                        </div>
                        <div class="form-group">
                            <label>Akun</label>
                            <select class="form-control select2" name="user_id" style="width: 100%;">
                                <option selected="selected" value="">- Pilih Akun -</option>
                                <?php
                                foreach ($users as $u) { ?>
                                    <option value="<?= $u['id']; ?>"><?= $u['username']; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Gaji</label>
                            <input type="number" name="salary" class="form-control" placeholder="Rp.">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?= base_url('employee'); ?>" class="btn btn">
                            Kembali</a>
                        <button type="submit" class="btn btn-primary  pull-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!-- /.box -->

</section>

</div>
<script>
    $('.select2').select2()
</script>
<!-- /.content -->
<?= $this->endSection(); ?>