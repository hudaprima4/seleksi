<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cek_email($id) {
        $this->db->select("email");
        $this->db->from("daftar_pegawai");
        $this->db->where("nip", $id);
        $get = $this->db->get();
        if ($get->num_rows() > 0) {
            return $get->unbuffered_row();
        }
    }
    
    function update_email($data = array(), $nip) {
        $this->db->update("daftar_pegawai", $data, array('nip' => $nip));
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
