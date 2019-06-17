<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekening extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekening_model');
        // proteksi halaman
        $this->simple_login->cek_login();
    }

    // data Rekening
    public function index()
    {
        $rekening = $this->rekening_model->listing();

        $data = array(
            'title'     => 'Data Rekening',
            'rekening'  => $rekening,
            'isi'       => 'admin/rekening/list'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Tambah Rekening
    public function tambah()
    {
        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_bank',
            'Nama NBank',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        $valid->set_rules(
            'nomor_rekening',
            'Nomor Rekening',
            'required|is_unique[rekening.nomor_rekening]',
            array(
                'required'    => '%s harus diisi',
                'is_unique'    => '%s sudah ada, buat rekening baru'
            )
        );

        $valid->set_rules(
            'nama_pemilik',
            'Nama Pemilik',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        if ($valid->run() == FALSE) {

            $data = [
                'title'     => 'Tambah Rekening',
                'isi'       => 'admin/rekening/tambah'
            ];

            $this->load->view('admin/layout/wrapper', $data, FALSE);
            // Masuk database
        } else {
            $i = $this->input;

            // $slug_rekening = url_title($this->input->post('nama_rekening'), 'dash', TRUE);

            $data = [
                'nama_bank'     => $i->post('nama_bank'),
                'nomor_rekening'    => $i->post('nomor_rekening'),
                'nama_pemilik'      => $i->post('nama_pemilik')
            ];

            $this->rekening_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data berhasil ditambah');
            redirect(base_url('admin/rekening'), 'refresh');
        }
    }

    // Edit Rekening
    public function edit($id_rekening)
    {
        // ambil idrekening dari model
        $rekening = $this->rekening_model->detail($id_rekening);

        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_bank',
            'Nama NBank',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        $valid->set_rules(
            'nomor_rekening',
            'Nomor Rekening',
            'required|is_unique[rekening.nomor_rekening]',
            array(
                'required'    => '%s harus diisi',
                'is_unique'    => '%s sudah ada, buat rekening baru'
            )
        );

        $valid->set_rules(
            'nama_pemilik',
            'Nama Pemilik',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );


        if ($valid->run() == FALSE) {

            $data = array(
                'title'         => 'Edit Data Rekening',
                'rekening'      => $rekening,
                'isi'           => 'admin/rekening/edit'
            );

            $this->load->view('admin/layout/wrapper', $data, FALSE);
            // Masuk database
        } else {
            $i = $this->input;

            $data = [
                'id_rekening'       => $id_rekening,
                'nama_bank'         => $i->post('nama_bank'),
                'nomor_rekening'    => $i->post('nomor_rekening'),
                'nama_pemilik'      => $i->post('nama_pemilik')
            ];

            $this->rekening_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data berhasil diubah');
            redirect(base_url('admin/rekening'), 'refresh');
        }
    }

    // hapus Rekening
    public function hapus($id_rekening)
    {
        $data = ['id_rekening'  => $id_rekening];
        $this->rekening_model->hapus($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('admin/rekening'), 'reflesh');
    }
}
/* End of file Rekening.php */
