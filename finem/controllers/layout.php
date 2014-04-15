<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/layout
     * 	- or -  
     * 		http://example.com/index.php/layout/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/layout/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {

        parent::__construct();
        $this->login->checkLogin();
        /* Verificar la sesión */

        $this->load->model('expediente_model', 'expediente');
        $this->load->model('layout_model', 'layout');
        //$this->load->model('Universidad_model', 'universidad');
        //$this->load->model('Campus_model', 'campus');

        //$this->phpsession->save('last_url','hola');
        
        
    }
    
    public function index(){}
    
    public function cobranza(){
        $data = NULL;
        $this->form_validation->set_rules('fecha_dos','Fecha de Actualizacion','valida_fechas_esp');
        if($this->form_validation->run() === FALSE){
            $this->load->view('layout/cobranza',$data);
        }else{
            $post = $this->input->post(NULL,TRUE);
            $layout = $this->layout->subir_cobranza($post);
            //print_r($layout);
            $tipo = ($layout['acierto'] === TRUE) ? 'acierto' : 'error';
            
            $this->phpsession->flashsave($tipo,$layout['msj']);
            redirect(current_url());
            //print_r($_FILES);
        }
        
    }
    
    public function template($tipo,$encabezados){
        $data = $this->layout->template($tipo,$encabezados);
        $this->load->helper('download');
        force_download('template_'.$tipo.'.csv', $data); 
    }
    
}

/* End of file layout.php */

/* Location: ./application/controllers/layout.php */