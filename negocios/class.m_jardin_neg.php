<?php

include_once 'C:\xampp\htdocs\Proyecto_Junji\datos\class.m_jardin_sql.php';

class m_jardin_neg {

    //Variables Clase
    private $parametros;
    private $materiales_sql;
    private $resultado;
    private $filas;

    //Variables Tabla
    private $codigo;
    private $item;
    private $unidad;
    private $stok_minimo;
    private $stok;
    private $requerimiento;

	public function m_jardin_neg() {}

	public function ObtieneXPks_neg($p_codigo){
	  $this->parametros=get_defined_vars();

    $this->m_jardin_sql=new m_jardin_sql();
		$this->resultado=$this->m_jardin_sql->ObtieneXPks($this->parametros);
	}

  public function ObtieneTodos_neg(){
	  $this->parametros=get_defined_vars();

    $this->m_jardin_sql=new m_jardin_sql();
		$this->resultado=$this->m_jardin_sql->ObtieneTodos($this->parametros);
	}

	public function InsertarRegistros_neg($p_codigo,$p_item,$p_unidad,$p_stok_minimo,$p_stok,$p_requerimiento){
	  $this->parametros=get_defined_vars();

    $this->m_jardin_sql=new m_jardin_sql();
		$this->resultado=$this->m_jardin_sql->InsertarRegistros($this->parametros);
	}

  public function ActualizarRegistros_neg($p_codigo,$p_item,$p_unidad,$p_stok_minimo,$p_stok,$p_requerimiento){
	  $this->parametros=get_defined_vars();

    $this->m_jardin_sql=new m_jardin_sql();
		$this->resultado=$this->m_jardin_sql->ActualizarRegistros($this->parametros);
	}

  public function EliminarRegistros_neg($p_codigo){
	  $this->parametros=get_defined_vars();

    $this->m_jardin_sql=new m_jardin_sql();
		$this->resultado=$this->m_jardin_sql->EliminarRegistros($this->parametros);
	}

  public function getFilas(){
		$this->filas=count($this->resultado);
		return $this->filas;
	}	

  public function getSet($filas=0){

    if($this->getFilas()>0){
        $this->codigo				      = $this->resultado[$filas]['codigo'];
        $this->item      		      = $this->resultado[$filas]['item'];
        $this->unidad      		    = $this->resultado[$filas]['unidad'];
        $this->stok_minimo        = $this->resultado[$filas]['stok_minimo'];
        $this->stok      		      = $this->resultado[$filas]['stok'];
        $this->requerimiento      = $this->resultado[$filas]['requerimiento'];			
    }

  }

  public function getCodigo(){
		return $this->codigo;
	}
  public function getItem(){
		return $this->item;
	}
  public function getUnidad(){
		return $this->unidad;
	}
  public function getStok_minimo(){
		return $this->stok_minimo;
	}
  public function getStok(){
		return $this->stok;
	}
  public function getRequerimiento(){
		return $this->requerimiento;
	}

   
}


?>