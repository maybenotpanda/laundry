<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<!-- Content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar <small><?= $title; ?></small></h3>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default">
                                Tambah</button>
                        </div>
                    </div>
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
                                    <th>Nama Layanan</th>
                                    <th>Harga</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($service as $s) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $s['name']; ?>
                                        </td>
                                        <td>Rp.<?= $s['price']; ?>/Kg</td>
                                        <td><?= $s['day']; ?> Hari</td>
                                        <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default<?= $s['id']; ?>">
                                                <i class=" fa fa-pencil"></i></a>
                                            <a href="<?= base_url('/service/delete/' . $s['id']) ?>" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content -->

<?= $this->include('admin/service/modal'); ?>
<?= $this->endSection(); ?>
<script>
    window.print();
</script>