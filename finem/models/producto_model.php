<?php

class Producto_model extends CI_Model {
    /*
      #####  ####### #     #  #####  #     # #       #######    #
      #     # #     # ##    # #     # #     # #          #      # #
      #       #     # # #   # #       #     # #          #     #   #
      #       #     # #  #  #  #####  #     # #          #    #     #
      #       #     # #   # #       # #     # #          #    #######
      #     # #     # #    ## #     # #     # #          #    #     #
      #####  ####### #     #  #####   #####  #######    #    #     #
     */

    function getproducto($idproducto = 0) {
        if ($idproducto == 0) {

            $pages = 10; //Numero de registros mostrados por páginas
            $this->load->library('pagination'); //Cargamos la librería de paginación
            $config = config_paginacion();
            $config['base_url'] = site_url('producto/lista/'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
            $config['total_rows'] = $this->totalproductos();
            $config['per_page'] = $pages;
            $config['num_links'] = 5; //Numero de links mostrados en la paginación
            $config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.

           

            $this->pagination->initialize($config);

            $q = $this->paginarproductos($config['per_page'], $this->uri->segment(3));
        } else {
            $q = $this->db->get_where('producto', array('idproducto' => $idproducto));
        }

        return $q->result_array();
    }

    function getAllproductos() {
        $this->db->where(array('activo' => 'SI'));
        $q = $this->db->get('producto');
        return $q->result_array();
    }

    function paginarproductos($per_page, $segment) {
        $this->db->where(array('activo' => 'SI'));
        $q = $this->db->get('producto', $per_page, $segment);
        return $q;
    }

    function totalproductos() {
        $this->db->where(array('activo' => 'SI'));
        $q = $this->db->get('producto');
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

    function guardarproducto($post, $editar = FALSE) {
        $data = array(
            'nombre' => $post['nom'],
            'condusef' => $post['condu'],
            'descripcion' => $post['descripcion'],
            'fecha_edicion' => date('Y-m-d H:i:s')
        );

        if ($editar == FALSE) {
            $this->db->insert('producto', $data);
        } else {
            $this->db->where(array('idproducto' => $post['id']));
            $this->db->update('producto', $data);
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

    function modificarproducto($idproducto, $accion) {
        $tmp = ($accion == 'activo') ? 'SI' : 'NO';
        $this->db->where('idproducto', $idproducto);
        $this->db->update('producto', array('activo' => $tmp));
    }

    function borrarproducto($idproducto) {
        $this->db->where('idproducto', $idproducto);
        $this->db->update('producto', array('activo' => 'NO'));
    }

}