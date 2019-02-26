<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penerimaan_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($tablename) {
        $query = $this->db->get($tablename);
        return $query->result();
    }

    function view_1($tablename, $data) {
        $this->db->where($data);
        $query = $this->db->get($tablename);
        return $query->result();
    }

    function single_view($tablename, $data = '', $select = '') {
        if ($select !== '') {
            $this->db->select($select);
        }
        if ($data !== '') {
            $this->db->where($data);
        }
        $query = $this->db->get($tablename);
        return $query->row();
    }

    function update($tablename, $where, $kolom) {
        $this->db->where($where);
        return $this->db->update($tablename, $kolom);
    }

     public function save($table,$data) {
        $this->db->insert($table, $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function get_daftar(){
        return $this->db->query("SELECT no,opd.nama AS nama_opd, barang.nama AS nama_barang, CONCAT(jumlah,' ', satuan) as jml, harga, jumlah * harga AS total FROM penerimaan JOIN opd ON penerimaan.id_opd = opd.id JOIN barang ON penerimaan.id_barang = barang.id")->result();
    }

    function get_max(){
        return $this->db->query("SELECT MAX(LEFT(no,3)) FROM penerimaan")->result();
    }

    function get_kode($id){
        return $this->db->query("SELECT CONCAT('00',(SELECT MAX(LEFT(no,3)) FROM penerimaan),'/M/',opd.kode,'/', CASE WHEN month(tanggal) = 1 THEN 'I' WHEN month(tanggal) = 2 THEN 'II' WHEN month(tanggal) = 3 THEN 'III' WHEN month(tanggal) = 4 THEN 'IV' WHEN month(tanggal) = 5 THEN 'V' WHEN month(tanggal) = 6 THEN 'VI' WHEN month(tanggal) = 7 THEN 'VII' WHEN month(tanggal) = 8 THEN 'VIII' WHEN month(tanggal) = 9 THEN 'IX' WHEN month(tanggal) = 10 THEN 'X' WHEN month(tanggal) = 11 THEN 'XI' ELSE 'XII' END ,'/',year(tanggal)) AS no FROM penerimaan JOIN opd ON penerimaan.id_opd = opd.id WHERE penerimaan.id = $id")->result();
    }

    function get_kode_pengeluaran($id){
        return $this->db->query("SELECT CONCAT('00',(SELECT MAX(LEFT(no,3)) FROM pengeluaran),'/K/',opd.kode,'/', CASE WHEN month(tanggal) = 1 THEN 'I' WHEN month(tanggal) = 2 THEN 'II' WHEN month(tanggal) = 3 THEN 'III' WHEN month(tanggal) = 4 THEN 'IV' WHEN month(tanggal) = 5 THEN 'V' WHEN month(tanggal) = 6 THEN 'VI' WHEN month(tanggal) = 7 THEN 'VII' WHEN month(tanggal) = 8 THEN 'VIII' WHEN month(tanggal) = 9 THEN 'IX' WHEN month(tanggal) = 10 THEN 'X' WHEN month(tanggal) = 11 THEN 'XI' ELSE 'XII' END ,'/',year(tanggal)) AS no FROM pengeluaran JOIN opd ON pengeluaran.id_opd = opd.id WHERE pengeluaran.id = $id")->result();
    }
    

}
