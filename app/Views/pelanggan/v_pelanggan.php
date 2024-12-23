<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModal" data-toggle="modal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
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
                                                        <button type="button" class="btn btn-info btn-sm btn-edit"
                                                            data-id_pelanggan="<?= $val['id_pelanggan']; ?>"
                                                            data-namapelanggan="<?= $val['nama_pelanggan'] ?>"
                                                            data-alamat="<?= $val['alamat'] ?>"
                                                            data-no_telfon="<?= $val['no_telfon'] ?>"
                                                            data-tanggal="<?= $val['tanggal'] ?>">
                                                            
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModalpelanggan"
                                                            data-toggle="modal"
                                                            data-id="<?= $val['id_pelanggan']; ?>">
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
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).ready(function() {
        $('#datapelanggan').DataTable();
    });


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

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('#deleteId').val(id);
    });
</script>

<?= $this->endSection() ?>