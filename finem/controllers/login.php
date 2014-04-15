<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/login
     * 	- or -  
     * 		http://example.com/index.php/login/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/login/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        //redirect('http://www.finemsist.com');
        $this->load->model('login_model', 'login');
    }

    public function index() {
        if ($this->form_validation->run('login') == FALSE) {
            session_destroy();
            $return = $this->phpsession->flashget('returnurl');
            //echo $return;
            if(!empty($return)){
                $this->phpsession->flashkeep('returnurl');
            }
            $this->phpsession->clear('user','finem');
            $data['seccion'] = 'login';
            $this->load->view('login_view', $data);
        } else {
            $post = $this->input->post(NULL, TRUE);
            $this->login->entrar($post);
            $this->phpsession->flashsave('acierto', 'Bienvenido al Nuevo Sistema de Finem.');
            $user = $this->phpsession->get('user');
            //echo $this->db->last_query();
            $this->login->redirige();
            //redirect('expediente/lista');
        }
    }

    public function username_check($user) {
        $pass = $_POST['pass'];
        $q = $this->login->checkUser($user, $pass);
        if ($q == FALSE) {
            $this->form_validation->set_message('username_check', 'La combinación de usuario/contraseña es incorrecta');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function salir() {
        $this->phpsession->clear('user','finem');
        $this->phpsession->flashsave('acierto', 'Tu sesión ha sido finalizada con éxito.');
        redirect('login');
        //redirect('http://www.finemsist.com');
    }
    
    public function reentrar(){
        $this->login->checkLogin();
        $this->login->redirige();
    }
    
    public function renovar(){
        $this->login->checkLogin();
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */