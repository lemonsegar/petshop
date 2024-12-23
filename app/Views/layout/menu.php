<ul class="sidebar-menu">
    <li class="menu-header">Menu Utama</li>
    <li class="<?= current_url(true)->getSegment(1) == '' ? 'active' : '' ?>">
        <a href="<?= site_url('layout/index') ?>" class="nav-link">
            <i class="fas fa-fire"></i>
            <span>Beranda</span>
        </a>
    </li>

    <?php if (session()->get('level') == 1) { ?>
        <li class="menu-header">Master Data</li>
        <li class="nav-item dropdown <?= current_url(true)->getSegment(1) == 'master' ? 'active' : '' ?>">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-database"></i>
                <span>Master</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('Pelanggan') ?>">Pelanggan</a></li>
                <li><a class="nav-link" href="<?= site_url('produk') ?>">Produk</a></li>
                <li><a class="nav-link" href="<?= site_url('layanan') ?>">Layanan</a></li>
                <li><a class="nav-link" href="<?= site_url('user') ?>">User</a></li>
            </ul>
        </li>

        <li class="menu-header">Transaksi</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-shopping-cart"></i>
                <span>Transaksi</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('barangmasuk') ?>">Barang Masuk</a></li>
                <li><a class="nav-link" href="<?= site_url('barangkeluar') ?>">Barang Keluar</a></li>
                <li><a class="nav-link" href="<?= site_url('pelayanan') ?>">Pelayanan</a></li>
            </ul>
        </li>

        <li class="menu-header">Laporan</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('barangmasuk/laporan') ?>">Laporan Barang Masuk</a></li>
                <li><a class="nav-link" href="<?= site_url('barangkeluar/laporan') ?>">Laporan Barang Keluar</a></li>
                <li><a class="nav-link" href="<?= site_url('pelayanan/laporan') ?>">Laporan Pelayanan</a></li>
                <li><a class="nav-link" href="<?= site_url('produk/laporan') ?>">Laporan Produk</a></li>
                <li><a class="nav-link" href="<?= site_url('pelanggan/laporan') ?>">Laporan Pelanggan</a></li>
                

            </ul>
        </li>
    <?php } ?>

    <?php if (session()->get('level') == 2) { ?>
        <!-- Menu untuk level 2 -->
        <li class="menu-header">Transaksi</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-shopping-cart"></i>
                <span>Transaksi</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('barangmasuk') ?>">Barang Masuk</a></li>
                <li><a class="nav-link" href="<?= site_url('barangkeluar') ?>">Barang Keluar</a></li>
                <li><a class="nav-link" href="<?= site_url('transaksi') ?>">Data Transaksi</a></li>
            </ul>
        </li>
    <?php } ?>

    <?php if (session()->get('level') == 3) { ?>
        <!-- Menu untuk level 3 -->
        <li class="menu-header">Laporan</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan Barang Masuk</a></li>
                <li><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan Barang Keluar</a></li>
                <li><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan Penjualan</a></li>
                <li><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan Produk</a></li>
                <li><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan Penjualan/Bulan</a></li>
                <li><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan Penjualan/Tahun</a></li>
            </ul>
        </li>
    <?php } ?>
</ul>