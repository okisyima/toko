<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
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
        $this->db->from('pelanggan');
        $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function login($email, $password)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where([
            'email' => $email,
            'password'  => SHA1($password)
        ]);
        $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function sudah_login($email, $nama_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where([
            'email'           => $email,
            'nama_pelanggan'  => $nama_pelanggan
        ]);
        $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function detail($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function tambah($data)
    {
        $this->db->insert('pelanggan', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_pelanggan', $data['id_pelanggan']);
        $this->db->update('pelanggan', $data);
    }

    public function hapus($data)
    {
        $this->db->where('id_pelanggan', $data['id_pelanggan']);
        $this->db->delete('pelanggan', $data);
    }
}

/* End of file Pelanggan_model.php */
