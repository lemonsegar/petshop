<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<head>


        <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
         <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>

<div class="col-sm-12">
    <div class="page-content-wrapper ">
        <!-- end page title and breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalproduk" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="dataproduk">
                                        <thead>
    <tr role="row">
        <th>No</th>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php $no = 0;
    foreach ($produk as $val) {
        $no++; ?>
        <tr role="row" class="odd">
            <td><?= $no; ?></td>
            <td><?= $val['id_produk'] ?></td>
            <td><?= $val['nama_produk'] ?></td>
            <td><?= $val['kategori'] ?></td>
            <td><?= $val['stok'] ?></td>
            <td><?= $val['harga'] ?></td>
            <td>
         <button type="button" class="btn btn-info btn-sm btn-edit" data-id="<?= $val['id_produk']; ?>" 
                                                    data-namaproduk="<?= $val['nama_produk'] ?>" data-kat="<?= $val['kategori'] ?>" 
                                                    data-stok="<?= $val['stok'] ?>" data-harga="<?= $val['harga'] ?>"> 
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModalproduk" 
                                                    data-toggle="modal" data-id="<?= $val['id_produk']; ?>">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>

            </td>
        </tr>
    <?php } ?>
</tbody>

   </table>
</div>
</div>
</div>
</div>
</div>
</div> <!-- end col -->
</div> <!-- end row -->
</div>
</div>



!-- Modal Scripts -->
<script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataproduk').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan MENU data",
                "info": "Menampilkan START hingga END dari TOTAL data"
            }
        });
    });

    $(document).ready(function() {
        $('#dataproduk').DataTable();
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModalproduk').model('show');
    });

    //script untuk edit data
$('.btn-edit').on('click', function() {
    const id = $(this).data('id');
    const namaproduk = $(this).data('namaproduk');
    const kat = $(this).data('kat');
    const stok = $(this).data('stok');
    const harga = $(this).data('harga');

    $('.id').val(id);
    $('.namaproduk').val(namaproduk);
    $('.kat').val(kat);
    $('.stok').val(stok);
    $('.harga').val(harga).trigger('change');
    $('#editModalproduk').modal('show');
});
</script>
<?= $this->endSection('') ?>