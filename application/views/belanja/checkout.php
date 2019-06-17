<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <h1><?= $title ?></h1>
                <hr>
                <div class="clearfix"></div>
                <br><br>

                <?php
                if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-info">';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                }
                ?>

                <table class="table-shopping-cart">
                    <tr class="table-head">
                        <th class="column-1">Gambar</th>
                        <th class="column-2">Produk</th>
                        <th class="column-3">Harga</th>
                        <th class="column-4 p-l-70">Jumlah</th>
                        <th class="column-5">SubTotal</th>
                        <th class="column-6">ACTION</th>
                    </tr>

                    <?php
                    // looping data keranjang belanja
                    foreach ($keranjang as $keranjang) {
                        // ambil data produk
                        $id_produk  = $keranjang['id'];
                        $produk     = $this->produk_model->detail($id_produk);
                        // form update
                        echo form_open(base_url('belanja/update_cart/' . $keranjang['rowid']));
                        ?>

                        <tr class="table-row">
                            <td class="column-1">
                                <div class="cart-img-product b-rad-4 o-f-hidden">
                                    <img src="<?= base_url('assets/upload/image/thumbs/' . $produk->gambar) ?>" alt="<?= $keranjang['name'] ?>">
                                </div>
                            </td>
                            <td class="column-2"><?= $keranjang['name'] ?></td>
                            <td class="column-3">IDR <?= number_format($keranjang['price'], '0', ',', '.') ?></td>
                            <td class="column-4">
                                <div class="flex-w bo5 of-hidden w-size17">
                                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                    </button>

                                    <input class="size8 m-text18 t-center num-product" type="number" name="qty" value="<?= $keranjang['qty'] ?>">

                                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="column-5">IDR <?= number_format($keranjang['subtotal'], '0', ',', '.') ?></td>
                            <td class="column-6">
                                <button type="submit" name="update" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i> Update
                                </button>

                                <a href="<?= base_url('belanja/hapus/' . $keranjang['rowid']) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-trash-o"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php
                        echo form_close(); //form close
                    } //end looping
                    ?>
                    <tr class="table-row">
                        <td colspan="4" class="column-1">Total Harga</td>
                        <td class="column-2">IDR <b><u> <?= number_format($this->cart->total(), '0', ',', '.'); ?></td>
                    </tr>
                </table>
                <br>

                <?php
                echo form_open(base_url('belanja/checkout'));
                $kode_transaksi = date('dmY') . strtoupper(random_string('alnum', 16));
                ?>

                <input type="hidden" name="id_pelanggan" value="<?= $pelanggan->id_pelanggan ?>">
                <table class="table">
                    <input type="hidden" name="jumlah_transaksi" value="<?= $this->cart->total(); ?>">
                    <table class="table">
                        <input type="hidden" name="tanggal_transaksi" value="<?= date('Y-m-d') ?>">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th><input type="text" name="kode_transaksi" class="form-control" value="<?= $kode_transaksi ?>" readonly required></th>
                                </tr>
                                <tr>
                                    <th>Nama Penerima</th>
                                    <th><input type="text" name="nama_pelanggan" class="form-control" placeholder="nama lengkap" value="<?= $pelanggan->nama_pelanggan ?>" required></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Email Penerima</td>
                                    <td><input type="email" name="email" class="form-control" placeholder="alamat email" value="<?= $pelanggan->email ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Telepon Penerima</td>
                                    <td><input type="text" name="telepon" class="form-control" placeholder="nomor telepon" value="<?= $pelanggan->telepon ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Alamat Pengiriman</td>
                                    <td><input name="alamat" class="form-control" placeholder="alamat domisili" value="<?= $pelanggan->alamat ?>"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-success btn-md" type="submit">
                                            <i class="fa fa-save"></i> Check Out Sekarang !
                                        </button>
                                        <button class="btn btn-danger btn-md" type="submit">
                                            <i class="fa fa-times"></i> Reset
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?= form_close() ?>
            </div>
        </div>

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">

                <p class="alert alert-info">Mohon diperiksa kembali barang pesanan anda, sebelum anda setujui pembelian, <b>Brada en Sista inget inget ye udeh hari keberape ini puasa?, tar lagi kite udeh di tinggal ramadhan, udeh sampe mane tilawah kite?, skuy ah abis abisan dah kite di ujung ini</b></p>

            </div>

            <div class="size10 trans-0-4 m-t-10 m-b-10">
                <!-- Button -->

            </div>
        </div>
    </div>
</section>