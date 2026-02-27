<?php

class Datos extends Conectar{
    private $bd;
  
    public function __construct(){
        //para que se ejecute la conexion
        $this->bd = parent::conectar();
        parent::setNames();
    }

    public function getDatos($sql,$params = []){
        
       $datos = $this->bd->prepare($sql);
       $datos->execute($params);

       return $datos->fetchAll();
    }

    public function getDato($sql, $param)
  {

    $datos = $this->bd->prepare($sql);
    //ejecuta la consulta sql que se le pasa por parametro
    $datos->execute($param);

    return $datos->fetch();
    
  }

  public function setDato($sql, $params = [])
  {

    $datos = $this->bd->prepare($sql);
    //ejecuta la consulta sql que se le pasa por parametro
    $datos->execute($params);
    //return $this->bd->lastInsertId() el ultimo id que se ingreso;
  }
}