<?php
class Elcuestionario extends CI_Model
{
	function cuentaIntentos($idUsuario, $modulo)
	{
		// echo 'cuenta Intentos';

		$this-> db -> count_all_results('cuestionario_status');
		$this -> db -> WHERE('usuarios_id', $idUsuario);
		$this -> db -> WHERE('modulo' , $modulo);
		$this -> db -> from('cuestionario_status');
		$cuentaIntentosStatus = $this -> db -> count_all_results();


		
		
		
		
		
		
		$this-> db -> count_all_results('respuestas');
		// Produces an integer, like 25
		
		$this -> db -> WHERE('usuarios_id', $idUsuario);
		$this -> db -> WHERE('preguntas_modulos_id' , $modulo);
		$this -> db -> from('respuestas');
		$cuentaIntentosRespuestas = $this -> db -> count_all_results();

		/*
		echo $cuentaIntentosRespuestas;
		echo $cuentaIntentosStatus;
		 * 
		 */
		
		$intentos = array('intentosCuestionario' => $cuentaIntentosRespuestas, 'intentosRespuestas' => $cuentaIntentosStatus);
		
		// print_r($intentos);
		
		return $intentos;
	}
	
	function cuentaPeeguntas($moduloId)
	{
		$query = $this -> db -> query("SELECT count(*) AS 'total_preguntas' FROM modulos m, preguntas p WHERE (m.id = p.modulos_id AND m.id = " . $moduloId . ") having count(*)>=1");
		// $query = $this -> db -> get();
		if($query -> num_rows() == 1)
        {
        	$rsltd = $query -> result();
        }
		
		return $rsltd;
	}
	
	function modulo($modulo)
	{
		$this -> db -> select('*');
		$this -> db -> from('modulos');
		$this -> db -> where("id = '" . $modulo ."'");
		
		$query = $this -> db -> get();
				
 
        if($query -> num_rows() == 1)
        {
                return $query -> result();
        }
        else
        {
                return false;
        }

	}
	
	// Listado de preguntas SOLO PREGUNTAS -> ALEATORIAS ...
	function lasPreguntas($modulo)
	{

		$this->db->order_by('id', 'RANDOM');
		$this -> db -> select('*');
		$this -> db -> from('preguntas');
		$this -> db -> where("modulos_id = '" . $modulo ."'");
		
		$query = $this -> db -> get();
				
 
        if($query -> num_rows() >= 1)
        {
                return $query -> result();
        }
        else
        {
                return false;
        }
	}
	
	function guardaElCuestionarioPorUsuario($datotes)
	{
		/*
		 * Aquí se hace el insert en cuestionario_status así se sabe que un usuario ya intentó contestar un modulo. 
		 */
		 $this->db->insert('cuestionario_status', $datotes); 
	}
	
	function guardaLasRespuestas($respuestasRespondidas)
	{
		foreach($respuestasRespondidas as $cfef => $poikm)
		{
			// echo $cfef . ' ' . $poikm . '<br/>';
			foreach($poikm as $qwep => $hgfd)
			{
				// echo $qwep . ' => ' . $hgfd . '<br/>';
				$this -> db -> insert('respuestas', $hgfd);
			}
		}
	}
	
	function actualizaUsuarioModulo($idUsuario, $cambiaModulo)
	{
		
		// echo 'El id del usuario a cambiar: ' . $ussid . ' || El nuevo modulo del usuario' . $cambiaModulo;
		
		$data = array('modulo_correspondiente' => $cambiaModulo);
		$this -> db -> WHERE('id', $idUsuario); 
		$this -> db -> update('usuarios', $data);
		
		
	}
}
?>