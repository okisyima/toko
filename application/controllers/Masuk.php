<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Masuk extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('pelanggan_model');
    }


    public function index()
    {
        // validasi
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => '%s harus diisi'));

        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s harus diisi'));

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // proses ke simple login
            $this->simple_pelanggan->login($email, $password);
        }

        $data = [
            'title'     => "Login Pelanggan",
            'isi'       => "masuk/list"
        ];

        $this->load->view('layout/wrapper', $data, FALSE);
    }

    // logout
    public function logout()
    {
        # code...
        // ambil fngsi logout di simplepelanggan yg sudah di set atutoload
        $this->simple_pelanggan->logout();
    }
}

/* End of file Masuk.php */
