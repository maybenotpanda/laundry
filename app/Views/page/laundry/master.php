<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah <?= $title; ?></h3>
            </div>
            <div class="box-body">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('transaction'); ?>" method="post" id="text-editor">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" name="" class="form-control pull-right" id="reservationtime" value="<?= $now; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <select class="form-control select2" name="customerId" style="width: 100%;">
                                <option selected="selected" value="">- Pilih Pelanggan -</option>
                                <?php
                                foreach ($customer as $c) { ?>
                                    <option value="<?= $c['id']; ?>"><?= $c['name']; ?> - <?= $c['phone']; ?> </option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detail Layanan</h3>
                            </div>
                            <div class="card-body">
                                <div id="serviceContainer">
                                    <div class="card card-secondary service-item">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Layanan #1
                                            </h3>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-danger btn-sm float-right removeRow">
                                                    Hapus Data <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Layanan</label>
                                                <select class="form-control select2" name="serviceIds[]">
                                                    <option value="">
                                                        -Pilih Layanan-
                                                    </option>
                                                    <?php foreach ($service as $s): ?>
                                                        <option value="<?= $s['id']; ?>">
                                                            <?= $s['name']; ?> - Rp <?= number_format($s['price']); ?>/<?= $s['day']; ?> Hari
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Berat</label>
                                                <input type="number" name="weight[]" class="form-control" placeholder="Kg">
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Pakaian</label>
                                                <input type="number" name="qty[]" class="form-control" placeholder="Unit">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea name="description[]" class="form-control" placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group pull-lift">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-success btn-sm" id="addOtherServices">
                                        Tambah Layanan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="userId" class="form-control" value="<?= user()->id; ?>">
                    </div>
                    <div class="box-footer">
                        <a href="<?= base_url('laundry'); ?>" class="btn btn">Kembali</a>
                        <button type="submit" class="btn btn-primary  pull-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>