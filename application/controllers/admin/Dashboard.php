<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('user_model');
        // proteksi halaman
        $this->simple_login->cek_login();
    }


    public function index()
    {
        $data = array(
            'title' => 'Halaman Administrator',
            'isi'   => 'admin/dasbor/list'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Dashboard.php */
