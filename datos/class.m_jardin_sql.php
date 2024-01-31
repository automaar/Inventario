<?php

include_once 'class.bd_sql.php';

class  m_jardin_sql {

	public function m_jardin_sql() {}
	
	public function ObtieneXPks($p_parametros) {

		$query='select codigo,item,unidad,stok_minimo,stok,requerimiento 
				from m_jardin 
				where codigo = :v_codigo;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;

	}

	public function ObtieneTodos($p_parametros) {

		$query='select codigo,item,unidad,stok_minimo,stok,requerimiento 
				from m_jardin;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;
	}

	public function InsertarRegistros($p_parametros) {

		$query='insert into m_jardin 
				(codigo,item,unidad,stok_minimo,stok,requerimiento)
				values
				(:v_codigo,:v_item,:v_unidad,:v_stok_minimo,:v_stok,:v_requerimiento);';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}
	public function ActualizarRegistros($p_parametros) {

		$query='update m_jardin  
				set codigo=:v_codigo,item=:v_item,unidad=:v_unidad,stok_minimo=:v_stok_minimo,stok=:v_stok,requerimiento=:v_requerimiento
				where codigo=:v_codigo;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}

	public function EliminarRegistros($p_parametros) {

		$query='delete from m_jardin   
				where codigo=:v_codigo;';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}


}


?>