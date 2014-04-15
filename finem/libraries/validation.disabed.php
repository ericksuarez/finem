<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	function __construct()
	{
	    parent::__construct();
	}

	protected $CI;
	protected $_field_data			= array();
	protected $_config_rules		= array();
	protected $_error_array			= array();
	protected $_error_messages		= array();
	protected $_error_prefix		= '<p>';
	protected $_error_suffix		= '</p>';
	protected $error_string			= '';
	protected $_safe_form_data		= FALSE;

    public function set_checkbox($field = '', $value = '', $default = FALSE,$advanced = FALSE,$key='')
	{
		

		

		$field = $this->_field_data[$field]['postdata'];

		print_r($field);

		if (is_array($field))
		{ //echo '<br>**********'.$advanced;
			if($advanced === FALSE){

				if ( ! in_array($value, $field))
				{
					return '';
				}else{
					return ' data-href="not array"';
				}

			}else{
				if(isset($field[$key])){
					return 'data-href="fieldkey"';
				}else{
					return '';
				}
				/*foreach($field as $key1=>$val){
					if($key1==$key && $val==$value){
						return 'checked="checked"';
					}else{
						return '';
					}
				}*/
			}
			
			
		}
		else
		{
			if (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
			return ' data-href="elsearray"';
		}

		return ' data-href="last"';
	}
}


