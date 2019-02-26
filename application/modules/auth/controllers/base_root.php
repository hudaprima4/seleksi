<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class base_root extends CI_Controller {

    function __construct() {
    	parent::__construct();
    	$nipnya = $this->session->userdata('pegawai_nip');
    	if(!isset($nipnya)){
    		redirect('login','refresh');
    	}else{
    		

	        $this->load->model('pegawai_model');

	        if ($this->session->userdata('pegawai_nip')) {
	            $username = $this->session->userdata('peg_uniq_kode');
	        } else {
	            $username = null;
	        }

	        $data['cekRole'] = array(
	            'role_uniq_kode' => $this->session->userdata('approle'),
	            'user_uniq_kode' => $username
	        );

	        $data['roleygdicocokin'] = array(
	            'name' => 'SUPERADMIN'      //ganti ini untuk role yg lain
	        );

	        $data['role'] = $this->pegawai_model->view('user_role', $data['cekRole']);

	        $data['lstRole'] = $this->pegawai_model->view('role', $data['roleygdicocokin']);

	        if ($data['role'][0]->role_uniq_kode == $data['lstRole'][0]->uniq_kode) {
	            //klo berhasil login gak usah redirect
	        } else {
	            /* if(isset($_SERVER['HTTP_REFERER'])){

	              //$this->output->set_header('refresh:3; url='.$_SERVER['HTTP_REFERER']);//redirect
	              redirect('nonapl');
	              }ELSE{
	              redirect('nonapl');
	              } */
	            redirect('nonapl');
	        }
    	}
        
    }

}

?>
