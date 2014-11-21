<?php
class Login extends CI_Model 
{
         function verifica($eemailio)         
         {
         	    $this -> db -> select('*');
                $this -> db -> from('usuarios');
 
                $this -> db -> where("email = '" . $eemailio ."'");
                $this -> db -> limit(1);
 
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
		 
		function upFecha($fecha, $id)
		{
			$data = array(
			               'fecha_login' => $fecha
			            );
			
			$this->db->where('id', $id);
			$this->db->update('usuarios', $data); 
		}
}
