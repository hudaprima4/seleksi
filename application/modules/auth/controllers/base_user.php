<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class base_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('pegawai_model');

        $config = $this->pegawai_model->get_con('configuration');

        define('tahap_skpd', $config[10]->value);


        if ($this->session->userdata('pegawai_nip')) {
            $username = $this->session->userdata('peg_uniq_kode');
        } else {
            $username = null;
        }

        $data['cekRole'] = array(
            'role_uniq_kode' => '11',
            'user_uniq_kode' => $username
        );

        $data['roleygdicocokin'] = array(
            'name' => 'SKPD'      //ganti ini untuk role yg lain
        );
        //var_dump($data['cekRole']);die();
        $data['role'] = $this->pegawai_model->view('user_role', $data['cekRole']);


        $data['lstRole'] = $this->pegawai_model->view('role', $data['roleygdicocokin']);

        if (tahap_skpd == '2' or tahap_skpd == '4') {
            if ($this->uri->segment(1) == 'dpa') {
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
            }else{
                
            }
        } elseif (tahap_skpd == '0' or tahap_skpd == '1') {
            if ($this->uri->segment(1) == 'skpd') {
                if ($data['role'][0]->role_uniq_kode == $data['lstRole'][0]->uniq_kode) {
                    print_r($this->uri->segment());
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
            }else{
                
            }
        }else{
            redirect('nonapl');
        }
    }

}

?>
