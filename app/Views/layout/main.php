<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit-no" name="viewport">
  <title>PetShop</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/summernote/summernote-bs4.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <?= $this->renderSection('css') ?>
</head>

<body>

  <?php if (strtolower(current_url()) == strtolower(base_url('pelanggan'))): ?>
    <?php include(APPPATH . 'Views/pelanggan/modalpelanggan.php'); ?>
  <?php endif; ?>

  <?php if (strtolower(current_url()) == strtolower(base_url('produk'))): ?>
    <?php include(APPPATH . 'Views/produk/modalproduk.php'); ?>
  <?php endif; ?>

  <?php if (strtolower(current_url()) == strtolower(base_url('layanan'))): ?>
    <?php include(APPPATH . 'Views/layanan/modallayanan.php'); ?>
  <?php endif; ?>

  <?php if (strtolower(current_url()) == strtolower(base_url('user'))): ?>
    <?php include(APPPATH . 'Views/user/modaluser.php'); ?>
  <?php endif; ?>

  <?php
  $currentUrl = current_url();
  if (
    strtolower($currentUrl) == strtolower(base_url('barangkeluar')) ||
    $currentUrl == base_url('barangkeluar/create') ||
    $currentUrl == base_url('barangkeluar/edit') ||
    strpos($currentUrl, base_url('barangkeluar/formedit')) !== false ||
    strpos($currentUrl, '/barangkeluar/edit/') !== false
  ): ?>
    <?php include(APPPATH . 'Views/barangkeluar/modal.php'); ?>
  <?php endif; ?>

  <?php
  $currentUrl = current_url();
  if (
    strtolower($currentUrl) == strtolower(base_url('pelayanan')) ||
    $currentUrl == base_url('pelayanan/create') ||
    $currentUrl == base_url('pelayanan/edit') ||
    strpos($currentUrl, base_url('pelayanan/formedit')) !== false ||
    strpos($currentUrl, '/pelayanan/edit/') !== false
  ): ?>
    <?php include(APPPATH . 'Views/pelayanan/modal.php'); ?>
  <?php endif; ?>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <!-- Navbar -->
      <?php include 'navbar.php'; ?>

      <!-- Sidebar -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url() ?>">PetShop</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ?>">PS</a>
          </div>

          <!-- Menu -->
          <?php include 'menu.php'; ?>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?= $this->renderSection('isi') ?>
        </section>
      </div>

      <!-- Footer -->
      <?php include 'footer.php'; ?>

    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/popper.js"></script>
  <script src="<?= base_url() ?>/assets/modules/tooltip.js"></script>
  <script src="<?= base_url() ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/moment.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/assets/js/custom.js"></script>


  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <?= $this->renderSection('js') ?>
</body>

</html>