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
                            <a href="<?= base_url('employee/add-employee/'); ?>" class="btn btn-success btn-sm">
                                Tambah</a>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. HP</th>
                                    <th>Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($employee as $e) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $e['first_name']; ?> <?= $e['last_name']; ?></td>
                                        <td><?= $e['address']; ?></td>
                                        <td><?= $e['phone']; ?></td>
                                        <td><?= $e['username']; ?></td>
                                        <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default<?= $e['employeeid']; ?>">
                                                <i class=" fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. HP</th>
                                    <th>Akun</th>
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

<?= $this->include('admin/employee/modal'); ?>
<?= $this->endSection(); ?>