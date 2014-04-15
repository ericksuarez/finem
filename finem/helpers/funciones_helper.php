<?php

function elige_menor($a, $b) {
    if ($a < $b) {
        return $a;
    } else {
        return $b;
    }
}

/**
 * 
 * @param string $posicion_post Posición del arreglo post
 * @param string $posicion_arreglo Posición del arreglo a comparar
 * @param string $arreglo Arreglo a comparar
 * @return string
 */
function repoblar_texto($posicion_post, $posicion_arreglo, $arreglo) {
    $respuesta = '';
    if (empty($_POST[$posicion_post])) {
        if (isset($arreglo[$posicion_arreglo])) {
            //$respuesta = $arreglo[$posisicon_arreglo];
            $respuesta = $arreglo[$posicion_arreglo];
            $test = valida_fechas($respuesta,'unix');
            if($test === TRUE){
                //echo 'volteado';
                $respuesta = fecha_contrato($respuesta,'inverso');
            }
            if($arreglo[$posicion_arreglo] == '0000-00-00'){
                $respuesta = '';
            }
            
        } else {
            $respuesta = '';
        }
        
    } else {
        $tmp = set_value($posicion_post);
        if ($tmp == '0000-00-00') {
            $respuesta = '';
        } else {
            $respuesta = set_value($posicion_post);
        }
        
    }
    
    //echo $respuesta;
    
    return $respuesta;
}

/**
 * 
 * @param string $posicion_post posición del arreglo POST
 * @param string $valor_option valor original del option
 * @param string $valor_compare Valor a comparar si post no esta vacío
 * @return string
 */
function repoblar_select($posicion_post, $valor_option, $valor_compare) {

    if (empty($_POST[$posicion_post])) {
        if ($valor_compare == $valor_option) {
            $respuesta = 'selected="selected"';
        } else {
            //$respuesta = set_select($posicion_post, $valor_option);
        }
    } else {
        if ($_POST[$posicion_post] == $valor_option) {
            $respuesta = 'selected="selected"';
        } else {
            $respuesta = '';
        }
    }
    return $respuesta;
}

/**
 * 
 * @param string $posicion_post Posicion del POST
 * @param string $valor_radio Valor original del radio button
 * @param string $valor_compare Valor a comparar
 * @return string
 */
function repoblar_radio($posicion_post, $valor_radio, $valor_compare) {

    if (empty($_POST[$posicion_post])) {
        if ($valor_compare == $valor_radio) {
            $respuesta = 'checked="checked"';
        } else {
            $respuesta = set_radio($posicion_post, $valor_radio);
        }
    } else {
        if ($_POST[$posicion_post] == $valor_radio) {
            $respuesta = 'checked="checked"';
        } else {
            $respuesta = '';
        }
    }

    return $respuesta;
}

function config_paginacion($con_query=FALSE) {
    if($con_query == TRUE){
        $config['full_tag_open'] = '<div class="pagination"><ul class="con-query">';
    }else{
        $config['full_tag_open'] = '<div class="pagination"><ul>';
    }
    
    $config['full_tag_close'] = '</ul></div>';
    $config['first_link'] = '<i class="icon icon-double-angle-left"></i>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = '<i class="icon icon-double-angle-right"></i>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['prev_link'] = '<i class="icon icon-angle-left"></i>';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '<i class="icon icon-angle-right"></i>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    return $config;
}

/**
 * Regresa un valor de la base de datos.
 * 
 * @param string $seleccionar Campo a seleccionar y la tabla de donde sacarlo separados por un punto (campo.tabla)
 * @param string $encontrar Campo que debe coincidir para que el row sea el necesario separados por un punto (primarykey.valor)
 * @param boolean $advanced Si esta en TRUE quiere decir que concatenerá. La estructura de $seleccionar será similar a (campo1,campo2,campo3.tabla)
 * @return string Valor de la base.
 */
function obtener_campo($seleccionar, $encontrar, $advanced = FALSE) {
    $a = explode('.', $seleccionar);
    $b = explode('.', $encontrar);

    $CI = & get_instance();
    $CI->db->select($a[0]);
    $q = $CI->db->get_where($a[1], array($b[0] => $b[1]));
    if ($advanced == TRUE) {
        $ax = explode(',', $a[0]);
        $cont = count($ax);
        $string = '';
        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            for ($i = 0; $i < $cont; $i++) {
                $string .= $tmp[0][$ax[$i]] . ' ';
            }
            return $string;
        } else {
            return '---';
        }
    } else {


        if ($q->num_rows() > 0) {
            $tmp = $q->result_array();
            return $tmp[0][$a[0]];
        } else {
            return '---';
        }
    }
}

