<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contrato extends CI_Controller {

    public function __construct() {

        parent::__construct();
        /* Verifica el browswer del usuario (por ie8 más que nada) */
        $this->load->library('user_agent');

        // SE CARGA EL MODELO PARA LA INFORMACIÓN DEL CONTRATO.
        $this->load->model('contrato_model', 'contrato');

        /* Verificar la sesión */
        //$this->phpsession->save('last_url','hola');
    }

    public function index() {
        
    }

    /**
     * GENERACIÓN DEL CONTRATO EN PDF.
     * 
     * @param int $id Identificador de expediente
     */
    public function pdf() {
        
        $this->contrato->construye_contrato();
    }
    
    public function caratula($id=0) {

        $config['estado_civil'] = $this->config->item('estado_civil');
        $config['nivel_estudios'] = $this->config->item('nivel_estudios');
        $this->contrato->construye_caratula($id, $config);
    }
    
    public function pagare($id=0,$numero=0){
        $this->contrato->construye_pagare($id,$numero);
    }
    
    public function tabla_pagos($id=0){
        $this->contrato->construye_tabla_pagos($id);
    }
    
    public function prueba($idexpediente,$numero){
        echo $this->contrato->get_last_plazo($idexpediente,$numero);
    }

}

/* End of file contrato.php */
/* Location: ./application/controllers/contrato.php */