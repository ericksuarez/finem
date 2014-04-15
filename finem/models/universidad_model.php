<?php class Universidad_model extends CI_Model {

	/* 
		  #####  ####### #     #  #####  #     # #       #######    #    
		 #     # #     # ##    # #     # #     # #          #      # #   
		 #       #     # # #   # #       #     # #          #     #   #  
		 #       #     # #  #  #  #####  #     # #          #    #     # 
		 #       #     # #   # #       # #     # #          #    ####### 
		 #     # #     # #    ## #     # #     # #          #    #     # 
		  #####  ####### #     #  #####   #####  #######    #    #     #
	 */

	function getuniversidad($iduniversidad=0){
		if($iduniversidad==0){

			$pages=10; //Numero de registros mostrados por páginas
			$this->load->library('pagination'); //Cargamos la librería de paginación
                        $config = config_paginacion();
			$config['base_url'] = site_url('universidad/lista/'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
			$config['total_rows'] = $this->totaluniversidads();    
			$config['per_page'] = $pages; 
			$config['num_links'] = 5; //Numero de links mostrados en la paginación
			$config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.

			$this->pagination->initialize($config); 
	 	
			$q = $this->paginaruniversidads($config['per_page'],$this->uri->segment(3));

			
		}else{
			$q=$this->db->get_where('universidad',array('iduniversidad'=>$iduniversidad));
		}

		return $q->result_array();
	}

	function getAlluniversidades(){
                $this->db->order_by('nombre_comercial','ASC');
		$q = $this->db->get_where('universidad');
		return $q->result_array();
	}

	function getalluniversidadescampus(){
		$this->load->model('campus_model','campus');
		$universidades = $this->getAlluniversidades();
		foreach($universidades as $universidad){
			$uni[$universidad['iduniversidad']]['mayor'] = $universidad;
			$uni[$universidad['iduniversidad']]['campus'] = $this->campus->getcampusbyuni($universidad['iduniversidad']);
		}
		return $uni;
	}
	

	function paginaruniversidads($per_page,$segment) {
	
		$this->db->where(array('activo' => 'SI'));
		$this->db->order_by('razon_social', 'ASC');
		$q = $this->db->get('universidad', $per_page,$segment);
		return $q;
	}

	function totaluniversidads(){
	
		$this->db->where(array('activo' => 'SI'));
		$q = $this->db->get('universidad');
		return  $q->num_rows() ;
	}

	/* 
		 #####  ######  #######    #     #####  ### ####### #     # 
		#     # #     # #         # #   #     #  #  #     # ##    # 
		#       #     # #        #   #  #        #  #     # # #   # 
		#       ######  #####   #     # #        #  #     # #  #  # 
		#       #   #   #       ####### #        #  #     # #   # # 
		#     # #    #  #       #     # #     #  #  #     # #    ## 
		 #####  #     # ####### #     #  #####  ### ####### #     #
	 */

	function guardaruniversidad($post, $beditar = 0){
		$data = array(
			'razon_social' => $post['razon'],
			'nombre_comercial' => $post['nombre'],
			'convenio_cie' => $post['convenio'],
			'fecha_edicion'=>date('Y-m-d H:i:s')
			);
		
		if ($beditar == 0) {
			$this->db->insert('universidad',$data);				
		} else {
		
			$this->db->where(array('iduniversidad' => $post['formhid']));				
			$this->db->update('universidad',$data);				
		}
	}

	/*

		####### ######  ###  #####  ### ####### #     # 
		#       #     #  #  #     #  #  #     # ##    # 
		#       #     #  #  #        #  #     # # #   # 
		#####   #     #  #  #        #  #     # #  #  # 
		#       #     #  #  #        #  #     # #   # # 
		#       #     #  #  #     #  #  #     # #    ## 
		####### ######  ###  #####  ### ####### #     # 
   
   */

	function modificaruniversidad($iduniversidad,$accion){
		$tmp = ($accion == 'activo') ? 'SI' : 'NO';
		$this->db->where('iduniversidad', $iduniversidad);
		$this->db->update('universidad', array('activo'=>$tmp)); 
	}

	function hacerPrincipal($iduniversidad){
		$this->db->where('iduniversidad', $iduniversidad);
		$this->db->update('universidad', array('main'=>'SI'));

		$this->db->where(array('iduniversidad !='=>$iduniversidad));
		$this->db->update('universidad',array('main'=>'NO')); 
	}
	
}