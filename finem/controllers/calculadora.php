<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculadora extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/calculadora
     * 	- or -
     * 		http://example.com/index.php/calculadora/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/calculadora/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Universidad_model', 'universidad');
        $this->load->model('Campus_model', 'campus');
        $this->load->model('Carrera_model', 'carrera');
        $this->load->model('calculadora_model', 'calculadora');
        
        $this->phpsession->clear('busqueda');
    }

    public function index($idcarrera) {
        $campos = 'numero_materias,costo_materia,semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
        $carrera = $this->carrera->get_one($idcarrera,$campos);
        
        $this->calculadora->carga_datos_carrera($carrera);
        //$recalculado = $this->calculadora->get_recalculado();        
        //$disposiciones = $this->calculadora->get_disposiciones($param);
        //$engine = $this->calculadora->get_engine();
        // PARAMETROS POR DEFAULT.
        $param = $this->calculadora->get_parametros();
        $tabla_pagos = $this->calculadora->tabla_pagos($param);   
        $tabla = $this->calculadora->calcula_fecha_pago($tabla_pagos['mes']);                
        $this->calculadora->construye_tabla_amortizacion($tabla);
                
        echo '<pre>';
        echo 'Carrera<br />';
        print_r($carrera);
        echo '------------------------------------------------------';
        echo '<pre>';
        echo 'Recalculado<br />';
        //print_r($recalculado);
        echo '------------------------------------------------------';
        echo '<pre>';
        echo 'Disposiciones <br />';
        //print_r($disposiciones);
        echo '------------------------------------------------------';
        echo '<pre>';
        echo 'Engine <br />';
        //print_r($engine);
        echo '------------------------------------------------------';
        echo '<pre>';
        echo 'Tabla de Pagos <br />';
        print_r($tabla);
        echo '------------------------------------------------------';
        
    }
    
    public function calcula_fecha() {
        $fecha = $this->calculadora->calcula_fecha_pago();
    }
    
    public function cat(){
        
        $campos = 'numero_materias,costo_materia,semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
        $carrera = $this->carrera->get_one($idcarrera,$campos);
        
        $recalculado = $this->calculadora->get_recalculado();
        $disposiciones = $this->calculadora->get_disposiciones($idcarrera);
        $engine = $this->calculadora->get_engine($idcarrera);
        $tabla_pagos = $this->calculadora->tabla_pagos($idcarrera); 
        
        echo $this->calculadora->calcula_cat($disposiciones,$tabla_pagos);
    }
}

/* End of file calculadora.php */
/* Location: ./application/controllers/calculadora.php */