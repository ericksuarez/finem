<?php

class Calculadora_model extends CI_Model {
    
    private $carrera;
    
    public function carga_datos_carrera($datos) {
        $this->carrera = $datos;
    }
    
    public function get_parametros(){
        $data['inicio_ciclo'] = 1;
        $data['tasa_anual'] = 13.90;
        $data['iva'] = 16;
        $data['periodo'] = 186;
        $data['anios'] = 15.5;
        $data['veces'] = 4;        
        return $data;
    }
    
    public function get_disposiciones($param){
        //$campos = 'numero_materias,costo_materia,semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
        //$carrera = $this->carrera->get_one($idcarrera,$campos);
        $carrera = $this->carrera;
        $disposiciones = array();
        
        $ciclos = ($carrera['marca_plan'] == 'semestral') ? $carrera['semestres'] : ( ($carrera['marca_plan'] == 'cuatrimestral') ? $carrera['cuatrimestres'] : $carrera['trimestres']);
        $mensualidades = $carrera['costo_total']/$ciclos;
        if($param['inicio_ciclo'] > 1){
            for($i = 1; $i < $param['inicio_ciclo'];$i++){
                $carrera['costo_total'] += -($mensualidades);
            }
        }
        
        $disposiciones['ministraciones'] = ($param['inicio_ciclo'] > 1) ? $ciclos - ($param['inicio_ciclo'] -1) : $ciclos;
        $disposiciones['periocidad'] = ($carrera['marca_plan'] == 'semestral') ? 6 : ( ($carrera['marca_plan'] == 'cuatrimestral') ? 4 : 3);
        $disposiciones['monto_previo'] = 0;
        $disposiciones['linea_credito'] = ($carrera['costo_total'] > 1000000) ? (1000000 * 100) / $carrera['costo_total'] : $carrera['costo_total'];
        $disposiciones['apertura_financiar'] = 0;
        $disposiciones['recurrentes_periodo'] = 0;
        $disposiciones['total_financiar'] = $disposiciones['linea_credito'] + $disposiciones['monto_previo'];
        $disposiciones['tasa'] = $param['tasa_anual'];
        $disposiciones['iva'] = $param['iva'];
        $disposiciones['plazo'] = $param['periodo'];
        
        if($disposiciones['monto_previo'] > 0){
            $a = ($param['veces'] * 10)/10 + 12/($disposiciones['periocidad'] * $disposiciones['ministraciones']);
            $b = (12*$param['anios']) / (10* $disposiciones['periocidad'] * $disposiciones['ministraciones']);
        }else{
            $a = ($param['veces'] * 10)/10;
            $b = (12*$param['anios']) / (10* $disposiciones['periocidad'] * $disposiciones['ministraciones']);
        }
        
        
        //echo $a.' '.$b;
        $disposiciones['plazo_carrera'] = elige_menor($a ,$b);
        $disposiciones['comision'] = 0.00;
        
        $i = 0;
        $mes = 0;
        for($i = 1; $i <= $disposiciones['ministraciones']; $i++){
            $disposiciones['ministracion'][$mes] = array(
                'numero' => $i,
                'mes' => $mes,
                'monto' => ($i == 1) ? $mensualidades + $disposiciones['monto_previo'] : $mensualidades
            );
            
            $mes += $disposiciones['periocidad'];
        }
        return $disposiciones;
    }
    
