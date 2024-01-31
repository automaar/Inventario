<?php

class bd_sql {
	public function bd_sql() {} 

	public function conexion(){

		$this->host='localhost';
		$this->user='root';
		$this->pass='';
		$this->BD='inventario_junji';
		$this->error=null;

		try {
			$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->BD, $this->user, $this->pass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			$this->error='Conexión Fallida: '.$e->getMessage().' Linea: '.__LINE__;
		}
	}

	public function ejecutar_query($p_query,$p_parametros){
		try {
			$this->ejec_query=$this->conn->prepare($p_query);
			
			foreach($p_parametros as $key => $val) {
				$key='$'.$key;
	
				if(is_bool($val)){
					$val_type = PDO::PARAM_BOOL;
				}elseif(is_int($val)){
					$val_type = PDO::PARAM_INT;
				}else{
					$val_type = PDO::PARAM_STR;
				}
				$this->ejec_query->bindParam(str_replace('$p',':v',$key), $val, $val_type);
				unset($key);
				unset($val);
				unset($val_type);
			}
			
			$this->ejec_query->execute();
			$this->resultado = $this->ejec_query->fetchAll(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			$this->error='Error Query: '.$e->getMessage().' Linea: '.__LINE__;
		}
	}
}
?>