<?php

abstract class Conectar{
    private $conexion;
    private $host = 'localhost';

    private $dbname='gestion_bodegas';
    private $username = 'postgres';
    private $password = 'a1b2c3d4e5';

     public function conectar(){
    try {
        //conexion a la base de datos
        $this->conexion = new PDO("pgsql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
        //establecer atributos de la conexion
        //para que lance excepciones en caso de error
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
    } catch (PDOException $e) {
        die("Error en la conexión: ". $e->getMessage());
    }

    return $this->conexion;
  }

  //para evitar problemas de caracteres especiales 
  public function setNames(){
    return $this->conexion->query("SET NAMES 'utf8'");
  }


}