    public function get_engine($param, $disposiciones, $recalculado){
        //$campos = 'numero_materias,costo_materia,semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
        //$carrera = $this->carrera->get_one($idcarrera,$campos);
        $carrera = $this->carrera;
        $ciclos = ($carrera['marca_plan'] == 'semestral') ? $carrera['semestres'] : ( ($carrera['marca_plan'] == 'cuatrimestral') ? $carrera['cuatrimestres'] : $carrera['trimestres']);
        
        $engine = array();
        
        $engine['duracion'] = $disposiciones['periocidad'];
        $engine['periodo_estudios'] = $disposiciones['periocidad'] * $disposiciones['ministraciones'];
        $engine['periodo_pagos_egresado'] = $disposiciones['plazo'] - $engine['periodo_estudios'];
        $engine['periodo_maximo_meses'] = $engine['periodo_pagos_egresado'] + $engine['periodo_estudios'];
        $engine['financiamiento_total'] = $disposiciones['total_financiar'];
        $key = ($disposiciones['monto_previo'] == 0) ? $disposiciones['periocidad'] : '1'.$disposiciones['periocidad'];
        //echo $key;
        $engine['comisiones_enganche'] = $recalculado[$key.'COMISIONES'][$ciclos];
        $engine['pago_inicial'] = $recalculado[$key.'PAGOINICIAL'][$ciclos];
        $engine['enganche'] = $recalculado[$key.'ENGANCHE'][$ciclos];
        
        //$engine['pago_mensual'] = ($disposiciones['total_financiar']/($ciclos*$disposiciones['periocidad']))/2;
        
        $engine['pago_mensual'] = ( floor( (1*$disposiciones['total_financiar']/$ciclos/$disposiciones['periocidad']) * ($recalculado[$key.'MENSUALIDAD'][$ciclos]/100)/50 ) * 50  );
        $engine['porcentaje_pago'] = round(($engine['pago_mensual']/($engine['financiamiento_total']/$engine['periodo_estudios']))*100,2);
        $engine['pago_inicial1'] = ($engine['pago_mensual'] * $engine['pago_inicial'])/100;
        $engine['enganche1'] = ($engine['pago_mensual'] * $engine['enganche'])/100;
        //$engine['cat'] = $this->calcula_cat();
        
        
        
        return $engine;
    }
    
