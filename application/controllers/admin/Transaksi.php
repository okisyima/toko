<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('rekening_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('konfigurasi_model');
    }

    // load data transaksi
    public function index()
    {
        $transaksi = $this->header_transaksi_model->listing();

        $data = [
            'title'            => 'Data Transaksi',
            'header_transaksi' =>  $transaksi,
            'isi'              => 'admin/transaksi/list'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function detail($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);

        $data = [
            'title'             => 'Detail Belanja',
            'header_transaksi'  => $header_transaksi,
            'transaksi'         => $transaksi,
            'isi'               => 'admin/transaksi/detail'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function cetak($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);
        $site               = $this->konfigurasi_model->listing();

        $data = [
            'title'             => 'Detail Belanja',
            'header_transaksi'  => $header_transaksi,
            'transaksi'         => $transaksi,
            'site'              => $site
        ];

        $this->load->view('admin/transaksi/cetak', $data, FALSE);
    }
}

/* End of file Transaksi.php */