function calcula_edad($fecha) {
    //$fecha = '1989-09-18';
    //echo $fecha;
    if ($fecha == '0000-00-00' || $fecha == NULL) {
        $resta = '';
    } else {
        $anio1 = date('Y', strtotime($fecha));
        $mes1 = date('m', strtotime($fecha));
        $dia1 = date('d', strtotime($fecha));
        $anio2 = date('Y');
        $mes2 = date('m');
        $dia2 = date('d');

        $resta = $anio2 - $anio1;

        if ($mes2 < $mes1) {
            $resta = $resta - 1;
        } elseif (($mes2 == $mes1) && ($dia2 < $dia1)) {

            $resta = $resta - 1;
        } else {
            $resta = $resta;
        }
    }


    return $resta;
}

function convierte_numero($datos, $posiciones = FALSE, $decimales = 2) {

    if (is_array($datos) AND count($datos)) {

        if (is_array($posiciones) AND count($posiciones) > 0) {

            $result = $datos;
            foreach ($posiciones as $posicion) {

                if (isset($datos[$posicion]) AND !empty($datos[$posicion])) {
                    $result[$posicion] = number_format($datos[$posicion], $decimales);
                }
            }
        } else {

            foreach ($datos as $key => $value) {
                if (!empty($value)) {
                    $result[$key] = number_format($value, $decimales);
                }
            }
        }
        return $result;
    } else {

        return number_format($datos, $decimales);
    }
}

/**
 * Limpia las posiciones necesarias de un arreglo, quitándole caracteres (, $ %).
 * 
 * @param array $data Arreglo con datos
 * @param array $arrMoneda Arreglo con las posiciones que queremos que limpie de arreglo $data
 * @return array
 */
function limpia_moneda($data, $arrMoneda = FALSE) {

    $result = FALSE;
    $arrayMoneda = array('$', ',', '%');

    if (is_array($data) AND count($data) > 0 AND is_array($arrMoneda) AND count($arrMoneda) > 0) {

        $result = $data;
        foreach ($arrMoneda as $posicion) {
            $result[$posicion] = str_replace($arrayMoneda, '', $data[$posicion]);
        }
    } else {

        $result = str_replace($arrayMoneda, '', $data);
    }
    return $result;
}

/**
 * Escapa los valores de un arreglo.
 * 
 * @param array $array Arreglo a escapar.
 * @return boolean
 */
function array_escape_string($array) {
    $result = FALSE;
    if (is_array($array) AND count($array) > 0) {
        foreach ($array as $llave => $valor) {
            $result[$llave] = mysql_real_escape_string($valor);
        }
    }
    return $result;
}

/**
 * Cambia la llave de un arreglo.
 * 
 * @param array $array Arreglo que se cambiarán sus llaves.
 * @param array $columnas Arreglo que contiene las viejas y nuevas llaves.
 *      $columnas = array(nueva_llave => vieja_llave)
 * @param boolean $inverso Sirve para usar la vieja como nuevay viceversa.
 * @return array
 */
function cambia_llaves($array, $columnas,$inverso = FALSE) {

    $result = FALSE;
    if (is_array($columnas) AND count($columnas) > 1) {
        foreach ($columnas as $new_col => $old_col) {
            if($inverso == TRUE){
                $test = valida_fechas($array[$new_col], 'esp');
                $result[$old_col] = ($test == TRUE) ? fecha_contrato($array[$new_col],'inverso') : $array[$new_col];
            }else{
                $result[$new_col] = $array[$old_col];
            }
            
        }
    }
    return $result;
}

function construye_arreglo_string_contador($max_val, $string_ini = '', $string_fin = '') {

    $result = FALSE;
    if (!empty($max_val)) {

        for ($i = 1; $i <= $max_val; $i++) {

            $string = '';

            if (!empty($string_ini)) {
                $string = $string_ini . ' ';
            }
            $string .= $i;
            if (!empty($string_fin)) {
                $string .= ' ' . $string_fin;
            }
            $result[$i] = $string;
        }
    }
    return $result;
}

