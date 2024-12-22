<!-- Pelanggan -->

  <!-- Form Tambah -->
  <form action="/pelanggan/save" method="post">
<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4>Periksa Entrian Form</h4>
        <hr>
        <?php echo session()->getFlashdata('error'); ?>
        <button type="button" id="addModal" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" />
                </div>
                    <div class="col-md-12">
                    <label>Nama Pelanggan</label>
                    <input type="text" class="form-control" name="namapelanggan" />
                </div>
                    <div class="col-md-12">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" />
                </div>
                    <div class="col-md-12">
                    <label>No Telfon</label>
                    <input type="text" class="form-control" name="no_telfon" />
                </div>
                    <div class="col-md-12">
                    <label>Tanggal</label>
                    <input type="text" class="form-control" name="tanggal" />
                </div>
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Pelanggan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/pelanggan/delete" method="post">
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModallabel"> Pelanggan</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close></button>
      </div>
      <div class="modal-body">
        <h1>Yakin Di Hapus?</h1>
        <input type="text" name="deleteId" id="deleteId" class="id">
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">HAPUS</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- edit modal -->
<form action="/pelanggan/update" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" id="id_pelanggan" readonly />
                </div>
                    <div class="col-md-12">
                    <label>Nama Pelanggan</label>
                    <input type="text" class="form-control" name="namapelanggan" id="namapelanggan" />
                </div>
                    <div class="col-md-12">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" />
                </div>
                    <div class="col-md-12">
                    <label>No Telfon</label>
                    <input type="text" class="form-control" name="no_telfon" id="no_telfon" />
                </div>
                    <div class="col-md-12">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" />
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Pelanggan -->


<!-- Layanan -->
<!-- Form Tambah -->
  <form action="/layanan/save" method="post">
<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4>Periksa Entrian Form</h4>
        <hr>
        <?php echo session()->getFlashdata('error'); ?>
        <button type="button" id="addModallayanan" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


    <div class="modal fade" id="addModallayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Layanan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" />
                </div>
                    <div class="col-md-12">
                    <label>Nama Layanan</label>
                    <input type="text" class="form-control" name="namalayanan" />
                </div>
                    <div class="col-md-12">
                    <label>Deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" />
                </div>
                    <div class="col-md-12">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" />
                </div>
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Layanan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/layanan/delete" method="post">
<div class="modal fade" id="deleteModallayanan" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModallabel"> layanan</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close></button>
      </div>
      <div class="modal-body">
        <h1>Yakin Di Hapus?</h1>
        <input type="text" name="id" id="id" class="id">
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">HAPUS</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- edit modal -->
<form action="/layanan/update" method="post">
    <div class="modal fade" id="editModallayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control id" name="id" readonly>
                    </div>
                    <div class="col-md-12">
                        <label>Nama Layanan</label>
                        <input type="text" class="form-control namalayanan" name="namalayanan">
                    </div>
                    <div class="col-md-12">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control deskripsi" name="deskripsi">
                    </div>
                    <div class="col-md-12">
                        <label>Harga</label>
                        <input type="text" class="form-control harga" name="harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Layanan -->


<!-- Produk -->

 <!-- Form Tambah -->
<form action="/produk/save" method="post">
<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4>Periksa Entrian Form</h4>
        <hr>
        <?php echo session()->getFlashdata('error'); ?>
        <button type="button" id="addModalproduk" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


    <div class="modal fade" id="addModalproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" />
                </div>
                    <div class="col-md-12">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="namaproduk" />
                </div>
                    <div class="col-md-12">
                    <label>Kategori</label>
                    <input type="text" class="form-control" name="kat" />
                </div>
                    <div class="col-md-12">
                    <label>Stok</label>
                    <input type="text" class="form-control" name="stok" />
                </div>
                <div class="col-md-12">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" />
                </div>
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Produk</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/produk/delete" method="post">
<div class="modal fade" id="deleteModalproduk" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModallabel"> Produk</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close"></button>
      </div>
      <div class="modal-body">
        <h1>Yakin Di Hapus?</h1>
        </div>
    <div class="modal-footer">
        <input type="text" name="id" class="id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">HAPUS</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- edit modal -->
<form action="/produk/update" method="post">
    <div class="modal fade" id="editModalproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control id" name="id">
                    </div>
                    <div class="col-md-12">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control namaproduk" name="namaproduk">
                    </div>
                    <div class="col-md-12">
                        <label>Kategori</label>
                        <input type="text" class="form-control kat" name="kat">
                    </div>
                    <div class="col-md-12">
                        <label>Stok</label>
                        <input type="text" class="form-control stok" name="stok">
                    </div>
                    <div class="col-md-12">
                        <label>Harga</label>
                        <input type="text" class="form-control harga" name="harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- produk -->


<!-- User -->

  <!-- Form Tambah -->
  <form action="/user/save" method="post">
<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4>Periksa Entrian Form</h4>
        <hr>
        <?php echo session()->getFlashdata('error'); ?>
        <button type="button" id="addModaluser" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


    <div class="modal fade" id="addModaluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">user</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" />
                </div>
                    <div class="col-md-12">
                    <label>Nama User</label>
                    <input type="text" class="form-control" name="username" />
                </div>
                    <div class="col-md-12">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" />
                </div>
                    <div class="col-md-12">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" />
                </div>
                <div class="col-md-12">
                    <label>Level</label>
                    <input type="text" class="form-control" name="level" />
                </div>
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data User</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/user/delete" method="post">
<div class="modal fade" id="deleteModaluser" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModallabel"> Data Mobil</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close"></button>
      </div>
      <div class="modal-body">
        <h1>Yakin Di Hapus?</h1>
        </div>
    <div class="modal-footer">
        <input type="text" name="id" class="id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">HAPUS</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- edit modal -->
<form action="/user/update" method="post">
    <div class="modal fade" id="editModaluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control id" id="id" name="id" readonly />
                    </div>
                    <div class="col-md-12">
                        <label>Nama User</label>
                        <input type="text" class="form-control username" id="username" name="username" />
                    </div>
                    <div class="col-md-12">
                        <label>Password</label>
                        <input type="text" class="form-control password" id="password" name="password" />
                    </div>
                    <div class="col-md-12">
                        <label>Email</label>
                        <input type="text" class="form-control email" id="email" name="email" />
                    </div>
                    <div class="col-md-12">
                        <label>Level</label>
                        <input type="text" class="form-control level" id="level" name="level" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- User -->









