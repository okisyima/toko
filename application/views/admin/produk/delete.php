<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-<?= $produk->id_produk; ?>">
    <i class="fa fa-trash-o"></i> Hapus
</button>

<div class="modal fade" id="delete-<?= $produk->id_produk; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">HA[US DATA PRODUK</h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-warning">
                    <h4>Peringatan!</h4>
                    Yakin ingin menghapus data ini? Data yang sudah di hapus tidak dapat dikembalikan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                <a href="<?= base_url('admin/produk/hapus/' . $produk->id_produk) ?>" class="btn btn-danger"><i class="fa fa-trans-o"></i>Ya, Hapus Data Ini</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->