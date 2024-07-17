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
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar<small> <?= $title; ?></small></h3>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            <a href="<?= base_url('barang/add-inventory'); ?>" class="btn btn-success btn-sm">
                                Tambah</a>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty(session()->getFlashdata('success'))) : ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                                <?php echo session()->getFlashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($inventory as $i) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $i['invoice']; ?></td>
                                        <td><?= $i['name']; ?></td>
                                        <td><?= $i['qty']; ?> <?= $i['unit']; ?></td>
                                        <td><?= $i['price']; ?></td>
                                        <td><?= $i['total']; ?></td>
                                        <td>
                                            <?php
                                            if ($i['status'] == "Diterima") {
                                            ?>
                                                <span class="label label-success"><?= $i['status']; ?></span>
                                            <?php } else if ($i['status'] == "Pengajuan") { ?>
                                                <span class="label label-warning"><?= $i['status']; ?></span>
                                            <?php } else { ?>
                                                <span class="label label-danger"><?= $i['status']; ?></span>
                                            <?php } ?>
                                        </td>
                                        <td><a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default<?= $i['id']; ?>">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit<?= $i['id']; ?>">
                                                <i class=" fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
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
<?= $this->include('page/inventory/modal'); ?>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>