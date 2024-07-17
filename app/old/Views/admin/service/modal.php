<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Layanan</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?= base_url('addservice'); ?>" method="post">
                    <!-- <form id="text-editor"> -->
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">Nama Layanan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Nama Layanan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-3 control-label">Harga Layanan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail" name="price" placeholder="Rp.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">Waktu</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputName" name="day" placeholder="Waktu pengerjaan">
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

<?php foreach ($service as $s) : ?>
    <div class="modal fade" id="modal-default<?= $s['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data Layanan</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?= base_url('/service/update/' . $s['id']) ?>" method="post">
                        <!-- <form id="text-editor"> -->
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Nama Layanan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="name" value="<?= $s['name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-3 control-label">Harga Layanan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail" name="price" value="<?= $s['price']; ?>" placeholder="Rp.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Waktu</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="day" value="<?= $s['day']; ?>" placeholder="Waktu pengerjaan">
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