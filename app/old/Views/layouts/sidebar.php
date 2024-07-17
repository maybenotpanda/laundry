<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="<?= site_url('dashboard'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a>
            </li>
            <?php if (in_groups('admin')) : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gears"></i> <span>Master</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?= site_url('employee'); ?>"><i class="fa fa-users"></i> Karyawan</a>
                        </li>
                        <li><a href="<?= site_url('service'); ?>"><i class="fa fa-tags"></i> Layanan</a></li>
                        <li><a href="<?= site_url('activity'); ?>"><i class="fa fa-tasks"></i> Aktivitas</a></li>
                        <li><a href="<?= site_url('transaksi-pembelian'); ?>"><i class="fa fa-cubes"></i> Aprov Barang</a></li>
                        <li class="treeview">
                            <a href=""><i class="fa fa-line-chart"></i> Laporan
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('income'); ?>"><i class="fa fa-arrow-up"></i> Pemasukkan</a></li>
                                <li><a href="<?= base_url('outcome'); ?>"><i class="fa fa-arrow-down"></i> Pengeluaran</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <li><a href="<?= base_url('customer'); ?>"><i class="fa fa-user-plus"></i> <span>Pelanggan</span></a></li>
            <li><a href="<?= base_url('laundry'); ?>"><i class="fa fa-credit-card"></i> <span>Laundry</span></a></li>
            <li><a href="<?= base_url('barang'); ?>"><i class="fa fa-cube"></i> <span>Barang</span></a></li>
        </ul>
    </section>
</aside>