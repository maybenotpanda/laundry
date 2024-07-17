<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Aktivitas</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?= base_url('addactivity'); ?>" method="post">
                    <!-- <form id="text-editor"> -->
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">Nama Aktivitas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Nama aktivitas">
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

<?php foreach ($activity as $a) : ?>
    <div class="modal fade" id="modal-default<?= $a['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data Aktivitas</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?= base_url('/activity/update/' . $a['id']) ?>" method="post">
                        <!-- <form id="text-editor"> -->
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Nama Aktivitas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" name="name" value="<?= $a['name']; ?>">
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