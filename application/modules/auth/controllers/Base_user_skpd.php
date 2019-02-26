<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'modules/auth/controllers/Base_global.php');

class base_user_skpd extends base_global {

    function __construct() {
        parent::__construct();
        $config = $this->Pegawai_model->view('configuration', array('config' => 'tahap_skpd'));
        $tahun = $this->Pegawai_model->view('configuration', array('config' => 'tahun'));

        define('CONS_TAHAP', $config[0]->value);
        define('CONS_TAHUN', $tahun[0]->value);
        
        $tahap=1;
        // if (CONS_TAHAP == '0' or $tahap == '1') {
            
        // } else {
        //     redirect('dpa/home');
        // }


//        if (CONS_TAHAP == '0' or CONS_TAHAP == '1') {
//            
//        } else {
//            redirect('dpa/home');
//        }
    }

}

?>
