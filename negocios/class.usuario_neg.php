<?php
include_once 'C:\xampp\htdocs\Proyecto_Junji\datos\class.usuario_sql.php';

class usuario_neg {
    private $parametros;
    private $usuario_sql;
    private $resultado;
    private $filas;

    private $correo;
    private $nombre;
    private $cargo;
    private $establecimiento;
    private $funcionario;
    private $pass;

	public function usuario_neg() {}

	public function ObtieneXPks_neg($p_correo){
	  $this->parametros=get_defined_vars();

    $this->usuario_sql=new usuario_sql();
		$this->resultado=$this->usuario_sql->ObtieneXPks($this->parametros);
	}

  public function ObtieneTodos_neg(){
	  $this->parametros=get_defined_vars();

    $this->usuario_sql=new usuario_sql();
		$this->resultado=$this->usuario_sql->ObtieneTodos($this->parametros);
	}

  public function ValidaClave_neg($p_correo,$p_pass){
    $this->parametros=get_defined_vars();

    $this->usuario_sql=new usuario_sql();
    $this->resultado=$this->usuario_sql->ValidaClave($this->parametros);
  }

	public function InsertarRegistros_neg($p_correo,$p_nombre,$p_cargo,$p_establecimiento,$p_funcionario,$p_pass){
	  $this->parametros=get_defined_vars();

    $this->usuario_sql=new usuario_sql();
		$this->resultado=$this->usuario_sql->InsertarRegistros($this->parametros);
	}

  public function ActualizarRegistros_neg($p_correo,$p_nombre,$p_cargo,$p_establecimiento,$p_funcionario,$p_pass){
	  $this->parametros=get_defined_vars();

    $this->usuario_sql=new usuario_sql();
		$this->resultado=$this->usuario_sql->ActualizarRegistros($this->parametros);
	}

  public function EliminarRegistros_neg($p_correo){
	  $this->parametros=get_defined_vars();

    $this->usuario_sql=new usuario_sql();
		$this->resultado=$this->usuario_sql->EliminarRegistros($this->parametros);
	}

  public function getFilas(){
		$this->filas=count($this->resultado);
		return $this->filas;
	}	

  public function getSet($filas=0){
    if($this->getFilas()>0){
        $this->correo				        = $this->resultado[$filas]['correo'];
        $this->nombre      		      = $this->resultado[$filas]['nombre'];
        $this->cargo      		      = $this->resultado[$filas]['cargo'];
        $this->establecimiento      = $this->resultado[$filas]['establecimiento'];
        $this->funcionario      		= $this->resultado[$filas]['funcionario'];
        $this->pass      		        = $this->resultado[$filas]['pass'];
    }
  }

  public function getCorreo(){
		return $this->correo;
	}
  public function getNombre(){
		return $this->nombre;
	}
  public function getCargo(){
		return $this->cargo;
	}
  public function getEstablecimiento(){
		return $this->establecimiento;
	}
  public function getFuncionario(){
    return $this->funcionario;
  }  
  public function getPass(){
		return $this->pass;
	}   
}



?>