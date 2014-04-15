<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expediente extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/expediente
     * 	- or -  
     * 		http://example.com/index.php/expediente/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/expediente/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {

        parent::__construct();
        $this->login->checkLogin();
        /* Verificar la sesión */

        $this->load->model('expediente_model', 'expediente');
        $this->load->model('Universidad_model', 'universidad');
        $this->load->model('Campus_model', 'campus');

        //$this->phpsession->save('last_url','hola');
    }

    public function index() {

        redirect('expediente/lista');
    }

    public function lista() {

        //$this->load->model('expediente_model','expediente');

        $data['universidades'] = $this->universidad->getAlluniversidades();
        $uni = (isset($_GET['uni'])) ? $_GET['uni'] : 0;
        $data['campi'] = $this->campus->getcampusbyuni($uni);
        $data['agencias'] = $this->expediente->getAgencia();
        $data['expedientes'] = $this->expediente->getExpediente();
        //$data['porcentajes'] = $this->expediente->get_porcentaje_total($data['expedientes']);

        $data['seccion'] = 'lista';

        $this->load->view('expediente/lista', $data);
    }

    public function limpiar_lista() {
        redirect('expediente/lista');
    }
    
    public function asignar_agencia(){
        $this->form_validation->set_rules('exp','Matricula','required');
        $this->form_validation->set_rules('agencia','Agencia','required');
        
        $post = $this->input->post(NULL, TRUE);
        
        if($this->form_validation->run() === FALSE){
            $this->phpsession->flashsave('error',  validation_errors());
        } else {
            $this->expediente->asignar_agencia($post['exp'],$post['agencia']);
            $this->phpsession->flashsave('acierto','La agencia ha sido asignada con éxito.');

            
        }
        
        if (!empty($post['page'])) {
            redirect('expediente/lista/' . $post['page']);
        } elseif (!empty($post['gets'])) {
            $post['gets'] = str_replace(';', '', $post['gets']);
            //echo $post['gets'];
            redirect('expediente/lista?' . $post['gets']);
        } else {
            redirect('expediente/lista');
        }
        
    }

    public function nuevo() {

        if ($this->form_validation->run('alta_expediente') === FALSE) {
            $data['universidades'] = $this->universidad->getAlluniversidades();
            $iduni = (isset($_POST['uni'])) ? $_POST['uni'] : 0;
            $data['campi'] = $this->campus->getcampusbyuni($iduni);
            $this->load->view('expediente/nuevo', $data);
        } else {
            $post = $this->input->post(NULL, TRUE);
            $expediente = $this->expediente->abrirNuevo($post);
            $this->phpsession->flashsave('acierto', 'Un nuevo expediente se ha creado con el número ' . $expediente);
            redirect('expediente/ver/solicitud/' . $expediente);
        }
    }

    public function ver($accion, $idexpediente, $nuevo = 'SI') {

        //$this->load->model('log_model','log');          
        $reglas = (isset($_POST['formhid'])) ? $_POST['formhid'] : $accion . '_rules';
        $this->expediente->guardar_post($reglas);
        
        if ($this->form_validation->run($reglas) == FALSE) {
            $data['seccion'] = 'ver';
            $data['accion'] = $accion;
            $tmp = $this->expediente->getExpediente($idexpediente);
            $data['expediente'] = $tmp[0];
            $data['informacion'] = $this->expediente->getAllInfo($data['expediente'], $accion, $_POST);
            $data['menu'] = $this->expediente->semaforo($idexpediente);
            $this->load->view('expediente_view', $data);
        } else {
            $post = $this->input->post(NULL, TRUE);
            $post['idexpediente'] = $idexpediente;

            $post['accion'] = $accion;
            $acierto = $this->expediente->guardar($post);
            if ($acierto == TRUE) {
                $this->phpsession->flashsave('acierto', 'El expediente ha sido actualizado con éxito');
            }
            redirect("expediente/ver/$accion/$idexpediente");
        }
    }

    public function borrar() {
        if ($this->form_validation->run('borrar_expediente') == FALSE) {
            $this->phpsession->flashsave('error', validation_errors());
        } else {
            $post = $this->input->post(NULL, TRUE);
            $this->expediente->borrarExpediente($post);
            $this->phpsession->flashsave('acierto', "La matrícula ha sido borrada con éxito.");
        }

        redirect('expediente/lista');
    }

    public function cambiar_matricula() {
        if ($this->form_validation->run('cambiar_matricula') == FALSE) {
            $this->phpsession->flashsave('error', validation_errors());
        } else {
            $post = $this->input->post(NULL, TRUE);
            $this->expediente->cambiarMat($post);
            $this->phpsession->flashsave('acierto', "La matrícula ha sido cambiado con éxito.");
        }
        

        redirect('expediente/lista');
    }

    public function revisa_firmas($firma) {

        // FIRMA CONSUELO (POSICION 1)                    
        // FIRMA FRANCISCO MACIEL (POSICION 2)
        // FIRMA MIGUEL BISOGNO (POSICION 3)
        // FIRMA JOSÉ LUIS CABRERA (POSICION 4)              
        //$firmas = $this->input->post('firma');        
        if (is_array($firmas) AND count($firmas) > 0) {
            foreach ($firmas as $posicion => $firma) {
                if ($this->expediente->verifica_firma($firma) === FALSE) {
                    $this->form_validation->set_message('revisa_firmas', 'La firma que ha ingresado es incorrecta.');
                    return FALSE;
                    break;
                }
            }
        } else {
            if (!empty($firma)) {
                if ($this->expediente->verifica_firma($firma) === FALSE) {
                    $this->form_validation->set_message('revisa_firmas', 'La firma que ha ingresado es incorrecta.');
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
    }

    public function imprime_autorizacion($idexpediente) {

        $tmp = $this->expediente->getExpediente($idexpediente);
        $data['expediente'] = $tmp[0];
        $data['informacion'] = $this->expediente->getAllInfo($data['expediente'], 'analisis');
//print_r($data);
        $this->load->view('common/header_print');
        $this->load->view('expediente/analisis_print_view', $data);
        $this->load->view('common/footer');
    }

    public function _unique_matricula($str) {
        $q = $this->db->get_where('expediente', array('matricula' => $str, 'activo' => 'SI'));

        if ($q->num_rows() > 0) {
            $this->form_validation->set_message('_unique_matricula', 'La matrícula que esta capturando ya existe en la base de datos. Escoja otra o elimine la anterior.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function desautorizar($id_xpediente) {
        $user = $this->phpsession->get('user', 'finem');
        $foo = $this->config->item('super_admin');

        if (in_array($user['idusuario'], $foo)) {
            $this->db->where('expediente_idexpediente', $id_xpediente);
            $this->db->update('analisis', array('firma_1' => 0, 'firma_2' => 0, 'firma_3' => 0, 'firma_4' => 0));

            $this->load->model('log_model', 'log');
            $this->log->guardar('analisis', 'desautorizar', $user['idusuario'], $id_xpediente);
        }

        redirect('expediente/ver/analisis/' . $id_xpediente);
    }
    
    public function pagare($exp,$pagare=0){
        $tmp = $this->expediente->getExpediente($exp);
        $data['expediente'] = $tmp[0]; 
        $data['contrato'] = $this->expediente->get_contrato($exp);
        $data['pagare'] = $this->expediente->get_pagare($exp,$pagare);
        $data['max_pagare'] = $this->expediente->get_max_pagare($exp);
        $data['disposicion'] = $this->expediente->get_disposicion($exp);
        
        //print_r($data);
        $this->load->view('expediente/pagare_view', $data);
    }
    
    public function newpagare($exp){
        $this->expediente->create_pagare($exp);
        $this->phpsession->flashsave('acierto','Un nuevo pagaré ha sido creado con éxito.');
        
        
        
        redirect('expediente/ver/disposicion/'.$exp);
    }
    
    public function borrarpagare(){
        if($this->form_validation->run('borrar_pagare') === FALSE){
            $this->phpsession->flashsave('error',  validation_errors());
        }else{
            $post = $this->input->post(NULL,TRUE);
            $this->expediente->borrar_pagare($post);
            $this->phpsession->flashsave('acierto','El pagaré ha sido borrado con éxito.');
        }
        
        
        
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function tabla_pagare(){
        $post = $this->input->post(NULL,TRUE);
        //print_r($post);
        $response = $this->expediente->create_tabla_pagare($post);
        
        echo '<div class="alert alert-'.($response['error'] == 1 ? 'error' : 'success').'"><a data-dismiss="alert" class="close" href="#">×</a>'.$response['msj'].'</div>';
    }
    
    public function _menor_a_disposicion($str) {
        //$q = $this->db->get_where('expediente', array('matricula' => $str, 'activo' => 'SI'));
        $contrato = (isset($_POST['contract'])) ? 1 : 0;
        $disposicion = $this->expediente->get_disposiciones($_POST['id'],$_POST['numero']);
        $str = limpia_moneda($str);
        if ($str > $disposicion) {
            if($contrato == 1){
                $this->form_validation->set_message('_menor_a_disposicion', 'La primer disposición no puede ser mayor a $'.number_format($disposicion,2).'.');
            }else{
                $this->form_validation->set_message('_menor_a_disposicion', 'El importe no puede ser mayor a $'.number_format($disposicion,2).'.');
            }
            
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function bitacora($idexpediente){
        $tmp = $this->expediente->getExpediente($idexpediente);
        $data['expediente'] = $tmp[0];
        $data['historia'] = $this->expediente->get_historia($idexpediente);
        $this->load->view('expediente/bitacora_view',$data);
    }
    
    public function porcentaje_total($idexpediente){
        echo round($this->expediente->get_porcentaje_total($idexpediente));
    }
    
    public function cambiar_linea(){
        if($this->form_validation->run('cambiar_linea') === FALSE){
            $this->phpsession->flashsave('error',validation_errors());
            
        }else{
            $post = $this->input->post(NULL,TRUE);
            //print_r($post);
            $sistema = isset($post['linea_user']) ? FALSE : TRUE;
            $linea = $sistema === FALSE ? $post['linea'] : $post['linea_parcial'];
            $this->expediente->save_linea_restante($post['expediente'],$linea,$sistema);
            $this->phpsession->flashsave('acierto','La línea ha sido cambiada con éxito.');
        }
        
        redirect($_SERVER['HTTP_REFERER']);
        
    }
    
    public function ampliar_linea(){
        if($this->form_validation->run('ampliar_linea') === FALSE){
            $this->phpsession->flashsave('error',validation_errors());
            $this->phpsession->flashsave('pestania','recal-li');
            
        }else{
            $post = $this->input->post(NULL,TRUE);
            //print_r($post);
            $this->expediente->amplia_linea($post);
            $this->phpsession->flashsave('acierto','La línea ha sido ampliada con éxito.');
            
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function actualizar_linea(){
        
        $response = $this->expediente->actualizar_linea_restante();
        //print_r($response);
        $this->phpsession->flashsave($response['type'],$response['msj']);
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function _menor_anterior_linea($str){
        $idexp = $_POST['expediente'];
        $d = obtener_campo('linea_global.disposicion', 'expediente_idexpediente.'.$idexp);
        $a = obtener_campo('linea_global.analisis', 'expediente_idexpediente.'.$idexp);
        
        $anterior = ($d == NULL) ? $a : $d;
        
        $str1 = limpia_moneda($str);
        
        if ($str1 <= $anterior) {
            $this->form_validation->set_message('_menor_anterior_linea', 'La nueva línea ($'.number_format($str1,2).') no puede ser menor a la anterior ($'.number_format($anterior,2).')');
            
            
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function _menor_a_prestado($str){
        $idexp = $_POST['expediente'];
        
        $anterior = $this->expediente->get_prestado($idexp);
        echo $anterior;
        $str1 = limpia_moneda($str);
        
        if ($str1 < $anterior) {
            $this->form_validation->set_message('_menor_a_prestado', 'La nueva línea ($'.number_format($str1,2).') no puede ser menor a la suma de todos los pagarés terminados. ($'.number_format($anterior,2).')');
            
            
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

/* End of file expediente.php */

/* Location: ./application/controllers/expediente.php */