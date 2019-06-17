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
echo form_open_multipart(base_url('admin/produk/edit/' . $produk->id_produk));
?>

<div class="form-group">
    <label>Nama Produk</label>
    <input type="text" name="nama_produk" class="form-control" placeholder="nama produk" value="<?= $produk->nama_produk; ?>" required>
</div>

<div class="form-group">
    <label>Kode Produk</label>
    <input type="text" name="kode_produk" class="form-control" placeholder="kode produk" value="<?= $produk->kode_produk; ?>" required>
</div>

<div class="form-group">
    <label>Kategori Produk</label>
    <select name="id_kategori" class="form-control">
        <?php foreach ($kategori as $kategori) { ?>
            <option value="<?= $kategori->id_kategori; ?>" <?php if ($produk->id_kategori == $kategori->id_kategori) {
                                                                echo "selected";
                                                            } ?>>
                <?= $kategori->nama_kategori; ?>
            </option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Harga</label>
    <input type="number" name="harga" class="form-control" placeholder="harga" value="<?= $produk->harga; ?>" required>
</div>

<div class="form-group">
    <label>Stok</label>
    <input type="number" name="stok" class="form-control" placeholder="stok" value="<?= $produk->stok; ?>" required>
</div>

<div class="form-group">
    <label>Berat</label>
    <input type="text" name="berat" class="form-control" placeholder="berat" value="<?= $produk->berat; ?>" required>
</div>

<div class="form-group">
    <label>Ukuran</label>
    <input type="text" name="ukuran" class="form-control" placeholder="ukuran" value="<?= $produk->ukuran; ?>" required>
</div>

<div class="form-group">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control" placeholder="keterangan" id="editor"><?= $produk->keterangan; ?></textarea>
</div>

<div class="form-group">
    <label>Keywords</label>
    <textarea name="keywords" class="form-control" placeholder="keywords (untuk SEO Google)"><?= $produk->keywords; ?></textarea>
</div>

<div class="form-group">
    <label>Upload Gambar Produk</label>
    <input type="file" name="gambar" class="form-control">
</div>

<div class="form-group">
    <label>Status Produk</label>
    <select name="status_produk" class="form-control">
        <option value="publish">Publikasikan</option>
        <option value="draft <?php if ($produk->status_produk == "draft") {
                                    echo "selected";
                                } ?>">Simpan Sebagai Draft</option>
    </select>
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