    public function tabla_pagos($param){
        
        //$campos = 'numero_materias,costo_materia,semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
        //$carrera = $this->carrera->get_one($idcarrera,$campos);
        $carrera = $this->carrera;
        $ciclos = ($carrera['marca_plan'] == 'semestral') ? $carrera['semestres'] : ( ($carrera['marca_plan'] == 'cuatrimestral') ? $carrera['cuatrimestres'] : $carrera['trimestres']);        
        $disposiciones = $this->get_disposiciones($param);
        $recalculado = $this->get_recalculado();
        $engine = $this->get_engine($param, $disposiciones, $recalculado);
        $tabla = array();
        for($i=0;$i<186;$i++){
            if(isset($disposiciones['ministracion'][$i])){
                if($i == 0){
                    $tabla['mes'][$i]['disposicion'] = $disposiciones['ministracion'][$i]['monto'] + $disposiciones['monto_previo'];
                    
                    $tabla['mes'][$i]['intereses'] = 0;
                    $tabla['mes'][$i]['iva'] = 0;
                    $tabla['mes'][$i]['comisiones'] = 0;
                    $tabla['mes'][$i]['capital'] = $engine['pago_mensual'];
                    $tabla['mes'][$i]['pago_total'] = $tabla['mes'][$i]['intereses'] + $tabla['mes'][$i]['iva']+ $tabla['mes'][$i]['comisiones']+ $tabla['mes'][$i]['capital'];
                    $tabla['mes'][$i]['saldo_insoluto'] = $tabla['mes'][$i]['disposicion'] - $tabla['mes'][$i]['pago_total'];
                    $tabla['mes'][$i]['pagare'] = $tabla['mes'][$i]['saldo_insoluto'];
                }else{
                    $tabla['mes'][$i]['disposicion'] = $disposiciones['ministracion'][$i]['monto'];
                    if($engine['duracion'] == 6){
                        $tabla['mes'][$i]['pago_total'] = $engine['pago_mensual'] + ($engine['pago_mensual']*0.5);
                    }else{
                        $tabla['mes'][$i]['pago_total'] = $engine['pago_mensual'];
                    }
                    
                    $tabla['mes'][$i]['pago_total2'] = $engine['pago_mensual'];
                    
                    $tabla['mes'][$i]['pagare'] = $tabla['mes'][$i]['disposicion'] - ((($engine['enganche']/100) * $engine['pago_mensual']) * ((100-$engine['comisiones_enganche'])/100));
                    $tabla['mes'][$i]['saldo_insoluto'] = $tabla['mes'][$i-1]['saldo_insoluto'] - $tabla['mes'][$i-1]['capital'] + $tabla['mes'][$i]['pagare'];
                    
                    $tabla['mes'][$i]['comisiones'] = ( ($engine['comisiones_enganche']/100) * $tabla['mes'][$i]['pago_total'])/(($param['iva']/100) + 1);
                    $tabla['mes'][$i]['iva'] = $tabla['mes'][$i]['comisiones'] * ($param['iva']/100);
                    $suma_tmp = $tabla['mes'][$i]['saldo_insoluto'] + $tabla['mes'][$i]['comisiones'] + $tabla['mes'][$i]['iva'];
                    $resta_tmp = $tabla['mes'][$i]['pago_total'] - $tabla['mes'][$i]['comisiones'] - $tabla['mes'][$i]['iva'];
                    $tabla['mes'][$i]['capital2'] = ($suma_tmp < $engine['pago_mensual']) ? $tabla['mes'][$i]['saldo_insoluto'] : $resta_tmp;
                    
                    
                    //$tabla['mes'][$i]['capital2'] = $tabla['mes'][$i]['pago_total'] - $tabla['mes'][$i]['comisiones'] - $tabla['mes'][$i]['iva'];
                    
                    $tabla['mes'][$i]['intereses'] = 0;  
                    $tabla['mes'][$i]['intereses2'] = (($disposiciones['tasa']/12) * $tabla['mes'][$i]['saldo_insoluto'])/100;                    
                    $tabla['mes'][$i]['intereses_iva'] = $tabla['mes'][$i]['intereses2'] *($param['iva']/100 );                    
                    
                    $suma_tmp = $tabla['mes'][$i]['saldo_insoluto'] + $tabla['mes'][$i]['intereses2'] + $tabla['mes'][$i]['intereses_iva'];
                    $resta_tmp = $engine['pago_mensual'] - $tabla['mes'][$i]['intereses2'] - $tabla['mes'][$i]['intereses_iva'];
                    $tabla['mes'][$i]['capital'] = ($suma_tmp < $engine['pago_mensual']) ? $tabla['mes'][$i]['saldo_insoluto'] : $resta_tmp;
                    //$tabla['mes'][$i]['capital'] = $tabla['mes'][$i]['pago_total'] - $tabla['mes'][$i]['intereses2'] - $tabla['mes'][$i]['intereses_iva']; 
                                       
                    
                }
                
            }else{
                if($i == 1){
                    $tabla['mes'][$i]['disposicion'] = 0;
                    $tabla['mes'][$i]['pago_total'] = $engine['pago_mensual'];
                    $tabla['mes'][$i]['saldo_insoluto'] = $tabla['mes'][$i-1]['saldo_insoluto'];
                    $tabla['mes'][$i]['intereses'] = (($disposiciones['tasa']/12) * $tabla['mes'][$i]['saldo_insoluto'])/100;
                    $tabla['mes'][$i]['iva'] = $tabla['mes'][$i]['intereses'] * ($param['iva']/100);
                    $tabla['mes'][$i]['comisiones'] = 0;
                    $tabla['mes'][$i]['capital'] = $tabla['mes'][$i]['pago_total'] - $tabla['mes'][$i]['intereses'] - $tabla['mes'][$i]['iva'];
                    $tabla['mes'][$i]['pagare'] = 0;
                }else{
                    $tabla['mes'][$i]['disposicion'] = 0;
                    //$tabla['mes'][$i]['pago_total'] = $engine['pago_mensual'];
                    $tabla['mes'][$i]['saldo_insoluto'] = $tabla['mes'][$i-1]['saldo_insoluto'] - $tabla['mes'][$i-1]['capital'];
                    $tabla['mes'][$i]['intereses'] = (($disposiciones['tasa']/12) * $tabla['mes'][$i]['saldo_insoluto'])/100;
                    $tabla['mes'][$i]['iva'] = $tabla['mes'][$i]['intereses'] * ($param['iva']/100);
                    $tabla['mes'][$i]['comisiones'] = 0;
                    //$tabla['mes'][$i]['capital'] = $tabla['mes'][$i]['pago_total'] - $tabla['mes'][$i]['intereses'] - $tabla['mes'][$i]['iva'];
                    $suma_tmp = $tabla['mes'][$i]['saldo_insoluto'] + $tabla['mes'][$i]['intereses'] + $tabla['mes'][$i]['iva'];
                    $resta_tmp = $engine['pago_mensual'] - $tabla['mes'][$i]['intereses'] - $tabla['mes'][$i]['iva'];
                    $tabla['mes'][$i]['capital'] = ($suma_tmp < $engine['pago_mensual']) ? $tabla['mes'][$i]['saldo_insoluto'] : $resta_tmp;
                    $tabla['mes'][$i]['pago_total'] = $tabla['mes'][$i]['intereses'] + $tabla['mes'][$i]['iva']+ $tabla['mes'][$i]['comisiones']+ $tabla['mes'][$i]['capital'];
                    $tabla['mes'][$i]['pagare'] = 0;
                }
                
                if($tabla['mes'][$i]['saldo_insoluto'] == $tabla['mes'][$i]['capital']){
                    BREAK;
                }
                
            }
        }        
        //$tabla['cat'] = $this->calcula_cat($disposiciones,$tabla);
        return $tabla;
    }
    
