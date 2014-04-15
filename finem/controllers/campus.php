<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campus extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/campus
     * 	- or -  
     * 		http://example.com/index.php/campus/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/campus/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->login->checkLogin();
        /* Verifica el browswer del usuario (por ie8 más que nada) */
        $this->load->library('user_agent');
        $this->load->model('campus_model', 'campus');
        /* Verificar la sesión */

        //$this->phpsession->save('last_url','hola');
    }

    public function index() {
        redirect('campus/lista');
    }

    public function lista() {
        //$this->load->model('campus_model', 'campus');

        $data['campuses'] = $this->campus->getcampus();
        // $data['campuses'] = $this->campus->getAllcampuss();
        $data['seccion'] = 'lista';
        $this->load->view('campus_view', $data);
    }

    public function nuevo() {
        $data['browser'] = $this->agent->browser();
        $data['browser_ver'] = $this->agent->version();

       // $this->load->model('campus_model', 'campus');
        $this->load->model('universidad_model', 'universidad');
        if ($this->form_validation->run('alta_campus') == FALSE) {
            $data['seccion'] = 'nuevo';
            $data['universidades'] = $this->universidad->getAlluniversidades();
            $this->load->view('campus_view', $data);
        } else {
            $post = $this->input->post(NULL, TRUE);
            $this->campus->guardarcampus($post);
            $this->phpsession->flashsave('acierto', 'El nuevo campus ha sido dado de alta correctamente.');
            redirect('campus/lista/');
        }
    }

    public function ver($idcampus) {
        //$this->load->model('campus_model', 'campus');
        $this->load->model('universidad_model', 'universidad');
        $tmp = $this->campus->getcampus($idcampus);
        $data['campus'] = $tmp[0];
        $data['universidades'] = $this->universidad->getAlluniversidades();
        $data['seccion'] = 'ver';


        if ($this->form_validation->run('alta_campus') == FALSE) {

            $this->load->view('campus_view', $data);
        } else {

            $post = $this->input->post(NULL, TRUE);
            $this->campus->guardarcampus($post, TRUE);
            $this->phpsession->flashsave('acierto', 'El campus ha sido actualizado correctamente.');
            redirect('campus/lista/');
        }
    }

    public function modificar($idcampus, $accion) {
        //$this->load->model('campus_model', 'campus');
        $this->campus->modificarcampus($idcampus, $accion);
        $accion1 = ($accion == 'activo') ? 'activado' : 'eliminada';
        $this->phpsession->flashsave('acierto', "La campus ha sido $accion1 con éxito.");
        redirect('campus/lista');
    }

    public function borrar($idcampus) {
        //$this->load->model('campus_model', 'campus');
        $this->campus->borrarcampus($idcampus);
        $this->phpsession->flashsave('acierto', "El campus ha sido eliminado con éxito.");
        redirect('campus/lista');
    }

    public function ajax_carrera() {
        
        $post = $this->input->post(NULL,TRUE);
        $carreras = $this->campus->get_carreras_campus($post['campus']);
        $carreras_sel = nuevo_arreglo_from_db($carreras, 'idcarrera', 'titulo');                
        echo crea_selects($carreras_sel, 'especialidad', $post['especialidad'], 'id="especialidad"', 
                $posCero = '', $valCero = 'Selecciona una carrera');        
    }
}

/* End of file campus.php */
/* Location: ./application/controllers/campus.php */