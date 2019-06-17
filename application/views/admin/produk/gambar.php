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
echo form_open_multipart(base_url('admin/produk/gambar/' . $produk->id_produk));
?>

<div class="form-group">
    <label>Judul Gambar Produk</label>
    <input type="text" name="judul_gambar" class="form-control" placeholder="judul gambar" value="<?= set_value('judul_gambar') ?>" required>
</div>

<div class="form-group">
    <label>Unggah Gambar</label>
    <input type="file" name="gambar" class="form-control" placeholder="gambar produk" value="<?= set_value('gambar') ?>" required>
</div>

<div class="form-group">
    <button class="btn btn-success btn-lg" name="submit" type="submit">
        <i class="fa fa-save"></i>Simpan dan Unggah Gambar
    </button>

    <button class="btn btn-info btn-lg" name="reset" type="reset">
        <i class="fa fa-times"></i>Reset
    </button>
</div>

<?= form_close(); ?>

<?php
// notifikasi
if ($this->session->flashdata('sukses')) {
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
?>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th>NO</th>
            <th>GAMBAR</th>
            <th>JUDUL</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>1</td>
            <td>
                <img src="<?= base_url('assets/upload/image/thumbs/' . $produk->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
            </td>
            <td><?= $produk->nama_produk ?></td>
            <td>

            </td>
        </tr>

        <?php $no = 2;
        foreach ($gambar as $gambar) { ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <img src="<?= base_url('assets/upload/image/thumbs/' . $gambar->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
                </td>
                <td><?= $gambar->judul_gambar ?></td>
                <td>
                    <a href="<?= base_url('admin/produk/hapus_gambar/' . $produk->id_produk . '/' . $gambar->id_gambar); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menhapus gambar ini?')"> <i class="fa fa-trash-o"></i>Hapus</a>
                </td>
            </tr>
            <?php $no++;
        } ?>
    </tbody>
</table>