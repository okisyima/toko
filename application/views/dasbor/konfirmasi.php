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

                <h1><?= $title ?></h1>
                <hr>
                <p> Berikut adalah riwayat belanja anda </p>

                <?php

                if ($header_transaksi) {

                    ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>KODE TRANSAKSI</th>
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

                            <tr>
                                <td>Bukti bayar</td>
                                <td>:
                                    <?php if ($header_transaksi->bukti_bayar != "") { ?>
                                        <img src="<?= base_url('assets/upload/image/' . $header_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200">
                                    <?php } else {
                                    echo 'Belum ada bukti bayar';
                                } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <?php

                    // error upload
                    if (isset($error)) {
                        echo '<p class="alert alert-warning">' . $error . '</p>';
                    }

                    // notif error
                    echo validation_errors('<p class="alert alert-warning">', '</p>');

                    // form open
                    echo form_open_multipart(base_url('dasbor/konfirmasi/' . $header_transaksi->kode_transaksi));
                    // 
                    ?>

                    <table>
                        <tbody>
                            <tr>
                                <td width="25%">Pembayaran Ke Rekening : </td>
                                <td>
                                    <select name="id_rekening" class="form-control">
                                        <?php foreach ($rekening as $rekening) { ?>
                                            <option value="<?= $rekening->id_rekening ?>">
                                                <?php if ($header_transaksi->id_rekening == $rekening->id_rekening) {
                                                    echo "selected";
                                                } ?>
                                                <?= $rekening->nama_bank ?> (NO. Rekening: <?= $rekening->nomor_rekening ?> a/n <?= $rekening->nama_pemilik ?>)
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Bayar</td>
                                <td>
                                    <input type="date" name="tanggal_bayar" class="form-control" placeholder="dd-mm-yyyy" value="<?php if (isset($_POST['tanggal_bayar'])) {
                                                                                                                                        echo set_value('tanggal_bayar');
                                                                                                                                    } elseif ($header_transaksi->tanggal_bayar != "") {
                                                                                                                                        echo $header_transaksi->tanggal_bayar;
                                                                                                                                    } else {
                                                                                                                                        echo date('d-m-Y');
                                                                                                                                    } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Pembayaran</td>
                                <td>
                                    <input type="number" name="jumlah_bayar" class="form-control" placeholder="jumlah pembayran" value="<?php if (isset($_POST['jumlah_bayar'])) {
                                                                                                                                            echo set_value('tanggal_bayar');
                                                                                                                                        } elseif ($header_transaksi->jumlah_bayar != "") {
                                                                                                                                            echo $header_transaksi->jumlah_bayar;
                                                                                                                                        } else {
                                                                                                                                            echo $header_transaksi->jumlah_transaksi;
                                                                                                                                        } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Dari Bank</td>
                                <td>
                                    <input input="text" name="nama_bank" class="form-control" value="<?= $header_transaksi->nama_bank ?>" placeholder="Nama Bank">
                                    <small>Misal : BANK BTN</small>
                                </td>
                            </tr>
                            <tr>
                                <td>Dari Nomor Rekening</td>
                                <td>
                                    <input input="text" name="rekening_pembayaran" class="form-control" value="<?= $header_transaksi->rekening_pembayaran ?>" placeholder="nomor rekening">
                                    <small>Misal : 7007007007</small>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Pemilik</td>
                                <td>
                                    <input input="text" name="rekening_pelanggan" class="form-control" value="<?= $header_transaksi->rekening_pelanggan ?>" placeholder="Nama Pemilik Rekening">
                                    <small>Misal : Kuncoro</small>
                                </td>
                            </tr>
                            <tr>
                                <td>Upload Bukti Bayar</td>
                                <td>
                                    <input type="file" name="bukti_bayar">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm" type="submit" name="submit"><i class="fa fa-upload"></i> Submit</button>
                                        <button class="btn btn-info btn-sm"><i class="fa fa-times"></i> Reset</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <?= form_close();
                // 
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