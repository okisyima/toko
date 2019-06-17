<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// form open
echo form_open(base_url('admin/rekening/tambah'));
?>

<!-- <form action="<?= base_url('admin/rekening/tambah') ?>" method="post"> -->

<div class="form-group">
    <label>Nama Bank</label>
    <input type="text" name="nama_bank" class="form-control" placeholder="nama bank" value="<?= set_value('nama_bank') ?>" required>
</div>

<div class="form-group">
    <label>Nomor Rekening</label>
    <input type="number" name="nomor_rekening" class="form-control" placeholder="nomor" value="<?= set_value('nomor_rekening') ?>" required>
</div>

<div class="form-group">
    <label>Nama Pemilik Rekening</label>
    <input type="text" name="nama_pemilik" class="form-control" placeholder="nama pemilik" value="<?= set_value('nama_pemilik') ?>" required>
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