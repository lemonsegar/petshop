<?= $this->extend('layout/main') ?>

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
                        <h4 class="mt-0 header-title">Data User</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModaluser" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datauser">
                                        <thead>
    <tr role="row">
        <th>No</th>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>email</th>
        <th>level</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php $no = 0;
    foreach ($user as $val) {
        $no++; ?>
        <tr role="row" class="odd">
            <td><?= $no; ?></td>
            <td><?= $val['id_user'] ?></td>
            <td><?= $val['username'] ?></td>
            <td><?= $val['password'] ?></td>
            <td><?= $val['email'] ?></td>
            <td><?= $val['level'] ?></td>
            <td>
            <button type="button" class="btn btn-info btn-sm btn-edit" data-id="<?= $val['id_user']; ?>" 
                                                    data-username="<?= $val['username'] ?>" data-password="<?= $val['password'] ?>" 
                                                    data-email="<?= $val['email'] ?>" data-level="<?= $val['level'] ?>"> 
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModaluser" 
                                                    data-toggle="modal" data-id="<?= $val['id_user']; ?>">
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




<script>
    $(document).ready(function() {
        $('#datauser').DataTable();
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModaluser').model('show');
    });

    //script untuk edit data
$('.btn-edit').on('click', function() {
    const id = $(this).data('id');
    const username = $(this).data('username');
    const password = $(this).data('password');
    const email = $(this).data('email');
    const level = $(this).data('level');

    $('.id').val(id);
    $('.username').val(username);
    $('.password').val(password);
    $('.email').val(email);
    $('.level').val(level).trigger('change');
    $('#editModaluser').modal('show');
});
</script>
<?= $this->endSection('') ?>