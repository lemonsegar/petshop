<!-- Form Tambah -->
<form action="/pelanggan/save" method="post">
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4>Periksa Entrian Form</h4>
            <hr>
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>ID Pelanggan</label>
                        <input type="text" class="form-control" name="id" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" name="namapelanggan" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>No Telepon</label>
                        <input type="tel" class="form-control" name="no_telfon" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Form Delete -->
<form action="/pelanggan/delete" method="post">
    <div class="modal fade" id="deleteModalpelanggan" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">Apakah anda yakin akan menghapus data ini?</h6>
                    <input type="hidden" name="deleteId" id="deleteId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Form Edit -->
<form action="/pelanggan/update" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>ID Pelanggan</label>
                        <input type="text" class="form-control" name="id" id="id_pelanggan" readonly />
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" name="namapelanggan" id="namapelanggan" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>No Telepon</label>
                        <input type="tel" class="form-control" name="no_telfon" id="no_telfon" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </div>
        </div>
    </div>
</form>