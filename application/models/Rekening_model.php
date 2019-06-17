<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekening_model extends CI_Model
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
        $this->db->from('rekening');
        $this->db->order_by('id_rekening', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail($id_rekening)
    {
        $this->db->select('*');
        $this->db->from('rekening');
        $this->db->where('id_rekening', $id_rekening);
        $this->db->order_by('id_rekening', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function tambah($data)
    {
        $this->db->insert('rekening', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_rekening', $data['id_rekening']);
        $this->db->update('rekening', $data);
    }

    public function hapus($data)
    {
        $this->db->where('id_rekening', $data['id_rekening']);
        $this->db->delete('rekening', $data);
    }

    // public function read($slug_rekening)
    // {
    //     $this->db->select('*');
    //     $this->db->from('rekening');
    //     $this->db->where('slug_rekening', $slug_rekening);
    //     $this->db->order_by('id_rekening', 'desc');
    //     $query = $this->db->get();
    //     return $query->row();
    // }


    // public function login($nama_rekening, $password)
    // {
    //     $this->db->select('*');
    //     $this->db->from('rekening');
    //     $this->db->where(array(
    //         'nama_rekening'  => $nama_rekening,
    //         'password'  => SHA1($password)
    //     ));
    //     $this->db->order_by('id_rekening', 'desc');
    //     $query = $this->db->get();
    //     return $query->row();
    // }
}

/* End of file Rekening_model.php */
