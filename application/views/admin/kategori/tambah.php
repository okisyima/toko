<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// form open
echo form_open(base_url('admin/kategori/tambah'));
?>

<!-- <form action="<?= base_url('admin/kategori/tambah') ?>" method="post"> -->

<div class="form-group">
    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" class="form-control" placeholder="nama kategori" value="<?= set_value('nama_kategori') ?>" required>
</div>

<div class="form-group">
    <label>Urusan</label>
    <input type="number" name="urutan" class="form-control" placeholder="urutan" value="<?= set_value('urutan') ?>" required>
</div>

<div class="form-group">
    <button class="btn btn-success btn-lg" name="submit" type="submit">
        <i class="fa fa-save"></i>Simpan
    </button>

    <button class="btn btn-info btn-lg" name="reset" type="reset">
        <i class="fa fa-times"></i>Reset
    </button>
</div>
<!-- </form> -->

<?= form_close(); ?>