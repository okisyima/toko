<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->database();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function kode_transaksi($kode_transaksi)
    {
        $this->db->select('transaksi.*,
                            produk.nama_produk,
                            produk.kode_produk');
        $this->db->from('transaksi');
        // join dengan produk
        $this->db->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
        // end join
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function read($slug_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('slug_transaksi', $slug_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function tambah($data)
    {
        $this->db->insert('transaksi', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('transaksi', $data);
    }

    public function hapus($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->delete('transaksi', $data);
    }

    public function login($nama_transaksi, $password)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where(array(
            'nama_transaksi'  => $nama_transaksi,
            'password'  => SHA1($password)
        ));
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file Transaksi_model.php */
