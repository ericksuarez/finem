<?php

Class General_model extends CI_Model {            
    
    /**
     * Trae el total de registros que trae un query.
     * 
     * @param string $tabla Nombre de la base de datos a la que se hará la consulta
     * @param array $condicion Arreglo con el siguiente formato
     *      $condicion['caso_aplica'] = array('col_db' => "'valor'");
     *      caso_aplica:
     *          and, or, like, or_like, string
     * @param array $join Arreglo con el siguiente formato
     *      $join[0] = array(
     *          'tabla' => 'nombre_tabla_db',
     *          'condicion' => 'condicion que aplicará al ON',
     *          'tipo' => 'si es INNER, OUTER, LEFT, RIGHT, etc'
     *      );
     * @return array
     */
    function total_tabla($tabla, $condicion = array(), $join = array(), $bimprime = FALSE) {
        
        if (is_array($join) AND count($join) > 0) {
            
            //$join_cond = "pe.id_contrato = con.id_contrato AND (pe.tipo_pago = 'seguro' OR pe.tipo_pago IS NULL)";
            foreach ($join as $key => $posicion) {
                
                $this->db->join($posicion['tabla'], $posicion['condicion'], $posicion['tipo']);
            }
        }
        
        if (is_array($condicion) AND count($condicion) > 0) {
            
            if (isset($condicion['string'])) {
                
                if (!empty($condicion['string'])) {
                
                    $this->db->where($condicion['string'], NULL, FALSE);
                }
            }
            
            if (isset($condicion['and'])) {
                
                if (is_array($condicion['and']) AND count($condicion['and']) > 0) {

                    $this->db->where($condicion['and'], NULL, FALSE);            

                }
            }
            
            if (isset($condicion['or'])) {
                
                if (is_array($condicion['or']) AND count($condicion['or']) > 0) {

                    foreach ($condicion['or'] as $posicion => $valor) {

                        $this->db->or_where($posicion, $valor); 
                    }
                }
            }
            
            if (isset($condicion['like'])) {
                
                if (is_array($condicion['like']) AND count($condicion['like']) > 0) {

                    foreach ($condicion['like'] as $posicion => $valor) {

                        $this->db->like($posicion, $valor, 'both'); 
                    }
                }
            }
            
            if (isset($condicion['or_like'])) { 
                
                if (is_array($condicion['or_like']) AND count($condicion['or_like']) > 0) {

                    foreach ($condicion['or_like'] as $posicion => $valor) {

                        $this->db->or_like($posicion, $valor, 'both'); 
                    }
                }
            }
            
            //$this->db->or_where('pe.tipo_pago', NULL); 
        }
        
        $q = $this->db->get($tabla);  
        
        if ($bimprime == TRUE) {
            echo '<br> <b>QUERY:</b> '.$this->db->last_query();
            echo '<br> <b>RESULT:</b> '; print_r($q->result_array());
        }
        
        return  $q->num_rows() ;
    }
    
    
    /**
     * Hace la búsqueda a la base de datos.
     * 
     * @param string $tabla Nombre de la base de datos a la que se hará la consulta
     * @param string $cols Columnas que queremos nos regrese el query
     * @param array $condicion Arreglo con el siguiente formato
     *      $condicion['caso_aplica'] = array('col_db' => "'valor'");
     *      caso_aplica:
     *          and, or, like, or_like, string
     * @param array $join Arreglo con el siguiente formato
     *      $join[0] = array(
     *          'tabla' => 'nombre_tabla_db',
     *          'condicion' => 'condicion que aplicará al ON',
     *          'tipo' => 'si es INNER, OUTER, LEFT, RIGHT, etc'
     *      );
     * @param array $order_by El órden con que queremos nos ordene el resultado
     *      Arreglo que con el siguiente formato
     *      $order_by = array('columan', 'DESC | ASC');
     * @param array $group_by Agrupa los resultados Ya sea arreglo o string
     *      Formato:
     *      $group_by = array('columnas_db');
     *      $group_by = 'columna1, columna2,columna3';
     * @param boolean $bescape Variable si queremos que escape las columnas o no
     * @param boolean $bimprimedb Variable que sirve para imprimer query, para debuggear
     * @return type
     */
    function busqueda_gral($tabla, $cols = '*', $condicion = array('AND' => array(1 => NULL)), $join = FALSE, 
            $order_by = FALSE, $group_by = FALSE, $bescape = FALSE, $bimprimedb = FALSE) {
        
        $this->db->select($cols, $bescape);
        
        if (is_array($join) AND count($join) > 0) {
            
            //$join_cond = "pe.id_contrato = con.id_contrato AND (pe.tipo_pago = 'seguro' OR pe.tipo_pago IS NULL)";
            foreach ($join as $key => $posicion) {
                
                $this->db->join($posicion['tabla'], $posicion['condicion'], $posicion['tipo']);
            }
        }        
        
        if (is_array($condicion) AND count($condicion) > 0) {
            
            if (isset($condicion['string'])) {
                
                if (!empty($condicion['string'])) {
                
                    $this->db->where($condicion['string'], NULL, FALSE);
                }
            }
            
            if (isset($condicion['and'])) {
                
                if (is_array($condicion['and']) AND count($condicion['and']) > 0) {

                    $this->db->where($condicion['and'], NULL, FALSE);            

                }
            }
            
            if (isset($condicion['or'])) {
                
                if (is_array($condicion['or']) AND count($condicion['or']) > 0) {

                    foreach ($condicion['or'] as $posicion => $valor) {

                        $this->db->or_where($posicion, $valor); 
                    }
                }
            }
            
            if (isset($condicion['like'])) {
                
                if (is_array($condicion['like']) AND count($condicion['like']) > 0) {

                    foreach ($condicion['like'] as $posicion => $valor) {

                        $this->db->like($posicion, $valor, 'both'); 
                    }
                }
            }
            
            if (isset($condicion['or_like'])) { 
                
                if (is_array($condicion['or_like']) AND count($condicion['or_like']) > 0) {

                    foreach ($condicion['or_like'] as $posicion => $valor) {

                        $this->db->or_like($posicion, $valor, 'both'); 
                    }
                }
            }            
            //$this->db->or_where('pe.tipo_pago', NULL); 
        }
        
        if (is_array($order_by) AND count($order_by) > 0) {
            
            foreach ($order_by as $posicion => $orden) {
                
                $this->db->order_by($posicion, $orden);
            }
        }
        
        if (is_array($group_by) AND count($group_by) > 0) {
            $this->db->group_by($group_by);
        }
        
        $q = $this->db->get($tabla);
        
        if ($bimprimedb == TRUE) {
            echo '<br> <b>QUERY:</b> '.$this->db->last_query();
            echo '<br> <b>RESULT:</b> '; print_r($q->result_array());
        }
        //return $q;
        return $q->result_array();
    }
        
    /**
     * Trae los resultados de una búsqueda, pensada para la paginación.
     * 
     * @param string $tabla Nombre de la base de datos a la que se hará la consulta
     * @param type $per_page Cuantos resultados mostrar por página
     * @param type $segment Posicion de la URL donde se encuentra la paginacion de acuerdo CI
     * @param string $cols Columnas que queremos nos regrese el query
     * @param array $condicion Arreglo con el siguiente formato
     *      $condicion['caso_aplica'] = array('col_db' => "'valor'");
     *      caso_aplica:
     *          and, or, like, or_like, string
     * @param array $join Arreglo con el siguiente formato
     *      $join[0] = array(
     *          'tabla' => 'nombre_tabla_db',
     *          'condicion' => 'condicion que aplicará al ON',
     *          'tipo' => 'si es INNER, OUTER, LEFT, RIGHT, etc'
     *      );
     * @param array $order_by El órden con que queremos nos ordene el resultado
     *      Arreglo que con el siguiente formato
     *      $order_by = array('columan', 'DESC | ASC');
     * @param array $group_by Agrupa los resultados Ya sea arreglo o string
     *      Formato:
     *      $group_by = array('columnas_db');
     *      $group_by = 'columna1, columna2,columna3';
     * @param boolean $bescape Variable si queremos que escape las columnas o no
     * @param boolean $bimprimedb Variable que sirve para imprimer query, para debuggear
     * @return array
     */
    function paginar($tabla, $per_page, $segment, $cols, $condicion, $join, $order_by, $group_by = FALSE, 
            $bescape = FALSE, $bimprimedb = FALSE) {
        
        $this->db->select($cols, $bescape);
        
        if (is_array($join) AND count($join) > 0) {
            
            //$join_cond = "pe.id_contrato = con.id_contrato AND (pe.tipo_pago = 'seguro' OR pe.tipo_pago IS NULL)";
            foreach ($join as $key => $posicion) {
                
                $this->db->join($posicion['tabla'], $posicion['condicion'], $posicion['tipo']);
            }
        }
        
        if (is_array($condicion) AND count($condicion) > 0) {
            
            if (isset($condicion['string'])) {
                
                if (!empty($condicion['string'])) {
                
                    $this->db->where($condicion['string'], NULL, FALSE);
                }
            }
            
            if (isset($condicion['and'])) {
                
                if (is_array($condicion['and']) AND count($condicion['and']) > 0) {

                    $this->db->where($condicion['and'], NULL, FALSE);            

                }
            }
            
            if (isset($condicion['or'])) {
                
                if (is_array($condicion['or']) AND count($condicion['or']) > 0) {

                    foreach ($condicion['or'] as $posicion => $valor) {

                        $this->db->or_where($posicion, $valor); 
                    }
                }
            }
            
            if (isset($condicion['like'])) {
                
                if (is_array($condicion['like']) AND count($condicion['like']) > 0) {

                    foreach ($condicion['like'] as $posicion => $valor) {

                        $this->db->like($posicion, $valor, 'both'); 
                    }
                }
            }
            
            if (isset($condicion['or_like'])) { 
                
                if (is_array($condicion['or_like']) AND count($condicion['or_like']) > 0) {

                    foreach ($condicion['or_like'] as $posicion => $valor) {

                        $this->db->or_like($posicion, $valor, 'both'); 
                    }
                }
            }            
            //$this->db->or_where('pe.tipo_pago', NULL); 
        }
        
        if (is_array($order_by) AND count($order_by) > 0) {
            
            foreach ($order_by as $posicion => $orden) {
                
                $this->db->order_by($posicion, $orden);
            }
        }
        
        if (is_array($group_by) AND count($group_by) > 0) {
            $this->db->group_by($group_by);
        }
        
        $q = $this->db->get($tabla, $per_page, $segment);
        
        if ($bimprimedb == TRUE) {
            echo $this->db->last_query();
        }
        return $q;
    }
    
    
    /**
     * Hace una búsqueda con paginación
     * 
     * @param string $url_links Ruta que tendrá el link de la paginación
     * @param int $uri_segment Posición que queremos que tome de la ruta de acuerdo a CI
     * @param string $tabla Nombre de la base de datos a la que se hará la consulta
     * @param string $cols Columnas que queremos nos regrese el query
     * @param array $condicion Arreglo con el siguiente formato
     *      $condicion['caso_aplica'] = array('col_db' => "'valor'");
     *      caso_aplica:
     *          and, or, like, or_like, string
     * @param array $join Arreglo con el siguiente formato
     *      $join[0] = array(
     *          'tabla' => 'nombre_tabla_db',
     *          'condicion' => 'condicion que aplicará al ON',
     *          'tipo' => 'si es INNER, OUTER, LEFT, RIGHT, etc'
     *      );
     * @param array $order_by El órden con que queremos nos ordene el resultado
     *      Arreglo que con el siguiente formato
     *      $order_by = array('columan', 'DESC | ASC');
     * @param array $group_by Agrupa los resultados Ya sea arreglo o string
     *      Formato:
     *      $group_by = array('columnas_db');
     *      $group_by = 'columna1, columna2,columna3';
     * @param int $show_rows Numero de registros a mostrar
     * @param int $num_links Numero de links que mostrará la paginación
     * @param boolean $bescape Variable si queremos que escape las columnas o no
     * @param boolean $bimprimedb Variable que sirve para imprimer query, para debuggear
     * @return type
     */
    function listado_paginacion($url_links, $uri_segment, $tabla, $cols = '*', $condicion = '', 
            $join = FALSE, $order_by = FALSE, $group_by =FALSE, $show_rows = 25, $num_links = 10, 
            $bescape = FALSE, $bimprimedb = FALSE) {

        
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $config['base_url'] = $url_links; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php                
        $config['total_rows'] = $this->total_tabla($tabla, $condicion, $join);
        $config['per_page'] = $show_rows; // Numero de registros mostrados por páginas
        $config['num_links'] = $num_links; //Numero de links mostrados en la paginación
        $config["uri_segment"] = $uri_segment; // La posición que va a tomar de la URL para saber donde está la numeración

        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'Primero';
        $config['last_link'] = '<i class="icon-double-angle-right"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<i class=" icon-angle-left"></i> ';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = ' <i class=" icon-angle-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $q = $this->paginar($tabla, $config['per_page'], $this->uri->segment($uri_segment), $cols, 
                $condicion, $join, $order_by, $group_by, $bescape, $bimprimedb);
        return $q->result_array();
    }
    
    /**
     * Guarda o actualiza la información en una tabla de la base de datos.
     * Toma la decisión de guardar o actualizar si la variable condición es un arreglo lleno.
     * 
     * @param string $tabla Nombre de la tabla donde se va a almacenar la información
     * @param array $datos Datos que se van a almacenar en dicha tabla
     * @param array $condicion Condiciones para actualizar en la base de datos
     * @param array $set_values
     * @param boolean $bimprimir
     * @return string Regresa el último id insertado si fue el caso.
     */
    function guardar_informacion($tabla, $datos, $condicion = FALSE, $set_values = FALSE, $bimprimir = FALSE) {
        
        if (!empty($tabla) AND is_array($datos) AND count($datos) > 0) {
            
            if (is_array($set_values) AND count($set_values)) {
                foreach ($set_values as $columna => $valor) {
                    $this->db->set($columna, $valor, FALSE);
                }
            }
                
            // SI VIENE LA CONDICION LLENA Y ARREGLO ES PORQUE SE VA A ACTUALIZAR.
            if (is_array($condicion) AND count($condicion) > 0) {                
                
                // ACTUALIZAR                
                $this->db->where($condicion);
                $this->db->update($tabla, $datos);	
                
            } else {
                
                // INSERTAR
                $this->db->insert($tabla, $datos);
                return $this->db->insert_id();
            }
            
            if ($bimprimir == TRUE) {
                echo $this->db->last_query();
            }
        }
    }
}
?>