    public function calcula_cat($disposiciones,$tabla){
        //$cat = 15.538;
        $cat = 0;
        $suma_uno = 0;
        $suma_dos = 0;
        $resta = 1;
        // while($cat != 0.06){
        for ($i = 0; $i <= 10000; $i = $i + 0.001) { 
            //echo '<br> -> ' . $i;
            $cat = $i;
            foreach($tabla['mes'] as $k=>$a){
                if(isset($disposiciones['ministracion'][$k])){
                    
                    if($k == 0){
                        //print_r($a);
                        $otro[$k]['prestamo_npv'] = ($disposiciones['ministracion'][$k]['monto'] - $a['capital'])/pow((1+(($cat/100)/12)),$k-1);
                        $otro[$k]['pago_npv'] = ($a['intereses'] + $a['iva'])/pow((1+(($cat/100)/12)),$k);
                        $otro[$k]['iva_npv'] = (0)/pow((1+(($cat/100)/12)),$k);
                        $otro[$k]['comisiones_npv'] = (0)/pow((1+(($cat/100)/12)),$k);
                        $otro[$k]['ivacomis_npv'] = ($otro[$k]['comisiones_npv'] * ($disposiciones['iva']/100));
                        
                    }else{
                        $otro[$k]['prestamo_npv'] = ($disposiciones['ministracion'][$k]['monto'] - $a['capital2'])/pow((1+(($cat/100)/12)),$k-1);
                        $otro[$k]['pago_npv'] = ($a['intereses2'] + $a['intereses_iva'] + $a['comisiones'] + $a['iva'] + $a['capital'])/pow((1+(($cat/100)/12)),$k);
                        $otro[$k]['iva_npv'] = ($a['intereses_iva'])/pow((1+(($cat/100)/12)),$k);
                        $otro[$k]['comisiones_npv'] = ($a['comisiones'])/pow((1+(($cat/100)/12)),$k-1);
                        $otro[$k]['ivacomis_npv'] = ($otro[$k]['comisiones_npv'] * ($disposiciones['iva']/100));
                    }
                    
                    
                    
                    
                }else{
                    $otro[$k]['prestamo_npv'] = (0)/pow((1+($cat/12)),$k-1);
                    $otro[$k]['pago_npv'] = ($a['intereses'] + $a['iva'] + $a['capital'])/pow((1+(($cat/100)/12)),$k);
                    $otro[$k]['iva_npv'] = ($a['iva'])/pow((1+(($cat/100)/12)),$k);
                    $otro[$k]['comisiones_npv'] = (0)/pow((1+(($cat/100)/12)),$k-1);
                    $otro[$k]['ivacomis_npv'] = ($otro[$k]['comisiones_npv'] * ($disposiciones['iva']/100));
                }
                
                $otro[$k]['total'] = ($otro[$k]['pago_npv'] - $otro[$k]['iva_npv'] - $otro[$k]['ivacomis_npv']);
                $suma_uno += $otro[$k]['total'];
                $suma_dos += $otro[$k]['prestamo_npv'];
                
                
            }
            
            //$resta = round($suma_uno) - round($suma_dos);
            if($i == 0.010){
                //$cat = $i;
                BREAK;
            }
            
            
            
        }
        //print_r($otro);
        //return $otro; 
        return ($suma_uno).' - '.($suma_dos); 
        //return round($cat,2);
    }
    
