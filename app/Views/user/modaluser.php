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