<?php

Class MY_form_validation extends CI_Form_validation {
    
    public function __construct($rules = array()) {
        parent::__construct($rules);
    }
    
    public function valida_fechas_unix($str){
        $preg = '/^(([0-9]{4,4}))[\-](0[1-9]|10|1[12])[\-](0[1-9]|[12][0-9]|3[01])$/';        
        if (preg_match($preg, $str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function valida_fechas_esp($str) {
        
        $preg = '/^(0[1-9]|[12][0-9]|3[01])[\-](0[1-9]|10|1[12])[\-](([0-9]{4,4}))$/';        
        if (preg_match($preg, $str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function valida_moneda($str) {
        $preg= '/^-?\$?(?:\d+|\d{1,3}(?:,\d{3})*)(?:\.\d{1,2}){0,1}$/';
        
        if (is_array($str)) {
            
            foreach($str as $llave => $string){
                
                if (preg_match($preg, $string)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
            
        } else {
            
            if (preg_match($preg, $str)) {
                return TRUE;
            } else {
                return FALSE;
            }            
        }    
    }
    
    
}
?>