    public function get_recalculado(){
        for($i = 0; $i < 17; $i++){
            if(($i == 3) || ($i == 4) || ($i == 6) || ($i == 13) || ($i == 14) || ($i == 16)){
                $recalculated[$i.'PAGOINICIAL'] = array(
                    '1' => '100',
                    '2' => '100',
                    '3' => '100',
                    '4' => '100',
                    '5' => '100',
                    '6' => '100',
                    '7' => '100',
                    '8' => '100',
                    '9' => '100',
                    '10' => '100',
                    '11' => '100',
                    '12' => '100',
                    '13' => '100',
                    '14' => '100',
                    '15' => '100',
                    '16' => '100',
                    '17' => '100',
                    '18' => '100'
                );
                $recalculated[$i.'ENGANCHE'] = array(
                    '1' => '100',
                    '2' => '100',
                    '3' => '100',
                    '4' => '100',
                    '5' => '100',
                    '6' => '100',
                    '7' => '100',
                    '8' => '100',
                    '9' => '100',
                    '10' => '100',
                    '11' => '100',
                    '12' => '100',
                    '13' => '100',
                    '14' => '100',
                    '15' => '100',
                    '16' => '100',
                    '17' => '100',
                    '18' => '100'
                );
                $recalculated[$i.'COMISIONES'] = array(
                    '1' => '100',
                    '2' => '100',
                    '3' => '100',
                    '4' => '100',
                    '5' => '100',
                    '6' => '100',
                    '7' => '100',
                    '8' => '100',
                    '9' => '100',
                    '10' => '100',
                    '11' => '100',
                    '12' => '100',
                    '13' => '100',
                    '14' => '100',
                    '15' => '100',
                    '16' => '100',
                    '17' => '100',
                    '18' => '100'
                );
                $recalculated[$i.'MENSUALIDAD'] = array(
                    '1' => '100',
                    '2' => '100',
                    '3' => '100',
                    '4' => '100',
                    '5' => '100',
                    '6' => '100',
                    '7' => '100',
                    '8' => '100',
                    '9' => '100',
                    '10' => '100',
                    '11' => '100',
                    '12' => '100',
                    '13' => '100',
                    '14' => '100',
                    '15' => '100',
                    '16' => '100',
                    '17' => '100',
                    '18' => '100'
                );
                
            }
        }
        
        $recalculated['3COMISIONES'] = array(
                    '1' => '30.6',
                    '2' => '30.6',
                    '3' => '30.6',
                    '4' => '30.6',
                    '5' => '30.6',
                    '6' => '30.6',
                    '7' => '30.6',
                    '8' => '30.6',
                    '9' => '30.6',
                    '10' => '30.6',
                    '11' => '30.6',
                    '12' => '30.6',
                    '13' => '30.6',
                    '14' => '30.6',
                    '15' => '30.6',
                    '16' => '30.6',
                    '17' => '30.6',
                    '18' => '30.6'
                );
        
        $recalculated['3MENSUALIDAD'] = array(
                    '1' => '50',
                    '2' => '50',
                    '3' => '50',
                    '4' => '50',
                    '5' => '50',
                    '6' => '50',
                    '7' => '50',
                    '8' => '50',
                    '9' => '50',
                    '10' => '50',
                    '11' => '50',
                    '12' => '50',
                    '13' => '50',
                    '14' => '50',
                    '15' => '50',
                    '16' => '50',
                    '17' => '50',
                    '18' => '50'
                );
        
        $recalculated['4COMISIONES'] = array(
                    '1' => '100',
                    '2' => '97.5',
                    '3' => '97.5',
                    '4' => '95',
                    '5' => '95',
                    '6' => '90',
                    '7' => '90',
                    '8' => '85',
                    '9' => '85',
                    '10' => '80',
                    '11' => '43',
                    '12' => '45',
                    '13' => '0',
                    '14' => '0',
                    '15' => '0',
                    '16' => '0',
                    '17' => '0',
                    '18' => '0'
                );
        
        $recalculated['4MENSUALIDAD'] = array(
                    '1' => '50',
                    '2' => '50',
                    '3' => '50',
                    '4' => '50',
                    '5' => '50',
                    '6' => '50',
                    '7' => '50',
                    '8' => '50',
                    '9' => '50',
                    '10' => '50',
                    '11' => '50',
                    '12' => '52.5',
                    '13' => '0',
                    '14' => '0',
                    '15' => '0',
                    '16' => '0',
                    '17' => '0',
                    '18' => '0'
                );
        
        $recalculated['6ENGANCHE'] = array(
                    '1' => '150',
                    '2' => '150',
                    '3' => '150',
                    '4' => '150',
                    '5' => '150',
                    '6' => '150',
                    '7' => '150',
                    '8' => '150',
                    '9' => '150',
                    '10' => '150',
                    '11' => '150',
                    '12' => '150',
                    '13' => '150',
                    '14' => '150',
                    '15' => '150',
                    '16' => '150',
                    '17' => '150',
                    '18' => '150'
                );
        $recalculated['6COMISIONES'] = array(
                    '1' => '100',
                    '2' => '95',
                    '3' => '95',
                    '4' => '95',
                    '5' => '90',
                    '6' => '90',
                    '7' => '49.5',
                    '8' => '31',
                    '9' => '44.5',
                    '10' => '26.3',
                    '11' => '0',
                    '12' => '0',
                    '13' => '0',
                    '14' => '0',
                    '15' => '0',
                    '16' => '0',
                    '17' => '0',
                    '18' => '0'
                );
        
        $recalculated['6MENSUALIDAD'] = array(
                    '1' => '50',
                    '2' => '50',
                    '3' => '50',
                    '4' => '50',
                    '5' => '50',
                    '6' => '50',
                    '7' => '50',
                    '8' => '52.5',
                    '9' => '57.5',
                    '10' => '60',
                    '11' => '0',
                    '12' => '0',
                    '13' => '0',
                    '14' => '0',
                    '15' => '0',
                    '16' => '0',
                    '17' => '0',
                    '18' => '0'
                );
        $recalculated['13COMISIONES'] = array(
                    '1' => '30.6',
                    '2' => '30.6',
                    '3' => '30.6',
                    '4' => '30.6',
                    '5' => '30.6',
                    '6' => '30.6',
                    '7' => '30.6',
                    '8' => '30.6',
                    '9' => '30.6',
                    '10' => '30.6',
                    '11' => '30.6',
                    '12' => '30.6',
                    '13' => '30.6',
                    '14' => '30.6',
                    '15' => '30.6',
                    '16' => '30.6',
                    '17' => '30.6',
                    '18' => '30.6'
                );
        
        $recalculated['13MENSUALIDAD'] = array(
                    '1' => '55',
                    '2' => '55',
                    '3' => '55',
                    '4' => '55',
                    '5' => '55',
                    '6' => '55',
                    '7' => '55',
                    '8' => '55',
                    '9' => '55',
                    '10' => '55',
                    '11' => '55',
                    '12' => '55',
                    '13' => '55',
                    '14' => '55',
                    '15' => '55',
                    '16' => '55',
                    '17' => '55',
                    '18' => '55'
                );
        
        $recalculated['14COMISIONES'] = array(
                    '1' => '0',
                    '2' => '100',
                    '3' => '95',
                    '4' => '95',
                    '5' => '95',
                    '6' => '95',
                    '7' => '95',
                    '8' => '95',
                    '9' => '95',
                    '10' => '83',
                    '11' => '62.5',
                    '12' => '31',
                    '13' => '0',
                    '14' => '0',
                    '15' => '0',
                    '16' => '0',
                    '17' => '0',
                    '18' => '0'
                );
        
        $recalculated['16PAGOINICIAL'] = array(
                    '1' => '150',
                    '2' => '150',
                    '3' => '150',
                    '4' => '150',
                    '5' => '150',
                    '6' => '150',
                    '7' => '150',
                    '8' => '150',
                    '9' => '150',
                    '10' => '150',
                    '11' => '150',
                    '12' => '150',
                    '13' => '150',
                    '14' => '150',
                    '15' => '150',
                    '16' => '150',
                    '17' => '150',
                    '18' => '150'
                );
        
        $recalculated['16ENGANCHE'] = array(
                    '1' => '150',
                    '2' => '150',
                    '3' => '150',
                    '4' => '150',
                    '5' => '150',
                    '6' => '150',
                    '7' => '150',
                    '8' => '150',
                    '9' => '150',
                    '10' => '150',
                    '11' => '150',
                    '12' => '150',
                    '13' => '150',
                    '14' => '150',
                    '15' => '150',
                    '16' => '150',
                    '17' => '150',
                    '18' => '150'
                );
        
        $recalculated['16COMISIONES'] = array(
                    '1' => '0',
                    '2' => '100',
                    '3' => '95',
                    '4' => '95',
                    '5' => '95',
                    '6' => '95',
                    '7' => '79.3',
                    '8' => '46.3',
                    '9' => '81.80',
                    '10' => '0',
                    '11' => '0',
                    '12' => '0',
                    '13' => '0',
                    '14' => '0',
                    '15' => '0',
                    '16' => '0',
                    '17' => '0',
                    '18' => '0'
                );
        
        $recalculated['16MESUALIDAD'] = array(
                    '1' => '50',
                    '2' => '50',
                    '3' => '50',
                    '4' => '50',
                    '5' => '50',
                    '6' => '52.5',
                    '7' => '52.5',
                    '8' => '52.5',
                    '9' => '55',
                    '10' => '62.5',
                    '11' => '0',
                    '12' => '0',
                    '13' => '67.5',
                    '14' => '70',
                    '15' => '72.5',
                    '16' => '75',
                    '17' => '77.5',
                    '18' => '80'
                );
        return $recalculated;
    }
    
