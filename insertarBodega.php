<?php

require ('config/conectar.php');
require ('config/datos.php');

header("Content-Type: application/json");

try {

    $d = new Datos();

    if(!isset($_POST['codigo_bodega'])){
        throw new Exception("Datos no enviados.");
    }

    $codigo = trim($_POST['codigo_bodega']);
    $nombre = trim($_POST['nombre_bodega']);
    $direccion = trim($_POST['direccion_bodega']);
    $dotacion = (int) $_POST['dotacion'];
    $encargados = $_POST['encargados'] ?? [];

    if(strlen($codigo) > 5 || strlen($nombre) > 100 || 
       $dotacion <= 0 || count($encargados) < 1){
        throw new Exception("Datos inválidos.");
    }

    // Primero se inserta en bodega
    $sql = "INSERT INTO bodegas 
            (codigo_bodega, nombre_bodega, direccion_bodega, dotacion)
            VALUES (?,?,?,?)";

    $params = [$codigo, $nombre, $direccion, $dotacion];

    // Luego se obtiene el id del  último registro insertado
    $idBodega = $d->setDato($sql, $params);

    // con el id del encargado más el id de la bodega id obtenida
    //en la linea de código anterior se inserta esos datos en la tabla
    //intermedia de bodega_encrgado
    $sql2 = "INSERT INTO bodega_encargado (bodega_id, encargado_id)
             VALUES (?,?)";
//se recorre el arreglo de los encargados  para insertar los parametros en php
//que vienen del formulario
    foreach($encargados as $idEncargado){
        $d->setDato($sql2, [$idBodega, $idEncargado]);
    }

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Bodega registrada correctamente"
    ]);

} catch(Exception $e){

    echo json_encode([
        "estado" => "error",
        "mensaje" => $e->getMessage()
    ]);
}