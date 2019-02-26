<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get($tablename) {
        $query = $this->db->get($tablename);
        return $query->result();
    }

     function get_con($tablename) {
        $this->db->order_by('id','asc');
        return  $this->db->get($tablename)->result();

        // return $query->result();
    }

    function insert($tablename, $data) {
        $query = $this->db->insert($tablename, $data);

        return $query;
    }

    function delete($tablename, $data) {
        $query = $this->db->delete($tablename, $data);

        return $query;
    }

    function view($tablename, $data) {
        $this->db->where($data);
        $query = $this->db->get($tablename);

        return $query->result();
    }

    function update($tablename, $data, $uniq_kode) {
        $this->db->where('uniq_kode', $uniq_kode);
        $query = $this->db->update($tablename, $data);

        return $query;
    }

    function updateNIP($tablename, $data, $uniq_kode) {
        $this->db->where('nip', $uniq_kode);
        $query = $this->db->update($tablename, $data);

        return $query;
    }

    function updateUserName($tablename, $data, $uniq_kode) {
        $this->db->where('name', $uniq_kode);
        $query = $this->db->update($tablename, $data);

        return $query;
    }

    function createUser($tableName, $username, $password, $keyEnc) {
        $this->db->set('name', $username);
        $this->db->set('password', "crypt('$password','$keyEnc')", FALSE);

        $this->db->insert($tableName);
    }

    function cekPass($tableName, $username, $password, $keyEnc) {
        $this->db->where('name', $username);
        $this->db->where('password', "crypt('$password','$keyEnc')", FALSE);
        $query = $this->db->get($tableName);

        return $query->num_rows();
    }

    function updatePass($tableName, $username, $password, $keyEnc) {
        $sql = "update \"$tableName\"
		set \"password\"=crypt('$password', '$keyEnc')
		where \"name\"='$username'";

        $query = $this->db->query($sql);
        return $query;
    }

}
