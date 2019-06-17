<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// form open
echo form_open(base_url('admin/user/tambah'));
?>

<!-- <form action="<?= base_url('admin/user/tambah') ?>" method="post"> -->

<div class="form-group">
    <label>Nama Pengguna</label>
    <input type="text" name="nama" class="form-control" placeholder="nama pengguna" value="<?= set_value('nama') ?>" required>
</div>

<div class="form-group">
    <label>Email Pengguna</label>
    <input type="email" name="email" class="form-control" placeholder="email pengguna" value="<?= set_value('email') ?>" required>
</div>

<div class="form-group">
    <label>Username</label>
    <input type="text" name="username" class="form-control" placeholder="username" value="<?= set_value('username') ?>" required>
</div>

<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="password" value="<?= set_value('password') ?>" required>
</div>

<div class="form-group">
    <label>Akses Level</label>
    <select name="akses_level" class="form-control">
        <option value="Admin">Admin</option>
        <option value="User">User</option>
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
<!-- </form> -->

<?= form_close(); ?>