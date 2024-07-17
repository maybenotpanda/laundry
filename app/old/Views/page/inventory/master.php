<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $title; ?></h3>
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
                <form action="<?= base_url('addinventory'); ?>" method="post" id="text-editor">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <input type="hidden" name="user_id" class="form-control" value="<?= user()->id; ?>" readonly>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Pengajuan</label>
                            <input type="text" name="name" class="form-control" placeholder="ex: Pewangi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga</label>
                            <input type="number" name="price" class="form-control" placeholder="ex: 1234567890">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah Pembelian</label>
                            <input type="number" name="qty" class="form-control" placeholder="ex: 1234567890">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control" name="unit" style="width: 100%;">
                                <option selected="selected" value="">- Pilih Satuan -</option>
                                <option value="PCS">PCS</option>
                                <option value="Liter">Liter</option>
                                <option value="Gram">Gram</option>
                                <option value="Kg">Kg</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" style="width: 100%;" aria-readonly="true" disabled="">
                                <option value="">- Pilih Satuan -</option>
                                <option selected="selected" value="Pengajuan">Pengajuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <textarea type="number" name="note" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?= base_url('barang'); ?>" class="btn btn">
                            Kembali</a>
                        <button type="submit" class="btn btn-primary  pull-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>