    public function construye_tabla_amortizacion($datos = FALSE) {
        
        $this->load->library('contrato_pdf');
        
        $this->contrato_pdf->abre_documento('L');
        $this->contrato_pdf->tabla_pagos_pdf($datos);
        //$this->contrato_pdf->nueva_hoja('P');
        $this->contrato_pdf->firmas();
        $this->contrato_pdf->cierra_documento();
    }
    
    public function calcula_fecha_pago($datos = FALSE, $fecha = '') {
        
        //setlocale(LC_ALL,"es_MX");
        $result = $datos; 
        if (empty($fecha)) {
            $fecha = date('Y-m-').'05';
            //$fecha = '2012-01-05';
        }
        
        if (is_array($datos) AND count($datos) > 0) {
            
            foreach ($datos as $key => $value) {                
                
                $date_obj = new DateTime($fecha);         
                $badd = 0;
                if ($key > 0) {
                    $date_obj->add(new DateInterval('P1M'));                
                    $dia_num = $date_obj->format('w');                

                    // LA SEMANA COMIENZA EN 0 (DOMINGO) Y TERMINA EL  6 (SABADO), CONSECUTIVAMENTE
                    if ($dia_num == 0) { // ES DOMINGO                     
                        $date_obj->add(new DateInterval('P1D'));
                        $badd = 1;
                    } else if ($dia_num == 6) { // ES SABADO
                        $date_obj->add(new DateInterval('P2D'));                    
                        $badd = 1;
                    } else {
                        $badd = 0;
                    }
                } 
                $result[$key]['fecha_pago'] = $date_obj->format('d-m-Y');
//echo '<br> ' . $key . ' - ' . $date_obj->format('d-m-Y') . ' - ' . $dia_num;
//print_r($date_obj);
                if ($badd == 1) {                        
                    $fecha = $date_obj->format('Y-m-05');                    
                } else {
                    $fecha = $result[$key]['fecha_pago'];
                }                
            }
        } else { //  ME SIRVIÓ PRA HACER PRUEBAS .. DEBUG
            $date_obj = new DateTime($fecha); 
            $date_obj->add(new DateInterval('P1M'));
            echo $date_obj->format('d-m-Y');
        }
        return $result;
    }
}