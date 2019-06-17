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
            </div>
        </div>

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">

            </div>

            <div class="size10 trans-0-4 m-t-10 m-b-10">
                <!-- Button -->
                <a href="<?= base_url('belanja/hapus') ?>" class="btn btn-danger btn-lg">
                    <i class="fa fa-trash-o"> Bersikan Keranjang</i>
                </a>

                <a href="<?= base_url('belanja/checkout') ?>" class="btn btn-info btn-lg">
                    <i class="fa fa-shopping-cart"> Checkout !</i>
                </a>
            </div>
        </div>
    </div>
</section>