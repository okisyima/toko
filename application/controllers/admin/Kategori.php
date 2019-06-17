<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_model');
        // proteksi halaman
        $this->simple_login->cek_login();
    }

    // data Kategori
    public function index()
    {
        $kategori = $this->kategori_model->listing();

        $data = array(
            'title'     => 'Data Kategori Produk',
            'kategori'  => $kategori,
            'isi'       => 'admin/kategori/list'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Tambah Kategori
    public function tambah()
    {
        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_kategori',
            'Nama Kategori',
            'required|is_unique[kategori.nama_kategori]',
            array(
                'required'    => '%s harus diisi',
                'is_unique'    => '%s sudah ada, buat kategori baru'
            )
        );

        if ($valid->run() == FALSE) {

            $data = array(
                'title'     => 'Tambah Kategori Produk',
                'isi'       => 'admin/kategori/tambah'
            );

            $this->load->view('admin/layout/wrapper', $data, FALSE);
            // Masuk database
        } else {
            $i = $this->input;

            $slug_kategori = url_title($this->input->post('nama_kategori'), 'dash', TRUE);

            $data = [
                'slug_kategori' => $slug_kategori,
                'nama_kategori' => $i->post('nama_kategori'),
                'urutan'        => $i->post('urutan')
            ];

            $this->kategori_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data berhasil ditambah');
            redirect(base_url('admin/kategori'), 'refresh');
        }
    }

    // Edit Kategori
    public function edit($id_kategori)
    {
        // ambil idkategori dari model
        $kategori = $this->kategori_model->detail($id_kategori);

        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_kategori',
            'Nama Kategori',
            'required|is_unique[kategori.nama_kategori]',
            array(
                'required'    => '%s harus diisi',
                'is_unique'   => '%s sudah ada, buat kategori baru'
            )
        );


        if ($valid->run() == FALSE) {

            $data = array(
                'title'     => 'Edit Data Kategori Produk',
                'kategori'      => $kategori,
                'isi'       => 'admin/kategori/edit'
            );

            $this->load->view('admin/layout/wrapper', $data, FALSE);
            // Masuk database
        } else {
            $i = $this->input;

            $slug_kategori = url_title($this->input->post('nama_kategori'), 'dash', TRUE);

            $data = [
                'id_kategori'   => $id_kategori,
                'slug_kategori' => $slug_kategori,
                'nama_kategori' => $i->post('nama_kategori'),
                'urutan'        => $i->post('urutan')
            ];

            $this->kategori_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data berhasil diubah');
            redirect(base_url('admin/kategori'), 'refresh');
        }
    }

    // hapus Kategori
    public function hapus($id_kategori)
    {
        $data = ['id_kategori'  => $id_kategori];
        $this->kategori_model->hapus($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('admin/kategori'), 'reflesh');
    }
}
/* End of file Kategori.php */
