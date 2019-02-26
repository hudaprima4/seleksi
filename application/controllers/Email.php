<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array("Email_model"));

        $this->tahun = TAHUN;
        $this->tahap = '2';
    }

    public function verification_email() {
        $appid = $_GET['appid'];
        $id = dekripsi($_GET['appid']);
        $this->data['cek_email'] = $this->Email_model->cek_email($id);
        //print_r($this->data['cek_email']);
        $kode = get_string($this->data['cek_email']->email, "#");
        $email = before("#", $this->data['cek_email']->email);
        $arrData = array(
            'email' => trim($email)
        );
        if ($appid == $kode) {
            if ($this->Email_model->update_email($arrData, $id) == true) {
                echo "E-mail Anda berhasil diverifikasi.";
            } else {
                echo "Maaf email tidak ditemukan.";
            }
        } else {
            echo "Maaf email tidak ditemukan.";
        }
    }
    
    public function reset_password(){
        
    }

}
