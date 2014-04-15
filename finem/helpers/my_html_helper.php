<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('crea_selects')) {

    /**
     * CREA EL HTML DE UN SELECT POR MEDIO DE VARIABLES DE CONFIGURACION.
     * 
     * @param array $select Arreglo que contiene en el key el value que tendrá el option y en 
     *      el val el texto que será visible para el usuario.
     * @param string $selectName Nombre que recibirá el select
     * @param array $selected El id que se ha elegido.
     * @param string $propertySelect Clases, id, complementos del select (opcional)     
     * @param string $posCero Value que queremos que tenga el primer valor (opcional), default 0
     * @param string $valCero Texto visible al usuario, default -
     * @param string $optGroup Texto que queremos que tenga el optgroup, default vacio
     * @return string
     */
    function crea_selects($select, $selectName, $selected, $propertySelect = '', $posCero = '', $valCero = ' - ', $optGroup = '') {
        
        $result = FALSE;
        if (is_array($select) AND count($select) > 0) {
            
            $result = '<select name="' . $selectName . '" ' . $propertySelect . '>';

            $result .= '<option value="' . $posCero . '"> ' .
                    $valCero .
                    ' </option>';            

            if (!empty($optGroup)) {

                $result .= '<optgroup label="' . $optGroup . '">';
            }

            foreach ($select as $key => $val) {

                $check = '';
                if ($selected == $key) {
                    $check = 'selected="selected"';
                }
                $result .= '<option value="' . $key . '" ' . $check . '>' .
                        $val .
                        '</option>';
            }
            
            if($optGroup != '') {
                
                $result .= '<optgroup/>';
            }
            
            $result .= '</select>'; 
        }
        return $result;
    }
}

/* End of file html_helper.php */
/* Location: ./application/helpers/html_helper.php */
