<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<head>
    <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>

<div class="container">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mt-0 header-title">Data Layanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4 text-right">
                            <button type="button" class="btn btn-sm btn-success" data-target="#addModallayanan" data-toggle="modal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="datalayanan">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nama Layanan</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($layanan as $val) {
                                        $no++; ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $val['id_layanan'] ?></td>
                                            <td><?= $val['nama_layanan'] ?></td>
                                            <td><?= $val['deskripsi'] ?></td>
                                            <td><?= $val['harga'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm btn-edit" data-id="<?= $val['id_layanan']; ?>" 
                                                    data-namalayanan="<?= $val['nama_layanan'] ?>" data-deskripsi="<?= $val['deskripsi'] ?>" 
                                                    data-harga="<?= $val['harga'] ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModallayanan" 
                                                    data-toggle="modal" data-id="<?= $val['id_layanan']; ?>">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end page-content-wrapper -->
</div> <!-- end container -->

<!-- Modal Scripts -->
<script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datalayanan').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan MENU data",
                "info": "Menampilkan START hingga END dari TOTAL data"
            }
        });
    });


    $(document).ready(function() {
        $('#datalayanan').DataTable();
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModallayanan').model('show');
    });

    //script untuk edit data
$('.btn-edit').on('click', function() {
    const id = $(this).data('id');
    const namalayanan = $(this).data('namalayanan');
    const deskripsi = $(this).data('deskripsi');
    const harga = $(this).data('harga');

    $('.id').val(id);
    $('.namalayanan').val(namalayanan);
    $('.deskripsi').val(deskripsi);
    $('.harga').val(harga).trigger('change');
    $('#editModallayanan').modal('show');
});
</script>
<?= $this->endSection('') ?>
