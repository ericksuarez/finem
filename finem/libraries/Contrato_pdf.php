<?php

require_once('fpdf/fpdf.php');

Class Contrato_pdf extends fpdf {

    const entrelineado = 5;
    const parrafo = 4;
    const una_linea = 0;
    const un_renglon = 8;
    const margen_izq = 15;
    const margen_der = 15;
    const letra_tamano = 8;
    const tipo_letra = 'Arial';
    protected $nombre;
    
    protected function crea_tabla(){
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode('Medios de Pago'), 1, 0, 'C');
        $this->Cell(135, self::entrelineado, utf8_decode('Fechas de Acreditamiento del pago'), 1, 0, 'C');
        $this->Ln();

        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode('Efectivo'), 1, 0, 'L');      
        $this->Cell(135, self::entrelineado, utf8_decode('Se acreditará el mismo día.'), 1, 0, 'L');
        $this->Ln();
        $this->Rect(65, 135, 135, 49);
        $this->Rect(15, 135, 50, 49);
        $this->Ln(1);
        $this->Cell(50, self::entrelineado, utf8_decode('Cheque'), 0, 0, 'L');      
        $this->Cell(135, 3, utf8_decode('1. Entregado a "FINEM" o a los terceros que ésta pudiera designar distintos a bancos:'), 0, 0, 'L');      
        $this->Ln();
        $this->Cell(50, self::entrelineado, utf8_decode(''), 0, 0, 'L');            
        $this->MultiCell(135,3, utf8_decode('a) A cargo de BBVA Bancomer, S.A., Institución de Banca Múltiple, se acreditará el mismo día hábil bancario.'));
        $this->Ln(2);
        $this->Cell(50, self::entrelineado, utf8_decode(''), 0, 0, 'L');            
        $this->MultiCell(135,3, utf8_decode('b) A cargo de cualquier otro banco que no sea el mencionado en el inciso anterior, se acreditará a más tardar el segundo día hábil bancario siguiente.'));
        $this->Ln(2);
        $this->Cell(50, self::entrelineado, utf8_decode(''), 0, 0, 'L');            
        $this->MultiCell(135,3, utf8_decode('2. Depositado en la Cuenta Concentradora de "FINEM" en BBVA Bancomer, S.A., Institución de Banca Múltiple, bajo el Número de Convenio CIE, que se precisa en la Carátula del presente Contrato.'));
        $this->Ln(2);
        $this->Cell(50, self::entrelineado, utf8_decode(''), 0, 0, 'L');            
        $this->MultiCell(135,3, utf8_decode('a) A cargo de BBVA Bancomer, S.A., Institución de Banca Múltiple, se acreditará el mismo día hábil bancario.'));
        $this->Ln(2);
        $this->Cell(50, self::entrelineado, utf8_decode(''), 0, 0, 'L');            
        $this->MultiCell(135,3, utf8_decode('b) A cargo de otro banco, depositado antes de las 16:00 horas, se acreditará a más tardar el día hábil siguiente; y después de las 16:00 horas, se acreditará a más tardar el segundo día hábil siguiente.'));
        $this->Ln(2);
        $this->Cell(50, self::entrelineado, utf8_decode(''), 0, 0, 'L');            
        $this->MultiCell(135,3, utf8_decode('3. El horario para recepción de cheques será de las  9:00 a las 13:00 horas.'));
        $this->Ln(2);
        //$this->Cell(50, self::entrelineado, utf8_decode('xxxxxxxxxxxxxxxxx'), 1, 0, 'L');  
        //$this->Cell(135, 50, utf8_decode(''), 1, 0, 'L');
        $this->Cell(50, self::entrelineado, utf8_decode('Transferencia Electrónica de Fondos'), 1, 0, 'L');      
        $this->Cell(135, self::entrelineado, utf8_decode('El mismo día hábil en que se hayan acreditado los recursos en la Cuenta de Cheques de "FINEM".'), 1, 0, 'L');
        $this->Ln();
    }
    protected function escribe_texto($parrafo, $letra) {

        foreach ($parrafo as $num_parrafo => $texto) {
            
            if($num_parrafo == 46){
                $this->crea_tabla();
                $this->Ln(self::parrafo);
            }else{
                if (isset($letra[$num_parrafo]) AND is_array($letra[$num_parrafo])) {
                    $this->SetFont(self::tipo_letra, $letra[$num_parrafo]['tipo'], $letra[$num_parrafo]['size']);
                } else {
                    $this->SetFont(self::tipo_letra, '', self::letra_tamano);
                }

                if (isset($letra[$num_parrafo]['alineado']) AND $letra[$num_parrafo]['alineado'] == 'center') {
                    $align = 'C';
                } else {
                    $align = 'J';
                }
                $this->MultiCell(185, self::entrelineado, utf8_decode($texto), 0, $align);
                $this->Ln(self::parrafo);
            }
            
        }
    }
    
    protected function set_nombre($nombre, $posicion) {
        $this->nombre[$posicion] = $nombre;
    }
    
    protected function get_nombre($posicion) {
        return $this->nombre[$posicion];
    }
    
    public function Header() {

        ////$this->Rect(10,8,196,262,'D');
        // Logo        
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            
            if (!defined('FPDF_FONTPATH')) {
                define('FPDF_FONTPATH',$_SERVER['DOCUMENT_ROOT'].'\finemv2\finem\libraries\fpdf\font/');
            }
            //$this->Image($_SERVER['DOCUMENT_ROOT'].'/finemv2/images/finem.jpg', 18, 11, 50);
        } else {

            if (!defined('FPDF_FONTPATH')) {

                define('FPDF_FONTPATH', $_SERVER['DOCUMENT_ROOT'] . '\sistema\finem\ibraries\fpdf\font');
            }
            //$this->Image($_SERVER['DOCUMENT_ROOT'] . '/sistema/images/finem.jpg', 18, 11, 50);
        }
        // Arial bold 15
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        //$this->Ln(20);
    }

    // Pie de página
    public function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-8);
        // Arial italic 8
        $this->SetFont(self::tipo_letra, 'I', 8);
        // Número de página
        $this->Cell(0, 5, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    public function abre_documento($orientacion = 'P') {

        $this->Open();
        $this->AliasNbPages();
        $this->AddPage($orientacion, 'Letter');
        $this->setLeftMargin(self::margen_izq);
        $this->setRightMargin(self::margen_der);
    }

    public function cierra_documento() {
        FPDF::Output();
    }

    public function nueva_hoja($orientacion = 'P') {
        //$this->AliasNbPages();
        $this->AddPage($orientacion, 'Letter');
        //$this->setLeftMargin(self::margen_izq);
        //$this->setRightMargin(self::margen_der);
    }

    public function caratula($info = FALSE, $config = FALSE) {
        
        $CI = & get_instance();
        $CI->load->helper('letra_numero');
        
        $estado_civil = $config['estado_civil'];
        $nivel_estudios = $config['nivel_estudios'];
        
        // DATOS DEL ALUMNO
        $nombre['alumno'] = $info['alumno']['nombre'] . ' ' . (($info['alumno']['nombre_dos'] == '') ? '' : $info['alumno']['nombre_dos'] . ' ') . 
                $info['alumno']['apater'] . ' ' . $info['alumno']['amater'];        
        if(!empty($info['alumno']['nacimiento'])){
            $fechanac_obj = new DateTime($info['alumno']['nacimiento']); //print_r($fecha_nac_obj);
            $dia_nac['alumno'] = $fechanac_obj->format('d');
            $mes_nac['alumno'] = $fechanac_obj->format('m');
            $anio_nac['alumno'] = $fechanac_obj->format('Y');
        }else{
            $dia_nac['alumno'] = '';
            $mes_nac['alumno'] = '';
            $anio_nac['alumno'] = '';
        }
        $calle_num['alumno'] = $info['adom']['calle'] . 
                (!empty($info['adom']['exterior']) ? ', Ext. ' . $info['adom']['exterior'] : '') . 
                (!empty($info['adom']['interior']) ? ', Int. ' . $info['adom']['interior'] : '');
        $conyuge['alumno'] = $info['alumno']['nombre_conyuge'];
        /* IDENTIFICACION OFICIAL */
        $doc_of = $info['alumno']['oficial'];
        $marca['alumno'][$doc_of] = 'X';
        $num_oficial['alumno']['folio'] = $info['alumno']['numero_oficial'];        
        // FIN DATOS DEL ALUMNO
        
        $posiciones = array('aval1', 'aval2');
        $titulos = array(
            'aval1' => 'II.  Datos generales del "Obligado Solidario y Aval" (1)',
            'aval2' => 'III.  Datos generales del "Obligado Solidario y Aval" (2)'
        );
        
        // DATOS DEL AVAL(ES)
        foreach ($posiciones as $llave => $posicion) {            
            $arreglo = $info[$posicion];
            $nombre[$posicion] = $arreglo['nombre'] . ' ' . (($arreglo['nombre_dos'] == '') ? '' : $arreglo['nombre_dos'] . ' ') . 
                    $arreglo['apaterno'] . ' ' . $arreglo['amaterno'];
            //$fechanac_obj[$posicion] = new DateTime($arreglo['nacimiento']); //print_r($fecha_nac_obj);            
            if(!empty($info[$posicion]['nacimiento'])){
                $fechanac_obj = new DateTime($info[$posicion]['nacimiento']); //print_r($fecha_nac_obj);
                $dia_nac[$posicion] = $fechanac_obj->format('d');
                $mes_nac[$posicion] = $fechanac_obj->format('m');
                $anio_nac[$posicion] = $fechanac_obj->format('Y');
            }else{
                //$fechanac_obj = new DateTime($info[$posicion]['nacimiento']); //print_r($fecha_nac_obj);
                $dia_nac[$posicion] = '';
                $mes_nac[$posicion] = '';
                $anio_nac[$posicion] = '';
            }
            $calle_num[$posicion] = $arreglo['calle'] . 
                (!empty($arreglo['exterior']) ? ', Ext. ' . $arreglo['exterior'] : '') . 
                (!empty($arreglo['interior']) ? ', Int. ' . $arreglo['interior'] : '');
            /* IDENTIFICACION OFICIAL */
            $doc_of = $info[$posicion]['oficial'];
            $marca[$posicion][$doc_of] = 'X';
            $num_oficial[$posicion]['folio'] = $info[$posicion]['numero_oficial'];        
        }
        // FIN DATOS DEL AVAL(ES)
        
        $this->set_nombre($nombre['alumno'], 'alumno');
        $this->set_nombre($conyuge['alumno'], 'conyuge_alu');
        $this->set_nombre($nombre['aval1'], 'aval1');
        $this->set_nombre($info['aval1']['nombre_conyuge'], 'conyuge_aval1');
        $this->set_nombre($nombre['aval2'], 'aval2');
        $this->set_nombre($info['aval2']['nombre_conyuge'], 'conyuge_aval2');
        
        //print_r($this->nombre);
        
        // DATOS DEL CREDITO (INICIO)
        $niv_ab = $info['expediente']['nivel'];
        $nivel[$niv_ab] = 'X';
        $universidad = obtener_campo('razon_social.universidad', 'iduniversidad.' . $info['expediente']['universidad_iduniversidad']);
        $campus = obtener_campo('nombre.campus', 'idcampus.' . $info['expediente']['campus_idcampus']);
        $plan_carrera = obtener_campo('marca_plan.carrera','idcarrera.'.$info['expediente']['especialidad']);
        $monto_total = isset($info['analisis']['importe']) ? $info['analisis']['importe'] : 0;
        $porcentaje_costo = isset($info['analisis']['credito_autorizado']) ? $info['analisis']['credito_autorizado'] : '';
        $cat = isset($info['contrato']['cat']) ? $info['contrato']['cat'] : '';        
        $plazo = isset($info['contrato']['plazo_credito']) ? $info['contrato']['plazo_credito'] : '';
        $periodo_disposicion = isset($info['contrato']['periodo_disposicion']) ? $info['contrato']['periodo_disposicion'] : '';
        $vigencia_contrato = isset($info['contrato']['plazo_credito']) ? $info['contrato']['plazo_credito'] : '';
        $monto_total_mensual = isset($info['monto_mensual']) ? $info['monto_mensual'] : '';
        $tasa_interes = isset($info['contrato']['tasa_fija']) ? $info['contrato']['tasa_fija'] : '';
        $tasa_moratoria = isset($info['contrato']['tasa_moratoria']) ? $info['contrato']['tasa_moratoria'] : '';
        $convenio_cie = obtener_campo('convenio_cie.universidad', 'iduniversidad.' . $info['expediente']['universidad_iduniversidad']);
        $referencia = isset($info['contrato']['numero_referencia']) ? $info['contrato']['numero_referencia'] : '';
        $digito = isset($info['contrato']['digito_verificador']) ? $info['contrato']['digito_verificador'] : '';
        $referencia .= $digito;
        $cantidad = array(
            'semestral' => ($plan_carrera == 'semestral') ? '$'.number_format($info['contrato']['pago_mensual'],2) : '>>>>>>>>>>>>>>',
            'cuatrimestral' => ($plan_carrera == 'cuatrimestral') ? '$'.number_format($info['contrato']['pago_mensual'],2) : '>>>>>>>>>>>>>>',
            'trimestral' => ($plan_carrera == 'trimestral') ? '$'.number_format($info['contrato']['pago_mensual'],2) : '>>>>>>>>>>>>>>'
        );
        $cantidadx = array(
            'semestral' => ($plan_carrera == 'semestral') ? '$'.number_format($info['contrato']['pago_extraordinario'],2) : '>>>>>>>>>>>>>>',
            'cuatrimestral' => ($plan_carrera == 'cuatrimestral') ? '$'.number_format($info['contrato']['pago_extraordinario'],2) : '>>>>>>>>>>>>>>',
            'trimestral' => ($plan_carrera == 'trimestral') ? '$'.number_format($info['contrato']['pago_extraordinario'],2) : '>>>>>>>>>>>>>>'
        );
        $periodox = array(
            'del' => $info['contrato']['del'],
            'al' => $info['contrato']['al']
        );
        $fecha_firma = fecha_contrato($info['contrato']['fecha_suscripcion']);
        
        
        //print_r($info);
        // DATOS DEL CREDITO (FIN)
        

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        //$this->Cell(185, self::entrelineado, utf8_decode('NUMERO DE REGISTRO CONDUSEF: ??????????????'), 0, 0, 'R');
        $this->Ln(self::un_renglon);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(130, self::entrelineado, utf8_decode('CARÁTULA DEL CONTRATO DE CRÉDITO'), 0, 0, 'C');
        $this->Rect(140, 15, 60, 10, 'D');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(54, self::entrelineado, utf8_decode('MATRÍCULA: ' . $info['expediente']['matricula']), 0, 0, 'R');
        $this->Ln(self::parrafo);
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(130, self::entrelineado, utf8_decode('(La presente carátula es parte integrante del Contrato de Crédito)'), 0, 0, 'C');
        $this->Ln(self::un_renglon);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->SetFillColor(237, 238, 236); // RELLENAMOS DE COLOR GRIS EL RECTÁNGULO		
        $this->Rect(15, 30, 185, 5, 'DF');
        $this->Cell(185, self::entrelineado, utf8_decode('CRÉDITO EDUCATIVO PAGOS IGUALES'), 0, 0, 'C');
        $this->Ln(self::un_renglon);

        // ############################# DATOS DEL ALUMNO (FIN) #############################
        //$this->Rect(15, 38, 185, 5, 'DF');
        $this->Cell(185, self::entrelineado, utf8_decode('I.  Datos generales del "Acreditado".-'), 1, 0, 'L',1);
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(36, self::entrelineado, utf8_decode('Nombre completo:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);        
        $this->Cell(149, self::entrelineado, utf8_decode($nombre['alumno']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(42, self::entrelineado, utf8_decode('Fecha de nacimiento:'), 1, 0, 'L');
        $this->Cell(10, self::entrelineado, utf8_decode('Día:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(8, self::entrelineado, utf8_decode($dia_nac['alumno']), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(11, self::entrelineado, utf8_decode('Mes:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(8, self::entrelineado, utf8_decode($mes_nac['alumno']), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(11, self::entrelineado, utf8_decode('Año:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(11, self::entrelineado, utf8_decode($anio_nac['alumno']), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(36, self::entrelineado, utf8_decode('Lugar nacimiento:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(48, self::entrelineado, utf8_decode($info['alumno']['lugar_nac']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(25, self::entrelineado, utf8_decode('Estado Civil:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode($estado_civil[$info['alumno']['estado_civil']]), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(42, self::entrelineado, utf8_decode('Nombre del conyuge:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(83, self::entrelineado, utf8_decode($conyuge['alumno']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(23, self::entrelineado, utf8_decode('Dirección:'), 1, 0, 'L');
        $this->Cell(31, self::entrelineado, utf8_decode('Calle y número:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(131, self::entrelineado, utf8_decode($calle_num['alumno']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(18, self::entrelineado, utf8_decode('Colonia:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(167, self::entrelineado, utf8_decode($info['adom']['colonia']), 1, 0, 'L');
        $this->Ln();
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(43, self::entrelineado, utf8_decode('Delegación/Municipio:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(142, self::entrelineado, utf8_decode($info['adom']['delegacion']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(16, self::entrelineado, utf8_decode('Ciudad:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(65, self::entrelineado, utf8_decode($info['adom']['ciudad']), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(13, self::entrelineado, utf8_decode('C.P.:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(15, self::entrelineado, utf8_decode($info['adom']['codigo_postal']), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(18, self::entrelineado, utf8_decode('Estado:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(58, self::entrelineado, utf8_decode($info['adom']['estado']), 1, 0, 'L');
        $this->Ln();
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('Documento con el que acredita su identidad:'), 1, 0, 'C');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(43, self::entrelineado, utf8_decode('Credencial para Votar:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca['alumno']['ife']) ? $marca['alumno']['ife'] : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode('Pasaporte Mexicano:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca['alumno']['pasaporte']) ? $marca['alumno']['pasaporte'] : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode('Cartilla de Servicio Militar:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca['alumno']['cartilla']) ? $marca['alumno']['cartilla'] : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(38, self::entrelineado, utf8_decode('Cédula Profesional:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca['alumno']['cedula']) ? $marca['alumno']['cedula'] : ''), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(42, self::entrelineado, utf8_decode('Folio/Número:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(143, self::entrelineado, utf8_decode($num_oficial['alumno']['folio']), 1, 0, 'L');
        /*$this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(20, self::entrelineado, utf8_decode('Número:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(23.5, self::entrelineado, utf8_decode(isset($num_oficial['alumno']['pasaporte']) ? $num_oficial['alumno']['pasaporte'] : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(16, self::entrelineado, utf8_decode('Folio:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(37.5, self::entrelineado, utf8_decode(isset($num_oficial['alumno']['cartilla']) ? $num_oficial['alumno']['cartilla'] : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(20, self::entrelineado, utf8_decode('Número:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(21.5, self::entrelineado, utf8_decode(isset($num_oficial['alumno']['cedula']) ? $num_oficial['alumno']['cedula'] : ''), 1, 0, 'L');*/
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(15.5, self::entrelineado, utf8_decode('IFE'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(12.5, self::entrelineado, utf8_decode('SRE'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(22.5, self::entrelineado, utf8_decode('SEDENA'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(10.5, self::entrelineado, utf8_decode('SEP'), 1, 0, 'L');
        $this->Ln(self::un_renglon);
        // ############################# DATOS DEL ALUMNO (FIN) #############################
        
        // ############################# DATOS DEL AVAL(ES) (INICIO) #############################        
        foreach ($posiciones as $posicion) {
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(185, self::entrelineado, utf8_decode($titulos[$posicion].'.-'), 1, 0, 'L', 1);
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(36, self::entrelineado, utf8_decode('Nombre completo:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(149, self::entrelineado, utf8_decode($nombre[$posicion]), 1, 0, 'L');
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(42, self::entrelineado, utf8_decode('Fecha de nacimiento:'), 1, 0, 'L');
            $this->Cell(10, self::entrelineado, utf8_decode('Día:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(10, self::entrelineado, utf8_decode($dia_nac[$posicion]), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(11, self::entrelineado, utf8_decode('Mes:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(10, self::entrelineado, utf8_decode($mes_nac[$posicion]), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(11, self::entrelineado, utf8_decode('Año:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(10, self::entrelineado, utf8_decode($anio_nac[$posicion]), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(42, self::entrelineado, utf8_decode('Lugar de nacimiento:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(39, self::entrelineado, utf8_decode($info[$posicion]['lugar_nac']), 1, 0, 'L');
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(25, self::entrelineado, utf8_decode('Estado Civil:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(35, self::entrelineado, utf8_decode($estado_civil[$info[$posicion]['edo_civil']]), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(42, self::entrelineado, utf8_decode('Nombre del conyuge:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(83, self::entrelineado, utf8_decode(isset($info[$posicion]['nombre_conyuge']) ? $info[$posicion]['nombre_conyuge'] : ''), 1, 0, 'L');
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(23, self::entrelineado, utf8_decode('Dirección:'), 1, 0, 'L');
            $this->Cell(31, self::entrelineado, utf8_decode('Calle y número:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(131, self::entrelineado, utf8_decode($calle_num[$posicion]), 1, 0, 'L');
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(18, self::entrelineado, utf8_decode('Colonia:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(167, self::entrelineado, utf8_decode($info[$posicion]['colonia']), 1, 0, 'L');
            $this->Ln();
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(43, self::entrelineado, utf8_decode('Delegación/Municipio:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(142, self::entrelineado, utf8_decode($info[$posicion]['delegacion']), 1, 0, 'L');
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(16, self::entrelineado, utf8_decode('Ciudad:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(65, self::entrelineado, utf8_decode($info[$posicion]['ciudad']), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(13, self::entrelineado, utf8_decode('C.P.:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(15, self::entrelineado, utf8_decode($info[$posicion]['cp']), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(18, self::entrelineado, utf8_decode('Estado:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(58, self::entrelineado, utf8_decode($info[$posicion]['estado']), 1, 0, 'L');
            $this->Ln();
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(185, self::entrelineado, utf8_decode('Documento con el que acredita su identidad:'), 1, 0, 'C');
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(43, self::entrelineado, utf8_decode('Credencial para Votar:'), 1, 0, 'L');
            $this->SetFont('Times', '', self::letra_tamano);
            $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca[$posicion]['ife']) ? $marca[$posicion]['ife'] : ''), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(40, self::entrelineado, utf8_decode('Pasaporte Mexicano:'), 1, 0, 'L');
            $this->SetFont('Times', '', self::letra_tamano);
            $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca[$posicion]['pasaporte']) ? $marca[$posicion]['pasaporte'] : ''), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(50, self::entrelineado, utf8_decode('Cartilla de Servicio Militar:'), 1, 0, 'L');
            $this->SetFont('Times', '', self::letra_tamano);
            $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca[$posicion]['cartilla']) ? $marca[$posicion]['cartilla'] : ''), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(38, self::entrelineado, utf8_decode('Cédula Profesional:'), 1, 0, 'L');
            $this->SetFont('Times', '', self::letra_tamano);
            $this->Cell(3.5, self::entrelineado, utf8_decode(isset($marca[$posicion]['cedula']) ? $marca[$posicion]['cedula'] : ''), 1, 0, 'L');
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(42, self::entrelineado, utf8_decode('Folio/Número:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(143, self::entrelineado, utf8_decode($num_oficial[$posicion]['folio']), 1, 0, 'L');
            /*$this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(20, self::entrelineado, utf8_decode('Número:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(23.5, self::entrelineado, utf8_decode(isset($num_oficial[$posicion]['pasaporte']) ? $num_oficial[$posicion]['pasaporte'] : ''), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(16, self::entrelineado, utf8_decode('Folio:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(37.5, self::entrelineado, utf8_decode(isset($num_oficial[$posicion]['cartilla']) ? $num_oficial[$posicion]['cartilla'] : '') , 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(20, self::entrelineado, utf8_decode('Número:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(21.5, self::entrelineado, utf8_decode(isset($num_oficial[$posicion]['cedula']) ? $num_oficial[$posicion]['cedula'] : ''), 1, 0, 'L');*/
            $this->Ln();

            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(15.5, self::entrelineado, utf8_decode('IFE'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(12.5, self::entrelineado, utf8_decode('SRE'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(22.5, self::entrelineado, utf8_decode('SEDENA'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
            $this->Cell(31, self::entrelineado, utf8_decode('Autoridad Exp.:'), 1, 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(10.5, self::entrelineado, utf8_decode('SEP'), 1, 0, 'L');
            $this->Ln(self::un_renglon);
        }
        // ############################# DATOS DEL AVAL(ES) (FIN) #############################        

        // ############################# DESTINO DEL CRÉDITO (INICIO) #############################
        //$this->Rect(15, 232, 185, 5, 'DF');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('IV. Destino del Crédito.-'), 1, 0, 'L',1);
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode('Tipo de estudios:'), 1, 0, 'L');
        $this->Cell(35, self::entrelineado, utf8_decode('A. Licenciatura:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(14, self::entrelineado, utf8_decode(isset($nivel['lic']) ? $nivel['lic'] : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode('B. Especialidad:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(14, self::entrelineado, utf8_decode(isset($nivel['especialidad']) ? $nivel['especialidad'] : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(33, self::entrelineado, utf8_decode('C. Maestría:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(14, self::entrelineado, utf8_decode(isset($nivel['maestria']) ? $nivel['maestria'] : ''), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('Nombre de la Carrera, Especialidad o Maestría a cursar:'), 1, 0, 'L');
        $this->Ln();
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode(ucfirst(obtener_campo('titulo.carrera','idcarrera.'.$info['expediente']['especialidad']))), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(60, self::entrelineado, utf8_decode('Nombre de la Universidad:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(125, self::entrelineado, utf8_decode($universidad), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode('Nombre del Campus:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(135, self::entrelineado, utf8_decode($campus), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(41, self::entrelineado, utf8_decode('Plan de la carrera:'), 1, 0, 'L');
        $this->Cell(27, self::entrelineado, utf8_decode('Semestral:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(17, self::entrelineado, utf8_decode(($plan_carrera=='semestral') ? 'X' : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(34, self::entrelineado, utf8_decode('Cuatrimestral:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(17, self::entrelineado, utf8_decode(($plan_carrera=='cuatrimestral') ? 'X' : ''), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(32, self::entrelineado, utf8_decode('Trimestral:'), 1, 0, 'L');
        $this->SetFont('Times', '', self::letra_tamano);
        $this->Cell(17, self::entrelineado, utf8_decode(($plan_carrera=='trimestral') ? 'X' : ''), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(43, self::entrelineado, utf8_decode('Periodo de estudios:'), 1, 0, 'L');
        $this->Cell(31, self::entrelineado, utf8_decode('Del:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra,'', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode($periodox['del']), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(31, self::entrelineado, utf8_decode('Al:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode($periodox['al']), 1, 0, 'L');
        $this->Ln(self::un_renglon);
        // ############################# DESTINO DEL CRÉDITO (FIN) #############################

        // ############################# DATOS GENERALES DEL CRÉDITO (INICIO) #############################
        //$this->Rect(15, 48, 185, 5, 'DF');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('V. Datos generales del Crédito.-'), 1, 0, 'L',1);
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(85, self::entrelineado, utf8_decode('Monto total de la línea de crédito autorizada:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(100, self::entrelineado, utf8_decode('$ ' . number_format($monto_total,2)), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode('Cantidad en letra:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(150, self::entrelineado, utf8_decode(ucfirst(convertirLetras($monto_total))), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano - 0.5);
        $this->Cell(100, self::entrelineado, utf8_decode('Porcentaje del costo de la carrera, que será financiado:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(17.5, self::entrelineado, utf8_decode($porcentaje_costo . '%'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(46, self::entrelineado, utf8_decode('Costo Anual Total (CAT)'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(21.5, self::entrelineado, utf8_decode($cat . '% (*1)'), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(39, self::entrelineado, utf8_decode('Tipo de moneda:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode('Moneda Nacional'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(46, self::entrelineado, utf8_decode('Plazo del crédito:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(60, self::entrelineado, utf8_decode($plazo . ' meses'), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode('Periodo de disposición:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(42.5, self::entrelineado, utf8_decode($periodo_disposicion . ' meses'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode('Vigencia del contrato:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(42.5, self::entrelineado, utf8_decode($vigencia_contrato . ' meses'), 1, 0, 'L');
        $this->Ln();

        /*
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(90, self::entrelineado, utf8_decode('Monto total a pagar en cada mensualidad:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(95, self::entrelineado, utf8_decode('$ ' . $monto_total_mensual), 1, 0, 'L');         
         */
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano - 2);
        $this->Cell(185, self::entrelineado, utf8_decode('La cantidad a pagar en cada mensualidad dependerá del Plan de Estudios de la carrera, como a continuación se cita:'), 1, 0, 'L');
        $this->Ln();
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, utf8_decode('A'), 1);
        $this->Cell(65, self::entrelineado, utf8_decode('Plan de estudios semestral:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(65, self::entrelineado, utf8_decode('Monto a pagar en cada mensualidad'), 1, 0, 'L');        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(45, self::entrelineado, utf8_decode($cantidad['semestral']), 1, 0, 'L');
        $this->Ln();        

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, utf8_decode('B'), 1);
        $this->Cell(65, self::entrelineado, utf8_decode('Plan de estudios Cuatrimestral:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(65, self::entrelineado, utf8_decode('Monto a pagar en cada mensualidad'), 1, 0, 'L');        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(45, self::entrelineado, utf8_decode($cantidad['cuatrimestral']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano );
        $this->Cell(10, self::entrelineado, utf8_decode('C'), 1);
        $this->Cell(65, self::entrelineado, utf8_decode('Plan de estudios trimestral:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(65, self::entrelineado, utf8_decode('Monto a pagar en cada mensualidad'), 1, 0, 'L');        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(45, self::entrelineado, utf8_decode($cantidad['trimestral']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(75, self::entrelineado, utf8_decode('Tasa de interés Ordinaria Anual (fija):'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(37.5, self::entrelineado, utf8_decode($tasa_interes . '%'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode('Tasa moratoria:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(37.5, self::entrelineado, utf8_decode($tasa_moratoria . '%'), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(60, self::entrelineado, utf8_decode('Fecha límite de pago y corte:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano - 1);
        $this->Cell(125, self::entrelineado, utf8_decode('Mensualmente los días 5 de cada mes, conforme a la Tabla de Amortización.'), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(45, self::entrelineado, utf8_decode('Referencia para pago:'), 1, 0, 'L');
        $this->Cell(15, self::entrelineado, utf8_decode('Banco:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(45, self::entrelineado, utf8_decode('BBVA, BANCOMER'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode('Convenico CIE:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(45, self::entrelineado, utf8_decode($convenio_cie), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode('Referencia:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode($referencia), 1, 0, 'L');
        $this->Ln();

        $this->MultiCell(185, self::entrelineado, utf8_decode('(*1) El CAT es calculado sin IVA, para fines informativos '.
                'y de comparación (calculado sobre plan de estudios completo).'), 0, 'J');
        $this->MultiCell(185, self::entrelineado, utf8_decode('(*2) Para el caso de que el Plan de Estudios elegido sea de '.
                'forma Semestral, el acreditado pagará adicionalmente a la cuota mensual fija, en la misma fecha de pago, '.
                'el equivalente al 50% de dicha cuota, en cada reinscripción a cada Semestre del Plan de Estudios.'), 0, 'J');        
        $this->Cell(185, self::entrelineado, utf8_decode('(*3) Los intereses se calcularán cada periodo sobre el saldo '.
                'insoluto decreciente del monto del préstamo.'), 0, 0, 'L');
        $this->Ln(self::un_renglon);
        // ############################# DATOS GENERALES DEL CRÉDITO (FIN) #############################
        // ############################# CUOTAS QUE SE DEBERÁN PAGAR(INICIO) #############################
        ////$this->Rect(15, 121, 185, 5, 'DF');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('VI. Cuotas y Comisiones que se deberán pagar.-'), 1, 0, 'L', 1);
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->MultiCell(185, self::entrelineado, utf8_decode('1) Al inicio del "Crédito",  el Acreditado pagará a FINEM por '.
                'una sola vez la siguiente Cuota de Inscripción (*4):'), 1, 'J');

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano );
        $this->Cell(10, self::entrelineado, utf8_decode('A'), 1);
        $this->Cell(65, self::entrelineado, utf8_decode('Plan de estudios semestral:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(70, self::entrelineado, utf8_decode('Monto a pagar por cuota de inscripción'), 1, 0, 'L');        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode($cantidadx['semestral']), 1, 0, 'L');
        $this->Ln();               

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, utf8_decode('B'), 1);
        $this->Cell(65, self::entrelineado, utf8_decode('Plan de estudios Cuatrimestral:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(70, self::entrelineado, utf8_decode('Monto a pagar por cuota de inscripción'), 1, 0, 'L');        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode($cantidadx['cuatrimestral']), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, utf8_decode('C'), 1);
        $this->Cell(65, self::entrelineado, utf8_decode('Plan de estudios trimestral:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(70, self::entrelineado, utf8_decode('Monto a pagar por cuota de inscripción'), 1, 0, 'L');        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode($cantidadx['trimestral']), 1, 0, 'L');
        $this->Ln(); 

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->MultiCell(185, self::entrelineado, utf8_decode('2. En caso de retraso en el pago total o parcial del "Crédito", ' .
                        'conforme al Calendario de Pago, el Acreditado pagará la Comisión por Pago Tardío, por cada mes en el que registre ' .
                        'un retraso en el pago del crédito, de: $100.00'), 1, 'J');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->MultiCell(185, self::entrelineado, utf8_decode('(*4) La Cuota de Inscripción se pagará a la cuenta bancaria '.
                'de "FINEM", con la referencia "Cuota de Inscripción".'), 0, 'J');
        $this->Ln();
        // ############################# CUOTAS QUE SE DEBERÁN PAGAR(FIN) #############################
        // ############################# SEGURO DE VIDA(INICIO) #############################
        ////$this->Rect(15, 181, 185, 5, 'DF');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('VII. Seguro de vida.-'), 1, 0, 'L', 1);
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(80, self::entrelineado, utf8_decode('Compañía de seguros:'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(105, self::entrelineado, utf8_decode('Axa Seguros, S.A. de C.V. '), 1, 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(80, self::entrelineado, utf8_decode('Págian de Internet'), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(105, self::entrelineado, utf8_decode('http://www.axa.mx (*5)'), 1, 0, 'L', 0);
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('(*5) Para la consulta de términos, condiciones y qué hacer en caso de siniestro'), 0, 0, 'L');
        $this->Ln(self::un_renglon);
        // ############################# SEGURO DE VIDA(FIN) #############################
        // ############################# ADVERTENCIAS(INICIO) #############################		
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('VIII. Advertencias.-'), 1, 0, 'L', TRUE);
        $this->Ln();

        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('- La presente carátula es parte integrante del Contrato de Crédito'), 'LR', 0, 'L');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('- Incumplir tus obligaciones te puede generar comisiones e intereses moratorios.'), 'LR', 0, 'L');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('- Contratar créditos por arriba de tu capacidad de pago puede afectar tu historial crediticio.'), 'LR', 0, 'L');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('- El (Los) Obligado(s) Solidario(s) y Aval(es),  responderá(n) como obligado principal frente a "FINEM".'), 'LRB', 0, 'L');
        $this->Ln(self::un_renglon);
        // ############################# ADVERTENCIAS(FIN) #############################
        // ############################# ADVERTENCIAS(INICIO) #############################		
        $this->MultiCell(185, self::entrelineado, utf8_decode('Se suscribe en 2 (dos) tantos la presente Carátula del Contrato de Crédito en la Ciudad de '.$info['contrato']['lugar_firma'].', ' .
                        'el día '.$fecha_firma.', y se entrega un tanto a "EL ACREDITADO" junto con un ejemplar del Contrato de Crédito, quien manifiesta haber recibido ' .
                        'a su entera satisfacción, asimismo las Partes contratantes, manifiestan que su voluntad ha sido libremente expresada y que su consentimiento no ' .
                        'se encuentra viciado por dolo, error, mala fe y en constancia de lo anterior, estampan sus firmas.'), 0, 'J');
        $this->Ln(self::un_renglon);
        // ############################# ADVERTENCIAS(FIN) #############################        
    }
    
    public function firmas() {
        
        $tmp = $this->get_nombre('alumno');
        $nombre_alumno = ( $tmp == '  ') ? '>>>>>>>>>>>>>>' : $tmp;
        $conyuge_alu = ($this->get_nombre('conyuge_alu') == '') ? '>>>>>>>>>>>>>>' : $this->get_nombre('conyuge_alu');
        $tmp = $this->get_nombre('aval1');
        $aval1 = ($tmp == '  ') ? '>>>>>>>>>>>>>>' : $tmp;
        $conyuge_aval1 = ($this->get_nombre('conyuge_aval1') == '') ? '>>>>>>>>>>>>>>' : $this->get_nombre('conyuge_aval1');
        $tmp = $this->get_nombre('aval2');
        $aval2 = ($tmp == '  ') ? '>>>>>>>>>>>>>>' : ($tmp);
        $conyuge_aval2 = ($this->get_nombre('conyuge_aval2') == '') ? '>>>>>>>>>>>>>>' : $this->get_nombre('conyuge_aval2');
        
        // ############################# FIRMAS(INICIO) #############################		
        $this->Cell(185, self::entrelineado, '');
        $this->Ln(20);
        $this->Cell(185, self::entrelineado, '');
        $this->Ln();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode($nombre_alumno), 'T', 0, 'C');
        $this->Cell(25, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode($conyuge_alu), 'T', 0, 'C');
        $this->Cell(10, self::entrelineado, '');
        $this->Ln();
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(10, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode('"EL ACREDITADO"'), 0, 0, 'C');
        $this->Cell(25, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode('SU CONYUGE'), 0, 0, 'C');
        $this->Cell(10, self::entrelineado, '');
        $this->Ln(self::un_renglon + 10);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode($aval1), 'T', 0, 'C');
        $this->Cell(25, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode($conyuge_aval1), 'T', 0, 'C');
        $this->Cell(10, self::entrelineado, '');
        $this->Ln();
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(10, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode('"EL OBLIGADO SOLIDARIO Y AVAL"'), 0, 0, 'C');
        $this->Cell(25, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode('SU CONYUGE'), 0, 0, 'C');
        $this->Cell(10, self::entrelineado, '');
        $this->Ln(self::un_renglon + 10);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode($aval2), 'T', 0, 'C');
        $this->Cell(25, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode($conyuge_aval2), 'T', 0, 'C');
        $this->Cell(10, self::entrelineado, '');
        $this->Ln();
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(10, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode('"EL OBLIGADO SOLIDARIO Y AVAL"'), 0, 0, 'C');
        $this->Cell(25, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode('SU CONYUGE'), 0, 0, 'C');
        $this->Cell(10, self::entrelineado, '');
        $this->Ln();
        $this->Ln(self::un_renglon + 5);
        // ############################# FIRMAS(FIN) #############################
    }

    public function machote() {
        
        $parrafo[0] = 'CONTRATO DE APERTURA DE CRÉDITO SIMPLE QUE CELEBRAN DE UNA PARTE FINANCIERA EDUCATIVA DE MÉXICO, S.A. DE C.V., SOFOM, E.N.R. A QUIEN EN LO SUCESIVO SE DENOMINARÁ COMO "FINEM", Y POR LA OTRA PARTE, POR SU PROPIO DERECHO LA PERSONA CUYO NOMBRE Y FIRMA APARECE EN LA CARÁTULA DEL PRESENTE CONTRATO, A QUIEN EN LO SUCESIVO SE DENOMINARÁ COMO "EL ACREDITADO", POR OTRA PARTE EN SU CARACTER DE OBLIGADO SOLIDARIO Y AVAL, LA(S) PERSONA(S) CUYO(S) NOMBRE(S) Y FIRMA(S) APARECE(N) EN LA CARÁTULA DEL PRESENTE CONTRATO, A QUIEN(ES) EN LO SUCESIVO SE LE(S) DENOMINARÁ EN CONJUNTO COMO "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS.';
        $letra[0] = array('tipo' => 'B', 'size' => self::letra_tamano, 'alineado' => '');

        $parrafo[1] = 'DECLARACIONES';
        $letra[1] = array('tipo' => 'B', 'size' => self::letra_tamano, 'alineado' => 'center');

        $parrafo[2] = 'I.-  Declara "FINEM" por conducto de su representante legal, que: ';

        $parrafo[3] = 'a.	Su representada se constituyó como Sociedad Anónima el 2 de diciembre de 2004, mediante la escritura pública número 21,162, otorgada ante la fe del licenciado Roberto Garzón Jiménez, titular de la Notaría 242 del Distrito Federal, actuando como asociado en el protocolo de la notaría número 229 del Distrito Federal cuyo primer testimonio está debidamente inscrito en el Registro Público del Comercio, Folio Mercantil número 337,427, de fecha 12 de septiembre de 2005.';

        $parrafo[4] = 'b.	Posteriormente, se transformó a Sociedad Financiera de Objeto Limitado mediante escritura pública número 24,604 de fecha 19 de mayo de 2005, otorgada ante la fe del licenciado Roberto Garzón Jiménez, titular de la Notaría 242 del Distrito Federal, actuando como asociado en el protocolo de la notaría número 229 del Distrito Federal cuyo primer testimonio está debidamente inscrito en el Registro Público de Comercio del Distrito Federal en el Folio Mercantil número 337,427, de fecha 24 de febrero de 2006, previa autorización otorgada por la Secretaría de Hacienda y Crédito Público mediante oficio número 101.-213.';

        $parrafo[5] = 'c.	Mediante la escritura número 62,337 de fecha cuatro de junio de 2013, otorgada ante la fe del Lic. Marco Antonio Ruiz Aguirre, titular de la notaría número 229 del Distrito Federal, se hizo constar el cambio en la modalidad de "FINEM" de "SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE, SOCIEDAD FINANCIERA DE OBJETO LIMITADO" a "SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE, SOCIEDAD FINANCIERA DE OBJETO MÚLTIPLE, ENTIDAD NO REGULADA", cuyo primer testimonio se encuentra inscrito en el registro Público de la Propiedad y de Comercio de la Ciudad de México, Distrito Federal, bajo el Folio Mercantil número 337427 de fecha 8 de julio de 2013.';

        $parrafo[6] = 'd.	Las facultades con que comparece su representante son bastantes y suficientes para obligarlo en los términos de este Contrato, las cuales se hacen constar en la escritura número 63,181 de fecha 15 de julio de 2013, otorgada ante la fe del Licenciado Marco Antonio Ruiz Aguirre titular de la notaría número 229 del Distrito Federal, mismas facultades que no le han sido revocadas, limitadas o modificadas en forma alguna a la fecha de firma de este Contrato.';
        $parrafo[7] = 'e.	Tiene capacidad legal, conforme a su objeto social, para otorgar el presente crédito en relación con programas que califiquen dentro de los programas de apoyo a educación continúa. ';
        $parrafo[8] = 'f.	La denominación actual es FINANCIERA EDUCATIVA DE MÉXICO, S.A. DE C.V. SOFOM, E.N.R. y señala como su domicilio legal el ubicado en Bosque de Ciruelos, número 160, piso 7, colonia Bosques de las Lomas, Código Postal 11700, Ciudad de México, Distrito Federal, página de internet: www.finem.com.mx';
        $parrafo[9] = 'g.	Con base en las declaraciones y documentación entregada por "EL ACREDITADO" y por "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" mediante la cual se realizó el estudio de crédito, está dispuesto en celebrar el presente contrato de apertura de Crédito, siendo éste el motivo determinante de su voluntad para otorgar el crédito, en los términos y bajo las condiciones establecidas en el mismo. ';
        $parrafo[10] = 'h.	Para el desarrollo y cumplimiento de su objeto social, recibe o puede recibir recursos de diversas instituciones financieras nacionales o extranjeras, pudiendo otorgar a las mismas en garantía prendaria los derechos de cobro a su favor derivados del presente contrato. ';
        $parrafo[11] = 'i.	La Carátula del presente Contrato, que también se firma en este acto, forma parte integrante del mismo.';
        $parrafo[12] = 'II.- Declara "EL ACREDITADO" por su propio derecho y bajo protesta de decir verdad que:';
        $parrafo[13] = 'a.	Es una persona física, mayor de edad, estar en pleno uso de sus facultades y tener capacidad suficiente para obligarse en términos del presente contrato; con los datos generales que se señalan en Carátula del presente Contrato';
        $parrafo[14] = 'b.	Es su deseo cursar la Carrera y/o Posgrado y por el periodo precisados en Carátula del presente Contrato, en lo sucesivo el "Plan de Estudios".';
        $parrafo[15] = 'c.	Ha solicitado a "FINEM" el otorgamiento de un crédito para el pago de hasta del porcentaje que se menciona en la Carátula del presente Contrato, de las cuotas por colegiaturas e inscripciones que corresponden a cada uno de los ciclos del Plan de Estudios, incluidos los Talleres de Desarrollo de Habilidades Profesionales y las materias de inglés, los accesorios del propio "CRÉDITO", así como cualquier otro concepto relacionado que convengan las Partes, sin exceder de la cantidad referida en la Cláusula Primera del presente contrato.';
        $parrafo[16] = 'd.	Previo a la suscripción del presente contrato, "FINEM" hizo de su conocimiento el contenido del contrato, de los cargos, comisiones y/o gastos que se generarán por la celebración del mismo, así como del Costo Anual Total (CAT) correspondiente al crédito materia del presente contrato, el cual para fines informativos y de comparación exclusivamente, se precisa en la Carátula del presente Contrato. ';
        $parrafo[17] = 'e.	Señala como domicilio para todos los efectos del presente contrato, el precisado en Carátula del presente Contrato.';
        $parrafo[18] = 'f.	La documentación e información proporcionada a "FINEM" y con base en la cual se realizó el estudio de crédito, es verdadera y refleja en forma exacta y fiel su situación económica y la de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", reconociendo expresamente que es la veracidad de dicha información, el motivo determinante de la voluntad de "FINEM" para otorgar el crédito.';
        $parrafo[19] = 'III.- Declara(n) "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" por su propio derecho y bajo protesta de decir verdad que:';
        $parrafo[20] = 'a.	Es (son) persona(s) física(s) mayor(es) de edad, con plena capacidad jurídica de goce y ejercicio para obligarse en los términos del presente contrato, sin que la misma le(s) haya sido limitada en forma alguna, con los datos generales que se señalan en Carátula del presente Contrato, identificándose en este acto con el documento descrito en la citada Carátula.';
        $parrafo[21] = 'b.	Es su deseo suscribir el presente contrato constituyéndose en "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" de todas y cada una de las obligaciones a cargo de "EL ACREDITADO" a favor de "FINEM" emanadas del presente contrato';
        $parrafo[22] = 'c.	La documentación e información proporcionada a "FINEM" y con base en la cual se realizó el estudio de crédito, es verdadera y refleja en forma exacta y fiel su situación económica, reconociendo expresamente que es la veracidad de dicha información, el motivo determinante de la voluntad de "FINEM" para otorgar el crédito a "EL ACREDITADO".';
        $parrafo[23] = 'd.	Estima(n) suficiente el valor de sus bienes para responder de las obligaciones que adquiere en los términos del presente instrumento. ';
        $parrafo[24] = 'e.	Conoce(n) y entiende(n) el contenido y los alcances del presente instrumento jurídico, manifestando libremente voluntad para obligarse en los términos del mismo.';
        $parrafo[25] = 'f.	Señala(n) domicilio para todos los efectos del presente contrato, el precisado en la Carátula del presente Contrato.';
        $parrafo[26] = 'En virtud de las declaraciones anteriores, de la información y de la documentación proporcionada por "EL ACREDITADO" y por "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", las Partes están de acuerdo en celebrar el presente Contrato en términos de las siguientes:';
        $parrafo[27] = 'C L Á U S U L A S';
        $letra[0] = array('tipo' => 'B', 'size' => self::letra_tamano);

        $parrafo[28] = 'PRIMERA.- APERTURA DEL CRÉDITO. "FINEM" otorga un Crédito Simple a "EL ACREDITADO" denominado en Moneda Nacional, que no deberá exceder de la cantidad que se precisa en Carátula del presente Contrato, en lo sucesivo referido como el "CRÉDITO".';
        $parrafo[29] = 'En dicho "CRÉDITO" no quedan incluidos los intereses, impuestos, y demás gastos que deba pagar  "EL ACREDITADO" con motivo del presente financiamiento.';
        $parrafo[30] = 'De conformidad con el artículo 293 de la Ley General de Títulos y Operaciones de Crédito "FINEM" está facultado para fijar el límite del importe del "CRÉDITO" en cualquier tiempo. Asimismo, las Partes facultan a "FINEM" para que en caso de faltar recursos para que el "EL ACREDITADO" pueda concluir el "Plan de Estudios", esta pueda ampliar la línea de crédito, referida en la presente cláusula. Lo anterior sujeto al cumplimiento total y oportuno de todas y cada una de las obligaciones a cargo de "EL ACREDITADO" establecidas en el presente contrato y en especial con las obligaciones de pago a su cargo.  ';
        $parrafo[31] = 'SEGUNDA.- DISPOSICIÓN Y DESTINO DEL CRÉDITO. "EL ACREDITADO" dispondrá de los recursos del "CRÉDITO", en varias disposiciones durante el plazo citado en la Carátula del presente Contrato, para cubrir hasta el porcentaje que se menciona en la citada Carátula, de las cuotas por colegiaturas e inscripciones que corresponden a cada uno de los ciclos del Plan de Estudios, incluidos los Talleres de Desarrollo de Habilidades Profesionales y las materias de inglés, los accesorios del propio "CRÉDITO", así como cualquier otro concepto relacionado que convengan las Partes, sin exceder de la cantidad referida en la Cláusula Primera del presente contrato.';
        $parrafo[32] = 'En este acto  "EL ACREDITADO" instruye expresa e irrevocablemente a "FINEM", para que en su nombre y representación deposite los recursos en la cuenta que la Universidad que corresponda y que al efecto se señale, con el objeto de liquidar a ésta última la colegiatura o la diferencia que exista en el costo de sus colegiaturas correspondientes a cada ciclo escolar.';
        $parrafo[33] = 'TERCERA.- COMPROBANTES DE DISPOSICIÓN. "EL ACREDITADO" suscribirá a favor de "FINEM" un Pagaré por cada una de las disposiciones que se realicen del "CRÉDITO", o en su caso de reexpedirá un nuevo pagaré por la cantidad que conrresponda al saldo insoluto pendiente de pago más el monto de la nueva disposición. Dichos títulos de credito serán por avalados por "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", cuya forma de pago se precisará en cada título de crédito, sin que en plazo de pago exceda del plazo fijado en la Cláusula Décima Primera de este Contrato.';
        $parrafo[34] = 'La disposición del "CRÉDITO" se comprobará mediante: (i) la suscripción de los Pagarés en favor de "FINEM" por cada uno de los importes que éste haya otorgado; (ii) los estados de la Cuenta bancaria que demuestren los depósitos que haya realizado "FINEM" en términos de la cláusula anterior; y (iii) mediante los asientos contables del crédito que realice "FINEM"; por lo que cualquiera de los elementos antes mencionados, individual o conjuntamente, harán prueba plena de la disposición del "CRÉDITO" por parte de  "EL ACREDITADO".';
        $parrafo[35] = 'CUARTA.- AMORTIZACIÓN DEL CRÉDITO. "EL ACREDITADO" se obliga a restituir a "FINEM" el importe del "CRÉDITO" en forma mensual, precisamente en las fechas límites de pago y por las cantidades que se detallan el Calendario de Pagos, más la cuotas de inscripción que correspondan, así como cualquier otro adeudo derivado como consecuencia de lo que se estipula en este Contrato.';
        $parrafo[36] = 'QUINTA.- INTERESES. El cálculo de los intereses ordinarios y moratorios se efectuará utilizando el procedimiento de meses de días naturales transcurridos, con divisor 360 (TRESCIENTOS SESENTA). Lo anterior, en la inteligencia de que el cálculo se lleve a cabo mensualmente, multiplicando el promedio ponderado diario del saldo insoluto del "CRÉDITO" por la Tasa pactada, dividiendo el resultado así obtenido entre 360 (TRESCIENTOS SESENTA DÍAS) y multiplicando por el número de días naturales de cada Periodo de Cálculo de Intereses. ';
        $parrafo[37] = 'Las tasas de intereses ordinarios y moratorios que causará el financiamiento, son las siguientes:';
        $parrafo[38] = 'a)	Intereses Ordinarios.- El "CRÉDITO" causará intereses ordinarios sobre saldos insolutos de capital vigente, a la tasa fija precisada en la Carátula del presente Contrato. Los intereses se calcularán mensualmente desde la fecha de disposición de los recursos y hasta su vencimiento, y serán pagaderos mensualmente a partir del mes de calendario siguiente a aquel en que se haya ejercido la disposición y hasta la liquidación del saldo insoluto del "CRÉDITO".';
        $parrafo[39] = 'b)	Intereses Moratorios.  "EL ACREDITADO" reconoce expresa e irrevocablemente que en caso de mora en el pago puntual y total de las cantidades adeudadas por virtud de este "CRÉDITO", la cantidad de capital no pagada devengará intereses moratorios desde la fecha de su vencimiento y hasta el día en que quede totalmente pagada, pagaderos a la vista, a la tasa anual que resulte de multiplicar por 2 (DOS) por la Tasa pactada para los intereses ordinarios.';
        $parrafo[40] = 'En el evento de que la fecha de vencimiento de algún pago derivado de este Contrato resultare no ser Día Hábil, "EL ACREDITADO" deberá realizar dicho pago el Día Hábil inmediato posterior al vencimiento sin cargo alguno.';
        $parrafo[41] = 'SEXTA.- PAGOS ANTICIPADOS Y APLICACIÓN DE REEMBOLSOS. "EL ACREDITADO" podrá pagar el importe del "CRÉDITO" antes de su vencimiento, parcial o totalmente, mediante solicitud expresa y por escrito, que deberá presentarse en el domicilio señalado por "FINEM"; una vez recibida dicha solicitud y a más tardar en un plazo de 5 (CINCO) días hábiles, "FINEM" informará a "EL ACREDITADO" el saldo restante del "CRÉDITO", el cual deberá ser liquidado en las próximas 24 (VEINTICUATRO) horas; dichos pagos serán aplicados por "FINEM" en el orden siguiente: (1) impuestos y gastos, (2) comisiones, (3) intereses moratorios, (4) intereses ordinarios vencidos, (5) saldo insoluto vencido del "CRÉDITO", (6) intereses ordinarios devengados, (7) saldo insoluto del "CRÉDITO" aplicándose en orden inverso al de su vencimiento. Una vez cubiertos los adeudos mencionados, le será entregado un estado de cuenta que refleje que no se adeuda cantidad alguna, con lo cual las partes acuerdan que se da por terminada la relación contractual. "EL ACREDITADO" no podrá volver a disponer de las cantidades pagadas anticipadamente.';
        $parrafo[42] = '"EL ACREDITADO" expresamente acepta y conviene con "FINEM" que, cualquier devolución o reembolso que la Universidad que corresponda, derivado del otorgamiento o ampliación de becas, baja de materias, descuentos, promociones o cualquier otro concepto, el importe que corresponda como devolución sea aplicado al pago de su crédito de conformidad con lo previsto en el párrafo anterior.';
        $parrafo[43] = 'A la terminación normal o anticipada del presente contrato y sólo en el caso de que "EL ACREDITADO" tenga un saldo a su favor, "FINEM" se obliga a devolverle íntegramente dicho saldo, más los accesorios que en su caso se hubieren generado.';
        $parrafo[44] = 'SÉPTIMA.- LUGAR Y FORMA DE PAGO DEL CRÉDITO. Todas las cantidades pagaderas por  "EL ACREDITADO" a "FINEM" de conformidad con el presente Contrato y los Pagarés que deriven del mismo, serán pagadas en Moneda Nacional, en la fecha de su vencimiento y sin necesidad de previo requerimiento, mediante depósito en la cuenta bancaria que "FINEM" le indique o en cualquier otra forma que "FINEM" determine notificando por escrito a "EL ACREDITADO" con por lo menos 15 (quince) días naturales anteriores a la fecha del pago siguiente.';
        $parrafo[45] = 'El pago de las cantidades que  "EL ACREDITADO" entregue a "FINEM" serán acreditadas de acuerdo al medio de pago que se utilice, de la manera siguiente:';
        $parrafo[46] = 'AQUI VA UNA TABLA';
        $parrafo[47] = 'Para efectos del presente contrato, existirá incumplimiento de parte de  "EL ACREDITADO", debiendo pagar a "FINEM" los intereses moratorios que se generen, en los siguientes casos:';
        $parrafo[48] = 'a)	Si habiendo efectuado el pago de alguna obligación a su cargo, no hubiere sido acreditada por "FINEM" a más tardar en la fecha de vencimiento de la misma por no haber realizado el pago con la antelación suficiente en términos de la presente cláusula. ';
        $parrafo[49] = 'b)	En el caso de devolución de cheques no pagados, debiendo "EL ACREDITADO" pagar a "FINEM", adicionalmente a los conceptos antes señalados, la comisión por devolución de cheques no pagados a que se refiere la cláusula inmediata siguiente del presente instrumento.';
        $parrafo[50] = 'OCTAVA.- COMISIONES. Durante la vigencia del presente contrato "EL ACREDITADO" y/o "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" se obligan a pagar a "FINEM", por concepto de cuotas y comisiones lo siguientes: ';
        $parrafo[51] = 'a)	En caso de devolución de un cheque, cuando el mismo hay sido entregado a "FINEM" para pago del presente "CRÉDITO",  "EL ACREDITADO" se obliga pagar a "FINEM" una cantidad hasta del 20% (VEINTE POR CIENTO) del importe del cheque devuelto.';
        $parrafo[52] = 'b)	En caso de retraso en el pago total o parcial del "CRÉDITO" conforme al Calendario de Pago, "EL ACREDITADO" se obliga a pagar a "FINEM" una Comisión por Pago Tardío de $100.00 (CIEN PESOS 00/100, MONEDA NACIONAL) por cada mes, en el que registre un saldo vencido pendiente de pago.';
        $parrafo[53] = 'c)	Solo para el caso de que el Plan de Estudios de la Licenciatura, Especialidad o Maestría a cursar sea de forma Semestral, "EL ACREDITADO" pagará adicionalmente a la cuota mensual fija, en la misma fecha de pago, el equivalente al 50% (CINCUENTA POR CIENTO) de dicha cuota, en cada reinscripción a cada Semestre del Plan de Estudios.';
        //$parrafo[53] = 'NOVENA.- CUOTA DE REINSCRIPCIÓN. Durante la vigencia del presente contrato "EL ACREDITADO" y/o "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" se obligan a pagar a "FINEM" por cada disposición que realice "EL ACREDITADO" del "CRÉDITO", una Cuota de Reinscripción, cuyo porcentaje se precisa en la Carátula del presente Contrato, la cual será pagada mediante depósito a cuenta bancaria de "FINEM", con la referencia "Cuota de Reinscripción".';
        //$parrafo[54] = 'Un porcentaje de la referida "Cuota de Reinscripción", será destinada de para el pago de capital del presente "CRÉDITO", el cual puede ser de un 50% (CINCUENTA POR CIENTO) a hasta un 72% (SETENTA Y DOS POR CIENTO) de la "Cuota de Reinscripción", dependiendo el plan de estudio que curse "EL ACREDITADO".';
        $parrafo[54] = 'NOVENA.- CUOTA DE INSCRIPCIÓN. Al inicio del presente contrato y previo a la primer disposición del "CRÉDITO", "EL ACREDITADO" y/o "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" se obligan a pagar a "FINEM", por una sola vez la "Cuota de Inscripción", la cual será determinada en función Plan de Estudios de la Carrera o Especialidad a cursar, cuyo monto se precisa en Carátula del presente Contrato.';
        $parrafo[55] = 'DÉCIMA.- OBLIGACIONES DE "EL ACREDITADO". Salvo que "FINEM" consienta por escrito en algo distinto, mientras las cantidades debidas por "EL ACREDITADO" a "FINEM" en virtud del presente Contrato no queden totalmente pagadas, "EL ACREDITADO" conviene con "FINEM" en lo siguiente:';
        $parrafo[56] = 'a)	Cumplir con todas las obligaciones a su cargo establecidas en este Contrato.';
        $parrafo[57] = 'b)	Cumplir o hacer que el alumno cumpla con lo establecido por el "PLAN DE ESTUDIOS" de la Universidad que corresponda, manteniendo un promedio general igual o superior en todo momento de 7.5 (siete punto cinco).';
        $parrafo[58] = 'c)	No reprobar más de dos materias en cada ciclo escolar.';
        $parrafo[59] = 'd)	Cursar todas las materias correspondientes a cada ciclo escolar.';
        $parrafo[60] = 'e)	Notificar con anticipación de 15 días naturales a que ocurra el hecho, cualquier cambio de domicilio, ya sea de  "EL ACREDITADO" y/o de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", realizando dicha notificación por escrito en el domicilio de "FINEM".';
        $parrafo[61] = 'f)	Cumplir con el reglamento de la Universidad que corresponda y a no obtener una suspensión definitiva o expulsión del ciclo escolar, durante la vigencia del presente contrato.';
        $parrafo[62] = 'g)	Proporcionar a "FINEM" los informes y documentación que éstas sociedades le requieran en la forma y términos en que le sean solicitados.';
        $parrafo[63] = 'h)	Asegurar que sus obligaciones bajo el presente Contrato, así como el Pagaré(s) que al efecto se suscriban, constituyan en todo momento obligaciones directas y no subordinadas de  "EL ACREDITADO" y que tengan una prelación de pago, al menos en la misma proporción respecto al pago de cualesquiera otras obligaciones futuras, directas no garantizadas y subordinadas de  "EL ACREDITADO", derivadas de cualquier pasivo a su respectivo cargo.';
        $parrafo[64] = 'i)	A no subordinar el cumplimiento de las obligaciones de pago de este Contrato al cumplimiento de cualquier otra obligación;';
        $parrafo[65] = 'j)	A no llevar a cabo cualquier acto que afecte o pueda afectar adversamente el cumplimiento de las obligaciones derivadas del presente Contrato.';
        $parrafo[66] = 'DÉCIMA PRIMERA.- CAUSAS DE TERMINACIÓN DEL CONTRATO Y VENCIMIENTO ANTICIPADO DEL PLAZO. "EL ACREDITADO" reconoce y acepta expresamente que la celebración del presente Contrato y el otorgamiento del "CRÉDITO" por parte de "FINEM", se basa entre otros factores, en la obligación que adquiere "EL ACREDITADO" de cumplir con todas y cada una de las obligaciones asumidas en virtud de la celebración del presente Contrato, por lo que está de acuerdo en que el incumplimiento de dichas obligaciones, será causa suficiente para que "FINEM" esté facultado para dar por vencido anticipadamente el plazo para el pago de el "CRÉDITO" y sus accesorios, y exigir a  "EL ACREDITADO" y/o a "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" el pago anticipado inmediato de todas las sumas que éste le adeudare, mediante simple declaración por escrito a "EL ACREDITADO".';
        $parrafo[67] = 'En virtud de lo anterior, "FINEM" podrá dar por vencido anticipadamente el presente Contrato por el incumplimiento por parte de "EL ACREDITADO" y/o de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" de cualquiera de las obligaciones contenidas en el presente Contrato, así como por cualquiera de las siguientes Causas:';
        $parrafo[68] = 'a)	Si "EL ACREDITADO" no paga parcial o totalmente y en el plazo fijado, la suma principal del "CRÉDITO", los intereses y/o la cuota de reinscripción, así como cualquier otro adeudo derivado como consecuencia de lo que se estipula en este Contrato.';
        $parrafo[69] = 'b)	Si cualquier información proporcionada directamente a "FINEM" por "EL ACREDITADO" y/o por "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" en los términos del presente Contrato resultare falsa o dolosamente incorrecta o incompleta o si se impide la supervisión y/o verificación a que se refiere la Cláusula Vigésima Segunda de este Contrato.';
        $parrafo[70] = 'c)	Si los recursos del "CRÉDITO" se destinaren total o parcialmente a fines distintos a los estipulados en el presente Contrato.';
        $parrafo[71] = 'd)	Si se instituye un juicio o procedimiento por o en contra de "EL ACREDITADO" y/o de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" con el fin de declararlo en quiebra, o sujetarlo a Concurso Mercantil. ';
        $parrafo[72] = 'e)	Si la autoridad(es) competente decreta algún embargo en contra de cualquier bien o posesión de "EL ACREDITADO" y/o de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" y en opinión de "FINEM" afecte significativamente la capacidad de cumplir con las obligaciones estipuladas en este Contrato;';
        $parrafo[73] = 'f)	En los demás casos previstos por la Ley.';
        $parrafo[74] = 'DÉCIMA SEGUNDA.- VIGENCIA. El presente contrato estará vigente por el periodo comprendió desde su fecha de firma, hasta la terminación del último pago a cargo de "EL ACREDITADO", en términos de lo previsto en la Carátula del presente Contrato. ';
        $parrafo[75] = 'Para el caso de que se acuerde ampliar la línea de crédito, autorizada mediante el presente contrato, el plazo de vigencia del presente contrato será prorrogado por un periodo suficiente para que "EL ACREDITADO" pueda cumplir en tiempo y forma con las obligaciones establecidas en el presente contrato y en especial con sus obligaciones de pago a su cargo.';
        $parrafo[76] = 'DÉCIMA TERCERA.- CUMPLIMIENTO DE LAS OBLIGACIONES. En garantía del cumplimiento de todas y cada una de las obligaciones derivadas de este Contrato, sean por concepto de capital, intereses o de cualquier otra naturaleza y que tengan origen en este instrumento, incluyendo los gastos y costas en caso de juicio, "EL ACREDITADO" y/o "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" responderán en favor de "FINEM" con todo su patrimonio. ';
        $parrafo[77] = 'DÉCIMA CUARTA.- DE LA OBLIGACIÓN SOLIDARIA. "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" en este acto expresamente se obliga(n) solidariamente con "EL ACREDITADO", al pago y cumplimiento de todas las obligaciones a su cargo derivadas de este instrumento, respondiendo ilimitadamente por el pago del mismo con todos y cada uno de los bienes de su propiedad en términos de los artículos 1987, 1988, 1989, 1995, 2002 y demás aplicables del Código Civil para el Distrito Federal y sus correlativos de los Códigos Civiles de los demás Estados de la República mexicana.';
        $parrafo[78] = '"EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" se obliga(n), además, a notificar por escrito en el domicilio de  "FINEM", cualquiera de los siguientes hechos:';
        $parrafo[79] = 'a)	Cualquier cambio de domicilio, ya sea de "EL ACREDITADO" o de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" con anticipación de 15 días naturales a que ocurra el hecho';
        $parrafo[80] = 'b)	Cualquier gravamen, hipoteca, afectación, aviso preventivo, limitación de dominio o cualquiera otra inscripción en el Registro Público de la Propiedad correspondiente, relativa al bien inmueble declarado a "FINEM".';
        $parrafo[81] = 'c)	Cualquier enajenación respecto del inmueble declarado a "FINEM", debiendo sustituirlo por otro dentro de los 15 días naturales anteriores a la enajenación.';
        $parrafo[82] = 'DÉCIMA QUINTA.- SEGUROS. Desde este momento "EL ACREDITADO" autoriza e instruye expresa e irrevocablemente a "FINEM" a contratar en su nombre con institución de seguros autorizada y a satisfacción de "FINEM", así como a mantener en vigor por todo el plazo del contrato un seguro de vida e invalidez total y permanente por el importe del "CRÉDITO". La póliza contendrá un endoso irrevocable en beneficio de "FINEM", en primer lugar y sólo con el consentimiento previo y por escrito de "FINEM", podrá cancelarse o modificarse dicha póliza.';
        $parrafo[83] = 'La póliza de seguro respectiva, contratada por "FINEM" en nombre y por cuenta del "ACREDITADO" podrá consultarse sus términos, condiciones y qué hacer en caso de siniestro, en la Página de Internet de la Compañía aseguradora, la cual se precisa en la Carátula del presente contrato.';
        $parrafo[84] = 'En caso de fallecimiento de "EL ACREDITADO" y/o de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" el Cónyuge en caso de que existiere o cualquier familiar, deberá notificar por escrito y en la ventanilla de  "FINEM" de lo ocurrido, siendo esta última la encargada de dar el aviso correspondiente a la Compañía de Seguros, para hacer efectivo el pago del Seguro de Vida.';
        $parrafo[85] = 'DÉCIMA SEXTA.- ESTADOS DE CUENTA. "FINEM" pondrá a disposición de "EL ACREDITADO" en la ventanilla de "FINEM" dentro de los horarios que establezca esta última y de manera mensual un estado de cuenta que contenga un resumen de la siguiente información: (i) Número de crédito, (ii) Detalle de saldos vigentes y vencidos,  (iii) Importe  y fecha de su próximo pago, (iv) La tasa de interés aplicada, (v) Los pagos y  cargos por intereses ordinarios y moratorios, así como demás accesorios del periodo. Asimismo, "EL ACREDITADO" podrá consultar el estado de cuenta directamente en la ventanilla de "FINEM", previa identificación oficial. Si en el transcurso de 90 (NOVENTA) días naturales posteriores a la fecha de corte,  "EL ACREDITADO" no impugnare dicho Estado de Cuenta el mismo se dará por total y completamente aceptado.';
        $parrafo[86] = 'El hecho de que "EL ACREDITADO" no solicite la expedición o desconozca por cualquier causa los Estados de Cuenta no lo eximirá de su obligación de cumplir en tiempo y forma todas y cada una de las obligaciones a su cargo, emanadas y de conformidad con el presente contrato.';
        $parrafo[87] = '"EL ACREDITADO" podrá presentar solicitudes, aclaraciones, inconformidades y quejas, relacionados con la operación o servicio contratado, mediante aviso dirigido a la Unidad Especializada de Atención a Usuarios de "FINEM", ubicada en Bosque de Ciruelos, número 160, piso 7, Col. Bosques de las Lomas, Delegación Miguel Hidalgo, C.P. 11700, México Distrito Federal, o a través de la página de internet: www.finem.com.mx';
        $parrafo[88] = 'DÉCIMA SÉPTIMA.- INFORMACIÓN. "EL ACREDITADO" y "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" autorizan en este acto a "FINEM" a solicitar y proporcionar información respecto de su historial crediticio a los usuarios de las Sociedades de Información Crediticia, sean centrales de informes de crédito o cualquier otro dedicado a la investigación y otorgamiento de informes de crédito y para recabar información de la misma naturaleza sobre  "EL ACREDITADO" y "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", mediante el formato de autorización que designe "FINEM" para solicitar reportes de crédito.';
        $parrafo[89] = '"EL ACREDITADO" y "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" se obligan a proporcionar a "FINEM" toda la información que tenga relación con este contrato y que le sea requerida en el tiempo y forma solicitados y absorber los costos que los mismos pudieran generar.';
        $parrafo[90] = 'Salvo por lo dispuesto en el primer párrafo de la presente Cláusula, la información proporcionada y entregada por "EL ACREDITADO" y por "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", a "FINEM" no será utilizada o distribuida para fines mercadológicos, en términos de lo previsto en el Aviso de Privacidad de "FINEM".';
        $parrafo[91] = 'DÉCIMA OCTAVA.- NOTIFICACIONES. Para efectos del presente Contrato, cada una de las partes señala como su domicilio convencional para recibir toda clase de notificaciones, el mencionado en el apartado de declaraciones. ';
        $parrafo[92] = 'Mientras las partes no se notifiquen por escrito un cambio de domicilio, los avisos, notificaciones y demás diligencias judiciales y extrajudiciales que se hagan en los domicilios indicados, surtirán plenamente sus efectos.';
        $parrafo[93] = 'DÉCIMA NOVENA.- CESIÓN DE DERECHOS U OBLIGACIONES. "EL ACREDITADO" no podrá ceder sus derechos u obligaciones derivados de este contrato o del Pagaré sin el consentimiento de "FINEM".';
        $parrafo[94] = '"FINEM" queda facultado para negociar, descontar o de cualquier otra forma ceder el (los) Pagaré(s) y/o el Contrato y los derechos de crédito derivados del mismo, aún antes del vencimiento del presente Contrato. Por lo tanto "EL ACREDITADO" y "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" autorizan expresamente a "FINEM" para transmitir, ceder, endosar o negociar en cualquier forma, los pagarés mencionados en la cláusula TERCERA anterior, de conformidad con lo estipulado en el primer párrafo del artículo 299 de la Ley General de Títulos y Operaciones de Crédito. ';
        $parrafo[95] = 'VIGÉSIMA.- RENUNCIA DE DERECHOS. La omisión por parte de "FINEM" en el ejercicio de los derechos previstos en este Contrato en ningún caso tendrá el efecto de una renuncia de los mismos, ni el ejercicio singular o parcial por parte de "FINEM" de cualquier derecho derivado de este Contrato excluye algún otro derecho, facultad o privilegio.';
        $parrafo[96] = 'VIGÉSIMA PRIMERA.- MODIFICACIONES AL CONTRATO. Ninguna modificación o renuncia a disposición alguna de este Contrato y ningún consentimiento dado a  "EL ACREDITADO" para divergir del Contrato surtirá efectos, a menos que conste por escrito y se suscriba por "FINEM", por "EL ACREDITADO" y por "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)" y aún en dicho supuesto, tal renuncia o consentimiento tendrá efecto solamente en el caso y para el fin especifico para el cual fue otorgado.';
        $parrafo[97] = 'VIGÉSIMA SEGUNDA.- DENUNCIA. En los términos del artículo 294 de la Ley General de Títulos y Operaciones de Crédito, "FINEM" se reserva el derecho de restringir el Plazo de Disposición de EL CRÉDITO o el importe del mismo,  el importe de éste a la vez, mediante simple comunicación escrita dirigida a "EL ACREDITADO", quedando limitado o extinguido, según sea el caso, el derecho de  "EL ACREDITADO" para hacer uso del saldo no dispuesto de el "CRÉDITO", a partir de la fecha de dicha notificación por parte de "FINEM".';
        $parrafo[98] = 'VIGÉSIMA TERCERA.- DERECHOS DE SUPERVISIÓN DE "FINEM". "EL ACREDITADO" deberá permitir que "FINEM" realice en todo momento, ya sea en forma directa o por el representante que este designe, las verificaciones que considere necesarias, a su domicilio y se obliga en todo momento, a presentar la información de cualquier naturaleza que requiera "FINEM" durante la vigencia del presente contrato.';
        $parrafo[99] = 'VIGÉSIMA CUARTA. CERTIFICACIÓN.- El presente Contrato junto con la certificación del adeudo que haga el contador facultado por "FINEM", constituirán título ejecutivo en contra de "EL ACREDITADO" y/o de "EL(LOS) OBLIGADO(S) SOLIDARIO(S) Y AVAL(ES)", de conformidad con lo dispuesto por el Artículo 68 de la Ley de Instituciones de Crédito, pudiendo ejercitar sus acciones de Ley respectivas "FINEM", en la vía y forma que mejor convenga a sus intereses.';
        $parrafo[100] = 'VIGÉSIMA QUINTA.- DENOMINACIÓN DE LAS CLÁUSULAS. Las partes están de acuerdo en que las denominaciones utilizadas en las cláusulas del presente Contrato, son únicamente para efectos de referencia, por lo que no limitan de manera alguna el contenido y alcance de las mismas, debiendo en todos los casos estar a lo pactado por las partes en dichas cláusulas.';
        $parrafo[101] = 'VIGÉSIMA SEXTA.- LEYES APLICABLES Y JURISDICCIÓN. Para todo lo relativo a la interpretación y cumplimiento de las obligaciones derivadas del presente Contrato, las partes se someten a las leyes aplicables y a la jurisdicción y competencia de los tribunales competentes en la Ciudad de México o cualquier otra jurisdicción que el efecto decida "FINEM", renunciando expresamente las demás Partes a cualquier otro fuero al que tengan derecho o lleguen a tenerlo en virtud de su domicilio o por cualquier otra razón';
        $parrafo[102] = 'El presente Contrato se suscribe en 2 (dos) tantos en la Ciudad y en la fecha, referidas en la Carátula del presente Contrato y se entrega un tanto a "EL ACREDITADO", asimismo las Partes contratantes, manifiestan que su voluntad ha sido libremente expresada y que su consentimiento no se encuentra viciado por dolo, error, mala fe y en constancia de lo anterior, estampan sus firmas en la Carátula del presente Contrato.';

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        //$this->Cell(185, self::entrelineado, utf8_decode('NUMERO DE REGISTRO CONDUSEF: >>>>>>>'), 0, 0, 'R');
        $this->Ln(self::un_renglon);

        $this->escribe_texto($parrafo, $letra);
        $this->Ln(self::un_renglon + 5);
    }

    public function direcciones() {

        $this->Cell(185, self::entrelineado, utf8_decode('UNIDAD ESPECIALIZADA DE ATENCIÓN A'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('USUARIOS DE "FINEM".'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('Responsable.- Act. Francisco Maciel Morfin.'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('Domicilio: Bosque de Ciruelos, Número 160, Piso 7, Colonia Bosques de Las Lomas, CP. 11700, '), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('Ciudad de México, D.F.  Tel:  0155 3088 3830'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('www.finem.com.mx'), 0, 0, 'C');
        $this->Ln(self::un_renglon + 2);

        $this->Cell(185, self::entrelineado, utf8_decode('COMISIÓN NACIONAL PARA LA PROTECCIÓN Y'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('DEFENSA DE LOS USUARIOS DE SERVICIOS FINANCIEROS (CONDUSEF).'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('Centro de Atención Telefónica: 01 800 999 8080'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('Domicilio: Insurgentes Sur No. 762 Col. del Valle, Delegación Benito Juárez, C.P 03100, México D.F.'), 0, 0, 'C');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('www.condusef.gob.mx'), 0, 0, 'C');
        $this->Ln(self::parrafo);
    }
    
    public function tabla_pagos_pdf($datos = FALSE, $info_alumno = FALSE)  {        
        
        // ENCABEZADO TABLA (INICIO)
        $letra['encabezado'] = self::letra_tamano - 3;
        $letra['resultado'] = self::letra_tamano - 2;
        $letra['titulos'] = self::letra_tamano + 2;        
        
        /*$this->Cell(250, self::entrelineado, utf8_decode('Periodo'), 1, 0, 'C', 0);
        $this->Ln();*/
        
        //$this->Ln(self::un_renglon);
        $this->SetFont(self::tipo_letra, 'B',  self::letra_tamano);
        //$this->Cell(250, self::entrelineado, utf8_decode('NÚMERO DE REGISTRO CONDUSEF: ??????????????'), 0, 0, 'R');
        $this->Ln(self::un_renglon);        
        $this->SetFont(self::tipo_letra, 'B', $letra['titulos']);
        $this->Cell(250, self::entrelineado, utf8_decode('"CALENDARIO DE PAGOS"'), 0, 0, 'C');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(125, self::entrelineado, utf8_decode('CRÉDITO NÚMERO: '), 0, 0, 'L');
        $this->Cell(125, self::entrelineado, utf8_decode('SUSCRIPTOR: '), 0, 0, 'L');
        $this->Ln();
        $this->Cell(125, self::entrelineado, utf8_decode('FECHA DE ELABORACIÓN: '), 0, 0, 'L');
        $this->Cell(125, self::entrelineado, utf8_decode('MATRICULA: '), 0, 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->Cell(125, self::entrelineado, utf8_decode(''), 0, 0, 'L');        
        $this->Cell(62.5, self::entrelineado, utf8_decode('Datos del depósito'), 'LT', 0, 'R');
        $this->Cell(62.5, self::entrelineado, utf8_decode('BBVA Bancomer'), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(125, self::entrelineado, utf8_decode(''), 0, 0, 'L');        
        $this->Cell(62.5, self::entrelineado, utf8_decode('Número de convenio'), 'L', 0, 'R');
        $this->Cell(62.5, self::entrelineado, utf8_decode('757926'), 'R', 0, 'L');        
        $this->Ln();
        $this->Cell(125, self::entrelineado, utf8_decode(''), 0, 0, 'L');        
        $this->Cell(62.5, self::entrelineado, utf8_decode('Num. de referencia'), 'LB', 0, 'R');
        $this->Cell(62.5, self::entrelineado, utf8_decode('113505952'), 'RB', 0, 'L');        
        $this->Ln(self::un_renglon);
        
        $this->SetTextColor(255, 255, 255); // COLOR DE FONDO.
        $this->SetFillColor(1, 10, 118); // COLOR DE FONDO.
        
        $this->SetFont(self::tipo_letra, '', $letra['encabezado']);
        $this->Cell(25, self::entrelineado, utf8_decode('Periodo'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('Fecha pago'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('Disposición'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('Monto Intereses'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('S. Insoluto'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('Capital'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('Intereses'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('Comision'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('IVA Total'), 1, 0, 'C', 1);
        $this->Cell(25, self::entrelineado, utf8_decode('Pago total'), 1, 0, 'C', 1);
        $this->Ln();
        // ENCABEZADO TABLA (FIN)
        
        $this->SetTextColor(0, 0, 0); // COLOR DE FONDO.
        $this->SetFillColor(255, 255, 255); // COLOR DE FONDO.
        $posiciones = array('disposicion', 'pagare', 'saldo_insoluto', 
            'capital', 'intereses', 'comisiones', 'iva', 'pago_total',
            'capital2', 'pago_total2', 'intereses_iva', 'pago_total2',
            'intereses2');
        if (is_array($datos) AND count($datos) > 0) {
            foreach ($datos as $periodo => $arreglo) {
                
                $arr = convierte_numero($arreglo, $posiciones);
                $this->Cell(25, self::entrelineado, utf8_decode($periodo), 1, 0, 'C', 1);                
                $this->Cell(25, self::entrelineado, utf8_decode($arr['fecha_pago']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$ ' . $arr['disposicion']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$' . $arr['pagare']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$ ' . $arr['saldo_insoluto']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$ ' . $arr['capital']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$ ' . $arr['intereses']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$ ' . $arr['comisiones']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$ ' . $arr['iva']), 1, 0, 'R', 1);
                $this->Cell(25, self::entrelineado, utf8_decode('$ ' . $arr['pago_total']), 1, 0, 'R', 1);
                $this->Ln();
                
                // EN EL CASO DE QUE SEA UN PERIODO DE QUE SE REPITA, SE VALIDA CON LA POSICIÓN "pago_total2"
                if (isset($arreglo['pago_total2'])) {
                    $this->Cell(25, self::parrafo, utf8_decode($periodo), 1, 0, 'C', 1);
                    $this->Cell(25, self::parrafo, utf8_decode($arr['fecha_pago']), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ 0.00'), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ 0.00'), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ ' . $arr['saldo_insoluto']), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ ' . $arr['capital2']), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ ' . $arr['intereses2']), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ 0.00'), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ ' . $arr['intereses_iva']), 1, 0, 'R', 1);
                    $this->Cell(25, self::parrafo, utf8_decode('$ ' . $arr['pago_total2']), 1, 0, 'R', 1);
                    $this->Ln();
                }
            }
        }
        $this->Ln();
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano - 2);
        $this->Cell(20, self::entrelineado, utf8_decode('NOTAS: '), 0, 0, 'L');
        $this->Cell(210, self::entrelineado, utf8_decode('- El presente "Calendario de Pagos" no debe considerarse como un Estado de Cuenta.'), 0, 0, 'L');
        $this->Ln();
        $this->Cell(20, self::entrelineado, utf8_decode(''), 0, 0, 'L');
        $this->Cell(210, self::entrelineado, utf8_decode('- El presente "Calendario de Pagos" es autónomo e independiente de cualquier otro "Calendario de Pagos" que al efecto se suscriba.'), 0, 0, 'L');
        $this->Ln();
        $this->Cell(20, self::entrelineado, utf8_decode(''), 0, 0, 'L');
        $this->Cell(210, self::entrelineado, utf8_decode('- El presente "Calendario de Pagos", no incluye los accesorios pactados en el Contrato de Crédito.'), 0, 0, 'L');
        $this->Ln();
        $this->Cell(20, self::entrelineado, utf8_decode(''), 0, 0, 'L');
        $this->Cell(210, self::entrelineado, utf8_decode('- El Impuesto al Valor Agregado "IVA del Interés" puede variar, conforme a las modificaciones que sufran en las disposiciones legales aplicables, '), 0, 0, 'L');
        $this->Ln();
        $this->Cell(20, self::entrelineado, utf8_decode(''), 0, 0, 'L');
        $this->Cell(210, self::entrelineado, utf8_decode('por lo que el Pago total se verá afectado.'), 0, 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->Cell(20, self::entrelineado, utf8_decode('Recibí de conformidad:'), 0, 0, 'L');
        $this->Ln(self::entrelineado);
        $this->Cell(50, self::entrelineado, utf8_decode('Fecha: 00-00-0000'), 0, 0, 'L');
        $this->Ln(self::entrelineado);
        $this->Cell(20, self::entrelineado, utf8_decode('Firmas:'), 0, 0, 'L');
        
    }
    
    public function tabla_pagos_subida($tabla){
        if(is_array($tabla) && !empty($tabla)){
            $this->SetFillColor(237, 238, 236);
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano - 2);
            $this->Cell(23, self::entrelineado, utf8_decode('Periodo'), 1, 0, 'C',TRUE);
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano - 4.8);
            $this->Cell(23, self::entrelineado, utf8_decode('Fecha Límite de Pago'), 1, 0, 'C',TRUE);
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano - 2);
            $this->Cell(23, self::entrelineado, utf8_decode('Saldo Insoluto'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Capital'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Intereses'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Accesorios'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('IVA(*)'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Total'), 1, 0, 'C',TRUE);
            
            $this->Ln();
            foreach($tabla as $t){
                $this->SetFont(self::tipo_letra, '', self::letra_tamano);
                $this->Cell(13, self::entrelineado, utf8_decode($t['mes']), 1, 0, 'C');
                $this->Cell(33, self::entrelineado, utf8_decode(fecha_contrato($tmpf,'inverso')), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode(number_format($t['saldo_inicial'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode(number_format($t['principal'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode(number_format($t['interes'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode(number_format($t['accesorios'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode(number_format($t['iva'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode(number_format($t['pago_total'],2)), 1, 0, 'C');
                $this->Ln();
            }
        }
    }
}

/* End of file contrato_pdf.php */
/* Location: ./application/libraries/contrato_pdf.php */