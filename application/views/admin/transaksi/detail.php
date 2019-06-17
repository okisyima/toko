<p class="pull-right">
    <div class="btn-group pull-right">
        <a href="<?= base_url('admin/transaksi/cetak' . $header_transaksi->kode_transaksi) ?>" target="_blank" title="Cetak" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak
        </a>
        <a href="<?= base_url('admin/transaksi') ?>" title="Kembali" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i> Kembali
        </a>
    </div>
</p>

<div class="clearfix"></div>
<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">NAMA PELANGGAN</th>
            <th>: <?= $header_transaksi->nama_pelanggan ?></th>
        </tr>
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

        <tr>
            <td>Butki bayar</td>
            <td>:
                <?php if ($header_transaksi->bukti_bayar == "") {
                    echo 'Belum ada';
                } else { ?>
                    <img src="<?= base_url('assets/upload/image/' . $header_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200">
                <?php } ?>
            </td>
        </tr>

        <tr>
            <td>Tanggal bayar</td>
            <td>: <?= date('d-m-Y', strtotime($header_transaksi->status_bayar)) ?></td>
        </tr>

        <tr>
            <td>Jumlah bayar</td>
            <td>: Rp. <?= number_format($header_transaksi->jumlah_bayar, '0', ',', '.') ?></td>
        </tr>

        <tr>
            <td>Pembayaran dari</td>
            <td>: <?= $header_transaksi->nama_bank ?> No. Rek <?= $header_transaksi->rekening_pembayaran ?> a/n <?= $header_transaksi->rekening_pelanggan ?></td>
        </tr>

        <tr>
            <td>Pembayaran ke rekening</td>
            <td>: <?= $header_transaksi->bank ?> No. Rek <?= $header_transaksi->nomor_rekening ?> a/n <?= $header_transaksi->nama_pemilik ?></td>
        </tr>

    </tbody>
</table>

<hr>

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