<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Investigacion extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/investigacion
     * 	- or -  
     * 		http://example.com/index.php/investigacion/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/investigacion/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {

        parent::__construct();
        $this->login->checkLogin();
        /* Verificar la sesión */

        $this->load->model('expediente_model', 'expediente');
        $this->load->model('investigacion_model', 'investigacion');
        //$this->load->model('Universidad_model', 'universidad');
        //$this->load->model('Campus_model', 'campus');

        //$this->phpsession->save('last_url','hola');
        
        
    }

    public function index() {

        redirect('investigacion/lista');
    }
    
    public function general($idexpediente){
        $this->load->model('alumno_model','alumno');
        $tmp = $this->expediente->getExpediente($idexpediente);
        $data['expediente'] = $tmp[0];
        $inv['expediente'] = $tmp[0];
        $inv['expediente']['avales'] = $this->alumno->get_aval($tmp[0]['alumno_idalumno']);
        $data['menu'] = $this->investigacion->semaforo($idexpediente);
        $data['info'] = $this->investigacion->get_cuadro($inv['expediente']);
        $this->load->view('investigacion/cuadro',$data);
    }
    
    public function solicitud($idexpediente){
        $data['seccion'] = 'ver';
        $data['accion'] = 'solicitud';
        $tmp = $this->expediente->getExpediente($idexpediente);
        $data['expediente'] = $tmp[0];
        $data['informacion'] = $this->expediente->getAllInfo($data['expediente'], 'solicitud', $_POST);
        $data['menu'] = $this->investigacion->semaforo($idexpediente);
        $this->load->view('investigacion/solicitud', $data);
    }
    
    public function personal($idexpediente){
        //print_r($_POST);
        if ($this->form_validation->run('inv_personal') == FALSE) {
            $tmp = $this->expediente->getExpediente($idexpediente);
            $data['expediente'] = $tmp[0];
            $data['info'] = $this->investigacion->get($idexpediente,'personal');
            $data['menu'] = $this->investigacion->semaforo($idexpediente);
            $this->load->view('investigacion/personal',$data);
        } else {
            $post = $this->input->post(NULL,TRUE);
            $post['idexpediente'] = $idexpediente;
            $this->investigacion->guardar($post,'personal');
            $this->phpsession->flashsave('acierto','La investigación personal ha sido guardada con éxito.');
            redirect(current_url());
        }
       
    }
    
    public function familiar($idexpediente){
        //print_r($_POST);
        if ($this->form_validation->run('inv_familiar') == FALSE) {
            $tmp = $this->expediente->getExpediente($idexpediente);
            $data['expediente'] = $tmp[0];
            $data['info'] = $this->investigacion->get_familiar($idexpediente);
            $data['menu'] = $this->investigacion->semaforo($idexpediente);
            $this->load->view('investigacion/familiar',$data);
        } else {
            $post = $this->input->post(NULL,TRUE);
            $post['idexpediente'] = $idexpediente;
            $this->investigacion->guardar_familiar($post);
            $this->phpsession->flashsave('acierto','La investigación familiar ha sido guardada con éxito.');
            redirect(current_url());
        }
       
    }
    public function padres($idexpediente){
        //print_r($_POST);
        if ($this->form_validation->run('inv_padre') == FALSE) {
            $tmp = $this->expediente->getExpediente($idexpediente);
            $data['expediente'] = $tmp[0];
            $data['info'] = $this->investigacion->get($idexpediente,'padre');
            $data['menu'] = $this->investigacion->semaforo($idexpediente);
            $this->load->view('investigacion/padre',$data);
        } else {
            $post = $this->input->post(NULL,TRUE);
            $post['idexpediente'] = $idexpediente;
            $this->investigacion->guardar($post,'padre');
            $this->phpsession->flashsave('acierto','La investigación de padres ha sido guardada con éxito.');
            redirect(current_url());
        }
       
    }
    
    public function avales($idexpediente){
        //print_r($_POST);
        if ($this->form_validation->run('inv_aval') == FALSE) {
            $tmp = $this->expediente->getExpediente($idexpediente);
            $data['expediente'] = $tmp[0];
            $data['info'] = $this->investigacion->get($idexpediente,'aval');
            $data['menu'] = $this->investigacion->semaforo($idexpediente);
            $this->load->view('investigacion/aval',$data);
        } else {
            $post = $this->input->post(NULL,TRUE);
            $post['idexpediente'] = $idexpediente;
            $this->investigacion->guardar($post,'aval');
            $this->phpsession->flashsave('acierto','La investigación de avales ha sido guardada con éxito.');
            redirect(current_url());
        }
       
    }
    
    public function fotos($idexpediente){
        //print_r($_POST);
        if ($this->form_validation->run('inv_foto') == FALSE) {
            $tmp = $this->expediente->getExpediente($idexpediente);
            $data['expediente'] = $tmp[0];
            $data['info'] = $this->investigacion->get($idexpediente,'fotos');
            $data['menu'] = $this->investigacion->semaforo($idexpediente);
            $this->load->view('investigacion/foto',$data);
        } else {
            $post = $this->input->post(NULL,TRUE);
            $post['idexpediente'] = $idexpediente;
            $errors = $this->investigacion->guardar_fotos($post,'fotos');
            $this->phpsession->flashsave('acierto','La investigación de fotos ha sido guardada con éxito.');
            $this->phpsession->flashsave('errors',$errors);
            redirect(current_url());
        }
       
    }
    
    public function lista(){
        
        $this->load->model('Universidad_model', 'universidad');
        $this->load->model('Campus_model', 'campus');
        
        $data['universidades'] = $this->universidad->getAlluniversidades();
        $uni = (isset($_GET['uni'])) ? $_GET['uni'] : 0;
        $data['campi'] = $this->campus->getcampusbyuni($uni);
        $data['expedientes'] = $this->investigacion->getExpediente();

        //$data['seccion'] = 'lista';

        $this->load->view('investigacion/lista', $data);
    }
    
    public function terminar($id=0){
        if($id == 0){
            redirect('investigacion/lista');
        }
        
        $this->investigacion->terminar($id);
        
        $this->phpsession->flashsave('acierto','La investigación ha concluido.');
        
        redirect('investigacion/lista');
    }
    
    public function reabrir($id_xpediente) {
        $user = $this->phpsession->get('user', 'finem');
        $foo = $this->config->item('super_admin');

        if (in_array($user['idusuario'], $foo)) {
            $this->db->where('idexpediente', $id_xpediente);
            $this->db->update('expediente', array('investigado' => 'NO'));

            $this->load->model('log_model', 'log');
            $this->log->guardar('investigacion', 'reabrir', $user['idusuario'], $id_xpediente);
        }

        redirect('investigacion/personal/' . $id_xpediente);
    }
    
    public function imprimir($idexpediente = 0){
        $this->load->model('alumno_model','alumno');
        $tmp = $this->expediente->getExpediente($idexpediente);
        $inv['expediente'] = $tmp[0];
        $inv['expediente']['avales'] = $this->alumno->get_aval($tmp[0]['alumno_idalumno']);
        $inv['personal'] = $this->investigacion->get($idexpediente,'personal');
        $inv['familiar'] = $this->investigacion->get_familiar($idexpediente);
        $inv['padre'] = $this->investigacion->get($idexpediente,'padre');
        $inv['aval'] = $this->investigacion->get($idexpediente,'aval');
        $inv['fotos'] = $this->investigacion->get($idexpediente,'fotos');
        //print_r($inv);
        $vacio = 0;
        foreach($inv as $i){
            if(empty($i)){
                $vacio = 1;
            }
        }
        
        if($vacio == 1){
            show_404();
        }else{
            $this->investigacion->imprimir($inv);
        }
        
    }
    
}

/* End of file investigacion.php */

/* Location: ./application/controllers/investigacion.php */