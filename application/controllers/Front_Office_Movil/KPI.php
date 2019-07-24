<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KPI extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Dao_bitacoras_model');
    }

    public function Control() {
        $data = array(
            'active_sidebar' => false,
            'title' => 'FO Movil Control KPI',
            'active' => 'ccili',
            'sub_bar' => true,
        );
        $this->load->view('parts/header', $data);
        $this->load->view('Front_Office_Movil/Control');
        $this->load->view('parts/footer');
    }

}
/* End of file Bitacoras.php */
?>
