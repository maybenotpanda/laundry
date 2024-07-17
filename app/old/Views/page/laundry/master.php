<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<div class="content-wrapper">
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah <?= $title; ?></h3>
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
                <form action="<?= base_url('addlaundry'); ?>" method="post" id="text-editor">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" name="created_at" class="form-control pull-right" id="reservationtime" value="<?= $now; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <select class="form-control select2" name="id_customer" style="width: 100%;">
                                <option selected="selected" value="">- Pilih Pelanggan -</option>
                                <?php
                                foreach ($customer as $c) { ?>
                                    <option value="<?= $c['id']; ?>"><?= $c['name']; ?> - <?= $c['phone']; ?> </option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Layanan</label>
                            <select class="form-control select2" id="id" name="id_service" style="width: 100%;" onchange="getService()">
                                <option selected="selected" value="">- Pilih Layanan -</option>
                                <?php
                                foreach ($service as $s) : ?>
                                    <option value="<?= $s['id']; ?>"><?= $s['name']; ?> - Rp.<?= $s['price']; ?>/<?= $s['day']; ?>Hari </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Berat</label>
                            <input type="text" name="weight" class="form-control" id="exampleInputPassword1" placeholder="/Kg">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah Pakaian</label>
                            <input type="number" name="qty" class="form-control" id="exampleInputPassword1" placeholder="Unit">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <textarea type="text" name="note" class="form-control" id="exampleInputPassword1" placeholder="Keterangan"></textarea>
                        </div>
                        <input name="price_service" id="price" class="form-control w-100 costum-rounded" value="<?= (isset($s['price'])) ? $s['price'] : ''; ?>" type="hidden">
                        <input name="day_service" id="day" class="form-control w-100 costum-rounded" value="<?= (isset($s['day'])) ? $s['day'] : ''; ?>" type="hidden">
                        <input type="hidden" name="user_id" class="form-control" id="exampleInputPassword1" value="<?= user()->id; ?>">
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
<script>
    function getService() {
        let e = document.getElementById("id");
        let ids = e.value;
        $.get("/getService/" + ids, function(response) {
            let detailS = JSON.parse(response);
            document.getElementById("price").value = detailS.price;
            document.getElementById("day").value = detailS.day;
        });
    }
</script>
<?= $this->endSection(); ?>