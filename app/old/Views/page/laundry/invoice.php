<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<style>
    .status {
        height: 50px;
    }

    @media only screen and (max-width: 445px) {
        .mobile {
            visibility: hidden;
        }
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <small><?= $laundry['invoice']; ?></small>
        </h1>
    </section>


    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Laundry Meilinia.
                    <small class="pull-right mobile">Waktu: <?= $now; ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong><?= user()->username; ?></strong><br>
                    Jl. Cardiact No.38,<br>
                    (belakang RSUP H. Adam Malik), Medan Tuntungan<br>
                    Phone: 0851 5803 1022<br>
                </address>
            </div>
            <!-- /.col -->
      
            <div class="col-sm-4 invoice-col">
                Pelanggan
                <address>
                    <strong><?= $laundry['name_customer']; ?></strong><br>
                    <?= $laundry['address_customer']; ?><br>
                    Phone: <?= $laundry['phone_customer']; ?><br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #<?= $laundry['invoice']; ?></b><br>
                <br>
                <b>Order ID:</b> <?= $laundry['invoice']; ?><br>
                <b>Tanggal Masuk:</b> <?= date('d M y', strtotime($laundry['created_at'])); ?><br>
                <b>Tanggal Selesai:</b> <?= date('d M y', strtotime($laundry['finished_at'])); ?><br><br>
                <!-- <b>Pelanggan:</b> -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Jumlah Pakaian</th>
                            <?php
                            if ($laundry['note'] == NULL) {
                            ?>
                                <!-- <th>Keterangan</th> -->
                            <?php } else { ?>
                                <th>Keterangan</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $laundry['name_service']; ?></td>
                            <td><?= $laundry['qty']; ?></td>
                            <?php
                            if ($laundry['note'] == NULL) {
                            ?>

                            <?php } else { ?>
                                <td><?= $laundry['note']; ?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12 pull">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="width:50%">Berat:</td>
                            <td><?= $laundry['weight']; ?> Kg</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Subtotal:</td>
                            <td>Rp. <?= $laundry['price_service']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:50%">Total:</td>
                            <td>Rp. <?= $laundry['price']; ?></td>
                        </tr>
                        <?php
                        if ($laundry['paid'] < $laundry['price']) {
                        ?>
                            <tr>
                                <th style="width:50%">Dibayar:</th>
                                <td>Rp. <?= $laundry['paid']; ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">Sisa:</th>
                                <td>Rp. <?= $laundry['result']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"><img src="<?= base_url(); ?>/dist/img/<?= $laundry['status']; ?>.png" class="status"></th>
                            </tr>
                        <?php } else if ($laundry['paid'] == $laundry['price']) { ?>
                            <tr>
                                <th style="width:50%">Dibayar:</th>
                                <td>Rp. <?= $laundry['paid']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> <img src="<?= base_url(); ?>/dist/img/<?= $laundry['status']; ?>.png" class="status"></th>
                            </tr>
                        <?php  } else { ?>
                            <tr>
                                <th style="width:50%">Dibayar:</th>
                                <td>Rp. <?= $laundry['paid']; ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">Kembalian:</th>
                                <td>Rp. <?= $laundry['result']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"><img src="<?= base_url(); ?>/dist/img/<?= $laundry['status']; ?>.png" class="status"></th>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <!-- <a href="" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
                <a href="https://wa.me/<?= $laundry['phone_customer']; ?>?text=*Laundry Meilinia*%0A=======================%0A%0AJl. Cardiact No.38 (belakang RSUP H. Adam Malik), Medan Tuntungan%0ANo Tlp : 085158031022%0A=======================%0AHai <?= $laundry['name_customer']; ?> Laundry anda <?= $laundry['name_activity']; ?>%0A%0AInvoice : <?= $laundry['invoice']; ?>%0APaket Layanan : <?= $laundry['name_service']; ?> ( Rp.<?= $laundry['price_service']; ?> x <?= $laundry['weight']; ?> Kg )%0ATanggal Masuk : <?= date('d M y h:i', strtotime($laundry['created_at'])); ?>%0ATanggal Selesai : <?= date('d M y h:i', strtotime($laundry['finished_at'])); ?>%0A%0AStatus : <?= $laundry['status']; ?>%0ATotal : <?= $laundry['price']; ?>%0A=======================%0ATerima Kasih%0A%0ALink :%0Ahttps://laundry.demiadektu.com/detail/<?= $laundry['invoice']; ?>" target="_blank" class="btn btn-success pull-right" style="margin-right: 5px;">
                    <i class="fa fa-send"></i> Kirim WhatsApp
                </a>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>
<?= $this->endSection(); ?>