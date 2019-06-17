<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Simple_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();

        // load data model user
        $this->ci->load->model('user_model');
    }

    public function login($username, $password)
    {
        $check = $this->ci->user_model->login($username, $password);

        // jika ada data user, maka create session login
        if ($check) {
            $id_user        = $check->id_user;
            $nama           = $check->nama;
            $akses_level    = $check->akses_level;

            // create session
            $this->ci->session->set_userdata('id_user', $id_user);
            $this->ci->session->set_userdata('nama', $nama);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('akses_level', $akses_level);

            // redirect ke halaman admin
            redirect(base_url('admin/dashboard'), 'reflesh');
        } else {
            // jika tidak ada, maka login kembali / user pass salah
            $this->ci->session->set_flashdata('warning', 'username atau password salah');
            redirect(base_url('login'), 'reflesh');
        }
    }

    public function cek_login()
    {
        // memeriksa apakan session udah ada atu belum, jika belum alihkan ke login
        if ($this->ci->session->userdata('username') == "") {
            $this->ci->session->set_flashdata('warning', 'anda belum login');
            redirect(base_url('login'), 'reflesh');
        }
    }

    public function logout()
    {
        // membuang semua sessio yang telah di set pada saat login
        $this->ci->session->unset_userdata('id_user');
        $this->ci->session->unset_userdata('nama');
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('akses_level');

        // setelah session dibuang, maka redirect ke login
        $this->ci->session->set_flashdata('sukses', 'logout !!');
        redirect(base_url('login'), 'reflesh');
    }
}

/* End of file Simple_login.php */