function nuevo_arreglo_from_db($datos, $llave, $valor) {
    $result = FALSE;
    if (is_array($datos) AND count($datos) > 0 AND !empty($llave) AND !empty($valor)) {
        foreach ($datos as $key => $arreglo) {
            $result[$arreglo[$llave]] = $arreglo[$valor];
        }
    }
    return $result;
}

/**
 * Formatea una fecha a tres formatos específicos.
 * 
 * @param type $fecha Fecha en formato UNIX
 * @param type $tipo Tipo de formato (completo|inverso|abreviado)
 * @return string Regresa la fecha formateada.
 */
function fecha_contrato($fecha, $tipo = 'completo') {
    $string = FALSE;
    $meses = array(
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    );


    if (!empty($fecha)) {
        $parts = explode('-', $fecha);

        if ($tipo == 'completo') {
            $string = $parts[2] . ' de ' . $meses[$parts[1]] . ' de ' . $parts[0];
        } elseif ($tipo == 'abreviado') {
            $string = $parts[2] . ' ' . $meses[$parts[1]] . ' ' . $parts[0];
        } elseif ($tipo == 'inverso') {
            $string = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        } else {
            $string = 'ERROR';
        }
    }



    return $string;
}

function formato_numerico($arreglo) {
    $nuevo = false;
    if (is_array($arreglo)) {
        foreach ($arreglo as $k => $a) {
            if (is_array($a)) {
                $nuevo[$k] = formato_numerico($a);
            } else {
                if (is_numeric($a) && !is_int($a)) {
                    $nuevo[$k] = number_format($a, 2);
                } else {
                    echo $k;
                    $nuevo[$k] = $a;
                }
            }
        }
    }

    return $nuevo;
}

/**
 * Valida el formato de una fecha en español o en unix.
 * 
 * @param string $str Cadena a validar
 * @param string $tipo (unix|esp) Para unix el formato es 'aaaa-mm-dd' y para esp es 'dd-mm-aaaa'
 * @return boolean
 */
function valida_fechas($str,$tipo = 'esp') {
    //$str = trim($str);
    //echo $str;
    if($tipo == 'esp'){
        $preg = '/^(0[1-9]|[12][0-9]|3[01])[\/|\-](0[1-9]|10|1[12])[\/|\-](([0-9]{2,2})|([0-9]{4,4}))$/';
    }elseif($tipo == 'unix'){
        $preg = '/^(([0-9]{4,4}))[\-](0[1-9]|10|1[12])[\-](0[1-9]|[12][0-9]|3[01])$/';
    }else{
        return FALSE;
    }
    
    if (preg_match($preg, $str)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function resta_fechas($mayor,$menor){
    //$mayor = '2013-05-09';
    //$menor = '2013-09-01';
    $a = explode('-',$mayor);
    $b = explode('-',$menor);
    
    $c = $a[1] - $b[1];
    
    //$meses = (abs($c)) / 60 / 24;
    $meses = abs($c);
    return $meses;
}

function resta_dias($mayor, $menor) {
    $now = strtotime($mayor); // or your date as well
    $your_date = strtotime($menor);
    $datediff = $now - $your_date;
    
    return floor($datediff / (60 * 60 * 24));
}

function formato_correcto($arreglo){
    
    $data = NULL;
    
    foreach($arreglo as $k => $a){
        $data[$k] = $a;
        $test = valida_fechas($a,'unix');
        if($test == TRUE){
            $data[$k] = fecha_contrato($a);
        }
        $test = valida_doubles($a);
        if($test == TRUE){
            $data[$k] = '$'.number_format($a,2);
        }
    }
    
    return $data;
}

function valida_doubles($str) {
    
    $preg = '/^([0-9])+(\.[0-9]{2})$/';
    
    
    if (preg_match($preg, $str)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function menor_en_arreglo($numero,$arreglo){
    $menor = FALSE;
    if(is_array($arreglo)){
        foreach($arreglo as $a){
            if($numero <= $a){
                
                $menor = TRUE;
            }
        }
    }
    
    return $menor;
}

function mapaGoogleStatic($coords){
    echo '<img src="http://maps.googleapis.com/maps/api/staticmap?center='.$coords['c1'].','.$coords['c2'].'&zoom=15&size=400x400&sensor=false&markers=color:red%7Clabel:XX%7C'.$coords['c1'].','.$coords['c2'].'" />';
}

?>
