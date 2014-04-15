<?php

class Campus_model extends CI_Model {
    /*
      #####  ####### #     #  #####  #     # #       #######    #
      #     # #     # ##    # #     # #     # #          #      # #
      #       #     # # #   # #       #     # #          #     #   #
      #       #     # #  #  #  #####  #     # #          #    #     #
      #       #     # #   # #       # #     # #          #    #######
      #     # #     # #    ## #     # #     # #          #    #     #
      #####  ####### #     #  #####   #####  #######    #    #     #
     */

    function getcampus($idcampus = 0) {
        if ($idcampus == 0) {

            $pages = 10; //Numero de registros mostrados por páginas
            $this->load->library('pagination'); //Cargamos la librería de paginación
            $config = config_paginacion();
            $config['base_url'] = site_url('campus/lista/'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
            $config['total_rows'] = $this->totalcampus();
            $config['per_page'] = $pages;
            $config['num_links'] = 5; //Numero de links mostrados en la paginación
            $config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.



            $this->pagination->initialize($config);

            $q = $this->paginarcampus($config['per_page'], $this->uri->segment(3));
        } else {
            $q = $this->db->get_where('campus', array('idcampus' => $idcampus));
        }

        return $q->result_array();
    }

    function getAllcampus() {
        $q = $this->db->get_where('campus');
        return $q->result_array();
    }

    function getcampusbyuni($iduniversidad) {
        //$iduniversidad = (empty($iduniversidad)) ? 0 : $iduniversidad;
        $this->db->order_by('nombre', 'ASC');
        $q = $this->db->get_where('campus', array('universidad_iduniversidad' => $iduniversidad,'activo'=>'SI'));
        return $q->result_array();
    }

    public function get_carreras_campus($id_campus) {
        $this->db->order_by('titulo', 'ASC');
        $q = $this->db->get_where('carrera', array('campus_idcampus' => $id_campus));
        return $q->result_array();
    }

    function paginarcampus($per_page, $segment) {

        $this->db->where(array('campus.activo' => 'SI'));
        $this->db->join('universidad', 'universidad_iduniversidad = iduniversidad');
        $q = $this->db->get('campus', $per_page, $segment);
        return $q;
    }

    function totalcampus() {

        //$this->db->where(array('activo' => 'SI'));
        $q = $this->db->get('campus');
        return $q->num_rows();
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

    function guardarcampus($post, $beditar = 0) {
        $data = array(
            'nombre' => $post['nombre'],
            'code_campus' => $post['code'],
            'universidad_iduniversidad' => $post['uni'],
            'fecha_edicion' => date('Y-m-d H:i:s')
        );

        if ($beditar == 0) {
            $this->db->insert('campus', $data);
        } else {

            $this->db->where(array('idcampus' => $post['formhid']));
            $this->db->update('campus', $data);
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

    function borrarcampus($idcampus) {
        $this->db->where('idcampus', $idcampus);
        $this->db->update('campus', array('activo' => 'NO'));
    }

    function modificarcampus($idcampus, $accion) {
        $tmp = ($accion == 'activo') ? 'SI' : 'NO';
        $this->db->where('idcampus', $idcampus);
        $this->db->update('campus', array('activo' => $tmp));
    }

}