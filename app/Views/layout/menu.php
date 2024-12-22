<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>


    <li>
        <a href="<?= site_url('layout/index') ?>" class="waves-effect">
            <i class="mdi mdi-airplay"></i>
            <span>Beranda</span>
        </a>
    </li>

    <?php if (session()->get('level') == 1) { ?>
        <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Master</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="nav-link">
            <li><a href="<?= site_url('Pelanggan/index') ?>">Pelanggan</a></li>
            <li><a href="<?= site_url('produk/index') ?>">Produk</a></li>
            <li><a href="<?= site_url('layanan/index') ?>">Layanan</a></li>
            <li><a href="<?= site_url('user/index') ?>">User</a></li>
        </ul>
    </li>

    

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Transaksi</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="nav-link">
            <li><a href="<?= site_url('dokter/index') ?>">Barang Masuk</a></li>
            <li><a href="charts-chartist.html">Barang Keluar</a></li>
            <li><a href="charts-chartist.html">Data Transaksi</a></li>
        </ul>
    </li>

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Laporan</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="nav-link">
        <li><a href="<?= site_url('dokter/index') ?>">Laporan Data Barang Masuk</a></li>
            <li><a href="charts-chartist.html">Laporan Data Barang Keluar</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Penjualan</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Produk</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Penjualan PerBulan</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Penjualan PerTahun</a></li>
        </ul>
    </li>
    <?php } ?>


    <?php if (session()->get('level') == 2) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Transaksi</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('dokter/index') ?>">Barang Masuk</a></li>
            <li><a href="charts-chartist.html">Barang Keluar</a></li>
            <li><a href="charts-chartist.html">Data Transaksi</a></li>
        </ul>
    </li>
    <?php } ?>


    <?php if (session()->get('level') == 3) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Laporan</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('dokter/index') ?>">Laporan Data Barang Masuk</a></li>
            <li><a href="charts-chartist.html">Laporan Data Barang Keluar</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Penjualan</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Produk</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Penjualan PerBulan</a></li>
            <li><a href="charts-chartjs.html">Laporan Data Penjualan PerTahun</a></li>
        </ul>
    </li>

    <?php } ?>

<?= $this->endSection('') ?>