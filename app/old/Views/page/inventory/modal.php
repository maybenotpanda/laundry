<?php foreach ($inventory as $i) : ?>
    <div class="modal fade" id="modal-default<?= $i['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data <?= $title; ?></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?= base_url('/inventory/update/' . $i['id']) ?>" method="post">
                        <!-- <form id="text-editor"> -->
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Nama Pengajuan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" value="<?= $i['name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" value="<?= $i['price']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Total</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="address" value="<?= $i['total']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" value="<?= $i['qty']; ?> <?= $i['unit']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" value="<?= $i['status']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="inputName" readonly><?= $i['note']; ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit<?= $i['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data <?= $title; ?></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?= base_url('/inventory/update/' . $i['id']) ?>" method="post">
                        <!-- <form id="text-editor"> -->
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Nama Pengajuan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="name" value="<?= $i['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="price" value="<?= $i['price']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="qty" value="<?= $i['qty']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="inputName" name="note"><?= $i['note']; ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>