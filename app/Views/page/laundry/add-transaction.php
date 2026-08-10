<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah <?= $title; ?></h3>
            </div>
            <div class="box-body">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('laundry/transaction'); ?>" method="post" id="transactionForm">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" name="" class="form-control pull-right" id="reservationtime" value="<?= $time; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <select class="form-control select2" name="customerId" style="width: 100%;">
                                <option selected="selected" value="">- Pilih Pelanggan -</option>
                                <?php
                                foreach ($customers as $customer) { ?>
                                    <option value="<?= $customer['id']; ?>"><?= $customer['name']; ?> - <?= $customer['phone']; ?> </option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detail Layanan</h3>
                            </div>
                            <div class="card-body">
                                <div id="serviceContainer">
                                    <div class="card card-secondary service-item">
                                        <div class="card-header">
                                            <h4 class="card-title service-title">Layanan</h4>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-danger btn-sm float-right d-none remove-row">
                                                    Hapus Data <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Layanan</label>
                                                <select class="form-control select2" name="serviceIds[]">
                                                    <option value="">
                                                        -Pilih Layanan-
                                                    </option>
                                                    <?php foreach ($services as $service): ?>
                                                        <option value="<?= $service['id']; ?>">
                                                            <?= $service['name']; ?> - Rp <?= number_format($service['price']); ?>/<?= $service['day']; ?> Hari
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Berat</label>
                                                <input type="number" name="weight[]" class="form-control" placeholder="Kg">
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Pakaian</label>
                                                <input type="number" name="qty[]" class="form-control" placeholder="Unit">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea name="description[]" class="form-control" placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group pull-lift">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-success btn-sm" id="addOtherServices">
                                        Tambah Layanan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="payment_action" id="paymentAction" value="later">
                        <input type="hidden" name="userId" class="form-control" value="<?= user()->id; ?>">
                    </div>
                    <div class="box-footer">
                        <a href="<?= base_url('laundry'); ?>" class="btn btn">Kembali</a>
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#paymentConfirmationModal">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->include('page/laundry/partials/payment-confirmation'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
        const addButton = document.getElementById('addOtherServices');
        const container = document.getElementById('serviceContainer');

        // CEK HALAMAN
        if (addButton && container) {
            addButton.addEventListener('click', function() {
                let firstForm = container.querySelector('.service-item');
                let cloned = firstForm.cloneNode(true);
                $(cloned).find('.select2-container').remove();

                // RESET INPUT
                cloned.querySelectorAll('input')
                    .forEach(function(input) {
                        input.value = "";
                    });

                cloned.querySelectorAll('textarea')
                    .forEach(function(textarea) {
                        textarea.value = "";
                    });
                cloned.querySelectorAll('select')
                    .forEach(function(select) {
                        select.selectedIndex = 0;
                    });

                // UPDATE NOMOR LAYANAN
                let total = container.querySelectorAll('.service-item').length + 1;

                function updateServiceTitle() {
                    let services = document.querySelectorAll('.service-item');
                    let total = services.length;
                    services.forEach(function(service, index) {
                        let title = service.querySelector('.service-title');
                        if (total > 1) {
                            title.innerHTML = "Layanan #" + (index + 1);
                        } else {
                            title.innerHTML = "Layanan";
                        }
                    });
                }

                // TAMBAHKAN FORM BARU
                container.appendChild(cloned);

                $('.select2').select2({
                    width: '100%'
                });

                updateServiceTitle();
                updateRemoveButton();
            });
        }

        // EVENT HAPUS
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                let button = e.target.closest('.remove-row');
                let form = button.closest('.service-item');
                let total = container.querySelectorAll('.service-item').length;

                if (total > 1) {
                    form.remove();
                    updateRemoveButton();
                }
            }
        });
    });

    function updateRemoveButton() {
        let forms = document.querySelectorAll('.service-item');
        let buttons = document.querySelectorAll('.remove-row');

        buttons.forEach(function(btn) {
            if (forms.length === 1) {
                btn.classList.add('d-none');
            } else {
                btn.classList.remove('d-none');
            }
        });

        if (forms.length == 1) {
            buttons[0].style.display = "none";
        }
    }

    // payment action
    $('#payLater').on('click', function() {
        $('#paymentAction').val('later');
        $('#transactionForm').submit();
    });

    $('#payNow').on('click', function() {
        $('#paymentAction').val('now');
        $('#transactionForm').submit();
    });
</script>

<?= $this->endSection(); ?>