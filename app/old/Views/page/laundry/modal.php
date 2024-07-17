<?php foreach ($laundry as $l) : ?>
    <div class="modal fade" id="modal-default<?= $l['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data Laundry</h4>
                </div>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1<?= $l['id']; ?>" data-toggle="tab" aria-expanded="true">Detail</a></li>
                        <li class=""><a href="#tab_2<?= $l['id']; ?>" data-toggle="tab" aria-expanded="false">Proses</a></li>
                    </ul>
                    <div class="modal-body">
                        <!-- Custom Tabs -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1<?= $l['id']; ?>">
                                <form class="form-horizontal" action="<?= base_url('/laundry/updatepaid/' . $l['id']) ?>" method="post">
                                    <!-- <form id="text-editor"> -->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nama Pelanggan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $l['name_customer']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Berat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $l['weight']; ?> Kg" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Jumlah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $l['qty']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Layanan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $l['name_service']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Total</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="price" value="<?= $l['price']; ?>" readonly>
                                        </div>
                                    </div>
                                    <?php
                                    if ($l['paid'] < $l['price']) {
                                    ?>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">Terbayar</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="sisa" value=" <?= $l['paid']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">Sisa</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value=" <?= $l['result']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">Pembayaran</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="paid" value="0">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $l['status']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <?php
                                        if ($l['paid'] < $l['price']) {
                                        ?>
                                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                        <?php } else { ?>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2<?= $l['id']; ?>">
                                <form class="form-horizontal" action="<?= base_url('/laundry/activity/' . $l['id']) ?>" method="post">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-10">

                                            <select class="form-control select2" name="id_activity" style="width: 100%;">
                                                <option selected="selected" value=""><?= $l['name_activity']; ?></option>
                                                <?php
                                                foreach ($activity as $c) { ?>
                                                    <option value="<?= $c['id']; ?>"><?= $c['name']; ?> </option>
                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>