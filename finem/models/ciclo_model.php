<?php class Ciclo_model extends CI_Model {

	/* 
		  #####  ####### #     #  #####  #     # #       #######    #    
		 #     # #     # ##    # #     # #     # #          #      # #   
		 #       #     # # #   # #       #     # #          #     #   #  
		 #       #     # #  #  #  #####  #     # #          #    #     # 
		 #       #     # #   # #       # #     # #          #    ####### 
		 #     # #     # #    ## #     # #     # #          #    #     # 
		  #####  ####### #     #  #####   #####  #######    #    #     #
	 */

	function getCiclo($idciclo=0){
		if($idciclo==0){

			$pages=10; //Numero de registros mostrados por páginas
			$this->load->library('pagination'); //Cargamos la librería de paginación
			$config['base_url'] = site_url('ciclo/lista/'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
			$config['total_rows'] = $this->totalCiclos();    
			$config['per_page'] = $pages; 
			$config['num_links'] = 5; //Numero de links mostrados en la paginación
			$config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.
			
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Anterior';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Siguiente &rarr;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] =  '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config); 
	 	
			$q = $this->paginarCiclos($config['per_page'],$this->uri->segment(3));

			
		}else{
			$q=$this->db->get_where('Ciclo',array('idciclo'=>$idciclo));
		}

		return $q->result_array();
	}

	function getAllCiclos($activo='NO'){
		if($activo == 'SI'){
			$this->db->where(array('activo'=>'SI'));
		}
		$q = $this->db->get('ciclo');
		return $q->result_array();
	}

	

	function paginarCiclos($per_page,$segment) {
		$q = $this->db->get('ciclo',$per_page,$segment);
		return $q;
	}

	function totalCiclos(){
		$q = $this->db->get('ciclo');
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

	function guardarCiclo($post){
		$data = array(
			'ciclo' => $post['ciclo'],
			'activo' => $post['activo'],
			'main' => $post['vigente'],
			'fecha_edicion'=>date('Y-m-d H:i:s')
			);
		$this->db->insert('ciclo',$data);

		$q = $this->db->query("select last_insert_id() as last");
		$tmp = $q->result_array();
		foreach($tmp as $l){
			$last = $l['last'];
		}
		if($post['vigente'] == 'SI'){
			$this->db->where(array('idciclo !='=>$last));
			$this->db->update('ciclo',array('main'=>'NO'));
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

	function modificarCiclo($idciclo,$accion){
		$tmp = ($accion == 'activo') ? 'SI' : 'NO';
		$this->db->where('idciclo', $idciclo);
		$this->db->update('ciclo', array('activo'=>$tmp)); 
	}

	function hacerPrincipal($idciclo){
		$this->db->where('idciclo', $idciclo);
		$this->db->update('ciclo', array('main'=>'SI'));

		$this->db->where(array('idciclo !='=>$idciclo));
		$this->db->update('ciclo',array('main'=>'NO')); 
	}
	
}