<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class barcode extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function set_barcode($code) {
        $kode = str_replace("-", "/", $code);
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $kode, 'drawText' => true,'barHeight'=> 60,"barThickWidth"=> 4,"barThinWidth"=> 2,"fontSize" => 14,"withBorder"=> true), array('imageType' => 'jpg', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle'));
    }

}

/* End of file  */
/* Location: ./application/controllers/ */