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
echo form_open_multipart(base_url('admin/konfigurasi/'));
?>

<div class="form-group">
    <label>Nama Website</label>
    <input type="text" name="nama_web" class="form-control" placeholder="nama web" value="<?= $konfigurasi->nama_web; ?>" required>
</div>

<div class="form-group">
    <label>TAgline/Moto</label>
    <input type="text" name="tagline" class="form-control" placeholder="tagline/moto" value="<?= $konfigurasi->tagline; ?>" required>
</div>

<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" placeholder="email" value="<?= $konfigurasi->email; ?>" required>
</div>

<div class="form-group">
    <label>Website</label>
    <input type="text" name="website" class="form-control" placeholder="website" value="<?= $konfigurasi->website; ?>" required>
</div>

<div class="form-group">
    <label>Alamat Facebook</label>
    <input type="text" name="facebook" class="form-control" placeholder="facebook" value="<?= $konfigurasi->facebook; ?>" required>
</div>

<div class="form-group">
    <label>Alamat Instagram</label>
    <input type="text" name="instagram" class="form-control" placeholder="instagram" value="<?= $konfigurasi->instagram; ?>" required>
</div>

<div class="form-group">
    <label>Telepon</label>
    <input type="text" name="telepon" class="form-control" placeholder="telepon" value="<?= $konfigurasi->telepon; ?>" required>
</div>

<div class="form-group">
    <label>Alamat Kantor</label>
    <textarea name="alamat" class="form-control" placeholder="alamat kantor"><?= $konfigurasi->alamat; ?></textarea>
</div>

<div class="form-group">
    <label>Keywords</label>
    <textarea name="keywords" class="form-control" placeholder="keywords (untuk SEO Google)"><?= $konfigurasi->keywords; ?></textarea>
</div>

<div class="form-group">
    <label>Kode MetaText</label>
    <textarea name="metatext" class="form-control" placeholder="metatext"><?= $konfigurasi->metatext; ?></textarea>
</div>

<div class="form-group">
    <label>Deskripsi Website</label>
    <textarea name="deskripsi" class="form-control" placeholder="deskripsi"><?= $konfigurasi->deskripsi; ?></textarea>
</div>

<div class="form-group">
    <label>Rekening Pembayaran</label>
    <textarea name="rekening_pembayaran" class="form-control" placeholder="rekening Pembayaran"><?= $konfigurasi->rekening_pembayaran; ?></textarea>
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