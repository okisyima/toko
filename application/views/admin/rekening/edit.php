<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// form open
echo form_open(base_url('admin/rekening/edit/' . $rekening->id_rekening));
?>

<div class="form-group">
    <label>Nama Banki</label>
    <input type="text" name="nama_bank" class="form-control" placeholder="nama_rekening" value="<?= $rekening->nama_bank ?>" required>
</div>

<div class="form-group">
    <label>Nomor Rekening</label>
    <input type="number" name="nomor_rekening" class="form-control" placeholder="urutan" value="<?= $rekening->nomor_rekening ?>" required>
</div>

<div class="form-group">
    <label>Nama Pemilik</label>
    <input type="text" name="nama_pemilik" class="form-control" placeholder="namapemilik" value="<?= $rekening->nama_pemilik ?>" required>
</div>

<div class="form-group">
    <button class="btn btn-success btn-lg" name="submit" type="submit">
        <i class="fa fa-save"></i>Simpan
    </button>

    <button class="btn btn-info btn-lg" name="reset" type="reset">
        <i class="fa fa-times"></i>Reset
    </button>
</div>

<?= form_close(); ?>