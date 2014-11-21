<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuestionario extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$data =  array(); // salida de datos a las views
		$this -> load -> helper('form');
		$this -> load -> helper('date');
		
	}
	
	
	
	public function index()
	{
		$session_id = $this -> session -> userdata('logged_in'); // Variable de sesión iniciada 
		$data['title'] = 'Bienvenidos al cuestionario XXXX';
		$data['solotest'] 	= 1;
		$data['nosession'] = '';
        $this -> load -> helper('form'); // Carga de helper para formulario (inputs, etc)
        		
		if(!$session_id)
        {
        	$data['nosession'] = 1;
		}
		
			// 
		$this -> load -> view('assets/header', $data);	

        if($session_id)
        {
                $this -> load -> model('elcuestionario'); // Carga del modelo listado de temas
                			$datestring = "%Y-%m-%d %H:%i";
			$time = time();
			$data['fecha'] = mdate($datestring, $time);
			$fecha = mdate($datestring, $time);
                // $fecha = @date(Y.'-'.m.'-'-d); // Fecha de HOY
                // Método del modelo cuestionario que actualiza la fecha de login del usuario registrado
				// $this -> load -> view('lobby', $data); //Cargamos el mensaje de error en la vista.
				redirect('cuestionario/lobby', 'refresh');

        }
        else
        {
            $this -> load -> view('welcome_message');
        }
			
		
		$this->load->view('assets/footer');
	}
	
	public function lobby()
	{
		// echo 'Lobby';
		$session_id = $this -> session -> userdata('logged_in'); // Variable de sesión iniciada
		$data['title'] = 'Bienvenidos al cuestionario XXXX';
		$data['nosession'] = '';
		$data['solotest'] 	= 0;
        $this -> load -> helper('form'); // Carga de helper para formulario (inputs, etc)
        $data['modulo_correspondiente']		= $session_id['modulo']; /* Modulo que le toca responder a cada usuario */
		// $idUsuario 							= $data['id'];
		$modulo 							= $data['modulo_correspondiente'];
		
		// echo $modulo;
        
        		
		if(!$session_id)
        {
        	$data['nosession'] = 1;
		}
		
			// 
		$this -> load -> view('assets/header', $data);	

        if($session_id)
        {
        	$this -> load -> model('elcuestionario');
			// echo 'Controlador LOBBY';
			/*
			print_r($session_id);
			echo $session_id['id'];
			 *  [id] => 1 [nombre] => Nestor Velazquez [num_promotor] => 00000001 
			*/
			$data['nombre'] 		= $session_id['nombre'];
			$data['id'] 			= $session_id['id'];
			$data['num_promotor']	= $session_id['num_promotor'];
			$idUsuario 				= $data['id']; 
			$result = $this -> elcuestionario -> cuentaIntentos($idUsuario, $modulo);
			
			// print_r($result);
			/*
			 *  [intentosCuestionario] => 0 [intentosRespuestas] => 0
			 */
			
			if($result['intentosCuestionario'] == 0 && $result['intentosRespuestas'] == 0)
			{
				$data['intentos'] = 0;
			}
			else
			{
				$data['intentos'] = 1;
			}
			
			$this -> load -> view('lobby', $data); //Cargamos el mensaje de error en la vista.
		}
		else
		{
			$this -> load -> view('welcome_message');
		}
		$this->load->view('assets/footer');
	}

	public function test()
	{
		// echo 'El TEST COMIENZA';
		$this -> load -> model('elcuestionario');
		$session_id = $this -> session -> userdata('logged_in'); // Variable de sesión iniciada
		
		$data['title'] = 'CUESTIONARIO XXXXX';
		$data['nosession'] = '';
        $this -> load -> helper('form'); // Carga de helper para formulario (inputs, etc)
        $data['tiempo'] = '30:00';
		
		$data['nombre'] 					= $session_id['nombre'];
		$data['id'] 						= $session_id['id'];
		$data['num_promotor']				= $session_id['num_promotor'];
		$data['modulo_correspondiente']		= $session_id['modulo']; /* Modulo que le toca responder a cada usuario */
		$idUsuario 							= $data['id'];
		$modulo 							= $data['modulo_correspondiente'];
		
		// echo $modulo;
		
		
		
			$datestring = "%Y-%m-%d %H:%i";
			$time = time();
			$data['fecha'] = mdate($datestring, $time);
			$fecha = mdate($datestring, $time);
		
		
		$idUsuario						= $session_id['id']; 
		$result = $this -> elcuestionario -> cuentaIntentos($idUsuario, $modulo);
			
			// print_r($result);
			/*
			 *  [intentosCuestionario] => 0 [intentosRespuestas] => 0
			 */
			
		if($result['intentosCuestionario'] == 0 && $result['intentosRespuestas'] == 0)
		{
			$data['intentos'] = 0;
			$data['solotest'] 	= 1;
		}
		else
		{
			$data['intentos'] = 1;
			$data['solotest'] 	= 0;
		}
        		
		if(!$session_id)
        {
        	$data['nosession'] 	= 1;
		}
		
			// 
		$this -> load -> view('assets/header', $data);	

        if($session_id)
        {
        	$this -> load -> model('elcuestionario');
			// echo 'Controlador LOBBY';
			/*
			print_r($session_id);
			echo $session_id['id'];
			 *  [id] => 1 [nombre] => Nestor Velazquez [num_promotor] => 00000001 
			*/

			
			
			
			
			$idUsuario 				= $data['id']; 
			$result = $this -> elcuestionario -> cuentaIntentos($idUsuario, $modulo);
			
			// print_r($result);
			/*
			 *  [intentosCuestionario] => 0 [intentosRespuestas] => 0
			 */
			 

			// echo mdate($datestring, $time);

			
			if($result['intentosCuestionario'] == 0 && $result['intentosRespuestas'] == 0)
			{
				$mdlrst = $this -> elcuestionario -> modulo($modulo);
				// Nombre del modulo para $data 
				// $data['modulon'] = $mdlrst['nombre_modulo'];
				$moduloDatos = array(); 
				foreach($mdlrst as $row)
				{
					$moduloDatos['nombre_modulo'] = $row -> nombre_modulo; 
					$moduloDatos['id'] = $row -> id;
				}
				
				$data['modulo'] = $moduloDatos['nombre_modulo'];
				$data['modulo_id'] = $moduloDatos['id'];  
				
				$preguntas = $this -> elcuestionario -> lasPreguntas($modulo);
				
				$listaPreguntas = array();
				foreach($preguntas  as $rpw)
				{
					 $listaPreguntas[$rpw -> id] = $rpw -> pregunta;
				}
				
				$data['lasPreguntas'] = $listaPreguntas;
				
				/*
				echo '<pre>';
				print_r($listaPreguntas);
				echo '</pre>';
				 * 
				 */

				
				$this -> load -> view('test', $data);
			}
			else
			{
				$this -> load -> view('lobby', $data); //Cargamos el mensaje de error en la vista.
			}
			

			
			
		
		}
		else
		{
			$this -> load -> view('welcome_message');
		}
		$this->load->view('assets/footer');
		
		
		// echo $fecha;
	}


	function t7q4eq43w073w5qw()
	{
		
		$session_id = $this -> session -> userdata('logged_in'); // Variable de sesión iniciada
 		
		$data['nombre'] 					= $session_id['nombre'];
		$data['id'] 						= $session_id['id'];
		$data['num_promotor']				= $session_id['num_promotor'];
		$data['modulo_correspondiente']		= $session_id['modulo']; /* El modulo que le toca responder a cada usuario */
		$idUsuario 							= $data['id'];
		$modulo 							= $data['modulo_correspondiente'];
		$respuestasRespondidas = array();
		$rsptslmpr = array();
		$losDatos = $this -> input -> post('todos');		
		$rsptslmpr = json_decode($losDatos); 
		$this -> load -> model('elcuestionario');
		
		$idPreguntaRespondida 	= '';
		$elModuloInsert			= '';
		$respuestaInsert		= '';
		$fecha					= '';
		$ussid					= '';
		
		$datestring = "%Y-%m-%d %H:%i";
		$time = time();
		$data['fecha'] = mdate($datestring, $time);
		$fecha = mdate($datestring, $time);
		 
		$incompletas = 0;
		
		// echo 'La fecha' . $fecha . '<br/>';
		
		foreach($rsptslmpr as $primerpaso => $primervalor)
		{
			// echo $primervalor . '<br/>';
			foreach($primervalor as $clave => $valor)
			{
				// echo 'bucle: ' . $clave . ': ';
				foreach($valor as $aeds => $asd)
				{
					
					// echo $aeds. ' > ';
					$campo = explode('_', $aeds);
					// echo $campo[0] . $campo[1] . '=>';
					
					switch($campo[0])
					{
						case 'respuesta':
							// echo 'La respuesta: <strong>' . $asd . '</strong> RESPUESTA ID >' . $campo[1] . '<br/>';

							$idPreguntaRespondida 	= $campo[1];

							if($asd == '')
							{
								$respuestaInsert	= ' NO CONTESTO <br/>';
								$incompletas ++;
							}
							else
							{
								$respuestaInsert		= $asd;
							}
							// echo  '<br/>';

							
							if($respuestaInsert != '' && $idPreguntaRespondida != '')
							{ 
								 $respuestasRespondidas[]['respuestas'] = array(
								 					'respuesta' 			=> $respuestaInsert, 
								 					'respuesta_fecha' 		=> $fecha, 
													'usuarios_id' 			=> $ussid,
													'preguntas_id' 			=> $idPreguntaRespondida,
													'preguntas_modulos_id' 	=> $elModuloInsert 
													);
							}
							
							
							
						break;
						
						case 'modulo':

							$elModuloInsert = $asd;
							$totalPorModulo = $this -> elcuestionario -> cuentaPeeguntas($asd);
							$moduluco			= $this -> elcuestionario -> modulo($asd);
							
							foreach($moduluco as $mdls => $uyg)
							{
								foreach($uyg as $qwerty => $qwoi)
								{
									// echo $qwerty . ' => ' . $qwoi . '<br/>';
									// nombre_modulo => El modulo
									if($qwerty == 'nombre_modulo')
									{
										$texto_modulo = $qwoi; 
									}
									
								}
							}
							foreach($totalPorModulo[0] as $ttlpgrts): $cuantasPorModulo = $ttlpgrts; endforeach;
							// $respuestasRespondidas[]['preguntas_modulos_id'] 	= $elModuloInsert;

						break;
						
						case 'usuario':
							$ussid = $asd;
							// $respuestasRespondidas[]['usuarios_id'] 			= $ussid;
						break;
						
						case 'tiempo':
							$tiempo_asignado = $asd;
						break; 
						case 'TIME':
						 	if($asd == 'true')
							{
								$tiempo = 'SE LE TERMINÓ EL TIEMPO';
							}
						break;
					}
				}
			}

			// echo 'ESTO SOLO PASA EN TIME OUT'; 
			$prgs = 'Preguntas por modulo: ' . $cuantasPorModulo . ' incompletas por intento: ' . $incompletas . '<br/>';

			if($incompletas == 0 ) {
				$terminado = ' contestó el total de las preguntas asignadas al modulo: ' . $texto_modulo;
				$terminadonm = 1;
			}
			else
			{
				$terminado = ' no contestó el total de las preguntas asignadas al modulo: ' . $texto_modulo;
				$terminadonm = 0;
			}
			
			$observaciones = 'El promotor: ' . $data['nombre'] . $terminado . ' en el tiempo asignado de ' . $tiempo_asignado . '<br/>' . $prgs; 
			
			// echo $observaciones;
			$insertaTimeOut = array('observaciones' => $observaciones, 'terminado' => $terminadonm, 'fecha_contestado' => $fecha, 'usuarios_id' => $ussid, 'modulo' => $modulo);
			$this -> elcuestionario -> guardaElCuestionarioPorUsuario($insertaTimeOut);
			
		}

		 $this -> elcuestionario -> guardaLasRespuestas($respuestasRespondidas);
		 // redirect('cuestionario/lobby', 'refresh');
		 
		 $cambiaModulo = $modulo+1;
		 
		 $this -> elcuestionario -> actualizaUsuarioModulo($idUsuario, $cambiaModulo);
		 
		 
		 }
}

?>