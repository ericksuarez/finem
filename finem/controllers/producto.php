<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Producto extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/producto
     * 	- or -  
     * 		http://example.com/index.php/producto/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/producto/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->login->checkLogin();
        /* Verifica el browswer del usuario (por ie8 más que nada) */
        $this->load->library('user_agent');
        $this->load->model('producto_model', 'producto');

        /* Verificar la sesión */

        //$this->phpsession->save('last_url','hola');
    }

    public function index() {
        redirect('producto/lista');
    }

    public function lista() {


        $data['productos'] = $this->producto->getproducto();
        //$data['productos'] = $this->producto->getAllproductos();
        $data['seccion'] = 'lista';
        $this->load->view('producto_view', $data);
    }

    public function nuevo() {
        $data['browser'] = $this->agent->browser();
        $data['browser_ver'] = $this->agent->version();

        $this->load->model('producto_model', 'producto');
        if ($this->form_validation->run('alta_producto') == FALSE) {
            $data['seccion'] = 'nuevo';
            $this->load->view('producto_view', $data);
        } else {
            $post = $this->input->post(NULL, TRUE);
            $this->producto->guardarproducto($post);
            $this->phpsession->flashsave('acierto', 'El nuevo producto ha sido dado de alta correctamente.');
            redirect('producto/lista/');
        }
    }

    public function ver($idproducto) {
        $this->load->model('producto_model', 'producto');
        $tmp = $this->producto->getproducto($idproducto);
        $data['producto'] = $tmp[0];
        if ($this->form_validation->run('alta_producto') == FALSE) {
            $data['seccion'] = 'ver';
            $this->load->view('producto_view', $data);
        } else {
            $post = $this->input->post(NULL, TRUE);
            $this->producto->guardarproducto($post, TRUE);
            $this->phpsession->flashsave('acierto', 'El producto ha sido editado correctamente.');
            redirect(current_url());
        }
    }

    public function borrar() {
        $this->load->model('producto_model', 'producto');
        $post = $this->input->post(NULL, TRUE);
        $this->producto->borrarproducto($post["id"]);
        $this->phpsession->flashsave('acierto', "El producto ha sido borrado con éxito.");
        redirect('producto/lista');
    }

    /* public function modificar($idproducto,$accion)
      {
      $this->load->model('producto_model','producto');
      $this->producto->modificarproducto($idproducto,$accion);
      $accion1 = ($accion=='activo') ? 'activado' : 'desactivado';
      $this->phpsession->flashsave('acierto',"El producto ha sido $accion1 con éxito.");
      redirect('producto/lista');
      } */

    public function principal($idproducto) {
        $this->load->model('producto_model', 'producto');
        $this->producto->hacerPrincipal($idproducto);
        $this->phpsession->flashsave('acierto', "El producto ha sido modificado como producto principal con éxito.");
        redirect('producto/lista');
    }

}

/* End of file producto.php */
/* Location: ./application/controllers/producto.php */