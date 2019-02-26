<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_portrait_tr4 extends TCPDF {

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
        // Position at 15 mm from bottom
        if ($this->page == 1) {
//            $this->SetY(-393);
            $this->SetY(-398);
        } else {
//            $this->SetY(-434);
            $this->SetY(-439);
        }
        // Set font
        $this->SetFont('helvetica', 'N', 10);
        // Page number
        $halaman = $this->PageNo();
        if (isset($_POST["hal"]) && !empty($_POST["hal"]) && $this->isLastPage) {
            $this->Cell(0, 12, "Hal " . (($halaman - 1) + $_POST["hal"]), 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        } else if (isset($_POST["hal"]) && !empty($_POST["hal"])) {
            $this->Cell(0, 12, "Hal " . (($halaman - 1) + $_POST["hal"]), 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        } else if (!isset($_POST["hal"]) && empty($_POST["hal"]) && $this->isLastPage) {
            $this->Cell(0, 12, "Hal " . (($halaman - 1) + 1), 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        } else {
            $this->Cell(0, 12, "Hal " . (($halaman - 1) + 1), 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        }
    }
    
    public function Header2() {
        // Position at 15 mm from bottom
        if ($this->page == 1) {
            $this->SetY(-393);
        } else {
            $this->SetY(-434);
        }
        // Set font
        $this->SetFont('helvetica', 'N', 10);
        // Page number
        $halaman = $this->PageNo();
        if (isset($_POST["hal"]) && !empty($_POST["hal"]) && $this->isLastPage) {
            $this->Cell(0, 12, "Hal " . $halaman, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
            $_SESSION["lastpage"] = $halaman;
        } else if (isset($_POST["hal"]) && !empty($_POST["hal"])) {
            $this->Cell(0, 12, "Hal " . $halaman, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
            $_SESSION["lastpage"] = $halaman;
        } else if (!isset($_POST["hal"]) && empty($_POST["hal"]) && $this->isLastPage) {
            $this->Cell(0, 12, "Hal " . $halaman, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
            $_SESSION["lastpage"] = $halaman;
        } else {
            $this->Cell(0, 12, "Hal " . $halaman, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
            $_SESSION["lastpage"] = $halaman;
        }
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
            $this->Cell(0, 12, false, 0, 0, 'C', 0, '', 0, false, 'T', 'M');
        } else if (isset($_POST["hal"]) && !empty($_POST["hal"])) {
            $this->Cell(0, 12, false, 'T', 0, 'C', 0, '', 0, false, 'T', 'M');
        } else if (!isset($_POST["hal"]) && empty($_POST["hal"]) && $this->isLastPage) {
            $this->Cell(0, 12, false, 0, 0, 'C', 0, '', 0, false, 'T', 'M');
        } else {
            $this->Cell(0, 12, false, 'T', 0, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
