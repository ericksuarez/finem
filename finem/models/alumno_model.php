<?php

class Alumno_model extends CI_Model {
    
    public function get($idalumno){
        $q = $this->db->get_where('alumno',array('idalumno' => $idalumno));
        
        if($q->num_rows() > 0){
            $tmp = $q->result_array();
        }else{
            $tmp[0] = array();
        }
        return $tmp[0];
    }
    
    public function get_domicilio($idalumno){
        $q = $this->db->get_where('domicilio',array('alumno_idalumno' => $idalumno));
        
        if($q->num_rows() > 0){
            $tmp = $q->result_array();
        }else{
            $tmp[0] = array();
        }
        return $tmp[0];
    }
    
    public function get_trabajo($tiene_trabajo,$idalumno){
        if($tiene_trabajo=='SI'){
            $q = $this->db->get_where('trabajo',array('alumno_idalumno' => $idalumno));

            if($q->num_rows() > 0){
                $tmp = $q->result_array();
            }else{
                $tmp[0] = array();
            }
        }else{
            $tmp[0] = array();
        }
        return $tmp[0];
    }
    
    function get_aval($idalumno,$iteracion=NULL,$campos='*'){
        
        $this->db->select($campos);
        $q = $this->db->get_where('aval',array('alumno_idalumno' => $idalumno));
            
        if($iteracion == NULL){
            if($q->num_rows() > 0){
                $tmpx = $q->result_array();
                //print_r($tmpx);
            }else{
                $tmpx[0] = array();
                $tmpx[1] = array();
            }
            
            return $tmpx;
        }else{
            //echo $iteracion-1;
            

            if($q->num_rows() > 0){
                $tmpx = $q->result_array();
                //print_r($tmpx);
            }else{
                $tmpx[$iteracion-1] = array();
            }
            
            return $tmpx[$iteracion-1];
        }
    }
    
    
    
    
    
}