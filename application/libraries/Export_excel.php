<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";
 
class Export_excel extends PHPExcel {
    function __construct() {
		  parent::__construct();
    }
}