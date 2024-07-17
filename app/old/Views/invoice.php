<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laundry Meilinia | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  
      <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/favicon.png" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
</head>
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
<body>
<div class="wrapper">
  <!-- Main content -->
      <?php
    foreach ($laundry as $laundry) { ?>
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Laundry Meilinia.
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Laundry Meilinia.</strong><br>
          Jl. Cardiact No.38,<br>
                    (belakang RSUP H. Adam Malik), Medan Tuntungan<br>
                    No. Tlp: 0851 5803 1022<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Pelanggan
        <address>
          <strong><?= $laundry['name_customer']; ?></strong><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>No Invoice:</b> <?= $laundry['invoice']; ?><br>
        <b>Tanggal Masuk:</b> <?= date('d M y', strtotime($laundry['created_at'])); ?><br>
        <b>Tangal Selesai:</b> <?= date('d M y', strtotime($laundry['finished_at'])); ?><br><br>
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
      <!-- accepted payments column -->
      <!-- /.col -->
      <div class="col-xs-12">
        <div class="table-responsive">
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
  </section>
    <?php
    } ?>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
