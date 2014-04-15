<?php

require_once('fpdf/fpdf.php');

Class Investigacion_pdf extends fpdf {

    const entrelineado = 5;
    const parrafo = 4;
    const una_linea = 0;
    const un_renglon = 8;
    const margen_izq = 15;
    const margen_der = 15;
    const letra_tamano = 8;
    const tipo_letra = 'Arial';
    protected $nombre;
    
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
            //$this->Image($_SERVER['DOCUMENT_ROOT'].'/finem2/images/finem.jpg', 18, 11, 50);
        } else {

            if (!defined('FPDF_FONTPATH')) {

                define('FPDF_FONTPATH', $_SERVER['DOCUMENT_ROOT'] . '\sistema\finem\ibraries\fpdf\font');
            }
            //$this->Image($_SERVER['DOCUMENT_ROOT'] . '/sistema/images/finem.jpg', 18, 11, 50);
        }
        // Arial bold 15
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        //$this->Ln(25);
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
    
    public function cabeza($exp){
        
        $nombre_alumno = obtener_campo('nombre,nombre_dos,apater,amater.alumno','idalumno.'.$exp['alumno_idalumno'],TRUE);
        $campus = obtener_campo('nombre.campus','idcampus.'.$exp['campus_idcampus']);
        $nombre_padre = '';
        $nombre_madre = '';
        $producto = 'Único';
        $ciclo = obtener_campo('ciclo.ciclo','idciclo.'.$exp['ciclo_idciclo']);
        $matricula = $exp['matricula'];
        if(isset($exp['avales'][0]) && !empty($exp['avales'][0]['nombre'])){
            $nombre_aval1 = $exp['avales'][0]['nombre'].' '.$exp['avales'][0]['nombre_dos'].' '.$exp['avales'][0]['apaterno'].' '.$exp['avales'][0]['amaterno'];
        }else{
            $nombre_aval1 = '-----';
        }
        if(isset($exp['avales'][1]) && !empty($exp['avales'][1]['nombre'])){
            $nombre_aval2 = $exp['avales'][1]['nombre'].' '.$exp['avales'][1]['nombre_dos'].' '.$exp['avales'][1]['apaterno'].' '.$exp['avales'][1]['amaterno'];
        }else{
            $nombre_aval2 = '-----';
        }
        
        $nombre_carrera = obtener_campo('titulo.carrera','idcarrera.'.$exp['especialidad']);
        $nuevo_ingreso = ($exp['ciclo_escolar'] == 1) ? 'SI' : 'NO';
        $financiamiento = obtener_campo('credito_autorizado.analisis','expediente_idexpediente.'.$exp['idexpediente']).'%';
        $identificacion = obtener_campo('oficial.alumno','idalumno.'.$exp['alumno_idalumno']);
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('ESTUDIO SOCIOECONÓMICO'), 0, 0, 'C');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(36, self::entrelineado, utf8_decode('Nombre del Solicitante:'), 'LT', 0, 'L');
        $this->Cell(56, self::entrelineado, utf8_decode($nombre_alumno), 'TR', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Matrícula:'), 'LT', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($matricula), 'TR', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Producto y Ciclo:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($producto.' | '.$ciclo), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Campus:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($campus), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('Nombre de Aval 1:'), 'LB', 0, 'L');
        $this->Cell(66, self::entrelineado, utf8_decode($nombre_aval1), 'RB', 0, 'L');
        $this->Cell(26, self::entrelineado, utf8_decode('Nombre de Aval 2:'), 'LB', 0, 'L');
        $this->Cell(67, self::entrelineado, utf8_decode($nombre_aval2), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(40, self::entrelineado, utf8_decode('Nombre de la Disciplina:'), 'LTB', 0, 'L');
        $this->Cell(145, self::entrelineado, utf8_decode($nombre_carrera), 'TRB', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Nuevo Ingreso:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($nuevo_ingreso), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Periodo Escolar a Cursar:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($ciclo), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Financiamiento Solicitado:'), 'LB', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($financiamiento), 'RB', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Se identifico con:'), 'LB', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($identificacion), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);
    }
    
    public function personal($per){
        $per = formato_correcto($per);
        extract($per);
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('DATOS DEL SOLICITANTE'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(36, self::entrelineado, utf8_decode('Nombre del Solicitante:'), 'LT', 0, 'L');
        $this->Cell(56, self::entrelineado, utf8_decode($nombre), 'TR', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Fecha de Elaboracion:'), 'LT', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($fecha_socioeconomico), 'TR', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Sexo:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($sexo), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Lugar de Financiamiento:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($lugar_finan), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Estado Civil:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($edo_civil), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('RFC:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($rfc), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Régimen:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($regimen), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Edad:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($edad2), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Número de Hermanos:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($num_hermanos), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Dependientes:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($dependientes), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Nombre del Cónyuge:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($nombre_conyuge), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Edades:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($edad_hermanos), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Edad:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($edad), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Fecha de Nacimiento:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($fecha_nac), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'LB', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'RB', 0, 'L');
        $this->Cell(36, self::entrelineado, utf8_decode('Lugar de Nacimiento:'), 'LB', 0, 'L');
        $this->Cell(57, self::entrelineado, utf8_decode($lugar_nac), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(165, self::entrelineado, utf8_decode('SITUACIÓN DE LOS PADRES'), 'B', 0, 'L');
        $this->Cell(20, self::entrelineado, utf8_decode($situacion_padres), 'B', 0, 'R');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(92, self::entrelineado, utf8_decode('Padre'), 1, 0, 'C');
        $this->Cell(93, self::entrelineado, utf8_decode('Madre'), 1, 0, 'C');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Vive:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($vive_padre), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Vive:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($vive_madre), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Trabaja:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($trabaja_padre), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Trabaja:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($trabaja_madre), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('Actividad Principal:'), 'L', 0, 'L');
        $this->Cell(66, self::entrelineado, utf8_decode($actividad_padre), 'R', 0, 'L');
        $this->Cell(26, self::entrelineado, utf8_decode('Actividad Principal:'), 'L', 0, 'L');
        $this->Cell(67, self::entrelineado, utf8_decode($actividad_madre), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Grado Estudios:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($gradoes_padre), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Grado Estudios:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($grado_madre), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('Domicilio'), 1, 0, 'C');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('Calle y Número:'), 'L', 0, 'L');
        $this->Cell(66, self::entrelineado, utf8_decode($calle), 'R', 0, 'L');
        $this->Cell(26, self::entrelineado, utf8_decode('Colonia:'), 'L', 0, 'L');
        $this->Cell(67, self::entrelineado, utf8_decode($colonia), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('Localidad:'), 'L', 0, 'L');
        $this->Cell(66, self::entrelineado, utf8_decode($localidad), 'R', 0, 'L');
        $this->Cell(26, self::entrelineado, utf8_decode('Entre las calles:'), 'L', 0, 'L');
        $this->Cell(67, self::entrelineado, utf8_decode($entre_calles), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Teléfono:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($telefono), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Célular:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($celular), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('E-mail:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($email), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Arraigo:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($arraigo), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('Correspondencia:'), 'L', 0, 'L');
        if(strlen($domicilio_correspondencia) > 40){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(66, self::entrelineado, utf8_decode($domicilio_correspondencia), 'R', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(46, self::entrelineado, utf8_decode('Problema Acceso Vigilancia:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($prob_acceso_vigencia), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Nivel:'), 'LB', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($niv_estudio), 'RB', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Otro:'), 'LB', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($estudio_otro), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('TRABAJO'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(46, self::entrelineado, utf8_decode('¿Trabajas Actualmente?'), 'TL', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($trabaja_act), 'TR', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('¿Trabajas tu Cónyuge?:'), 'TL', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($con_trabajo), 'TR', 0, 'L');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('Nombre Empresa:'), 'L', 0, 'L');
        $this->Cell(66, self::entrelineado, utf8_decode($empresa_dtrabajo), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Empresa:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($tipo_emp), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('Puesto:'), 'L', 0, 'L');
        $this->Cell(66, self::entrelineado, utf8_decode($puesto_dtrabajo), 'R', 0, 'L');
        $this->Cell(26, self::entrelineado, utf8_decode('Nivel:'), 'L', 0, 'L');
        $this->Cell(67, self::entrelineado, utf8_decode($nivel_emp), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(16, self::entrelineado, utf8_decode('Domicilio:'), 'L', 0, 'L');
        $this->Cell(76, self::entrelineado, utf8_decode($dom_dtrabajo), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Arraigo:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($arraigo_emp), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Ingreso Mensual:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_m), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Teléfono:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($tel_emp), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Informante:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($informante), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Ext:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($ext_emp), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Departamento:'), 'L', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($puesto_trabajodep), 'R', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Puesto Específico:'), 'L', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($puest_con), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('Piso:'), 'LB', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode($piso), 'RB', 0, 'L');
        $this->Cell(46, self::entrelineado, utf8_decode('Área:'), 'LB', 0, 'L');
        $this->Cell(47, self::entrelineado, utf8_decode($area_con), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->nueva_hoja();
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('REFERENCIAS PERSONALES'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(60, self::entrelineado, utf8_decode('Nombre'), 1, 0, 'L');
        $this->Cell(35, self::entrelineado, utf8_decode('Teléfono'), 1, 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode('Relación'), 1, 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode('Años de Conocerlo'), 1, 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode('Lo recomienda'), 1, 0, 'L');
        $this->Ln();
        
        if(strlen($nomb_refp) > 25){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(60, self::entrelineado, utf8_decode($nomb_refp), 'LR', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode($tel_refp), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($rel_refp), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($anio_conoc), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($recomendacion), 'LR', 0, 'L');
        $this->Ln();
        
        if(strlen($nomb_refp2) > 25){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(60, self::entrelineado, utf8_decode($nomb_refp2), 'LR', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode($tel_refp2), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($rel_refp2), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($anio_conoc2), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($recomendacion2), 'LR', 0, 'L');
        $this->Ln();
        
        if(strlen($nomb_refp3) > 25){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(60, self::entrelineado, utf8_decode($nomb_refp3), 'LR', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(35, self::entrelineado, utf8_decode($tel_refp3), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($rel_refp3), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($anio_conoc3), 'LR', 0, 'L');
        $this->Cell(30, self::entrelineado, utf8_decode($recomendacion3), 'LR', 0, 'L');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('Comentario:'), 'TLR', 0, 'L');
        $this->Ln();
        $this->MultiCell(185, self::entrelineado, utf8_decode($comentario), 'LBR', 'L');
        $this->Ln(self::un_renglon);
    }
    
    public function familiar($per) {
        $per = formato_correcto($per);
        extract($per);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('ECONOMÍA FAMILIAR'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 3);
        $this->Cell(185, self::entrelineado, utf8_decode('ESTRUCTURA FAMILIAR (HERMANOS QUE DEPENDEN DE LA ECONOMÍA FAMILIAR)'), 'B', 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(50, self::entrelineado, utf8_decode('Nombre'), 'BLT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(10, self::entrelineado, utf8_decode('Edad'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(30, self::entrelineado, utf8_decode('Ocupación'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(30, self::entrelineado, utf8_decode('Grado Escolar'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(30, self::entrelineado, utf8_decode('Escuela*'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(30, self::entrelineado, utf8_decode('% de Beca'), 'RBT', 0, 'L');
        $this->Ln();
        
        if(strlen($nombre_hermano1) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(50, self::entrelineado, utf8_decode($nombre_hermano1), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(10, self::entrelineado, utf8_decode($edad_hermano1), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($ocupacion_hermano1), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($escuela_hermano1), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($grado_hermano1), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($beca_hermano1), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($nombre_hermano2) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(50, self::entrelineado, utf8_decode($nombre_hermano2), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(10, self::entrelineado, utf8_decode($edad_hermano2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($ocupacion_hermano2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($escuela_hermano2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($grado_hermano2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($beca_hermano2), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($nombre_hermano3) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(50, self::entrelineado, utf8_decode($nombre_hermano3), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(10, self::entrelineado, utf8_decode($edad_hermano3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($ocupacion_hermano3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($escuela_hermano3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($grado_hermano3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($beca_hermano3), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($nombre_hermano4) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(50, self::entrelineado, utf8_decode($nombre_hermano4), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(10, self::entrelineado, utf8_decode($edad_hermano4), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($ocupacion_hermano4), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($escuela_hermano4), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($grado_hermano4), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($beca_hermano4), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($nombre_hermano5) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
        }
        $this->Cell(50, self::entrelineado, utf8_decode($nombre_hermano5), 'BL', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(10, self::entrelineado, utf8_decode($edad_hermano5), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($ocupacion_hermano5), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($escuela_hermano5), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($grado_hermano5), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(30, self::entrelineado, utf8_decode($beca_hermano5), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);

        $this->Cell(74, self::entrelineado, utf8_decode('DESCRIPCIÓN'), 'BLT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(36, self::entrelineado, utf8_decode('VALOR APROX.'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(36, self::entrelineado, utf8_decode('PAGADO TOTALMENTE'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0);
        $this->Cell(36, self::entrelineado, utf8_decode('ADEUDO'), 'RBT', 0, 'L');
        $this->Ln();
        $this->Cell(27, self::entrelineado, utf8_decode('AUTOMÓVIL 1'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($descripcion_auto1), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_auto1), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_auto1), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_auto1), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(27, self::entrelineado, utf8_decode('AUTOMÓVIL 2'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($descripcion_auto2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_auto2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_auto2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_auto2), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(27, self::entrelineado, utf8_decode('AUTOMÓVIL 3'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($descripcion_auto3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_auto3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_auto3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_auto3), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(23, self::entrelineado, utf8_decode('COMPUTADORA'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        if(strlen($descripcion_computadora) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(50, self::entrelineado, utf8_decode($descripcion_computadora), '', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_computadora), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_computadora), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_computadora), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(57, self::entrelineado, utf8_decode('LIBROS DE BIBLIOTECA PERSONAL'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(16, self::entrelineado, utf8_decode($descripcion_libro), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_libro), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_libro), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_libro), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(26, self::entrelineado, utf8_decode('MENAJE DE CASA'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        if(strlen($descripcion_mensaje) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(47, self::entrelineado, utf8_decode($descripcion_mensaje), '', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_mensaje), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_mensaje), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_mensaje), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode('OTROS BIENES MUEBLES'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        if(strlen($descripcion_otros) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(36, self::entrelineado, utf8_decode($descripcion_otros), '', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_otros), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_otros), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_otros), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode('BIENES INMUEBLES'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        if(strlen($descripcion_bienesin) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(36, self::entrelineado, utf8_decode($descripcion_bienesin), '', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_bienesin), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_bienesin), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_bienesin), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode('OTROS BIENES INMUEBLES'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($descripcion_otros2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($valoraprox_otros2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pagado_otros2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($adeudo_otros2), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(74, self::entrelineado, utf8_decode('MONTO TOTAL DE LOS BIENES'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Valor Total'), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Adeudo'), 'RB', 0, 'L');
        $this->Ln();
        $this->Cell(74, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($monto_bienes), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($monto_adeudo), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Diferencia'), 'RB', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode(''), 'BL', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode(''), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($monto_diferencia), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 3);
        $this->Cell(185, self::entrelineado, utf8_decode('ACTIVOS FINANCIEROS'), 'B', 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(37, self::entrelineado, utf8_decode('Descripción'), 'LBT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Institución'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Titular'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('No. Cuenta'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Monto (MN)'), 'RBT', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode($activo_descripcion), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($activo_institucion), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        if(strlen($activo_titular) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(36, self::entrelineado, utf8_decode($activo_titular), '', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($activo_cuenta), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($activo_monto), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode($activo_descripcion2), 'BL', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($activo_institucion2), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($activo_titular2), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($activo_cuenta2), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($activo_monto2), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 3);
        $this->Cell(185, self::entrelineado, utf8_decode('SEGUROS'), 'B', 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(61, self::entrelineado, utf8_decode('SEGURO'), 'LBT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode('PRIMA'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode('SUMA ASEGURADA'), 'RBT', 0, 'L');
        $this->Ln();
        $this->Cell(61, self::entrelineado, utf8_decode($seg_seguro), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_prima), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_suma), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(61, self::entrelineado, utf8_decode($seg_seguro2), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_prima2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_suma2), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(61, self::entrelineado, utf8_decode($seg_seguro3), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_prima3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_suma3), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(61, self::entrelineado, utf8_decode($seg_seguro4), 'LB', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_prima4), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(61, self::entrelineado, utf8_decode($seg_suma4), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 3);
        $this->Cell(185, self::entrelineado, utf8_decode('PASIVOS'), 'B', 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(37, self::entrelineado, utf8_decode('Descripción'), 'LBT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Institución'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Titular'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('No. Cuenta'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode('Monto (MN)'), 'RBT', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode($pacivo_descripcion), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_institucion), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        if(strlen($pacivo_titular) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_titular), '', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_cuenta), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_monto), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(37, self::entrelineado, utf8_decode($pacivo_descripcion2), 'BL', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_institucion2), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        if(strlen($pacivo_titular2) > 10){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_titular2), 'B', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_cuenta2), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(36, self::entrelineado, utf8_decode($pacivo_monto2), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);

        $this->nueva_hoja();
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 3);
        $this->Cell(185, self::entrelineado, utf8_decode('INGRESOS FAMILIARES BRUTOS'), 0, 0, 'L');
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('(ÚNICAMENTE PERSONAS QUE CONTRIBUYEN A LA ECONOMÍA FAMILIAR)'), 'B', 0, 'L');
        $this->Ln();

        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(56, self::entrelineado, utf8_decode('Nombre'), 'LBT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode('Parentesco'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode('Concepto'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('$ Mensual'), 'RBT', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre2) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre2), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto2), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual2), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre3) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre3), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto3), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual3), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre4) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre4), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco4), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto4), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual4), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre5) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre5), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco5), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto5), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual5), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre6) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre6), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco6), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto6), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual6), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre7) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre7), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco7), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto7), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual7), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre8) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre8), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco8), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto8), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual8), 'R', 0, 'L');
        $this->Ln();
        
        if(strlen($ingreso_nombre9) > 30){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
        }
        $this->Cell(56, self::entrelineado, utf8_decode($ingreso_nombre9), 'L', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode($ingreso_parentesco9), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($ingreso_consepto9), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_mensual9), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(56, self::entrelineado, utf8_decode(''), 'LB', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(35, self::entrelineado, utf8_decode(''), 'B', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(47, self::entrelineado, utf8_decode('Total de ingresos familiares:'), 'BT', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($ingreso_totalmensual), 'RBT', 0, 'L');
        $this->SetFont(self::tipo_letra, '', self::letra_tamano - 2);
        $this->Ln();
        $this->Cell(185, self::entrelineado, utf8_decode('*Notas:Favor de anexar copia de comprobantes de todos los ingresos detallados.En caso de ser un negocio la principal fuente de ingresos familiar, requerimos fotografías del mismo.'), 0, 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->nueva_hoja();

        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano);
        $this->Cell(46, self::entrelineado, utf8_decode('INTEGRACIÓN DE EGRESOS'), 'LBT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('CONCEPTO'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode('MENSUAL'), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'T', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('ANUAL'), 'RBT', 0, 'L');
        $this->Ln();
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(46, self::entrelineado, utf8_decode('ALIMENTACIÓN'), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode(''), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_alimentacionmens), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_alimentacionanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('SERVICIOS'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('RENTA'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_servrentamens), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_servrentaanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('IMP. PREDIAL'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_servimppredailmens), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_servimppredailanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('AGUA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_servaguamensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_servaguaanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('LUZ'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_servluzmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_servluzanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('GAS'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_servgasmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_servgasanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('TELÉFONO/CELULAR'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_servtelmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_servtelanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('EDUCACIÓN'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('COLEGIATURAS'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_educolegmensual), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_educoleanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('INSCRIPCIONES'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_eduinscripmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_eduinscripanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('CURSOS'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_educursomensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_educursoanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('UTILES ESCOLARES'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_eduutilesmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_eduutilesanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('SEGUROS'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('DE VIDA'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_segurovidamensual), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_segurovidaanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('GASTOS MÉDICOS'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_segurogastomedicomensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_segurogastomedicoanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('DE AUTOMÓVIL'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_seguroautomovilmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_seguroautomovilanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('DE CASA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_seguocasamensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_segurocasaanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('TRANSPORTE'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('TRANSPORTE PÚBLICO'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_transportetransmen), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_transportetransanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('GASOLINA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_transportegasolinamens), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_transportegasolinaanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('VERIFICACIÓN'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_transporteaverificacionmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_transporteverificavionanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('TENENCIA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_transportetenenciamensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_transportetenenciaanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('MTTO. AUTOMÓVIL'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_transportemttoautomensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_transportemttoautoanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('DIVERSIÓN'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('CLUB O DEPORTIVO'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_diversionclubmensual), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_diversionclubanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('DIVERSIÓN'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_diversiondivermensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_diversiondiveranual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('VACACIONES'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_diversionvacacionmensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_diversionvacacionanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('TELEVISIÓN DE PAGA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_diversiontelemensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_diversionteleanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('VESTIDO'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('ROPA Y UNIFORMES'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_vestidoropamensual), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_vestidoropaanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('TINTORERÍA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_vestidotintoreriamensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_vestidotitoreriaanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('OTROS'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('AYUDA DOMÉSTICA'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_otrosayudamensual), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_otrosayudaanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('MANTENIM. CASA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_otrosmentenimensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_otrosmantenimanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('MÉDICOS'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_otrosmedicomensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_otrosmendicoanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('OTROS GASTOS'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_otrosotromensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_otrosotroanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('ADEUDO'), 'LT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('HIPOTECARIO'), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_adeudohipotemensual), 'T', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_adeudohipoteanual), 'RT', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('AUTOMÓVIL'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_adeudoautomensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_adeudoautpanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('TARJETAS DE CRÉDITO'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_adeudotargetamensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_adeudotargetaanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('PRÉSTAMOS PERS.'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_adeudoprestamomensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_adeudoprestamoanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode('COMPUTADORA'), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($integracion_adeudocomputadoramensual), '', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), '', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($integracion_adeudocomputadoraanual), 'R', 0, 'L');
        $this->Ln();
        $this->Cell(46, self::entrelineado, utf8_decode('TOTAL DE EGRESOS'), 'BLT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'BT', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode(''), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(46, self::entrelineado, utf8_decode($totalegreso_mensual), 'BT', 0, 'L');
        $this->Cell(1, self::entrelineado, utf8_decode(''), 'B', 0, '');
        $this->Cell(45, self::entrelineado, utf8_decode($totalegreso_adeudohipoteanual), 'RBT', 0, 'L');
        $this->Ln();
        $this->Ln(self::un_renglon);
    }

    public function padres($per){
        $per = formato_correcto($per);
        extract($per);
        for($j=1; $j < 3; $j++){
            $i = ($j == 1) ? 'padre' : 'madre';
            $tmp = ($i == 'padre') ? 'DEL PADRE' : 'DE LA MADRE';
            $tmp2 = ($i == 'padre') ? 'el padre' : 'la madre';
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
            $this->Cell(165, self::entrelineado, utf8_decode('DATOS '.$tmp), 'B', 0, 'L');
            $this->Cell(20, self::entrelineado, utf8_decode(${'identificacion_'.$i}), 'B', 0, 'R');
            $this->Ln(self::un_renglon);

            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(185, self::entrelineado, utf8_decode('Generales'), 1, 0, 'C');
            $this->Ln();
            $this->Cell(26, self::entrelineado, utf8_decode('Nombre:'), 'L', 0, 'L');
            $this->Cell(66, self::entrelineado, utf8_decode(${"nombre_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Fecha de Nacimiento:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"fecha_nacimiento_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Estado Civil:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"estado_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Lugar de Nacimiento:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"lugar_nacimiento_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Régimen:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"regimen_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('RFC:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"rfc_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Dependientes:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"dependientes_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Edad:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"edad_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(185, self::entrelineado, utf8_decode('Domicilio'), 1, 0, 'C');
            $this->Ln();
            $this->Cell(26, self::entrelineado, utf8_decode('Calle y Número:'), 'L', 0, 'L');
            $this->Cell(66, self::entrelineado, utf8_decode(${"calle_num_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Colonia:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"colonia_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(36, self::entrelineado, utf8_decode('Localidad:'), 'L', 0, 'L');
            $this->Cell(56, self::entrelineado, utf8_decode(${"localidad_" . $i}), 'R', 0, 'L');
            $this->Cell(26, self::entrelineado, utf8_decode('Entre las Calles:'), 'L', 0, 'L');
            $this->Cell(67, self::entrelineado, utf8_decode(${"entre_calles_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Teléfono:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"tel_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Celular:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"celular_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Email:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"email_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Arraigo:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"arraigo_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(26, self::entrelineado, utf8_decode('Correspondencia:'), 'L', 0, 'L');
            if(strlen(${"domicilio_" . $i}) > 40){
                $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
            }
            $this->Cell(66, self::entrelineado, utf8_decode(${"domicilio_" . $i}), 'R', 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(46, self::entrelineado, utf8_decode(''), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(''), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(185, self::entrelineado, utf8_decode('Trabajo'), 1, 0, 'C');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Trabaja '.$tmp2.':'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"trabaja_act_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Empresa:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"tipo_emp_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Nombre de la Empresa:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"empresa_dtrabaja_" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Nivel:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"nivel_emp_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Puesto:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"puesto_dtrabajo_" . $i}), 'R', 0, 'L');
            $this->Cell(26, self::entrelineado, utf8_decode('Arraigo:'), 'L', 0, 'L');
            if(strlen(${"arraigo_emp_" . $i}) > 30){
                $this->SetFont(self::tipo_letra, '', self::letra_tamano-2);
            }
            $this->Cell(67, self::entrelineado, utf8_decode(${"arraigo_emp_" . $i}), 'R', 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Ln();
            
            $this->Cell(16, self::entrelineado, utf8_decode('Domicilio:'), 'L', 0, 'L');
            if(strlen(${"dom_dtrabajo_" . $i}) > 30){
                $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
            }
            $this->Cell(76, self::entrelineado, utf8_decode(${"dom_dtrabajo_" . $i}), 'R', 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(46, self::entrelineado, utf8_decode('Teléfono:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"tel_emp_" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Ingreso Mensual Bruto:'), 'LB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"ingreso_m_" . $i}), 'RB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Informante:'), 'LB', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"informante_" . $i}), 'RB', 0, 'L');
            $this->Ln(self::un_renglon);
        }
    }
    
    public function avales($per){
        $per = formato_correcto($per);
        extract($per);
        
        for($i=1; $i < 3; $i++){
            $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
            $this->Cell(165, self::entrelineado, utf8_decode('DATOS DEL AVAL '.$i), 'B', 0, 'L');
            $this->Cell(20, self::entrelineado, utf8_decode(${"identificacion_aval" . $i}), 'B', 0, 'R');
            $this->Ln(self::un_renglon);
            
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(185, self::entrelineado, utf8_decode('Generales'), 1, 0, 'C');
            $this->Ln();
            $this->Cell(26, self::entrelineado, utf8_decode('Nombre:'), 'L', 0, 'L');
            $this->Cell(66, self::entrelineado, utf8_decode(${"nombre_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Fecha de Nacimiento:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"fecha_nacimiento_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Estado Civil:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"estado_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Lugar de Nacimiento:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"lugar_nacimiento_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Régimen:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"regimen_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('RFC:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"rfc_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Dependientes:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"dependientes_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Edad:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"edad_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(36, self::entrelineado, utf8_decode('Nombre del Cónyuge:'), 'LB', 0, 'L');
            if(strlen(${"nombre_conyuge_aval" . $i}) > 25){
                $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
            }
            $this->Cell(56, self::entrelineado, utf8_decode(${"nombre_conyuge_aval" . $i}), 'RB', 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(46, self::entrelineado, utf8_decode(''), 'LB', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(''), 'RB', 0, 'L');
            $this->Ln();
            $this->Cell(185, self::entrelineado, utf8_decode('Domicilio'), 1, 0, 'C');
            $this->Ln();
            $this->Cell(16, self::entrelineado, utf8_decode('Calle y No.:'), 'L', 0, 'L');
            $this->Cell(76, self::entrelineado, utf8_decode(${"calle_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Colonia:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"colonia_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(36, self::entrelineado, utf8_decode('Municipio o Delegación:'), 'L', 0, 'L');
            $this->Cell(56, self::entrelineado, utf8_decode(${"municipio_aval" . $i}), 'R', 0, 'L');
            $this->Cell(26, self::entrelineado, utf8_decode('Entre las Calles:'), 'L', 0, 'L');
            $this->Cell(67, self::entrelineado, utf8_decode(${"entre_calles_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('CP:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"cp_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Estado:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"domestado_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Teléfono:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"tel_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Celular:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"celular_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Email:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"email_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Arraigo:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"arraigo_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(26, self::entrelineado, utf8_decode('Correspondencia:'), 'L', 0, 'L');
            if(strlen(${"domicilio_aval" . $i}) > 30){
                $this->SetFont(self::tipo_letra, '', self::letra_tamano-3);
            }
            $this->Cell(66, self::entrelineado, utf8_decode(${"domicilio_aval" . $i}), 'R', 0, 'L');
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(46, self::entrelineado, utf8_decode('Problema de Acceso:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"problema_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Relación con el Solicitante:'), 'LB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"relacion_aval" . $i}), 'RB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(''), 'LB', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(''), 'RB', 0, 'L');
            $this->Ln();
            $this->Cell(185, self::entrelineado, utf8_decode('Trabajo'), 1, 0, 'C');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Trabaja el Aval:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"trabaja_act_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Empresa:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"tipo_emp_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(36, self::entrelineado, utf8_decode('Nombre de la Empresa:'), 'L', 0, 'L');
            $this->Cell(56, self::entrelineado, utf8_decode(${"empresa_dtrabajo_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Nivel:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"nivel_emp_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Puesto Específico:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"puesto_dtrabajo_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Arraigo:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"arraigo_emp_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(16, self::entrelineado, utf8_decode('Domicilio:'), 'L', 0, 'L');
            $this->Cell(76, self::entrelineado, utf8_decode(${"dom_dtrabajo_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Teléfono:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"tel_emp_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Ingreso Mensual Bruto:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"ingreso_m_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Estensiones:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"ext_emp_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Informante:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"verificacion_aval" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Área:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"area_emp_aval" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Piso:'), 'LB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"piso_avaltra" . $i}), 'RB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Departamento'), 'LB', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"departamento_emp_aval" . $i}), 'RB', 0, 'L');
            $this->Ln();
            $this->Cell(92, self::entrelineado, utf8_decode('Respaldo Automóvil '.$i), 1, 0, 'C');
            $this->Cell(93, self::entrelineado, utf8_decode('Respaldo Inmueble '.$i), 1, 0, 'C');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('No. de Serie:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_noserie" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Domicilio:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_domicilio" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Número de Factura:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_nofactura" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Superficie del Terreno:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_superficie" . $i}.' m²'), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Marca:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_marca" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Construcción:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_construccion" . $i}.' m²'), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Tipo:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_notipo" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Edo. de Conservación:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_edodeconservacion" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Modelo:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_modelo" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Registro Público:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_registro" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Placas:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_placas" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Gravámenes:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_gravamenes" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Aseguradora:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_aseguradora" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Acreedor:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_acredor" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Cobertura:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_cobertura" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Propietario:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_propietario" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Valor Comercial:'), 'L', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_valor" . $i}), 'R', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Valor Comercial:'), 'L', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_valor" . $i}), 'R', 0, 'L');
            $this->Ln();
            $this->Cell(46, self::entrelineado, utf8_decode('Adeudo Actual:'), 'LB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode(${"respaldoau_adeudo" . $i}), 'RB', 0, 'L');
            $this->Cell(46, self::entrelineado, utf8_decode('Adeudo Actual:'), 'LB', 0, 'L');
            $this->Cell(47, self::entrelineado, utf8_decode(${"respaldoin_acuerdo" . $i}), 'RB', 0, 'L');
            $this->Ln(self::un_renglon);
            
            if($i == 1){
                $this->nueva_hoja();
            }
        }
        
        $this->Cell(185, self::entrelineado, utf8_decode('Comentario:'), 'TLR', 0, 'L');
        $this->Ln();
        $this->MultiCell(185, self::entrelineado, utf8_decode($comentario), 'LBR', 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('INVESTIGADOR'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(61, self::entrelineado, utf8_decode('Nombre(s)'), 1, 0, 'C');
        $this->Cell(61, self::entrelineado, utf8_decode('Apellido Paterno'), 1, 0, 'C');
        $this->Cell(62, self::entrelineado, utf8_decode('Apellido Materno'), 1, 0, 'C');
        $this->Ln();
        $this->Cell(61, self::entrelineado, utf8_decode($nombre_investigador), 'LB', 0, 'L');
        $this->Cell(61, self::entrelineado, utf8_decode($apellidop_investigador), 'RLB', 0, 'L');
        $this->Cell(62, self::entrelineado, utf8_decode($apellidom_investigador), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);
            
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('RESPONSABLE DE LA AGENCIA'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        
        $this->SetFont(self::tipo_letra, '', self::letra_tamano);
        $this->Cell(61, self::entrelineado, utf8_decode('Nombre(s)'), 1, 0, 'C');
        $this->Cell(61, self::entrelineado, utf8_decode('Apellido Paterno'), 1, 0, 'C');
        $this->Cell(62, self::entrelineado, utf8_decode('Apellido Materno'), 1, 0, 'C');
        $this->Ln();
        $this->Cell(61, self::entrelineado, utf8_decode($nombre_respagencia), 'LB', 0, 'L');
        $this->Cell(61, self::entrelineado, utf8_decode($apellidop_respagencia), 'RLB', 0, 'L');
        $this->Cell(62, self::entrelineado, utf8_decode($apellidom_respagencia), 'RB', 0, 'L');
        $this->Ln(self::un_renglon);
        
    }
    
    public function fotos($per){
        
        extract($per);
        $this->nueva_hoja();
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('FOTOS'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        
        for($i=1; $i<8; $i++){
            $this->SetFont(self::tipo_letra, '', self::letra_tamano);
            $this->Cell(185, self::entrelineado, utf8_decode(${"des".$i}), 1, 0, 'C');
            $this->Ln();
            $this->Image($_SERVER['DOCUMENT_ROOT'].'/sistema/uploads/investigacion/'.$expediente_idexpediente.'/'.${"foto".$i});
            $this->Ln(self::un_renglon);
            
            if($i == 2 || $i == 4){
                $this->nueva_hoja();
            }
        }
        
        $this->SetFont(self::tipo_letra, 'B', self::letra_tamano + 5);
        $this->Cell(185, self::entrelineado, utf8_decode('MAPAS'), 'B', 0, 'L');
        $this->Ln(self::un_renglon);
        
        
    }
    
}

/* End of file contrato_pdf.php */
/* Location: ./application/libraries/contrato_pdf.php */