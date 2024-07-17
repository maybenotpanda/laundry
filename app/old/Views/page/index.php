<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<!-- content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Hi <strong><?= user()->username; ?></strong>, selamat datang 🙂</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= ($pendapatanHariIni['total'] == null) ? '0' : $pendapatanHariIni['total'] ?></h3>
                        <p>Transaksi Hari ini</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-tshirt"></i>
                    </div>
                    <a href="<?= base_url('income'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $customer ?></sup></h3>
                        <p>Pelanggan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="<?= base_url('customer'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= ($outcome['total'] == null) ? '0' : $outcome['total'] ?></h3>

                        <p>Pengeluaran</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cube"></i>
                    </div>
                    <a href="<?= base_url('outcome'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $totalprocess ?> / <?= $totallaundry ?></h3>

                        <p>Proses</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('laundry'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Transaksi Laundry</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama Pelanggan</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($laundry as $l) { ?>
                                <tr>
                                    <td><a href="laundry/invoice/<?= $l['id']; ?>"><?= $l['invoice']; ?></a></td>
                                    <td><?= $l['name_customer']; ?></td>

                                    <td><?= $l['paid']; ?></td>
                                    <td>
                                        <?php
                                        if ($l['name_activity'] == "Sudah diambil") {
                                        ?>
                                            <span class="label label-success"><?= $l['name_activity']; ?></span>
                                        <?php } else if ($l['name_activity'] == "Dalam Proses") { ?>
                                            <span class="label label-warning"><?= $l['name_activity']; ?></span>
                                        <?php  } else if ($l['name_activity'] == "Selesai") { ?>
                                            <span class="label label-info"><?= $l['name_activity']; ?></span>
                                        <?php } else { ?>
                                            <span class="label label-danger"><?= $l['name_activity']; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="box-footer clearfix">
                <a href="<?= base_url('laundry/add-laundry/'); ?>" class="btn btn-sm btn-info btn-flat pull-left">Tambah Transaksi</a>
                <a href="<?= base_url('laundry'); ?>" class="btn btn-sm btn-default btn-flat pull-right">Lihat Transaksi</a>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- ./content -->
<?= $this->endSection(); ?>