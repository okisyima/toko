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

                <?php
                // notif
                if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-warning">';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                }
                // display error
                echo validation_errors('<div class="alert alert-warning">', '</div>');
                // form open
                echo form_open(base_url('dasbor/profil'), 'class="leave-comment"');
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th><input type="text" name="nama_pelanggan" class="form-control" placeholder="nama lengkap" value="<?= $pelanggan->nama_pelanggan ?>" required></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" class="form-control" placeholder="alamat email" value="<?= $pelanggan->email ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" class="form-control" placeholder="password" value="<?= set_value('password') ?>">
                                <span class="text-danger"> Minimal 6 karakter</span></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input type="text" name="telepon" class="form-control" placeholder="nomor telepon" value="<?= $pelanggan->telepon ?>" required></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><input type="text" name="alamat" class="form-control" placeholder="nomor telepon" value="<?= $pelanggan->alamat ?>" required></td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-success btn-md" type="submit">
                                    <i class="fa fa-save"></i> Update
                                </button>
                                <button class="btn btn-danger btn-md" type="submit">
                                    <i class="fa fa-times"></i> Reset
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?= form_close(); ?>

            </div>
        </div>
    </div>
    </div>
</section>