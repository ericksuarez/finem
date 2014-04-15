<?php

Class Carta_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model', 'gral');
        $this->load->model('expediente_model', 'exp');
    }
    
    public function compromiso($id_expediente){
        $this->load->library('carta_pdf');
        $info = FALSE;
        
        $tmp = $this->exp->getExpediente($id_expediente);
        $info['expediente'] = $tmp[0];
        $folio = $this->exp->getFolio($id_expediente);
        $this->carta_pdf->abre_documento();
        $this->carta_pdf->creaEncabezado(date('Y-m-d'),$tmp[0]['universidad_iduniversidad'],$folio);
        $this->carta_pdf->compromiso($info);
        $this->carta_pdf->creaPie($tmp[0]['alumno_idalumno']);
        $this->carta_pdf->cierra_documento();
    }
    
    public function bienvenida($id_expediente){
        $this->load->library('carta_pdf');
        $info = FALSE;
        
        $tmp = $this->exp->getExpediente($id_expediente);
        $info['expediente'] = $tmp[0];
        $folio = $this->exp->getFolio($id_expediente);
        
        $this->carta_pdf->abre_documento();
        $this->carta_pdf->creaEncabezado(obtener_campo('fecha_suscripcion.contrato','expediente_idexpediente.'.$id_expediente),0,$folio);
        $this->carta_pdf->bienvenida($info['expediente']);
        $this->carta_pdf->cierra_documento();
    }
    
    public function cobranza($id_expediente,$numero){
        $this->load->library('carta_pdf');
        $info = FALSE;
        
        $tmp = $this->exp->getExpediente($id_expediente);
        $info['expediente'] = $tmp[0];
        $pagare = ($numero > 1) ? $this->exp->get_pagare($id_expediente,$numero) : NULL;
        $folio = $this->exp->getFolio($id_expediente);
        
        $this->carta_pdf->abre_documento();
        $this->carta_pdf->creaEncabezado(date('Y-m-d'),0,$folio);
        $this->carta_pdf->cobranza($info['expediente'],$pagare);
        $this->carta_pdf->cierra_documento();
    }
    
    public function liberacion($id_expediente,$numero){
        $this->load->library('carta_pdf');
        $info = FALSE;
        
        $tmp = $this->exp->getExpediente($id_expediente);
        $info['expediente'] = $tmp[0];
        $folio = $this->exp->getFolio($id_expediente);
        $pagare = ($numero > 1) ? $this->exp->get_pagare($id_expediente,$numero) : NULL;
        
        $this->carta_pdf->abre_documento();
        $this->carta_pdf->creaEncabezado(date('Y-m-d'),0,$folio);
        $this->carta_pdf->liberacion($info['expediente'],$pagare);
        $this->carta_pdf->cierra_documento();
    }
}

/* End of file contrato_model.php */
/* Location: ./application/models/contrato_model.php */