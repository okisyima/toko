<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {
        // validasi
        $this->form_validation->set_rules('username', 'Username', 'required', array('required' => '%s harus diisi'));

        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s harus diisi'));

        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // proses ke simple login
            $this->simple_login->login($username, $password);
        }
        // end validasi

        $data = array('title' => 'Login Administrator');
        $this->load->view('login/list', $data, FALSE);
    }

    public function logout()
    {
        // ambil dari fungsi logout di simplelogin
        $this->simple_login->logout();
    }
}

/* End of file Login.php */
