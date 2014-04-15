<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class reporte extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/reporte
     * 	- or -  
     * 		http://example.com/index.php/reporte/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/reporte/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {

        parent::__construct();
        $this->login->checkLogin();
        /* Verificar la sesión */

        $this->load->model('expediente_model', 'expediente');
        $this->load->model('reporte_model', 'reporte');
        //$this->load->model('Universidad_model', 'universidad');
        //$this->load->model('Campus_model', 'campus');

        //$this->phpsession->save('last_url','hola');
        
        
    }
    
    public function index(){
        
    }
    
    public function contrato(){
        
        if($this->form_validation->run('reporte_contrato') === FALSE){
            $this->load->view('reporte/contrato');
        }else{
            $post = $this->input->post(NULL,TRUE);
            $reporte = $this->reporte->contrato($post);
            $this->reporte->forzar_download($reporte);
            
        }
        
    }
    
    public function mesa(){
        
        if($this->form_validation->run('reporte_mesa') === FALSE){
            $this->load->view('reporte/mesa');
        }else{
            $post = $this->input->post(NULL,TRUE);
            $reporte = $this->reporte->mesa($post);
            //$this->reporte->forzar_download($reporte);
            
        }
        
    }
    
    
}

/* End of file reporte.php */

/* Location: ./application/controllers/reporte.php */
