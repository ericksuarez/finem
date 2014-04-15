<?php

Class Contrato_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model', 'gral');
        $this->load->model('expediente_model', 'exp');
    }
    
    public function construye_caratula($id_expediente, $config){
        $this->load->library('contrato_pdf');
        $info = FALSE;
        
        $tmp = $this->exp->getExpediente($id_expediente);
        $info = $this->exp->getAllInfo($tmp[0], 'contrato_pdf');
        $info['expediente'] = $tmp[0];
        
        //print_r($info); break;        
        
        $this->contrato_pdf->abre_documento();
        $this->contrato_pdf->caratula($info, $config);
        $this->contrato_pdf->nueva_hoja();
        $this->contrato_pdf->firmas();
        $this->contrato_pdf->direcciones();
        $this->contrato_pdf->cierra_documento();
    }

    public function construye_contrato() {

        $this->load->library('contrato_pdf');
        
        
        //print_r($info); break;        
        
        $this->contrato_pdf->abre_documento();
        $this->contrato_pdf->machote();        
        $this->contrato_pdf->direcciones();
        $this->contrato_pdf->cierra_documento();
    }
    
    public function construye_pagare($id_expediente,$numero){
        if($numero == 0){
            show_404();
        }else{
            $this->load->library('pagare_pdf');
            $info = FALSE;

            $tmp = $this->exp->getExpediente($id_expediente);
            $info = $this->exp->getAllInfo($tmp[0], 'contrato_pdf');
            $info['expediente'] = $tmp[0];
            $tabla = $this->exp->get_tabla_pagos($tmp[0]['idexpediente'],'pagos',$numero);
            
            $pagare = $this->exp->get_pagare($tmp[0]['idexpediente'],$numero);
            
            $x = $this->exp->get_contrato($tmp[0]['idexpediente'],'fecha_suscripcion');
            if($numero == 1){
                $c = $x;
                //print_r($c);
                $info['contrato']['fecha_suscripcion'] = $c['fecha_suscripcion'];
                $info['contrato']['fecha_vencimiento'] = $pagare['fecha_vencimiento'];
                $info['contrato']['plazo_credito'] = $pagare['plazo'];
                //$numero_real = 0;
            }else{
                
                $c = $pagare;
                $info['contrato']['fecha_suscripcion'] = $pagare['fecha_suscripcion'];
                $info['contrato']['fecha_primer_pago'] = $pagare['fecha_primer_pago'];
                $info['contrato']['fecha_vencimiento'] = $pagare['fecha_vencimiento'];
                $info['contrato']['plazo_credito'] = $pagare['plazo'];
                $info['contrato']['primer_disposicion'] = $pagare['importe'];
                $info['contrato']['adeudo_universidad'] = $pagare['adeudo'];
                //$numero_real = resta_fechas($pagare['fecha_suscripcion'], $x['fecha_suscripcion']);
            }
            
            //$numero_real = $this->get_last_plazo($tmp[0]['idexpediente'], $numero);
            $numero_real = $this->get_last_plazo($pagare['fecha_suscripcion'], $x['fecha_suscripcion']);
            //echo $numero_real;
            //print_r($info);         

            $this->pagare_pdf->abre_documento();
            $this->pagare_pdf->dinamico($info);
            $this->pagare_pdf->tabla_pagos($tabla,$c['fecha_suscripcion'],$numero_real);
            $this->pagare_pdf->machote();
            //$this->pagare_pdf->nueva_hoja();
            $this->pagare_pdf->firmas();
            $this->pagare_pdf->cierra_documento();
        }
        
    }
    
    public function construye_tabla_pagos($id_expediente){
        $this->load->library('contrato_pdf');
        
        $info = FALSE;
        
        //$tmp = $this->exp->getExpediente($id_expediente);
        //$info = $this->exp->getAllInfo($tmp[0], 'contrato_pdf');
        //$info['expediente'] = $tmp[0];
        
        $tabla = $this->exp->get_tabla_pagos($id_expediente,date('Y-m-d'));
        //print_r($info); break;        
        //echo $id_expediente;
        //echo $this->db->last_query();
        $this->contrato_pdf->abre_documento();
        $this->contrato_pdf->tabla_pagos_subida($tabla);
        $this->contrato_pdf->cierra_documento();
    }
    
    public function get_last_plazo($fecha_pagare,$fecha_contrato){
        
        
            $query = "select period_diff(date_format('$fecha_pagare', '%Y%m'), date_format('$fecha_contrato', '%Y%m')) as plazo;";
            //$this->db->where(array('expediente_idexpediente' => $idexpediente,'numero <' => $numero));
            //$this->db->select_sum('plazo');
            //$q = $this->db->get('pagare');
            $q = $this->db->query($query);
            //echo $this->db->last_query();
            $tmp = $q->result_array();
            //print_r($tmp);
            /*if($numero > 2){
                $i = 2;
                while($i < $numero){
                    $tmp[0]['plazo']++;
                    $i++;
                }
            }*/
        
        
        return ($tmp[0]['plazo'] == NULL) ? 0 : $tmp[0]['plazo'];
    }
}

/* End of file contrato_model.php */
/* Location: ./application/models/contrato_model.php */