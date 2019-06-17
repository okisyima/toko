<?php
// notifikasi
if ($this->session->flashdata('sukses')) {
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
?>

<?php
// ERROR UPLOAD
if (isset($error)) {
    echo '<p class="alert alert-warning">';
    echo $error;
    echo '</p>';
}

// notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// form open
echo form_open_multipart(base_url('admin/konfigurasi/icon/'));
?>

<div class="form-group">
    <label>Nama Website</label>
    <input type="text" name="nama_web" class="form-control" placeholder="nama web" value="<?= $konfigurasi->nama_web; ?>" required>
</div>

<div class="form-group">
    <label>Upload Icon Baru</label>
    <input type="file" name="icon" class="form-control" placeholder="icon baru" value="<?= $konfigurasi->icon; ?>" required>
    Icon lama : <br>
    <img src="<?= base_url('assets/upload/image/' . $konfigurasi->icon) ?>" class="img img-responsive img-thumbnail" width="200">
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