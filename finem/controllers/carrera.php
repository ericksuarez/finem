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

class Carrera extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/carrera
     * 	- or -
     * 		http://example.com/index.php/carrera/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/carrera/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->login->checkLogin();
        $this->load->model('Universidad_model', 'universidad');
        $this->load->model('Campus_model', 'campus');
        $this->load->model('Carrera_model', 'carrera');
        
        $seccion = $this->uri->segment(2);
        
        if($seccion == 'alta'){
            $this->phpsession->clear('busqueda');
        }
        
    }

    public function index() {
        //$this->load->view('carrera_view');
    }
    
    public function lista(){
        $data['universidades'] = $this->universidad->getAlluniversidades();
        //$data['b'] = $this->phpsession->get('busqueda');
        $data['total'] = $this->carrera->totalcarreras();
        $campos = 'semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
        $data['carreras'] = $this->carrera->listado(100,$campos);
        $data['campi'] = $this->campus->getcampusbyuni($_GET['uni']);
        $this->load->view('carrera/lista',$data);
    }
    
    public function ajax_campus(){
        $post = $this->input->post(NULL,TRUE);
        
        $campus = $this->campus->getcampusbyuni($post['universidad']);
        $b = $this->phpsession->get('busqueda');
        $tmp = $this->uri->segment(3);
        $set_select = (!empty($tmp)) ? $tmp : 0;
        
        echo '<option value="">Seleccione un Campus</option>';
        
        if(!empty($campus)){
            foreach($campus as $c){
                $selected2 = ($set_select == $c['idcampus']) ? 'selected = "selected"' : '';
                $selected = ($b['campus'] == $c['idcampus']) ? 'selected = "selected"' : '';
                echo '<option '.$selected2.' '.$selected.' value="'.$c['idcampus'].'">'.$c['nombre'].'</option>';
            }
        }
        
    }
    
    public function buscar(){
        $post = $this->input->post(NULL,TRUE);
        $old = $this->phpsession->get('busqueda');
        if(($post['universidad'] == $old['universidad']) && ($post['campus'] == $old['campus']) && ($post['carrera'] == $old['carrera']) ){
            //echo 'IGUAL';
            $uri = $this->uri->segment(3);
        }else{
            //echo 'DIFERENTE';
            $uri = $this->uri->segment(4);
        }
        $data['total'] = $this->carrera->totalcarreras($post['universidad'],$post['campus'],$post['carrera']);
        if($data['total'] < $uri){
            $data['error_total'] = TRUE;
        }else{
            $data['error_total'] = FALSE;
        }
        $this->phpsession->save('busqueda',$post);
        $campos = 'semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
        $data['carreras'] = $this->carrera->buscar($uri,$post['universidad'],$post['campus'],$post['carrera'],$campos);
        //echo $this->db->last_query();
        
        $this->load->view('carrera/buscar',$data);
    }
    
    public function alta(){
        if($this->form_validation->run('alta_carrera') === FALSE){
            $data['universidades'] = $this->universidad->getAlluniversidades();
            $this->load->view('carrera/alta',$data);
            
        }else{
            $post = $this->input->post(NULL,TRUE);
            $this->carrera->guardar($post);
            
            $this->phpsession->flashsave('acierto','La carrera ha sido creada con éxito.');
            redirect(current_url());
        }
    }
    
    public function editar($idcarrera){
        if($idcarrera == 0){
            redirect('carrera/error');
        }
        
        if($this->form_validation->run('editar_carrera') === FALSE){
            $campos = 'numero_materias,costo_materia,semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
            $data['carrera'] = $this->carrera->get_one($idcarrera,$campos);
            $this->load->view('carrera/editar',$data);
            
        }else{
            $post = $this->input->post(NULL,TRUE);
            $query = '?uni='.$post['uni'].'&cam='.$post['cam'].'&car='.$post['car'];
            unset($post['uni']);
            unset($post['cam']);
            unset($post['car']);
            $post['id'] = $idcarrera;
            $this->carrera->guardar($post,TRUE);
            
            $this->phpsession->flashsave('acierto','La carrera ha sido editada con éxito.');
            
            redirect(current_url().$query);
        }
        
    }
    
    public function borrar($idcarrera){
        $this->carrera->borrar($idcarrera);
        $this->phpsession->flashsave('acierto','La carrera ha sido borrada con éxito.');
        
        redirect($_SERVER['HTTP_REFERER']);
    }

}

/* End of file carrera.php */
/* Location: ./application/controllers/carrera.php */