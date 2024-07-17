<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah <small><?= $title; ?></small></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
                        <form action="<?= base_url('addcustomer'); ?>" method="post" id="text-editor">
                            <?= csrf_field(); ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Pelanggan</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Nama Pelanggan">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Alamat</label>
                                    <input type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="ex: Bumiayu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">No HP</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputPassword1" placeholder="ex: 6281234567890">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary  pull-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Daftar <small><?= $title; ?></small></h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="10">No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No.Hp</th>
                                                <th>Join</th>
                                                <th width="50">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $no = 1;
                                            foreach ($customer as $c) { ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $c['name']; ?></td>
                                                    <td><?= $c['address']; ?></td>
                                                    <td><?= $c['phone']; ?></td>
                                                    <td><?= date('d M y h:i', strtotime($c['created_at'])); ?> WIB</td>
                                                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default<?= $c['id']; ?>">
                                                            <i class=" fa fa-pencil"></i></a>
                                                        <a href="<?= base_url('/customer/delete/' . $c['id']) ?>" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i></a>
                                                    </td>
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
                                                <th>No.Hp</th>
                                                <th>Join</th>
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
            </div>
        </div>
    </section>
</div>
<?= $this->include('page/customer/modal'); ?>
<?= $this->endSection(); ?>