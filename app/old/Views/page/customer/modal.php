<?php foreach ($customer as $c) : ?>
    <div class="modal fade" id="modal-default<?= $c['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data <?= $title; ?></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?= base_url('/customer/update/' . $c['id']) ?>" method="post">
                        <!-- <form id="text-editor"> -->
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Nama Pelanggan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="name" value="<?= $c['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Alamat Pelanggan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="address" value="<?= $c['address']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">No.Hp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="phone" value="<?= $c['phone']; ?>">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>