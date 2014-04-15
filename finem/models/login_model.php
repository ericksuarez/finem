<?php class Login_model extends CI_Model {

	function checkLogin(){
                $userold = FALSE;
                if(isset($_SESSION['login']) && isset($_SESSION['clave'])){
                    $userold = TRUE;
                }
                //print_r($_SESSION);
                //echo $userold;
                $user = $this->phpsession->get('user','finem');
                
                //print_r($user);
                if((empty($user)) && ($userold == FALSE) ){
                    //$this->phpsession->flashsave('returnurl',current_url());
                    redirect('login');
                    //redirect('http://www.finemsist.com');
                }else{
                    //print_r($_SERVER);
                    if ($_SERVER['SERVER_NAME'] == 'localhost') {                        
                        $post['user'] = $user['login'];
                        $post['pass'] = $user['clave'];
                    
                    } else {
                        if($userold== FALSE){
                            $post['user'] = $user['login'];
                            $post['pass'] = $user['clave'];
                        }else{
                            $post['user'] = $_SESSION['login'];
                            $post['pass'] = $_SESSION['clave'];
                        }
                        
                        
                        //print_r($post);
                    }
                    $this->entrar($post);
                }  
                
		
		
	}

	function checkUser($user,$pass){
		$regreso = FALSE;
		
		$q = $this->db->get_where('usuario',array('login'=>$user,'activo'=>'SI','clave'=>$pass,'permiso_idpermiso !=' => 0));
                
                
		if($q->num_rows() > 0){
			$regreso = TRUE;
		}else{
			$regreso = FALSE;
		}

		return $regreso;
	}

	function getUser($user,$pass){
		$user = 0;
		$this->db->select('*, idusuario AS id_user');
		$q = $this->db->get_where('usuario',array('login'=>$user,'clave'=>$pass));
		if($q->num_rows() > 0){
                    $r = $q->result_array();
                    $user = $r[0];
		}

		return $user;
	}

	function entrar($post){
            //print_r($post);
		$q = $this->checkUser($post['user'],$post['pass']);
                
                
		if($q == TRUE){
                         
			$user = $this->getUser($post['user'],$post['pass']);
                        //print_r($user);
			if(is_array($user)){
				$this->phpsession->save('user',$user,'finem');
			}else{
				//La busqueda en base de datos no regreso ningun user
                                $this->phpsession->flashkeep('returnurl');
				$this->phpsession->flashsave('error','Ocurrió un error al ingresar al sistema. #1');
				redirect('login');
			}
			
		}else{
                        //echo $this->db->last_query();
			//El username y el password no coinciden como combinación O ha sido desactivado.
                        //Esta sucediendo seguido cuando entran del viejo sistema por que cambiaron su clave.
                        $this->phpsession->flashkeep('returnurl');
			$this->phpsession->flashsave('error','Ocurrió un error al ingresar al sistema. #2');
			redirect('login');
		}
	}
        
        function redirige(){
            $user = $this->phpsession->get('user','finem');
            $return = '';
            //$return = $this->phpsession->flashget('returnurl');
            //echo $return;
            if(!empty($return)){
                redirect($return);
            }else{
                if($user['agencia_idagencia'] != 0){
                    redirect('investigacion/lista');
                }elseif($user['permiso_idpermiso'] == 10){
                    redirect('layout/cobranza/insoluto');
                }elseif($user['permiso_idpermiso'] == 6){
                    redirect('layout/cobranza/adeudo');
                }elseif($user['permiso_idpermiso'] == 5){
                    redirect('reporte/mesa');
                }else{
                    redirect('expediente/lista');
                }
            }
            
            
        }
        
        
	
}