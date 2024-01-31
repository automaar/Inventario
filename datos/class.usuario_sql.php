<?php

include_once 'class.bd_sql.php';

class usuario_sql {
	public function usuario_sql() {}
	
	public function ObtieneXPks($p_parametros) {
		$query='select correo,nombre,cargo,establecimiento,funcionario,pass
				from usuario 
				where correo = :v_correo;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;

	}

	public function ObtieneTodos($p_parametros) {
		$query='select correo,nombre,cargo,establecimiento,funcionario,pass
				from usuario;';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;
	}

	public function ValidaClave($p_parametros) {
		$query='select correo,nombre,cargo,establecimiento,funcionario,pass
				from usuario
				where (correo = :v_correo)
				and pass=:v_pass';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;
	}

	public function InsertarRegistros($p_parametros) {
		$query='insert into usuario
				(correo,nombre,cargo,establecimiento,funcionario,pass)
				values
				(:v_correo,:v_nombre,:v_cargo,:v_establecimiento,:v_funcionario,:v_pass);';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}

	public function ActualizarRegistros($p_parametros) {
		$query='update usuario 
				set nombre=:v_nombre,cargo=:v_cargo,establecimiento=:v_establecimiento,funcionario=:v_funcionario,pass=:v_pass
				where correo=:v_correo;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}

	public function EliminarRegistros($p_parametros) {
		$query='delete from usuario 
				where correo=:v_correo;';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}
}
?>