<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow" style="background-color: #FFF !important; color:#444 !important;">
                    <div class="inner">
                        <h3><?= $process_transactions ?></h3>
                        <p>Dalam Proses</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow" style="background-color: #FFF !important; color:#444 !important;">
                    <div class="inner">
                        <h3><?= $completed_transactions ?></h3>
                        <p>Selesai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-tshirt-outline"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow" style="background-color: #FFF !important; color:#444 !important;">
                    <div class="inner">
                        <h3><?= $monthly_transactions ?></sup></h3>
                        <p>Transaksi Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow" style="background-color: #FFF !important; color:#444 !important;">
                    <div class="inner">
                        <h3><?= $previous_transactions ?></h3>
                        <p>Total Transaksi Sebelumnya</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-podium"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar <small><?= $title; ?></small></h3>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            <a href="<?= base_url('laundry/add-laundry/'); ?>" class="btn btn-success btn-sm">
                                Tambah</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Layanan</th>
                                    <th>Masuk</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($laundry as $l) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><a href="laundry/invoice/<?= $l['id']; ?>"><?= $l['invoice']; ?></a></td>
                                        <td><?= $l['name_customer']; ?></td>
                                        <td><?= $l['weight']; ?></td>
                                        <td><?= $l['price']; ?></td>
                                        <td><?= $l['name_service']; ?></td>
                                        <td><?= date('d M y', strtotime($l['created_at'])); ?></td>
                                        <td><?= date('d M y h:i', strtotime($l['finished_at'])); ?></td>

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
                                        <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default<?= $l['id']; ?>">
                                                <i class=" fa fa-pencil"></i></a>
                                            <a class="btn btn-success btn-sm" href="https://wa.me/<?= $l['phone_customer']; ?>?text=*Laundry Meilinia*%0A=======================%0A%0AJl. Cardiact No.38 (belakang RSUP H. Adam Malik), Medan Tuntungan%0ANo Tlp : 085158031022%0A=======================%0AHai <?= $l['name_customer']; ?> Laundry anda <?= $l['name_activity']; ?>%0A%0AInvoice : <?= $l['invoice']; ?>%0APaket Layanan : <?= $l['name_service']; ?> ( Rp.<?= $l['price_service']; ?> x <?= $l['weight']; ?> Kg )%0ATanggal Masuk : <?= date('d M y h:i', strtotime($l['created_at'])); ?>%0ATanggal Selesai : <?= date('d M y h:i', strtotime($l['finished_at'])); ?>%0A%0AStatus : <?= $l['status']; ?>%0ATotal : <?= $l['price']; ?>%0A=======================%0ATerima Kasih%0A%0ALink :%0Ahttps://laundry.demiadektu.com/detail/<?= $l['invoice']; ?>" target="_blank" class="btn btn-success pull-right" style="margin-right: 5px;">
                                                <i class="fa fa-send"></i></a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Layanan</th>
                                    <th>Masuk</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<?= $this->include('page/laundry/modal'); ?>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>