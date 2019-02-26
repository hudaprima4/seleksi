<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'modules/auth/controllers/Base_global.php');

class base_user_dpa extends base_global {

    function __construct() {
        parent::__construct();

        $this->load->model('Pegawai_model');

        $config = $this->Pegawai_model->get_con('configuration');

        // echo "<pre>";
        // print_r($config);die();
//        $a=$config[10]->value;
//        //echo $a;
//        define('tahap_skpd1', $a);
//       
//        define('tanggal_dpa', $config[11]->value);
//        define('tanggal_dpa_rincian', $config[12]->value);

        $config = $this->Pegawai_model->view('configuration', array('config' => 'tahap_skpd'));
        $tahun = $this->Pegawai_model->view('configuration', array('config' => 'tahun'));
        $tanggal_dpa= $this->Pegawai_model->view('configuration',array('config'=>'tanggal_dpa'));
        $tanggal_dpa_rincian=$this->Pegawai_model->view('configuration',array('config'=>'tanggal_dpa_rincian'));

        define('CONS_TAHAP', $config[0]->value);
        define('CONS_TAHUN', $tahun[0]->value);
        define('tanggal_dpa',$tanggal_dpa[0]->value);
        define('tanggal_dpa_rincian', $tanggal_dpa_rincian[0]->value);


        $tahap_skpd = '2';
        if ($tahap_skpd == '2' or CONS_TAHAP == '4') {
            
        } else {
            redirect('skpd/home');
        }
    }

}

?>
