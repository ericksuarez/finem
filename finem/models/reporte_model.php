<?php

class Reporte_model extends CI_Model {

    public function contrato($post) {
        $data = NULL;
        $titulos = '';
        $contenido = '';

        $titulos .= 'No. Consecutivo,';
        $titulos .= 'Tipo de reporte,';
        $titulos .= 'Universidad,';
        $titulos .= 'Campus,';
        $titulos .= 'Fecha de alta,';
        $titulos .= 'Matricula,';
        $titulos .= 'Carrera,';
        $titulos .= 'Nombre alumno,';
        $titulos .= 'Aval 1,';
        $titulos .= 'Aval 2,';
        $titulos .= 'Aval 3,';
        $titulos .= 'Importe de la línea.,';
        $titulos .= 'Plazo,';
        $titulos .= 'Periodo de gracia,';
        $titulos .= 'P. remanente,';
        $titulos .= 'G. remanente,';
        $titulos .= 'Competencia,';
        $titulos .= 'Socioeconomico,';
        $titulos .= 'Fecha emisión,';
        $titulos .= 'Fecha vencimiento,';
        $titulos .= 'Fecha primer pago,';
        $titulos .= 'Tasa interés.,';
        $titulos .= 'CONDUSEF,';
        $titulos .= 'Disposición,';
        $titulos .= 'Saldo Insoluto,';
        $titulos .= 'Valor Pagaré,';
        $titulos .= 'Accesorios,';
        $titulos .= 'Total,';
        $titulos .= 'ESE,';
        $titulos .= 'BC,';
        $titulos .= 'Seguro,';
        $titulos .= 'IVA,';
        $titulos .= 'Tipo plan,';
        $titulos .= '% autorizado,';
        $titulos .= '% comisión,';
        $titulos .= 'Importe a pagar de accesorios a la firma del contrato,';
        $titulos .= 'Comisión,';
        $titulos .= 'ESE,';
        $titulos .= 'BC,';
        $titulos .= 'Seguro,';
        $titulos .= 'IVA,';
        $titulos .= 'Pago total,';
        $titulos .= 'Cantidad de 1er pago,';
        $titulos .= 'Fecha nacimiento,';
        $titulos .= 'RFC,';
        $titulos .= 'Calle y número,';
        $titulos .= 'Colonia,';
        $titulos .= 'CP,';
        $titulos .= 'Ciudad,';
        $titulos .= 'Municipio Delegacion ,';
        $titulos .= 'Teléfono 1,';
        $titulos .= 'Teléfono 2,';
        $titulos .= 'Correo electrónico';


        
        
        if (is_array($post['mat']) && count($post['mat']) > 0) {
            $this->load->model('expediente_model','expediente');
            foreach ($post['mat'] as $k => $v) {
                $test = $this->expediente->check_mat($v);

                if ($test != 0) {
                    //echo 'SI';
                    $pag = $this->expediente->last_pagare($test);
                    $campos = "idalumno,
                                'CREDITO EDUCATIVO PAGOS IGUALES' as tipo_reporte,
                                 universidad.nombre_comercial as universidad,
                                 campus.nombre as campus,
                                 contrato.fecha_suscripcion as fecha_alta,
                                 matricula,
                                 carrera.titulo as carrera,
                                 CONCAT( alumno.nombre,' ',alumno.nombre_dos,' ',alumno.apater,' ',alumno.amater ) as alumno,
                                 analisis.importe as importe_linea,
                                 analisis.plazo,
                                 0 as periodo_gracia,
                                 0 as p_remanente,
                                 0 as g_remanente,
                                 contrato.lugar_firma as competencia,
                                 ciclo.ciclo as socioeconomico,".
                                 (($pag == 1) ? 'contrato.fecha_suscripcion' : 'pagare.fecha_suscripcion'). " as fecha_emision,
                                 pagare.fecha_vencimiento as fecha_vencimiento,".
                                 (($pag == 1) ? 'contrato.fecha_primer_pago' : 'pagare.fecha_primer_pago'). " as fecha_primer_pago,
                                 contrato.tasa_fija,
                                 ' ' as CONDUSEF,".
                                 (($pag == 1) ? '(contrato.primer_disposicion + contrato.adeudo_universidad)' : 'pagare.importe'). " as importe,".
                                 (($pag == 1) ? '0' : 'pagare.adeudo'). " as adeudo,".
                                 (($pag == 1) ? '(contrato.primer_disposicion + contrato.adeudo_universidad)' : 'pagare.importe_pagare'). " as importe_pagare,
                                 0 as accesorios,
                                 0 as ESE,
                                 0 as BC,
                                 0 as seguro,
                                 0 as IVA,
                                 carrera.marca_plan as tipo_plan,
                                 analisis.credito_autorizado as por_autorizado,
                                 0 as comision_por,
                                 0 as importe_accesorios,
                                 0 as comision,
                                 0 as ESE2,
                                 0 as BC2,
                                 0 as seguro2,
                                 0 as IVA2,
                                 contrato.pago_mensual as pago_total,
                                 contrato.pago_mensual as cantidad_1_pago,
                                 alumno.nacimiento as fecha_nacimiento,
                                 alumno.rfc as RFC,
                                 CONCAT( domicilio.calle,' ',domicilio.exterior,' ',domicilio.interior ) as calle_numero,
                                 domicilio.colonia as colonia,
                                 domicilio.codigo_postal as cp,
                                 domicilio.ciudad as ciudad,
                                 domicilio.delegacion as municipio,
                                 domicilio.telefono as telefono1,
                                 alumno.celular as telefono2,
                                 alumno.email as correo_electronico";
                    
                    $this->db->select($campos, FALSE);
                    $this->db->where('idexpediente', $test);
                    $this->db->where('pagare.numero', $pag);
                    $this->db->join('universidad', 'iduniversidad = universidad_iduniversidad');
                    $this->db->join('campus', 'idcampus = campus_idcampus');
                    $this->db->join('carrera', 'especialidad = idcarrera');
                    $this->db->join('ciclo', 'idciclo = ciclo_idciclo');
                    $this->db->join('alumno', 'idalumno = expediente.alumno_idalumno');
                    $this->db->join('domicilio', 'idalumno = domicilio.alumno_idalumno');
                    $this->db->join('analisis', 'idexpediente = analisis.expediente_idexpediente');
                    $this->db->join('contrato', 'idexpediente = contrato.expediente_idexpediente');
                    $this->db->join('pagare', 'idexpediente = pagare.expediente_idexpediente');
                    $q = $this->db->get('expediente');
                    //echo $this->db->last_query();
                    
                    
                    if ($q->num_rows() > 0) {
                        $tmp = $q->result_array();

                        $data['aceptados'][] = $tmp[0];
                    } else {

                        $data['incompletos'][] = $v;
                    }
                } else {
                    $data['inexistentes'][] = $v;
                }
            }
        }

        //BREAK;
        if (isset($data['aceptados'])) {
            $this->load->model('alumno_model', 'alumno');
            $aval = NULL;
            foreach ($data['aceptados'] as $k => $v) {
                //print_r($v);

                for ($i = 1; $i < 4; $i++) {
                    if($i == 3){
                        $aval[] = '>> >> >> >>';
                    }else{
                        $tmp = $this->alumno->get_aval($v['idalumno'], $i, 'nombre,nombre_dos,apaterno,amaterno');
                        
                        $aval[] = (empty($tmp['nombre'])) ? array('nombre' => '>>','nombre_dos' => '>>','apaterno' => '>>','amaterno' => '>>') : $tmp;
                    }
                    
                }

                //print_r($v); BREAK;


                $contenido .= '"' . ($k + 1) . '",';
                $contenido .= '"' . ucfirst($v['tipo_reporte']) . '",';
                $contenido .= '"' . ucfirst($v['universidad']) . '",';
                $contenido .= '"' . ucfirst($v['campus']) . '",';
                $contenido .= '"' . fecha_contrato($v['fecha_alta'], 'inverso') . '",';
                $contenido .= '"' . ($v['matricula']) . '",';
                $contenido .= '"' . ucfirst($v['carrera']) . '",';
                $contenido .= '"' . ucfirst($v['alumno']) . '",';
                $contenido .= '"' . ucfirst($aval[0]['nombre'] . ' ' . $aval[0]['nombre_dos'] . ' ' . $aval[0]['apaterno'] . ' ' . $aval[0]['amaterno']) . '",';
                $contenido .= '"' . ucfirst($aval[1]['nombre'] . ' ' . $aval[1]['nombre_dos'] . ' ' . $aval[1]['apaterno'] . ' ' . $aval[1]['amaterno']) . '",';
                $contenido .= '"' . $aval[2] . '",';
                $contenido .= '"' . number_format($v['importe_linea'], 2) . '",';
                $contenido .= '"' . ($v['plazo']) . '",';
                $contenido .= '"' . ($v['periodo_gracia']) . '",';
                $contenido .= '"' . ($v['plazo'] - (resta_fechas($v['fecha_emision'], $v['fecha_alta']))) . '",';
                $contenido .= '"' . ($v['g_remanente']) . '",';
                $contenido .= '"' . ucfirst($v['competencia']) . '",';
                $contenido .= '="' . ($v['socioeconomico']) . '",';
                $contenido .= '"' . fecha_contrato($v['fecha_emision'], 'inverso') . '",';
                $contenido .= '"' . fecha_contrato($v['fecha_vencimiento'], 'inverso') . '",';
                $contenido .= '"' . fecha_contrato($v['fecha_primer_pago'], 'inverso') . '",';
                $contenido .= '"' . number_format($v['tasa_fija'], 2) . '%",';
                $contenido .= '"' . ($v['CONDUSEF']) . '",';
                $contenido .= '"' . number_format($v['importe'], 2) . '",';
                $contenido .= '"' . number_format($v['adeudo'], 2) . '",';
                $contenido .= '"' . number_format($v['importe_pagare'], 2) . '",';
                $contenido .= '"' . number_format($v['accesorios'], 2) . '",';
                $contenido .= '"' . number_format($v['importe_pagare'], 2) . '",';
                $contenido .= '"' . number_format($v['ESE'], 2) . '",';
                $contenido .= '"' . number_format($v['BC'], 2) . '",';
                $contenido .= '"' . number_format($v['seguro'], 2) . '",';
                $contenido .= '"' . number_format($v['IVA'], 2) . '",';
                $contenido .= '"' . ucfirst($v['tipo_plan']) . '",';
                $contenido .= '"' . number_format($v['por_autorizado']) . '%",';
                $contenido .= '"' . number_format($v['comision_por']) . '%",';
                $contenido .= '"' . number_format($v['importe_accesorios'], 2) . '",';
                $contenido .= '"' . number_format($v['comision'], 2) . '",';
                $contenido .= '"' . number_format($v['ESE2'], 2) . '",';
                $contenido .= '"' . number_format($v['BC2'], 2) . '",';
                $contenido .= '"' . number_format($v['seguro2'], 2) . '",';
                $contenido .= '"' . number_format($v['IVA2'], 2) . '",';
                $contenido .= '"' . number_format($v['pago_total'], 2) . '",';
                $contenido .= '"' . number_format($v['cantidad_1_pago'], 2) . '",';
                $contenido .= '"' . fecha_contrato($v['fecha_nacimiento'], 'inverso') . '",';
                $contenido .= '"' . ucfirst($v['RFC']) . '",';
                $contenido .= '"' . ucfirst($v['calle_numero']) . '",';
                $contenido .= '"' . ucfirst($v['colonia']) . '",';
                $contenido .= '"' . ($v['cp']) . '",';
                $contenido .= '"' . ucfirst($v['ciudad']) . '",';
                $contenido .= '"' . ucfirst($v['municipio']) . '",';
                $contenido .= '"' . ($v['telefono1']) . '",';
                $contenido .= '"' . ($v['telefono2']) . '",';
                $contenido .= '"' . ($v['correo_electronico']) . '"';
                $contenido .= "\n";

                $aval = NULL;
            }
        }
        
        $reporte = ($titulos . "\n" . $contenido);
        return $reporte;
    }

