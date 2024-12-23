<?= $this->extend('layout/main') ?>
<?= $this->section('isi') ?>
<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Layanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModallayanan" data-toggle="modal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datalayanan">
                                        <thead>
                                            <tr role="row">
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
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['id_layanan'] ?></td>
                                                    <td><?= $val['nama_layanan'] ?></td>
                                                    <td><?= $val['deskripsi'] ?></td>
                                                    <td><?= $val['harga'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm btn-edit" 
                                                            data-id="<?= $val['id_layanan']; ?>"
                                                            data-namalayanan="<?= $val['nama_layanan'] ?>" 
                                                            data-deskripsi="<?= $val['deskripsi'] ?>"
                                                            data-harga="<?= $val['harga'] ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete" 
                                                            data-target="#deleteModallayanan"
                                                            data-toggle="modal" 
                                                            data-id="<?= $val['id_layanan']; ?>">
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

<!-- Modal Scripts -->
<script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datalayanan').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModallayanan').modal('show');
    });

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
<?= $this->endSection() ?>
