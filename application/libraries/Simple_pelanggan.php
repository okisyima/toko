<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Simple_pelanggan
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();

        // load data model user
        $this->ci->load->model('pelanggan_model');
    }

    public function login($email, $password)
    {
        $check = $this->ci->pelanggan_model->login($email, $password);

        // jika ada data user, maka create session login
        if ($check) {
            $id_pelanggan   = $check->id_pelanggan;
            $nama_pelanggan = $check->nama_pelanggan;
            // $akses_level    = $check->akses_level;

            // create session
            $this->ci->session->set_userdata('id_pelanggan', $id_pelanggan);
            $this->ci->session->set_userdata('nama_pelanggan', $nama_pelanggan);
            $this->ci->session->set_userdata('email', $email);
            // $this->ci->session->set_userdata('akses_level', $akses_level);

            // redirect ke halaman admin
            redirect(base_url('dasbor'), 'reflesh');
        } else {
            // jika tidak ada, maka login kembali / user pass salah
            $this->ci->session->set_flashdata('warning', 'email atau password salah');
            redirect(base_url('masuk'), 'reflesh');
        }
    }

    public function cek_login()
    {
        // memeriksa apakan session udah ada atu belum, jika belum alihkan ke login
        if ($this->ci->session->userdata('email') == "") {
            $this->ci->session->set_flashdata('warning', 'anda belum login');
            redirect(base_url('masuk'), 'reflesh');
        }
    }

    public function logout()
    {
        // membuang semua sessio yang telah di set pada saat login
        $this->ci->session->unset_userdata('id_pelanggan');
        $this->ci->session->unset_userdata('nama');
        $this->ci->session->unset_userdata('email');
        // $this->ci->session->unset_userdata('akses_level');

        // setelah session dibuang, maka redirect ke login
        $this->ci->session->set_flashdata('sukses', 'logout !!');
        redirect(base_url('masuk'), 'reflesh');
    }
}

/* End of file Simple_pelanggan.php */