    public function forzar_download($reporte) {
        //echo $reporte;

        $this->load->helper('download');

        $data = utf8_decode($reporte);
        $name = 'reporte_' . date('YmdHis') . '.csv';

        force_download($name, $data);
    }

    public function creaHojaUno($objPHPExcel,$mesa, $style_header) {

        //global $objPHPExcel;
        $contRow = 2;
        $objPHPExcel->setActiveSheetIndex(0);
// $objPHPExcel->createSheet(0);
//$objPHPExcel; 
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sucursal Kepler');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'No. De cliente');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Fecha Alta Contrato');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Matricula');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Apellido Paterno');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Apellido Materno');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Primer Nombre');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Segundo Nombre');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Calle y No.');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Colonia');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Población');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'CP');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Ciudad');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Delegación');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Clave estado');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Clave localidad');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Actividad económica');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Nacionalidad');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Celular');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Teléfono');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Extensión');
        $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Fax');
        $objPHPExcel->getActiveSheet()->setCellValue('W1', 'RFC');
        $objPHPExcel->getActiveSheet()->setCellValue('X1', 'CURP');
        $objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Web');
        $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Correo');
        $objPHPExcel->getActiveSheet()->setCellValue('AA1', 'Clave de la linea');
        $objPHPExcel->getActiveSheet()->setCellValue('AB1', 'Importe de la linea de credito');
        $objPHPExcel->getActiveSheet()->setCellValue('AC1', 'Fecha inicio linea contrato');
        $objPHPExcel->getActiveSheet()->setCellValue('AD1', 'Fecha venc. Linea contrato');
        $objPHPExcel->getActiveSheet()->setCellValue('AE1', 'Fecha de nacimiento');

        if (is_array($mesa)) {

            foreach ($mesa as $arreglo) {

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $contRow, $arreglo['kepler']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $contRow, $arreglo['num_cliente']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $contRow, $arreglo['falta_contrato']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $contRow, $arreglo['matricula']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $contRow, $arreglo['apaterno']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $contRow, $arreglo['amaterno']);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $contRow, $arreglo['nombre1']);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $contRow, $arreglo['nombre2']);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $contRow, $arreglo['calle_num']);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $contRow, $arreglo['colonia']);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $contRow, $arreglo['poblacion']);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $contRow, $arreglo['cod_postal']);
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $contRow, $arreglo['ciudad']);
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $contRow, $arreglo['delegacion']);
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $contRow, $arreglo['clave_edo']);
                $objPHPExcel->getActiveSheet()->setCellValue('P' . $contRow, $arreglo['clave_loc']);
                $objPHPExcel->getActiveSheet()->setCellValue('Q' . $contRow, $arreglo['act_economica']);
                $objPHPExcel->getActiveSheet()->setCellValue('R' . $contRow, 'MEXICANA');
                $objPHPExcel->getActiveSheet()->setCellValue('S' . $contRow, $arreglo['cel_alumno']);
                $objPHPExcel->getActiveSheet()->setCellValue('T' . $contRow, $arreglo['telefono']);
                $objPHPExcel->getActiveSheet()->setCellValue('U' . $contRow, $arreglo['ext']);
                $objPHPExcel->getActiveSheet()->setCellValue('V' . $contRow, $arreglo['fax']);
                $objPHPExcel->getActiveSheet()->setCellValue('W' . $contRow, $arreglo['rfc']);
                $objPHPExcel->getActiveSheet()->setCellValue('X' . $contRow, $arreglo['curp']);
                $objPHPExcel->getActiveSheet()->setCellValue('Y' . $contRow, $arreglo['pag_web']);
                $objPHPExcel->getActiveSheet()->setCellValue('Z' . $contRow, $arreglo['email']);
                $objPHPExcel->getActiveSheet()->setCellValue('AA' . $contRow, $arreglo['producto']);
                $objPHPExcel->getActiveSheet()->setCellValue('AB' . $contRow, $arreglo['importe_linea']);
                $objPHPExcel->getActiveSheet()->setCellValue('AC' . $contRow, $arreglo['finicio_lin_contrato']);
                $objPHPExcel->getActiveSheet()->setCellValue('AD' . $contRow, $arreglo['fvencimiento_lin_contrato']);
                $objPHPExcel->getActiveSheet()->setCellValue('AE' . $contRow, $arreglo['fnacimiento']);
                $contRow++;
            }
        }

        $objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->setTitle("Layout 1");
    }

    public function creaHojaDos($objPHPExcel,$mesa, $style_header) {

        //global $objPHPExcel;
        $contRow = 2;
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1);

