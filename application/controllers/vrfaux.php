<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vrfaux extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$data =  array(); // salida de datos a las views
		$this -> load -> helper('form');
		$this->load->library('form_validation');

	}
	
	
	public function chkLgn()
	{
		$session_id = $this -> session -> userdata('logged_in'); // Variable de sesión iniciada
   		$this -> load -> model('login'); // Cargamos el modelo login
   		$data = array();
		$data['title'] = 'VERIFICA EMAIL';
		
		
		if(!$session_id)
        {
        	$data['nosession'] = 1;
		}
		
		if($this -> input -> post('emailio')) //recibimos vía post email de usuarios
		{ // Verificamos si llega mediante post el username

			$rules = array(
      			array('field'=>'emailio','label'=>'emailio','rules'=>'required')
      		);//Reglas de validación en este caso solo es requerido que los campos tengan contenido
 
      		$this -> form_validation -> set_rules($rules); // Establecemos las reglas de validacion

			if($this -> form_validation->run() == FALSE)
			{
				//Si la informacion no fue correctamente enviada
				// $this -> load -> view('cuestionario/index'); //Carga la vista de login
				
				$data['error'] = 'email incorrecto';
				
				$this -> load -> view('assets/header', $data);
				$this -> load -> view('welcome_message');
				$this->load->view('assets/footer');
			}
			else
			{
				$username = $this -> input -> post('emailio');
				// $password = $this -> input -> post('password');
				$result = $this -> login -> verifica($username);
				//Llamamos a la función login dentro del modelo common mandando los argumentos password y username
	 
				if($result)
				{ //login exitoso
					$sess_array = array();
					foreach($result as $row)
					{
	 
						$sess_array = array(
									/* DATOS QUE YA VIENEN DE LA BASE */
									 'id' 				=> $row -> id,
									 'nombre' 			=> $row -> nombre,
									 'num_promotor'		=> $row -> num_promotor,
									 'email'			=> $row -> email, 
									 'modulo'			=> $row -> modulo_correspondiente /* El modulo que le toca responder por cada sesión */
									 
						);
	 
						$this -> session -> set_userdata('logged_in', $sess_array); //Iniciamos una sesión con los datos obtenidos de la base.
	            	}
					$id 	= $sess_array['id'];
					
					// echo unix_to_human($now); // U.S. time, no seconds
					
					
					$datestring = "%Y-%m-%d %H:%i";
					$time = time();
					$fch = mdate($datestring, $time);
					
					
					$this -> login -> upFecha($fch, $id);
					redirect('cuestionario/lobby', 'refresh');

				}
				else
				{ // La validación falla
					$this -> load -> view('assets/header', $data);
					// echo 'ERROR EN EL QUERY';
					$data['error'] = 'email no registrado.'; //Error que será enviado a la vista en forma de arreglo
					$this -> load -> view('welcome_message', $data); //Cargamos el mensaje de error en la vista.
					$this->load->view('assets/footer');
	         	}
	      	}
	   }
	   else
	   {
	      // $this -> load -> view('cuestionario/index');
	      // echo 'Primer validación';
		  // echo $this -> input -> post('emailio');
		  
			$this -> load -> view('assets/header', $data);
			// echo 'ERROR EN EL QUERY';
			$data['error'] = 'email no registrado.'; //Error que será enviado a la vista en forma de arreglo
			$this -> load -> view('welcome_message', $data); //Cargamos el mensaje de error en la vista.
			$this->load->view('assets/footer');
		   
	   }
		   
	}

}