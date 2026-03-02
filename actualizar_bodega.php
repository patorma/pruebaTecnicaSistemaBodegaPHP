<?php

require('config/conectar.php');
require('config/datos.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$d = new Datos();
$pdo = $d->conectar();

$id = $_POST['id_bodega'] ?? null;
$codigo_bodega = $_POST['codigo_bodega'];
$nombre = trim($_POST['nombre_bodega'] ?? '');
$direccion = trim($_POST['direccion_bodega'] ?? '');
$dotacion = $_POST['dotacion'] ?? null;
$estado = $_POST['estado'] ?? null;
$encargados = $_POST['encargados'] ?? [];
// echo "<pre>";
// var_dump($_POST);
// exit;
// Validaciones de los campos

if(!$id || !is_numeric($id)){
    die("ID inválido");
}

if(strlen($codigo_bodega) > 5){
     echo "<span style='color:red;'>Código inválido debe ser de 5 caracteres</span>";
        exit;
}

if($nombre == '' || strlen($nombre) > 100){
    die("Nombre inválido");
}

if($direccion == ''){
    die("Dirección obligatoria");
}

if(!is_numeric($dotacion) || $dotacion <= 0){
    die("Dotación inválida");
}
$estado = strtolower(trim($_POST['estado'] ?? ''));
if(!in_array($estado,['activada','desactivada'])){
    die("Estado inválido");
}

if(empty($encargados)){
    die("Debe asignar al menos un encargado");
}

// TRANSACCIÓN

try{

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        UPDATE bodegas
        SET nombre_bodega=?, direccion_bodega=?, dotacion=?, estado=?
        WHERE id_bodega=?
    ");

    $stmt->execute([$nombre,$direccion,$dotacion,$estado,$id]);

    // eliminar relaciones anteriores
    $stmt = $pdo->prepare("DELETE FROM bodega_encargado WHERE bodega_id=?");
    $stmt->execute([$id]);

    // insertar nuevas relaciones con encargado
    $stmt = $pdo->prepare("INSERT INTO bodega_encargado (bodega_id, encargado_id) VALUES (?,?)");

    foreach($encargados as $enc){
        $stmt->execute([$id,$enc]);
    }

    $pdo->commit();

    header("Location: index.php?exito=Actualizado correctamente");

}catch(Exception $e){

    $pdo->rollBack();
    echo "<pre>";
    echo $e->getMessage();
    echo "</pre>";
    exit;
}