//$objPHPExcel; 
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sucursal Kepler');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'No. cliente');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Matrícula');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Fecha Contrato');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Clave de la linea');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Importe del pagaré');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Plazo');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Periodo de gracia');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Fecha inicio pagare');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Día de pago');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Fecha 1er pago');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Fuente fondeo');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Colegiatura');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Seg. vida');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Est. socioeconomico');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Buro');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Comision disp.');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Tasa interés');

        if (is_array($mesa)) {

            foreach ($mesa as $arreglo) {

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $contRow, $arreglo['kepler']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $contRow, $arreglo['num_cliente']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $contRow, $arreglo['matricula']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $contRow, $arreglo['falta_contrato']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $contRow, $arreglo['producto']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $contRow, '$ ' . number_format($arreglo['subtotal'], 2));
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $contRow, $arreglo['plazo']);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $contRow, $arreglo['periodo_gracia']);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $contRow, $arreglo['finicio_pagare']);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $contRow, $arreglo['dia_pago']);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $contRow, $arreglo['fprimer_pago']);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $contRow, $arreglo['ffondeo']);
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $contRow, '$ ' . number_format($arreglo['colegiatura'],2));
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $contRow, $arreglo['seg_vida']);
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $contRow, $arreglo['cantSocio']);
                $objPHPExcel->getActiveSheet()->setCellValue('P' . $contRow, $arreglo['buro_credito']);
                $objPHPExcel->getActiveSheet()->setCellValue('Q' . $contRow, $arreglo['comi_disp']);
                $objPHPExcel->getActiveSheet()->setCellValue('R' . $contRow, $arreglo['porc_subsidio']);
                $contRow++;
            }
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:R1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->setTitle("Layout 2");
    }

    public function mesa($post) {

        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        ini_set('memory_limit', '-1');
        include './finem/third_party/phpexcel/PHPExcel.php'; // FUNCIONES GENERALES.
        include './finem/third_party/phpexcel/PHPExcel/IOFactory.php'; 
        
        $fini = fecha_contrato($post['fechaini'],'inverso');
        $ffin = fecha_contrato($post['fechafin'],'inverso');
        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '353C42')
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '010A76'),
            ),
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF')
            )
        );
