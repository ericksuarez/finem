<?php

class Expediente_model extends CI_Model {
    /*
      #####  ####### #     #  #####  #     # #       #######    #
      #     # #     # ##    # #     # #     # #          #      # #
      #       #     # # #   # #       #     # #          #     #   #
      #       #     # #  #  #  #####  #     # #          #    #     #
      #       #     # #   # #       # #     # #          #    #######
      #     # #     # #    ## #     # #     # #          #    #     #
      #####  ####### #     #  #####   #####  #######    #    #     #
     */

    function getExpediente($idexpediente = 0) {
        if ($idexpediente == 0) {

            $pages = 100; //Numero de registros mostrados por páginas
            $this->load->library('pagination'); //Cargamos la librería de paginación
            $config = config_paginacion(TRUE);
            $config['base_url'] = site_url('expediente/lista/'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
            $config['total_rows'] = $this->totalExpedientes();
            $config['per_page'] = $pages;
            $config['num_links'] = 5; //Numero de links mostrados en la paginación
            $config["uri_segment"] = 3; //Para que los links en la paginación sean los correctos.


            $this->pagination->initialize($config);

            $q = $this->paginarExpedientes($config['per_page'], $this->uri->segment(3));
        } else {

            //$this->db->join('proceso', 'idexpediente=expediente_idexpediente');
            $q = $this->db->get_where('expediente', array('activo' => 'SI', 'idexpediente' => $idexpediente));
        }

        return $q->result_array();
    }

    function get_porcentaje_total($expedientes) {
        $total = 0;
        if (!empty($expedientes) && is_array($expedientes)) {
            foreach ($expedientes as $e) {
                $total = 0;
                $por_sol = $this->get_porcentaje($e['idexpediente'], 'solicitud');
                //echo 'POR SOL: '.$por_sol.'%<br />';
                $total += $por_sol;

                $por_buro = $this->get_porcentaje($e['idexpediente'], 'buro');
                //echo 'POR BURO: '.$por_buro.'%<br />';
                $total += $por_buro;

                $por_ced = $this->get_porcentaje($e['idexpediente'], 'cedula_analisis');
                //echo 'POR CEDULA: '.$por_ced.'%<br />';
                $total += $por_ced;

                $por_auto = $this->get_porcentaje($e['idexpediente'], 'analisis');
                //echo 'POR AUTO: '.$por_auto.'%<br />';
                $total += $por_auto;

                $por_con = $this->get_porcentaje($e['idexpediente'], 'contrato');
                //echo 'POR CON: '.$por_con.'%<br />';
                $total += $por_con;

                $por_per = $this->get_porcentaje($e['idexpediente'], 'inv_personal');
                //echo 'POR INVPER: '.$por_per.'%<br />';
                $total += $por_per;

                $por_fam = $this->get_porcentaje($e['idexpediente'], 'familiar');
                //echo 'POR INVFAM: '.$por_fam.'%<br />';
                $total += $por_fam;

                $por_pad = $this->get_porcentaje($e['idexpediente'], 'inv_padre');
                //echo 'POR INVPAD: '.$por_pad.'%<br />';
                $total += $por_pad;

                $por_aval = $this->get_porcentaje($e['idexpediente'], 'inv_aval');
                //echo 'POR INVAVAL: '.$por_aval.'%<br />';
                $total += $por_aval;

                $por_foto = $this->get_porcentaje($e['idexpediente'], 'inv_fotos');
                //echo 'POR FOTO: '.$por_foto.'%<br />';
                $total += $por_foto;

                $porcentajes[$e['idexpediente']] = ($total * 100) / (100 * 10);
            }
        } else {
            $por_sol = $this->get_porcentaje($expedientes, 'solicitud');
            //echo 'POR SOL: '.$por_sol.'%<br />';
            $total += $por_sol;

            $por_buro = $this->get_porcentaje($expedientes, 'buro');
            //echo 'POR BURO: '.$por_buro.'%<br />';
            $total += $por_buro;

            $por_ced = $this->get_porcentaje($expedientes, 'cedula_analisis');
            //echo 'POR CEDULA: '.$por_ced.'%<br />';
            $total += $por_ced;

            $por_auto = $this->get_porcentaje($expedientes, 'analisis');
            //echo 'POR AUTO: '.$por_auto.'%<br />';
            $total += $por_auto;

            $por_con = $this->get_porcentaje($expedientes, 'contrato');
            //echo 'POR CON: '.$por_con.'%<br />';
            $total += $por_con;

            $por_per = $this->get_porcentaje($expedientes, 'inv_personal');
            //echo 'POR INVPER: '.$por_per.'%<br />';
            $total += $por_per;

            $por_fam = $this->get_porcentaje($expedientes, 'familiar');
            //echo 'POR INVFAM: '.$por_fam.'%<br />';
            $total += $por_fam;

            $por_pad = $this->get_porcentaje($expedientes, 'inv_padre');
            //echo 'POR INVPAD: '.$por_pad.'%<br />';
            $total += $por_pad;

            $por_aval = $this->get_porcentaje($expedientes, 'inv_aval');
            //echo 'POR INVAVAL: '.$por_aval.'%<br />';
            $total += $por_aval;

            $por_foto = $this->get_porcentaje($expedientes, 'inv_fotos');
            //echo 'POR FOTO: '.$por_foto.'%<br />';
            $total += $por_foto;

            $porcentajes = ($total * 100) / (100 * 10);
            //echo 'POR TOTAL: '.($total * 100)/(100 * 10).'%<br />';
        }

        return $porcentajes;
    }

    function get_porcentaje($idexp, $tipo) {

        if ($tipo == 'solicitud') {
            $q1 = $this->db->get_where('expediente', array('idexpediente' => $idexp), 1);

            $idal = obtener_campo('alumno_idalumno.expediente', 'idexpediente.' . $idexp);

            $this->db->join('domicilio', 'alumno_idalumno = idalumno');
            $q2 = $this->db->get_where('alumno', array('idalumno' => $idal), 1);

            $q3 = $this->db->get_where('aval', array('alumno_idalumno' => $idal), 2);
            if ($q1->num_rows() > 0 && $q2->num_rows() > 0 && $q3->num_rows() > 0) {
                $exp = $q1->result_array();
                $alumno = $q2->result_array();
                $aval = $q3->result_array();
                $total = count($exp[0]) + count($alumno[0]) + count($aval[0]) + count($aval[1]);
                //echo count($exp[0]) .'+'. count($alumno[0]) .'+'. count($aval[0]) .'+'. count($aval[1]);
                $llenos = 0;
                foreach ($exp[0] as $c) {
                    if ($c != '' || $c != NULL) {
                        $llenos++;
                    }
                }

                foreach ($alumno[0] as $c) {
                    if ($c != '' || $c != NULL) {
                        $llenos++;
                    }
                }

                foreach ($aval as $c) {
                    if ($c != '' || $c != NULL) {
                        $llenos++;
                    }
                }
            } else {
                $llenos = 0;
                $total = 1;
            }
        } elseif ($tipo == 'familiar') {
            $q1 = $this->db->get_where('inv_familiar', array('expediente_idexpediente' => $idexp), 1);
            $q2 = $this->db->get_where('inv_familiarex0', array('expediente_idexpediente' => $idexp), 1);
            $q3 = $this->db->get_where('inv_familiarex1', array('expediente_idexpediente' => $idexp), 1);
            if ($q1->num_rows() > 0 && $q2->num_rows() > 0 && $q3->num_rows() > 0) {
                $exp = $q1->result_array();
                $alumno = $q2->result_array();
                $aval = $q3->result_array();
                $total = count($exp[0]) + count($alumno[0]) + count($aval[0]);
                //echo count($exp[0]) .'+'. count($alumno[0]) .'+'. count($aval[0]) .'+'. count($aval[1]);
                $llenos = 0;
                foreach ($exp[0] as $c) {
                    if ($c != '' || $c != NULL) {
                        $llenos++;
                    }
                }

                foreach ($alumno[0] as $c) {
                    if ($c != '' || $c != NULL) {
                        $llenos++;
                    }
                }

                foreach ($aval[0] as $c) {
                    if ($c != '' || $c != NULL) {
                        $llenos++;
                    }
                }
            } else {
                $llenos = 0;
                $total = 1;
            }
        } else {

            $q = $this->db->get_where($tipo, array('expediente_idexpediente' => $idexp), 1);

            if ($q->num_rows() > 0) {
                $tmp = $q->result_array();

                $total = count($tmp[0]);
                $llenos = 0;
                foreach ($tmp[0] as $c) {
                    if ($c != '' || $c != NULL) {
                        $llenos++;
                    }
                }
            } else {
                $llenos = 0;
                $total = 1;
            }
        }
        //echo $tipo.' '.$idexp;
        $por = ($llenos * 100) / $total;

        return $por;
    }

    public function semaforo($idexpediente) {
        $buro = $this->get_buro($idexpediente, 'idburo');
        $cedula = $this->get_cedula($idexpediente, 'bstatus');
        $analisis = $this->get_analisis($idexpediente, 'firma_1,firma_2,firma_3,firma_4');
        $contrato = $this->get_contrato($idexpediente, 'enviar_mesa');

        $status['buro'] = (empty($buro)) ? 'btn-danger' : 'btn-success';

        $firmas = $analisis['firma_1'] + $analisis['firma_2'] + $analisis['firma_3'] + $analisis['firma_4'];

        if (empty($cedula) && empty($analisis)) {
            $status['analisis'] = 'btn-danger';
        } elseif (empty($cedula) || empty($analisis)) {
            $status['analisis'] = 'btn-warning';
        } elseif ($cedula['bstatus'] == 1 && $firmas >= 2) {
            $status['analisis'] = 'btn-success';
        } else {
            $status['analisis'] = 'btn-warning';
        }

        if (empty($contrato)) {
            $status['contrato'] = 'btn-danger';
            $status['disposicion'] = 'btn-danger';
        } elseif ($contrato['enviar_mesa'] == 1) {
            $status['contrato'] = 'btn-success';
            $status['disposicion'] = 'btn-warning';
        } else {
            $status['contrato'] = 'btn-warning';
            $status['disposicion'] = 'btn-warning';
        }

        return $status;
    }

    public function getAgencia($id = 0) {
        if ($id != 0) {

            $this->db->where('idagencia', $id);
        }

        $this->db->order_by('nombre', 'ASC');
        $q = $this->db->get('agencia');

        return $q->result_array();
    }

    /* function getAgencia_byExp($idexp){

      $this->db->where('expediente_idexpediente',$idexp);
      $this->db->order_by('fecha','DESC');
      $q = $this->db->get('agencia_has_expediente',1);

      if($q->num_rows() == 1){
      $tmp= $q->result_array();
      }else{
      $tmp[0] = array();
      }
      return $tmp[0];
      } */

    function getAllExpedientes($campos = '*') {
        $this->db->select($campos);
        $this->db->where('activo', 'SI');
        $q = $this->db->get('expediente');
        return $q->result_array();
    }

    function paginarExpedientes($per_page, $segment) {
        $get = $_GET;

        if (!empty($get)) {
            //$this->phpsession->flashsave('get',$get);
            if (!empty($get['matricula'])) {
                $this->db->like('matricula', $get['matricula']);
            }

            if (!empty($get['nom_uno'])) {
                $this->db->like('alumno.nombre', $get['nom_uno']);
            }

            if (!empty($get['nom_dos'])) {
                $this->db->like('alumno.nombre_dos', $get['nom_dos']);
            }

            if (!empty($get['apaterno'])) {
                $this->db->like('alumno.apater', $get['apaterno']);
            }

            if (!empty($get['amaterno'])) {
                $this->db->like('alumno.amater', $get['amaterno']);
            }

            if (!empty($get['uni'])) {
                $this->db->where('expediente.universidad_iduniversidad', $get['uni']);
            }

            if (!empty($get['cam'])) {
                $this->db->where('expediente.campus_idcampus', $get['cam']);
            }
        }
        //$this->db->order_by('universidad.nombre_comercial','ASC');
        //$this->db->order_by('campus.nombre','ASC');
        $this->db->order_by('alumno.apater', 'ASC');
        $this->db->select('idexpediente,nombre_comercial as universidad,campus.nombre as campus,alumno.nombre as nombre,nombre_dos,apater,amater,matricula,agencia.nombre as agencia,investigado,contrato.enviar_mesa');
        $this->db->where(array('expediente.activo' => 'SI'));
        //$this->db->join('proceso', 'idexpediente=expediente_idexpediente');
        $this->db->join('universidad', 'iduniversidad=universidad_iduniversidad');
        $this->db->join('campus', 'idcampus=campus_idcampus');
        $this->db->join('alumno', 'alumno_idalumno=idalumno', 'LEFT');
        $this->db->join('agencia', 'agencia_idagencia=idagencia', 'LEFT');
        $this->db->join('contrato', 'expediente_idexpediente=idexpediente', 'LEFT');
        $q = $this->db->get('expediente', $per_page, $segment);

        //echo $this->db->last_query();
        return $q;
    }

    function totalExpedientes() {
        $get = $_GET;

        if (!empty($get)) {
            if (!empty($get['matricula'])) {
                $this->db->like('matricula', $get['matricula']);
            }

            if (!empty($get['nom_uno'])) {
                $this->db->like('alumno.nombre', $get['nom_uno']);
            }

            if (!empty($get['nom_dos'])) {
                $this->db->like('alumno.nombre_dos', $get['nom_dos']);
            }

            if (!empty($get['apaterno'])) {
                $this->db->like('alumno.apater', $get['apaterno']);
            }

            if (!empty($get['amaterno'])) {
                $this->db->like('alumno.amater', $get['amaterno']);
            }

            if (!empty($get['uni'])) {
                $this->db->where('expediente.universidad_iduniversidad', $get['uni']);
            }

            if (!empty($get['cam'])) {
                $this->db->where('expediente.campus_idcampus', $get['cam']);
            }

            //$this->db->join('proceso', 'idexpediente=expediente_idexpediente');
            $this->db->join('universidad', 'iduniversidad=universidad_iduniversidad');
            $this->db->join('campus', 'idcampus=campus_idcampus');
            $this->db->join('alumno', 'alumno_idalumno=idalumno', 'LEFT');

            $this->db->select('idexpediente');
        }
        $q = $this->db->get_where('expediente', array('expediente.activo' => 'SI'));
        return $q->num_rows();
    }

    function getAllInfo($expediente, $accion) {

        $this->load->model('alumno_model', 'alumno');
        $this->load->model('log_model', 'log');
        $this->load->model('universidad_model', 'universidad');
        $this->load->model('producto_model', 'producto');
        $this->load->model('ciclo_model', 'ciclo');

        switch ($accion) {
            case 'solicitud':

                $data['universidades'] = $this->universidad->getalluniversidadescampus();
                $iduni = (isset($_POST['universidad'])) ? $_POST['universidad'] : $expediente['universidad_iduniversidad'];
                $idcampus = (isset($_POST['campus'])) ? $_POST['campus'] : $expediente['campus_idcampus'];
                $data['campi'] = $this->campus->getcampusbyuni($iduni);
                $carreras = $this->campus->get_carreras_campus($idcampus);
                $data['carreras'] = nuevo_arreglo_from_db($carreras, 'idcarrera', 'titulo');
                $data['productos'] = $this->producto->getAllproductos();
                $data['ciclos'] = $this->ciclo->getAllCiclos('SI');
                $data['alumno'] = $this->alumno->get($expediente['alumno_idalumno']);
                $data['adom'] = $this->alumno->get_domicilio($expediente['alumno_idalumno']);
                $tiene_trabajo = (isset($data['alumno']['tiene_trabajo'])) ? $data['alumno']['tiene_trabajo'] : 'NO';
                $data['awork'] = $this->alumno->get_trabajo($tiene_trabajo, $expediente['alumno_idalumno']);
                for ($i = 1; $i < 3; $i++) {

                    $data['aval' . $i] = $this->alumno->get_aval($expediente['alumno_idalumno'], $i);
                }
                $data['log'] = $this->log->get($accion, $expediente['idexpediente']);

                break;
            case 'buro':

                $q = $this->db->get_where('buro', array('expediente_idexpediente' => $expediente['idexpediente']));
                if ($q->num_rows() > 0) {
                    $tmp = $q->result_array();
                    $data['buro'] = $tmp;
                } else {
                    $data['buro'] = array();
                }

                //echo $this->db->last_query();
                $data['log'] = $this->log->get($accion, $expediente['idexpediente']);
                break;
            case 'analisis':
                $alumno = $this->alumno->get($expediente['alumno_idalumno']);
                $adom = $this->alumno->get_domicilio($expediente['alumno_idalumno']);
                $tiene_trabajo = (isset($alumno['tiene_trabajo'])) ? $alumno['tiene_trabajo'] : 'NO';
                $awork = $this->alumno->get_trabajo($tiene_trabajo, $expediente['alumno_idalumno']);
                $q = $this->db->get_where('cedula_analisis', array('expediente_idexpediente' => $expediente['idexpediente']));
                $auto = $this->db->get_where('analisis', array('expediente_idexpediente' => $expediente['idexpediente']));
                $auto_tmp = $auto->result_array();
                if (is_array($auto_tmp) AND count($auto_tmp) > 0) {

                    $data['autorizacion'] = $auto_tmp[0];
                } else {
                    $data['autorizacion'] = FALSE;
                }

                if ($q->num_rows() > 0) {
                    $tmp = $q->result_array();
                    $analisis = $tmp[0];
                    $data['buro_info'] = unserialize($analisis['buro_credito_info']);
                    $data['capacidad_pago'] = unserialize($analisis['capacidad_pago_info']);

                    unset($analisis['buro_credito_info']);
                    unset($analisis['capacidad_pago_info']);
                } else {
                    $analisis = array();
                    $data['buro_info'] = array();
                    $data['capacidad_pago'] = array();
                }
                for ($i = 1; $i < 3; $i++) {

                    $a = $this->alumno->get_aval($expediente['alumno_idalumno'], $i);
                    $data['aval'][$i - 1] = array(
                        'nombre_completo' => $a['nombre'] . ' ' . $a['nombre_dos'] . ' ' . $a['apaterno'] . ' ' . $a['amaterno'],
                        'edad' => calcula_edad($a['nacimiento']),
                        'parentesco' => $a['parentesco'],
                        'ingresoA' => $a['ingresoA'],
                        'ingresoC' => $a['ingresoC'],
                        'egresoA' => $a['egresoA'],
                        'egresoC' => $a['egresoC'],
                    );
                }
                //print_r($awork);
                $info = array(
                    'universidad' => obtener_campo('nombre_comercial.universidad', 'iduniversidad.' . $expediente['universidad_iduniversidad']),
                    'campus' => obtener_campo('nombre.campus', 'idcampus.' . $expediente['campus_idcampus']),
                    'carrera' => obtener_campo('titulo.carrera', 'idcarrera.' . $expediente['especialidad']),
                    'ciclo_nuevo' => obtener_campo('ciclo.ciclo', 'idciclo.' . $expediente['ciclo_idciclo']),
                    'matricula' => $expediente['matricula'],
                    'avance' => 70,
                    'promediog' => $alumno['promedio'],
                    'linea' => '',
                    'adeudo' => '',
                    'producto' => obtener_campo('nombre.producto', 'idproducto.' . $expediente['producto_idproducto']),
                    'nombre_completo' => $alumno['nombre'] . ' ' . $alumno['nombre_dos'] . ' ' . $alumno['apater'] . ' ' . $alumno['amater'],
                    'edad' => calcula_edad($alumno['nacimiento']),
                    'ingreso' => (isset($awork['ingreso_mensual'])) ? $awork['ingreso_mensual'] : 0.00,
                    'egreso' => (isset($awork['egreso_mensual'])) ? $awork['egreso_mensual'] : 0.00
                );
                $data['selects'] = array(
                    'grado' => $expediente['ciclo_escolar'],
                );


                $data['info'] = array_merge($info, $analisis);

                $tmp = obtener_campo('ingreso_totalmensual.inv_familiarex0', 'expediente_idexpediente.' . $expediente['idexpediente']);
                $data['info']['total_ingresos_ese'] = ($tmp == '---') ? 0.00 : $tmp;

                $tmp = obtener_campo('totalegreso_mensual.inv_familiarex1', 'expediente_idexpediente.' . $expediente['idexpediente']);
                $data['info']['total_egresos_ese'] = ($tmp == '---') ? 0.00 : $tmp;

                $data['tabla_global'] = $this->get_tabla_pagos($expediente['idexpediente'], 'global');

                $data['log'] = $this->log->get($accion, $expediente['idexpediente']);
                break;
            case 'contrato':
                $data['analisis'] = $this->get_analisis($expediente['idexpediente'], 'linea_global,importe,firma_1,firma_2,firma_3,firma_4,plazo');


                $this->load->model('calculadora_model', 'calculadora');
                $this->load->model('carrera_model', 'carrera');

                $campos = 'numero_materias,costo_materia,semestres,cuatrimestres,trimestres,marca_plan,idcarrera,universidad.nombre_comercial as uni,campus.nombre as campus,titulo,costo_total,costo_semestral,ingresoFE';
                $carrera = $this->carrera->get_one($expediente['especialidad'], $campos);
                $carrera['costo_total'] = $data['analisis']['importe'];
                //$this->calculadora->carga_datos_carrera($carrera);
                //$param = $this->calculadora->get_parametros();
                //$tabla_pagos = $this->calculadora->tabla_pagos($param);
                //$data['plazo'] = count($tabla_pagos['mes']);
                $q = $this->db->get_where('contrato', array('expediente_idexpediente' => $expediente['idexpediente']));
                if ($q->num_rows() > 0) {
                    $tmp = $q->result_array();
                    $data['contrato'] = $tmp[0];
                } else {
                    $data['contrato'] = array();
                }
                //$this->db->order_by('idtablaparcial','ASC');
                //$q = $this->db->get_where('tablaparcial',array('expediente_idexpediente' => $expediente['idexpediente']),1);
                $data['max_pagare'] = $this->get_max_pagare($expediente['idexpediente']);
                $data['pagare'] = $this->get_pagare($expediente['idexpediente'], $data['max_pagare']);
                $data['log'] = $this->log->get($accion, $expediente['idexpediente']);


                break;
            case 'contrato_pdf':
                $data['alumno'] = $this->alumno->get($expediente['alumno_idalumno']);
                $data['adom'] = $this->alumno->get_domicilio($expediente['alumno_idalumno']);
                $tiene_trabajo = (isset($data['alumno']['tiene_trabajo'])) ? $data['alumno']['tiene_trabajo'] : 'NO';
                $data['awork'] = $this->alumno->get_trabajo($tiene_trabajo, $expediente['alumno_idalumno']);
                for ($i = 1; $i < 3; $i++) {

                    $data['aval' . $i] = $this->alumno->get_aval($expediente['alumno_idalumno'], $i);
                }
                $data['analisis'] = $this->get_analisis($expediente['idexpediente'], 'importe,credito_autorizado');
                $data['contrato'] = $this->get_contrato($expediente['idexpediente']);


                //print_r($data['log']);
                break;


            case 'disposicion':
                //$data['max_pagare'] = $this->get_max_pagare($expediente['idexpediente']);
                $data['analisis'] = $this->get_analisis($expediente['idexpediente'], 'linea_global,importe');
                $data['pagares'] = $this->get_all_pagare($expediente['idexpediente']);
                $data['contrato'] = $this->get_contrato($expediente['idexpediente']);
                $data['disposicion'] = $this->get_disposicion($expediente['idexpediente'], '*,IF(calificacion=1,"MUY MALA",IF(calificacion=2,"MALA"," ")) as calificacion');
                //print_r($data['disposicion']);
                $data['analisis']['linea_global'] = $data['disposicion']['linea_global'] == NULL ? $data['analisis']['linea_global'] : $data['disposicion']['linea_global'];
                $this->get_linea_restante($expediente['idexpediente'], $data['analisis']['importe']);
                $data['log'] = $this->log->get($accion, $expediente['idexpediente']);
                $recals = $this->log->get_by_accion('recal', $expediente['idexpediente'], 100000);

                foreach ($recals as $r) {
                    $data['recals'][] = $r['comentario'];
                }
                break;
            default:
                $data['nada'] = 'No seleccionaste ninguna acción válida';
                break;
        }
        $data['creacion'] = $this->log->get('expediente', $expediente['idexpediente']);
        return $data;
    }

    public function get_analisis($idexpediente, $campos = '*') {
        $this->db->select($campos, FALSE);
        $q = $this->db->get_where('analisis', array('expediente_idexpediente' => $idexpediente));
        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            return $tmp[0];
        } else {
            return array();
        }
    }

