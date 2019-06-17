<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dasbor extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        $this->load->model('rekening_model');
        // Halam ini di proteksi dengan simple pelanggan -> ceklogin
        $this->simple_pelanggan->cek_login();
    }


    public function index()
    {
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = [
            'title'             => 'Halama Dashboard Pelanggan',
            'header_transaksi'  => $header_transaksi,
            'isi'               => 'dasbor/list'
        ];

        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function belanja()
    {
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = [
            'title'             => 'Riwayat Belanja',
            'header_transaksi'  => $header_transaksi,
            'isi'               => 'dasbor/belanja'
        ];

        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function detail($kode_transaksi)
    {
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);

        // 
        if ($header_transaksi->id_pelanggan != $id_pelanggan) {
            $this->session->set_flashdata('warning', 'Anda mencoba mengakses data');
            redirect(base_url('masuk'));
        }

        $data = [
            'title'             => 'Detail Belanja',
            'header_transaksi'  => $header_transaksi,
            'transaksi'         => $transaksi,
            'isi'               => 'dasbor/detail'
        ];

        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function profil()
    {
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $pelanggan          = $this->pelanggan_model->detail($id_pelanggan);

        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_pelanggan',
            'Nama Pelanggan',
            'required',
            array('required'    => '%s harus diisi')
        );

        $valid->set_rules(
            'telepon',
            'Nomor Telepon',
            'required',
            array('required'    => '%s harus diisi')
        );

        $valid->set_rules(
            'alamat',
            'Alamat Domilisi',
            'required',
            array('required'    => '%s harus diisi')
        );

        if ($valid->run() == FALSE) {

            $data = [
                'title'         => 'Profil Saya',
                'pelanggan'     => $pelanggan,
                'isi'           => 'dasbor/profil'
            ];

            $this->load->view('layout/wrapper', $data, FALSE);

            // Masuk database
        } else {
            $i = $this->input;

            // jika password lebih dari 6 karakter, maka di ganti
            if (strlen($i->post('password')) >= 6) {

                $data = [
                    'id_pelanggan'      => $id_pelanggan,
                    'nama_pelanggan'    => $i->post('nama_pelanggan'),
                    'password'          => SHA1($i->post('password')),
                    'telepon'           => $i->post('telepon'),
                    'alamat'            => $i->post('alamat'),
                ];
            } else {

                // jika kurang dari 6, maka tidak diganti
                $data = [
                    'id_pelanggan'      => $id_pelanggan,
                    'nama_pelanggan'    => $i->post('nama_pelanggan'),
                    'telepon'           => $i->post('telepon'),
                    'alamat'            => $i->post('alamat'),
                ];
            } //end data updat

            $this->pelanggan_model->edit($data);
            $this->session->set_flashdata('sukses', 'Update Berhasil');
            redirect(base_url('dasbor/profil'), 'refresh');
        }
    }

    // konfirmasi pembayaran
    public function konfirmasi($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $rekening           = $this->rekening_model->listing();

        // validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_bank',
            'Nama Bank',
            'required',
            array('required'    => '%s harus diisi')
        );

        $valid->set_rules(
            'rekening_pembayaran',
            'Nomor Rekening',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        $valid->set_rules(
            'rekening_pelanggan',
            'Nama Pemilik',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        $valid->set_rules(
            'tanggal_bayar',
            'Tangal Pembayaran',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        $valid->set_rules(
            'jumlah_bayar',
            'Jumlah Pembayaran',
            'required',
            array(
                'required'    => '%s harus diisi'
            )
        );

        if ($valid->run()) {
            // check jika gambar diganti
            if (!empty($_FILES['bukti_bayar']['name'])) {

                $config['upload_path']      = './assets/upload/image/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2400'; //Dalam ukuran KB
                $config['max_width']        = '2024';
                $config['max_height']       = '2024';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('bukti_bayar')) {

                    $data = [
                        'title'             => 'Konfirmasi Pembayaran',
                        'header_transaksi'  => $header_transaksi,
                        'rekening'          => $rekening,
                        'error'             => $this->upload->display_errors(),
                        'isi'               => 'dasbor/konfirmasi'
                    ];

                    $this->load->view('layout/wrapper', $data, FALSE);

                    // Masuk database
                } else {

                    $upload_gambar = array('upload_data' => $this->upload->data());

                    // create thumbnail gambar
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/upload/image/' . $upload_gambar['upload_data']['file_name'];
                    // lokasi folder thumbail
                    $config['new_image']        = './assets/upload/image/';
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
                        'id_header'             => $header_transaksi->id_header,
                        'status_bayar'          => 'konfirmasi',
                        'jumlah_bayar'          => $i->post('jumlah_bayar'),
                        'rekening_pembayaran'   => $i->post('rekening_pembayaran'),
                        'rekening_pelanggan'    => $i->post('rekening_pelanggan'),
                        'bukti_bayar'           => $upload_gambar['upload_data']['file_name'],
                        'id_rekening'           => $i->post('id_rekening'),
                        'tanggal_bayar'         => $i->post('tanggal_bayar'),
                        'nama_bank'             => $i->post('nama_bank')
                    ];

                    $this->header_transaksi_model->edit($data);
                    $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
                    redirect(base_url('dasbor'), 'refresh');
                }
            } else {
                // edit produk tanpa ganti gambar
                $i = $this->input;

                $data = [
                    'id_header'             => $header_transaksi->id_header,
                    'status_Bayar'          => 'konfirmasi',
                    'jumlah_bayar'          => $i->post('jumlah_bayar'),
                    'rekening_pembayaran'   => $i->post('rekening_pembayaran'),
                    'rekening_pelanggan'    => $i->post('rekening_pelanggan'),
                    'id_rekening'           => $i->post('id_rekening'),
                    'tanggal_bayar'         => $i->post('tanggal_bayar'),
                    'nama_bank'             => $i->post('nama_bank')
                ];

                $this->header_transaksi_model->edit($data);
                $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
                redirect(base_url('dasbor'), 'refresh');
            }
        }

        $data = [
            'title'             => 'Konfirmasi Pembayaran',
            'header_transaksi'  => $header_transaksi,
            'rekening'          => $rekening,
            'isi'               => 'dasbor/konfirmasi'
        ];

        $this->load->view('layout/wrapper', $data, FALSE);
    }
}

/* End of file Dasbor.php */
