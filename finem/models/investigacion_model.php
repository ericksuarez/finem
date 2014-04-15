<?php

Class Investigacion_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->model('log_model', 'log');
    }

    public function guardar($post, $tipo) {
        $reglas = $this->config->item('inv_' . $tipo);
        //print_r($post);
        if ($tipo == 'padre') {
            $post = limpia_moneda($post, array('padre_ingreso', 'madre_ingreso'));
        } elseif ($tipo == 'aval') {
            $post = limpia_moneda($post, array('aval_ingreso1', 'aval_ingreso2', 'aval_a91', 'aval_a101', 'aval_i91', 'aval_i101', 'aval_a92', 'aval_a102', 'aval_i92', 'aval_i102',));
        } elseif ($tipo == 'personal') {
            $post = limpia_moneda($post, array('trabajo_ingreso'));
        }
        $data = cambia_llaves($post, $reglas, TRUE);

        //print_r($data);

        $q = $this->get($post['idexpediente'], $tipo);

        if (!empty($q)) {
            $this->db->where('expediente_idexpediente', $post['idexpediente']);
            $this->db->update('inv_' . $tipo, $data);
        } else {
            $data['expediente_idexpediente'] = $post['idexpediente'];
            $this->db->insert('inv_' . $tipo, $data);
        }

        $user = $this->phpsession->get('user', 'finem');
        $this->log->guardar('inv_' . $tipo, 'edicion', $user['idusuario'], $post['idexpediente']);
    }

    public function get($id, $tabla, $campos = '*') {
        $this->db->select($campos);
        $q = $this->db->get_where('inv_' . $tabla, array('expediente_idexpediente' => $id));

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
        } else {
            $tmp[0] = array();
        }

        return $tmp[0];
    }
    
    public function get_familiar($idexp){
        $test1 = $this->get($idexp, 'familiar');
        $test2 = $this->get($idexp, 'familiarex0');
        $test3 = $this->get($idexp, 'familiarex1');
        
        $tmp = array_merge($test1,$test2);
        $final = array_merge($tmp,$test3);
        
        return $final;
    }

    public function guardar_fotos($post) {
        $files = $_FILES;
        $arreglo = array(1 => 'img1', 2 => 'img2', 3 => 'img3', 4 => 'img4', 5 => 'img5',6=>'img6',7=>'img7');
        $data = FALSE;
        $data['error'] = array();
        //Suben las imagenes
        foreach ($arreglo as $a) {
            if (!empty($files[$a])) {
                $img = $this->sube_imagen($a, $post['idexpediente']);
                if ($img['no_upload'] == 1) {
                    $data['error'][$a] = $img['error'];
                }
                $data[$a] = $img['imagen'];
            }
        }

        $test = $this->get($post['idexpediente'], 'fotos', 'id_inv_fotos');
        
        $datos = array(
            'foto1' => $data['img1'],
            'foto2' => $data['img2'],
            'foto3' => $data['img3'],
            'foto4' => $data['img4'],
            'foto5' => $data['img5'],
            'foto6' => $data['img6'],
            'foto7' => $data['img7'],
            'des1' => $post['descrip1'],
            'des2' => $post['descrip2'],
            'des3' => $post['descrip3'],
            'des4' => $post['descrip4'],
            'des5' => $post['descrip5'],
            'des6' => $post['descrip6'],
            'des7' => $post['descrip7'],
            'mapa_acreditado' => $post['mapa1'],
            'mapa_aval' => $post['mapa2'],
            'coord1' => serialize($this->mapaCoords($post['mapa1'])),
            'coord2' => serialize($this->mapaCoords($post['mapa2']))
        );
        
        //print_r($datos);
        
        if (!empty($test)) {
            //Actualiza
            foreach ($arreglo as $k => $a) {
                if (isset($data['error'][$a])) {
                    unset($datos['foto' . $k]);
                }
            }

            if (empty($datos['mapa_acreditado'])) {
                unset($datos['mapa_acreditado']);
                unset($datos['coord1']);
            }

            if (empty($datos['mapa_aval'])) {
                unset($datos['mapa_aval']);
                unset($datos['coord2']);
            }

            $this->db->where(array('expediente_idexpediente' => $post['idexpediente']));
            $this->db->update('inv_fotos', $datos);
            //$acierto = TRUE;
        } else {
            //INSERTA
            $datos['expediente_idexpediente'] = $post['idexpediente'];
            $this->db->insert('inv_fotos', $datos);
            //$acierto = TRUE;
        }

        //if($acierto == TRUE){
        $user = $this->phpsession->get('user', 'finem');
        $this->log->guardar('inv_fotos', 'edicion', $user['idusuario'], $post['idexpediente']);
        //}

        return $data['error'];
    }
    
    public function mapaCoords($iframe){
        $data = array('c1' => 0, 'c2' => 0);
        if(!empty($iframe)){
            
            $foo = (strpos($iframe, '3d') + 2);
            $foo2 = strpos($iframe, '!',$foo);
            //echo $foo2;
            $c1 = substr($iframe,$foo,$foo2 - $foo);
            //echo $c1;
            $c1 = is_numeric($c1) ? $c1 : 0;
            
            $foo = (strpos($iframe, '2d') +2);
            $foo2 = strpos($iframe, '!',$foo);
            //echo $foo2;
            $c2 = substr($iframe,$foo,$foo2 - $foo);
            //echo $c2;
            //$bar =  strpos($test, '2d');
            //$c1 = substr($post['mapa1'],strpos($string, ' '), strpos($string, ' '));
            $c2 = is_numeric($c2) ? $c2 : 0;
            $data = array('c1' => $c1,'c2' => $c2);
        }
        
        return $data;
    }
    
    public function sube_imagen($pos, $mat) {

        if (!file_exists('uploads/investigacion/' . $mat . '/')) {
            mkdir('uploads/investigacion/' . $mat . '/', 0777, true);
        }
        $config['upload_path'] = './uploads/investigacion/' . $mat . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '800';
        $config['max_width'] = '1024';
        $config['max_height'] = '800';
        $config['file_name'] = $pos;
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($pos)) {
            $data['no_upload'] = 1;
            $data['error'] = $this->upload->display_errors();

            //$this->load->view('upload_form', $error);
            $data['imagen'] = 'sin_imagen.jpg';
        } else {
            $data['no_upload'] = 0;
            $img = $this->upload->data();
            $data['imagen'] = $img['file_name'];
            //$this->load->view('upload_success', $data);
            //$this->db->where(array('idexpediente' => $idexpediente));
            //$this->db->update('expediente', array('foto' => $img['upload_data']['file_name']));
        }
        return $data;
    }

    public function guardar_familiar($post) {

        $reglas1 = $this->config->item('inv_familiar');
        $reglas2 = $this->config->item('inv_familiarex0');
        $reglas3 = $this->config->item('inv_familiarex1');

        $limpieza = array('valortotal', 'adeudo', 'diferencia', 'activo_monto1', 'activo_monto2', 'pasivo_monto1', 'pasivo_monto2', 'ingresos_total');

        for ($i = 1; $i < 10; $i++) {
            $limpieza[] = 'valor' . $i;
            $limpieza[] = 'adeudo' . $i;
            $limpieza[] = 'ingresos_mensual' . $i;
        }

        for ($i = 1; $i < 5; $i++) {
            $limpieza[] = 'prima' . $i;
            $limpieza[] = 'suma_asegurada' . $i;
        }

        for ($i = 1; $i < 37; $i++) {
            $limpieza[] = 'egresomen' . $i;
            $limpieza[] = 'egresoanu' . $i;
        }

        $post = limpia_moneda($post, $limpieza);


        $data1 = cambia_llaves($post, $reglas1, TRUE);
        $data2 = cambia_llaves($post, $reglas2, TRUE);
        $data3 = cambia_llaves($post, $reglas3, TRUE);

        $test1 = $this->get($post['idexpediente'], 'familiar', 'idinv_familiar');
        $test2 = $this->get($post['idexpediente'], 'familiarex0', 'idinv_familiar');
        $test3 = $this->get($post['idexpediente'], 'familiarex1', 'idinv_familiar');

        if (!empty($test1)) {
            $this->db->where('expediente_idexpediente', $post['idexpediente']);
            $this->db->update('inv_familiar', $data1);
        } else {
            $data1['expediente_idexpediente'] = $post['idexpediente'];
            $this->db->insert('inv_familiar', $data1);
        }

        if (!empty($test2)) {
            $this->db->where('expediente_idexpediente', $post['idexpediente']);
            $this->db->update('inv_familiarex0', $data2);
        } else {
            $data2['expediente_idexpediente'] = $post['idexpediente'];
            $this->db->insert('inv_familiarex0', $data2);
        }

        if (!empty($test3)) {
            $this->db->where('expediente_idexpediente', $post['idexpediente']);
            $this->db->update('inv_familiarex1', $data3);
        } else {
            $data3['expediente_idexpediente'] = $post['idexpediente'];
            $this->db->insert('inv_familiarex1', $data3);
        }

        $user = $this->phpsession->get('user', 'finem');
        $this->log->guardar('inv_familiar', 'edicion', $user['idusuario'], $post['idexpediente']);

        //print_r($data3);
    }
    
    function getExpediente($idexpediente = 0) {
        if ($idexpediente == 0) {

            $pages = 100; //Numero de registros mostrados por páginas
            $this->load->library('pagination'); //Cargamos la librería de paginación
            $config = config_paginacion();
            $config['base_url'] = site_url('investigacion/lista/'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
            $config['total_rows'] = $this->totalExpedientes();
            $config['per_page'] = $pages;
            $config['num_links'] = 5; //Numero de links mostrados en la paginación
            $config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.


            $this->pagination->initialize($config);

            $q = $this->paginarExpedientes($config['per_page'], $this->uri->segment(3));
        } else {

            $this->db->join('proceso', 'idexpediente=expediente_idexpediente');
            $q = $this->db->get_where('expediente', array('activo' => 'SI', 'idexpediente' => $idexpediente));
        }

        return $q->result_array();
    }

    function getAllExpedientes() {
        $q = $this->db->get('expediente');
        return $q->result_array();
    }

    function paginarExpedientes($per_page, $segment) {
        $get = $_GET;
        $user = $this->phpsession->get('user','finem');
        
        if(!empty($get)){
            //$this->phpsession->flashsave('get',$get);
            if(!empty($get['matricula'])){
                $this->db->like('matricula',$get['matricula']);
            }
            
            if(!empty($get['nom_uno'])){
                $this->db->like('alumno.nombre',$get['nom_uno']);
            }
            
            if(!empty($get['nom_dos'])){
                $this->db->like('alumno.nombre_dos',$get['nom_dos']);
            }
            
            if(!empty($get['apaterno'])){
                $this->db->like('alumno.apater',$get['apaterno']);
            }
            
            if(!empty($get['amaterno'])){
                $this->db->like('alumno.amater',$get['amaterno']);
            }
            
            if(!empty($get['uni'])){
                $this->db->like('expediente.universidad_iduniversidad',$get['uni']);
            }
            
            if(!empty($get['cam'])){
                $this->db->like('expediente.campus_idcampus',$get['cam']);
            }
            
        }
        $this->db->order_by('alumno.apater','ASC');
        $this->db->select('idexpediente,nombre_comercial as universidad,campus.nombre as campus,alumno.nombre as nombre,nombre_dos,apater,amater,matricula,fase,agencia.nombre as agencia');
        $this->db->where(array('expediente.activo' => 'SI','agencia_idagencia'=>$user['agencia_idagencia'],'investigado'=>'NO'));
        $this->db->join('proceso', 'idexpediente=expediente_idexpediente');
        $this->db->join('universidad', 'iduniversidad=universidad_iduniversidad');
        $this->db->join('campus', 'idcampus=campus_idcampus');
        $this->db->join('alumno', 'alumno_idalumno=idalumno','LEFT');
        $this->db->join('agencia', 'agencia_idagencia=idagencia','LEFT');
        $q = $this->db->get('expediente', $per_page, $segment);
        return $q;
    }

    function totalExpedientes() {
        $get = $_GET;
        $user = $this->phpsession->get('user','finem');
        if(!empty($get)){
            if(!empty($get['matricula'])){
                $this->db->like('matricula',$get['matricula']);
            }
            
            if(!empty($get['nom_uno'])){
                $this->db->like('alumno.nombre',$get['nom_uno']);
            }
            
            if(!empty($get['nom_dos'])){
                $this->db->like('alumno.nombre_dos',$get['nom_dos']);
            }
            
            if(!empty($get['apaterno'])){
                $this->db->like('alumno.apater',$get['apaterno']);
            }
            
            if(!empty($get['amaterno'])){
                $this->db->like('alumno.amater',$get['amaterno']);
            }
            
            if(!empty($get['uni'])){
                $this->db->like('expediente.universidad_iduniversidad',$get['uni']);
            }
            
            if(!empty($get['cam'])){
                $this->db->like('expediente.campus_idcampus',$get['cam']);
            }
            
            $this->db->join('proceso', 'idexpediente=expediente_idexpediente');
            $this->db->join('universidad', 'iduniversidad=universidad_iduniversidad');
            $this->db->join('campus', 'idcampus=campus_idcampus');
            $this->db->join('alumno', 'alumno_idalumno=idalumno','LEFT');
            
            $this->db->select('idexpediente');
            
        }
        $q = $this->db->get_where('expediente', array('expediente.activo' => 'SI','agencia_idagencia'=>$user['agencia_idagencia'],'investigado'=>'NO'));
        return $q->num_rows();
    }
    
    public function terminar($id){
        
        $this->db->where('idexpediente',$id);
        $this->db->update('expediente',array('investigado'=>'SI'));
        
        $user = $this->phpsession->get('user', 'finem');
        $this->log->guardar('investigacion', 'terminado', $user['idusuario'], $id);
    }
    
    public function imprimir($investigacion){
        $this->load->library('investigacion_pdf');
        
        
        $this->investigacion_pdf->abre_documento();
        $this->investigacion_pdf->cabeza($investigacion['expediente']);
        $this->investigacion_pdf->personal($investigacion['personal']);
        $this->investigacion_pdf->nueva_hoja();
        $this->investigacion_pdf->familiar($investigacion['familiar']);
        $this->investigacion_pdf->nueva_hoja();
        $this->investigacion_pdf->padres($investigacion['padre']);
        $this->investigacion_pdf->nueva_hoja();
        $this->investigacion_pdf->avales($investigacion['aval']);
        //$this->investigacion_pdf->fotos($investigacion['fotos']);
        $this->investigacion_pdf->cierra_documento();
    }
    
    public function semaforo($idexpediente){
        
        $this->db->select('investigado');
        $q = $this->db->get_where('expediente',array('idexpediente' => $idexpediente));
        if($q->num_rows() > 0){
            $tmp = $q->result_array();
            if($tmp[0]['investigado'] == 'SI'){
                $status['personal'] = 'btn-success';
                $status['familiar'] = 'btn-success';
                $status['padre'] = 'btn-success';
                $status['aval'] = 'btn-success';
                $status['foto'] = 'btn-success';
            }else{
                $inv_personal = $this->get($idexpediente,'personal','expediente_idexpediente');
                $inv_familiar = $this->get_familiar($idexpediente);
                $inv_padre = $this->get($idexpediente,'padre','expediente_idexpediente');
                $inv_aval = $this->get($idexpediente,'aval','expediente_idexpediente');
                $inv_foto = $this->get($idexpediente,'fotos','expediente_idexpediente');

                $status['personal'] = (empty($inv_personal)) ? 'btn-danger' : 'btn-warning';
                $status['familiar'] = (empty($inv_familiar)) ? 'btn-danger' : 'btn-warning';
                $status['padre'] = (empty($inv_padre)) ? 'btn-danger' : 'btn-warning';
                $status['aval'] = (empty($inv_aval)) ? 'btn-danger' : 'btn-warning';
                $status['foto'] = (empty($inv_foto)) ? 'btn-danger' : 'btn-warning';
            }
        }else{
            $status['personal'] = 'btn-danger';
            $status['familiar'] = 'btn-danger';
            $status['padre'] = 'btn-danger';
            $status['aval'] = 'btn-danger';
            $status['foto'] = 'btn-danger';
        }
        
        
        return $status;
    }
    
    public function get_cuadro($exp){
        
        $data['nombre_alumno'] = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$exp['alumno_idalumno'],TRUE);
        $data['campus'] = obtener_campo('nombre.campus','idcampus.'.$exp['campus_idcampus']);
        $data['producto'] = 'Único';
        $data['ciclo'] = obtener_campo('ciclo.ciclo','idciclo.'.$exp['ciclo_idciclo']);
        $data['matricula'] = $exp['matricula'];
        if(isset($exp['avales'][0]) && !empty($exp['avales'][0]['nombre'])){
            $data['nombre_aval1'] = $exp['avales'][0]['nombre'].' '.$exp['avales'][0]['nombre_dos'].' '.$exp['avales'][0]['apaterno'].' '.$exp['avales'][0]['amaterno'];
        }else{
            $data['nombre_aval1'] = '-----';
        }
        if(isset($exp['avales'][1]) && !empty($exp['avales'][1]['nombre'])){
            $data['nombre_aval2'] = $exp['avales'][1]['nombre'].' '.$exp['avales'][1]['nombre_dos'].' '.$exp['avales'][1]['apaterno'].' '.$exp['avales'][1]['amaterno'];
        }else{
            $data['nombre_aval2'] = '-----';
        }
        
        $data['nombre_carrera'] = obtener_campo('titulo.carrera','idcarrera.'.$exp['especialidad']);
        $data['nuevo_ingreso'] = ($exp['ciclo_escolar'] == 1) ? 'SI' : 'NO';
        $data['financiamiento'] = obtener_campo('credito_autorizado.analisis','expediente_idexpediente.'.$exp['idexpediente']).'%';
        $data['identificacion'] = obtener_campo('oficial.alumno','idalumno.'.$exp['alumno_idalumno']);
        
        return $data;
    }

}

?>
