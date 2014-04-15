<?php

require_once('fpdf/fpdf.php');

Class Carta_pdf extends fpdf {

    const entrelineado = 5;
    const parrafo = 4;
    const una_linea = 0;
    const un_renglon = 8;
    const margen_izq = 15;
    const margen_der = 15;
    const letra_tamano = 12;
    
    
    protected function escribe_texto($parrafo, $letra) {

        foreach ($parrafo as $num_parrafo => $texto) {

            if (isset($letra[$num_parrafo]) AND is_array($letra[$num_parrafo])) {
                $this->SetFont('Helvetica', $letra[$num_parrafo]['tipo'], $letra[$num_parrafo]['size']);
            } else {
                $this->SetFont('Helvetica', '', self::letra_tamano);
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

    function creaEncabezado($fecha, $idUniversidad, $folio) {



        if ($idUniversidad == 7) {

            $this->Ln(10);
            $this->SetFont('Helvetica', 'B', self::letra_tamano);
            $this->Cell(185, 4, $folio, 0, 0, 'R');
            $this->Ln(5);
        } else {

            $this->Ln(15);
        }

        $this->Ln(4);
        $this->SetFont('Helvetica', 'B', 12);
        $this->Cell(185, 4, utf8_decode('México D.F. ' . fecha_contrato($fecha)), 0, 0, 'R');

        $this->Ln(7);
        $this->SetFont('Helvetica', '', 12);
        $this->Ln(13);
    }

    function creaPie($idalumno) {
        $nombreCompleto = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$idalumno,TRUE);
        $this->Cell(40,4,'ACEPTO',0,0,'L');
        $this->Ln(27);
        $this->Ln();
        $this->SetFont('Helvetica', 'B', self::letra_tamano);
        $this->Cell(10, self::entrelineado, '');
        $this->Cell(70, self::entrelineado, utf8_decode($nombreCompleto), 'T', 0, 'C');
    }

    public function Header() {

        //$this->Rect(10,8,196,262,'D');
        // Logo        
        if ($_SERVER['SERVER_NAME'] == '192.168.1.100') {

            if (!defined('FPDF_FONTPATH')) {
                define('FPDF_FONTPATH', $_SERVER['DOCUMENT_ROOT'] . '\finem2\finem\libraries\fpdf\font/');
            }
            $this->Image($_SERVER['DOCUMENT_ROOT'] . '/finem/images/finem.jpg', 18, 11, 50);
        } else {

            if (!defined('FPDF_FONTPATH')) {

                define('FPDF_FONTPATH', $_SERVER['DOCUMENT_ROOT'] . '\sistema\finem\ibraries\fpdf\font');
            }
            $this->Image($_SERVER['DOCUMENT_ROOT'] . '/sistema/images/finem.jpg', 18, 11, 50);
        }
        // Arial bold 15
        $this->SetFont('Helvetica', 'B', 14);
        //$this->Ln(20);
    }

    // Pie de página
    public function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-8);
        // Arial italic 8
        $this->SetFont('Helvetica', 'I', 8);
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

    public function compromiso($info) {
        $nombreCompleto = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$info['expediente']['alumno_idalumno'],TRUE);
        $razonSocial = obtener_campo('razon_social.universidad','iduniversidad.'.$info['expediente']['universidad_iduniversidad']);
        $numMatricula = $info['expediente']['matricula'];
        $cicloNuevo = obtener_campo('ciclo.ciclo','idciclo.'.$info['expediente']['ciclo_idciclo']);
        
        $this->Ln(3);
        $this->Cell(40, 4, utf8_decode('CARTA COMPROMISO / PRE APROBACIÓN'), 0, 0, 'L');
        $this->Ln(17);
        $this->MultiCell(185, 4, utf8_decode('Quien suscribe ' . $nombreCompleto . ', estudiante de la ' . $razonSocial . ', con número de matrícula ' . $numMatricula . ', hago constar que a solicitud mía, ha sido autorizada mi inscripción temporal a la ' . $razonSocial . ' al amparo del crédito educativo que estoy tramitando ante Financiera Educativa de México, S.A. de C.V., SOFOM, E.N.R., (FINEM) y que espero me autoricen en próximos días, para mi inscripción al ciclo escolar ' . $cicloNuevo . '.'));
        $this->Ln(7);
        $this->MultiCell(185, 4, utf8_decode('Así mismo, me comprometo a que en tres días naturales a partir de la presente fecha, habré entregado la documentación completa a (FINEM), así como en este tiempo presentarme con mi (s) aval (es) en el domicilio de la Universidad '.$razonSocial.' para que ambos suscribamos la documentación correspondiente al posible crédito educativo por el ciclo ' . $cicloNuevo . '.'));
        $this->Ln(7);
        $this->MultiCell(185, 4, utf8_decode('En caso de no cumplir con el compromiso señalado en el párrafo anterior, y en caso de que (FINEM) no llegara a autorizarme el crédito educativo por cualquier índole,  me comprometo  a cubrir a la ' . $razonSocial . ' todos los pagos que me correspondan a las colegiaturas y en su caso los recargos correspondientes a que sea acreedor de acuerdo con el reglamento de pagos de la ' . $razonSocial . '. '));

        $idUniversidad = $info['expediente']['universidad_iduniversidad'];
        switch ($idUniversidad) {

            case 7:
                $this->Ln(7);
                $this->MultiCell(185, 4, utf8_decode('Por este medio quedo enterado que fue validada mi información en buró de crédito y que es interés de FINEM autorizar mi crédito educativo siempre y cuando cumpla con los requisitos y trámites correspondientes que a virtud de la presente se me soliciten.'));
                $this->Ln(19);
                break;

            default:
                $this->Ln(27);
                break;
        }
    }
    
    public function bienvenida($exp){
        
        $info['nombre_alumno'] = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$exp['alumno_idalumno'],TRUE);
        $info['fecha_primer_pago'] = obtener_campo('fecha_primer_pago.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $info['cie'] = obtener_campo('convenio_cie.universidad','iduniversidad.'.$exp['universidad_iduniversidad']);
        $info['numero_referencia'] = obtener_campo('numero_referencia.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $info['id_universidad'] = $exp['universidad_iduniversidad'];
        $digito = obtener_campo('digito_verificador.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        
	$this->SetFont('Helvetica','',self::letra_tamano); 
	$this->Cell(45,4,'Estimado(a) alumno(a)', 0, 0,'L');
	$this->SetFont('Helvetica','B',self::letra_tamano); 
	$this->Cell(140,4,utf8_decode($info['nombre_alumno']), 0, 0, 'L');
	
	$this->SetFont('Helvetica','',self::letra_tamano); 
	
	$this->Ln(25);
	$this->MultiCell(0, 5, utf8_decode('Te damos la más cordial bienvenida al Programa Nacional de Financiamiento a la Educación ' .
		'Superior que otorga Financiera Educativa de México, S.A. de C.V. SOFOM E.N.R. que apoya el inicio o conclusión de ' . 
		'tus estudios profesionales, es por ello que el realizar tus pagos mensuales en tiempo y forma, '.
		'fortalece tu financiamiento y así juntos lograremos alcanzar tus objetivos.'));
		
	$this->Ln(10);
	$this->MultiCell(0, 5, utf8_decode('Es básico que recuerdes la importancia que tiene que conserves un excelente historial crediticio ' .
		'con FINEM, ya que con ello, además de obtener múltiples beneficios y satisfacciones, impulsas a ' .
		'otros estudiantes que necesitan contar con un soporte económico y te permite seguir disponiendo ' .
		'ágilmente de los recursos necesarios, para continuar con tus estudios.'));
		
	$this->Ln(10);
	$this->MultiCell(0, 5, utf8_decode('Tu financiamiento se reporta el Buró Nacional de Crédito, por lo que estás generando desde '. 
		'ahora un historial que te abrirá las puertas en el ambiente crediticio y financiero.')
	);
	
	$uni_banorte = array(15, 19);	
	if (in_array($info['id_universidad'], $uni_banorte)) {
	
		$banco = 'Banorte';
		
	} else {
	
		$banco = 'BBVA Bancomer, S.A.';
	}
		
	$this->Ln(10);
	$this->MultiCell(0, 5, utf8_decode('Tu primer pago lo debes realizar el próximo ' . fecha_contrato($info['fecha_primer_pago']) . 
		' al convenio CIE ' . $info['cie'] . ' del banco ' . $banco . 
		' y con tu referencia número ' . $info['numero_referencia'] .$digito. '.'));
		
	$this->Ln(10);
	$this->MultiCell(0, 5, utf8_decode('Esta información es única para cada uno de los acreditados, por lo que es necesario que '.
		'te cerciores que tus depósitos sean canalizados correctamente hasta la liquidación total de tu financiamiento, '.
		'confirma que tu pago NO sea aplicado a conceptos como: "comisiones" o "accesorios" ya que será difícil '.
		'identificarlos y no se aplicarán a tu saldo.'));
		
	$this->Ln(10);
	$this->MultiCell(0, 5, utf8_decode('Para cualquier duda o comentario, estamos a tus ordenes en los teléfonos 30 88 38 30 y 30 88 38 ' .
		'56, del interior 01 800 753 42 73 o directamente en nuestras oficinas ubicadas en Bosque de Ciruelos numero 160 piso 7, ' .
		'colonia Bosques de las Lomas, en la delegación Miguel Hidalgo C.P. 11700, en México D.F.'));
	
	$this->Ln(20);
	$this->Cell(184,4,utf8_decode('De antemano ¡MUCHAS GRACIAS!'), 0, 0, 'L');
    }
    
    public function cobranza($exp,$pagare=NULL) {
        $zxc['id_entidad'] = $exp['universidad_iduniversidad'];
        $nombre_alu = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$exp['alumno_idalumno'],TRUE);
        $zxc['entidad'] = obtener_campo('razon_social.universidad', 'iduniversidad.'.$exp['universidad_iduniversidad']);
        $zxc['campus'] = obtener_campo('nombre.campus', 'idcampus.'.$exp['campus_idcampus']);
        $zxc['mat'] = $exp['matricula'];
        $cie= obtener_campo('convenio_cie.universidad','iduniversidad.'.$exp['universidad_iduniversidad']);
        $referencia = obtener_campo('numero_referencia.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $digito = obtener_campo('digito_verificador.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        
        if(is_array($pagare) && !empty($pagare)){
            $importe = $pagare['importe'];
            $adeudo = 0;
        }else{
            $importe = obtener_campo('primer_disposicion.contrato','expediente_idexpediente.'.$exp['idexpediente']);
            $adeudo = obtener_campo('adeudo_universidad.contrato','expediente_idexpediente.'.$exp['idexpediente']);
            
        }
        
        $disposicion = obtener_campo('pago_extraordinario.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        
        $importe += $adeudo;
        
        
        /**El siguiente código lo ha hecho venga a saber quién. 
         * Es horrible, no lo he corregido sólo cambiado lo que necesito para que funcione. 
         * **/
        
        $this->Cell(55, 4, 'Nombre del alumno ', 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode($nombre_alu), 0, 0, 'L');
        $this->Ln(7);
        $this->Cell(55, 4, 'Universidad ', 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode($zxc["entidad"]), 0, 0, 'L');
        
        $this->Ln(7);
        $this->Cell(55, 4, 'Campus ', 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode($zxc["campus"]), 0, 0, 'L');
        
        $this->Ln(7);
        $this->Cell(55, 4, 'No. de Matricula ', 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode($zxc["mat"]), 0, 0, 'L');
        
        if ($zxc["id_entidad"] == 19) {
            $this->Ln(7);
            $this->Cell(55, 4, 'Datos del deposito ', 0, 0, 'L');
            $this->Cell(30, 4, 'Banorte', 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Empresa concentradora ', 0, 0, 'L');
            $this->Cell(30, 4, 'FINEM', 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'No. Cuenta concentradora', 0, 0, 'L');
            $this->Cell(30, 4, utf8_decode($cie), 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Referencia 1', 0, 0, 'L');
            $this->Cell(30, 4, utf8_decode($referencia . $digito), 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Referencia 2', 0, 0, 'L');
            $this->Cell(30, 4, 'UCO', 0, 0, 'L');
        } else if ($zxc["id_entidad"] == 15) {

            $this->Ln(7);
            $this->Cell(55, 4, 'Datos del deposito ', 0, 0, 'L');
            $this->Cell(30, 4, 'Banorte', 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Empresa concentradora ', 0, 0, 'L');
            $this->Cell(30, 4, 'FINEM', 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'No. Cuenta concentradora', 0, 0, 'L');
            $this->Cell(30, 4, utf8_decode($cie), 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Referencia 1', 0, 0, 'L');
            $this->Cell(30, 4, utf8_decode($referencia . $digito), 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Referencia 2', 0, 0, 'L');
            $this->Cell(30, 4, 'TANGAMANGA', 0, 0, 'L');
        } else {
            $this->Rect(55, 75, 85, 22, 'D');
            $this->Ln(7);
            $this->Cell(55, 4, utf8_decode('Datos del depósito '), 0, 0, 'L');
            $this->Cell(30, 4, 'BBVA Bancomer', 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Num convenio ', 0, 0, 'L');
            $this->Cell(30, 4, utf8_decode($cie), 0, 0, 'L');
            $this->Ln(7);
            $this->Cell(55, 4, 'Num Referencia', 0, 0, 'L');
            $this->Cell(30, 4, utf8_decode($referencia . $digito), 0, 0, 'L');
        }

        $this->Ln(7);
        $this->Cell(55, 4, utf8_decode('Importe del pagaré '), 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode('$ ' . number_format($importe, 2) . ''), 0, 0, 'L');
        $this->Ln(7);
        $this->Cell(55, 4, utf8_decode('Cuota de Inscripción '), 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode('$ ' . number_format($disposicion, 2) . ''), 0, 0, 'L');
        /*if ($capitalizacion != 1) {
            $this->Ln(7);
            $this->Cell(40, 4, 'Seguro de vida anual ', 0, 0, 'L');
            $this->Cell(30, 4, '$ ' . number_format($seguro, 2) . '', 0, 0, 'L');
        }
        $this->Ln(7);
        $this->Cell(40, 4, 'IVA', 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode('$ ' . number_format($iva, 2) . ''), 0, 0, 'L');
        $this->Ln(7);
        //$this->SetFont('Times', 'B', 9);
        $this->Cell(40, 4, utf8_decode('Total'), 0, 0, 'L');
        $this->Cell(30, 4, utf8_decode('$ ' . number_format($total, 2) . ''), 0, 0, 'L');
        $this->Ln(7);

        $this->Ln(10);
        $this->Cell(40, 4, utf8_decode('Recibí importes, asi como número de convenio y de referencia para deposito.'), 0, 0, 'L');
        $this->Ln(30);
//aki empieza una tabla---------------------------------------------------------------------------------------------------
        //$this->SetFont('Times', 'B', 9);
        $this->Cell(185, 3, '_______________________________________________________', 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Times', 'B', 9);
        $this->Cell(185, 3, utf8_decode($nombre_alu), 0, 0, 'C');*/
    }
    
    public function liberacion($exp,$pagare) {
        
        $CI = & get_instance();
        $CI->load->helper('letra_numero');
        
        $nombre_alu = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$exp['alumno_idalumno'],TRUE);
        if(is_array($pagare) && !empty($pagare)){
            $fecha_suscripcion = $pagare['fecha_suscripcion'];
        }else{
            $fecha_suscripcion = obtener_campo('fecha_suscripcion.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        }
        
        $info['fecha_primer_pago'] = obtener_campo('fecha_primer_pago.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $id_universidad = $exp['universidad_iduniversidad'];
        $nombre_uni = obtener_campo('razon_social.universidad', 'iduniversidad.'.$exp['universidad_iduniversidad']);
        $matricula = $exp['matricula'];
        $capitalizacion = 0;
        $cie= obtener_campo('convenio_cie.universidad','iduniversidad.'.$exp['universidad_iduniversidad']);
        $referencia = obtener_campo('numero_referencia.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $digito = obtener_campo('digito_verificador.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        
        $importe_credito = obtener_campo('importe.analisis','expediente_idexpediente.'.$exp['idexpediente']);
        $avance = obtener_campo('credito_autorizado.analisis','expediente_idexpediente.'.$exp['idexpediente']);
        
        $disposicion = obtener_campo('pago_extraordinario.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $iva = ($disposicion * 0.16);
        $total = $disposicion + $iva;
        
        if(is_array($pagare) && !empty($pagare)){
            $importe = $pagare['importe'];
            $adeudo = 0;
        }else{
            $importe = obtener_campo('primer_disposicion.contrato','expediente_idexpediente.'.$exp['idexpediente']);
            $adeudo = obtener_campo('adeudo_universidad.contrato','expediente_idexpediente.'.$exp['idexpediente']);
            
        }
        $importe += $adeudo;
        
        $this->MultiCell(185, 5, utf8_decode($nombre_uni));
        $this->Ln(7);
        $this->MultiCell(185, 5, utf8_decode('Por medio de la presente nos es grato informarle que el alumno ' . $nombre_alu . ' con número de matrícula ' . $matricula .
                ' tiene autorizado un crédito educativo FINANCIERA EDUCATIVA DE MEXICO, S.A. DE C.V. SOFOM, E.N.R. (FINEM) ; con vigencia a partir de  ' .fecha_contrato($fecha_suscripcion). '.'));

        $this->MultiCell(185, 5, utf8_decode('El alumno ha hecho entrega de la información y documentación requerida y '
                . 'ha suscrito en favor de "FINEM" un pagaré por un monto total de $'.number_format($importe, 2).' '
                . '('.strtoupper(convertirLetras($importe)).'), cantidad que incluye el adeudo que alumno tiene con la '
                . $nombre_uni.', conformado de la siguiente manera:'));
        
        $this->Ln(7);
        $this->Cell(91, 4, utf8_decode('Crédito Nuevo'), 0, 0, 'C');
        $this->Cell(93, 4, utf8_decode('Re-Disposición'), 0, 0, 'C');
        $this->Rect(40, 108, 3, 3);
        $this->Rect(132, 108, 3, 3);
        $this->Ln(7);
        
        $this->SetFillColor(237, 238, 236); 
        $this->Cell(11, 5, utf8_decode('No.'), 1, 0, 'C',1);
        $this->Cell(87, 5, utf8_decode('Concepto'), 1, 0, 'C',1);
        $this->Cell(87, 5, utf8_decode('Monto'), 1, 0, 'C',1);
        $this->Ln();
        $this->Cell(11, 5, utf8_decode('1'), 1, 0, 'C');
        $this->Cell(87, 5, utf8_decode('Costo del Ciclo Actual:'), 1, 0, 'L');
        $this->Cell(87, 5, utf8_decode('$'.number_format($importe - $adeudo,2)), 1, 0, 'R');
        $this->Ln();
        $this->Cell(11, 5, utf8_decode('2'), 1, 0, 'C');
        $this->Cell(87, 5, utf8_decode('Adeudo Correspondiente al Ciclo Anterior:'), 1, 0, 'L');
        $this->Cell(87, 5, utf8_decode('$'.number_format($adeudo,2)), 1, 0, 'R');
        $this->Ln();
        //$this->Cell(98, 5, utf8_decode('Depósito a la Universidad:'), 1, 0, 'C');
        $this->Cell(98, 5, utf8_decode('Total Pagaré:'), 1, 0, 'C');
        $this->Cell(87, 5, utf8_decode('$'.number_format($importe,2)), 1, 0, 'R');
        
        /*$this->Ln(10);
        
        $this->Cell(11, 5, utf8_decode('3'), 1, 0, 'C');
        $this->Cell(87, 5, utf8_decode('Capitalización de Accesorios:'), 1, 0, 'L');
        $this->Cell(87, 5, utf8_decode('Monto'), 1, 0, 'R');
        $this->Ln();
        $this->Cell(98, 5, utf8_decode('Total Pagaré:'), 1, 0, 'C');
        $this->Cell(87, 5, utf8_decode('Monto'), 1, 0, 'R');*/
        
        $this->Ln(7);
        
        $this->MultiCell(185, 5, utf8_decode('Sin más por el momento, le reiteramos nuestra disposición para cualquier duda o comentario adicional.'));
        $this->Ln(15);
        $this->MultiCell(185, 5, 'Atentamente');
        $this->Ln(20);
        $this->Cell(185, 3, '__________________________________________________', 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(185, 3, 'Representante FINEM', 0, 0, 'C');
    }
    
    /* OBSOLETA
    public function liberacion($exp,$pagare) {
        
        $CI = & get_instance();
        $CI->load->helper('letra_numero');
        
        $nombre_alu = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$exp['alumno_idalumno'],TRUE);
        if(is_array($pagare) && !empty($pagare)){
            $fecha_suscripcion = $pagare['fecha_suscripcion'];
        }else{
            $fecha_suscripcion = obtener_campo('fecha_suscripcion.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        }
        
        $info['fecha_primer_pago'] = obtener_campo('fecha_primer_pago.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $id_universidad = $exp['universidad_iduniversidad'];
        $nombre_uni = obtener_campo('razon_social.universidad', 'iduniversidad.'.$exp['universidad_iduniversidad']);
        $matricula = $exp['matricula'];
        $capitalizacion = 0;
        $cie= obtener_campo('convenio_cie.universidad','iduniversidad.'.$exp['universidad_iduniversidad']);
        $referencia = obtener_campo('numero_referencia.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $digito = obtener_campo('digito_verificador.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        
        $importe_credito = obtener_campo('importe.analisis','expediente_idexpediente.'.$exp['idexpediente']);
        $avance = obtener_campo('credito_autorizado.analisis','expediente_idexpediente.'.$exp['idexpediente']);
        
        $disposicion = obtener_campo('pago_extraordinario.contrato','expediente_idexpediente.'.$exp['idexpediente']);
        $iva = ($disposicion * 0.16);
        $total = $disposicion + $iva;
        
        if(is_array($pagare) && !empty($pagare)){
            $importe = $pagare['importe'];
            $adeudo = 0;
        }else{
            $importe = obtener_campo('primer_disposicion.contrato','expediente_idexpediente.'.$exp['idexpediente']);
            $adeudo = obtener_campo('adeudo_universidad.contrato','expediente_idexpediente.'.$exp['idexpediente']);
            
        }
        $importe += $adeudo;
        
        $this->MultiCell(185, 5, utf8_decode($nombre_uni));
        $this->Ln(15);
        $this->MultiCell(185, 5, utf8_decode('Por medio de la presente nos es grato informarle que el alumno ' . $nombre_alu . ' con número de cuenta ' . $matricula .
                '; ha sido aceptado bajo el esquema de crédito educativo FINANCIERA EDUCATIVA DE MEXICO, S.A. DE C.V. SOFOM, E.N.R. ; con vigencia a partir de  ' .fecha_contrato($fecha_suscripcion). '.'));

        switch ($id_universidad) {

            case 25:
                
                if ($capitalizacion == 1) {
                    $totImporte = ($importe - 1067.2);
                } else {
                    $totImporte = $importe;
                }
                $this->Ln(7);
                $this->MultiCell(185, 5, utf8_decode('Después del estudio realizado por nosotros a este alumno, se liberó una línea de crédito de $' .
                        number_format($importe_credito, 2) . ' en cuyo caso se dispondrá de un importe de $' . number_format($totImporte, 2) .
                        ' incluye cuotas vigentes y/o vencidas. Este importe no incluye: Registro ante la SEP, Plan de Protección, SGMM y recargos sobre adeudos que actualmente mantiene con ustedes; como concepto de monto a disponer el cual quedará depositado en las cuentas y mecanismos establecidos en el convenio de colaboración firmado entre UVM y FINEM.'));
                $this->Ln(7);
                $this->MultiCell(185, 5, utf8_decode('Así mismo nos ha firmado un pagaré por la cantidad de $ ' .
                        number_format($importe, 2) . ' (' . strtoupper(convertirLetras($importe)) .
                        ') el cual representa el ' . $avance . '%  de los costos de inscripción y colegiatura e incluye la cantidad de $ ' .
                        number_format($adeudo) . ' (' . strtoupper(convertirLetras($adeudo)) .
                        ') por concepto de adeudos que a esta fecha presenta con la Universidad. '));
                $this->Ln(12);
                break;
            default:
                $this->Ln(15);
                $this->MultiCell(185, 5, utf8_decode('Así mismo nos ha firmado un pagaré por la cantidad de $ ' . number_format($importe, 2) .
                        ' (' . strtoupper(convertirLetras($importe)) . ') el cual representa el ' . $avance .
                        '%  de los costos de inscripción y colegiatura e incluye la cantidad de $ ' . number_format($adeudo) .
                        ' (' . strtoupper(convertirLetras($adeudo)) . ') por concepto de adeudos que a esta fecha presenta con la Universidad.'));
                $this->Ln(15);
                break;
        }
        $this->MultiCell(185, 5, utf8_decode('Sin más por el momento, nos ponemos a sus órdenes para cualquier duda o aclaración al respecto.'));
        $this->Ln(15);
        $this->MultiCell(185, 5, 'Atentamente');
        $this->Ln(20);
        $this->Cell(185, 3, '__________________________________________________', 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(185, 3, 'Representante FINEM', 0, 0, 'C');
    }
     * */

}

/* End of file carta_pdf.php */
/* Location: ./application/libraries/carta_pdf.php */