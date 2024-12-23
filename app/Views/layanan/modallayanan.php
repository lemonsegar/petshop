  <!-- Form Tambah -->
  <form action="/layanan/save" method="post">
      <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <h4>Periksa Entrian Form</h4>
              <hr>
              <?php echo session()->getFlashdata('error'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <?php endif; ?>

      <div class="modal fade" id="addModallayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Data Layanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label>ID Layanan</label>
                          <input type="text" class="form-control" name="id" required>
                      </div>
                      <div class="form-group">
                          <label>Nama Layanan</label>
                          <input type="text" class="form-control" name="namalayanan" required>
                      </div>
                      <div class="form-group">
                          <label>Deskripsi</label>
                          <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                      </div>
                      <div class="form-group">
                          <label>Harga</label>
                          <input type="number" class="form-control" name="harga" required>
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

  <!-- Form Hapus -->
  <form action="/layanan/delete" method="post">
      <div class="modal fade" id="deleteModallayanan" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>Apakah Anda yakin ingin menghapus data ini?</p>
                      <input type="hidden" name="id" class="id">
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
  <form action="/layanan/update" method="post">
      <div class="modal fade" id="editModallayanan" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Data Layanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label>ID Layanan</label>
                          <input type="text" class="form-control id" name="id" readonly>
                      </div>
                      <div class="form-group">
                          <label>Nama Layanan</label>
                          <input type="text" class="form-control namalayanan" name="namalayanan" required>
                      </div>
                      <div class="form-group">
                          <label>Deskripsi</label>
                          <textarea class="form-control deskripsi" name="deskripsi" rows="3" required></textarea>
                      </div>
                      <div class="form-group">
                          <label>Harga</label>
                          <input type="number" class="form-control harga" name="harga" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                  </div>
              </div>
          </div>
      </div>
  </form>