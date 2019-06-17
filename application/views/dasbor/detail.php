<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->

                    <?php include('menu.php') ?>

                </div>
            </div>

            <div class="col-sm-6 col-md-9 col-lg-9 p-b-50">

                <!-- Product -->
                <!-- <div class="row"> -->

                <h1><?= $title ?></h1>
                <hr>
                <p> Berikut adalah riwayat belanja anda </p>

                <?php

                if ($header_transaksi) {

                    ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="20%">KODE TRANSAKSI</th>
                                <th>: <?= $header_transaksi->kode_transaksi ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?= date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                            </tr>

                            <tr>
                                <td>Jumlah total</td>
                                <td>: <?= number_format($header_transaksi->jumlah_transaksi) ?></td>
                            </tr>

                            <tr>
                                <td>Status bayar</td>
                                <td>: <?= $header_transaksi->status_bayar ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE</th>
                                <th>NAMA PRODUK</th>
                                <th>JUMLAH</th>
                                <th>HARGA</th>
                                <th>SUB TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($transaksi as $transaksi) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $transaksi->kode_produk ?></td>
                                    <td><?= $transaksi->nama_produk ?></td>
                                    <td><?= number_format($transaksi->jumlah) ?></td>
                                    <td><?= number_format($transaksi->harga) ?></td>
                                    <td><?= number_format($transaksi->total_harga) ?></td>
                                </tr>
                                <?php $i++;
                            } ?>
                        </tbody>
                    </table>

                <?php

            } else {

                ?>

                    <p class="alert alert-success">
                        <i class="fa fa-warning"></i>Belum ada data transaksi </p>

                <?php } ?>

                <!-- </div> -->

                <!-- Pagination -->
                <div class="pagination flex-m flex-w p-t-26">

                </div>
            </div>
        </div>
    </div>
</section>