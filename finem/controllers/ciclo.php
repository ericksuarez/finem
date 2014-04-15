<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ciclo extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/ciclo
	 *	- or -  
	 * 		http://example.com/index.php/ciclo/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/ciclo/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
                $this->login->checkLogin();
		/* Verifica el browswer del usuario (por ie8 más que nada) */
		$this->load->library('user_agent');
                
		/* Verificar la sesión */

		//$this->phpsession->save('last_url','hola');
	}

	public function index()
	{
		redirect('ciclo/lista');	
	}

	public function lista()
	{
		$this->load->model('ciclo_model','ciclo');

		//$data['ciclos'] = $this->ciclo->getCiclo();
		$data['ciclos'] = $this->ciclo->getAllCiclos();
		$data['seccion'] = 'lista';
		$this->load->view('ciclo_view',$data);
	}

	public function nuevo()
	{
		$data['browser'] = $this->agent->browser();
		$data['browser_ver'] = $this->agent->version();

		$this->load->model('ciclo_model','ciclo');
		if($this->form_validation->run('alta_ciclo') == FALSE){
			$data['seccion'] = 'nuevo';
			$this->load->view('ciclo_view',$data);
		}else{
			$post = $this->input->post(NULL, TRUE);
			$this->ciclo->guardarCiclo($post);
			$this->phpsession->flashsave('acierto','El nuevo ciclo ha sido dado de alta correctamente.');
			redirect('ciclo/lista/');
		}
			
	}

	public function ver($idciclo)
	{
		$this->load->model('ciclo_model','ciclo');
		$data['seccion'] = 'ver';
		$this->load->view('ciclo_view',$data);
	}

	public function modificar($idciclo,$accion)
	{
		$this->load->model('ciclo_model','ciclo');
		$this->ciclo->modificarCiclo($idciclo,$accion);
		$accion1 = ($accion=='activo') ? 'activado' : 'desactivado';
		$this->phpsession->flashsave('acierto',"El ciclo ha sido $accion1 con éxito.");
		redirect('ciclo/lista');
	}

	public function principal($idciclo)
	{
		$this->load->model('ciclo_model','ciclo');
		$this->ciclo->hacerPrincipal($idciclo);
		$this->phpsession->flashsave('acierto',"El ciclo ha sido modificado como ciclo principal con éxito.");
		redirect('ciclo/lista');
	}
}

/* End of file ciclo.php */
/* Location: ./application/controllers/ciclo.php */