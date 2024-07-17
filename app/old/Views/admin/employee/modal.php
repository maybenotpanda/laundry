<?php foreach ($employee as $e) : ?>
    <div class="modal fade" id="modal-default<?= $e['employeeid']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data Karyawan</h4>
                </div>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1<?= $e['employeeid']; ?>" data-toggle="tab" aria-expanded="true">Profil</a></li>
                        <li class=""><a href="#tab_2<?= $e['user_id']; ?>" data-toggle="tab" aria-expanded="false">Hak Akses</a></li>
                    </ul>
                    <div class="modal-body">
                        <!-- Custom Tabs -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1<?= $e['employeeid']; ?>">
                                <form class="form-horizontal" action="<?= base_url('/employee/update/' . $e['employeeid']) ?>" method="post">
                                    <!-- <form id="text-editor"> -->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nama Depan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputName" name="first_name" value="<?= $e['first_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-3 control-label">Nama Belakang</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputEmail" name="last_name" value="<?= $e['last_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Alamat</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputName" name="address" value="<?= $e['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSkills" class="col-sm-3 control-label">No Tlp</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputSkills" name="phone" value="<?= $e['phone']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSkills" class="col-sm-3 control-label">Gaji</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="inputSkills" name="salary" value="<?= $e['salary']; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2<?= $e['user_id']; ?>">
                                <form class="form-horizontal" action="<?= base_url('/employee/group-update/' . $e['employeeid']) ?>" method="post">
                                    <input type="hidden" class="form-control" id="inputName" name="id" value="<?= $e['user_id']; ?>">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Akses Akun</label>
                                        <div class="col-sm-10">
                                            <select name="group" class="form-control" data-toggle="select">
                                                <?php
                                                foreach ($groups as $key => $row) {
                                                ?>
                                                    <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
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