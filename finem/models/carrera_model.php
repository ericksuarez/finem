<?php class Carrera_model extends CI_Model {
    /**
     * OBSOLETA 
     * 
     * @param type $page
     * @param type $iduniversidad
     * @param type $idcampus
     * @param type $carrera
     * @param type $campos
     * @return type
     */
	/*public function buscar($page,$iduniversidad=0,$idcampus=0,$carrera='',$campos='*'){
            
            $pages = 50; //Numero de registros mostrados por páginas
            $this->load->library('pagination'); //Cargamos la librería de paginación
            $config = config_paginacion();
            
            $config['base_url'] = base_url() . 'carrera/lista/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
            $config['total_rows'] = $this->totalcarreras($iduniversidad,$idcampus,$carrera);
            $config['per_page'] = $pages;
            $config['num_links'] = 5; //Numero de links mostrados en la paginación
            $config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.

            

            $this->pagination->initialize($config);

            $q = $this->paginarcarreras($iduniversidad,$idcampus,$carrera,$campos,$config['per_page'], $page);

            return $q->result_array();
            
        }*/
        
        public function listado($paginas,$campos='*'){
            
            $pages = $paginas; //Numero de registros mostrados por páginas
            $this->load->library('pagination'); //Cargamos la librería de paginación
            $config = config_paginacion(TRUE);
            
            $config['base_url'] = base_url() . 'carrera/lista/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
            $config['total_rows'] = $this->totalcarreras();
            $config['per_page'] = $pages;
            $config['num_links'] = 5; //Numero de links mostrados en la paginación
            $config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.

            

            $this->pagination->initialize($config);

            $q = $this->paginarcarreras($config['per_page'], $this->uri->segment(3),$campos);

            return $q->result_array();
            
        }
        
        public function paginarcarreras($per_page, $segment,$campos='*'){
            $get = $_GET;
            $carrera = $get['car'];
            $idcampus = $get['cam'];
            $iduniversidad = $get['uni'];
            
            if($carrera != ''){
                $this->db->like('carrera.titulo',$carrera,'after');
            }
            
            if($idcampus != 0){
                $this->db->where('campus.idcampus',$idcampus);
            }
            
            if($iduniversidad != 0){
                $this->db->where('universidad.iduniversidad',$iduniversidad);
            }
            
            $this->db->order_by('nombre_comercial','ASC');
            $this->db->order_by('nombre','ASC');
            $this->db->order_by('titulo','ASC');
            $this->db->select($campos);
            $this->db->join('campus','iduniversidad = universidad_iduniversidad');
            $this->db->join('carrera','idcampus = campus_idcampus');
            $q = $this->db->get('universidad',$per_page, $segment);
            
            
            return $q;
        }
        
        public function totalcarreras(){
            
            $get = $_GET;
            $carrera = $get['car'];
            $idcampus = $get['cam'];
            $iduniversidad = $get['uni'];
            
            if($carrera != ''){
                $this->db->like('carrera.titulo',$carrera,'after');
            }
            
            if($idcampus != 0){
                $this->db->where('campus.idcampus',$idcampus);
            }
            
            if($iduniversidad != 0){
                $this->db->where('universidad.iduniversidad',$iduniversidad);
            }
            
            $this->db->order_by('nombre_comercial','ASC');
            $this->db->order_by('nombre','ASC');
            $this->db->order_by('titulo','ASC');
            $this->db->join('campus','iduniversidad = universidad_iduniversidad');
            $this->db->join('carrera','idcampus = campus_idcampus');
            $q = $this->db->get('universidad');
            
            
            return $q->num_rows();
        }
        
        /*
        public function paginarcarreras($iduniversidad,$idcampus,$carrera,$campos,$per_page, $segment){
            if($carrera != ''){
                $this->db->like('carrera.titulo',$carrera,'after');
            }
            
            if($idcampus != 0){
                $this->db->where('campus.idcampus',$idcampus);
            }
            
            if($iduniversidad != 0){
                $this->db->where('universidad.iduniversidad',$iduniversidad);
            }
            
            $this->db->order_by('nombre_comercial','ASC');
            $this->db->order_by('nombre','ASC');
            $this->db->order_by('titulo','ASC');
            $this->db->select($campos);
            $this->db->join('campus','iduniversidad = universidad_iduniversidad');
            $this->db->join('carrera','idcampus = campus_idcampus');
            $q = $this->db->get('universidad',$per_page, $segment);
            
            
            return $q;
        }
        
        public function totalcarreras($iduniversidad,$idcampus,$carrera){
            if($carrera != ''){
                $this->db->like('carrera.titulo',$carrera,'after');
            }
            
            if($idcampus != 0){
                $this->db->where('campus.idcampus',$idcampus);
            }
            
            if($iduniversidad != 0){
                $this->db->where('universidad.iduniversidad',$iduniversidad);
            }
            
            $this->db->order_by('nombre_comercial','ASC');
            $this->db->order_by('nombre','ASC');
            $this->db->order_by('titulo','ASC');
            $this->db->join('campus','iduniversidad = universidad_iduniversidad');
            $this->db->join('carrera','idcampus = campus_idcampus');
            $q = $this->db->get('universidad');
            
            
            return $q->num_rows();
        }
        */
        public function get_one($idcarrera,$campos='*'){
            $this->db->select($campos);
            $this->db->join('campus','iduniversidad = universidad_iduniversidad');
            $this->db->join('carrera','idcampus = campus_idcampus');
            $q = $this->db->get_where('universidad',array('idcarrera'=>$idcarrera));
            if($q->num_rows() == 1){
                $tmp = $q->result_array();
            }else{
                $tmp[0] = array();
            }
            
            return $tmp[0];
            
        }
        
        public function guardar($post,$editar = FALSE){
            
            if($post['marca_plan'] == 'semestral'){
                $post['semestres'] = $post['duracion'];
            }elseif($post['marca_plan'] == 'cuatrimestral'){
                $post['cuatrimestres'] = $post['duracion'];
            }else{
                $post['trimestres'] = $post['duracion'];
            }
            
            if($editar == TRUE){
                $this->db->where('idcarrera',$post['id']);
                unset($post['id']);
                unset($post['duracion']);
                $this->db->update('carrera',$post);
            }else{
                $post['campus_idcampus'] = $post['campus'];
                unset($post['uni']);
                unset($post['campus']);
                unset($post['duracion']);
                
                $this->db->insert('carrera',$post);
            }
        }
        
        public function borrar($idcarrera){
            $this->db->delete('carrera',array('idcarrera' => $idcarrera));
        }
        
        /**
         * Obtiene el plazo de una carrera.
         * @param integer $idcarrera
         * @return int
         */
        public function get_plazo($idcarrera){
            $c = $this->get_one($idcarrera,'marca_plan,semestres,cuatrimestres,trimestres');
            if(!empty($c)){
                if($c['marca_plan'] == 'semestral'){
                    $x = $c['semestres'];
                }elseif($c['marca_plan'] == 'cuatrimestral'){
                    $x = $c['cuatrimestres'];
                }else{
                    $x = $c['trimestres'];
                }
            }else{
                $x = 1;
            }
            
            return $x;
        }
        
        
	
}