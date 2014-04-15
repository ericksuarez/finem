<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carta extends CI_Controller {

    public function __construct() {

        parent::__construct();
        /* Verifica el browswer del usuario (por ie8 más que nada) */
        $this->load->library('user_agent');

        // SE CARGA EL MODELO PARA LA INFORMACIÓN DEL CONTRATO.
        $this->load->model('carta_model', 'carta');

        /* Verificar la sesión */
        //$this->phpsession->save('last_url','hola');
    }

    public function index() {
        
    }

    public function compromiso($id = 0){
        $this->carta->compromiso($id);
    }
    
    public function bienvenida($id = 0){
        $this->carta->bienvenida($id);
    }
    
    public function cobranza($id = 0,$pagare = 1){
        $this->carta->cobranza($id,$pagare);
    }
    
    public function liberacion($id = 0,$pagare = 1){
        $this->carta->liberacion($id,$pagare);
    }

}

/* End of file contrato.php */
/* Location: ./application/controllers/contrato.php */