<?php

require ('../config/conectar.php');
require ('../config/datos.php');

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

    // 1️⃣ Insertar bodega
    $sql = "INSERT INTO bodegas 
            (codigo_bodega, nombre_bodega, direccion_bodega, dotacion)
            VALUES (?,?,?,?)";

    $params = [$codigo, $nombre, $direccion, $dotacion];

    // Aquí obtenemos el ID recién creado
    $idBodega = $d->setDato($sql, $params);

    // 2️⃣ Insertar en tabla intermedia
    $sql2 = "INSERT INTO bodega_encargado (bodega_id, encargado_id)
             VALUES (?,?)";

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