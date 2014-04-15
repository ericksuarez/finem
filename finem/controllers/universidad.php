<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Universidad extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/universidad
	 *	- or -  
	 * 		http://example.com/index.php/universidad/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/universidad/<method_name>
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
		redirect('universidad/lista');	
	}

	public function lista()
	{
		$this->load->model('universidad_model','universidad');

		$data['universidades'] = $this->universidad->getuniversidad();
		// $data['universidades'] = $this->universidad->getAlluniversidads();
		$data['seccion'] = 'lista';
		$this->load->view('universidad_view',$data);
	}

	public function nuevo()
	{
		$data['browser'] = $this->agent->browser();
		$data['browser_ver'] = $this->agent->version();

		$this->load->model('universidad_model','universidad');
		if($this->form_validation->run('alta_universidad') == FALSE){
			$data['seccion'] = 'nuevo';
			$this->load->view('universidad_view',$data);
		}else{
			$post = $this->input->post(NULL, TRUE);
			$this->universidad->guardaruniversidad($post);
			$this->phpsession->flashsave('acierto','La nueva universidad ha sido dado de alta correctamente.');
			redirect('universidad/lista/');
		}
			
	}

	public function ver($iduniversidad)
	{
		$this->load->model('universidad_model','universidad');
		$tmp = $this->universidad->getuniversidad($iduniversidad);		
		$data['universidades'] = $tmp[0];
		$data['seccion'] = 'ver';
		$beditar = 1;
		
		if($this->form_validation->run('alta_universidad') == FALSE) {
		
			$this->load->view('universidad_view',$data);			
		} else {			
			
			$post = $this->input->post(NULL, TRUE);
			$this->universidad->guardaruniversidad($post, $beditar);
			$this->phpsession->flashsave('acierto','La universidad ha sido actualizada correctamente.');
			redirect('universidad/lista/');
		}		
	}

	public function modificar($iduniversidad,$accion)
	{
		$this->load->model('universidad_model','universidad');
		$this->universidad->modificaruniversidad($iduniversidad,$accion);
		$accion1 = ($accion=='activo') ? 'activado' : 'eliminada';
		$this->phpsession->flashsave('acierto',"La universidad ha sido $accion1 con éxito.");
		redirect('universidad/lista');
	}

	public function principal($iduniversidad)
	{
		$this->load->model('universidad_model','universidad');
		$this->universidad->hacerPrincipal($iduniversidad);
		$this->phpsession->flashsave('acierto',"El universidad ha sido modificado como universidad principal con éxito.");
		redirect('universidad/lista');
	}
}

/* End of file universidad.php */
/* Location: ./application/controllers/universidad.php */