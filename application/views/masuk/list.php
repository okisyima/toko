<!-- Cart -->
<section class="bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="pos-relative">
            <div class="bgwhite">
                <h1><?= $title ?></h1>
                <hr>
                <div class="clearfix"></div>
                <br><br>

                <?php
                // display logout
                if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-warning">';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                }
                ?>

                <p class="alert alert-success">Belum memiliki akun? Silahkan <a href="<?= base_url('registrasi') ?>" class="btn btn-warning btn-sm">Registrasi di sini</a></p>

                <div class="col-md-12">
                    <?php
                    // display error
                    echo validation_errors('<div class="alert alert-warning">', '</div>');
                    // display notif notghing login
                    if ($this->session->flashdata('warning')) {
                        echo '<div class="alert alert-danger">';
                        echo $this->session->flashdata('warning');
                        echo '</div>';
                    }

                    // form open
                    echo form_open(base_url('masuk'), 'class="leave-comment"');
                    ?>

                    <table class="table">

                        <tbody>
                            <tr>
                                <td width="20%">Email (username)</td>
                                <td><input type="email" name="email" class="form-control" placeholder="alamat email" value="<?= set_value('email') ?>" required></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" name="password" class="form-control" placeholder="password" value="<?= set_value('password') ?>" required></td>
                            </tr>

                            <tr>
                                <td>
                                    <button class="btn btn-success btn-md" type="submit">
                                        <i class="fa fa-save"></i> Login
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

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">

            </div>

            <div class="size10 trans-0-4 m-t-10 m-b-10">
                <!-- Button -->

            </div>
        </div>
    </div>
</section>