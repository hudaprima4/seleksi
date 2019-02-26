<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    protected $processId = 0;
    protected $header = '';
    protected $footer = '';
    static $errorMsg = '';
    public $page_counter = 1;
    public $isLastPage = false;

    /**
     * This method is used to override the parent class method.
     * */
    public function Header() {
        $this->SetTopMargin($this->GetY());
        $this->writeHTMLCell($w = '', $h = '', $x = '', $y = '', $this->header, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);
        $this->SetLineStyle(array('width' => 0.40, 'color' => array(153, 204, 0)));

        $this->Line(5, 5, $this->getPageWidth() - 5, 5);

        $this->Line($this->getPageWidth() - 5, 5, $this->getPageWidth() - 5, $this->getPageHeight() - 5);
        $this->Line(5, $this->getPageHeight() - 5, $this->getPageWidth() - 5, $this->getPageHeight() - 5);
        $this->Line(5, 5, 5, $this->getPageHeight() - 5);
    }

    public function lastPage($resetmargins = false) {
        $this->setPage($this->getNumPages(), $resetmargins);
        $this->isLastPage = true;
    }

    public function Footer() {
        // Position at 15 mm from bottom
        //$this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'B', 8);
        // Page number
        $halaman = $this->PageNo();
        if (isset($_POST["hal"]) && !empty($_POST["hal"]) && $this->isLastPage) {
            $this->Cell(0, 12, ($halaman - 1) + $_POST["hal"], 0, 0, 'C', 0, '', 0, false, 'T', 'M');
        } else if (isset($_POST["hal"]) && !empty($_POST["hal"])) {
            $this->Cell(0, 12, ($halaman - 1) + $_POST["hal"], 'T', 0, 'C', 0, '', 0, false, 'T', 'M');
        } else if (!isset($_POST["hal"]) && empty($_POST["hal"]) && $this->isLastPage) {
            $this->Cell(0, 12, ($halaman - 1) + 1, 0, 0, 'C', 0, '', 0, false, 'T', 'M');
        } else {
            $this->Cell(0, 12, ($halaman - 1) + 1, 'T', 0, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
