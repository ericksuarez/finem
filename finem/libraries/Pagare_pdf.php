<?php

require_once('fpdf/fpdf.php');

Class Pagare_pdf extends fpdf {

    const entrelineado = 5;
    const parrafo = 4;
    const una_linea = 0;
    const un_renglon = 8;
    const margen_izq = 15;
    const margen_der = 15;
    const letra_tamano = 8;
    const tipo_letra = 'Arial';
    protected $nombre;
    protected $lugar;
    protected $fecha;

    protected function escribe_texto($parrafo, $letra) {

        foreach ($parrafo as $num_parrafo => $texto) {

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
    
    protected function set_nombre($nombre, $posicion) {
        $this->nombre[$posicion] = $nombre;
    }
    
    protected function get_nombre($posicion) {
        return $this->nombre[$posicion];
    }
    
    protected function set_lugar($lugar) {
        $this->lugar = $lugar;
    }
    
    protected function get_lugar() {
        return $this->lugar;
    }
    
    protected function set_fecha($str) {
        $this->fecha = $str;
    }
    
    protected function get_fecha() {
        return $this->fecha;
    }
    
    public function Header() {

        //$this->Rect(10,8,196,262,'D');
        // Logo        
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            
            if (!defined('FPDF_FONTPATH')) {
                define('FPDF_FONTPATH',$_SERVER['DOCUMENT_ROOT'].'\finem2\finem\libraries\fpdf\font/');
                
            }
            //$this->Image($_SERVER['DOCUMENT_ROOT'].'/finemv2/images/finem.jpg', 18, 11, 50);
        } else {

            if (!defined('FPDF_FONTPATH')) {

                define('FPDF_FONTPATH', $_SERVER['DOCUMENT_ROOT'] . '\sistema\finem\ibraries\fpdf\font');
            }
            //$this->Image($_SERVER['DOCUMENT_ROOT'] . '/sistema/images/finem.jpg', 18, 11, 50);
        }
        // Arial bold 15
        $this->SetFont(self::tipo_letra, 'B', 14);
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
        
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('"EL ACREDITADO Y SUSCRIPTOR"'), 0, 0, 'C');
        $this->Cell(185, self::entrelineado, '');
        $this->Ln(10);
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
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('"EL(LOS) AVAL(ES)"'), 0, 0, 'C');
        $this->Cell(185, self::entrelineado, '');
        $this->Ln(10);
        $this->Cell(185, self::entrelineado, '');
        $this->Ln();
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
        
        $parrafo[0] = '"El Acreditado" se obliga a pagar a "El Acreedor", intereses ordinarios sobre el saldo insoluto de la Suma Principal, mismos que se encuentran calculados a una tasa anual del 13.90% (TRECE PUNTO NOVENTA POR CIENTO), cuyo pago se deberá efectuar junto con el pago de la "La suma principal".';
        
        


        $parrafo[1] = 'En caso de que cualquier importe de la Suma Principal, de los intereses o cualquier otra cantidad que correspondan y no fuere pagada en su vencimiento, de conformidad con el Calendario de Pagos, con independencia del derecho de "El Acreedor" de dar por vencido anticipadamente este Pagaré, haciéndose exigible el saldo insoluto de la Suma Principal, generará intereses moratorios a razón de la cantidad que resulte de multiplicar por 2 (DOS) la tasa de interés ordinaria señalada en el párrafo anterior, mientras exista algún saldo insoluto sobre cualquier cantidad que no haya sido pagada oportunamente por "El Acreditado" en su vencimiento y hasta su total liquidación.';


        $parrafo[2] = 'Todos los pagos al amparo de este Pagaré deberán hacerse en su fecha de vencimiento, en Pesos Moneda Nacional, en las oficinas de "El Acreedor" localizada en Bosque de Ciruelos, número 160, piso 7, Colonia Bosques de las Lomas, Delegación Miguel Hidalgo, C.P. 11700, en cualquier momento antes de las 13:00 horas tiempo de la Ciudad de México, o en la cuenta bancaria de "El Acreedor" que al efecto se indique, sin retención de ningún impuesto o compensación.';

        $parrafo[3] = 'Si cualquier pago que deba hacerse conforme a este Pagaré en cualquier día que no fuere Día Hábil, dicho pago se hará en el Día Hábil inmediato posterior. Para efectos de lo aquí señalado, Día Hábil significa un día del año distinto a sábados y domingos en el cual las instituciones de crédito no se encuentren autorizadas a cerrar sus puertas al público.';

        $parrafo[4] = 'En todo caso y en cualquier momento "El (Los) Aval(es)" garantiza(n) de manera incondicional e irrevocable, cubrir puntualmente a "El Acreedor", sus sucesores o cesionarios, la Suma Principal y los intereses que se generen, así como los accesorios que se causen.';

        $parrafo[5] = '"El (Los) Aval(es)" expresamente reconoce(n) y acepta(n) que sus obligaciones como Aval(es) y Garante(s) sean regidas por la sección 4ª del Capítulo II de la Ley General de Títulos y Operaciones de Crédito y conforme a las demás leyes aplicables del Distrito Federal, específicamente renuncia a los beneficios de orden, excusión, división, quita, novación, espera, modificación y cualquier otro previsto, de conformidad con los artículos 2813, 2814, 2816, 2818, 2820, 2821, 2822, 2823, 2827, 2836, 2840 y demás relativos y aplicables del Código Civil vigente para el Distrito Federal y los correlativos de los códigos civiles de los demás Estados, mismos que no se reproducen literalmente aquí en virtud de que "Los Avales" expresamente manifiesta conocer el contenido de los mismos.';

        $parrafo[6] = '"El Acreditado" y "El (Los) Aval(es)" se obligan a cubrir todos los gastos y costas que se generen (incluyendo honorarios razonables de abogados) en que incurra "El Acreedor" a fin de hacer exigible el presente Pagaré.';
        $parrafo[7] = 'Para la interpretación, cumplimiento y ejecución del presente Pagaré, "EL Acreditado" y "El (Los) Aval(es)" expresan e irrevocablemente se someten a las leyes y tribunales competentes en la Ciudad de México, Distrito Federal, o a la jurisdicción que efecto decida "El Acreedor", renunciando las demás partes a cualquier otra jurisdicción a la que pudieran tener derecho por cualquier razón o por virtud de sus domicilios presentes o futuros.';
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        //$this->Cell(185, self::entrelineado, utf8_decode('NUMERO DE REGISTRO CONDUSEF: >>>>>>>'), 0, 0, 'R');
        $this->Ln(self::un_renglon);
        $letra = FALSE;
        $this->escribe_texto($parrafo, $letra);
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('Se suscribe el presente Pagaré en la Ciudad de '.$this->get_lugar().' el día '.$this->get_fecha()), 0, 0, 'L');
        $this->Ln(self::un_renglon + 5);
    }
    
    public function dinamico($info = FALSE, $config = FALSE) {
        
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
        $num_oficial['alumno'][$doc_of] = $info['alumno']['numero_oficial'];        
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
            $num_oficial[$posicion][$doc_of] = $info[$posicion]['numero_oficial'];        
        }
        // FIN DATOS DEL AVAL(ES)
        
        $this->set_nombre($nombre['alumno'], 'alumno');
        $this->set_nombre($conyuge['alumno'], 'conyuge_alu');
        $this->set_nombre($nombre['aval1'], 'aval1');
        $this->set_nombre($info['aval1']['nombre_conyuge'], 'conyuge_aval1');
        $this->set_nombre($nombre['aval2'], 'aval2');
        $this->set_nombre($info['aval2']['nombre_conyuge'], 'conyuge_aval2');
        
        
        $nombre['aval1'] = ($nombre['aval1'] == '  ') ? '>>>>>>>>>>>>>>' : ($nombre['aval1']);
        $nombre['aval2'] = ($nombre['aval2'] == '  ') ? '>>>>>>>>>>>>>>' : ($nombre['aval2']);
        //print_r($this->nombre);
        
        // DATOS DEL CREDITO (INICIO)
        $niv_ab = $info['expediente']['nivel'];
        $nivel[$niv_ab] = 'X';
        $universidad = obtener_campo('razon_social.universidad', 'iduniversidad.' . $info['expediente']['universidad_iduniversidad']);
        $campus = obtener_campo('nombre.campus', 'idcampus.' . $info['expediente']['campus_idcampus']);
        $plan_carrera = obtener_campo('marca_plan.carrera','idcarrera.'.$info['expediente']['especialidad']);
        //$plazo = isset($info['contrato']['plazo_credito']) ? $info['contrato']['plazo_credito'] : '';
        $cantidad = array(
            'semestral' => ($plan_carrera == 'semestral') ? ($info['contrato']['pago_mensual']) : '',
            'cuatrimestral' => ($plan_carrera == 'cuatrimestral') ? ($info['contrato']['pago_mensual']) : '',
            'trimestral' => ($plan_carrera == 'trimestral') ? ($info['contrato']['pago_mensual']) : ''
        );
        $cantidadx = array(
            'semestral' => ($plan_carrera == 'semestral') ? ($info['contrato']['pago_extraordinario']) : '',
            'cuatrimestral' => ($plan_carrera == 'cuatrimestral') ? ($info['contrato']['pago_extraordinario']) : '',
            'trimestral' => ($plan_carrera == 'trimestral') ? ($info['contrato']['pago_extraordinario']) : ''
        );
        $primer_disposicion = $info['contrato']['primer_disposicion'] + $info['contrato']['adeudo_universidad'];
        
        $this->set_lugar($info['contrato']['lugar_firma']);
        $this->set_fecha(fecha_contrato($info['contrato']['fecha_suscripcion']));
        
        //$tmp = obtener_campo('fecha_vencimiento.pagare','expediente_idexpediente.'.$info['expediente']['idexpediente']);
        //$fecha_vencimiento = ($tmp == 'ERROR') ? '' : $tmp;
        $fecha_vencimiento = $info['contrato']['fecha_vencimiento'];
        //$tmp = obtener_campo('plazo.pagare','expediente_idexpediente.'.$info['expediente']['idexpediente']);
        //$plazo = ($tmp == 'ERROR') ? 0 : $tmp;
        $plazo = $info['contrato']['plazo_credito'];
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        //$this->Cell(185, self::entrelineado, utf8_decode('NUMERO DE REGISTRO CONDUSEF: ??????????????'), 0, 0, 'R');
        $this->Ln(self::un_renglon);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(185, self::entrelineado, utf8_decode('PAGARÉ'), 0, 0, 'C');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->SetFillColor(237, 238, 236);
        $this->Cell(48, self::entrelineado, utf8_decode('MATRÍCULA NÚMERO:'), 1, 0, 'L',true);
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);        
        $this->Cell(44, self::entrelineado, utf8_decode($info['expediente']['matricula']), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->SetFillColor(237, 238, 236);
        $this->Cell(48, self::entrelineado, utf8_decode('LUGAR DE SUSCRIPCIÓN:'), 1, 0, 'L',true);
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);        
        $this->Cell(45, self::entrelineado, utf8_decode($info['contrato']['lugar_firma']), 1, 0, 'L');
        $this->Ln();
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->SetFillColor(237, 238, 236);
        $this->Cell(48, self::entrelineado, utf8_decode('FECHA SUSCRIPCIÓN:'), 1, 0, 'L',true);
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);        
        $this->Cell(44, self::entrelineado, utf8_decode(fecha_contrato($info['contrato']['fecha_suscripcion'],'abreviado')), 1, 0, 'L');
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->SetFillColor(237, 238, 236);
        $this->Cell(48, self::entrelineado, utf8_decode('FECHA VENCIMIENTO:'), 1, 0, 'L',true);
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);        
        $this->Cell(45, self::entrelineado, utf8_decode(fecha_contrato($fecha_vencimiento,'abreviado')), 1, 0, 'L');
        $this->Ln();
        $this->Ln(self::un_renglon);
        
        $this->MultiCell(185, self::entrelineado, utf8_decode('El suscrito, '.$nombre['alumno'].' compareciendo por mi propio derecho con el carácter de suscriptor y acreditado en adelante referido como ' .
                        '"El Acreditado", junto con '.$nombre['aval1'].' y '.$nombre['aval2'].' quien(es) también comparece(n) por su propio derecho con el carácter de aval(es),' . 
                        'en adelante referido(s) como "El (Los) Aval(es)"; por el presente Pagaré prometemos incondicionalmente pagar a la orden de "FINANCIERA EDUCATIVA DE MÉXICO, SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,' .
                        'SOCIEDAD FINANCIERA DE OBJETO MÚLTIPLE, ENTIDAD NO REGULADA", en adelante referida como "El Acreedor" o "FINEM", la suma principal de $'.number_format($primer_disposicion,2).' ('.ucfirst(convertirLetras($primer_disposicion)).') en adelante ' .
                        'referida como "La Suma Principal", mediante '.$plazo.' ('.ucfirst(convertirLetras($plazo,FALSE)).') pagos mensuales y consecutivos de $'.number_format($cantidad[$plan_carrera],2).' ('.ucfirst(convertirLetras($cantidad[$plan_carrera])).') cada uno de los ' .
                        'pagos, en las fechas y montos que se indican en la Tabla de Amortización o Calendario de Pagos, que a continuación se menciona:'), 0, 'J');
        
        $this->Ln(self::un_renglon);
        
    }
    
    public function tabla_pagos($tabla,$fecha,$numero_real=0){
        //print_r($tabla);
        
        if(is_array($tabla) && !empty($tabla)){
            $this->SetFillColor(237, 238, 236);
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano - 2);
            $this->Cell(10, self::entrelineado, utf8_decode('Interno'), 1, 0, 'C',TRUE);
            $this->Cell(10, self::entrelineado, utf8_decode('Periodo'), 1, 0, 'C',TRUE);
            $this->Cell(33, self::entrelineado, utf8_decode('Fecha Límite de Pago'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Saldo Insoluto'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Capital'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Intereses'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Accesorios'), 1, 0, 'C',TRUE);
            $this->Cell(16, self::entrelineado, utf8_decode('IVA(*)'), 1, 0, 'C',TRUE);
            $this->Cell(23, self::entrelineado, utf8_decode('Total'), 1, 0, 'C',TRUE);
            
            $this->Ln();
            $tmpf = $fecha;
            foreach($tabla as $t){
                
                $this->SetFont(self::tipo_letra, '', self::letra_tamano);
                $this->Cell(10, self::entrelineado, utf8_decode($numero_real), 1, 0, 'C');
                $this->Cell(10, self::entrelineado, utf8_decode($t['mes']), 1, 0, 'C');
                $this->Cell(33, self::entrelineado, utf8_decode(fecha_contrato($tmpf,'inverso')), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode('$'.number_format($t['saldo_inicial'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode('$'.number_format($t['principal'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode('$'.number_format($t['interes'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode('$'.number_format($t['accesorios'],2)), 1, 0, 'C');
                $this->Cell(16, self::entrelineado, utf8_decode('$'.number_format($t['iva'],2)), 1, 0, 'C');
                $this->Cell(23, self::entrelineado, utf8_decode('$'.number_format($t['pago_total'],2)), 1, 0, 'C');
                $this->Ln();
                
                $tmpf = date('Y-m',strtotime($tmpf.' + 1 month')).'-05';
                
                $numero_real++;
            }
        }
    }

    
    
    
}

/* End of file contrato_pdf.php */
/* Location: ./application/libraries/contrato_pdf.php */