    public function get_contrato($idexpediente, $campos = '*') {
        $this->db->select($campos);
        $q = $this->db->get_where('contrato', array('expediente_idexpediente' => $idexpediente));

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            return $tmp[0];
        } else {
            return array();
        }
    }

    public function get_disposicion($idexpediente, $campos = '*') {
        $this->db->select($campos, FALSE);
        $q = $this->db->get_where('disposicion', array('expediente_idexpediente' => $idexpediente));

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            return $tmp[0];
        } else {
            return array();
        }
    }

    public function get_max_pagare($id) {
        $this->db->where('expediente_idexpediente', $id);
        $this->db->select_max('numero');
        $q = $this->db->get('pagare');

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
        } else {
            $tmp[0]['numero'] = 0;
        }

        //echo $this->db->last_query();
        return ($tmp[0]['numero'] == NULL) ? 0 : $tmp[0]['numero'];
    }

    public function get_buro($idexpediente, $campos = '*') {
        $this->db->select($campos);
        $q = $this->db->get_where('buro', array('expediente_idexpediente' => $idexpediente), 1);

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
        } else {
            $tmp[0] = array();
        }

        return $tmp[0];
    }

    public function get_cedula($idexpediente, $campos = '*') {
        $this->db->select($campos);
        $q = $this->db->get_where('cedula_analisis', array('expediente_idexpediente' => $idexpediente), 1);

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
        } else {
            $tmp[0] = array();
        }

        return $tmp[0];
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

    function abrirNuevo($post) {
        $this->load->model('log_model', 'log');
        $data = array(
            'universidad_iduniversidad' => $post['uni'],
            'campus_idcampus' => $post['cam'],
            'matricula' => $post['mat'],
            'fecha_edicion' => date('Y-m-d H:i:s')
        );
        $this->db->insert('expediente', $data);

        $q = $this->db->query("select last_insert_id() as last");
        $tmp = $q->result_array();
        foreach ($tmp as $l) {
            $last = $l['last'];
        }

        $data = array(
            'expediente_idexpediente' => $last,
            'fase' => 'SOLICITUD',
            'fecha_edicion' => date('Y-m-d H:i:s')
        );
        $this->db->insert('proceso', $data);

        if ($post['uni'] == 7) {
            $data3 = array(
                'expediente_idexpediente' => $last,
                'id_universidad' => $post['uni'],
                'id_campus' => $post['cam'],
                'fecha_alta' => date('Y-m-d')
            );

            $this->db->insert('carta_preaprobacion', $data3);
        }


        $user = $this->phpsession->get('user', 'finem');
        $this->log->guardar('expediente', 'crear', $user['idusuario'], $last);
        return $last;
    }

    function create_tabla_pagare($post) {
        $this->load->model('contrato_model', 'contrato');
        $this->load->model('carrera_model', 'carrera');

        $user = $this->phpsession->get('user', 'finem');
        $pagare = $this->get_pagare(0, 0, $post['idpagare']);
        //print_r($post);
        $contrato = $this->get_contrato($post['idexpediente'], 'fecha_suscripcion');
        $numero_real = $this->contrato->get_last_plazo($pagare['fecha_suscripcion'], $contrato['fecha_suscripcion']);

        $exp = $this->getExpediente($post['idexpediente']);
        $plazo = $this->carrera->get_plazo($exp[0]['especialidad']);
        //echo $plazo;
        $plazo = ($exp[0]['avance'] == 1) ? $plazo : ($exp[0]['avance'] == $plazo ? 1 : ($plazo + 1) - $exp[0]['avance']);
        //echo $plazo;
        $plazo--; //Se asume que el primer pagaré ya cobró los primeros accesorios.
        $div = ($post['marca_plan'] == 'semestral') ? 6 : ($post['marca_plan'] == 'cuatrimestral' ? 4 : 3);
        $cobrados = floor($numero_real - 1 / $div); //accesorios cobrados.
        if (!empty($pagare['importe']) && !empty($pagare['fecha_suscripcion'])) {
            //print_r($pagare);
            $disposicion = $pagare['importe_pagare'];
            $tmp1 = obtener_campo('pago_mensual.contrato', 'expediente_idexpediente.' . $pagare['expediente_idexpediente']);
            $tmp2 = obtener_campo('pago_mensual.disposicion', 'expediente_idexpediente.' . $pagare['expediente_idexpediente']);
            $pago_total = is_numeric($tmp2) ? $tmp2 : $tmp1;
            $mes = 0;
            //echo $disposicion;
            while ($disposicion > 0 /* && $mes < 50 */) {

                $tabla[$mes]['interno'] = $numero_real;
                $tabla[$mes]['mes'] = $mes;
                $tabla[$mes]['accesorios'] = 0;
                $extra = 0;
                $interes_accesorios = 0;
                $mesx = $numero_real - 1;

                $multiplo = $mesx % $div;
                if ($mesx != 0 && $multiplo == 0 && $plazo > 0) {
                    if ($div == 6) {
                        $tabla[$mes]['accesorios'] = ($pago_total / 4) / 1.16;
                        $extra = $pago_total / 2;
                    } else {
                        $tabla[$mes]['accesorios'] = ($pago_total / 2) / 1.16;
                    }
                    $plazo--;
                }
                /*
                  if($post['marca_plan'] == 'semestral'){

                  $multiplo = $mesx%6;
                  if($mesx != 0 && $multiplo == 0 && $plazo > 0){
                  $tabla[$mes]['accesorios'] = ($pago_total/4)/1.16;
                  $extra = $pago_total/2;
                  $plazo--;
                  }
                  }elseif($post['marca_plan'] == 'cuatrimestral'){
                  $multiplo = $mesx%4;
                  if($mesx != 0 && $multiplo == 0 && $plazo > 0){
                  $tabla[$mes]['accesorios'] = ($pago_total/2)/1.16;
                  //$extra = $pago_total/2;
                  $plazo--;
                  }
                  }else{
                  $multiplo = $mesx%3;
                  if($mesx != 0 && $multiplo == 0 && $plazo > 0){
                  $tabla[$mes]['accesorios'] = ($pago_total/2)/1.16;
                  //$extra = $pago_total/2;
                  $plazo--;
                  }
                  } */
                $interes_accesorios = $tabla[$mes]['accesorios'] * 0.16;
                if ($mes == 0) {
                    $tabla[$mes]['pago_total'] = $pago_total + $extra;
                    $tabla[$mes]['disposicion'] = $disposicion;
                    //$tabla[$mes]['accesorios'] = (($post['marca_plan'] == 'semestral') ? $tabla[$mes]['pago_total']/4 : $tabla[$mes]['pago_total']/2)/1.16;
                    $tabla[$mes]['saldo_inicial'] = $disposicion;
                    $tabla[$mes]['interes'] = $tabla[$mes]['saldo_inicial'] * (0.1390 / 12);
                    //$tabla[$mes]['principal'] = $tabla[$mes]['pago_total'] - $tabla[$mes]['accesorios'];
                    $tabla[$mes]['iva'] = ($tabla[$mes]['interes'] * 0.16) + $interes_accesorios;
                    $tabla[$mes]['principal'] = $tabla[$mes]['pago_total'] - $tabla[$mes]['interes'] - $tabla[$mes]['accesorios'] - $tabla[$mes]['iva'];

                    $tabla[$mes]['saldo_final'] = abs($tabla[$mes]['saldo_inicial'] - $tabla[$mes]['principal']);
                } else {



                    $tabla[$mes]['saldo_inicial'] = $tabla[$mes - 1]['saldo_final'];

                    $tabla[$mes]['disposicion'] = 0;

                    $tabla[$mes]['interes'] = $tabla[$mes]['saldo_inicial'] * (0.1390 / 12);
                    $tabla[$mes]['iva'] = ($tabla[$mes]['interes'] * 0.16) + $interes_accesorios;
                    $tabla[$mes]['pago_total'] = $tabla[$mes]['saldo_inicial'] > $pago_total ? $pago_total + $extra : $tabla[$mes]['saldo_inicial'] + $tabla[$mes]['interes'] + $tabla[$mes]['iva'] + $tabla[$mes]['accesorios'];
                    $tabla[$mes]['principal'] = $tabla[$mes]['pago_total'] - $tabla[$mes]['interes'] - $tabla[$mes]['accesorios'] - $tabla[$mes]['iva'];
                    $tabla[$mes]['saldo_final'] = abs(round($tabla[$mes]['saldo_inicial'], 2) - round($tabla[$mes]['principal'], 2));
                }

                $disposicion = $tabla[$mes]['saldo_final'];
                $mes++;
                $numero_real++;
            }

            //echo $numero_real;
            //print_r($tabla);

            $serial = serialize($tabla);
            $data = array(
                'expediente_idexpediente' => $pagare['expediente_idexpediente'],
                'idrenovacion' => $post['numero'],
                'serialinfo' => $serial,
                'tipotabla' => 'pagos',
                'id_usuario' => $user['idusuario']
            );
            $pagos = $this->get_tabla_pagos($pagare['expediente_idexpediente'], 'pagos', $post['numero'], TRUE);
            //echo $pagos.'------------';
            if ($pagos == 0) {

                $this->db->insert('tablaparcial', $data);
            } else {
                unset($data['expediente_idexpediente']);
                $this->db->where('idtablaparcial', $pagos);
                $this->db->update('tablaparcial', $data);
            }

            $datax['plazo'] = count($tabla) - 1;
            $datax['fecha_primer_pago'] = date('Y-m', strtotime($pagare['fecha_suscripcion'] . " + 1 month")) . '-05';
            $datax['fecha_vencimiento'] = date('Y-m', strtotime($pagare['fecha_suscripcion'] . " + " . $datax['plazo'] . " month")) . '-05';

            $this->db->where('idpagare', $pagare['idpagare']);
            $this->db->update('pagare', $datax);

            $this->load->model('log_model', 'log');
            $this->log->guardar('pagare', 'tablapagos', $user['idusuario'], $pagare['expediente_idexpediente']);

            $return['error'] = 0;
            $return['msj'] = 'Se ha creado la tabla con éxito.';
        } else {
            //echo 'Vacíos los campos. Guardar primero el pagaré.';
            $return['error'] = 1;
            $return['msj'] = 'No se puede crear la tabla. Asegúrate de guardar primero el importe y la fecha de suscripción.';
        }

        return $return;
    }

    function create_pagare($exp) {
        $max = $this->get_max_pagare($exp);

        $this->db->insert('pagare', array('expediente_idexpediente' => $exp, 'numero' => $max + 1));

        $user = $this->phpsession->get('user', 'finem');
        $this->load->model('log_model', 'log');
        $this->log->guardar('pagare', 'agregar', $user['idusuario'], $exp);
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

    function borrarExpediente($post) {

        $this->db->where('idexpediente', $post['confirmar']);
        $this->db->update('expediente', array('activo' => 'NO'));

        $this->load->model('log_model', 'log');
        $user = $this->phpsession->get('user', 'finem');
        $this->log->guardar('expediente', 'borrar', $user['idusuario'], $post['confirmar'], $post['comentario']);
    }

    function cambiarMat($post) {

        $this->db->where('idexpediente', $post['exp']);
        $this->db->update('expediente', array('matricula' => $post['matricula_new']));

        $this->load->model('log_model', 'log');
        $user = $this->phpsession->get('user', 'finem');
        $this->log->guardar('expediente', 'cambiar_matricula', $user['idusuario'], $post['exp'], $post['comentario']);
    }

    function asignar_agencia($idexp, $idag) {
        $data['agencia_idagencia'] = $idag;

        $this->db->where('idexpediente', $idexp);
        $this->db->update('expediente', $data);
    }

    function guardar($post) {
        $this->load->model('log_model', 'log');
        $acierto = FALSE;
        switch ($post['accion']) {
            case 'solicitud':

                /*                 * ** Checar si las tablas necesarias existen *** */
                if (empty($post['idalumno'])) {
                    $nuevo = 'SI';
                } else {
                    $nuevo = 'NO';
                }

                /*                 * * Guardar ALUMNO *** */

                //$documentos = serialize($post['documentos']);
                $data = array(
                    'oficial' => $post['oficial'],
                    'numero_oficial' => $post['numero_oficial'],
                    'nombre' => $post['nombre1'],
                    'nombre_dos' => $post['nombre2'],
                    'apater' => $post['apater'],
                    'amater' => $post['amater'],
                    'rfc' => $post['rfc'],
                    'nacimiento' => (!empty($post['nac'])) ? fecha_contrato($post['nac'], 'inverso') : NULL,
                    'lugar_nac' => $post['nac_place'],
                    'estado_civil' => $post['civil'],
                    'nombre_conyuge' => $post['conyuge'],
                    'promedio' => $post['promedio'],
                    'tiene_trabajo' => (isset($post['trabajox'])) ? $post['trabajox'] : '',
                    'fecha_edicion' => date('Y-m-d H:i:s'),
                    'comentario' => $post['comentarios'],
                    'email' => $post['email'],
                    'celular' => $post['cellphone']
                );
                if ($nuevo == 'NO') {
                    //Editar
                    $idalumno = $post['idalumno'];
                    $this->db->where(array('idalumno' => $idalumno));
                    $this->db->update('alumno', $data);
                } else {
                    //Insertar
                    $this->db->insert('alumno', $data);
                    $idalumno = mysql_insert_id();
                }

                /** Insertar Trabajo * */
                $data = array(
                    'actividad' => (isset($post['actividad_alumno'])) ? $post['actividad_alumno'] : '',
                    'nombre_empresa' => $post['empresa'],
                    'antiguedad' => $post['antiguedad'],
                    'puesto' => $post['puesto'],
                    'telefono' => $post['telefono_emp'],
                    'ingreso_mensual' => limpia_moneda($post['ingreso']),
                    'egreso_mensual' => limpia_moneda($post['egreso']),
                    'alumno_idalumno' => $idalumno
                );

                if ($nuevo == 'NO') {
                    //Editar

                    $this->db->where(array('alumno_idalumno' => $idalumno));
                    $this->db->update('trabajo', $data);
                } else {
                    //Insertar
                    $this->db->insert('trabajo', $data);
                    $trabajo = mysql_insert_id();
                }

                /*                 * * Guardar DOMICILIO *** */
                $data = array(
                    'telefono' => $post['phone'],
                    'calle' => $post['calle'],
                    'interior' => $post['interior'],
                    'exterior' => $post['exterior'],
                    'colonia' => $post['colonia'],
                    'delegacion' => $post['delegacion'],
                    'codigo_postal' => $post['postal'],
                    'ciudad' => $post['ciudad'],
                    'casa' => $post['casa'],
                    'estado' => $post['estado'],
                    'alumno_idalumno' => $idalumno,
                    'fecha_edicion' => date('Y-m-d H:i:s')
                );
                if ($nuevo == 'NO') {
                    //Editar
                    $this->db->where(array('alumno_idalumno' => $idalumno));
                    $this->db->update('domicilio', $data);
                } else {
                    //Insertar
                    $this->db->insert('domicilio', $data);
                }

                /*                 * * Guardar AVALES *** */
                for ($i = 1; $i < 3; $i++) {
                    $data = array(
                        'oficial' => $post['oficiala' . $i],
                        'numero_oficial' => $post['numero_oficiala' . $i],
                        'nombre' => $post['nombre1_a' . $i],
                        'nombre_dos' => $post['nombre2_a' . $i],
                        'apaterno' => $post['apater_a' . $i],
                        'amaterno' => $post['amater_a' . $i],
                        'parentesco' => $post['parentesco_a' . $i],
                        'edo_civil' => $post['civil_a' . $i],
                        'direccion' => $post['ciclox'],
                        'colonia' => $post['colonia_a' . $i],
                        'cp' => $post['postal_a' . $i],
                        'telefono' => $post['telefono_fijo_a' . $i],
                        'casa_habita' => $post['casa_a' . $i],
                        'automovil' => (isset($post['trabajo_a' . $i])) ? $post['trabajo_a' . $i] : '',
                        'modelo' => $post['modelo_a' . $i],
                        'actividad_aval' => (isset($post['actividad_a' . $i])) ? $post['actividad_a' . $i] : '',
                        'nombre_empresaA' => $post['empresa_a' . $i],
                        'antiguedadA' => $post['antiguedad_a' . $i],
                        'puestoA' => $post['puesto_a' . $i],
                        'telefono_empresaA' => $post['telefono_a' . $i],
                        'ingresoA' => limpia_moneda($post['ingreso_a' . $i]),
                        'actividad_con' => (isset($post['conyuact_a' . $i])) ? $post['conyuact_a' . $i] : '',
                        'nombre_empresaC' => $post['conyuemp_a' . $i],
                        'antiguedadC' => $post['conyuant_a' . $i],
                        'puestoC' => $post['conyupuesto_a' . $i],
                        'telefono_empresaC' => $post['conyutel_a' . $i],
                        'ingresoC' => limpia_moneda($post['conyuing_a' . $i]),
                        'alumno_idalumno' => $idalumno,
                        'fecha_edicion' => date('Y-m-d H:i:s'),
                        'delegacion' => $post['delegacion_a' . $i],
                        'ciudad' => $post['ciudad_a' . $i],
                        'calle' => $post['calle_a' . $i],
                        'interior' => $post['interior_a' . $i],
                        'exterior' => $post['exterior_a' . $i],
                        'estado' => $post['estado_a' . $i],
                        'casa_habita' => $post['casa_a' . $i],
                        'nacimiento' => (!empty($post['naca_' . $i])) ? fecha_contrato($post['naca_' . $i], 'inverso') : NULL,
                        'lugar_nac' => $post['nac_placea_' . $i],
                        'nombre_conyuge' => $post['conyugea_' . $i],
                        'egresoA' => limpia_moneda($post['egreso_a' . $i]),
                        'egresoC' => limpia_moneda($post['conyueg_a' . $i])
                    );

                    //print_r($post);
                    if ($nuevo == 'NO') {
                        //Editar
                        $this->db->where(array('idaval' => $post['idaval_a' . $i]));
                        $this->db->update('aval', $data);
                    } else {
                        //Insertar
                        $this->db->insert('aval', $data);
                    }
                }

                /*                 * * Guardar EXPEDIENTE *** */
                $data = array(
                    'campus_idcampus' => $post['cam'],
                    'universidad_iduniversidad' => $post['universidad'],
                    'nivel' => $post['nivel'],
                    'avance' => $post['ciclo_escolar'],
                    'avance_por' => $post['avance_por'],
                    'ciclo_idciclo' => $post['ciclox'],
                    'producto_idproducto' => $post['producto'],
                    'ciclo_escolar' => $post['ciclo_escolar'],
                    'especialidad' => $post['especialidad'],
                    'alumno_idalumno' => $idalumno,
                    'fecha_edicion' => date('Y-m-d H:i:s')
                );

                $this->db->where(array('idexpediente' => $post['idexpediente']));
                $this->db->update('expediente', $data);

                if ($post['universidad'] == 7) {
                    $data3 = array(
                        'expediente_idexpediente' => $post['idexpediente'],
                        'id_universidad' => $post['universidad'],
                        'id_campus' => $post['cam'],
                        'fecha_alta' => date('Y-m-d')
                    );

                    $q = $this->db->get_where('carta_preaprobacion', array('expediente_idexpediente' => $post['idexpediente']));

                    if ($q->num_rows() > 0) {
                        $this->db->where(array('expediente_idexpediente' => $post['idexpediente']));
                        $this->db->update('carta_preaprobacion', $data3);
                    } else {
                        $this->db->insert('carta_preaprobacion', $data3);
                    }
                }

                $acierto = TRUE;
                break;

            case 'buro':

                if (!file_exists('uploads/buro/' . $post['idexpediente'] . '/')) {
                    mkdir('uploads/buro/' . $post['idexpediente'] . '/', 0777, true);
                }

                $config['upload_path'] = './uploads/buro/' . $post['idexpediente'] . '/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '1000';
                $config['max_width'] = '1024';
                $config['max_height'] = '800';
                $config['file_name'] = 'buro_' . date('YmdHis');
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('buro')) {
                    $acierto = FALSE;
                    //print_r($_FILES);                    
                    $this->phpsession->flashsave('error', $this->upload->display_errors());
                } else {
                    $acierto = TRUE;
                    $img = $this->upload->data();
                    if (empty($post['idburo'])) {

                        $this->db->insert('buro', array('pdf' => $img['file_name'], 'expediente_idexpediente' => $post['idexpediente']));
                    } else {
                        $this->db->where(array('idburo' => $post['idburo']));
                        $this->db->update('buro', array('pdf' => $img['file_name']));
                    }
                }


                break;
            case 'analisis':

                $user = $this->phpsession->get('user', 'finem');

                if (isset($post['formhid'])) {

                    if ($post['formhid'] == 'tabla_global') {

                        if (!file_exists('uploads/global/' . $post['idexpediente'] . '/')) {
                            mkdir('uploads/global/' . $post['idexpediente'] . '/', 0777, true);
                        }

                        $config['upload_path'] = './uploads/global/' . $post['idexpediente'] . '/';
                        $config['allowed_types'] = 'csv';
                        $config['max_size'] = '800';
                        $config['file_name'] = 'tablaglobal_' . date('YmdHis');
                        $config['overwrite'] = TRUE;

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('global')) {
                            $acierto = FALSE;
                            //print_r($_FILES);                    
                            $this->phpsession->flashsave('error', $this->upload->display_errors());
                        } else {
                            $img = $this->upload->data();
                            //echo '<br> --> '; print_r($img);
                            $tabla = $this->serializar_tabla_pagos($img['file_name'], 'global/' . $post['idexpediente']);
                            if ($tabla == 'encabezados incorrectos') {
                                //echo 'error';
                                $this->phpsession->flashsave('error', 'El archivo no tiene los encabezados correctos.');
                            } else {
                                //echo'xx';
                                $user = $this->phpsession->get('user', 'finem');
                                $data = array(
                                    'expediente_idexpediente' => $post['idexpediente'],
                                    'idcontrato' => 0,
                                    'id_usuario' => $user['idusuario'],
                                    'serialInfo' => $tabla,
                                    'tipotabla' => 'global'
                                );

                                $this->db->insert('tablaparcial', $data);
                                //echo $this->db->last_query();
                                $acierto = TRUE;
                            }
                        }
                    } else {
                        $tmp = array(
                            'cuenta_alu' => $post['cuenta_alu'],
                            'saldo_actual_alu' => $post['saldo_actual_alu'],
                            'saldo_vencido_alu' => $post['saldo_vencido_alu'],
                            'mop_alumno' => $post['mop_alumno'],
                            'com_alumno' => $post['com_alumno'],
                            'cuenta_aval1' => $post['cuenta_aval1'],
                            'saldo_actual_aval1' => $post['saldo_actual_aval1'],
                            'saldo_vencido_aval1' => $post['saldo_vencido_aval1'],
                            'mop_aval1' => $post['mop_aval1'],
                            'com_aval1' => $post['com_aval1'],
                            'cuenta_aval2' => $post['cuenta_aval2'],
                            'saldo_actual_aval2' => $post['saldo_actual_aval2'],
                            'saldo_vencido_aval2' => $post['saldo_vencido_aval2'],
                            'mop_aval2' => $post['mop_aval2'],
                            'com_aval2' => $post['com_aval2']
                        );

                        $buro_credito_info = serialize($tmp);

                        //echo $post['inmueble']; BREAK;
                        $tmp = array(
                            'inmueble' => (isset($post['inmueble'])) ? $post['inmueble'] : '',
                            'excepcion' => (isset($post['excepcion'])) ? $post['excepcion'] : '',
                            'ingreso_bruto_alu' => $post['ingreso_bruto_alu'],
                            'documentacion_alumno' => $post['documentacion_alumno'],
                            'comentario_bruto_alumno' => $post['comentario_bruto_alumno'],
                            'ingreso_bruto_aval1' => $post['ingreso_bruto_aval1'],
                            'documentacion_aval1' => $post['documentacion_aval1'],
                            'comentario_bruto_aval1' => $post['comentario_bruto_aval1'],
                            'ingreso_bruto_aval2' => $post['ingreso_bruto_aval2'],
                            'documentacion_aval2' => $post['documentacion_aval2'],
                            'comentario_bruto_aval2' => $post['comentario_bruto_aval2'],
                            'ingresos_comprobados' => $post['ingresos_comprobados'],
                            'pago_buro' => $post['pago_buro']
                        );

                        $capacidad_pago_info = serialize($tmp);

                        $data = array(
                            'expediente_idexpediente' => $post['idexpediente'],
                            'tipo_ingreso' => $post['tipo_ingreso'],
                            'avance_por' => $post['avance_por'],
                            'modalidad' => $post['modalidad'],
                            'linea_solicitada' => $post['linea_solicitada'],
                            'tipo_linea' => $post['tipo_linea'],
                            'adeudo' => $post['adeudo'],
                            'buro_credito_info' => $buro_credito_info,
                            'comentario_buro' => $post['comentario_buro'],
                            'ingreso_minimo' => $post['ingreso_minimo'],
                            'capacidad_pago_info' => $capacidad_pago_info,
                            'comentario_gral' => $post['comentario_gral']
                        );


                        if (isset($post['terminar'])) {
                            $data['reviso_idusuario'] = $user['idusuario'];
                            $data['bstatus'] = 1;
                        } else {
                            $data['reviso_idusuario'] = 0;
                            $data['bstatus'] = 0;
                            $data['elaboro_idusuario'] = $user['idusuario'];
                        }

                        $q = $this->db->get_where('cedula_analisis', array('expediente_idexpediente' => $post['idexpediente']));

                        if ($q->num_rows() > 0) {
                            unset($data['expediente_idexpediente']);
                            $this->db->where('expediente_idexpediente', $post['idexpediente']);
                            $this->db->update('cedula_analisis', $data);
                        } else {
                            $data['elaboro_idusuario'] = $user['idusuario'];
                            //print_r($data);
                            $this->db->insert('cedula_analisis', $data);
                        }

                        $acierto = TRUE;
                    }
                } else {

                    $data = array(
                        'estado_operacion' => $post['status'],
                        'linea_global' => limpia_moneda($post['linea_global']),
                        'importe' => limpia_moneda($post['importe']),
                        'credito_autorizado' => limpia_moneda($post['porc_credito']),
                        'capacidad_resultado' => $post['res_pago'],
                        'capacidad_observaciones' => $post['obs_pago'],
                        'capacidad_condiciones' => $post['cond_pago'],
                        'buro_resultado' => $post['res_buro'],
                        'buro_observaciones' => $post['obs_buro'],
                        'buro_condiciones' => $post['cond_buro'],
                        'estudio_resultado' => $post['res_estudio'],
                        'estudio_observaciones' => $post['obs_estudio'],
                        'estudio_condiciones' => $post['cond_estudio'],
                        'aval1_respaldo' => $post['aval1_respaldo'],
                        'aval1_valor' => limpia_moneda($post['aval1_valor']),
                        'aval2_respaldo' => $post['aval2_respaldo'],
                        'aval2_valor' => limpia_moneda($post['aval2_valor']),
                        'tipo_observacion' => $post['tipo_obs'],
                        'observacion' => $post['comentario_observacion'],
                        'politicas_otorgamiento' => $post['politicas'],
                        'expediente_idexpediente' => $post['idexpediente'],
                        'plazo' => $post['plazo_credito']
                    );
                    if (!empty($post['firma'][1])) {
                        $data['firma_1'] = 1;
                    }
                    if (!empty($post['firma'][2])) {
                        $data['firma_2'] = 1;
                    }
                    if (!empty($post['firma'][3])) {
                        $data['firma_3'] = 1;
                    }
                    if (!empty($post['firma'][4])) {
                        $data['firma_4'] = 1;
                    }
                    $q = $this->db->get_where('analisis', array('expediente_idexpediente' => $post['idexpediente']));

                    if ($q->num_rows() > 0) {
                        unset($data['expediente_idexpediente']);
                        $this->db->where('expediente_idexpediente', $post['idexpediente']);
                        $this->db->update('analisis', $data);
                    } else {
                        //print_r($data);
                        $this->db->insert('analisis', $data);
                    }
                    $acierto = TRUE;
                }
                break;
            case 'contrato':
                $this->load->model('carrera_model', 'carrera');
                $this->load->model('calculadora_model', 'calculadora');

                if (!isset($post['formhid'])) {
                    //print_r($post);
                    $data = $post;
                    unset($data['accion']);
                    unset($data['pestania']);
                    unset($data['idexpediente']);
                    unset($data['carrera']);
                    unset($data['monto_total']);
                    unset($data['id']);
                    unset($data['numero']);
                    unset($data['contract']);

                    $data['enviar_mesa'] = isset($post['enviar_mesa']) ? $post['enviar_mesa'] : 0;
                    $data['expediente_idexpediente'] = $post['idexpediente'];
                    $data['fecha_suscripcion'] = fecha_contrato($post['fecha_suscripcion'], 'inverso');
                    $data['fecha_primer_pago'] = date('Y-m', strtotime($data['fecha_suscripcion'] . " + 1 month")) . '-05';
                    $data['fecha_vencimiento'] = date('Y-m', strtotime($data['fecha_suscripcion'] . " + " . $post['plazo_credito'] . " month")) . '-05';
                    $data['primer_disposicion'] = limpia_moneda($post['primer_disposicion']);
                    $data['pago_mensual'] = limpia_moneda($post['pago_mensual']);
                    $data['pago_extraordinario'] = limpia_moneda($post['pago_extraordinario']);
                    $data['adeudo_universidad'] = limpia_moneda($post['adeudo_universidad']);
                    $data['cuota_reinscripcion'] = limpia_moneda($post['cuota_reinscripcion']);


                    $q = $this->db->get_where('contrato', array('expediente_idexpediente' => $post['idexpediente']));
                    if ($q->num_rows() > 0) {

                        unset($data['expediente_idexpediente']);
                        $this->db->where('expediente_idexpediente', $post['idexpediente']);
                        $this->db->update('contrato', $data);
                    } else {
                        //print_r($data);
                        $this->db->insert('contrato', $data);
                    }

                    $acierto = TRUE;
                } else {

                    if ($post['formhid'] == 'pagare_rules') {
                        $data = array(
                            'fecha_vencimiento' => fecha_contrato($post['fecha_vencimiento'], 'inverso'),
                            'expediente_idexpediente' => $post['idexpediente'],
                            'plazo' => $post['plazo'],
                            'terminado' => (isset($post['terminado'])) ? $post['terminado'] : 'no',
                            'numero' => $post['max'] + 1
                        );

                        $q = $this->db->get_where('pagare', array('expediente_idexpediente' => $post['idexpediente'], 'numero' => $post['max'] - 1));
                        if ($q->num_rows() > 0) {
                            unset($data['expediente_idexpediente']);
                            $this->db->where(array('expediente_idexpediente' => $post['idexpediente'], 'numero' => $post['max'] - 1));
                            $this->db->update('pagare', $data);
                        } else {
                            $this->db->insert('pagare', $data);
                        }
                        $acierto = TRUE;
                    } else {
                        $config['upload_path'] = './uploads/contrato';
                        $config['allowed_types'] = 'csv';
                        $config['max_size'] = '800';
                        $config['file_name'] = 'tabla_' . $post['mat'];
                        $config['overwrite'] = TRUE;

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('tabla_contrato')) {
                            //print_r($_FILES);
                            //echo $this->upload->display_errors();
                            $this->phpsession->flashsave('error', $this->upload->display_errors());
                        } else {
                            //$acierto = TRUE;
                            $img = $this->upload->data();
                            //echo '<br> --> '; print_r($img);
                            $tabla = $this->serializar_tabla_pagos($img['file_name']);
                            if ($tabla == 'encabezados incorrectos') {
                                $this->phpsession->flashsave('error', 'El archivo no tiene los encabezados correctos.');
                            } else {
                                $user = $this->phpsession->get('user', 'finem');
                                $data = array(
                                    'expediente_idexpediente' => $post['idexpediente'],
                                    'idcontrato' => $post['idcontrato'],
                                    'id_usuario' => $user['idusuario'],
                                    'serialInfo' => $tabla,
                                    'tipotabla' => 'pagos'
                                );

                                $this->db->insert('tablaparcial', $data);
                                $acierto = TRUE;
                            }
                        }
                    }
                }

                break;
            case 'disposicion':
                if (!isset($post['formhid'])) {
                    print_r($post);
                } else {

                    if ($post['formhid'] == 'pagare_rules' || $post['formhid'] == 'pagare2_rules') {

                        $numero = (empty($post['numero'])) ? 1 : $post['numero'];

                        if ($numero == 1) {
                            //Actualiza toda la información desde contrato
                            $query = "update contrato,pagare 
                                        SET 
                                        pagare.fecha_suscripcion = contrato.fecha_suscripcion,
                                        pagare.fecha_primer_pago = contrato.fecha_primer_pago,
                                        pagare.importe = contrato.primer_disposicion,
                                        pagare.adeudo = contrato.adeudo_universidad,
                                        pagare.importe_pagare = (contrato.primer_disposicion + contrato.adeudo_universidad)
                                        WHERE pagare.expediente_idexpediente = contrato.expediente_idexpediente AND pagare.numero = 1
                                        AND pagare.expediente_idexpediente = " . $post['idexpediente'] . ";";

                            $this->db->query($query);
                            $data = array(
                                //'fecha_vencimiento' => fecha_contrato($post['fecha_vencimiento'], 'inverso'),
                                'expediente_idexpediente' => $post['idexpediente'],
                                'plazo' => $post['plazo'],
                                'terminado' => (isset($post['terminado'])) ? $post['terminado'] : 'no',
                                'numero' => $numero
                            );

                            $data['fecha_vencimiento'] = date('Y-m', strtotime($post['fecha_suscripcion'] . " + " . $data['plazo'] . " month")) . '-05';
                        } else {

                            $data = array(
                                'fecha_suscripcion' => fecha_contrato($post['fecha_suscripcion'], 'inverso'),
                                'expediente_idexpediente' => $post['idexpediente'],
                                'plazo' => $post['plazo'],
                                'terminado' => (isset($post['terminado'])) ? $post['terminado'] : 'no',
                                'importe' => limpia_moneda($post['importe']),
                                'adeudo' => limpia_moneda($post['adeudo']),
                                'importe_pagare' => limpia_moneda($post['importe']) + limpia_moneda($post['adeudo']),
                                'numero' => $numero
                            );

                            //$data['fecha_primer_pago'] = date('Y-m',strtotime($data['fecha_suscripcion']. " + 1 month")).'-05';
                            //$data['fecha_vencimiento'] = date('Y-m',strtotime($data['fecha_suscripcion']. " + ".$data['plazo']." month")).'-05';
                        }


                        $q = $this->db->get_where('pagare', array('expediente_idexpediente' => $post['idexpediente'], 'numero' => $numero));
                        //echo $this->db->last_query();
                        if ($q->num_rows() > 0) {
                            unset($data['expediente_idexpediente']);
                            $this->db->where(array('expediente_idexpediente' => $post['idexpediente'], 'numero' => $numero));
                            $this->db->update('pagare', $data);
                        } else {
                            $this->db->insert('pagare', $data);
                        }
                        $acierto = TRUE;
                    } else {
                        $path = 'uploads/parcial/' . $post['idexpediente'] . '/';
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        $config['upload_path'] = $path;
                        $config['allowed_types'] = 'csv';
                        $config['max_size'] = '800';
                        $config['file_name'] = 'tabla_' . $post['mat'];
                        $config['overwrite'] = TRUE;

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('tabla_contrato')) {
                            //print_r($_FILES);
                            //echo $this->upload->display_errors();
                            $this->phpsession->flashsave('error', $this->upload->display_errors());
                        } else {
                            //$acierto = TRUE;
                            $img = $this->upload->data();
                            //echo '<br> --> '; print_r($img);
                            $tabla = $this->serializar_tabla_pagos($img['file_name'], 'parcial/' . $post['idexpediente']);
                            if ($tabla == 'encabezados incorrectos') {
                                $this->phpsession->flashsave('error', 'El archivo no tiene los encabezados correctos.');
                            } else {
                                $user = $this->phpsession->get('user', 'finem');
                                $data = array(
                                    'expediente_idexpediente' => $post['idexpediente'],
                                    'idcontrato' => $post['idcontrato'],
                                    'id_usuario' => $user['idusuario'],
                                    'serialInfo' => $tabla,
                                    'tipotabla' => 'pagos',
                                    'idrenovacion' => $post['numero']
                                );

                                $this->db->insert('tablaparcial', $data);
                                $acierto = TRUE;
                            }
                        }
                    }
                }
                break;
            default:
                break;
        } //break;
        if ($acierto == TRUE) {
            $user = $this->phpsession->get('user', 'finem');
            $this->log->guardar($post['accion'], 'edicion', $user['idusuario'], $post['idexpediente']);
        }
        return $acierto;
    }

    public function verifica_firma($firma) {

        // SESIÓN DEL NUEVO SISTEMA
        if (isset($_SESSION['finem'])) {
            $session_user = $_SESSION['finem']['user'];
        } else { // SESIÓN DEL ANTIGUO SISTEMA            
            $session_user = $_SESSION;
        }
        $condicion = array(
            'login' => $session_user['login'],
            'clave' => $session_user['clave'],
            'firma' => $firma
        );
        $q = $this->db->get_where('usuario', $condicion);
//echo  $this->db->last_query();
        if ($q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function serializar_tabla_pagos($nombre_archivo, $carpeta = 'contrato') {
        $this->load->library('CSVReader');
        $csv = $this->csvreader->parse_file('uploads/' . $carpeta . '/' . $nombre_archivo);
        $regreso = NULL;
        //echo 'some';
        //print_r($csv);
        if (is_array($csv)) {
            if (isset($csv[0]['mes']) && isset($csv[0]['disposicion']) && isset($csv[0]['saldo_inicial']) && isset($csv[0]['interes']) && isset($csv[0]['principal']) && isset($csv[0]['accesorios']) && isset($csv[0]['iva']) && isset($csv[0]['saldo_final']) && isset($csv[0]['pago_total'])) {
                foreach ($csv as $k => $v) {
                    foreach ($v as $k1 => $v1) {
                        $tmp[$k][$k1] = (empty($v1)) ? 0.00 : $v1;
                    }
                }

                $regreso = serialize($tmp);
            } else {
                $regreso = 'encabezados incorrectos';
            }

            return $regreso;
        }
    }

    public function get_tabla_pagos($idexpediente, $tipo = 'pagos', $numero = NULL, $id = FALSE) {

        $this->db->where('expediente_idexpediente', $idexpediente);
        $this->db->where('idrenovacion', $numero);
        $this->db->where('tipotabla', $tipo);
        $this->db->order_by('idtablaparcial', 'DESC');
        $q = $this->db->get('tablaparcial', 1);
        //echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            $tabla = unserialize($tmp[0]['serialinfo']);
            //print_r($tabla);
            //$txt = formato_numerico($tabla);
            //print_r($txt);
            if ($id == TRUE) {
                return $tmp[0]['idtablaparcial'];
            } else {
                return $tabla;
            }
        } else {

            if ($id == TRUE) {
                return 0;
            } else {
                return array();
            }
        }
    }

    public function getFolio($id_expediente) {
        $folio = 0;
        $q = $this->db->get_where('carta_preaprobacion', array('expediente_idexpediente' => $id_expediente));
        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            //print_r($tmp);
            $consecutivo = sprintf("%06s", $tmp[0]['idcarta_preaprobacion']);
            $claveCampus = obtener_campo('code_campus.campus', 'idcampus.' . $tmp[0]['id_campus']);
            $numMatricula = obtener_campo('matricula.expediente', 'idexpediente.' . $tmp[0]['expediente_idexpediente']);

            $folio = 'A' . $consecutivo . '/' . $claveCampus . '/' . $numMatricula;
        }

        return $folio;
    }

    public function get_pagare($idexpediente, $numero, $idpagare = 0) {

        if ($idpagare > 0) {
            $q = $this->db->get_where('pagare', array('idpagare' => $idpagare), 1);
        } else {
            $q = $this->db->get_where('pagare', array('expediente_idexpediente' => $idexpediente, 'numero' => $numero), 1);
        }
        //$this->db->order_by('idtablaparcial','DESC');
        //echo $this->db->last_query();
        $resultado = array();
        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            $resultado = $tmp[0];
        }

        return $resultado;
    }

    public function check_mat($mat) {
        $this->db->select('idexpediente');
        $q = $this->db->get_where('expediente', array('matricula' => $mat, 'activo' => 'SI'));

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            return $tmp[0]['idexpediente'];
        } else {
            return 0;
        }
    }

    public function last_pagare($idexp) {
        $this->db->order_by('numero', 'DESC');
        $this->db->select('numero');
        $q = $this->db->get_where('pagare', array('expediente_idexpediente' => $idexp, 'terminado' => 'SI'), 1);

        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            return $tmp[0]['numero'];
        } else {
            return 0;
        }
    }

    public function get_all_pagare($idexpediente) {
        $this->db->order_by('numero', 'ASC');
        $q = $this->db->get_where('pagare', array('expediente_idexpediente' => $idexpediente));
        //echo $this->db->last_query();
        $tmp = $q->result_array();

        return $tmp;
    }

    function borrar_pagare($post) {

        $this->db->delete('tablaparcial', array('idrenovacion' => $post['numero'], 'expediente_idexpediente' => $post['exp']));
        $this->db->delete('pagare', array('idpagare' => $post['id']));

        $user = $this->phpsession->get('user', 'finem');
        $this->load->model('log_model', 'log');
        $this->log->guardar('pagare', 'borrar', $user['idusuario'], $post['exp'], $post['comentario'] . ' Pagaré:' . $post['numero']);
    }

    function guardar_post($rules) {
        if ($rules == 'pagare_rules' || $rules == 'pagare2_rules') {
            $post = $this->input->post(NULL, TRUE);
            $this->phpsession->flashsave('post', $post);
        }
    }

    function get_disposiciones($idexpediente, $numero) {
        //echo $idexpediente;
        $this->load->model('carrera_model', 'carrera');
        $exp = $this->getExpediente($idexpediente);
        //print_r($exp);
        $plazo = $this->carrera->get_plazo($exp[0]['especialidad']);
        //echo $plazo;
        $plazo = ($exp[0]['avance'] == 1) ? $plazo : ($exp[0]['avance'] == $plazo ? 1 : $plazo - $exp[0]['avance'] + 1);
        $d = obtener_campo('linea_global.disposicion', 'expediente_idexpediente.' . $idexpediente);
        if ($d == NULL || !is_numeric($d)) {
            $a = $this->get_analisis($idexpediente, '(linea_global/' . $plazo . ') as disposicion');
            //echo $this->db->last_query();
            $c['disposicion'] = ($d == NULL || !is_numeric($d)) ? $a['disposicion'] : $d / $plazo;
            //echo $c['disposicion'];
            $remanente = $this->get_saldo_remanente($idexpediente, $c['disposicion'] * 1.10, $numero);
            //echo $remanente;
            if ($remanente < 0 && $remanente != 0) {
                $resultado = 0;
            } else {
                $resultado = (($c['disposicion']) * 1.10) + $remanente;
            }
        } else {
            $this->db->select_sum('importe');
            $this->db->where('numero <', $numero);
            $this->db->where('terminado', 'si');
            $this->db->where('expediente_idexpediente', $idexpediente);
            $qx = $this->db->get('pagare');

            if ($qx->num_rows() > 0) {
                $tmp = $qx->result_array();
                //echo $this->db->last_query();
                $resultado = $d - $tmp[0]['importe'];
                if ($resultado < 0 && $resultado != 0) {
                    $resultado = 0;
                }
            }
        }

        //echo $remanente;
        return $resultado;
        //return (($c['disposicion']) * 1.10) + $remanente;
    }

    function get_saldo_remanente($idexpediente, $disposicion, $numero) {

        $c = $this->get_contrato($idexpediente, 'primer_disposicion as importe,adeudo_universidad as adeudo');

        $this->db->where('numero <', $numero);
        $this->db->where('expediente_idexpediente', $idexpediente);
        $q = $this->db->get('pagare');

        //echo $this->db->last_query();
        $remanente = 0;
        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            foreach ($tmp as $t) {
                if ($t['numero'] == 1) {
                    $remanente += $disposicion - ($c['importe']);
                } else {
                    $remanente += $disposicion - ($t['importe']);
                }
            }
        }

        return $remanente;
    }

    function get_linea_restante($idexp, $linea_parcial) {
        $this->db->select_sum('importe');
        $q = $this->db->get_where('pagare', array('expediente_idexpediente' => $idexp));

        $restante = $linea_parcial;
        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            $restante = $linea_parcial - $tmp[0]['importe'];
        }

        /* $this->db->select('adeudo');
          $this->db->where(array('expediente_idexpediente' => $idexp, 'numero' => 1));
          $q = $this->db->get('pagare');

          if($q->num_rows() > 0){
          $tmp = $q->result_array();
          $restante = $restante - $tmp[0]['adeudo'];
          } */

        return $restante;
    }

    function save_linea_restante($idexp, $linea_parcial, $sistema = FALSE, $log = TRUE) {
        if ($sistema === TRUE) {
            $linea = $this->get_linea_restante($idexp, $linea_parcial);
        } else {
            $linea = $linea_parcial;
        }
        $linea = limpia_moneda($linea);
        $this->db->where(array('expediente_idexpediente' => $idexp));
        $this->db->update('disposicion', array('linea_restante' => $linea, 'subida_restante' => date('Y-m-d H:i:s')));

        if ($log == TRUE) {
            $user = $this->phpsession->get('user', 'finem');
            $this->load->model('log_model', 'log');
            $this->log->guardar('linea_restante', 'edicion', $user['idusuario'], $idexp, '');
        }
        //echo $this->db->last_query();
    }

    function actualizar_linea_restante() {

        $usuarios = $this->config->item('super_admin');
        $user = $this->phpsession->get('user', 'finem');

        //print_r($usuarios);

        if (in_array($user['idusuario'], $usuarios)) {
            //echo 'Bien';
            $this->db->select('expediente_idexpediente as idexpediente,importe');
            $q = $this->db->get('analisis');


            if ($q->num_rows() > 0) {
                $mats = $q->result_array();

                foreach ($mats as $m) {
                    $this->save_linea_restante($m['idexpediente'], $m['importe'], TRUE, TRUE);
                }
            }

            $response['type'] = 'acierto';
            $response['msj'] = 'Se han actualizado las líneas con éxito.';
        } else {
            $response['type'] = 'error';
            $response['msj'] = 'No tiene permisos para realizar esta acción.';
        }

        return $response;
    }

    function get_historia($idexpediente) {
        $this->load->model('log_model', 'log');
        $tmp = $this->log->get_all($idexpediente);
        foreach ($tmp as $k => $v) {
            if ($v['accion'] == 'edicion') {
                $tmp[$k]['accion'] = 'editado';
            }

            if ($v['accion'] == 'tablapagos') {
                $tmp[$k]['accion'] = 'subido una tabla de pagos';
            }

            if ($v['accion'] == 'borrar') {
                $tmp[$k]['accion'] = 'borrado';
            }

            if ($v['accion'] == 'desautorizar') {
                $tmp[$k]['accion'] = 'invalidado la autorización';
            }

            if ($v['accion'] == 'agregar') {
                $tmp[$k]['accion'] = 'agregado un pagare';
            }

            if ($v['accion'] == 'reabrir') {
                $tmp[$k]['accion'] = 'vuelto a abrir';
            }

            if ($v['accion'] == 'cambiar_matricula') {
                $tmp[$k]['accion'] = 'cambiado el número de matrícula';
            }

            if ($v['accion'] == 'crear') {
                $tmp[$k]['accion'] = 'creado el expediente';
            }

            if ($v['accion'] == 'recal') {
                $tmp[$k]['accion'] = 'ejecutado una recalendarización';
            }

            if (strstr($v['seccion'], 'inv_')) {
                $tmpx = explode('_', $v['seccion']);
                $tmp[$k]['seccion'] = 'investigación ' . $tmpx[1];
            }

            if ($v['seccion'] == 'linea_credito') {
                $tmp[$k]['seccion'] = 'Línea de Crédito';
            }

            if ($v['seccion'] == 'linea_restante') {
                $tmp[$k]['seccion'] = 'Línea Restante';
            }
        }
        return $tmp;
    }

    public function cambia_linea($post) {
        $post = limpia_moneda($post);
        $this->db->where('expediente_idexpediente', $post['expediente']);
        $this->db->update('analisis', array('importe' => $post['linea']));

        $user = $this->phpsession->get('user', 'finem');
        $this->load->model('log_model', 'log');
        $this->log->guardar('linea_credito', 'edicion', $user['idusuario'], $post['expediente'], '');
    }

    public function amplia_linea($post) {
        $post = limpia_moneda($post);
        $this->db->where('expediente_idexpediente', $post['expediente']);
        $this->db->update('disposicion', array('linea_global' => $post['linea'], 'pago_mensual' => $post['pago']));

        $user = $this->phpsession->get('user', 'finem');
        $this->load->model('log_model', 'log');
        $this->log->guardar('linea_credito', 'recal', $user['idusuario'], $post['expediente'], $this->last_pagare($post['expediente']));
    }

    public function get_prestado($idexpediente) {
        $this->db->select_sum('importe');
        $this->db->where('terminado', 'si');
        $this->db->where('expediente_idexpediente', $idexpediente);
        $qx = $this->db->get('pagare');
        
        if($qx->num_rows() > 0){
            $tmp = $qx->result_array();
            $prestado = $tmp[0]['importe'];
        }else{
            $prestado = 0;
        }
        
        return $prestado;
    }

}
