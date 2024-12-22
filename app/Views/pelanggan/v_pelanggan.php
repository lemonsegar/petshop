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
                        <h4 class="mt-0 header-title">Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapelanggan">
                                        <thead>
    <tr role="row">
        <th>No</th>
        <th>ID</th>
        <th>Nama Pelanggan</th>
        <th>Alamat</th>
        <th>No Telfon</th>
        <th>Tanggal</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php $no = 0;
    foreach ($pelanggan as $val) {
        $no++; ?>
        <tr role="row" class="odd">
            <td><?= $no; ?></td>
            <td><?= $val['id_pelanggan'] ?></td>
            <td><?= $val['nama_pelanggan'] ?></td>
            <td><?= $val['alamat'] ?></td>
            <td><?= $val['no_telfon'] ?></td>
            <td><?= $val['tanggal'] ?></td>
            <td>
            <button type="button" class="btn btn-info btn-sm btn-edit" data-id_pelanggan="<?= $val['id_pelanggan']; ?>" 
                                                    data-namapelanggan="<?= $val['nama_pelanggan'] ?>" data-alamat="<?= $val['alamat'] ?>" 
                                                    data-no_telfon="<?= $val['no_telfon'] ?>" data-tanggal="<?= $val['tanggal'] ?>"> 
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModalpelanggan" 
                                                    data-toggle="modal" data-id="<?= $val['id_pelanggan']; ?>">
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





<script src="<?= base_url()?>/assets/modules/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datapelanggan').DataTable();
    });

    // $('.btn-delete').on('click', function() {
    //     const id = $(this).data('id');
    //     $('.id').val(id);
    //     $('#deleteModal').model('show');
    // });

    $(document).on('click', '.btn-delete', function () {
        var id = $(this).data('id'); // Ambil id dari data-id di tombol
    $('#deleteId').val(id); // Isi input hidden di modal dengan id yang sesuai

});

    //script untuk edit data
$('.btn-edit').on('click', function() {
    const id = $(this).data('id_pelanggan');
    const namapelanggan = $(this).data('namapelanggan');
    const alamat = $(this).data('alamat');
    const no_telfon = $(this).data('no_telfon');
    const tanggal = $(this).data('tanggal');

    $('#id_pelanggan').val(id);
    $('#namapelanggan').val(namapelanggan);
    $('#alamat').val(alamat);
    $('#no_telfon').val(no_telfon);
    $('#tanggal').val(tanggal).trigger('change');
    $('#editModal').modal('show');
});
</script>
<?= $this->endSection('') ?>