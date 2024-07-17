<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Pembayaran
            <small><?= $title; ?></small>
        </h1>
    </section>
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $laundry['invoice']; ?></h3>
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
                <form action="<?= base_url('/laundry/paid/' . $laundry['id']) ?>" method="post" id="text-editor">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Total</label>
                            <input type="text" name="price" class="form-control pull-right" id="reservationtime" value="<?= $laundry['price']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Pembayaran</label>
                            <input type="text" name="paid" class="form-control pull-right" id="reservationtime" value="<?= $laundry['paid']; ?>">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?= base_url('laundry'); ?>" class="btn btn">
                            Kembali</a>
                        <button type="submit" class="btn btn-primary  pull-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!-- /.box -->
<!-- /.content -->

<?= $this->endSection(); ?>