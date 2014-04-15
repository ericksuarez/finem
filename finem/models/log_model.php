<?php

class Log_model extends CI_Model {
    
    /**
     * Ingresa un registro al log.
     * 
     * @param string $seccion Seccion donde se realiza
     * @param string $accion Accion que se esta haciendo
     * @param integer $usuario ID del usuario
     * @param integer $matricula Id del expediente
     * @param string $comentario Opcional
     */
    public function guardar($seccion,$accion,$usuario,$matricula,$comentario=NULL){
        
        $data = array(
            'usuario_idusuario' => $usuario,
            'accion' => $accion,
            'seccion' => $seccion,
            'matricula' => $matricula,
            'comentario' => $comentario
        );
        
        $this->db->insert('log',$data);
    }
    
    public function get($seccion,$expediente,$limit=5){
        $this->db->order_by('fecha','DESC');
        $this->db->join('usuario','usuario_idusuario = idusuario');
        $q = $this->db->get_where('log',array('matricula'=>$expediente,'seccion'=>$seccion),$limit);
        
        if($q->num_rows() > 0){
            return $q->result_array();
        }else{
            return array();
        }
    }
    
    public function get_by_accion($accion,$expediente,$limit=5){
        $this->db->order_by('fecha','DESC');
        $this->db->join('usuario','usuario_idusuario = idusuario');
        $q = $this->db->get_where('log',array('matricula'=>$expediente,'accion'=>$accion),$limit);
        
        if($q->num_rows() > 0){
            return $q->result_array();
        }else{
            return array();
        }
    }
    
   public function get_all($expediente){
       $this->db->order_by('fecha','DESC');
        $this->db->join('usuario','usuario_idusuario = idusuario');
        $q = $this->db->get_where('log',array('matricula'=>$expediente));
        
        if($q->num_rows() > 0){
            return $q->result_array();
        }else{
            return array();
        }
   }
    
    
    
    
    
}