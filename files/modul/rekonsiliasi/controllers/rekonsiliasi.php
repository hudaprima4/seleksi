<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekonsiliasi extends Base_Controller {

    public function index() {
        $this->content = 'daftar';
        $this->view();
    }

    public function tambah() {
        $this->load->view('rekonsiliasi/form');
    }

    public function edit() {
        $this->load->view('rekonsiliasi/form');
    }

}
