<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "/third_party/fpdf.php";

class Export_pdf extends FPDF
{
    public function __construct($orientation = 'L', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }
}
