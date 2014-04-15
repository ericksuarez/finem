<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
        
        public function renombrar_folders($foo=''){
            $target = 'uploads/'.$foo;
            $scan = scandir($target);
            
            print_r($scan);
            echo '<br />';
            foreach($scan as $s){
                $this->db->select('idexpediente');
                $q = $this->db->get_where('expediente',array('matricula' => $s));
                
                if($q->num_rows() > 0){
                    echo 'renombrar_'.$s.'<br />';
                    $tmp = $q->result_array();
                    rename($target.'/'.$s,$target.'/'.$tmp[0]['idexpediente']);
                }
            }
        }
        
        public function tabla(){
            $reglas = $this->config->item('inv_familiarex1');
            //print_r($reglas);
            $arreglo = FALSE;
            $cont = 1;
            $fila = 0;
            unset($reglas['terminado']);
            foreach($reglas as $k => $v){
                $arreglo[$fila][$cont] = array(
                    'labelto' => $k,
                    'campelto' => $v
                );
                
                $cont++;
                
                if($cont == 3){
                    $cont = 1;
                    $fila++;
                }
            }
            
            print_r($arreglo);
            $string = '<table style="text-align:center" width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <th scope="col">INTEGRACIÓN DE EGRESOS</th>
            <th scope="col">CONCEPTO</th>
            <th scope="col">MENSUAL</th>
            <th scope="col">ANUAL</th>
        </tr>
        ';
            foreach($arreglo as $a){
                $string .= '<tr>
            <td> <p> ------ </p></td>
            <td>&nbsp;</td>
            <td>
                <label class="control-label" for="'.$a[1]['labelto'].'"></label>

                <div class="input-prepend">
                    <span class="add-on">$</span>
                    <input name="'.$a[1]['labelto'].'" class="input-small money suma" data-sumar="mensual" value="<?php echo repoblar_texto("'.$a[1]['labelto'].'", "'.$a[1]['campelto'].'", $info);?>" id="'.$a[1]['labelto'].'" type="text" placeholder="0.00" />
                </div>

            </td>
            <td><label class="control-label" for="'.$a[2]['labelto'].'"></label>
                <div class="input-prepend">
                    <span class="add-on">$</span>
                    <input name="'.$a[2]['labelto'].'" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("'.$a[2]['labelto'].'", "'.$a[2]['campelto'].'", $info);?>" id="'.$a[2]['labelto'].'" type="text" placeholder="0.00" />
                </div></td>
        </tr>
        ';
            }
            
            $string .= '</table>';
            ?>
            <pre> <?php echo htmlentities($string);?> </pre>
            
            <?php
        }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */?>