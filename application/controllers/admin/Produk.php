<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');

        // proteksi halaman
        $this->simple_login->cek_login();
    }


    // data Produk
    public function index()
    {
        $produk = $this->produk_model->listing();

        $data = array(
            'title'     => 'Data Pengguna',
            'produk'    => $produk,
            'isi'       => 'admin/produk/list'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function gambar($id_produk)
    {
        $produk = $this->produk_model->detail($id_produk);
        $gambar = $this->produk_model->gambar($id_produk);

        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'judul_gambar',
            'Judul atau Nama Gambar',
            'required',
            array('required'    => '%s harus diisi')
        );

        if ($valid->run()) {

            $config['upload_path']      = './assets/upload/image/thumbs/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2400'; //Dalam ukuran KB
            $config['max_width']        = '2024';
            $config['max_height']       = '2024';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {


                $data = array(
                    'title'     => 'Tambah Gambar Produk : ' . $produk->nama_produk,
                    'produk'    => $produk,
                    'gambar'    => $gambar,
                    'error'     => $this->upload->display_errors(),
                    'isi'       => 'admin/produk/gambar'
                );

                $this->load->view('admin/layout/wrapper', $data, FALSE);
                // Masuk database
            } else {

                $upload_gambar = array('upload_data' => $this->upload->data());

                // create thumbnail gambar
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/upload/image/thumbs' . $upload_gambar['upload_data']['file_name'];
                // lokasi folder thumbail
                $config['new_image']        = './assets/upload/image/thumbs';
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 250; //pixel
                $config['height']           = 250; //pixel
                $config['thumb_maker']      = '';


                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                // end thumbnail gambar

                $i = $this->input;

                $data = [
                    'id_produk'        => $id_produk,
                    'judul_gambar'  => $i->post('judul_gambar'),
                    // disimpan nama file gambar
                    'gambar'        => $upload_gambar['upload_data']['file_name']
                ];

                $this->produk_model->tambah_gambar($data);
                $this->session->set_flashdata('sukses', 'Data Gambar berhasil ditambah');
                redirect(base_url('admin/produk/gambar/' . $id_produk), 'refresh');
            }
        }

        $data = array(
            'title'     => 'Tambah Gambar Produk :' . $produk->nama_produk,
            'produk'    => $produk,
            'gambar'    => $gambar,
            'isi'       => 'admin/produk/gambar'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Tambah Produk
    public function tambah()
    {
        // ambil data kategori
        $kategori = $this->kategori_model->listing();

        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_produk',
            'Nama Produk',
            'required',
            array('required'    => '%s harus diisi')
        );

        $valid->set_rules(
            'kode_produk',
            'Kode Produk',
            'required|is_unique[produk.kode_produk]',
            array(
                'required'    => '%s harus diisi',
                'is_unique' => '%s sudah ada, Buat kode baru.'
            )
        );

        if ($valid->run()) {

            $config['upload_path']      = './assets/upload/image/thumbs/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2400'; //Dalam ukuran KB
            $config['max_width']        = '2024';
            $config['max_height']       = '2024';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {


                $data = array(
                    'title'     => 'Tambah Pengguna',
                    'kategori'  => $kategori,
                    'error'     => $this->upload->display_errors(),
                    'isi'       => 'admin/produk/tambah'
                );

                $this->load->view('admin/layout/wrapper', $data, FALSE);
                // Masuk database
            } else {

                $upload_gambar = array('upload_data' => $this->upload->data());

                // create thumbnail gambar
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/upload/image/thumbs' . $upload_gambar['upload_data']['file_name'];
                // lokasi folder thumbail
                $config['new_image']        = './assets/upload/image/thumbs';
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 250; //pixel
                $config['height']           = 250; //pixel
                $config['thumb_maker']      = '';


                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                // end thumbnail gambar

                $i = $this->input;

                $slug_produk = url_title($this->input->post('nama_produk') . '-' . $this->input->post('kode_produk'), 'dash', TRUE);

                $data = [
                    'id_user'       => $this->session->userdata('id_user'),
                    'id_kategori'   => $i->post('id_kategori'),
                    'kode_produk'   => $i->post('kode_produk'),
                    'nama_produk'   => $i->post('nama_produk'),
                    'slug_produk'   => $slug_produk,
                    'keterangan'    => $i->post('keterangan'),
                    'keywords'      => $i->post('keywords'),
                    'harga'         => $i->post('harga'),
                    'stok'          => $i->post('stok'),
                    // disimpan nama file gambar
                    'gambar'        => $upload_gambar['upload_data']['file_name'],
                    'berat'         => $i->post('berat'),
                    'ukuran'        => $i->post('ukuran'),
                    'status_produk' => $i->post('status_produk'),
                    'tanggal_post'  => date('Y-m-d H:i:s')
                ];

                $this->produk_model->tambah($data);
                $this->session->set_flashdata('sukses', 'Data berhasil ditambah');
                redirect(base_url('admin/produk'), 'refresh');
            }
        }

        $data = array(
            'title'     => 'Tambah Pengguna',
            'kategori'  => $kategori,
            'isi'       => 'admin/produk/tambah'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    // Edit Produk
    public function edit($id_produk)
    {
        // ambil data produk yang akan diedit
        $produk = $this->produk_model->detail($id_produk);
        // ambil data kategori
        $kategori = $this->kategori_model->listing();
        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_produk',
            'Nama Produk',
            'required',
            array('required'    => '%s harus diisi')
        );

        $valid->set_rules(
            'kode_produk',
            'Kode Produk',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        if ($valid->run()) {
            // check jika gambar diganti
            if (!empty($_FILES['gambar']['name'])) {

                $config['upload_path']      = './assets/upload/image/thumbs/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2400'; //Dalam ukuran KB
                $config['max_width']        = '2024';
                $config['max_height']       = '2024';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {

                    $data = array(
                        'title'     => 'Edit Produk: ' . $produk->nama_produk,
                        'kategori'  => $kategori,
                        'produk'    => $produk,
                        'error'     => $this->upload->display_errors(),
                        'isi'       => 'admin/produk/edit'
                    );

                    $this->load->view('admin/layout/wrapper', $data, FALSE);
                    // Masuk database
                } else {

                    $upload_gambar = array('upload_data' => $this->upload->data());

                    // create thumbnail gambar
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/upload/image/thumbs' . $upload_gambar['upload_data']['file_name'];
                    // lokasi folder thumbail
                    $config['new_image']        = './assets/upload/image/thumbs';
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 250; //pixel
                    $config['height']           = 250; //pixel
                    $config['thumb_maker']      = '';


                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                    // end thumbnail gambar

                    $i = $this->input;

                    $slug_produk = url_title($this->input->post('nama_produk') . '-' . $this->input->post('kode_produk'), 'dash', TRUE);

                    $data = [
                        'id_produk'     => $id_produk,
                        'id_user'       => $this->session->userdata('id_user'),
                        'id_kategori'   => $i->post('id_kategori'),
                        'kode_produk'   => $i->post('kode_produk'),
                        'nama_produk'   => $i->post('nama_produk'),
                        'slug_produk'   => $slug_produk,
                        'keterangan'    => $i->post('keterangan'),
                        'keywords'      => $i->post('keywords'),
                        'harga'         => $i->post('harga'),
                        'stok'          => $i->post('stok'),
                        // disimpan nama file gambar
                        'gambar'        => $upload_gambar['upload_data']['file_name'],
                        'berat'         => $i->post('berat'),
                        'ukuran'        => $i->post('ukuran'),
                        'status_produk' => $i->post('status_produk')
                    ];

                    $this->produk_model->edit($data);
                    $this->session->set_flashdata('sukses', 'Data berhasil diedit');
                    redirect(base_url('admin/produk'), 'refresh');
                }
            } else {
                // edit produk tanpa ganti gambar
                $i = $this->input;

                $slug_produk = url_title($this->input->post('nama_produk') . '-' . $this->input->post('kode_produk'), 'dash', TRUE);

                $data = [
                    'id_produk'     => $id_produk,
                    'id_user'       => $this->session->userdata('id_user'),
                    'id_kategori'   => $i->post('id_kategori'),
                    'kode_produk'   => $i->post('kode_produk'),
                    'nama_produk'   => $i->post('nama_produk'),
                    'slug_produk'   => $slug_produk,
                    'keterangan'    => $i->post('keterangan'),
                    'keywords'      => $i->post('keywords'),
                    'harga'         => $i->post('harga'),
                    'stok'          => $i->post('stok'),
                    // disimpan nama file gambar (gambar tidak diganti)
                    // 'gambar'        => $upload_gambar['upload_data']['file_name'],
                    'berat'         => $i->post('berat'),
                    'ukuran'        => $i->post('ukuran'),
                    'status_produk' => $i->post('status_produk')
                ];

                $this->produk_model->edit($data);
                $this->session->set_flashdata('sukses', 'Data berhasil diedit');
                redirect(base_url('admin/produk'), 'refresh');
            }
        }

        $data = array(
            'title'     => 'Edit Produk:' . $produk->nama_produk,
            'kategori'  => $kategori,
            'produk'    => $produk,
            'isi'       => 'admin/produk/edit'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // hapus produk
    public function hapus($id_produk)
    {
        // proses hapus gambar
        $produk = $this->produk_model->detail($id_produk);
        unlink('./assets/upload/image/' . $produk->gambar);
        unlink('./assets/upload/image/thumbs/' . $produk->gambar);
        // end proses hapus
        $data = ['id_produk'  => $id_produk];
        $this->produk_model->hapus($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('admin/produk'), 'reflesh');
    }

    // hapus produk
    public function hapus_gambar($id_produk, $id_gambar)
    {
        // proses hapus gambar
        $gambar = $this->produk_model->detail_gambar($id_gambar);
        unlink('./assets/upload/image/' . $gambar->gambar);
        unlink('./assets/upload/image/thumbs/' . $gambar->gambar);
        // end proses hapus
        $data = ['id_gambar'  => $id_gambar];
        $this->produk_model->hapus_gambar($data);
        $this->session->set_flashdata('sukses', 'Data gambar berhasil dihapus');
        redirect(base_url('admin/produk/gambar/' . $id_produk), 'reflesh');
    }
}

/* End of file Produk.php */
