<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sql extends CI_Model {
	
	public function __construct(){
        parent::__construct();
    }

    public function count_all($table){
        $row = 0;
        $this->db->select('*');
        $this->db->from($table);
        if(session('user_level') == 'GU' && $table == 'dusun'){
            $this->db->where('dus_desid', session('desid'));
        }
        if(session('user_level') == 'GU' && $table == 'desa'){
            $this->db->where('desid', session('desid'));
        }
        if(session('user_level') == 'GU' && $table == 'kecamatan'){
            $this->db->where('kecid', session('kecid'));
        }
        if(session('user_level') == 'GU' && $table == 'kabupaten'){
            $this->db->where('kabid', session('kabid'));
        }
        $get = $this->db->get();
        if($get->num_rows() > 0){
            $row = $get->num_rows();
        }
        return $row;
    }
    
    public function select_row($sql=''){
        $sql = $this->db->query($sql);
        if($sql->num_rows() > 0){
            return $sql->row();
        }
        return array();
    }
    
    public function select_row_array($sql=''){
        $sql = $this->db->query($sql);
        if($sql->num_rows() > 0){
            return $sql->row_array();
        }
        return array();
    }
    
    public function select_result($sql=''){
        $sql = $this->db->query($sql);
        if($sql->num_rows() > 0){
            return $sql->result();
        }
        return array();
    }
    
    public function select_result_array($sql=''){
        $sql = $this->db->query($sql);
        if($sql->num_rows() > 0){
            return $sql->result_array();
        }
        return array();
    }
    
    public function insert($sql=''){
        $this->db->query($sql);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
    
    public function update($sql=''){
        $this->db->query($sql);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
    
    public function delete($sql=''){
        $this->db->query($sql);
        if($this->db->affected_row() == 0){
            return true;
        }
        return false;
    }

}

