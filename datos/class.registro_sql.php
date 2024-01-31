<?php

include_once 'class.bd_sql.php';

class registro_sql {

	public function registro_sql() {}
	
	public function ObtieneXPks($p_parametros) {

		$query='select codigo,date_format(fecha,"%d/%m/%Y")fecha,item,unidad,entrada,salida,entregado_a,jardin,observaciones,n_registro 
				from registro 
				where codigo = :v_codigo ;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;

	}

	public function ObtieneTodos($p_parametros) {

		$query='select codigo,date_format(fecha,"%d/%m/%Y")fecha,item,unidad,entrada,salida,entregado_a,jardin,observaciones,n_registro 
				from registro;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
		return $this->ob_bd->resultado;
	}

	public function InsertarRegistros($p_parametros) {

		$query='insert into registro 
				(codigo,fecha,item,unidad,entrada,salida,entregado_a,jardin,observaciones,n_registro )
				values
				(:v_codigo,:v_fecha,:v_item,:v_unidad,:v_entrada,:v_salida,:v_entregado_a,:v_jardin,:v_observaciones,:v_n_registro );';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}

	public function ActualizarRegistros($p_parametros) {

		$query='update registro
				set fecha=:v_fecha,item=:v_item,unidad=:v_unidad,entrada=:v_entrada,salida=:v_salida,entregado_a=:v_entregado_a,jardin=:v_jardin,observaciones=:v_observaciones,n_registro=:v_n_registro
				where codigo=:v_codigo;';	
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}

	public function EliminarRegistros($p_parametros) {

		$query='delete from registro 
				where codigo=:v_codigo;';
		
		$this->ob_bd=new bd_sql();
		$this->ob_bd->conexion();
		$this->ob_bd->ejecutar_query($query,$p_parametros);
	}


}


?>