<?php

class Layout_model extends CI_Model {
    
    public function subir_cobranza($post){
        $path = 'uploads/layouts/cobranza';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '800';
        $config['file_name'] = 'layout_cobranza' . date('YmdHis');
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('cobranza')) {
            $data['acierto'] = FALSE;
            $data['msj'] = $this->upload->display_errors();
            //echo $this->upload->display_errors();
            //print_r($_FILES);                    
            //$this->phpsession->flashsave('error', $this->upload->display_errors());
        } else {
            $img = $this->upload->data();
            $acierto = TRUE;
            $archivo = $this->actualizar_base('cobranza',$img['file_name'],$post['fecha_dos']);
            
            if($archivo['acierto'] === FALSE){
                $data['acierto'] = FALSE;
                $data['msj'] = $archivo['msj'];
            }else{
                $data['acierto'] = TRUE;
                $data['msj'] = $archivo['msj'];
            }
        }
        
        return $data;
    }
    
    public function actualizar_base($tipo,$file_name,$fecha2 = ''){
        $path = 'uploads/layouts/'.$tipo.'/'.$file_name;
        
        $this->load->library('CSVReader');
        
        $csv = $this->csvreader->parse_file($path);
        //print_r($csv);
        //BREAK;
        $no_existe = '';
        $subida = date('Y-m-d H:i:s');
        
        if(isset($csv[0]['matricula']) && (isset($csv[0]['restante']) || isset($csv[0]['calificacion']) || isset($csv[0]['adeudo']) || isset($csv[0]['insoluto']))){
            //echo 'RIGHT';
            foreach($csv as $c){
                $test = $this->comprueba_matricula($c['matricula']);
                if($test > 0){
                    $data = NULL;
                    $this->crea_cobranza($test);
                    if(isset($c['restante'])){
                        $data['linea_restante'] = limpia_moneda($c['restante']);
                        $data['subida_restante'] = $subida;
                        
                    }
                    
                    if(isset($c['calificacion'])){
                        $data['calificacion'] = $c['calificacion'];
                        $data['subida_calificacion'] = $subida;
                    }
                    
                    if(isset($c['adeudo'])){
                        $data['adeudo'] = limpia_moneda($c['adeudo']);
                        $data['subida_adeudo'] = $subida;
                    }
                    
                    if(isset($c['insoluto']) && $c['insoluto'] != ''){
                        $data['saldo_insoluto'] = limpia_moneda($c['insoluto']);
                        $data['subida_insoluto'] = $subida;
                        if(!empty($fecha2)){
                            $data['subida_insoluto2'] = fecha_contrato($fecha2,'inverso');
                        }
                    }
                    
                    if($data != NULL && is_array($data)){
                        $this->db->where('expediente_idexpediente',$test);
                        $this->db->update('disposicion',$data);
                    }
                    
                    
                    
                }else{
                    $no_existe .= $c['matricula'].',';
                    
                }
                
                if($no_existe != ''){
                    
                    $this->phpsession->flashsave('error','Las matriculas '.$no_existe.' no se encontraron para su actualización.');
                }
                $data['acierto'] = TRUE;
                $data['msj'] = 'Cobranza ha sido actualizada con éxito.';
            }
            
        }else{
            //echo 'encabezados incorrectos';
            $data['acierto'] = FALSE;
            $data['msj'] = 'El archivo no tiene los encabezados correctos.';
        }
        
        return $data;
        //print_r($csv);
    }
    
    public function comprueba_matricula($mat){
        $q = $this->db->get_where('expediente',array('matricula' => $mat,'activo' => 'SI'));
        
        if($q->num_rows() > 0){
            $tmp = $q->result_array();
            return $tmp[0]['idexpediente'];
            
        }else{
            return 0;
        }
    }
    
    public function crea_cobranza($idexp){
        $q = $this->db->get_where('disposicion',array('expediente_idexpediente' => $idexp));
        
        if($q->num_rows() == 0){
            $this->db->insert('disposicion',array('expediente_idexpediente' => $idexp));
        }
    }
    
    public function template($tipo,$encabezados){
        $string = '';
        switch($tipo){
            
            case 'cobranza':
                $correctos = array('all','restante','calificacion','adeudo','insoluto');
                if(in_array($encabezados, $correctos)){
                    $this->load->model('expediente_model','expediente');
                    $mats = $this->expediente->getAllExpedientes('matricula');
                    if($encabezados == 'all'){
                        $string = 'matricula,restante,calificacion,adeudo,insoluto'."\n";
                    }elseif($encabezados == 'adeudo'){
                        $string = 'matricula,calificacion,adeudo'."\n";
                        
                    }else{
                        $string = 'matricula,'.$encabezados."\n";
                    }
                    if(!empty($mats)){
                       foreach($mats as $m){
                           $string .= '="'.$m['matricula'].'"'."\n";
                       } 
                    }
                }
                
                break;
            default:
                break;
        }
        return $string;
    }
}