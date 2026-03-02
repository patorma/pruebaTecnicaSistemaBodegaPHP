<?php
require('config/conectar.php');
require('config/datos.php');

header('Content-Type: application/json');

if (!isset($_POST['id_bodega']) || !is_numeric($_POST['id_bodega'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID inválido'
    ]);
    exit();
}

$id = $_POST['id_bodega'];

try {

    $d = new Datos();
    $pdo = $d->conectar();   

    // Verificar si existe en la bd 
    $stmt = $pdo->prepare("SELECT id_bodega FROM bodegas WHERE id_bodega = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'La bodega no existe'
        ]);
        exit();
    }

    // Eliminar relación primero
    $stmt = $pdo->prepare("DELETE FROM bodega_encargado WHERE bodega_id = ?");
    $stmt->execute([$id]);

    // Luego eliminar bodega
    $stmt = $pdo->prepare("DELETE FROM bodegas WHERE id_bodega = ?");
    $stmt->execute([$id]);

    echo json_encode([
        'success' => true,
        'message' => 'Bodega eliminada correctamente'
    ]);

} catch (PDOException $e) {

    echo json_encode([
        'success' => false,
        'message' => 'Error al eliminar'
    ]);
}