//$bguardar = TRUE;
        $bguardar = FALSE;

        /** Se crea el objeto del excel. */
        $objPHPExcel = new PHPExcel();
        $pageConfig = $_SERVER['PHP_SELF'];
        $archivoActual = basename($pageConfig);

        $objPHPExcel->getProperties()->setCreator("FINEM (Estrategias Digitales)")
                ->setLastModifiedBy("FINEM (Estrategias Digitales)")
                ->setTitle("Layout 1")
                ->setSubject("Reporte Mesa Control " . date('d-m-Y H:i:s'))
                ->setDescription("Reporte para Mesa de Control de nuevos contraots..")
                ->setKeywords("Mesa Control FINEM Estrategias Digitales")
                ->setCategory("Reporte");

        $mesa = $this->getMesa($fini,$ffin);
        //$mesa = FALSE;
        //print_r($mesa);
        //echo $this->db->last_query();
        //BREAK;
        $this->creaHojaUno($objPHPExcel,$mesa, $style_header);
        $this->creaHojaDos($objPHPExcel,$mesa, $style_header);

        if ($bguardar == FALSE) {

            header("Content-type: application/vnd.ms-excel");
            header('Content-Disposition: attachment;filename="' . str_replace('.php', '', $archivoActual) . '"');
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
            header("Pragma: public");
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        } else {
//echo '<br>' . __FILE__;
//echo '<br>'.str_replace('.php', '.xlsx', __FILE__);
//echo '<br>'.$_SERVER['DOCUMENT_ROOT'] . '/finem/archivostemp/' . str_replace('.php', '.xlsx', $archivoActual);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
            echo date('H:i:s'), " File written to ", str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
        }
    }
    
    public function getMesa($fini,$ffin){
        $this->load->model('expediente_model','expediente');
        $campos = "idexpediente,idalumno,
                    '>>>>>' as kepler,
                    '>>>>>' as num_cliente,
                    contrato.fecha_suscripcion as falta_contrato,
                    alumno.nombre as nombre1,
                    alumno.nombre_dos as nombre2,
                    alumno.apater as apaterno,
                    alumno.amater as amaterno,
                    expediente.matricula as matricula,
                    alumno.nacimiento as fnacimiento,
                    CONCAT(domicilio.calle,' ',domicilio.interior,' ',domicilio.exterior) as calle_num,
                    domicilio.colonia as colonia,
                    domicilio.colonia as poblacion,
                    domicilio.codigo_postal as cod_postal,
                    domicilio.ciudad as ciudad,
                    domicilio.delegacion as delegacion,
                    NULL as clave_edo,
                    NULL as clave_loc,
                    alumno.email as email,
                    alumno.celular as cel_alumno,
                    domicilio.telefono as telefono,
                    NULL as act_economica,
                    NULL as nacionalidad,
                    NULL as pag_web,
                    alumno.rfc as rfc,
                    NULL as curp,
                    NULL as clave_linea,
                    analisis.importe as importe_linea,
                    contrato.fecha_suscripcion as finicio_lin_contrato,
                    contrato.fecha_vencimiento as fvencimiento_lin_contrato,
                    analisis.plazo as plazo,
                    NULL as periodo_gracia,
                    pagare.fecha_suscripcion as finicio_pagare,
                    5 as dia_pago,
                    pagare.fecha_primer_pago as fprimer_pago,
                    NULL as ffondeo,
                    pagare.importe as colegiatura,
                    NULL as seg_vida,
                    NULL as est_socioec,
                    NULL as buro_credito,
                    NULL as comi_disp,
                    NULL as porc_subsidio,
                    0 as terminado,
                    NULL as comentarios,
                    NULL as comentarios_cobranza,
                    CURDATE() as falta,
                    NULL as status,
                    universidad.razon_social as universidad,
                    campus.nombre as campus,
                    producto.nombre as producto,
                    NULL as fvencimiento_plazo,
                    NULL as nombre1Aval3,
                    NULL as nombre2Aval3,
                    NULL as appaternoAval3,
                    NULL as apmaternoAval3,
                    NULL as bguardado,
                    NULL as cantSocio,
                    NULL as ext,
                    NULL as fax,
                    pagare.importe_pagare as subtotal";

        $this->db->select($campos, FALSE);
        $this->db->where('enviar_mesa', 1);
        $this->db->where('pagare.fecha_suscripcion >=', $fini);
        $this->db->where('pagare.fecha_suscripcion <=', $ffin);
        //$this->db->where('expediente.matricula', 'pruebax');
        $this->db->join('contrato', 'pagare.expediente_idexpediente = contrato.expediente_idexpediente');
        $this->db->join('expediente', 'idexpediente = contrato.expediente_idexpediente');
        $this->db->join('universidad', 'iduniversidad = universidad_iduniversidad');
        $this->db->join('campus', 'idcampus = campus_idcampus');
        $this->db->join('carrera', 'especialidad = idcarrera');
        $this->db->join('alumno', 'idalumno = expediente.alumno_idalumno');
        //$this->db->join('aval as aval1', 'idalumno = expediente.alumno_idalumno');
        //$this->db->join('aval as aval2', 'idalumno = expediente.alumno_idalumno');
        $this->db->join('domicilio', 'idalumno = domicilio.alumno_idalumno');
        $this->db->join('analisis', 'idexpediente = analisis.expediente_idexpediente');
        $this->db->join('producto', 'producto_idproducto = producto.idproducto');
        //$this->db->group_by('idexpediente');
        $q = $this->db->get('pagare');
        //echo $this->db->last_query();
        if($q->num_rows() > 0){
            $tmp = $q->result_array();
            
            foreach($tmp as $t){
                $datax = $t;
                $datay = $this->get_aval_mesa($t['idalumno']);
                
                $data2[] = array_merge($datax,$datay);
            }
            
            //print_r($datay);
            
        }else{
            $data2 = array();
        }
        
        return $data2;
    }
    
    public function get_aval_mesa($id){
        $q = $this->db->get_where('aval',array('alumno_idalumno' => $id));
        
        if($q->num_rows() > 0){
            $tmp = $q->result_array();
            $cont = 0;
            foreach($tmp as $t){
                if($cont == 0){
                    $data['nombre1Aval'] = $t['nombre'];
                    $data['nombre2Aval'] = $t['nombre_dos'];
                    $data['appaternoAval'] = $t['apaterno'];
                    $data['apmaternoAval'] = $t['amaterno'];
                }
                if($cont == 1){
                    $data['nombre1Aval2'] = $t['nombre'];
                    $data['nombre2Aval2'] = $t['nombre_dos'];
                    $data['appaternoAval2'] = $t['apaterno'];
                    $data['apmaternoAval2'] = $t['amaterno'];
                }
                
                $cont++;
            }
        }else{
            $data['nombre1Aval'] = NULL;
            $data['nombre2Aval'] = NULL;
            $data['appaternoAval'] = NULL;
            $data['apmaternoAval'] = NULL;
            $data['nombre1Aval2'] = NULL;
            $data['nombre2Aval2'] = NULL;
            $data['appaternoAval2'] = NULL;
            $data['apmaternoAval2'] = NULL;
        }
        
        return $data;
    }

}

