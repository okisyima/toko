<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Header_transaksi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->database();
    }

    public function listing()
    {
        $this->db->select('header_transaksi.*,
                            pelanggan.nama_pelanggan, 
                            SUM(transaksi.jumlah) AS total_item');
        $this->db->from('header_transaksi');
        // join
        $this->db->join('transaksi', 'transaksi.kode_transaksi = 
        header_transaksi.kode_transaksi', 'left');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = header_transaksi.id_pelanggan', 'left');
        // end join
        $this->db->group_by('header_transaksi.id_header');
        $this->db->order_by('id_header', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function pelanggan($id_pelanggan)
    {
        $this->db->select('header_transaksi.*, 
        SUM(transaksi.jumlah) AS total_item');
        $this->db->from('header_transaksi');
        $this->db->where('header_transaksi.id_pelanggan', $id_pelanggan);
        // join
        $this->db->join('transaksi', 'transaksi.kode_transaksi = 
        header_transaksi.kode_transaksi', 'left');
        // end join
        $this->db->group_by('header_transaksi.id_header');
        $this->db->order_by('id_header', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function kode_transaksi($kode_transaksi)
    {
        $this->db->select('header_transaksi.*,
                            pelanggan.nama_pelanggan,
                            rekening.nama_bank AS bank,
                            rekening.nomor_rekening,
                            rekening.nama_pemilik, 
                            SUM(transaksi.jumlah) AS total_item');
        $this->db->from('header_transaksi');
        // join
        $this->db->join('transaksi', 'transaksi.kode_transaksi = 
        header_transaksi.kode_transaksi', 'left');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = header_transaksi.id_pelanggan', 'left');
        $this->db->join('rekening', 'rekening.id_rekening = header_transaksi.id_rekening', 'left');
        // end join
        $this->db->group_by('header_transaksi.id_header');
        $this->db->where('transaksi.kode_transaksi', $kode_transaksi);
        $this->db->order_by('id_header', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function detail($id_header)
    {
        $this->db->select('*');
        $this->db->from('header_transaksi');
        $this->db->where('id_header', $id_header);
        $this->db->order_by('id_header', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function tambah($data)
    {
        $this->db->insert('header_transaksi', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_header', $data['id_header']);
        $this->db->update('header_transaksi', $data);
    }

    public function hapus($data)
    {
        $this->db->where('id_header', $data['id_header']);
        $this->db->delete('header_transaksi', $data);
    }
}

/* End of file Header_transaksi_model.php */
