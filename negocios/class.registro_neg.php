<?php

include_once 'C:\xampp\htdocs\Proyecto_Junji\datos\class.registro_sql.php';

class registro_neg {

    //Variables Clase
    private $parametros;
    private $registro_sql;
    private $resultado;
    private $filas;

    //Variables Tabla
    private $codigo;
    private $fecha;
    private $item;
    private $unidad;
    private $entrada;
    private $salida;
    private $entregado_a;
    private $jardin;
    private $observaciones;
    private $n_registro;

	public function registro_neg() {}

	public function ObtieneXPks_neg($p_codigo){
	  $this->parametros=get_defined_vars();

    $this->registro_sql=new registro_sql();
		$this->resultado=$this->registro_sql->ObtieneXPks($this->parametros);
	}

  public function ObtieneTodos_neg(){
	  $this->parametros=get_defined_vars();

    $this->registro_sql=new registro_sql();
		$this->resultado=$this->registro_sql->ObtieneTodos($this->parametros);
	}

	public function InsertarRegistros_neg($p_codigo,$p_fecha,$p_item,$p_unidad,$p_entrada,$p_salida,$p_entregado_a,$p_jardin,$p_observaciones,$p_n_registro){
	  $this->parametros=get_defined_vars();

    $this->registro_sql=new registro_sql();
		$this->resultado=$this->registro_sql->InsertarRegistros($this->parametros);
	}

  public function ActualizarRegistros_neg($p_codigo,$p_fecha,$p_item,$p_unidad,$p_entrada,$p_salida,$p_entregado_a,$p_jardin,$p_observaciones,$p_n_registro){
	  $this->parametros=get_defined_vars();

    $this->registro_sql=new registro_sql();
		$this->resultado=$this->registro_sql->ActualizarRegistros($this->parametros);
	}

  public function EliminarRegistros_neg($p_codigo){
	  $this->parametros=get_defined_vars();

    $this->registro_sql=new registro_sql();
		$this->resultado=$this->registro_sql->EliminarRegistros($this->parametros);
	}

  public function getFilas(){
		$this->filas=count($this->resultado);
		return $this->filas;
	}	

  public function getSet($filas=0){

    if($this->getFilas()>0){
        $this->codigo				        = $this->resultado[$filas]['codigo'];
        $this->fecha      		      = $this->resultado[$filas]['fecha'];
        $this->item      		        = $this->resultado[$filas]['item'];
        $this->unidad      		      = $this->resultado[$filas]['unidad'];
        $this->entrada      		    = $this->resultado[$filas]['entrada'];
        $this->salida      		      = $this->resultado[$filas]['salida'];
        $this->entregado_a          = $this->resultado[$filas]['entregado_a'];
        $this->jardin      		      = $this->resultado[$filas]['jardin'];
        $this->observaciones        = $this->resultado[$filas]['observaciones'];
        $this->n_registro      		  = $this->resultado[$filas]['n_registro'];				
    }

  }

  public function getCodigo(){
		return $this->codigo;
	}
  public function getFecha(){
		return $this->fecha;
	}
  public function getItem(){
		return $this->item;
	}
  public function getUnidad(){
		return $this->unidad;
	}
  public function getEntrada(){
		return $this->entrada;
	}
  public function getSalida(){
		return $this->salida;
	}
  public function getEntregado_a(){
		return $this->entregado_a;
	}
  public function getJardin(){
		return $this->jardin;
	}
  public function getObservaciones(){
		return $this->observaciones;
	}
  public function getN_registro(){
		return $this->n_registro;
	}
}


?>