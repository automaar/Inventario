<?php

include_once 'class.bd_sql.php';

class  materiales_sql {

	public function materiales_sql() {}
	
	public function ObtieneXPks($p_parametros) {

		$query='select codigo,item,unidad,stok_minimo,stok,requerimiento 
				from materiales 
				where codigo = :v_codigo;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;
	}

	public function ObtieneTodos($p_parametros) {

		$query='select codigo,item,unidad,stok_minimo,stok,requerimiento 
				from materiales;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;
	}

	public function InsertarRegistros($p_parametros) {

		$query='insert into materiales 
				(codigo,item,unidad,stok_minimo,stok,requerimiento )
				values
				(:v_codigo,:v_item,:v_unidad,:v_stok_minimo,:v_stok,:v_requerimiento);';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}
	public function ActualizarRegistros($p_parametros) {

		$query='update materiales
				set item=:v_item,unidad=:v_unidad,stok_minimo=:v_stok_minimo,stok=:v_stok,requerimiento=:v_requerimiento
				where codigo=:v_codigo;';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}

	public function EliminarRegistros($p_parametros) {

		$query='delete from materiales 
				where codigo=:v_codigo;';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}


}


?>