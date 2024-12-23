<!-- Modal Pelanggan -->
<div class="modal fade" id="modalPelanggan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Pilih Pelanggan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tablePelanggan" style="width:100%">
                        <thead class="bg-light">
                            <tr>
                                <th width="30%">Nama</th>
                                <th width="35%">Alamat</th>
                                <th width="20%">No. Telpon</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #modalPelanggan .modal-lg {
        max-width: 900px;
    }

    #tablePelanggan_wrapper .row:first-child {
        margin-bottom: 10px;
    }

    #tablePelanggan_filter {
        text-align: right;
    }

    #tablePelanggan_filter label,
    #tablePelanggan_length label {
        display: inline-flex;
        align-items: center;
        margin-bottom: 0;
    }

    #tablePelanggan_filter input {
        margin-left: 5px;
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    #tablePelanggan_length select {
        margin: 0 5px;
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    #tablePelanggan th,
    #tablePelanggan td {
        padding: 10px;
        vertical-align: middle;
    }

    .pilih-pelanggan {
        width: 80px;
    }
</style>