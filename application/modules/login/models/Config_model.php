<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function get($tablename){
        $query = $this->db->get($tablename);
        return $query->result();
    }
    
    function insert($tablename,$data){
		$query=$this->db->insert($tablename, $data); 
		
		return $query;
	}
	
	function delete($tablename,$data){
		$query=$this->db->delete($tablename,$data);
		
		return $query;
	}
	
	function view($tablename,$data){
		$this->db->where($data);
		$query=$this->db->get($tablename); 
		
		return $query->result();
	}
	
	function update($tablename,$data,$id){
		$this->db->where('id', $id);
		$query=$this->db->update($tablename, $data); 
		
		return $query;
	}
	
	function getKey($key){
		$data=array("config"=>$key);
		
		$this->db->where($data);
		$query=$this->db->get('configuration'); 
		
		return $query->result();
	}
	
	function genKey(){
		$sql="select gen_salt('bf',8) as \"key\"";
		$query=$this->db->query($sql,FALSE);
		
		return $query->result();
	}
	
	function setKey($data,$id){
		$this->db->where('id', $id);
		$query=$this->db->update('configuration', $data); 
		
		return $query;
	}
}
